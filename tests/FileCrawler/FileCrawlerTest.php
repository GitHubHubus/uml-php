<?php

namespace Tests\FileCrawler;

use Tests\TestCase;
use OK\Uml\FileCrawler\FileCrawler;
use OK\Uml\FileCrawler\Exception\FileCrawlerException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class FileCrawlerTest extends TestCase
{
    /**
     * @dataProvider getProvider
     */
    public function testGet($directory, $result)
    {
        if ($result === null) {
            $this->expectException(FileCrawlerException::class);
        }
        
        $data = FileCrawler::get($directory);
        
        if ($result !== null) {
            $this->assertEquals($result, $data);
        }
    }
    
    public function getProvider()
    {
        return [
            [__DIR__ . '/../Classes', [__DIR__ . '/../Classes/AbstractClass.php', __DIR__ . '/../Classes/NewClass.php', __DIR__ . '/../Classes/NewInterface.php', __DIR__ . '/../Classes/NewTrait.php']],
            [__DIR__ . '/../Classes/EmptyFolder', []],
            [__DIR__ . '/../InvalidCatalog', null]
        ];
    }

    /**
     * @dataProvider getClassInfoProvider
     */
    public function testGetClassInfo($directory, $result)
    {
        $this->assertEquals($result, FileCrawler::getClassInfo($directory));
    }
    
    public function getClassInfoProvider()
    {
        return [
            [__DIR__ . '/../Classes/NewClass.php', ['\Tests\Classes\NewClass', T_CLASS]],
            [__DIR__ . '/../Classes/NewInterface.php', ['\Tests\Classes\NewInterface', T_INTERFACE]],
            [__DIR__ . '/../Classes/NewTrait.php', ['\Tests\Classes\NewTrait', T_TRAIT]]
        ];
    }
    
    /**
     * @dataProvider isDirectoryProvider
     */
    public function testIsDirectory($directory, $result)
    {
        $isDirectory = $this->makeCallable(FileCrawler::class, 'isDirectory');
        
        $this->assertEquals($result, $isDirectory->invokeArgs(null, [$directory]));
    }
    
    public function isDirectoryProvider()
    {
        return [
            [__DIR__ . '/../Classes', true],
            [__DIR__ . '/..', false],
            [__DIR__ . '/.', false],
            [__DIR__ . '/../Classes/NewTrait.php', false]
        ];
    }
    
    /**
     * @dataProvider isPhpFileProvider
     */
    public function testIsPhpFile($filename, $result)
    {
        $isPhpFile = $this->makeCallable(FileCrawler::class, 'isPhpFile');
        
        $this->assertEquals($result, $isPhpFile->invokeArgs(null, [$filename]));
    }
    
    public function isPhpFileProvider()
    {
        return [
            ['../Classes', false],
            ['../Classes/File.js', false],
            ['/..', false],
            ['/.', false],
            ['../Classes/NewTrait.php', true]
        ];
    }
}
