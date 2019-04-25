<?php

namespace Tests\Classes;

trait NewTrait
{
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var array
     */
    private $modifiers = [];

    /**
     * @param array $modifiers
     */
    public function setModifiers(array $modifiers)
    {
        $this->modifiers = $modifiers;
    }
    
    /**
     * @param return array
     */
    public function getModifiers(): array
    {
        return $this->modifiers;
    }
}
