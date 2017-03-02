<?php
namespace Tzsk\ShortenUrl\Facade;


use Illuminate\Support\Facades\Facade;

class GoogleUrl extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'tzsk-shorten-url';
    }
}