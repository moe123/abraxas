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

	function _F_builtin_ratio_LCM(int &$num_d___, int &$den_d___)
	{ return (int)($num_d___ / _F_builtin_ratio_GCD($num_d___, $den_d___) * $den_d___); }

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
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _F_builtin_ratio_GCD($m___, $n___);
	}
	
	function lcm(int $m___, int $n___)
	{
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _F_builtin_ratio_LCM($m___, $n___);
	}
} /* EONS */

/* EOF */