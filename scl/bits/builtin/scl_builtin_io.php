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
	const stdin  = \STDIN;
	const stdout = \STDOUT;
	const stderr = \STDERR;

	function fwrite($d___, int $siz___, int $cnt___, $os___)
	{
		$n = 0;
		if (\ is_resource($os___)) {
			if ($n = \fwrite($os___, $d___, $siz___ * $cnt___) === false) {
				$n = 0;
			}
		}
		return $n;
	}

	function cin(&$d___)
	{ return (($d___ = \fgets(\STDIN)) !== false) ? true : false; }

	function cout($d___)
	{ return (($n = \fwrite(\STDOUT, $d___)) !== false) ? $n : 0; }

	function cerr($d___)
	{ return (($n = \fwrite(\STDERR, $d___)) !== false) ? $n : 0; }

	function putc(int $ch___, $os___)
	{
		if (\ is_resource($os___)) {
			\fwrite($os___, \chr($ch___));
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

namespace
{
	std\io\fwrite("34\n", 1, 3, std\io\stdout);
}

/* EOF */