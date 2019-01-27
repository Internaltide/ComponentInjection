<?php

namespace Internaltide\ComponentInjection\Components;

use App;
use Internaltide\ComponentInjection\FactoryContract;
use Internaltide\ComponentInjection\FactoryException;

class ComponentFactory implements FactoryContract
{
    const COMPONENT_PREFIX = __NAMESPACE__;
    const COMPONENT_SUFFIX = 'Component';

    private $reserveName = ['modal'];

    public function __construct()
    {
        // do nothing
    }

    public function create($compoentClassMethod, ...$arguments)
    {
        $parser = explode('@', $compoentClassMethod);

        // If component client defined exist, use it
        if ( function_exists('config') ) {
            $class = static::generate($parser[0], config('component.extra.namespace'));
            if ( class_exists($class) ) {
                $component = App::make($class);
                return call_user_func_array(array($component, $parser[1]), $arguments);
            }
        }

        // If component client defined not exist, use built-in
        $class = static::generate($parser[0]);
        if ( class_exists($class) ) {
            $component = App::make($class);
            return call_user_func_array(array($component, $parser[1]), $arguments);
        }

        throw new FactoryException('Component Not Found.');
    }

    protected function generate($name, $namespace = __NAMESPACE__)
    {
        if( is_null($namespace) ){
            throw new FactoryException('Component namespace not found.');
        }

        if( $this->isReserved($name) ){
            $name = ucfirst($name);
            $namespace = $this->always(__NAMESPACE__);
        }

        return strtr('{namespace}\{component_name}{suffix}', [
            '{namespace}' => $namespace,
            '{component_name}' => $name,
            '{suffix}' => static::COMPONENT_SUFFIX
        ]);
    }

    private function isReserved($name)
    {
        $name = strtolower($name);

        return ( in_array($name, $this->reserveName) ) ? true:false;
    }

    private function always($val)
    {
        return $val;
    }
}
