<?php

declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Roots\Acorn\View\Composer;

class VacComposer extends Composer
{
	private $amount;
	private $page;
	private $subjects;
	private $ministries;

	public function __construct(Request $request)
	{
		$this->amount = $request->query('amount') ?? 25;
		$this->page = $request->query('page');
		$this->subjects = $request->query('subjects');
		$this->ministries = $request->query('ministries');
	}

	/**
	 * List of views served by this composer.
	 *
	 * @var string[]
	 */
	protected static $views = [
		'template-vacs',
	];

	/**
	 * This will make the variable `$roots` available in the 'example' partial
	 * with the value described here.
	 */
	public function with()
	{
		return [
			'faqs' => $this->getFaqs(),
			'subjects' => $this->getSubjects(),
			'ministries' => $this->getMinistries(),
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

	private function makeApiCallOpendata($endpoint, $params = []): array
	{
		$baseUrl = 'https://opendata.rijksoverheid.nl/v1/infotypes/';
		$url = $baseUrl . "{$endpoint}?output=json";

		foreach ($params as $key => $value) {
			$url .= "&{$key}={$value}";
		}

		$response = $this->makeApiCall($url);
		if ($response) {
			return $response;
		}

		return [];
	}

	private function getAllSubjects(): array
	{
		$params = [];

		return $this->makeApiCallOpendata('subject', $params);
	}

	private function getAllMinistries(): array
	{
		$params = [];

		return $this->makeApiCallOpendata('ministry', $params);
	}

	private function getSingleFaq($faqId): array
	{
		return $this->makeApiCallOpendata("faq/{$faqId}");
	}

	private function getTheFaqs($rows = 25, $offset = null): array
	{
		$params = [
			'rows' => $rows,
		];
		if ($offset) {
			$params['offset'] = $offset;
		}

		return $this->makeApiCallOpendata('faq', $params);
	}

	private function getSubjectFaqs($subject, $rows = 25, $offset = null)
	{
		$params = [
			'rows' => $rows,
		];

		if ($offset) {
			$params['offset'] = $offset;
		}

		return $this->makeApiCallOpendata("faq/subjects/{$subject}", $params);
	}

	private function getMinistryFaqs($ministry, $rows = 25, $offset = null)
	{
		$params = [
			'rows' => $rows,
		];

		if ($offset) {
			$params['offset'] = $offset;
		}

		return $this->makeApiCallOpendata("faq/ministries/{$ministry}", $params);
	}

	private function getAllFaqs(): array
	{
		$amount = $this->amount;
		$faqs = $this->getTheFaqs($amount);

		$nextFaqs = $this->getTheFaqs($amount + 1);

		//		$page = $this->page;
		//		if ($page) {
		//
		//		}

		return $faqs;
	}

	private function getMinistries(): object
	{
		$ministries = [];
		$ministriesObjects = $this->getAllMinistries();
		foreach ($ministriesObjects as $ministryObject) {
			$ministry = [
				'id' => $ministryObject['id'],
				'name' => $ministryObject['name'],
				'label' => $ministryObject['title'],
			];
			$ministries[] = (object)$ministry;
		}

		return (object)$ministries;
	}

	private function getSubjects(): object
	{
		$subjects = [];
		$subjectsObjects = $this->getAllSubjects();
		foreach ($subjectsObjects as $subjectObject) {
			$subject = [
				'id' => $subjectObject['id'],
				'name' => $subjectObject['name'],
				'label' => $subjectObject['title'],
			];
			$subjects[] = (object)$subject;
		}
		sort($subjects);

		return (object)$subjects;
	}

	public function getFaqs(): array
	{
		$faqs = [];

		if (! is_null($this->subjects) && '' != $this->subjects) {
			$allFaqs = $this->getSubjectFaqs($this->subjects) ?? [];
		} elseif (! is_null($this->ministries) && '' != $this->ministries) {
			$allFaqs = $this->getMinistryFaqs($this->ministries) ?? [];
		} else {
			$allFaqs = $this->getAllFaqs() ?? [];
		}

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
