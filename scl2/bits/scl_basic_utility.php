<?php
# -*- coding: utf-8 -*-

//
// scl_basic_utility.php
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
	abstract class comparison_result
	{
		const same       = 0;
		const ascending  = -1;
		const descending = 1;
	} /* EOC */

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

	const not_callable = "std<not a callable>";

	/*! callable */
	function null_callable()
	{ return function(...$args) { return not_callable; }; }

	function sizeof($in___)
	{
		if (\is_array($in___)) {
			return \count($in___);
		} else if (is_iteratable($in___)) {
			return $in___->_M_size;
		} else if (is_tuple($in___)()) {
			return tuple_size($in___)();
		} else if (\is_string($in___)) {
			return \strlen($in___);
		} else if (\is_float($in___)) {
			return numeric_limits_float::size;
		} else if (\is_int($in___)) {
			return numeric_limits_int::size;
		}
		return -1;
	}

	function typeof($in___)
	{
		if (\is_resource($in___)) {
			return \get_resource_type($l) == \get_resource_type($r);
		}
		if (\is_object($in___)) {
			return get_class($in___);
		}
		return \gettype($in___);
	}

	function hash($v___)
	{
		return function () use ($v___) {
			if (\is_object($v___) || \is_array($v___)) {
				return \sha1(\serialize($v___));
			}
			if (\is_resource($v___)) {
				return \sha1(print_r($v___, true));
			}
			return \sha1((string)$v___);
		};
	}

	/*! callable */
	function random(int $min___ = 0, int $max___ = 0)
	{
		return function () use ($min___, $max___) {
			if (!$max___) {
				return \mt_rand();
			}
			if ($min___ < 0) {
				$min___ = 0;
			}
			return \mt_rand($min___, $max___);
		};
	}

	/*! callable */
	function urandom(int $min___ = 0, int $max___ = 0)
	{
		return function () use ($min___, $max___) {
			if ($min___ === 0 && $max___ === 0) {
				$min___ = PHP_INT_MIN;
				$max___ = PHP_INT_MAX;
			}
			return \random_int($min___, $max___);
		};
	}

	function tuple_size(object $v___)
	{
		if (\is_object($v___)) {
			if ($v___ instanceof \std\tuple) {
				return $v___->_M_size;
			} else if ($v___ instanceof \std\pair) {
				return 2;
			} else if ($v___ instanceof \std\triad) {
				return 3;
			} else if ($v___ instanceof \std\quad) {
				return 4;
			} else if ($v___ instanceof \std\quint) {
				return 5;
			}
		}
		return -1;
	}

	function get(int $i___, $v___)
	{
		if ($v___ instanceof \std\tuple) {
			if ($v___->_M_size && $i___ < $v___->_M_size) {
				return $v___->_M_container[$i___];
			}
		} else if ($v___ instanceof \std\quint) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $i___ === 2 ? $v___->third : $i___ === 3 ? $v___->fourth : $v___->fifth;
		} else if ($v___ instanceof \std\quad) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $i___ === 2 ? $v___->third : $v___->fourth;
		} else if ($v___ instanceof \std\triad) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $v___->third;
		} else if ($v___ instanceof \std\pair) {
			return $i___ === 0 ? $v___->first : $v___->second;
		}
		return null;
	}

	function apply(callable $f___, tuple $tuple)
	{ return call_user_func_array($f___, $tuple->_M_container); }

	function tuple_cat(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new tuple($args___, true);
		}
		return new tuple;
	}

	function make_timespec(int $sec___, int $nsec___)
	{ return new timespec($sec___, $nsec___); }

	function make_tm(
			  int $tm_sec___
			, int $tm_min___
			, int $tm_hour___
			, int $tm_mday___
			, int $tm_mon___
			, int $tm_year___
			, int $tm_wday___
			, int $tm_yday___
			, int $tm_isdst___
		) {
			return new tm(
				  $tm_sec___
				, $tm_min___
				, $tm_hour___
				, $tm_mday___
				, $tm_mon___
				, $tm_year___
				, $tm_wday___
				, $tm_yday___
				, $tm_isdst___
			);
		}

	function make_collator(string $id___, int $lv___ = collator_level::none)
	{ return new collator($id___, $lv___); }

	function make_locale(string $id___, int $lv___ =  collator_level::none, int $cat___ = locale_category::all)
	{ return new locale($id___, $lv___, $cat___); }

	function make_comparator(callable $f___)
	{ return new comparator($f___); }

	function make_vector(...$args___)
	{ return new vector($args___); }

	function make_set(...$args___)
	{ return new set($args___); }

	function make_seqlist(...$args___)
	{ return new seqlist($args___); }

	function make_tuple(...$args___)
	{ return new tuple($args___); }

	function make_dict(...$args___)
	{ return new dict($args___); }

	function make_pair($a1___, $a2___)
	{ return new pair($a1___, $a2___); }

	function make_triad($a1___, $a2___, $a3___)
	{ return new triad($a1___, $a2___, $a3___); }

	function make_quad($a1___, $a2___, $a3___, $a4___)
	{ return new quad($a1___, $a2___, $a3___, $a4___); }

	function make_quint($a1___, $a2___, $a3___, $a4___, $a5___)
	{ return new quint($a1___, $a2___, $a3___, $a4___, $a5___); }
} /* EONS */

/* EOF */