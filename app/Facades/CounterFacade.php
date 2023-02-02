<?php


namespace App\Facades;


use App\Contracts\CounterContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class CounterFacade
 * @method static int increment(string $key, array $tags = null)
 */
class CounterFacade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return CounterContract::class;
    }
}
