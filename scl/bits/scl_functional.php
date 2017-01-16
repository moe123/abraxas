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
	final class comparator
	{
		var $_M_f;

		function __invoke($l, $r)
		{ return $this->_M_f($l, $r); }

		function __construct(callable $f)
		{ $this->_M_f = $f; }

		function & swap(comparator &$comparator)
		{
			$f = $this->_M_f;
			$this->_M_f = $comparator->_M_f;
			$comparator->_M_f = $f;
			return $this;
		}
	} /* EOC */

	function greater(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) > func_get_arg(1);
		};
	}

	function less(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) < func_get_arg(1);
		};
	}

	function minus(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) - func_get_arg(1);
		};
	}

	function plus(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) + func_get_arg(1);
		};
	}

	function equal_to(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) === func_get_arg(1);
		};
	}

	function greater_equal(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) >= func_get_arg(1);
		};
	}

	function less_equal(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) <= func_get_arg(1);
		};
	}

	function not_equal_to(callable $f___ = null)
	{
		return function () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			return func_get_arg(0) !== func_get_arg(1);
		};
	}

	function & assign_to(callable $f___ = null)
	{
		return function & () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			$l = &func_get_arg(0);
			$l = func_get_arg(1);
			return $l;
		};
	}

	function & copy_to(callable $f___ = null)
	{
		return function & () use ($f___) {
			if (!\is_null($f___)) {
				return $f___(func_get_arg(0), func_get_arg(1));
			}
			$l = &func_get_arg(0);
			$r = func_get_arg(1);

			if (\is_object($r___)) {
				$l = clone $r;
			} else {
				$l = $r;
			}
			return $l;
		};
	}

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

	function bond($cls___, string $f___)
	{ return [$cls___, $f___]; }

	function bind(callable $f___, ...$args___)
	{
		return function () use ($f___, $args___) {
			if (\is_array($args___) && \count($args___)) {
				return $f___(...$args___);
				//return call_user_func_array($f___, $args___);
			}
			return $f___();
		};
	}

	function invoke(callable $f___, ...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return $f___(...$args___);
			//return call_user_func_array($f___, $args___);
		}
		return $f___();
	}

	function not1(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0));
		};
	}

	function not2(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0), func_get_arg(1));
		};
	}

	function not_fn(callable $f___)
	{
		return function () use ($f___) {
			return !call_user_func_array($f___, func_get_args());
		};
	}

	function count_args(callable $f___)
	{
		$r = \is_array($f___) ? new \ReflectionMethod($f___[0], $f___[1]) : new \ReflectionFunction($f___);
		return $r->getNumberOfParameters();
	}

	function is_unary_function(callable $f___)
	{ return count_args() == 1; }

	function is_binary_function(callable $f___)
	{ return count_args() == 2; }
} /* EONS */

/* EOF */