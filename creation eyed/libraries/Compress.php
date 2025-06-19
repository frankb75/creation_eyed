<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compress
{
	function sanitize($buffer)
	{
		$search = array(
			'/\n/',									// replace end of line by a space
			'/\>[^\S ]+/s',							// strip whitespaces after tags, except space
			'/[^\S ]+\</s',							// strip whitespaces before tags, except space
			'/(\s)+/s',								// shorten multiple whitespace sequences
			'/\s*(?!<\")\/\*[^\*]+\*\/(?!\")\s*/'	// removed css comment.
		);

		$replace = array(
			' ',
			'>',
			'<',
			'\\1',
			''
		);

		$buffer = preg_replace($search, $replace, $buffer);

		return $buffer;
	}
}