<?php
# -*- coding: utf-8 -*-

//
// scl_basic_forward_list.php
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
	class basic_forward_list implements
		  \ArrayAccess
		/*
		, \IteratorAggregate
		*/
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iteratable_tag::basic_forward_list;

		use _T_builtin_linked_list_container_traits;
		use _T_builtin_linked_list_int_operator_traits;
		use _T_builtin_linked_list_serializable_traits;
		use _T_builtin_linked_list_debug_traits;
		use _T_builtin_countable_traits;

		function __toArray()
		{ return $this->_F_dump(); }

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
						  $this->_F_dump()
						, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				);
			}
			return "[]";
		}
	}
} /* EONS */

/* EOF */