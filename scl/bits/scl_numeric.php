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

	function _F_builtin_ratio_gcd(int &$m___, int &$n___)
	{
		$a = $m___ < 0 ? -($m___) : $m___;
		$b = $n___ < 0 ? -($n___) : $n___;
		$c = $a % $b;
		while($c > 0) { $a = $b; $b = $c; $c = $a % $b; }
		$m___ = (int)($m___ / $b);
		$n___ = (int)($n___ / $b);
	}

	function _F_builtin_gcd(int $m___, int $n___)
	{
		$m = \abs($m___);
		$n = \abs($n___);
		$c = 0;
		while($m > 0) { $c = $m; $m = $n % $m; $n = $c; }
		return $n;
	}

	function _F_builtin_ratio_reduce(
		  int &$num1___
		, int &$den1___
		, int &$num2___
		, int &$den2___
	) {
		$d3 = _F_builtin_gcd($den1___, $den2___);
		$n1 = $num1___ * ($d3 / $den1___);
		$n2 = $num2___ * ($d3 / $den2___);
		$num1___ = $n1;
		$den1___ = $d3;
		$num2___ = $n2;
		$den2___ = $d3;
	}

	function _F_builtin_lcm(int $a___, int $b___)
	{
		$c = _F_builtin_gcd($a___, $b___);
		return $c !== 0 ? (int)($a___ / ($c * $b___)) : 0;
	}

	function _F_builtin_lcmv(array &$m___, int $n___)
	{
		$a = \abs((int)$m___[0]);
		for ($i = 1; $i < $n___; $i++) {
			$m = \abs((int)$m___[$i]);
			if (($c = _F_builtin_gcd($m, $a))) {
				$a = (int)(($m * $a) / $c);
			}
		}
		return $a;
	}

	function _F_builtin_ratio_add(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) + ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_F_builtin_ratio_gcd($m___, $n___);
	}

	function _F_builtin_ratio_subtract(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = (($num1___ * $den2___) - ($den1___ * $num2___));
		$n___ = ($den1___ * $den2___);
		_F_builtin_ratio_gcd($m___, $n___);
	}

	function _F_builtin_ratio_multiply(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $num2___);
		$n___ = ($den1___ * $den2___);
		_F_builtin_ratio_gcd($m___, $n___);
	}

	function _F_builtin_ratio_divide(
		  int $num1___
		, int $den1___
		, int $num2___
		, int $den2___
		, int &$m___
		, int &$n___
	) {
		$m___ = ($num1___ * $den2___);
		$n___ = ($den1___ * $num2___);
		_F_builtin_ratio_gcd($m___, $n___);
	}

	function gcd(int $m___, int $n___)
	{
		if ($m___ === 0 && $n___ === 0) {
			return 0;
		}
		if ($n___ === 0) {
			return $m___;
		}
		return _F_builtin_gcd($m___, $n___);
	}
	
	function lcm(int $m___, int $n___)
	{
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _F_builtin_lcm($m___, $n___);
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
		return _F_builtin_lcmv($m, $n);
	}
} /* EONS */

/* EOF */