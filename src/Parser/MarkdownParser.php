<?php

namespace saratonite\phpsendmail\Parser;

use \Michelf\Markdown;

class MarkdownParser implements ParserInterface {

	protected $html = null;



	public function parse($text){
		$this->html = Markdown::defaultTransform($text);
		return $this->html;
	}


	
}