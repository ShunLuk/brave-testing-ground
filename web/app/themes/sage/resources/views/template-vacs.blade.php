@php
/**
* Template Name: Veelgestelde Vragen Template
*
*/
@endphp
<x-layout>
	<h1>Veelgestelde Vragen</h1>
	<div class="faqs-wrapper">
		@if(count($faqs))
			@foreach($faqs as $faq)
				<div class="faq-item faq-item-{{ $faq->id }}">
					<h2 class="faq-item-question">{{ $faq->question }}</h2>
					<div class="faq-item-answer">
						@if($faq->introduction)
							<div class="faq-item-answer-intro">
								{!! $faq->introduction !!}
							</div>
						@endif
						@if ($faq->content && count($faq->content))
							@foreach($faq->content as $faqParagraph)
								<div class="faq-item-answer-paragraph">
									@if(array_key_exists('paragraphtitle', $faqParagraph))
										<h3 class="faq-item-answer-paragraph-title">{{ $faqParagraph['paragraphtitle'] }}</h3>
									@endif
									@if (array_key_exists('paragraph', $faqParagraph))
										{!! $faqParagraph['paragraph'] !!}
									@endif
								</div>
							@endforeach
						@endif
					</div>
					@if($faq->canonical)
						<a href="{{ $faq->canonical }}" target="_blank" title="{{ $faq->question }}">
							{{ $faq->question }}
						</a>
					@endif
				</div>
			@endforeach
		@else
			Er zijn geen veelgestelde vragen gevonden
		@endif
	</div>
</x-layout>
