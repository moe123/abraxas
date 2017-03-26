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
		} else if (is_nan($x___)) {
			return FP_NAN;
		} else if (!\is_finite($x___)) {
			return FP_SUBNORMAL;
		} else if (_X_real_iszero($x___)) {
			return FP_ZERO;
		}
		return FP_NORMAL;
	}

	function isnan(float $x___)
	{ return \intval(is_nan($x___)); }

	function isnormal(float $x___)
	{ return \intval(fpclassify($x___) === FP_NORMAL); }

	function isfinite(float $x___)
	{ return \intval(is_finite($x___)); }

	function isinf(float $x___)
	{ return \intval(is_infinite($x___)); }

	function copysign(float $x___, float $y___)
	{
		if (\is_nan($x___)) {
			return \NAN;
		}
		$y = \strval($y___);
		if ($y[0] == "-") {
			$x = \strval($x___);
			if ($x[0] == "+") {
				$x = \substr($x, 1);
			}
			if ($x[0] != "-") {
				return \floatval("-" . $x);
			}
		}
		return $x___;
	}

	function hypot(float $x___ , float $y___)
	{ return \hypot($x___ , $y___); }
} /* EONS */

/* EOF */