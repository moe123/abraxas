<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_math.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @brief      The Math numerics library declares a set of functions to compute 
 *             common mathematical operations and transformations on integral, 
 *             real-floating-point and complex type (@todo rational numbers support).
 * @comment
 *             A native support would be nice to have i.e precision loss, performances 
 *             issues, naive shortcuts, etc. Take it as an incomplete wish list for a
 *             more complete and robust math library ; a starting point ¯\(ツ)/¯.
 *
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	define('std\FP_NAN'       , 1);
	define('std\FP_INFINITE'  , 2);
	define('std\FP_ZERO'      , 3);
	define('std\FP_NORMAL'    , 4);
	define('std\FP_SUBNORMAL' , 5);

	define('std\NAN'      , \NAN);
	define('std\INFINITY' , \INF);

	define('std\HUGE_VAL' , 1e308);

	define('std\M_E'        , 2.71828182845904523536028747135266250 ); /* e              */
	define('std\M_LOG2E'    , 1.44269504088896340735992468100189214 ); /* log2(e)        */
	define('std\M_LOG10E'   , 0.434294481903251827651128918916605082); /* log10(e)       */
	define('std\M_LN2'      , 0.693147180559945309417232121458176568); /* loge(2)        */
	define('std\M_LN10'     , 2.30258509299404568401799145468436421 ); /* loge(10)       */
	define('std\M_PI'       , 3.14159265358979323846264338327950288 ); /* pi             */
	define('std\M_2PI'      , 6.28318530717958647692528676655910060 ); /* 2pi            */
	define('std\M_PI_2'     , 1.57079632679489661923132169163975144 ); /* pi/2           */
	define('std\M_PI_4'     , 0.785398163397448309615660845819875721); /* pi/4           */
	define('std\M_1_PI'     , 0.318309886183790671537767526745028724); /* 1/pi           */
	define('std\M_2_PI'     , 0.636619772367581343075535053490057448); /* 2/pi           */
	define('std\M_2_SQRTPI' , 1.12837916709551257389615890312154517 ); /* 2/sqrt(pi)     */
	define('std\M_SQRT2'    , 1.41421356237309504880168872420969808 ); /* sqrt(2)        */
	define('std\M_1_SQRT2'  , 0.707106781186547524400844362104849039); /* 1/sqrt(2)      */

	define('std\FE_DOWNWARD'   , 10);
	define('std\FE_TONEAREST'  , 20);
	define('std\FE_TOWARDZERO' , 30);
	define('std\FE_UPWARD'     , 40);

	define('std\FP_ILOGB0'   , SINT_MAX);
	define('std\FP_ILOGBNAN' , SINT_LOWEST);

	$GLOBALS["^std@_g_signgam"] = 1;
	$GLOBALS["^std@_g_rndmode"] = FE_TONEAREST;

	function setsigngam(int $signgam___)
	{ $GLOBALS["^std@_g_signgam"] = $signgam___; }

	function & signgam()
	{ return $GLOBALS["^std@_g_signgam"]; }

	function fesetround(int $rndmode___)
	{
		switch ($rndmode___) {
			case FE_DOWNWARD:
			case FE_TONEAREST:
			case FE_TOWARDZERO:
			case FE_UPWARD:
			{
				$GLOBALS["^std@_g_rndmode"] = $rndmode___;
				return 0;
			}
		}
		return -1;
	}

	function fegetround()
	{ return $GLOBALS["^std@_g_rndmode"]; }

	function fpclassify(float $x___)
	{
		if (\is_infinite($x___)) {
			return FP_INFINITE;
		} else if (\is_nan($x___)) {
			return FP_NAN;
		} else if (!\is_finite($x___)) {
			return FP_SUBNORMAL;
		} else if (_F_FP_iszero($x___)) {
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
	{ return \intval($x___ > $y___ || _F_FP_equal($x___, $y___)); }

	function isless(float $x___, float $y___)
	{ return \intval($x___ < $y___); }

	function islessequal(float $x___, float $y___)
	{ return \intval($x___ < $y___ || _F_FP_equal($x___, $y___)); }

	function islessgreater(float $x___, float $y___)
	{ return \intval($y___ > $x___ || $x___ > $y___); }

	function isunordered(float $x___, float $y___)
	{ return \intval(\is_nan($x___) || \is_nan($y___)); }

	function signbit($x___)
	{ return \is_numeric($x___) ? \intval(\strval($x___)[0] == '-') : 0; }

	function fabs(float $x___)
	{ return \floatval(\abs($x___)); }

	function fmod(float $x___, float $y___)
	{ return \fmod($x___, $y___); }

	function modf(float $x___, float &$iptr___)
	{
		$iptr___ = trunc($x___);
		return \fmod($x___, 1.0);
	}

	function fmax(float $x___, float $y___)
	{ return \max($x___, $y___); }

	function fmin(float $x___, float $y___)
	{ return \min($x___, $y___); }

	function fdim(float $x___, float $y___)
	{ return \max(($x___ - $y___), 0.0); }

	function fma(float $x___, float $y___, float $z___)
	{
		if (\is_infinite($x___) && _F_FP_iszero($y___) && \is_nan($z___)) {
			return \NAN;
		}
		if (\is_infinite($y___) && _F_FP_iszero($x___) && \is_nan($z___)) {
			return \NAN;
		}
		return \round(($x___ * $y___) + $z___);
	}

	function fdeg2rad(float $x___)
	{ return \deg2rad($x___); }

	function frad2deg(float $x___)
	{ return \rad2deg($x___); }

	function fsec(float $x___)
	{ return 1.0 / \cos($x___); }

	function fcsc(float $x___)
	{ return 1.0 / \sin($x___); }

	function fcot(float $x___)
	{ return 1.0 / \tan($x___); }

	function fsech(float $x___)
	{ return 1.0 / \cosh($x___); }

	function fcsch(float $x___)
	{ return 1.0 / \sinh($x___); }

	function fcoth(float $x___)
	{ return 1.0 / \tanh($x___); }

	function facsc(float $x___)
	{ return 1.0 / \asin($x___); }

	function fasec(float $x___)
	{ return 1.0 / \acos($x___); }

	function facot(float $x___)
	{ return 1.0 / \atan($x___); }

	function fasech(float $x___)
	{ return 1.0 / \acosh($x___); }

	function facsch(float $x___)
	{ return 1.0 / \asinh($x___); }

	function facoth(float $x___)
	{ return 1.0 / \atanh($x___); }

	function trunc(float $x___)
	{
		if (\is_infinite($x___)) {
			return $x___;
		}
		if (\is_nan($x___)) {
			return \NAN;
		}
		if (_F_FP_iszero($x___)) {
			return copysign(0.0, $x___);
		}
		if ($x___ > 0.0 ) {
			return \floor($x___);
		}
		return \ceil($x___);
	}

	function nearbyint(float $x___)
	{
		// $rnd = fegetround();
		return trunc($x___);
	}

	function remainder(float $x___, float $y___)
	{
		if (\is_infinite($y___)) {
			return $x___;
		}
		if (_F_FP_iszero($y___)) {
			return -(\NAN);
		}
		if (!_F_FP_same_sign($x___, $y___)) {
			$a = copysign($y___, $x___);
		} else {
			$a = $y___;
		}
		$n = _F_FP_nearest_int($x___ / $a);
		$r = $x___ - $n * $a;
		if (_F_FP_iszero($r)) {
			return copysign($r, $a);
		}
		return $r;
	}

	function hypot(float $x___, float $y___)
	{ return \hypot($x___ , $y___); }

	function fact(int $x___)
	{
		$v = 1;
		for($i = 2; $i <= $x___; $i++) {
			$v *= $i;
		}
		return $v;
	}

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

	function sec($x___)
	{
		if ($x___ instanceof \std\complex) {
			return csec($x___);
		}
		return fsec($x___);
	}

	function csc($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccsc($x___);
		}
		return fcsc($x___);
	}

	function cot($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccot($x___);
		}
		return fcot($x___);
	}

	function sech(float $x___)
	{
		if ($x___ instanceof \std\complex) {
			return csech($x___);
		}
		return fsech($x___);
	}

	function csch($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccsch($x___);
		}
		return fcsch($x___);
	}

	function coth($x___)
	{
		if ($x___ instanceof \std\complex) {
			return ccoth($x___);
		}
		return fcoth($x___);
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

	function topolar($x___, float &$rho___, float &$theta___)
	{
		$rho___   = abs($x___);
		$theta___ = arg($x___);
	}

	function exp($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cexp($x___);
		}
		$x = \exp($x___);
		if (\is_infinite($x)) {
			seterrno(ERANGE);
		}
		return $x;
	}

	function exp2($x___)
	{
		if ($x___ instanceof \std\complex) {
			return cpow(new complex(2.0), $x___);
		}
		$x = \pow(2, $x___);
		if (\is_infinite($x)) {
			seterrno(ERANGE);
		}
		return $x;
	}

	function expm1(float $x___)
	{
		$x = \expm1($x___);
		if (\is_infinite($x)) {
			seterrno(ERANGE);
		}
		return $x;
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
		if (_F_FP_iszero($x___) || $n___ < 1) {
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

	function lrint(float $x___)
	{ return \intval(\round($x___)); }

	function logb(float $x___)
	{
		if (\is_infinite($x___)) {
			return -(\INF);
		}
		if (\is_nan($x___)) {
			return \NAN;
		}
		if (_F_FP_iszero($x___)) {
			return \INF;
		}
		return \log(\abs($x___), FLT_RADIX);
	}

	function ilogb(float $x___)
	{
		if (\is_infinite($x___)) {
			return SINT_MAX;
		}
		if (\is_nan($x___)) {
			return FP_ILOGBNAN;
		}
		if (_F_FP_iszero($x___)) {
			return FP_ILOGB0;
		}
		return \intval(logb($x___));
	}

	function lgamma_s(float $x___)
	{
		if (\is_infinite($x___)) {
			return \INF;
		}
		if (\is_nan($x___)) {
			return \NAN;
		}
		if ($x___ < 0.0 || _F_FP_iszero($x___)) {
			return \INF;
		}
		if (_F_FP_isone($x___) || _F_FP_istwo($x___)) {
			return 0.0;
		}
		$e = 1.0;
		while ($x___ < 8) {
			$e *= $x___;
			$x___++; 
		}
		$ix2 = (1.0 / ($x___ * $x___));
		return (((((((((-0.029550653594771) * $ix2 + (0.0064102564102566 )) * $ix2
			+ (-0.0019175269175269 ))        * $ix2 + (0.00084175084175084)) * $ix2
			+ (-0.00059523809523809))        * $ix2 + (0.0007936507936508 )) * $ix2
			+ (0.0007936507936508  ))        * $ix2 + (0.083333333333335  )) / $x___
			+ 0.5 * 1.83787706640934548 - \log($e) - $x___ + ($x___ - 0.5) * \log($x___)
		);
	}

	function lgamma_r(float $x___, int &$signp___)
	{
		if ($x___ < 0.0 || _F_FP_iszero($x___)) {
			$intp = 0.0;
			$f = modf(-($x___), $intp);
			if (_F_FP_iszero($f)) {
				$signp___ = signbit($x___) ? -1 : 1;
				seterrno(ERANGE);
				return HUGE_VAL;
			}
			$signp___ = (!_F_FP_iszero(\fmod($intp, 2.0))) ? 1 : -1;
			$s = \sin(\M_PI * $f);
			if ($s < 0.0) {
				$s = -($s);
			}
			return 1.1447298858494001741 - \log($s) - lgamma_s(1 - $x___);
		}
		$signp___ = 1;
		return lgamma_s($x___);
	}

	function lgamma(float $x___)
	{
		$sign = 1;
		$g = lgamma_r($x___, $sign);
		setsigngam($sign);
		return $g;
	}

	function tgamma(float $x___)
	{
		$sign = 1;
		if (_F_FP_iszero($x___)) {
			seterrno(ERANGE);
			return (1.0 / $x___) < 0 ? -(HUGE_VAL) : HUGE_VAL;
		}
		if ($x___ < 0.0) {
			$intp = 0.0;
			$f = modf(-($x___), $intp);
			if (_F_FP_iszero($f)) {
				seterrno(EDOM);
				return \NAN;
			}
		}
		$g = lgamma_r($x___, $sign);
		return $sign * \exp($g);
	}

	function beta(float $x___, float $y___)
	{ return (\exp(lgamma_s($x___) + lgamma_s($y___) - lgamma_s($x___ + $y___))); }

	function frexp(float $x___, int &$e___)
	{
		$e___ = (\floor(\log($float, 2)) + 1 );
		return ($x___ * \pow(2, -($e___)));
	}

	function ldexp(float $x___, int $n___)
	{ return ($x___ * \pow(2, $n___)); }

	function erf(float $x___)
	{ return _F_erf_f77($x___); }

	function erfc(float $x___)
	{ return (1.0 - (erf($x___))); }

	function sincosf(float $x___, float &$sin___, float &$cos___)
	{
		$sin___ = \sin($x___);
		$cos___ = \cos($x___);
	}
} /* EONS */

/* EOF */