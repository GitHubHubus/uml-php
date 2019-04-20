<?php

namespace OK\Uml\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
trait CommonNode {
    public $name;
    private $modifiers = [];
    
    public function addModifier(string $modifier)
    {
        $this->modifiers[] = $modifier;
    }
}
