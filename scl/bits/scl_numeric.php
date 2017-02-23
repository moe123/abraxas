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
	function _F_builtin_lcm(int $a___, int $b___)
	{
		$c = _F_builtin_gcd($a___, $b___);
		return $c !== 0 ? \intval(($a___ * $b___) / ($c)) : 0;
	}

	function _F_builtin_lcmv(array &$m___, int $n___)
	{
		$a = \abs(\intval($m___[0]));
		for ($i = 1; $i < $n___; $i++) {
			$m = \abs(\intval($m___[$i]));
			if (($c = _F_builtin_gcd($m, $a))) {
				$a = \intval(($m * $a) / $c);
			}
		}
		return $a;
	}

	function _F_builtin_gcd(int $m___, int $n___)
	{
		$a = $m___ < 0 ? -($m___) : $m___;
		$b = $n___ < 0 ? -($n___) : $n___;
		$c = $a % $b;
		while($c > 0) { $a = $b; $b = $c; $c = $a % $b; }
		return $b;
	}

	function _F_builtin_ratio_is_integral(int &$num___, int &$den____)
	{ return \intval(($num___ % $den____) === 0); }

	function _F_builtin_ratio_is_real(int &$num___, int &$den____)
	{ return \intval(($num___ % $den____) !== 0); }

	function _F_builtin_ratio_gcd(int &$m___, int &$n___)
	{
		if ($gcd = _F_builtin_gcd($m___, $n___)) {
			$m___ = \intval($m___ / $gcd);
			$n___ = \intval($n___ / $gcd);
		} else {
			_F_throw_overflow_error("Divide by zero error");
		}
	}

	function _F_builtin_ratio_reduce(
		  int &$num1___
		, int &$den1___
		, int &$num2___
		, int &$den2___
	) {
		if ($lcm = _F_builtin_lcm($den1___, $den2___)) {
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