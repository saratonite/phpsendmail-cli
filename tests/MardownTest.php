<?php

use saratonite\phpsendmail\Parser\MarkdownParser;

class MarkdonTest extends PHPUnit_Framework_TestCase{

	protected $markdown;

	public function setUp(){

		$this->markdown = new MarkdownParser();

	}

	public function testParse(){

		$this->assertSame("<h1>Hello World</h1>\n",$this->markdown->parse('# Hello World'));
	}
}