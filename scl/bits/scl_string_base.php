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

	function memize(&$in___)
	{
		if (\gettype($in___) !== 'array') {
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

	function & memset(&$dest___, int $c, int $n___)
	{
		memize($dest___);
		for ($i = 0; $i < $n___; $i++) {
			$dest___[$i] = \chr($c);
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
} /* EONS */

namespace std\utf8
{
	function glyph_len($c___)
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
	
	function glyph_offset($c___)
	{ return glyph_len(c) -1; }

	function is_valid(string $in___)
	{
		for ($i = 0 ; i < memlen($in___) ; $i++) {
			if (utf8_glyph_len($in___[$i]) === 0
			) {
				return false;
			}
		}
		return true;
	}
	
	function have_bom(string &$in___)
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
	
	function add_bom(string &$in___)
	{
		if (!have_bom($in___)) {
			$in___ = \chr(0xEF) . \chr(0xBB) . \chr(0xBF) . $in___;
		}
	}

	function del_bom(string &$in___)
	{
		if (have_bom($in___)) {
			$in___ = \std\memsub($in___, 3, \std\memlen($in___));
		}
	}
} /* EONS */

/* EOF */