<?php
# -*- coding: utf-8 -*-

//
// scl_basic_u8string.php
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
	abstract class basic_encoding
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
	} /* EOC */

	class encoding extends basic_encoding
	{ /* NOP */ } /* EOC */

	abstract class basic_u8string extends basic_iteratable implements
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iteratable_tag::basic_u8string;

		use _T_x_langarray_container;
		use _T_x_langarray_int_operator;
		use _T_x_langarray_debug;
		use _T_x_langarray_serializable;
		use _T_x_langarray_iterative;
		use _T_x_langarray_iteratable;
		use _T_x_countable;

		function __toArray()
		{ return $this->_M_container; }

		function __toString()
		{ return @\implode('', $this->_M_container); }

		function to_array()
		{ return $this->__toArray(); }

		function to_string()
		{
			if ($this->_M_size) {
				return "\"" . @\implode('', $this->_M_container) . "\"";
			}
			return "\"\"";
		}
	} /* EOC */
} /* EONS */

/* EOF */