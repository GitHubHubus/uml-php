<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface NodeFactoryInterface
{
    /**
     * @param \Reflection $object
     */
    public function create($object): NodeInterface;
}
