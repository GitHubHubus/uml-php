<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\ArgumentNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class MethodNode {
    use CommonNode;

    public $arguments = [];
    public $type;
    
    public function addArgument(ArgumentNode $argument)
    {
        $this->arguments[] = $argument;
    }
}
