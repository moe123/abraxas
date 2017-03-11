<?php
# -*- coding: utf-8 -*-

//
// scl_basic_dict.php
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
	abstract class basic_dict extends basic_iteratable implements 
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iteratable_tag::basic_dict;

		use _T_builtin_array_container;
		use _T_builtin_array_string_operator;
		use _T_builtin_array_debug;
		use _T_builtin_array_serializable;
		use _T_builtin_dict_iterative;
		use _T_builtin_dict_iteratable;
		use _T_builtin_countable;

		function __toArray()
		{ return $this->_M_container; }

		function __toString()
		{
			return get_class($this)
				. " Object"
				. PHP_EOL
				. $this->to_string()
				. PHP_EOL
			;
		}

		function to_array()
		{ return $this->__toArray(); }

		function to_string()
		{
			if ($this->_M_size) {
				return \json_encode(
					  $this->_M_container
					, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				);
			}
			return "{}";
		}
	} /* EOC */
} /* EONS */

/* EOF */