<x-layout>
	<div class="frontpage-banner">
		@if($banner)
			<div class="banner-image">
				{!! $banner->image !!}
			</div>
			<div class="banner-content">
				<h1>{{ $banner->title }}</h1>
				<span>{{ $banner->subtitle }}</span>
				@if($banner->buttons) @php($buttons = $banner->buttons)
					<div class="banner-buttons">
						<div class="banner-buttons-grouped">
							@if($buttons->linkedin) @php($linkedin = $buttons->linkedin)
								<x-button :title="$linkedin->title" :url="$linkedin->url" :target="$linkedin->target" :extra-classes="['banner-button']" />
							@endif
							@if($buttons->github) @php($github = $buttons->github)
								<x-button :title="$github->title" :url="$github->url" :target="$github->target" :extra-classes="['banner-button']" />
							@endif
							@if($buttons->dribbble) @php($dribbble = $buttons->dribbble)
								<x-button :title="$dribbble->title" :url="$dribbble->url" :target="$dribbble->target" :extra-classes="['banner-button']" />
							@endif
						</div>
						@if($buttons->contact) @php($contact = $buttons->contact)
							<x-button :title="$contact->title" :url="$contact->url" :target="$contact->target" :extra-classes="['banner-button banner-button-contact']" />
						@endif
					</div>
				@endif
			</div>
		@endif
	</div>
	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
</x-layout>
