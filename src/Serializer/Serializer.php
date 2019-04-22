<?php

namespace OK\Uml\Serializer;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Serializer implements SerializerInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function serialize(array $data): string
    {
        return 'json serialize result';
    }
}
