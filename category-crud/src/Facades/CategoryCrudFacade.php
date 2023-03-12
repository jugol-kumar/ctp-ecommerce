<?php


namespace JugolKumar\CategoryCurd\Facades;

use Illuminate\Support\Facades\Facade;

class CategoryCrudFacade extends Facade{


    protected static function getFacadeAccessor(): string
    {
        return "JugolCategory";
    }

}
