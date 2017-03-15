<?php
# -*- coding: utf-8 -*-

//
// scl_triad.php
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
	final class triad
	{
		use _T_multi_construct;

		var $first  = null;
		var $second = null;
		var $third  = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function triad_1(triad &$triad)
		{
			$this->first = $triad->first;
			$this->second = $triad->second;
			$this->third = $triad->third;
		}

		function triad_2($first, $second, $third)
		{
			$this->first = $first;
			$this->second = $second;
			$this->third = $third;
		}

		function & swap(triad &$triad)
		{
			$first = $this->first;
			$second = $this->second;
			$third = $this->third;

			$this->first = $triad->first;
			$this->second = $triad->second;
			$this->third = $triad->third;

			$triad->first = $first;
			$triad->second = $second;
			$triad->third = $third;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */