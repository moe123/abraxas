<?php
# -*- coding: utf-8 -*-

//
// scl_u8string.php
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
	abstract class encoding
	{
		const auto       = 0;
		const utf8       = 1;
		const utf32      = 2;
		const utf32_be   = 3;
		const utf32_le   = 4;
		const utf16      = 5;
		const utf16_be   = 6;
		const utf16_le   = 7;
		const iso8859_1  = 8;
		const iso8859_2  = 9;
		const iso8859_3  = 10;
		const iso8859_4  = 11;
		const iso8859_5  = 12;
		const iso8859_6  = 13;
		const iso8859_7  = 14;
		const iso8859_8  = 15;
		const iso8859_9  = 16;
		const iso8859_10 = 17;
		const iso8859_13 = 18;
		const iso8859_14 = 19;
		const iso8859_15 = 20;
		const iso8859_16 = 21;

		const table = [
			, "auto"
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
	} /* EOC */

	final class u8string extends basic_u8string
	{
		use _T_multi_construct_traits;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function _F_u8string_1(u8string &$u8str)
		{
			$this->_M_container = $u8str->_M_container;
			$this->_M_size      = $u8str->_M_len;
		}

		function _F_u8string_2(string $str, int $encoding)
		{
			$this->_M_container = utf8_glyph_split($str);
			$this->_M_size      = \count($this->_M_container);
		}

		function & assign(u8string &$u8str)
		{
			$this->_M_container = $u8str->_M_container;
			$this->_M_size      = $u8str->_M_size;
			return $this;
		}

		function & assign_str(string $str, int $encoding = encoding::utf8)
		{
			$this->_M_container = utf8_glyph_split($str);
			$this->_M_size      = \count($this->_M_container);
			return $this;
		}

		function & substring(int $pos, int $len)
		{
			$u8str = new u8string;
			$u8str->_M_container = \array_slice(
				  $this->_M_container
				, $pos
				, $len < 1 ? null : $len
			);
			$u8str->_M_size = \count($this->_M_data);
			return $u8str;
		}

		function & append(u8string &$u8str)
		{
			$this->_M_container += $u8str->_M_container;
			$this->_M_size      += $u8str->_M_size;
			return $this;
		}

		function & append_str(string $str, int $encoding = encoding::utf8)
		{
			$s = utf8_glyph_split($str);
			$this->_M_container += $s;
			$this->_M_size      += \count($s);
			return $this;
		}

		function & prepend(u8string &$u8str)
		{
			$this->_M_container = $u8str->_M_container + $this->_M_container;
			$this->_M_size     += $u8str->_M_size;
			return $this;
		}

		function & prepend_str(string $str, int $encoding = encoding::utf8)
		{
			$s = utf8_glyph_split($str);
			$this->_M_container = $s + $this->_M_container;
			$this->_M_size     += \count($s);
			return $this;
		}

		function bom()
		{ return \chr(0xEF) . \chr(0xBB) . \chr(0xBF); }

		function size()
		{ return $this->_M_size; }

		function & swap(u8string &$u8str)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $u8str->_M_container;
			$this->_M_size = $u8str->_M_size;

			$u8str->_M_container = $c;
			$u8str->_M_size = $sz;

			return $this;
		}
	}
} /* EONS */

/* EOF */