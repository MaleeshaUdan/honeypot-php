<?php
/**
 * Advanced PHP Honeypot Script with Bootstrap 5 Admin Login Simulation, Bot Detection, and Enhanced Logging
 * Logs details only when the fake admin login form is submitted, including bot detection and time zone information.
 * Adds a blank line between log records for better readability.
 * Note: This script is for educational purposes. Customize and use it at your own risk.

 * This Honeypot script was created by Maleesha Udan Aththanayaka
 * https://github.com/MaleeshaUdan
 */

class AdvancedHoneypot {
    private $logFile = 'honeypot_log.txt';

    public function __construct() {
        // Optional: Set a specific time zone. Comment this line to use the server's default time zone.
        // date_default_timezone_set('America/New_York');
        
        $this->checkFormSubmission();
        $this->displayLoginForm();
    }

    private function checkFormSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isBot = !empty($_POST['email_confirm']) ? 'true' : 'false';
            $timeZone = date_default_timezone_get();
            $submissionData = [
                'time' => date('Y-m-d H:i:s') . " (Time Zone: $timeZone)",
                'ip' => $this->getIP(),
                'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                'submittedUsername' => $_POST['username'] ?? 'N/A',
                'submittedPassword' => $_POST['password'] ?? 'N/A',
                'botAction' => $isBot 
            ];
            $logEntry = "FORM SUBMISSION | " . implode(" | ", array_map(
                function ($v, $k) { return sprintf("%s: %s", $k, $v); },
                $submissionData,
                array_keys($submissionData)
            )) . "\n\n"; 

            file_put_contents($this->logFile, $logEntry, FILE_APPEND);

            header('Location: checklogin.php'); 
            exit;
        }
    }
    private function displayLoginForm() {
        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Login Here</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <!-- Honeypot Field (hidden from users) -->
                            <div style="display:none;">
                                <input type="text" name="email_confirm" id="email_confirm" value="">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
HTML;
    }
    private function getIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}
new AdvancedHoneypot();
