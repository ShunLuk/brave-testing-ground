<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontpageComposer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * This will make the variable `$roots` available in the 'example' partial
     * with the value described here.
     */
    public function with()
    {
        return [
            'banner' => $this->getBannerData(),
        ];
    }

    private function getBannerData()
    {
        $title = get_field('title') ?? 'Hello World!';
        $subtitle = get_field('subtitle') ?? 'Just another Brave Theme';
        $banner_id = get_field('banner_image') ?? '';
        $buttons = get_field('buttons') ?? [];

        if ($banner_id && $banner_id != '') {
            $banner = wp_get_attachment_image($banner_id, 'large', false, ['class'=> '']);
        }

        $banner = [
            'title' => $title,
            'subtitle' => $subtitle,
            'image' => $banner,
        ];

        if ($buttons && count($buttons)) {
            $buttonsArr = [];
            foreach($buttons as $buttonKey => $button) {
				if ($button && $button !== '') {
					$buttonsArr[$buttonKey] = (object)$button;
				}
            }
			if(count($buttonsArr)) {
				$banner['buttons'] = (object)$buttonsArr;
			}
        }

        return (object) $banner;
    }
}
