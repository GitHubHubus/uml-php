<?php

namespace OK\Uml\Serializer;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface SerializerInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function serialize(array $data): string;
}
