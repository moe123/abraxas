<?php
# -*- coding: utf-8 -*-

//
// scl_string_base.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_utility.php";
} /* EONS */

namespace std
{
	abstract class char_utils
	{
		const eol = \PHP_EOL;

		const vt = "\v";
		const ff = "\f";
		const ht = "\t";
		const lf = "\n";
		const cr = "\r";
		const crlf = "\r\n";
		const lfcr = "\n\r";
		
		static function to_int($c___)
		{ return \ord($c___); }
		
		static function to_char($i___)
		{ return \chr($i___); }
	}
} /* EONS */

/* EOF */