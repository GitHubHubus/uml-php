<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait CommonNode
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
}
