<x-layout>
	<div class="flex flex-col md:flex-row md:items-center">
		@if($banner)
			<div class="banner-image flex w-100 justify-center">
				{!! $banner->image !!}
			</div>
			<div class="banner-content flex flex-col w-100 text-left md:text-center">
				<h1>{{ $banner->title }}</h1>
				<span>{{ $banner->subtitle }}</span>
			</div>
		@endif
	</div>
	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
</x-layout>
