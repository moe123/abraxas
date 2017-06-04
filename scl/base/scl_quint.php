<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_quint.php
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
	final class quint
	{
		use _T_multi_construct;

		var $first  = null;
		var $second = null;
		var $third  = null;
		var $fourth = null;
		var $fifth  = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function quint_1(quint &$quint)
		{
			$this->first = $quint->first;
			$this->second = $quint->second;
			$this->third = $quint->third;
			$this->fourth = $quint->fourth;
			$this->fifth = $quint->fifth;
		}

		function quint_2($first, $second, $third, $fourth, $fifth)
		{
			$this->first = $first;
			$this->second = $second;
			$this->third = $third;
			$this->fourth = $fourth;
			$this->fifth = $fifth;
		}

		function & swap(quint &$quint)
		{
			$first  = $this->first;
			$second = $this->second;
			$third  = $this->third;
			$fourth = $this->fourth;
			$fifth  = $this->fifth;

			$this->first  = $quint->first;
			$this->second = $quint->second;
			$this->third  = $quint->third;
			$this->fourth = $quint->fourth;
			$this->fifth  = $quint->fifth;

			$quint->first  = $first;
			$quint->second = $second;
			$quint->third  = $third;
			$quint->fourth = $fourth;
			$quint->fifth  = $fifth;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */