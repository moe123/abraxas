<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_forward_list.php
//
// Copyright (C) 2017-2019 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @author     Moe123 2019.
 * @maintainer Moe123 2019.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	class basic_forward_list extends basic_iterable implements
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iterable_tag::basic_forward_list;

		use _T_linkedlist_container;
		use _T_linkedlist_int_operator;
		use _T_linkedlist_serializable;
		use _T_linkedlist_debug;
		use _T_linkedlist_iterable;
		use _T_linkedlist_iterative;
		use _T_countable;

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