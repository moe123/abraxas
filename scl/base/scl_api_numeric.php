<?php
# -*- coding: utf-8 -*-

//
// scl_api_numeric.php
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
	function _F_erf_cheung(float $x___)
	{
		$a = copysign(1.0, $x___);
		$x = \abs($x___);
		$v = (1.0 / (1.0 + 0.3275911 * $x));
		return ($a * (1.0 - (
			((((1.061405429 * $v + -1.4531520271) * $v) + 1.421413741) 
				* $v + -0.284496736) * $v + 0.254829592) * $v * \exp(-$x * $x)
		));
	}

	function _F_erf_f77(float $x___)
	{
		$v = (1 / (1 + 0.5 * \abs($x___)));
		$Τ = $v * \exp(
				- $x___ * $x___
				- 1.26551223
				+ 1.00002368 * $v
				+ 0.37409196 * $v * $v
				+ 0.09678418 * $v * $v * $v
				- 0.18628806 * $v * $v * $v * $v
				+ 0.27886807 * $v * $v * $v * $v * $v
				- 1.13520398 * $v * $v * $v * $v * $v * $v
				+ 1.48851587 * $v * $v * $v * $v * $v * $v * $v
				- 0.82215223 * $v * $v * $v * $v * $v * $v * $v * $v
				+ 0.17087277 * $v * $v * $v * $v * $v * $v * $v * $v * $v
		);
		if ($x___ >= 0) {
			return 1 - $Τ;
		}
		return $Τ - 1;
	}

	function _F_npdf(float $x___, float $mu___, float $sigma___)
	{
		return ((\exp(-1.0 * ($x___ - $mu___) * ($x___ - $mu___) /
			(2.0 * $sigma___ * $sigma___)) / ($sigma___ * 2.50662827463100024161)
		));
	}

	function _F_ncdf_1(float $x___, float $mu___, float $sigma___)
	{ return (0.5 * (1.0 + _F_erf_cheung(($x___ - $mu___) / ($sigma___ * 1.41421356237309514547)))); }

	function _F_ncdf_2(float $x___, float $mu___, float $sigma___)
	{
		$a = 0;
		for ($i = 1; $i < (1000000 - 1); $i++) {
			$a += npdf($x___ + $i * ($x___ + 1000) / 1000000, $mu___, $sigma___);
		}
		return ((($x___ + 1000) / 1000000) * ((npdf($x___, $mu___, $sigma___)
			+ npdf(-1000, $mu___, $sigma___)) / 2.0 + $a)
		);
	}

	function _F_lcm(int $a___, int $b___)
	{
		$c = _F_gcd($a___, $b___);
		return $c !== 0 ? \intval(($a___ * $b___) / ($c)) : 0;
	}

	function _F_lcmv(array &$m___, int $n___)
	{
		$a = \abs(\intval($m___[0]));
		for ($i = 1; $i < $n___; $i++) {
			$m = \abs(\intval($m___[$i]));
			if (($c = _F_gcd($m, $a))) {
				$a = \intval(($m * $a) / $c);
			}
		}
		return $a;
	}

	function _F_gcd(int $m___, int $n___)
	{
		$a = $m___ < 0 ? -($m___) : $m___;
		$b = $n___ < 0 ? -($n___) : $n___;
		$c = $a % $b;
		while($c > 0) { $a = $b; $b = $c; $c = $a % $b; }
		return $b;
	}

	function _F_ratio_is_integral(int &$num___, int &$den___)
	{ return (($num___ % $den___) === 0); }

	function _F_ratio_is_real(int &$num___, int &$den___)
	{ return (($num___ % $den___) !== 0); }

	function _F_ratio_gcd(int &$m___, int &$n___)
	{
		if ($gcd = _F_gcd($m___, $n___)) {
			$m___ = \intval($m___ / $gcd);
			$n___ = \intval($n___ / $gcd);
		} else {
			_F_throw_overflow_error("Divide by zero error");
		}
	}

	function _F_ratio_nearest(float $x, int &$num___, int &$den___)
	{
		$m1 = 1;
		$m2 = 0;
		$n1 = 0;
		$n2 = 1;

		$n = 0;
		if ($x < 0) {
			$n = -($x);
			$sign = -1;
		} else {
			$n = ($x);
			$sign = 1;
		}
		if ($n < FLT_EPSILON) {
			$num___ = 0;
			$den___ = 1;
			return;
		}
		$b = 1 / $n;
		$p = $m1;
		do {
			if (!$b) {
				break;
			}
			$b = 1 / $b;
			$a = \floor($b);
			$p = $m1;
			$m1 = (($a * $m1) + $m2);
			$m2 = $p;
			$p = $n1;
			$n1 = (($a * $n1) + $n2);
			$n2 = $p;
			$b = $b - $a;
		} while (\abs($n - $m1 / $n1) > ($n * FLT_EPSILON));

		$num___ = $m1 * $sign;
		$den___ = $n1;
	}

	function _F_ratio_reduce(
		  int &$num1___
		, int &$den1___
		, int &$num2___
		, int &$den2___
	) {
		if ($lcm = _F_lcm($den1___, $den2___)) {
			$n1 = \intval($num1___ * \intval($lcm / $den1___));
			$n2 = \intval($num2___ * \intval($lcm / $den2___));
			$num1___ = $n1;
			$den1___ = $lcm;
			$num2___ = $n2;
			$den2___ = $lcm;
		} else {
			_F_throw_overflow_error("Divide by zero error");
		}
	}

	function _F_ratio_add(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) + ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_F_ratio_gcd($m___, $n___);
	}

	function _F_ratio_add_int( 
		  int $num1___
		, int $den1___
		, int $int___
		, int &$m___
		, int &$n___
	) {
		$num2 = $int___;
		$den2 = 1;
		_F_ratio_add($num1___, $den1___, $num2, $den2, $m___, $n___);
	}

	function _F_ratio_add_real( 
		  int   $num1___
		, int   $den1___
		, float $real___
		, int   &$m___
		, int   &$n___
	) {
		$num2 = 0;
		$den2 = 0;
		_F_ratio_nearest($real___, $num2, $den2);
		_F_ratio_add($num1___, $den1___, $num2, $den2, $m___, $n___);
	}

	function _F_ratio_subtract(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) - ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_F_ratio_gcd($m___, $n___);
	}

	function _F_ratio_multiply(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $num2___);
		$n___ = ($den1___ * $den2___);
		_F_ratio_gcd($m___, $n___);
	}

	function _F_ratio_divide(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $den2___);
		$n___ = ($den1___ * $num2___);
		_F_ratio_gcd($m___, $n___);
	}
} /* EONS */

/* EOF */