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
	const stdin  = \STDIN;
	const stdout = \STDOUT;
	const stderr = \STDERR;

	const seek_set     = \SEEK_SET;
	const seek_end     = \SEEK_END;
	const seek_cur     = \SEEK_CUR;

	function fopen(string $f___ , string $m___)
	{ return (($fp = \fopen($f___, $m___)) !== false) ? $fp : null; }

	function fclose($h___)
	{ return \fclose($h___) === true ? 0 : -1; }

	function fflush($h___)
	{ return \fflush($h___) === true ? 0 : -1; }

	function fseek($h___, int $offset___, int $orig___)
	{ return \fseek($h___, $offset___, $orig___); }

	function fwrite($in___, int $siz___, int $cnt___, $h___)
	{
		$n = 0;
		if ($n = \fwrite($h___, $in___, $siz___ * $cnt___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fputs($in___, $h___)
	{
		$n = 0;
		if ($n = \fwrite($h___, $in___) === false) {
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

	function fread(&$buf___, int $siz___, int $cnt___, $h___)
	{
		$n = 0;
		if ($buf___ = \fread($h___, $siz___ * $cnt___) === false) {
			$buf___ = null;
			$n = -1;
		} else {
			$n = \std\str\memlen($buf___);
		}
		return $n;
	}

	function & fgets(&$buf___, int $n___, $h___)
	{
		if ($buf___ = \fgets($h___, $n___) === false) {
			$buf___ = null;
		}
		return $buf___;
	}

	function fgetc($h___)
	{ return \ord(\fgetc($h___)); }

	function ftell($h___)
	{ return \ftell($h___); }

	function feof($h___)
	{ return \feof($h___) === true ? 1 : 0;}

	function fputc(int $ch___, $h___)
	{ return (\fwrite($h___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function cin(&$buf___)
	{ return (($buf___ = \fgets(\STDIN)) !== false) ? true : false; }

	function cout($in___)
	{ return (($n = \fwrite(\STDOUT, $in___)) !== false) ? $n : -1; }

	function cerr($in___)
	{ return (($n = \fwrite(\STDERR, $in___)) !== false) ? $n : -1; }

	function putc(int $ch___, $h___)
	{ return (\fwrite($h___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function putchar(int $ch___)
	{ return (\fwrite(\STDOUT, \chr($ch___)) !== false) ? $ch___ : -1; }

	function println(string $fmt___, ...$args___)
	{ \vfprintf(\STDOUT, $fmt___ . \PHP_EOL, $args___); }

	function fprintln($h___, string $fmt___, ...$args___)
	{ \vfprintf($h___, $fmt___ . \PHP_EOL, $args___); }

	function printf($h___, string $fmt___, ...$args___)
	{ \vfprintf(\STDOUT, $fmt___, $args___); }

	function fprintf($h___, string $fmt___, ...$args___)
	{ \vfprintf($h___, $fmt___, $args___); }

	function vfprint($h___, string $fmt___, $args___)
	{ \vfprintf($h___, $fmt___, $args___); }

	function vfprintf($h___, string $fmt___, $args___)
	{ \vfprintf($h___, $fmt___, $args___); }

	function vfprintln($h___, string $fmt___, $args___)
	{ \vfprintf($h___, $fmt___ . \PHP_EOL, $args___); }
} /* EONS */

/* EOF */