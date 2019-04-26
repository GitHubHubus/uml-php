<?php

namespace Tests\Parser;

use Tests\TestCase;
use OK\Uml\Parser\DocCommentParser;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class DocCommentParserTest extends TestCase
{
    /**
     * @dataProvider getReturnTypeProvider
     */
    public function testGetReturnType($comment, $result)
    {
        $this->assertEquals($result, DocCommentParser::getReturnType($comment));
    }
    
    public function getReturnTypeProvider()
    {
        return [
            ['/**
               * @return string
               */', 'string'],
            ['/**
               * @param string
               */', null],
            ['/**
               * @return int|null
               */', 'int|null'],
            ['/**
               *
               */', null],
            ['/**
               * @var int
               */', null],
        ];
    }
    
    /**
     * @dataProvider getVarTypeProvider
     */
    public function testGetVarType($comment, $result)
    {
        $this->assertEquals($result, DocCommentParser::getVarType($comment));
    }
    
    public function getVarTypeProvider()
    {
        return [
            ['/**
               * @var string
               */', 'string'],
            ['/**
               * @param string
               */', null],
            ['/**
               * @var int|null
               */', 'int|null'],
            ['/**
               *
               */', null],
            ['/**
               * @return int
               */', null],
        ];
    }
    
    /**
     * @dataProvider getArgumentsProvider
     */
    public function testGetArguments($comment, $result)
    {
        $this->assertEquals($result, DocCommentParser::getArguments($comment));
    }
    
    public function getArgumentsProvider()
    {
        return [
            ['/**
               * @var string
               */', []],
            ['/**
               * @param string
               * @param int
               */', [['string', null], ['int', null]]],
            ['/**
               * @param string $name
               * @param int $count
               */', [['string', '$name'], ['int', '$count']]],
            ['/**
               * @param $name
               * @param int $count
               */', [[null, '$name'], ['int', '$count']]],
            ['/**
               *
               */', []],
            ['/**
               * @return int
               */', []],
        ];
    }
}
