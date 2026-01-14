<?php

declare(strict_types=1);

namespace App\View\Components;

use \Yard\Data\Contracts\PostDataInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $title = null,
        public ?string $url = null,
        public ?string $target = null,
		public ?string $postType = null,
        public ?array $extraClasses = []       
    ) {
		$this->hydrate();
    }

	protected function hydrate(): void
	{
		// This method is intended to be overridden in subclasses
	}

	public function buttonClass(): string
	{
		return 'button' . ($this->postType ? " button-{$this->postType}" : '');
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.button');
    }
}
