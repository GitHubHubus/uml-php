<?php

namespace OK\Uml;

use OK\Uml\Parser\ParserInterface;
use OK\Uml\Serializer\SerializerInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Uml
{
    private $prepared = [];
    private $serializer;
    private $parser;
    
    /**
     * @param string $directory
     * @param ParserInterface $parser
     * @param SerializerInterface $serializer
     */
    public function __construct(string $directory, ParserInterface $parser, SerializerInterface $serializer)
    {
        $this->parser = $parser;
        $this->serializer = $serializer;
    }
    
    public function get()
    {
        ;
    }
}
