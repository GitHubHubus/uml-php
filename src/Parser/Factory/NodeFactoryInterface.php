<?php

namespace OK\Uml\Parser\Factory;

use OK\Uml\Entity\ArgumentNode;
use OK\Uml\Entity\ClassNode;
use OK\Uml\Entity\ConstantNode;
use OK\Uml\Entity\InterfaceNode;
use OK\Uml\Entity\MethodNode;
use OK\Uml\Entity\PropertyNode;
use OK\Uml\Entity\TraitNode;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface NodeFactoryInterface
{
    public static function create($object);
}
