<?php

/**
 * Plugin Name: opening
 */

namespace opening;

require (__DIR__ . '/vendor/autoload.php');

define('OPENING_PLUGIN_FILE', __FILE__);

define('OPENING_TEMPLATES_DIR', __DIR__ . '/templates');

define('OPENING_PLUGIN_URL', plugin_dir_url(__FILE__));

define('OPENING_THEME_URL', get_stylesheet_directory(__DIR__));

$opening = new Plugin();
$opening->run();

