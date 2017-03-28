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

	function real($x___)
	{
		if ($x___ instanceof \std\complex) {
			return creal($x___);
		}
		return $x___;
	}

	function imag($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cimg($x___);
		}
		return 0.0;
	}

	function arg($x___)
	{
		if ($x___ instanceof \std\complex) {
			return carg($x___);
		}
		return \atan2(0.0, $x___);
	}

	function norm($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cnorm($x___);
		}
		return $x___ * $x___;
	}

	function conj($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cconj($x___);
		}
		return new complex($x___);
	}

	function proj($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cproj($x___);
		}
		return new complex(\is_infinite($x___) ? \abs($x___) : $x___);
	}

	function polar(float $rho___, float $theta___ = 0.0)
	{ return cpolar($rho___, $theta___); }
} /* EONS */

/* EOF */