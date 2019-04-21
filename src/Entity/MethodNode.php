<?php

namespace OK\Uml\Entity;

use OK\Uml\Entity\ArgumentNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class MethodNode implements NodeInterface {
    use CommonNode;

    public $arguments = [];
    public $type;
    
    public function addArgument(ArgumentNode $argument)
    {
        $this->arguments[] = $argument;
    }
    
    /**
     * @return string
     */
    public static function getNodeType(): string
    {
        return NodeInterface::TYPE_METHOD;
    }
}
