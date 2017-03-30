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

namespace
{
	if (\intval(PHP_MAJOR_VERSION . PHP_MINOR_VERSION . PHP_RELEASE_VERSION) < 7200) {
		define('PHP_FLOAT_EPSILON', 0.000001);
		define('PHP_FLOAT_MIN'    , \floatval(PHP_INT_MIN));
		define('PHP_FLOAT_MAX'    , \floatval(PHP_INT_MAX));
	}
} /* EONS */

namespace std
{
	define('std\FLT_EPSILON'  , PHP_FLOAT_EPSILON);
	define('std\FLT_SIZE'     , PHP_INT_SIZE);
	define('std\FLT_MAX'      , PHP_FLOAT_MAX);
	define('std\FLT_LOWEST'   , -PHP_FLOAT_MAX);
	define('std\FLT_MIN'      , PHP_FLOAT_MIN);
	define('std\FLT_RADIX'    , 2);

	define('std\SINT_EPSILON' , 0);
	define('std\SINT_SIZE'    , PHP_INT_SIZE);
	define('std\SINT_MAX'     , PHP_INT_MAX);
	define('std\SINT_LOWEST'  , -PHP_INT_MAX);
	define('std\SINT_MIN'     , PHP_INT_MIN);

	define('std\FP_NAN'       , 1);
	define('std\FP_INFINITE'  , 2);
	define('std\FP_ZERO'      , 3);
	define('std\FP_NORMAL'    , 4);
	define('std\FP_SUBNORMAL' , 5);

	define('std\NAN'      , \NAN);
	define('std\INFINITY' , \INF);

	define('std\M_E'        , 2.71828182845904523536028747135266250 ); /* e              */
	define('std\M_LOG2E'    , 1.44269504088896340735992468100189214 ); /* log2(e)        */
	define('std\M_LOG10E'   , 0.434294481903251827651128918916605082); /* log10(e)       */
	define('std\M_LN2'      , 0.693147180559945309417232121458176568); /* loge(2)        */
	define('std\M_LN10'     , 2.30258509299404568401799145468436421 ); /* loge(10)       */
	define('std\M_PI'       , 3.14159265358979323846264338327950288 ); /* pi             */
	define('std\M_PI_2'     , 1.57079632679489661923132169163975144 ); /* pi/2           */
	define('std\M_PI_4'     , 0.785398163397448309615660845819875721); /* pi/4           */
	define('std\M_1_PI'     , 0.318309886183790671537767526745028724); /* 1/pi           */
	define('std\M_2_PI'     , 0.636619772367581343075535053490057448); /* 2/pi           */
	define('std\M_2_SQRTPI' , 1.12837916709551257389615890312154517 ); /* 2/sqrt(pi)     */
	define('std\M_SQRT2'    , 1.41421356237309504880168872420969808 ); /* sqrt(2)        */
	define('std\M_SQRT1_2'  , 0.707106781186547524400844362104849039); /* 1/sqrt(2)      */

	define('std\FP_ILOGB0'   , (-2147483647 - 1));
	define('std\FP_ILOGBNAN' , (-2147483647 - 1));

	function _X_compute_pi()
	{
		static $_S_PI_const = null;
		if (\is_null($_S_PI_const)) {
			$_S_PI_const = \atan2(+0.0, -0.0);
		}
		return $_S_PI_const;
	}

	function _X_FP_equal(float $l___, float $r___)
	{
		if (_X_FP_iszero($l___) && _X_FP_iszero($r___)) {
			return true;
		}
		return ($l___ == $r___ || \abs($l___ - $r___) < FLT_EPSILON);
	}

	function _X_FP_iszero(float $x___)
	{ return ($x___ == -0.0 || $x___ == 0.0 || \abs($x___) < FLT_EPSILON); }

	function _X_FP_zeroed(...$args___)
	{
		$ret = false;
		foreach ($args___ as $x) {
			if (_X_FP_iszero($x)) {
				$ret = true;
			} else {
				$ret = false;
				break;
			}
		}
		return $ret;
	}

	function fpclassify(float $x___)
	{
		if (\is_infinite($x___)) {
			return FP_INFINITE;
		} else if (\is_nan($x___)) {
			return FP_NAN;
		} else if (!\is_finite($x___)) {
			return FP_SUBNORMAL;
		} else if (_X_FP_iszero($x___)) {
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
			$y = \strval($y___);
			$x = \strval($x___);
			if ($x[0] == '-' || $x[0] == '+') {
				$x = \substr($x, 1);
			}
			if ($y[0] == '-') {
				return \floatval('-' . $x);
			}
			return \floatval($x);
		}
		return \NAN;
	}

	function isgreater(float $x___, float $y___)
	{ return \intval($x___ > $y___); }
	
	function isgreaterequal(float $x___, float $y___)
	{ return \intval($x___ > $y___ || _X_FP_equal($x___, $y___)); }

	function isless(float $x___, float $y___)
	{ return \intval($x___ < $y___); }

	function islessequal(float $x___, float $y___)
	{ return \intval($x___ < $y___ || _X_FP_equal($x___, $y___)); }

	function islessgreater(float $x___, float $y___)
	{ return \intval($y___ > $x___ || $x___ > $y___); }

	function isunordered(float $x___, float $y___)
	{ return \intval(\is_nan($x___) || \is_nan($y___)); }

	function signbit($x___)
	{ return \is_numeric($x___) ? \intval(\strval($x___)[0] == '-') : 0; }

	function fabs(float $x___)
	{ return \floatval(\abs($x___)); }

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
		if (\is_float($x___)) {
			return \floatval(\abs($x___));
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

	function log2(float $x___)
	{ return \log($x___, 2); }

	function logn($x___)
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

	function log1p(float $x___)
	{ return \log1p($x___); }

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

	function acos($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cacos($x___);
		}
		return \acos($x___);
	}

	function acosh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cacosh($x___);
		}
		return \acosh($x___);
	}

	function asin($x___)
	{
		if ($x___ instanceof \std\complex) {
			return casin($x___);
		}
		return \asin($x___);
	}

	function asinh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return casinh($x___);
		}
		return \asinh($x___);
	}

	function atan2(float $x___)
	{ return \atan2($x___); }

	function atan($x___)
	{
		if ($x___ instanceof \std\complex) {
			return catan($x___);
		}
		return \atan($x___);
	}

	function atanh($x___)
	{
		if ($x___ instanceof \std\complex) {
			return catanh($x___);
		}
		return \atanh($x___);
	}

	function cbrt(float $x___)
	{ return nthrt($x___, 3); }

	function ftrt(float $x___)
	{ return nthrt($x___, 4); }

	function nthrt(float $x___, int $n___)
	{
		if (_X_FP_iszero($x___) || $n___ < 1) {
			return $x___;
		}
		$rt = \pow(\abs($x___), 1.0 / \abs($n___));
		return $x___ < 0 ? -($rt) : $rt;
	}

	function ceil(float $x___)
	{ return \ceil($x___); }

	function floor(float $x___)
	{ return \floor($x___); }

	function round(float $x___)
	{ return \round($x___); }

	function logb(float $x___)
	{
		if (\is_infinite($x___)) {
			return -(\INF);
		}
		if (\is_nan($x___)) {
			return \NAN;
		}
		if (_X_FP_iszero($x___)) {
			return \INF;
		}
		return \log(\abs($x___), FLT_RADIX);
	}
} /* EONS */

/* EOF */