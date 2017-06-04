<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_complex.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @brief      The complex library implements the complex class to contain
 *             complex numbers in cartesian form and several functions and overloads
 *             to operate with them: hyperbolic, trigonometric, exponential, power.
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

	function & complex_copy(complex $z)
	{
		$x = new complex;
		$this->_M_real = $z->_M_real;
		$this->_M_imag = $z->_M_imag;
		return $x;
	}

	function & complex_invert(complex $z)
	{ return cinv($z); }

	function & complex_negate(complex $z)
	{ return cneg($z); }

	function & complex_muliply(complex $l, complex $r)
	{ return cmul($l, $r); }

	function & complex_divide(complex $l, complex $r)
	{ return cdiv($l, $r); }

	function & complex_add(complex $l, complex $r)
	{ return cadd($l, $r); }

	function & complex_subtract(complex $l, complex $r)
	{ return csub($l, $r); }

	function complex_equal(complex $l, complex $r)
	{
		return (
			_F_FP_equal($l->_M_real, $r->_M_real) &&
			_F_FP_equal($l->_M_imag, $r->_M_imag)
		);
	}

	function complex_not_equal(complex $l, complex $r)
	{ return (!complex_equal($l, $r)); }
} /* EONS */

/* EOF */