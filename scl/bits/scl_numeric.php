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
	function _F_builtin_ratio_is_integral(int &$num___, int &$den____)
	{ return (int)(($num___ % $den____) === 0); }

	function _F_builtin_ratio_is_real(int &$num___, int &$den____)
	{ return (int)(($num___ % $den____) !== 0); }

	function _F_builtin_ratio_GCD(int &$num_d___, int &$den_d___)
	{
		$a = $num_d___ < 0 ? -($num_d___) : $num_d___;
		$b = $den_d___ < 0 ? -($den_d___) : $den_d___;
		$c = $a % $b;
		while($c > 0) { $a = $b; $b = $c; $c = $a % $b; }
		$num_d___ = (int)($num_d___ / $b);
		$den_d___ = (int)($den_d___ / $b);
	}

	function _F_builtin_GCD(int $m___, int $n___)
	{
		$m = \abs($m___);
		$n = \abs($n___);
		$c = 0;
		while($m > 0) { $c = $m; $m = $n % $m; $n = $c; }
		return $n;
	}

	function _F_builtin_LCM(int $a___, int $b___)
	{
		$c = _F_builtin_GCD($a___, $b___);
		return $c !== 0 ? (int)($a___ / ($c * $b___)) : 0;
	}

	function _F_builtin_ratio_add(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$num_d___
		, int &$den_d___
	) {
		$num_d___ = (($num1___ * $den2___) + ($den1___ * $num2___));
		$den_d___ = ($den1___ * $den2___);
		_F_builtin_ratio_GCD($num_d___, $den_d___);
	}

	function _F_builtin_ratio_subtract(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$num_d___
		, int &$den_d___
	) {
		$num_d___ = (($num1___ * $den2___) - ($den1___ * $num2___));
		$den_d___ = ($den1___ * $den2___);
		_F_builtin_ratio_GCD($num_d___, $den_d___);
	}

	function _F_builtin_ratio_multiply(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$num_d___
		, int &$den_d___
	) {
		$num_d___ = ($num1___ * $num2___);
		$den_d___ = ($den1___ * $den2___);
		_F_builtin_ratio_GCD($num_d___, $den_d___);
	}

	function _F_builtin_ratio_divide(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$num_d___
		, int &$den_d___
	) {
		$num_d___ = ($num1___ * $den2___);
		$den_d___ = ($den1___ * $num2___);
		_F_builtin_ratio_GCD($num_d___, $den_d___);
	}

	function gcd(int $m___, int $n___)
	{
		if ($m___ === 0 && $n___ === 0) {
			return 0;
		}
		if ($n___ === 0) {
			return $m___;
		}
		return _F_builtin_GCD($m___, $n___);
	}
	
	function lcm(int $m___, int $n___)
	{
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _F_builtin_LCM($m___, $n___);
	}

	function lcmv(array &$m___, int $n___)
	{
		$a = (int)$m___[0];
		for ($i = 1; $i < $n___; $i++) {
			if ($c = _F_builtin_GCD((int)$m___[$i], $a)) {
				$a = (int)(($m___[$i] * $a) / $c);
			}
		}
		return $a;
	}
} /* EONS */

/* EOF */