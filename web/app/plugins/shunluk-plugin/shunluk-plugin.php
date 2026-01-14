<?php
/**
 * Plugin Name: Shun Luk's Plugin
 * Plugin URI: https://shunluk.com
 * Description: A custom plugin made by Shun Luk to test some Yard features
 * Version: 0.0.1
 * Author: Shun Luk
 * Author URI: https://shunluk.com
 * Text Domain: shunluk
 * Requires at least: 6.6
 */

/**
 * Exit when accessed directly.
 */
if ( ! defined( 'ABSPATH' )) {
	exit;
}

if ( ! class_exists('ShunLukPlugin') ) {
    class ShunLukPlugin {
        public function __construct() {
            // do something
        }
    }
}