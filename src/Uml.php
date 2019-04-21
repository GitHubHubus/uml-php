<?php

namespace OK\Uml;

use OK\Uml\File\File;
use OK\Uml\Parser\ParserInterface;
use OK\Uml\Serializer\SerializerInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Uml
{
    private $rootDirectory = null;
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
        $this->rootDirectory = $directory;
        $this->parser = $parser;
        $this->serializer = $serializer;
    }

    public function get()
    {
        $data = $this->process();

        return $this->serializer->serialize($data);
    }
    
    public function getRaw()
    {
        return $this->process();
    }
    
    private function process(): array
    {
        $data = [];
        $files = File::get($this->rootDirectory);
        
        foreach ($files as $file) {
            $class = File::getClassName($file);
            $data[] = $this->parser::getClassInformation($class);
        }
        
        return $data;
    }
}
