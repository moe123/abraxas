<?php
# -*- coding: utf-8 -*-

//
// scl_pair.php
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
	final class pair
	{
		use _T_multi_construct_traits;

		var $first  = null;
		var $second = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function pair_1(pair &$pair)
		{
			$this->first = $pair->first;
			$this->second = $pair->second;
		}

		function pair_2($first, $second)
		{
			$this->first = $first;
			$this->second = $second;
		}

		function & swap(pair &$pair)
		{
			$first = $this->first;
			$second = $this->second;

			$this->first = $pair->first;
			$this->second = $pair->second;

			$pair->first = $first;
			$pair->second = $second;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */