<?php
# -*- coding: utf-8 -*-

//
// xmath.php
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
	define('std\FP_NAN'         , 1);
	define('std\FP_INFINITE'    , 2);
	define('std\FP_ZERO'        , 3);
	define('std\FP_NORMAL'      , 4);
	define('std\FP_SUBNORMAL'   , 5);

	define('std\NAN'         , \NAN);
	define('std\INFINITY'    , \INF);

	function fpclassify(float $x___)
	{
		if (\is_infinite($x___)) {
			return FP_INFINITE;
		} else if (\is_nan($x___)) {
			return FP_NAN;
		} else if (!\is_finite($x___)) {
			return FP_SUBNORMAL;
		} else if (_X_real_iszero($x___)) {
			return FP_ZERO;
		}
		return FP_NORMAL;
	}

	function isnan(float $x___)
	{ return \intval(\is_nan($x___)); }

	function isnormal(float $x___)
	{ return \intval(fpclassify($x___) === FP_NORMAL); }

	function isfinite(float $x___)
	{ return \intval(\is_finite($x___)); }

	function isinf(float $x___)
	{ return \intval(\is_infinite($x___)); }

	function copysign($x___, $y___)
	{
		if (\is_numeric($x___)  && \is_numeric($x___)) {
			if (\is_nan(\floatval($x___))) {
				return \NAN;
			}
			$y = \strval($y___);
			if ($y[0] == '-') {
				$x = \strval($x___);
				if ($x[0] == '+') {
					$x = \substr($x, 1);
				}
				if ($x[0] != '-') {
					return \floatval('-' . $x);
				}
			}
			return $x___;
		}
		return \NAN;
	}

	function isgreater(float $x___, float $y___)
	{ return \intval($x___ > $y___); }
	
	function isgreaterequal(float $x___, float $y___)
	{ return \intval($x___ > $y___ || _X_real_equal($x___, $y___)); }

	function isless(float $x___, float $y___)
	{ return \intval($x___ < $y___); }

	function islessequal(float $x___, float $y___)
	{ return \intval($x___ < $y___ || _X_real_equal($x___, $y___)); }

	function islessgreater(float $x___, float $y___)
	{ return \intval($y___ > $x___ || $x___ > $y___); }

	function isunordered(float $x___, float $y___)
	{ return \intval(\is_nan($x___) || \is_nan($y___)); }

	function signbit($x___)
	{ return \is_numeric($x___) ? \intval(\strval($x___)[0] == '-') : 0; }

	function fabs(float $x___)
	{ return floatval(\abs($x___)); }

	function fmax(float $x___, float $y___)
	{ return \max($x___, $y___); }

	function fmin(float $x___, float $y___)
	{ return \min($x___, $y___); }

	function fdim(float $x___, float $y___)
	{ return \max(($x___ - $y___), 0.0); }

	function trunc(float $x___)
	{ return \intval(\round($x___ * 2) / 2); }	

	function fmod(float $x___, float $y___)
	{ return \fmod($x___, $y___); }

	function hypot(float $x___, float $y___)
	{ return \hypot($x___ , $y___); }

	function abs($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cabs($x___);
		}
		return \abs($x___);
	}

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

	function exp($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cexp($x___);
		}
		return \exp($x___);
	}

	function pow($x___, $y___) {
		if ($x___ instanceof \std\complex || $y___ instanceof \std\complex) {
			if (!($x___ instanceof \std\complex)) {
				$x___ = new complex($x___);
			}
			if (!($y___ instanceof \std\complex)) {
				$y___ = new complex($y___);
			}
			return cpow($x___, $y___);
		}
		return \pow($x___, $y___);
	}

	function log($x___)
	{
		if ($x___ instanceof \std\complex) {
			return clog($x___);
		}
		return \log($x___);
	}

	function log10($x___)
	{
		if ($x___ instanceof \std\complex) {
			return clog10($x___);
		}
		return \log10($x___);
	}

	function sqrt($x___)
	{
		if ($x___ instanceof \std\complex) {
			return csqrt($x___);
		}
		return \sqrt($x___);
	}

	function cos($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccos($x___);
		}
		return \cos($x___);
	}

	function cosh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccosh($x___);
		}
		return \cosh($x___);
	}

	function sin($x___)
	{
		if ($x___ instanceof \std\complex) {
			return csin($x___);
		}
		return \sin($x___);
	}

	function sinh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return csinh($x___);
		}
		return \sinh($x___);
	}

	function tan($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ctan($x___);
		}
		return \tan($x___);
	}

	function tanh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ctanh($x___);
		}
		return \tanh($x___);
	}

	function acos(float $x___)
	{ return \acos($x___); }

	function acosh(float $x___)
	{ return \acosh($x___); }

	function asin(float $x___)
	{ return \asin($x___); }

	function asinh(float $x___)
	{ return \asinh($x___); }

	function atan2(float $x___)
	{ return \atan2($x___); }

	function atan(float $x___)
	{ return \atan($x___); }

	function atanh(float $x___)
	{ return \atanh($x___); }
} /* EONS */

/* EOF */