<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Site timezone
$conf['site_timezone'] = 'Africa/Nairobi';

// Site information
$conf['site_name'] = 'Nuki Books';
$conf['site_url']  = 'http://localhost/nuki';
$conf['admin_email'] = 'admin@Nukibooks.com';

// Site language
$conf['site_lang'] = 'en';

// Database configuration
$conf['db_type'] = 'mysqli';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = 'newpassword123';
$conf['db_name'] = 'iap_assignment';

// Email configuration
$conf['smtp_user'] = 'your_gmail@gmail.com';
$conf['smtp_pass'] = 'your_app_password'; // not your Gmail password
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_port'] = 465;
$conf['smtp_secure'] = 'ssl';


// Password policy
$conf['min_password_length'] = 8;

// Allowed email domains for signup
$conf['valid_email_domain'] = [
    'gmail.com',
    'yahoo.com',
    'outlook.com',
    'hotmail.com',
    'strathmore.edu'
];
