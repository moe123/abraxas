<?php
# -*- coding: utf-8 -*-

//
// xcomplex.php
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
	final class complex_t
	{
		var $_M_real = 0.0;
		var $_M_imag  = 0.0;
		
		function __construct(float $r___, float $i___)
		{
			$this->_M_real = $r___;
			$this->_M_imag = $i___;
		}
	} /* EOC */

	function newcomplex(float $r___, float $i___)
	{ return new complex_t($r___, $i___); }

	function ccos(complex_t $x)
	{
		return newcomplex(
			  \cos($x->_M_real) * \cosh($x->_M_imag)
			, \sin($x->_M_real) * \sinh($x->_M_imag)
		);
	}

	function csin(complex_t $x)
	{
		return newcomplex(
			  \sin($x->_M_real) * \cosh($x->_M_imag)
			, \cos($x->_M_real) * \sinh($x->_M_imag)
		);
	}

	function ctan(complex_t $x)
	{
		$d = 1 + \pow(\tan($x->_M_real), 2) * \pow(\tanh($x->_M_imag), 2);
		return newcomplex(
			  \pow((1 / \cosh($x->_M_imag)), 2) * \tan($x->_M_real) / $d
			, \pow((1 / \cos($x->_M_real)), 2) * \tanh($x->_M_imag) / $d
		);
	}

	function ccosh(complex_t $x)
	{
		return newcomplex(
			  \cosh($x->_M_real) * \cos($x->_M_imag)
			, \sinh($x->_M_real) * \sin($x->_M_imag)
		);
	}

	function csinh(complex_t $x)
	{
		return newcomplex(
			  \sinh($x->_M_real) * \cos($x->_M_imag)
			, \cosh($x->_M_real) * \sin($x->_M_imag)
		);
	}

	function ctanh(complex_t $x)
	{
		$d = \cos($x->_M_imag) * \cos($x->_M_imag) + \sinh($x->_M_real) * \sinh($x->_M_real);
		return newcomplex(
			  \sinh($x->_M_real) * \cosh($x->_M_real) / $d
			, 0.5 * \sin(2 * $x->_M_imag) / $d
		);
	}

	function cexp(complex_t $x)
	{
		return newcomplex(
			  \exp($x->_M_real) * \cos($x->_M_imag)
			, \exp($x->_M_real) * \sin($x->_M_imag)
		);
	}

	function clog(complex_t $x)
	{
		return newcomplex(
			  \log(\sqrt($x->_M_real * $x->_M_real + $x->_M_imag * $x->_M_imag))
			, \atan2($x->_M_imag, $x->_M_real)
		);
	}

	function cabs(complex_t $x)
	{ return \sqrt($x->_M_real * $x->_M_real + $x->_M_imag * $x->_M_imag); }

	function carg(complex_t $x)
	{ return \atan2($x->_M_imag, $x->_M_real); }

	function cconj(complex_t $x)
	{
		return newcomplex(
			  $x->_M_real
			, $x->_M_imag * -1
		);
	}

	function creal(complex_t $x)
	{ return $x->_M_real; }

	function cimag(complex_t $x)
	{ return $x->_M_imag; }
} /* EONS */

/* EOF */