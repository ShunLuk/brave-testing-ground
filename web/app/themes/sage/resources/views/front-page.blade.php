<x-layout>
	<div class="flex flex-col md:flex-row md:items-center">
		@if($banner)
			<div class="banner-image flex justify-center">
				{!! $banner->image !!}
			</div>
			<div class="banner-content flex flex-col text-left md:text-center">
				<h1>{{ $banner->title }}</h1>
				<span>{{ $banner->subtitle }}</span>
				@if($banner->buttons) @php($buttons = $banner->buttons)
					<div class="banner-buttons">
						<div class="banner-buttons-grouped">
							@if($buttons->linkedin) @php($linkedin = $buttons->linkedin)
								<x-button :title="$linkedin->title" :url="$linkedin->url" :target="$linkedin->target" />
							@endif
							@if($buttons->github) @php($github = $buttons->github)
								<x-button :title="$github->title" :url="$github->url" :target="$github->target" />
							@endif
							@if($buttons->dribbble) @php($dribbble = $buttons->dribbble)
								<x-button :title="$dribbble->title" :url="$dribbble->url" :target="$dribbble->target" />
							@endif
						</div>
						@if($buttons->contact) @php($contact = $buttons->contact)
							<x-button :title="$contact->title" :url="$contact->url" :target="$contact->target" />
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
