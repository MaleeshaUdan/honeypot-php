# 🍯Advanced PHP Honeypot Script

This repository hosts an advanced PHP script designed to emulate a vulnerable login form, complete with Bootstrap 5 styling. It's crafted to attract, detect, and log bot submissions alongside human interactions, incorporating enhanced logging with time zone details and bot activity detection. Dive into deploying your own honeypot to safeguard your applications by trapping malicious actors in their tracks!

## 📋 Prerequisites
Before you begin, make sure you have:

- A server with PHP support.
- Access to modify server files (for placing the honeypot script).
- Basic knowledge of PHP and web server configurations.

  # 🔑 Configuration
The script includes several key features that can be configured:

- Time Zone: The script uses the server's default time zone for logging. You can specify a different time zone directly in the script using date_default_timezone_set().
- Log File: Adjustments can be made to the $logFile variable to change the log file's location or name as desired.

# 🚀 Getting Started
1. **Clone the Repository:** Download the script to your local machine or server.
    `https://github.com/MaleeshaUdan/honeypot-php.git`
2. **Place the Script:** Upload `index.php` and any other files to your desired directory on the server.
3. **Adjust Permissions:** Ensure the script and log file have appropriate permissions. Writing should be enabled for the server process.
4. **Visit the Honeypot:** Access the honeypot via your browser to see it in action, or wait for it to capture real threats.


