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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_iterator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_container_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_operator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_utility_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_algorithm.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_exception.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_ios.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_numeric_limits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_type_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_iterator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collation.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_locale.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_functional.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_algorithm.php";


	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_set.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_set.php";
} /* EONS */

namespace std
{
	abstract class comparison_result
	{
		const same       = 0;
		const ascending  = -1;
		const descending = 1;
	}

	function sizeof($in___)
	{
		if (is_array($in___)) {
			return \count($in___);
		} else if (\is_string($in___)) {
			return \strlen($in___);
		} else if (\is_float($in___)) {
			return numeric_limits_float\size;
		} else if (\is_int($in___)) {
			return numeric_limits_int\size;
		}
		return 0;
	}

	function hash($v___)
	{
		if (!\is_resource($v___)) {
			return \sha1(\serialize($v___));
		}
		return $v___;
	}

	function rand(int $min = 0, int $max = 0)
	{
		if ($min < 0) {
			$min = 0;
		}
		if (!$max) {
			 $max = mt_getrandmax();
		}
		return mt_rand($min, $max);
	}

	function tuple_size(object $o___)
	{
		if ($o___ instanceof \std\tuple) {
			return $o___->_M_size;
		} else if ($o___ instanceof \std\pair) {
			return 2;
		} else if ($o___ instanceof \std\triad) {
			return 3;
		} else if ($o___ instanceof \std\quad) {
			return 4;
		} else if ($o___ instanceof \std\quint) {
			return 5;
		}
	}

	function get(int $i___, object $o___)
	{
		if ($o___ instanceof \std\tuple) {
			if (isset($o___->_M_container[$i___])) {
				return $o___->_M_container[$i___];
			}
		} else if ($o___ instanceof \std\quint) {
			return $i___ === 0 ? $o___->first : $i___ === 1 ? $o___->second : $i___ === 2 ? $o___->third : $i___ === 3 ? $o___->fourth : $o___->fifth;
		} else if ($o___ instanceof \std\quad) {
			return $i___ === 0 ? $o___->first : $i___ === 1 ? $o___->second : $i___ === 2 ? $o___->third : $o___->fourth;
		} else if ($o___ instanceof \std\triad) {
			return $i___ === 0 ? $o___->first : $i___ === 1 ? $o___->second : $o___->third;
		} else if ($o___ instanceof \std\pair) {
			return $i___ === 0 ? $o___->first : $o___->second;
		}
		return null;
	}

	function make_collator(string $id___, int $lv___ = collator_level::none)
	{ return new collator($id___, $lv___); }

	function make_locale(string $id___, int $lv___ =  collator_level::none, int $cat___ = locale_category::all)
	{ return new locale($id___, $lv___, $cat___); }

	function make_comparator(callable $f___)
	{ return new comparator($f___); }

	function make_vector(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new vector($args___);
		}
		return new vector;
	}

	function make_set(callable $binaryPredicate___, ...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new set($binaryPredicate___, $args___);
		}
		if($binaryPredicate() !== not_callable) {
			return new set($binaryPredicate___);
		}
		return new set;
	}

	make_set(null_callable(), 1, 2, 3, 4, 5, 6);

	function make_seq_list(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new seq_list($args___);
		}
		return new seq_list;
	}

	function make_tuple(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new tuple($args___);
		}
		return new tuple;
	}

	function make_dict(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new dict($args___);
		}
		return new dict;
	}

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