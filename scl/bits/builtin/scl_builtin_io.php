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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_builtin_str.php";
} /* EONS */

namespace std\io
{
	use \std\str as str;

	const stdin  = \STDIN;
	const stdout = \STDOUT;
	const stderr = \STDERR;

	function fopen(string $f___ , string $m___)
	{ return (($fp = \fopen($f___, $m___)) !== false) ? $fp : null; }
	
	function fclose(resource $ios___)
	{ return \fclose($ios___) === true ? 0 : -1; }

	function fflush(resource $ios___)
	{ return \fflush($ios___) === true ? 0 : -1; }

	function fwrite($in___, int $siz___, int $cnt___, resource $ios___)
	{
		$n = 0;
		if ($n = \fwrite($ios___, $in___, $siz___ * $cnt___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fputs($in___, resource $ios___)
	{
		$n = 0;
		if ($n = \fwrite($ios___, $in___) === false) {
			$n = -1;
		}
		return $n;
	}

	function puts($in___)
	{
		$n = 0;
		if ($n = \fwrite(\STDOUT, $in___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fread(&$buf___, int $siz___, int $cnt___, resource $ios___)
	{
		$n = 0;
		if ($buf___ = \fread($ios___, $siz___ * $cnt___) === false) {
			$buf___ = null;
			$n = -1;
		} else {
			$n = str\memlen($buf___);
		}
		return $n;
	}

	function & fgets(&$buf___, int $n___, resource $ios___)
	{
		if ($buf___ = \fgets($ios___, $n___) === false) {
			$buf___ = null;
		}
		return $buf___;
	}

	function fgetc(resource $ios___)
	{ return \ord(\fgetc($ios___)); }

	function ftell(resource $ios___)
	{ return \ftell($ios___); }

	function feof(resource $ios___) {
		return \feof($ios___) === true ? 1 : 0;
	}

	function cin(&$buf___)
	{ return (($buf___ = \fgets(\STDIN)) !== false) ? true : false; }

	function cout($in___)
	{ return (($n = \fwrite(\STDOUT, $in___)) !== false) ? $n : 0; }

	function cerr($in___)
	{ return (($n = \fwrite(\STDERR, $in___)) !== false) ? $n : 0; }

	function putc(int $ch___, $ios___)
	{
		if (\is_resource($ios___)) {
			\fwrite($ios___, \chr($ch___));
		} else {
			_F_throw_invalid_argument("Invalid stream error");
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