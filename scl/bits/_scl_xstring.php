<?php
# -*- coding: utf-8 -*-

//
// _scl_xstring.php
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
	{
		return xformat_message($fmt___, ...$args___);
		/*
		$fmt___ = preg_replace_callback('#\{(?!\{)\}(?!\})#', function($r) {
			static $idx = 0;
			return '{'.($idx++).'}';
		}, $fmt___);

		return \str_replace(
			array_map(
				function (&$k) { return '{'.$k.'}'; }
				, array_keys($args___)
			)
			, array_map(
				function ($v_) {
					if (\is_float($v_)) {
						$numfmt = \numfmt_create(\setlocale(\LC_NUMERIC, ""), \NumberFormatter::DECIMAL);
						\numfmt_set_attribute($numfmt, \NumberFormatter::MAX_FRACTION_DIGITS, 20);
						if (false !== ($r = \numfmt_format($numfmt, $v_))) {
							return $r;
						}
					} if (\is_object($v_)) {
						return (string)$v_;
					}
					return $v_;
				}
				, array_values($args___)
			)
			, $fmt___
		);
		*/
	}

	function xformat_l(locale_t $xloc__, string $fmt___, ...$args___)
	{
		return xformat_message_l($xloc__, $fmt___, ...$args___);

		/*
		$fmt___ = preg_replace_callback('#\{(?!\{)\}(?!\})#', function($r) {
			static $idx = 0;
			return '{'.($idx++).'}';
		}, $fmt___);

		return \str_replace(
			array_map(
				function (&$k) { return '{'.$k.'}'; }
				, array_keys($args___)
			)
			, array_map(
				function ($v_) {
					if (\is_float($v_)) {
						$numfmt = \numfmt_create($xloc___->u_data[0]["^std@_u_nid"], \NumberFormatter::DECIMAL);
						\numfmt_set_attribute($numfmt, \NumberFormatter::MAX_FRACTION_DIGITS, 20);
						if (false !== ($r = \numfmt_format($numfmt, $v_))) {
							return $r;
						}
					} if (\is_object($v_)) {
						return (string)$v_;
					}
					return $v_;
				}
				, array_values($args___)
			)
			, $fmt___
		);
		*/
	}

	function xformatln(string $fmt___, ...$args___)
	{ return xformat_message($fmt___ . \PHP_EOL, ...$args___); }

	function xformatln_l(locale_t $xloc__, string $fmt___, ...$args___)
	{ return xformat_message_l($xloc__, $fmt___ . \PHP_EOL, ...$args___); }

	function xformat_message($fmt___, ...$args___)
	{ return \msgfmt_format_message(\setlocale(\LC_ALL, ""), $fmt___, $args___); }

	function xformat_message_l(locale_t $xloc__, $fmt___, ...$args___)
	{ return \msgfmt_format_message($xloc___->u_data[0]["^std@_u_nid"], $fmt___, $args___); }

	function memize(&$in___)
	{
		if (\gettype($in___) != 'array') {
			\settype($in___, 'string');
			$i = 0;
			while (isset($in___[$i])) { ++$i; }
			if (!$i) {
				$in___ = "_";
			}
		}
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

	function strtol(string $str, &$endptr = null, int $base = 10)
	{
		if ($base > 36 || $base < 2) {
			return 0;
		}
		$r = \intval($str, $base);
		if (!\is_null($endptr)) {
			if (false !== ($span = \strpos($str, (string)\abs($r)))) {
				$span += \strlen((string)\abs($r));
				$endptr = \substr($str, $span, \strlen($str) - $span);
			}
		}
		return $r;
	}

	function strtoul(string $str, &$endptr = null, int $base = 10)
	{
		$r = strtol($str, $endptr, $base);
		return $r >= 0 ? $r : numeric_limit::max;
	}

	function strtod(string $str, &$endptr = null)
	{
		if ($base > 36 || $base < 2) {
			return 0;
		}
		$r = \floatval($str);
		if (!\is_null($endptr)) {
			if (false !== ($span = \strpos($str, (string)\abs($r)))) {
				$span += \strlen((string)\abs($r));
				$endptr = \substr($str, $span, \strlen($str) - $span);
			}
		}
		return $r;
	}

	function strcoll(string $s1___, string $s2___)
	{ return \strcoll($s1___, $s2___); }

	function strcoll_l(string $s1___, string $s2___, locale_t $xloc___)	
	{
		uselocale($xloc);
		$r = \strcoll($s1___, $s2___);
		_F_builtin_unsetlocale($xloc___);
		return $r;
	}

	function utf8_glyph_len($c___)
	{
		$cp = \ord($c___);
		if ($cp < 0x80) { return 1; }
		else if (($cp & 0xE0) == 0xC0) { return 2; }
		else if (($cp & 0xF0) == 0xE0) { return 3; }
		else if (($cp & 0xF8) == 0xF0) { return 4; }
		else if (($cp & 0xFC) == 0xF8) { return 5; }
		else if (($cp & 0xFE) == 0xFC) { return 6; }
		_F_throw_builtin_error("Invalid UTF-8 codepoint");
		return 0;
	}

	function utf8_glyph_offset($c___)
	{ return utf8_glyph_len(c) -1; }

	function utf8_is_valid(string $in___)
	{
		for ($i = 0 ; i < memlen($in___) ; $i++) {
			if (utf8_glyph_len($in___[$i]) === 0) {
				return false;
			}
		}
		return true;
	}

	function utf8_have_bom(string &$in___)
	{
		$r = false;
		if (isset($in___[2])) {
			$b1 = \ord($in___[0]);
			$b2 = \ord($in___[1]);
			$b3 = \ord($in___[2]);
			if ($b1 == 0xEF && $b2 == 0xBB && $b3 == 0xBF) {
				$r = true;
			}
		}
		return $r;
	}

	function utf8_add_bom(string &$in___)
	{
		if (!utf8_have_bom($in___)) {
			$in___ = \chr(0xEF) . \chr(0xBB) . \chr(0xBF) . $in___;
		}
	}

	function utf8_del_bom(string &$in___)
	{
		if (utf8_have_bom($in___)) {
			$in___ = memsub($in___, 3, memlen($in___));
		}
	}

	function utf8_glyph_split(string $s___, int $l___ = 1)
	{
		$out = [];
		preg_match_all("/./u", $s___, $out);
		$arr = array_chunk($out[0], $l___);
		$out = array_map('implode', $out);
		return $out;
	}
} /* EONS */

/* EOF */