<?php
# -*- coding: utf-8 -*-

//
// scl_complex.php
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
	final class complex
	{
		use _T_multi_construct;

		var $_M_real = 0.0;
		var $_M_imag = 0.0;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function complex_1(float $real)
		{
			$this->_M_real = $real;
			$this->_M_imag = 0.0;
		}

		function complex_2(float $real, float $imag)
		{
			$this->_M_real = $real;
			$this->_M_imag = $imag;
		}

		function real()
		{ return $this->_M_real; }

		function imag()
		{ return $this->_M_imag; }
	} /* EOC */
} /* EONS */

/* EOF */