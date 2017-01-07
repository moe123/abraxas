<?php
# -*- coding: utf-8 -*-

//
// scl_builtin_io.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */


namespace std\io
{
	function stdin(&$d___)
	{ return (($d___ = \fgets(\STDIN)) !== false) ? true : false; }

	function stdout($d___)
	{ return (\fwrite(\STDOUT, $d___) !== false) ? true : false; }

	function stderr($d___)
	{ return (\fwrite(\STDERR, $d___) !== false) ? true : false; }

	function putc(int $ch___, $os___)
	{
		if (\ is_resource($os___)) {
			return (\fwrite($os___, \chr($ch___)) !== false) ? true : false;
		} else if (\ is_callable($os___)) {
			$os___(\chr($ch___));
		}
	}

	function putchar(int $ch___)
	{ \fwrite(\STDOUT, \chr($ch___)); }

	function println(string $fmt___, ...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			array_unshift($args___, $fmt___);
			\fwrite(\STDOUT, \call_user_func_array('\sprintf', $args___));
			\fwrite(\STDOUT, \PHP_EOL);
		} else {
			\fwrite(\STDOUT, $fmt___);
			\fwrite(\STDOUT, \PHP_EOL);
		}
	}
} /* EONS */

/* EOF */