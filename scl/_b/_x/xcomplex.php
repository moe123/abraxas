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
		var $_M_imag = 0.0;
		
		function __construct(float $r___, float $i___)
		{
			$this->_M_real = $r___;
			$this->_M_imag = $i___;
		}
	} /* EOC */

	function newcomplex(float $r___, float $i___)
	{ return new complex_t($r___, $i___); }

	function ccos(complex_t $x___)
	{
		return newcomplex(
			  \cos($x___->_M_real) * \cosh($x___->_M_imag)
			, \sin($x___->_M_real) * \sinh($x___->_M_imag)
		);
	}

	function csin(complex_t $x___)
	{
		return newcomplex(
			  \sin($x___->_M_real) * \cosh($x___->_M_imag)
			, \cos($x___->_M_real) * \sinh($x___->_M_imag)
		);
	}

	function ctan(complex_t $x___)
	{
		$d = 1 + \pow(\tan($x___->_M_real), 2) * \pow(\tanh($x___->_M_imag), 2);
		return newcomplex(
			  \pow((1 / \cosh($x___->_M_imag)), 2) * \tan($x___->_M_real) / $d
			, \pow((1 / \cos($x___->_M_real)), 2) * \tanh($x___->_M_imag) / $d
		);
	}

	function ccosh(complex_t $x___)
	{
		return newcomplex(
			  \cosh($x___->_M_real) * \cos($x___->_M_imag)
			, \sinh($x___->_M_real) * \sin($x___->_M_imag)
		);
	}

	function csinh(complex_t $x___)
	{
		return newcomplex(
			  \sinh($x___->_M_real) * \cos($x___->_M_imag)
			, \cosh($x___->_M_real) * \sin($x___->_M_imag)
		);
	}

	function ctanh(complex_t $x___)
	{
		$d = \cos($x___->_M_imag) * \cos($x___->_M_imag) + \sinh($x___->_M_real) * \sinh($x___->_M_real);
		return newcomplex(
			  \sinh($x___->_M_real) * \cosh($x___->_M_real) / $d
			, 0.5 * \sin(2 * $x___->_M_imag) / $d
		);
	}

	function cexp(complex_t $x___)
	{
		return newcomplex(
			  \exp($x___->_M_real) * \cos($x___->_M_imag)
			, \exp($x___->_M_real) * \sin($x___->_M_imag)
		);
	}

	function clog(complex_t $x___)
	{
		return newcomplex(
			  \log(\sqrt($x___->_M_real * $x___->_M_real + $x___->_M_imag * $x___->_M_imag))
			, \atan2($x___->_M_imag, $x___->_M_real)
		);
	}

	function cabs(complex_t $x___)
	{ return \sqrt($x___->_M_real * $x___->_M_real + $x___->_M_imag * $x___->_M_imag); }

	function carg(complex_t $x___)
	{ return \atan2($x___->_M_imag, $x___->_M_real); }

	function cpow(complex_t $x1___, complex_t $x2___) 
	{
		if (_X_real_zeroed($x1___->_M_real, $x1___->_M_imag)) {
			return $x1;
		}

		$l = \log(\sqrt($x1___->_M_real * $x1___->_M_real + $x1___->_M_imag * $x1___->_M_imag));
		$T = \atan2($x1___->_M_imag, $x1___->_M_real);
		$R = \exp($l * $x2___->_M_real - $x2___->_M_imag * $T);
		$B = $T * $x2___->_M_real + $x2___->_M_imag * $l;

		return newcomplex($R * \cos($B), $R * \sin($B));
	}

	function csqrt(complex_t $x___) 
	{
		if (_X_real_zeroed($x___->_M_real, $x___->_M_imag)) {
			return $x;
		}

		$a = \abs($x___->_M_real);
		$b = \abs($x___->_M_imag);

		$W = (($a >= $b)
			? \sqrt($a) * \sqrt(0.5 * (1.0 + \sqrt(1.0 + ($b / $a) * ($b / $a))))
			: \sqrt($b) * \sqrt(0.5 * (($a / $b) + \sqrt(1.0 + ($a / $b) * ($a / $b))))
		);

		if ($x___->_M_real > 0.0 || _X_real_iszero($x___->_M_real)) {
			return newcomplex(
				  $W
				, $x___->_M_imag / (2.0 * $W)
			);
		}

		$I = ($x___->_M_imag >= 0) ? $W : -1 * $W;
		return newcomplex(
			$x___->_M_imag / (2.0 * $I)
			, $I
		);
	}

	function cconj(complex_t $x___)
	{
		return newcomplex(
			  $x___->_M_real
			, $x___->_M_imag * -1
		);
	}

	function creal(complex_t $x___)
	{ return $x___->_M_real; }

	function cimag(complex_t $x___)
	{ return $x___->_M_imag; }
} /* EONS */

/* EOF */