<?php

namespace OK\Uml\FileCrawler;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClassInfo
{
    private $path = '';

    private $type = '';

    public function __construct(string $path, string $type)
    {
        $this->path = $path;
        $this->type = $type;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
