<?php namespace App\Http\Controllers;

use App\Services\CrawlService;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CrawlController extends Controller {

	public function crawl(Request $request)
	{
		$url = $request->input('url');
		$from = $request->input('from');
		return CrawlService::crawl($url, $from);
	}
}
