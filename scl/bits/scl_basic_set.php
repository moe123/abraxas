<?php
# -*- coding: utf-8 -*-

//
// scl_basic_set.php
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
	abstract class basic_set extends basic_iteratable implements
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iteratable_tag::basic_set;

		use _T_builtin_array_container_traits;
		use _T_builtin_array_int_operator_unique_traits;
		use _T_builtin_mapreduce_traits;
		use _T_builtin_array_debug_traits;
		use _T_builtin_array_serializable_traits;
		use _T_builtin_array_conformity_traits;
		use _T_builtin_array_iterative_traits;
		use _T_builtin_array_iteratable_traits;
		use _T_builtin_countable_traits;

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

		function copy()
		{ return clone $this; }

		function to_array()
		{ return $this->__toArray(); }

		function to_string()
		{
			if ($this->_M_size) {
				return @json_encode(
						  $this->_M_container
						, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				);
			}
			return "[]";
		}
	} /* EOC */
} /* EONS */

/* EOF */