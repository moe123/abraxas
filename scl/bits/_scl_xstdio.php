<?php
# -*- coding: utf-8 -*-

//
// _scl_xstdio.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	const stdin    = \STDIN;
	const stdout   = \STDOUT;
	const stderr   = \STDERR;

	const seek_set = \SEEK_SET;
	const seek_end = \SEEK_END;
	const seek_cur = \SEEK_CUR;

	const lock_sh = \LOCK_SH;
	const lock_ex = \LOCK_EX;
	const lock_nb = \LOCK_NB;
	const lock_un = \LOCK_UN;

	function fopen(string $fname___ , string $m___)
	{ return (($fp = \fopen($fname___, $m___)) !== false) ? $fp : null; }

	function fclose($fp___)
	{ return \fclose($fp___) === true ? 0 : -1; }

	function fflush($fp___)
	{ return \fflush($fp___) === true ? 0 : -1; }

	function fseek($fp___, int $offset___, int $orig___)
	{ return \fseek($fp___, $offset___, $orig___); }

	function fwrite($in___, int $siz___, int $cnt___, $fp___)
	{
		$n = 0;
		if ($n = \fwrite($fp___, $in___, $siz___ * $cnt___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fputs($in___, $fp___)
	{
		$n = 0;
		if ($n = \fwrite($fp___, $in___) === false) {
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

	function fread(&$buf___, int $siz___, int $cnt___, $fp___)
	{
		$n = 0;
		if ($buf___ = \fread($fp___, $siz___ * $cnt___) === false) {
			$buf___ = null;
			$n = -1;
		} else {
			$n = memlen($buf___);
		}
		return $n;
	}

	function & fgets(&$buf___, int $n___, $fp___)
	{
		if ($buf___ = \fgets($fp___, $n___) === false) {
			$buf___ = null;
		}
		return $buf___;
	}

	function fgetc($fp___)
	{ return \ord(\fgetc($fp___)); }
	
	function fgetpos($fp___, int &$pos___)
	{
		if (false === ($pos___ = \ftell($fp___))) {
			$pos___ = -1;
			seterrno(EBADF);
			return -1;
		}
		return 0;
	}

	function fsetpos($fp___, int $pos___)
	{
		$r = \fseek($fp___, $pos___, \SEEK_CUR);
		if ($r != 0) {
			seterrno(EBADF);
		}
		return $r;
	}

	function rewind($fp___)
	{ \fseek($fp___, 0, \SEEK_SET); }

	function ftell($fp___)
	{
		if (false === ($r = \ftell($fp___))) {
			$r = -1;
			seterrno(EBADF);
		}
		return $r;
	}

	function feof($fp___)
	{ return \feof($fp___) === true ? 1 : 0;}

	function fputc(int $ch___, $fp___)
	{ return (\fwrite($fp___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function stdcin(&$buf___)
	{ return (($buf___ = \fgets(\STDIN)) !== false) ? true : false; }

	function stdcout($in___)
	{ return (($n = \fwrite(\STDOUT, $in___)) !== false) ? $n : -1; }

	function stdcerr($in___)
	{ return (($n = \fwrite(\STDERR, $in___)) !== false) ? $n : -1; }

	function stdcout_fmt($fmt___, ...$args___)
	{ return (($n = \fwrite(\STDOUT, \vsprintf($fmt___, $args___))) !== false) ? $n : -1; }

	function stdcerr_fmt($fmt___, ...$args___)
	{ return (($n = \fwrite(\STDERR, \vsprintf($fmt___, $args___))) !== false) ? $n : -1; }

	function putc(int $ch___, $fp___)
	{ return (\fwrite($fp___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function putchar(int $ch___)
	{ return (\fwrite(\STDOUT, \chr($ch___)) !== false) ? $ch___ : -1; }

	function println(string $fmt___, ...$args___)
	{ return \vfprintf(\STDOUT, $fmt___ . \PHP_EOL, $args___); }

	function fprintln($fp___, string $fmt___, ...$args___)
	{ return \vfprintf($fp___, $fmt___ . \PHP_EOL, $args___); }
	
	function sprintf(string &$dest___, string $fmt___, ...$args___)
	{
		if (false !== ($dest___ = \vsprintf($fmt___, $args___))) {
			return memlen($dest___);
		}
		$dest___ = null;
		return -1;
	}

	function vsprintf(string &$dest___, string $fmt___, $argv___)
	{
		if (false !== ($dest___ = \vsprintf($fmt___, $argv___))) {
			return memlen($dest___);
		}
		$dest___ = null;
		return -1;
	}

	function asprintf(string &$dest___, string $fmt___, ...$args___)
	{
		if (false !== ($dest___ = \vsprintf($fmt___, $args___))) {
			return memlen($dest___);
		}
		$dest___ = null;
		return -1;
	}

	function vasprintf(string &$dest___, string $fmt___, $argv___)
	{
		if (false !== ($dest___ = \vsprintf($fmt___, $argv___))) {
			return memlen($dest___);
		}
		$dest___ = null;
		return -1;
	}

	function printf(string $fmt___, ...$args___)
	{ return \vfprintf(\STDOUT, $fmt___, $args___); }

	function fprintf($fp___, string $fmt___, ...$args___)
	{ return \vfprintf($fp___, $fmt___, $args___); }

	function vfprint($fp___, string $fmt___, $argv___)
	{ return \vfprintf($fp___, $fmt___, $argv___); }

	function vfprintf($fp___, string $fmt___, $argv___)
	{ return \vfprintf($fp___, $fmt___, $argv___); }

	function vfprintln($fp___, string $fmt___, $argv___)
	{ return \vfprintf($fp___, $fmt___ . \PHP_EOL, $argv___); }

	function perror(string $errstr___)
	{ \fwrite(\STDERR, $errstr___); }

	function strerror(int $errno___)
	{
		if (isset($GLOBALS["^std@_g_strerror"][$errno___])) {
			return $GLOBALS["^std@_g_strerror"][$errno___];
		}
		return "";
	}

	function fflock($fp___, int $op___)
	{
		$e = 0;
		if (\flock($fp___, $op___, $e)) {
			return 0;
		}
		seterrno($e ? EWOULDBLOCK : EBADF);
		return -1;
	}

	function flockfile($fp___)
	{ \flock($fp___, \LOCK_EX); }

	function ftrylockfile($fp___)
	{
		$e = 0;
		if (\flock($fp___, \LOCK_EX|\LOCK_NB, $e)) {
			return 0;
		}
		seterrno($e ? EWOULDBLOCK : EBADF);
		return -1;
	}

	function funlockfile($fp___)
	{ \flock($fp___, \LOCK_UN); }

	function popen(string $cmd___ , string $m___)
	{ return (($fp = \popen($cmd___, $m___)) !== false) ? $fp : null; }

	function pclose($fp___)
	{
		if ($r = \pclose($fp___) != -1) {
			return $r;
		}
		seterrno(EBADF);
		return -1;
	}
} /* EONS */

/* EOF */