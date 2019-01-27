<?php

namespace Internaltide\ComponentInjection\Components;

use Illuminate\Support\Facades\Facade;

class ComponentFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'component.factory';
    }
}
