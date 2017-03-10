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
	class basic_forward_list extends basic_iteratable implements
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iteratable_tag::basic_forward_list;

		use _T_builtin_linked_list_container;
		use _T_builtin_linked_list_int_operator;
		use _T_builtin_linked_list_serializable;
		use _T_builtin_linked_list_debug;
		use _T_builtin_linked_list_iteratable;
		use _T_builtin_linked_list_iterative;
		use _T_builtin_countable;

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

		function to_array()
		{ return $this->__toArray(); }

		function to_string()
		{
			if ($this->_M_size) {
				return \json_encode(
					  $this->_F_dump()
					, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				);
			}
			return "[]";
		}
	}
} /* EONS */

/* EOF */