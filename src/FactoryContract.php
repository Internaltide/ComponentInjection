<?php

namespace Internatide\ComponentInjection;

interface FactoryContract
{
    public function create($compoentClassMethod, ...$arguments);
}
