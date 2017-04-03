<?php
# -*- coding: utf-8 -*-

//
// scl_api_string.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	const _N_encodingtab = [
		  "auto"
		, "UTF-8"
		, "UTF-32"
		, "UTF-32BE"
		, "UTF-32LE"
		, "UTF-16"
		, "UTF-16BE"
		, "UTF-16LE"
		, "ISO-8859-1"
		, "ISO-8859-2"
		, "ISO-8859-3"
		, "ISO-8859-4"
		, "ISO-8859-5"
		, "ISO-8859-6"
		, "ISO-8859-7"
		, "ISO-8859-8"
		, "ISO-8859-9"
		, "ISO-8859-10"
		, "ISO-8859-13"
		, "ISO-8859-14"
		, "ISO-8859-15"
		, "ISO-8859-16"
	];

	function _F_u8gh_len($c___)
	{
		$cp = \ord($c___);
		if ($cp < 0x80) { return 1; }
		else if (($cp & 0xE0) == 0xC0) { return 2; }
		else if (($cp & 0xF0) == 0xE0) { return 3; }
		else if (($cp & 0xF8) == 0xF0) { return 4; }
		else if (($cp & 0xFC) == 0xF8) { return 5; }
		else if (($cp & 0xFE) == 0xFC) { return 6; }
		_F_throw_error("Invalid UTF-8 codepoint");
		return 0;
	}

	function _F_u8gh_offset($c___)
	{ return _F_u8gh_len(c) -1; }

	function _F_u8gh_is_valid(string &$s___)
	{
		for ($i = 0 ; i < memlen($s___) ; $i++) {
			if (_F_u8gh_len($s___[$i]) === 0) {
				return false;
			}
		}
		return true;
	}

	function _F_u8gh_pos(string $s1___, string $s2___, int $pos = 0)
	{
		if (false === ($found = \mb_strpos($s1___, $s2___, $pos, "UTF-8"))) {
			$found = -1;
		}
		return $found;
	}

	function _F_u8gh_ipos(string $s1___, string $s2___, int $pos = 0)
	{
		if (false === ($found = \mb_stripos($s1___, $s2___, $pos, "UTF-8"))) {
			$found = -1;
		}
		return $found;
	}

	function _F_u8gh_coll(string $s1___, string $s2___, locale_t $xloc___ = null)
	{
		if (\is_null($xloc___)) {
			return strcoll($s1___, $s2___);
		}
		return strcoll_l($s1___, $s2___, $xloc___);
	}

	function _F_u8gh_have_bom(string &$s___)
	{
		$r = false;
		if (isset($s___[2])) {
			$b1 = \ord($s___[0]);
			$b2 = \ord($s___[1]);
			$b3 = \ord($s___[2]);
			if ($b1 == 0xEF && $b2 == 0xBB && $b3 == 0xBF) {
				$r = true;
			}
		}
		return $r;
	}

	function _F_u8gh_get_bom()
	{ return \chr(0xEF) . \chr(0xBB) . \chr(0xBF); }

	function _F_u8gh_add_bom(string &$s___)
	{
		if (!_F_u8gh_have_bom($s___)) {
			$s___ = _F_u8gh_get_bom() . $s___;
		}
	}

	function _F_u8gh_del_bom(string &$s___)
	{
		if (_F_u8gh_have_bom($s___)) {
			$s___ = memsub($s___, 3, memlen($s___));
		}
	}

	function _F_u8gh_guess(string $s___)
	{
		if (false !== ($enc = \mb_detect_encoding($s___, "auto"))) {
			return \array_search($enc, _N_encodingtab[$enc]);
		}
		return -1;
	}

	function _F_u8gh_is_utf8(string $s___)
	{  return _F_u8gh_guess($s___) == 1; }

	function _F_u8gh_check(string $s___, int $enc___)
	{  return _F_u8gh_guess($s___) == $enc___; }

	function _F_u8gh_convert(string $s___, int $enc___)
	{ return \mb_convert_encoding($s___, "UTF-8", _N_encodingtab[$enc___]); }

	function _F_u8gh_count(string $s___)
	{
		$out = [];
		@\preg_match_all("/./u", $s___, $out);
		return \count($out[0]);
	}

	function _F_u8gh_split(string $s___, int &$cnt___, int $l___ = 1)
	{
		if ($l___ > 1) {
			$out = [];
			@\preg_match_all("/./u", $s___, $out);
			$arr = \array_chunk($out[0], $l___);
			$out = \array_map('\implode', $arr);
			$cnt = \count($out);
			return $out;
		}
		$out = @\preg_split("//u", $s___, -1, PREG_SPLIT_NO_EMPTY);
		$cnt___ = \count($out);
		return $out;
	}

	function _F_u8gh_subv(string $s___, int $pos___, int $len___ = -1)
	{
		$out = [];
		@\preg_match_all("/./u", $s___, $out);
		return \array_slice($out[0], $pos___, $len___ < 1 ? null : $len___);
	}

	function _F_u8gh_substr(string $s___, int $pos___, int $len___ = -1)
	{ return @\implode('', _F_u8gh_subv($s___, $pos___, $len___)); }

	function _F_u8gh_cmp(string $s1___, string $s2___, $cmp___ = null)
	{
		if (\is_null($loc___)) {
			return \strcmp($s1___, $s2___);
		}
		return $cmp___($s1___, $s2___);
	}

	function _F_u8gh_substr_cmp(
		  string $s1___
		, string $s2___
		, int $pos___ = 0
		, int $len___ = -1
		, $cmp___ = null
	) {
		if (\is_null($cmp___)) {
			if ($len___ < 1) {
				return \substr_compare($s1___, $s2___, $pos___);
			}
			return \substr_compare($s1___, $s2___, $pos___, $len___);
		}
		$s1 = _F_u8gh_substr($s1___, $pos___, $len___);
		$s2 = _F_u8gh_substr($s2___, $pos___, $len___);
		return $cmp___($s1, $s2);
	}

	function _F_u8_find(basic_u8string &$s1___, basic_u8string &$s2___, int $pos = 0)
	{ return _F_u8gh_pos(\strval($s1___), \strval($s2___), $pos); }

	function _F_u8_rfind(basic_u8string &$s1___, basic_u8string &$s2___, int $pos = 0)
	{ return _F_u8gh_ipos(\strval($s1___), \strval($s2___), $pos); }

	function _F_u8_cmp(basic_u8string &$s1___, basic_u8string &$s2___, callable $cmp___ = null)
	{
		if (\is_null($loc___)) {
			return \strcmp(\strval($s1___), \strval($s2___));
		}
		return $cmp___($s1___, $s2___);
	}

	function _F_u8_substr_cmp(
		  basic_u8string &$s1___
		, basic_u8string &$s2___
		, int $pos___ = 0
		, int $len___ = -1
		, callable $cmp___ = null
	) {
		if ($pos___ == 0 && $len___ < 1) {
			return _F_u8_cmp($s1___, $s2___, $cmp___);
		}
		if (\is_null($cmp___)) {
			if ($len___ == numeric_limits_int::max) {
				return \substr_compare(\strval($s1___), \strval($s2___), $pos___);
			}
			return \substr_compare(\strval($s1___), \strval($s2___), $pos___, $len___);
		}
		$s1 = _F_u8gh_substr(\strval($s1___), $pos___, $len___);
		$s2 = _F_u8gh_substr(\strval($s2___), $pos___, $len___);
		return $cmp___($s1, $s2);
	}

	function _F_u8gh_to_u16(string $s___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo === endian_utils::little ? "UTF-16LE" : "UTF-16BE")
			, "UTF-8"
		);
	}

	function _F_u8gh_to_u32(string $s___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo === endian_utils::little ? "UTF-32LE" : "UTF-32BE")
			, "UTF-8"
		);
	}

	function _F_u16gh_convert(string $s___, int $enc___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo ? "UTF-16LE" : "UTF-16BE")
			, _N_encodingtab[$enc___]
		);
	}

	function _F_u32gh_convert(string $s___, int $enc___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo ? "UTF-32LE" : "UTF-32BE")
			, _N_encodingtab[$enc___]
		);
	}

	function _F_format(string $fmt___, ...$args___)
	{ return _F_format_message($fmt___, ...$args___); }

	function _F_format_l(locale_t $xloc___, string $fmt___, ...$args___)
	{ return _F_format_message_l($xloc___, $fmt___, ...$args___); }

	function _F_formatln(string $fmt___, ...$args___)
	{ return _F_format_message($fmt___ . \PHP_EOL, ...$args___); }

	function _F_formatln_l(locale_t $xloc___, string $fmt___, ...$args___)
	{ return _F_format_message_l($xloc___, $fmt___ . \PHP_EOL, ...$args___); }

	function _F_format_message($fmt___, ...$args___)
	{ return \msgfmt_format_message(\setlocale(\LC_ALL, ""), $fmt___, $args___); }

	function _F_format_message_l(locale_t $xloc___, $fmt___, ...$args___)
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

	function & memccpy(&$dest___, $src___, int $c___, int $n___)
	{
		memize($dest___);
		memize($src___);
		for ($i = 0; $i < $n___; $i++) {
			if ($src___[$i] == pack_uint8($c___)) {
				break;
			}
			$dest___[$i] = $src___[$i];
		}
		return $dest___;
	}

	function & memset(&$dest___, int $c___, int $n___)
	{
		memize($dest___);
		for ($i = 0; $i < $n___; $i++) {
			$dest___[$i] = pack_uint8($c___);
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

	function memchr(&$src___, int $c___, int $n___)
	{
		for ($i = 0; $i < $n___; $i++) {
			if ($src___[$i] == pack_uint8($c___)) {
				return $src___[$i];
			}
		}
		return null;
	}

	function rawmemchr(&$src___, int $c___)
	{
		$i = 0;
		while (isset($src___[$i])) {
			if ($src___[$i] == pack_uint8($c___)) {
				return $src___[$i];
			}
			++$i;
		}
		return null;
	}

	function memrchr(&$src___, int $c___, int $n___)
	{
		for ($i = ($n___ - 1); $i >= 0; $i--) {
			if ($src___[$i] == pack_uint8($c___)) {
				return $src___[$i];
			}
		}
		return null;
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
		_F_unsetlocale($xloc___);
		return $r;
	}
} /* EONS */

/* EOF */