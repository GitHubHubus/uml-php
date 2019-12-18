<?php

namespace OK\Uml;

use OK\Uml\Entity\NodeInterface;
use OK\Uml\FileCrawler\FileCrawler;
use OK\Uml\Parser\ParserInterface;
use OK\Uml\Serializer\SerializerInterface;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Uml
{
    /**
     * @var string
     */
    private $rootDirectory;

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ParserInterface 
     */
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

    /**
     * @return string
     */
    public function get(): string
    {
        $data = $this->process();

        return $this->serializer->serialize($data);
    }

    /**
     * @return array
     */
    public function getRaw(): array
    {
        return $this->process();
    }

    /**
     * @return array
     * @throws FileCrawler\Exception\FileCrawlerException
     */
    private function process(): array
    {
        $data = [];
        $files = FileCrawler::get($this->rootDirectory);
        
        foreach ($files as $file) {
            $class = FileCrawler::getClassInfo($file);
            $node = $this->parser::getClassMetadata($class[0], NodeInterface::CLASS_TYPES[$class[1]]);

            if ($node) {
                $data[] = $node;
            }
        }

        return $data;
    }
}
