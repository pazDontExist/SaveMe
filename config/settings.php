<?php

$dotenv = \Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->overload();
// Should be set to 0 in production
getenv('ENVIRONMENT') == 'prod' ? error_reporting(0) : error_reporting(E_ALL);

// Should be set to '0' in production
getenv('ENVIRONMENT') == 'prod' ? ini_set('display_errors', '0') : ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('Europe/Rome');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['template'] = $settings['root'] . '/templates';

// Error Handling Middleware settings
if ( getenv('ENVIRONMENT') == 'dev')  {
    $settings['error'] = [

        // Should be set to false in production
        'display_error_details' => true,

        // Parameter is passed to the default ErrorHandler
        // View in rendered output by enabling the "displayErrorDetails" setting.
        // For the console and unit tests we also disable it
        'log_errors' => true,

        // Display error details in error log
        'log_error_details' => true,
    ];
} else {
    $settings['error'] = [

        // Should be set to false in production
        'display_error_details' => false,

        // Parameter is passed to the default ErrorHandler
        // View in rendered output by enabling the "displayErrorDetails" setting.
        // For the console and unit tests we also disable it
        'log_errors' => false,

        // Display error details in error log
        'log_error_details' => false,
    ];
}

// Database settings
$settings['db'] = [
    'driver' => \Cake\Database\Driver\Mysql::class,
    'host' => getenv('DB_HOST'),
    'username' => getenv('DB_USER'),
    'database' => getenv('DB_NAME'),
    'password' => getenv('DB_PASS'),
    // Enable identifier quoting
    'quoteIdentifiers' => true,
    // Set to null to use MySQL servers timezone
    'timezone' => null,
    // Disable meta data cache
    'cacheMetadata' => false,
    // Disable query logging
    'log' => false,
    'charset' => 'utf8mb4',
    'encoding' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Set connection timeout
        PDO::ATTR_TIMEOUT => 2,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
        // Convert numeric values to strings when fetching.
        // Since PHP 8.1 integers and floats in result sets will be returned using native PHP types.
        // This option restores the previous behavior.
        PDO::ATTR_STRINGIFY_FETCHES => true,
    ],
];


// Phoenix settings
$settings['phoenix'] = [
    'migration_dirs' => [
        'first' => __DIR__ . '/../resources/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST'),
            'port' => 3306,
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'db_name' => getenv('DB_NAME'),
            'charset' => 'utf8',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];

// Console commands
$settings['commands'] = [
    \App\Console\SchemaDumpCommand::class,
];

$settings['view'] = [
// Path to templates
    'path' => __DIR__ . '/../templates',
];

// Twig settings
$settings['twig'] = [
    // Template paths
    'paths' => [
        __DIR__ . '/../templates',
    ],
    // Twig environment options
    'options' => [
        // Should be set to true in production
        'cache_enabled' => false,
        'cache_path' => __DIR__ . '/../tmp/twig',
    ],
];

$settings['commands'] = [
    \App\Console\SchemaDumpCommand::class,
    // Add more here...
];

$settings['session'] = [
    'name' => 'save_me',
    'cache_expire' => 0,
];

$settings['upload_directory'] = __DIR__ . '/../data';

return $settings;