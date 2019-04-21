<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\ConstantNode;
use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ConstantFactory implements NodeFactoryInterface
{
    /**
     * @param array $object <p>[name => value]</p>
     *
     * @return ConstantNode
     */
    public function create($object): NodeInterface
    {
        $constantNode = new ConstantNode();
        $constantNode->name = $object[0];
        $constantNode->type = gettype($object[1]);

        return $constantNode;
    }
}
