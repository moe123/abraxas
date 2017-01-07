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

	function tuple_size(object $o___)
	{
		if ($obj instanceof \std\tuple) {
			return $o___->_M_size;
		} else if ($obj instanceof \std\pair) {
			return 2;
		} else if ($obj instanceof \std\triad) {
			return 3;
		} else if ($obj instanceof \std\quad) {
			return 4;
		} else if ($obj instanceof \std\quint) {
			return 5;
		}
	}

	function get(int $i___, object $o___)
	{
		if ($obj instanceof \std\tuple) {
			if (isset($o___->_M_container[$i___])) {
				return $o___->_M_container[$i___];
			}
		} else if ($obj instanceof \std\quint) {
			return $i___ === 0 ? $obj->first : $i___ === 1 ? $obj->second : $i___ === 2 ? $obj->third : $i___ === 3 ? $obj->fourth : $obj->fifth;
		} else if ($obj instanceof \std\quad) {
			return $i___ === 0 ? $obj->first : $i___ === 1 ? $obj->second : $i___ === 2 ? $obj->third : $obj->fourth;
		} else if ($obj instanceof \std\triad) {
			return $i___ === 0 ? $obj->first : $i___ === 1 ? $obj->second : $obj->third;
		} else if ($obj instanceof \std\pair) {
			return $i___ === 0 ? $obj->first : $obj->second;
		}
		return null;
	}

	function make_vector(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new vector($args___);
		}
		return new vector;
	}

	function make_seq(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new seq($args___);
		}
		return new seq;
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

	function make_pair($first, $second)
	{ return new pair($first, $second); }

	function make_triad($first, $second, $third)
	{ return new triad($first, $second, $third); }

	function make_quad($first, $second, $third, $fourth)
	{ return new quad($first, $second, $third, $fourth); }

	function make_quint($first, $second, $third, $fourth, $fifth)
	{ return new quint($first, $second, $third, $fourth, $fifth); }
} /* EONS */

/* EOF */