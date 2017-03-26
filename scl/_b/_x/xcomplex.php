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

	function ccos(complex_t $z___)
	{
		return newcomplex(
			  \cos($z___->_M_real) * \cosh($z___->_M_imag)
			, \sin($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function csin(complex_t $z___)
	{
		return newcomplex(
			  \sin($z___->_M_real) * \cosh($z___->_M_imag)
			, \cos($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function ctan(complex_t $z___)
	{
		$d = 1 + \pow(\tan($z___->_M_real), 2) * \pow(\tanh($z___->_M_imag), 2);
		return newcomplex(
			  \pow((1 / \cosh($z___->_M_imag)), 2) * \tan($z___->_M_real) / $d
			, \pow((1 / \cos($z___->_M_real)), 2) * \tanh($z___->_M_imag) / $d
		);
	}

	function ccosh(complex_t $z___)
	{
		return newcomplex(
			  \cosh($z___->_M_real) * \cos($z___->_M_imag)
			, \sinh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function csinh(complex_t $z___)
	{
		return newcomplex(
			  \sinh($z___->_M_real) * \cos($z___->_M_imag)
			, \cosh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function ctanh(complex_t $z___)
	{
		$d = \cos($z___->_M_imag) * \cos($z___->_M_imag) + \sinh($z___->_M_real) * \sinh($z___->_M_real);
		return newcomplex(
			  \sinh($z___->_M_real) * \cosh($z___->_M_real) / $d
			, 0.5 * \sin(2 * $z___->_M_imag) / $d
		);
	}

	function cexp(complex_t $z___)
	{
		return newcomplex(
			  \exp($z___->_M_real) * \cos($z___->_M_imag)
			, \exp($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function clog(complex_t $z___)
	{
		return newcomplex(
			  \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag))
			, \atan2($z___->_M_imag, $z___->_M_real)
		);
	}

	function cabs(complex_t $z___)
	{
		/* return \sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag); */
		return \hypot($z___->_M_real, $z___->_M_imag);
	}

	function carg(complex_t $z___)
	{
		if (\is_nan($z___->_M_real) || \is_nan($z___->_M_imag)) {
			return \NAN;
		}
		$A = \atan2($z___->_M_imag, $z___->_M_real);
		if (\M_PI < $A || $A < (\M_PI * - 1)) {
			return \INF;
		}
		return $A;
	}

	function cpow(complex_t $z1___, complex_t $z2___) 
	{
		if (_X_real_zeroed($z1___->_M_real, $z1___->_M_imag)) {
			return $x1;
		}

		$l = \log(\sqrt($z1___->_M_real * $z1___->_M_real + $z1___->_M_imag * $z1___->_M_imag));
		$T = \atan2($z1___->_M_imag, $z1___->_M_real);
		$R = \exp($l * $z2___->_M_real - $z2___->_M_imag * $T);
		$B = $T * $z2___->_M_real + $z2___->_M_imag * $l;

		return newcomplex($R * \cos($B), $R * \sin($B));
	}

	function csqrt(complex_t $z___) 
	{
		if (_X_real_zeroed($z___->_M_real, $z___->_M_imag)) {
			return $x;
		}

		$a = \abs($z___->_M_real);
		$b = \abs($z___->_M_imag);

		$W = (($a >= $b)
			? \sqrt($a) * \sqrt(0.5 * (1.0 + \sqrt(1.0 + ($b / $a) * ($b / $a))))
			: \sqrt($b) * \sqrt(0.5 * (($a / $b) + \sqrt(1.0 + ($a / $b) * ($a / $b))))
		);

		if ($z___->_M_real > 0.0 || _X_real_iszero($z___->_M_real)) {
			return newcomplex(
				  $W
				, $z___->_M_imag / (2.0 * $W)
			);
		}

		$I = ($z___->_M_imag >= 0) ? $W : -1 * $W;
		return newcomplex(
			$z___->_M_imag / (2.0 * $I)
			, $I
		);
	}

	function cconj(complex_t $z___)
	{
		return newcomplex(
			  $z___->_M_real
			, $z___->_M_imag * -1
		);
	}

	function cproj(complex_t $z___)
	{
		$z = clone $z___;
		if (isinf($z->_M_real) || isinf($z->_M_imag)) {
			$z->_M_real = \INF;
			$z->_M_imag = copysign(0.0, $z->_M_imag);
		}
		return $z;
	}

	function creal(complex_t $z___)
	{ return $z___->_M_real; }

	function cimag(complex_t $z___)
	{ return $z___->_M_imag; }
} /* EONS */

/* EOF */