<?php
# -*- coding: utf-8 -*-

//
// scl_basic_ratio.php
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

	abstract class basic_ratio_tag
	{
		const basic_base  = 0;
		const basic_const = 1;
	}

	abstract class basic_ratio
	{
		const container_category = basic_ratio_tag::basic_base;

		const num = 0;
		const den = 0;
		const mir = 0;

		function num()
		{ return static::num; }

		function den()
		{ return static::den; }

		function mir()
		{ return static::mir; }

	} /* EOC */

	final class _C_ratio_unum extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1;
		const mir = 1;
	} /* EOC */

	final class _C_ratio_atto extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000000000000000000;
		const mir = 0.000000000000000001;
	} /* EOC */

	final class _C_ratio_femto extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000000000000000;
		const mir = 0.000000000000001;
	} /* EOC */

	final class _C_ratio_pico extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000000000000;
		const mir = 0.000000000001;
	} /* EOC */

	final class _C_ratio_nano extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000000000;
		const mir = 0.000000001;
	} /* EOC */

	final class _C_ratio_micro extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000000;
		const mir = 0.000001;
	} /* EOC */

	final class _C_ratio_milli extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 1000;
		const mir = 0.001;
	} /* EOC */

	final class _C_ratio_centi extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 100;
		const mir = 0.01;
	} /* EOC */

	final class _C_ratio_deci extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1;
		const den = 10;
		const mir = 0.1;
	} /* EOC */

	final class _C_ratio_deca extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 10;
		const den = 1;
		const mir = 10;
	} /* EOC */

	final class _C_ratio_hecto extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 100;
		const den = 1;
		const mir = 100;
	} /* EOC */

	final class _C_ratio_kilo extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000;
		const den = 1;
		const mir = 1000;
	} /* EOC */

	final class _C_ratio_mega extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000000;
		const den = 1;
		const mir = 1000000;
	} /* EOC */

	final class _C_ratio_giga extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000000000;
		const den = 1;
		const mir = 1000000000;
	} /* EOC */

	final class _C_ratio_tera extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000000000000;
		const den = 1;
		const mir = 1000000000000;
	} /* EOC */

	final class _C_ratio_peta extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000000000000000;
		const den = 1;
		const mir = 1000000000000000;
	} /* EOC */

	final class _C_ratio_exa extends basic_ratio
	{
		const container_category = basic_ratio_tag::basic_const;

		const num = 1000000000000000000;
		const den = 1;
		const mir = 1000000000000000000;
	} /* EOC */
} /* EONS */

/* EOF */