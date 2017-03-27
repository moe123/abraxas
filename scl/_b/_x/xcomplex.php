<?php
# -*- coding: utf-8 -*-

//
// xcomplex.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//

/*!
 * @project    Abraxas (Standard Container Library).
 * @brief      Complex numbers and associated mathematical functions:
 *             hyperbolic, trigonometric, exponential, power.
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

	function CMPLX(float $r___, float $i___)
	{ return new complex_t($r___, $i___); }

	function ccos(complex_t $z___)
	{
		return CMPLX(
			  \cos($z___->_M_real) * \cosh($z___->_M_imag)
			, \sin($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function csin(complex_t $z___)
	{
		return CMPLX(
			  \sin($z___->_M_real) * \cosh($z___->_M_imag)
			, \cos($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function ctan(complex_t $z___)
	{
		$d = 1 + \pow(\tan($z___->_M_real), 2) * \pow(\tanh($z___->_M_imag), 2);
		return CMPLX(
			  \pow((1 / \cosh($z___->_M_imag)), 2) * \tan($z___->_M_real) / $d
			, \pow((1 / \cos($z___->_M_real)), 2) * \tanh($z___->_M_imag) / $d
		);
	}

	function ccosh(complex_t $z___)
	{
		return CMPLX(
			  \cosh($z___->_M_real) * \cos($z___->_M_imag)
			, \sinh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function csinh(complex_t $z___)
	{
		return CMPLX(
			  \sinh($z___->_M_real) * \cos($z___->_M_imag)
			, \cosh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function ctanh(complex_t $z___)
	{
		$d = \cos($z___->_M_imag) * \cos($z___->_M_imag) + \sinh($z___->_M_real) * \sinh($z___->_M_real);
		return CMPLX(
			  \sinh($z___->_M_real) * \cosh($z___->_M_real) / $d
			, 0.5 * \sin(2 * $z___->_M_imag) / $d
		);
	}

	function cexp(complex_t $z___)
	{
		return CMPLX(
			  \exp($z___->_M_real) * \cos($z___->_M_imag)
			, \exp($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function clog(complex_t $z___)
	{
		return CMPLX(
			  \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag))
			, \atan2($z___->_M_imag, $z___->_M_real)
		);
	}

	function clog10(complex_t $z___)
	{
		$R = \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag));
		$I = \atan2($z___->_M_imag, $z___->_M_real);
		return CMPLX(
			  $R * (1.0 / \log(10))
			, $I * (1.0 / \log(10))
		);
	}

	function cabs(complex_t $z___)
	{
		/* return \sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag); */
		return \hypot($z___->_M_real, $z___->_M_imag);
	}

	function cnorm(complex_t $z___)
	{
		if (\is_infinite($z___->_M_real))
			return \abs($z___->_M_real);
		if (\is_infinite($z___->_M_imag))
			return \abs($z___->_M_imag);
		return $z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag;
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

		return CMPLX($R * \cos($B), $R * \sin($B));
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
			return CMPLX(
				  $W
				, $z___->_M_imag / (2.0 * $W)
			);
		}

		$I = ($z___->_M_imag > 0.0 || _X_real_iszero($z___->_M_imag)) ? $W : -($W);
		return CMPLX(
			  $z___->_M_imag / (2.0 * $I)
			, $I
		);
	}

	function cconj(complex_t $z___)
	{ return CMPLX($z___->_M_real, -($z___->_M_imag)); }

	function cproj(complex_t $z___)
	{
		$z = clone $z___;
		if (\is_infinite($z->_M_real) || \is_infinite($z->_M_imag)) {
			$z->_M_real = \INF;
			$z->_M_imag = copysign(0.0, $z->_M_imag);
		}
		return $z;
	}

	function cpolar(float $rho___, float $theta___ = 0.0)
	{
		if (\is_nan($rho___) || signbit($rho___)) {
			return CMPLX(\NAN, \NAN);
		}

		if (\is_nan($theta___)) {
			if (\is_infinite($rho___)) {
					return CMPLX($rho___, $theta___);
			}
			return CMPLX($theta___, $theta___);
		}

		if (\is_infinite($theta___)) {
			if (\is_infinite($rho___)) {
					return CMPLX($rho___, \NAN);
			}
			return CMPLX(\NAN, \NAN);
		}

		$R = $rho___ * \cos($theta___);
		if (\is_nan($R)) {
			$R = 0.0;
		}
			
		$I = $rho___ * \sin($theta___);
		if (\is_nan($I)) {
			$I = 0.0;
		}
		return CMPLX($R, $I);
	}

	function cinv(complex_t $z___) 
	{
		$h = \hypot($z___->_M_real, $z___->_M_imag);
		if (_X_real_iszero($h)) {
			return CMPLX(0.0, -(copysign(0.0, $z->_M_imag)));
		}
		$t = (1.0 / $h);
		return CMPLX(
			  ($z___->_M_real * $t * $t)
			, (-($z___->_M_imag) * $t * $t)
		);
	}

	function cneg(complex_t $z___) 
	{ return CMPLX(-($z___->_M_real), -($z->_M_imag)); }

	function csec(complex_t $z___) 
	{ return cinv(ccos($z___)); }

	function ccosec(complex_t $z___) 
	{ return cinv(csin($z___)); }

	function ccotan(complex_t $z___) 
	{ return cinv(ctan($z___)); }

	function creal(complex_t $z___)
	{ return $z___->_M_real; }

	function cimag(complex_t $z___)
	{ return $z___->_M_imag; }
} /* EONS */

/* EOF */