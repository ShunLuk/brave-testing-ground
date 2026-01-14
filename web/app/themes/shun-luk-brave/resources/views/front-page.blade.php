<x-layout>
	@while (have_posts())
		@php(the_post())
		@php(the_content())
	@endwhile
    Hello World!
</x-layout>
