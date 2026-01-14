<?php

namespace ShunLuk\Hooks;

use Yard\Hook\Action;

class ShortcodeHooks
{
    #[Action('init')]
    public function registerShortcode()
    {
        add_shortcode('shun-luk-test', [$this, 'render']);
    }

    public function render($atts, $content = null)
    {
        $attributes = shortcode_atts([
            'title' => 'Test Shortcodee',
        ], $atts);

        return view('test', [
            'title' => $attributes['title'],
            'slot'  => $content,
        ])->render();
    }
}