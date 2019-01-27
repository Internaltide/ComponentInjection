<?php

namespace Internaltide\ComponentInjection;

interface FactoryContract
{
    public function create($compoentClassMethod, ...$arguments);
}
