<?php namespace App\Services;

use \DOMDocument;

use Illuminate\Http\Request;

class CrawlService{

	public static function crawl($url, $from)
	{
		$result = [];
		if($url)
		{
			$html=file_get_contents($url);
		}
		else
		{
			$html='';
		}
		if(!empty($html))
		{	
			$doc = new DOMDocument();
			@$doc->loadHTML('<?xml encoding="UTF-8">' .$html);
			$doc->encoding = 'UTF-8';
			if($from == 'in')
			{
				return CrawlService::LinkedInCrawl($doc);
			}
			else if($from == 'fb')
			{
				return CrawlService::FacebookCrawl($doc);
			}
		}
	}

	private static function LinkedInCrawl($doc)
	{
		$currexperience = $passexperience = $award = $lang = $school = $recom = [];

		$name = $doc->getElementById('name')->nodeValue;
		$description = $doc->getElementById('summary')->nodeValue;
		$list = $doc->getElementsByTagName('li');
		for ($i = 0; $i < $list->length; $i++)
		{
			$lists = $list->item($i);
			if($lists->getAttribute('data-section') == 'currentPositionsDetails')
			{
				$currexperience[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('data-section') == 'pastPositionsDetails')
			{
				$passexperience[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'award')
			{
				$award[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'language')
			{
				$lang[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'school')
			{
				$school[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'recommendation-container')
			{
				$recom[] = $lists->nodeValue;
			}
		}
		return array(
			'name' => $name,
			'description' => $description,
			'current_experience' => $currexperience,
			'past_experience' => $passexperience,
			'award' => $award,
			'language' => $lang,
			'school' => $school,
			'recomendation' => $recom
		);
	}

	private static function FacebookCrawl($doc)
	{
		$name = $doc->getElementById('fb-timeline-cover-name');
		$images = $doc->getElementsByTagName('img');
		$photo='';
		foreach($images as $img)
		{
			$im = $img->item($i);
				$photo = $im->nodeValue;
		}
		print_r($photo);die();

		$description = $doc->getElementById('summary')->nodeValue;
		$list = $doc->getElementsByTagName('li');
		for ($i = 0; $i < $list->length; $i++)
		{
			$lists = $list->item($i);
			if($lists->getAttribute('data-section') == 'currentPositionsDetails')
			{
				$currexperience[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('data-section') == 'pastPositionsDetails')
			{
				$passexperience[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'award')
			{
				$award[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'language')
			{
				$lang[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'school')
			{
				$school[] = $lists->nodeValue;
			}
			else if($lists->getAttribute('class') == 'recommendation-container')
			{
				$recom[] = $lists->nodeValue;
			}
		}
		return array(
			'name' => $name,
			'description' => $description,
			'current_experience' => $currexperience,
			'past_experience' => $passexperience,
			'award' => $award,
			'language' => $lang,
			'school' => $school,
			'recomendation' => $recom
		);
	}
}
