<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', IS_DEBUG_MODE);

// Timezone
date_default_timezone_set($_ENV['TIMEZONE'] ?? 'Europe/London');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);

// Error Handling Middleware settings
$settings['error'] = [

    // Should be set to false in production
    'display_error_details' => IS_DEBUG_MODE,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => IS_DEBUG_MODE,

    // Display error details in error log
    'log_error_details' => IS_DEBUG_MODE,
];

return $settings;
