<?php
# -*- coding: utf-8 -*-

//
// xstring.php
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
	function xformat(string $fmt___, ...$args___)
	{ return xformat_message($fmt___, ...$args___); }

	function xformat_l(locale_t $xloc___, string $fmt___, ...$args___)
	{ return xformat_message_l($xloc___, $fmt___, ...$args___); }

	function xformatln(string $fmt___, ...$args___)
	{ return xformat_message($fmt___ . \PHP_EOL, ...$args___); }

	function xformatln_l(locale_t $xloc___, string $fmt___, ...$args___)
	{ return xformat_message_l($xloc___, $fmt___ . \PHP_EOL, ...$args___); }

	function xformat_message($fmt___, ...$args___)
	{ return \msgfmt_format_message(\setlocale(\LC_ALL, ""), $fmt___, $args___); }

	function xformat_message_l(locale_t $xloc___, $fmt___, ...$args___)
	{ return \msgfmt_format_message($xloc___->u_data[0]["^std@_u_nid"], $fmt___, $args___); }

	function memize(&$in___)
	{
		if (\gettype($in___) != 'array') {
			\settype($in___, 'string');
			$i = 0;
			while (isset($in___[$i])) { ++$i; }
			if (!$i) {
				$in___ = \chr(0);
			}
		}
	}

	function & bzero(&$dest___, int $n___)
	{
		memize($dest___);
		for ($i = 0; $i < $n___; $i++) {
			$dest___[$i] = \chr(0);
		}
		return $dest___;
	}

	function & memcpy_r(&$dest___, $src___, int $offset___, int $n___)
	{
		memize($dest___);
		memize($src___);
		for ($i = $offset___; $i < $n___ + $offset___; $i++) {
			$dest___[$i - $offset___] = $src___[$i];
		}
	}

	function & memcpy(&$dest___, $src___, int $n___)
	{
		memize($dest___);
		memize($src___);
		for ($i = 0; $i < $n___; $i++) {
			$dest___[$i] = $src___[$i];
		}
		return $dest___;
	}

	function & memset(&$dest___, int $c___, int $n___)
	{
		memize($dest___);
		for ($i = 0; $i < $n___; $i++) {
			$dest___[$i] = \chr($c___);
		}
		return $dest___;
	}

	function memsub($src___, int $offset___, int $n___)
	{
		$dest;
		memize($dest);
		memize($src___);
		for ($i = $offset___; $i < $n___; $i++) {
			$dest[$i - $offset___] = $src___[$i];
		}
		return $dest;
	}

	function memlen(&$in___)
	{
		$i = 0;
		while (isset($in___[$i])) {
			++$i;
		}
		return $i;
	}

	function strlen(string $s___, int $nullch___ = 0)
	{
		if (!$nullch___) {
			$i = 0;
			while (isset($s___[$i]) && $s___[$i] !== \chr(0)) {
				++$i;
			}
			return $i;
		}
		if (\function_exists('\mb_strlen')) {
			return \mb_strlen($s___, '8bit');
		}
		return \strlen($s___);
	}

	function & strncpy(string &$dest___, string $src___, int $n___)
	{
		$dest___ = memsub($src___, 0, $n___) . memsub($dest___, $n___, memlen($dest___));
		return $dest___;
	}

	function & strcpy(string &$dest___, string $src___)
	{
		$dest___ = memsub($src___, 0, memlen($src___));
		return $dest___;
	}

	function & strcat(string &$s1___, string $s2___)
	{
		$s1___ .= $s2___;
		return $s1___;
	}

	function & strncat(string &$s1___, string $s2___, int $n___)
	{
		for ($i = 0; $i < $n___; $i++) {
			$s1___ .= $s2___[$i];
		}
		return $s1___;
	}

	function strtol(string $str___, &$endptr___ = null, int $base___ = 10)
	{
		if ($base___ > 36 || $base___ < 2) {
			return 0;
		}
		$r = \intval($str___, $base___);
		if (!\is_null($endptr___)) {
			if (false !== ($span = \strpos($str___, \strval(\abs($r))))) {
				$span += \strlen(\strval(\abs($r)));
				$endptr___ = \substr($str___, $span, \strlen($str___) - $span);
			}
		}
		return $r;
	}

	function strtoul(string $str___, &$endptr___ = null, int $base___ = 10)
	{
		$r = strtol($str___, $endptr___, $base___);
		return $r >= 0 ? $r : numeric_limit::max;
	}

	function strtod(string $str___, &$endptr___ = null)
	{
		if ($base___ > 36 || $base___ < 2) {
			return 0;
		}
		$r = \floatval($str___);
		if (!\is_null($endptr___)) {
			if (false !== ($span = \strpos($str___, \strval(\abs($r))))) {
				$span += \strlen(\strval(\abs($r)));
				$endptr___ = \substr($str___, $span, \strlen($str___) - $span);
			}
		}
		return $r;
	}

	function strcoll(string $s1___, string $s2___)
	{ return \strcoll($s1___, $s2___); }

	function strcoll_l(string $s1___, string $s2___, locale_t $xloc___)	
	{
		uselocale($xloc___);
		$r = \strcoll($s1___, $s2___);
		_X_unsetlocale($xloc___);
		return $r;
	}
} /* EONS */

/* EOF */