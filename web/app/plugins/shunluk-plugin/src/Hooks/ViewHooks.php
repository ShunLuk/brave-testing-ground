<?php

namespace ShunLuk\Hooks;

use Yard\Hook\Action;

class ViewHooks
{
    #[Action('after_setup_theme', 5)]
    public function registerView()
    {
        if (function_exists('\Roots\view')) {
            \Roots\view()->addLocation(PLUGIN_PATH . '/resources/views');
        }
    }
}