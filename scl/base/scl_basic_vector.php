<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_vector.php
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

declare(strict_types=1);

namespace std
{
	abstract class basic_vector extends basic_iterable implements
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iterable_tag::basic_vector;

		use _T_langarray_container;
		use _T_langarray_int_operator;
		use _T_langarray_debug;
		use _T_langarray_serializable;
		use _T_langarray_iterative;
		use _T_langarray_iterable;
		use _T_countable;

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
			return "[]";
		}
	} /* EOC */
} /* EONS */
/* EOF */