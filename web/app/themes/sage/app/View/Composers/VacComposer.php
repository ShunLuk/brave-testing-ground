<?php

declare(strict_types=1);

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Illuminate\Support\Facades\Http;

class VacComposer extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var string[]
	 */
	protected static $views = [
		'template-vacs'
	];

	/**
	 * This will make the variable `$roots` available in the 'example' partial
	 * with the value described here.
	 */
	public function with()
	{
		return [
			'faqs' => $this->getFaqs(),
		];
	}

	private function makeApiCall($url)
	{
		$response = Http::get($url);

		if ($response->successful()) {
			return $response->json();
		}

		return false;
	}

	private function makeApiCallOpendata($endpoint): array
	{
		$baseUrl = 'https://opendata.rijksoverheid.nl/v1/infotypes/';
		$url = $baseUrl . "{$endpoint}?output=json";

		$response = $this->makeApiCall($url);
		if ($response) {
			return $response;
		}

		return [];
	}

	private function getSingleFaq($faqId): array
	{
		return $this->makeApiCallOpendata("faq/{$faqId}");
	}

	private function getAllFaqs(): array
	{
		return $this->makeApiCallOpendata('faq');
	}
	public function getFaqs(): array
	{
		$faqs = [];
		$allFaqs = $this->makeApiCallOpendata('faq') ?? [];
		foreach ($allFaqs as $faqObject) {
			$faqId = $faqObject['id'];
			$faqResponse = $this->getSingleFaq($faqId);
			if ($faqResponse) {
				$faqs[] = (object) $faqResponse;
			}
		}

		return $faqs;
	}
}
