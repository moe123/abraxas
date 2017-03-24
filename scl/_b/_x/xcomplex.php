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
	final class complex
	{
		var $_M_real = 0.0;
		var $_M_imag  = 0.0;
		
		function __construct(float $r___, float $i___)
		{
			$this->_M_real = $r___;
			$this->_M_imag = $i___;
		}
	} /* EOC */

	function cmplx(float $r___, float $i___)
	{ return new complex($r___, $i___); }

	function ccos(complex $x)
	{
		return cmplx(
			  \cos($x->_M_real) * \cosh($x->_M_imag)
			, \sin($x->_M_real) * \sinh($x->_M_imag)
		);
	}

	function csin(complex $x)
	{
		return cmplx(
			  \sin($x->_M_real) * \cosh($x->_M_imag)
			, \cos($x->_M_real) * \sinh($x->_M_imag)
		);
	}

	function ctan(complex $x)
	{
		$d = 1 + \pow(\tan($x->_M_real), 2) * \pow(\tanh($x->_M_imag), 2);
		return cmplx(
			  \pow((1 / \cosh($x->_M_imag)), 2) * \tan($x->_M_real) / $d
			, \pow((1 / \cos($x->_M_real)), 2) * \tanh($x->_M_imag) / $d
		);
	}

	function ccosh(complex $x)
	{
		return cmplx(
			  \cosh($x->_M_real) * \cos($x->_M_imag)
			, \sinh($x->_M_real) * \sin($x->_M_imag)
		);
	}

	function csinh(complex $x)
	{
		return cmplx(
			  \sinh($x->_M_real) * \cos($x->_M_imag)
			, \cosh($x->_M_real) * \sin($x->_M_imag)
		);
	}

	function ctanh(complex $x)
	{
		$d = \cos($x->_M_imag) * \cos($x->_M_imag) + \sinh($x->_M_real) * \sinh($x->_M_real);
		return cmplx(
			  \sinh($x->_M_real) * \cosh($x->_M_real) / $d
			, 0.5 * \sin(2 * $x->_M_imag) / $d
		);
	}

	function creal(complex $x)
	{ return $x->_M_real; }

	function cimag(complex $x)
	{ return $x->_M_imag; }
} /* EONS */

/* EOF */