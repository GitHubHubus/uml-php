<?php

namespace OK\Uml\Serializer;

use \OK\Uml\Entity\NodeInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface SerializerInterface
{
    /**
     * @param NodeInterface[] $nodes
     *
     * @return string
     */
    public function serialize(array $nodes): string;
}
