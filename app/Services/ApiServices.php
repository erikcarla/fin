<?php namespace App\Services;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

abstract class ApiServices {

	private static $statusCode = 200;

	protected static function respondWithArray(array $array)
	{
		return response()->json($array, ApiServices::$statusCode);
	}

	protected static function respondWithItem($item, $callback)
	{
		$resource = new Item($item, $callback);
		$manager = new Manager();
		$rootScope = $manager->createData($resource);
		return ApiServices::respondWithArray($rootScope->toArray());
	}
}
