<?php

namespace ShunLuk\App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontpageComposer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        '*',
        'front-page',
    ];
    
    /**
     * This will make the variable `$roots` available in the 'example' partial
     * with the value described here.
     */
    public function with()
    {
        return [
            'texts' => $this->getTexts(),
        ];
    }

    private function getTexts()
    {
        $texts = [];
        dd($texts);

        return (object) $texts;
    }
}
