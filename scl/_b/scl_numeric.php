<?php
# -*- coding: utf-8 -*-

//
// scl_numeric.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	function _X_lcm(int $a___, int $b___)
	{
		$c = _X_gcd($a___, $b___);
		return $c !== 0 ? \intval(($a___ * $b___) / ($c)) : 0;
	}

	function _X_lcmv(array &$m___, int $n___)
	{
		$a = \abs(\intval($m___[0]));
		for ($i = 1; $i < $n___; $i++) {
			$m = \abs(\intval($m___[$i]));
			if (($c = _X_gcd($m, $a))) {
				$a = \intval(($m * $a) / $c);
			}
		}
		return $a;
	}

	function _X_gcd(int $m___, int $n___)
	{
		$a = $m___ < 0 ? -($m___) : $m___;
		$b = $n___ < 0 ? -($n___) : $n___;
		$c = $a % $b;
		while($c > 0) { $a = $b; $b = $c; $c = $a % $b; }
		return $b;
	}

	function _X_ratio_is_integral(int &$num___, int &$den___)
	{ return (($num___ % $den___) === 0); }

	function _X_ratio_is_real(int &$num___, int &$den___)
	{ return (($num___ % $den___) !== 0); }

	function _X_ratio_gcd(int &$m___, int &$n___)
	{
		if ($gcd = _X_gcd($m___, $n___)) {
			$m___ = \intval($m___ / $gcd);
			$n___ = \intval($n___ / $gcd);
		} else {
			_F_throw_overflow_error("Divide by zero error");
		}
	}

	function _X_ratio_nearest(float $x, int &$num___, int &$den___)
	{
		$m1 = 1;
		$m2 = 0;
		$n1 = 0;
		$n2 = 1;

		if ($x < 0) {
			$n = -($x);
			$sign = -1;
		} else {
			$n = ($x);
			$sign = 1;
		}
		if ($n < numeric_limits_float::epsilon) {
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
		} while (\abs($n - $m1 / $n1) > ($n * numeric_limits_float::epsilon));

		$num___ = $m1 * $sign;
		$den___ = $n1;
	}

	function _X_ratio_reduce(
		  int &$num1___
		, int &$den1___
		, int &$num2___
		, int &$den2___
	) {
		if ($lcm = _X_lcm($den1___, $den2___)) {
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

	function _X_ratio_add(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) + ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_X_ratio_gcd($m___, $n___);
	}

	function _X_ratio_add_int( 
		  int $num1___
		, int $den1___
		, int $int___
		, int &$m___
		, int &$n___
	) {
		$num2 = $int___;
		$den2 = 1;
		_X_ratio_add($num1___, $den1___, $num2, $den2, $m___, $n___);
	}

	function _X_ratio_add_real( 
		  int   $num1___
		, int   $den1___
		, float $real___
		, int   &$m___
		, int   &$n___
	) {
		$num2 = 0;
		$den2 = 0;
		_X_ratio_nearest($real___, $num2, $den2);
		_X_ratio_add($num1___, $den1___, $num2, $den2, $m___, $n___);
	}

	function _X_ratio_subtract(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) - ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_X_ratio_gcd($m___, $n___);
	}

	function _X_ratio_multiply(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $num2___);
		$n___ = ($den1___ * $den2___);
		_X_ratio_gcd($m___, $n___);
	}

	function _X_ratio_divide(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $den2___);
		$n___ = ($den1___ * $num2___);
		_X_ratio_gcd($m___, $n___);
	}

	function gcd(int $m___, int $n___)
	{
		if ($m___ === 0 && $n___ === 0) {
			return 0;
		}
		if ($n___ === 0) {
			return $m___;
		}
		return _X_gcd($m___, $n___);
	}
	
	function lcm(int $m___, int $n___)
	{
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _X_lcm($m___, $n___);
	}

	function lcm_r(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		$m = [];
		$n = 0;
		while ($first___ != $last___) {
			$m[] = $first___->_F_this();
			$first___->_F_next();
			$n++;
		}
		return _X_lcmv($m, $n);
	}
} /* EONS */

/* EOF */