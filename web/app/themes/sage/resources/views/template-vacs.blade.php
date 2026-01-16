@php
/**
* Template Name: Veelgestelde Vragen Template
*
*/
@endphp
<x-layout>
	<h1>Veelgestelde Vragen</h1>
	<div class="faqs-wrapper">
		<form class="faqs-filters">
			@php($selectedAmount = app('request')->input('amount') ?? 0)
			<div class="faq-filter">
				<label for="amount">Hoeveelheid vragen tonen</label>
				<select name="amount">
					<option value="25"{{ ($selectedAmount == 25 ? ' selected' : '') }}>25</option>
					<option value="50"{{ ($selectedAmount == 50 ? ' selected' : '') }}>50</option>
					<option value="100"{{ ($selectedAmount == 100 ? ' selected' : '') }}>100</option>
					<option value="150"{{ ($selectedAmount == 150 ? ' selected' : '') }}>150</option>
					<option value="200"{{ ($selectedAmount == 200 ? ' selected' : '') }}>200</option>
				</select>
			</div>
			@if ($subjects)
				@php($selectedSubject = app('request')->input('subjects') ?? '')
				<div class="faq-filter">
					<label for="subjects">Filteren op onderwerpen</label>
					<select name="subjects">
						<option value="">Kies een onderwerp</option>
						@foreach($subjects as $subject)
							<option value="{{ $subject->name }}">{{ $subject->label }}</option>
						@endforeach
					</select>
				</div>
			@endif
			@if ($ministries)
				@php($selectedMinistry = app('request')->input('ministries') ?? '')
				<div class="faq-filter">
					<label for="ministries">Filteren op ministeries</label>
					<select name="ministries">
						<option value="">Kies een ministerie</option>
						@foreach($ministries as $ministry)
							<option value="{{ $ministry->name }}">{{ $ministry->label }}</option>
						@endforeach
					</select>
				</div>
			@endif
			<button class="button" type="submit">Filter</button>
		</form>
		@if(count($faqs))
			<div class="faqs ac-panel">
				@foreach($faqs as $faq)
					<div class="faq-item faq-item-{{ $faq->id }}">
						<a class="faq-item-question" href="javascript:toggleFaq('{{ $faq->id }}')">
							<h2>{{ $loop->iteration }}. {{ $faq->question }}</h2>
							<span class="faq-item-toggler closed">+</span>
							<span class="faq-item-toggler open">-</span>
						</a>
						<div class="faq-item-answer">
							@if($faq->introduction)
								<div class="faq-item-answer-intro">
									{!! $faq->introduction !!}
								</div>
							@endif
							@if (property_exists($faq, 'content') && count($faq->content))
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
							@if($faq->canonical)
								<a href="{{ $faq->canonical }}" target="_blank" title="{{ $faq->question }}">
									{{ $faq->question }}
								</a>
							@endif
						</div>
					</div>
				@endforeach
			</div>
			<div class="faq-pagination">

			</div>
		@else
			Er zijn geen veelgestelde vragen gevonden
		@endif
	</div>
</x-layout>
<script>
	function toggleFaq(faqId) {
		var faqSelector = `.faq-item-${faqId}`;
		var faqWrapper = document.querySelector(faqSelector);

		if (!faqWrapper.classList.contains('open') && !faqWrapper.classList.contains('closed')) {
			faqWrapper.classList.add('open');
		} else {
			faqWrapper.classList.toggle('open');
			faqWrapper.classList.toggle('closed');
		}
		console.log(faqWrapper.classList);
	}
</script>
