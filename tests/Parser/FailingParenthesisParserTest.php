<?php

namespace Shunt\Parser;

use Shunt\Parser;

class FailingParenthesisParserTest extends \PHPUnit_Framework_TestCase
{
	
    public function testParenthesisThrowsError()
    {
		$this->expectOutputString(null);
        $equation = '()';
		return Parser::parse($equation);
    }

}
