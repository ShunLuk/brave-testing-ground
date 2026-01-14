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

namespace ShunLuk;

/**
 * Exit when accessed directly.
 */
if ( ! defined( 'ABSPATH' )) {
	exit;
}

use Yard\Hook\Registrar;

if ( ! class_exists('ShunLukPlugin') ) {
    class ShunLukPlugin {
        public function __construct() {
            // do something
            $this->autoload();
            $this->hooks();
        }

        private function dirToArray($dir)
        {
            $out = [];
            $dirScan = scandir($dir);
            foreach ($dirScan as $file) {
                if (!in_array($file, [ '.', '..' ])) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $file)) {
                        $out = array_merge($out, $this->dirToArray($dir . DIRECTORY_SEPARATOR . $file));
                    } else {
                        $out[] = $dir . DIRECTORY_SEPARATOR . $file;
                    }
                }
            }
            return $out;
        }

        private function autoload()
        {
            require __DIR__ . '/vendor/autoload.php';

            $srcDir = __DIR__ .'/src';
            $srcRequires = $this->dirToArray($srcDir);
            foreach ($srcRequires as $srcRequire) {
                require $srcRequire;
            }
        }

        private function hooks()
        {
            $registrar = new Registrar();
            $registrar->addClass(
                Hooks\ShortcodeHooks::class
            );
            // dd($registrar);
            $registrar->registerHooks();
        }
    }
    $shp = new ShunLukPlugin();
}
