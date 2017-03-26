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
	const nan      = \NAN;
	const inf      = \INF;
	const infinity = \INF;

	function isnan(float $val___)
	{ return \intval(is_nan($val___)); }

	function isinf(float $val___)
	{ return \intval(is_infinite($val___)); }

	function copysign(float $x___, float $y___)
	{
		if (\is_nan($x___)) {
			return \NAN;
		}
		$y = \strval($y___);
		if ($y[0] == "-") {
			$x = \strval($x___);
			if ($x[0] != "-") {
				return \floatval("-" . $x);
			}
		}
		return $x___;
	}

} /* EONS */

/* EOF */