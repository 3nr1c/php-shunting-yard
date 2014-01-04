<?php

namespace tests\Parser;

use RR\Shunt\Parser;
use RR\Shunt\Context;


class FunctionParserTest extends \PHPUnit_Framework_TestCase
{

    public function testFunctionCallWithOneParam()
    {
        $context = new Context();
        $context->def(
            'myfunc',
            function ($param1) {
                return $param1;
            }
        );

        $equation = '12 + myfunc(100) * 2';
        $actual = Parser::parse($equation, $context);

        $expected = 212;
        $this->assertEquals($expected, $actual);
    }

    public function testFunctionCallWithTwoParams()
    {
        $context = new Context();
        $context->def(
            'myfunc',
            function ($param1, $param2) {
                return ($param1 + $param2);
            }
        );

        $equation = '12+myfunc(100,50)*2';
        $actual = Parser::parse($equation, $context);

        $expected = 312;
        $this->assertEquals($expected, $actual);
    }

    public function testFunctionCallWithDefaultParamValue()
    {
        $context = new Context();
        $context->def(
            'myfunc',
            function ($param1, $param2 = 33) {
                return ($param1 + $param2);
            }
        );

        $equation = '12+myfunc(100)*2';
        $actual = Parser::parse($equation, $context);

        $expected = 278;
        $this->assertEquals($expected, $actual);

        $equation = '12+myfunc(100,44)*2';
        $actual = Parser::parse($equation, $context);

        $expected = 300;
        $this->assertEquals($expected, $actual);
    }

    public function testWrapPHPFunction()
    {
        $context = new Context();
        $context->def('abs');

        $equation = 'abs(100)';
        $actual = Parser::parse($equation, $context);

        $expected = 100;
        $this->assertEquals($expected, $actual);

        $equation = 'abs(-100)';
        $actual = Parser::parse($equation, $context);

        $expected = 100;
        $this->assertEquals($expected, $actual);
    }

}
