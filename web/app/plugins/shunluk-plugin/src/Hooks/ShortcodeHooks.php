<?php

namespace ShunLuk\Hooks;

use Yard\Hook\Action;

class ShortcodeHooks
{
    #[Action('init')]
    public function registerShortcode(): void
    {
        add_shortcode('shun-luk-test', [$this, 'render']);
    }

    public function render($atts): string
    {
        return '<div class="shun-luk-test">This shortcode does something!</div>';
    }
}