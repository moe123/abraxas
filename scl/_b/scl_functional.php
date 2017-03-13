<?php
# -*- coding: utf-8 -*-

//
// scl_functional.php
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
	const greater       = '\std\greater';
	const less          = '\std\less';
	const multiplies    = '\std\multiplies';
	const divides       = '\std\divides';
	const modulus       = '\std\modulus';
	const negate        = '\std\negate';
	const minus         = '\std\minus';
	const plus          = '\std\plus';
	const equal_to      = '\std\equal_to';
	const greater_equal = '\std\greater_equal';
	const less_equal    = '\std\less_equal';
	const not_equal_to  = '\std\not_equal_to';

	/*! callable */
	function greater(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) > 0;
			}
			return $l > $r;
		};
	}
	
	/*! callable */
	function less(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) < 0;
			}
			return $l < $r;
		};
	}

	/*! callable */
	function multiplies(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) * func_get_arg(1);
		};
	}

	/*! callable */
	function divides(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) / func_get_arg(1);
		};
	}

	/*! callable */
	function modulus(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) % func_get_arg(1);
		};
	}

	/*! callable */
	function negate(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0));
			}
			return -(func_get_arg(0));
		};
	}

	/*! callable */
	function minus(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) - func_get_arg(1);
		};
	}

	/*! callable */
	function plus(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) + func_get_arg(1);
		};
	}

	/*! callable */
	function equal_to(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) == 0;
			}
			return $l == $r;
		};
	}

	/*! callable */
	function greater_equal(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) >= 0;
			}
			return $l >= $r;
		};
	}

	/*! callable */
	function less_equal(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) <= 0;
			}
			return $l <= $r;
		};
	}

	/*! callable */
	function not_equal_to(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r)) != 0;
			}
			return $l != $r;
		};
	}

	/*! callable */
	function logical_cmp(callable $f___ = null)
	{
		return function () use ($f___) {
			$l = func_get_arg(0);
			$r = func_get_arg(0);
			if (!\is_null($f___)) {
				return $f___($l, $r);
			}
			if (is_string($l) || is_string($r)) {
				return \strcmp(\strval($l), \strval($r));
			}
			if ($l < $r) {
				return comparison_result::ascending;
			}
			if ($l > $r) {
				return comparison_result::descending;
			}
			return comparison_result::same;
		};
	}

	/*! callable */
	function logical_and(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) && func_get_arg(1);
		};
	}

	/*! callable */
	function logical_or(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) || func_get_arg(1);
		};
	}

	/*! callable */
	function logical_not(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0));
			}
			return !(func_get_arg(0));
		};
	}

	/*! callable */
	function & pre_increment(callable $f___ = null)
	{
		return function & () use ($f___) {
			$step = 1;
			if (func_num_args() == 2) {
				$step = func_get_arg(1);
			}
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), $step);
			}
			$p = &func_get_arg(0);
			$i = 0;
			while ($i < $step) {
				++$p;
				++$i;
			}
			return $p;
		};
	}

	/*! callable */
	function & post_increment(callable $f___ = null)
	{
		return function & () use ($f___) {
			$step = 1;
			if (func_num_args() == 2) {
				$step = func_get_arg(1);
			}
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), $step);
			}
			$p = &func_get_arg(0);
			$i = 0;
			while ($i < $step) {
				$p++;
				++$i;
			}
			return $p;
		};
	}

	/*! callable */
	function & pre_decrement(callable $f___ = null)
	{
		return function & () use ($f___) {
			$step = 1;
			if (func_num_args() == 2) {
				$step = func_get_arg(1);
			}
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), $step);
			}
			$p = &func_get_arg(0);
			$i = 0;
			while ($i < $step) {
				--$p;
				++$i;
			}
			return $p;
		};
	}

	/*! callable */
	function & post_decrement(callable $f___ = null)
	{
		return function & () use ($f___) {
			$step = 1;
			if (func_num_args() == 2) {
				$step = func_get_arg(1);
			}
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), $step);
			}
			$p = &func_get_arg(0);
			$i = 0;
			while ($i < $step) {
				$p--;
				++$i;
			}
			return $p;
		};
	}

	abstract class placeholders
	{
		const _1  = "^std@_0";
		const _2  = "^std@_1";
		const _3  = "^std@_2";
		const _4  = "^std@_3";
		const _5  = "^std@_4";
		const _6  = "^std@_5";
		const _7  = "^std@_6";
		const _8  = "^std@_7";
		const _9  = "^std@_8";
		const _10 = "^std@_9";
		const _11 = "^std@_10";
		const _12 = "^std@_11";
		const _13 = "^std@_12";
		const _14 = "^std@_13";
		const _15 = "^std@_14";
		const _16 = "^std@_15";
		const _17 = "^std@_16";
		const _18 = "^std@_17";
		const _19 = "^std@_18";
		const _20 = "^std@_19";
	};

	function bond(string $fn___, $cls___ = null)
	{
		if (\is_null($cls___)) {
			return $fn___;
		}
		return [$cls___, $fn___];
	}

	/*! callable */
	function bind(callable $f___, ...$args___)
	{
		return function () use ($f___, $args___) {
			if (($argc = func_num_args())) {
				if (\preg_grep('/^' . \preg_quote("^std@_", '/') . '/', $args___)) {
					for ($i = 0, $j = 0 ; $i < \count($args___), $j < $argc; ++$i) {
						if ($args___[$i] === "^std@_" . $i) {
							$args___[$i] = func_get_arg($j);
						} else {
							$j++;
						}
					}
				}
			}
			if (\preg_grep('/^' . \preg_quote("^std@_", '/') . '/', $args___)) {
				_F_throw_invalid_argument("Placeholder error");
			}
			return call_user_func_array($f___, $args___);
		};
	}

	function invoke(callable $f___, ...$args___)
	{
		try {
			return $f___(...$args___);
		} catch(\Throwable $ex) {
			_X_throw_error("Invocation failure : ". $ex->getMessage());
		};
		return null;
	}

	function invoke_v(callable $f___, array &$args___) 
	{
		try {
			return $f___(...$args___);
		} catch(\Throwable $ex) {
			_X_throw_error("Invocation failure : ". $ex->getMessage());
		};
		return null;
	}

	function unary_negate(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0));
		};
	}

	function binary_negate(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0), func_get_arg(1));
		};
	}

	function not1(callable $f___)
	{ return unary_negate($f___); }

	function not2(callable $f___)
	{ return binary_negate($f___); }

	function not_fn(callable $f___)
	{
		return function () use ($f___) {
			return !call_user_func_array($f___, func_get_args());
		};
	}

	function count_args(callable $f___)
	{
		return function () use ($f___) {
			$r = \is_array($f___) ? new \ReflectionMethod($f___[0], $f___[1]) : new \ReflectionFunction($f___);
			return $r->getNumberOfParameters();
		};
	}

	function is_unary_function(callable $f___)
	{
		return function () use ($f___) {
			return count_args($f___)() == 1;
		};
	}

	function is_binary_function(callable $f___)
	{
		return function () use ($f___) {
			return count_args($f___)() == 2;
		};
	}
} /* EONS */

/* EOF */