<?php
# -*- coding: utf-8 -*-

//
// scl_type_traits.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	function is_null($v__)
	{ return \is_null($v__) || (\is_string($v__) && $v__ === ignore); }

	function is_integral($v__)
	{
		if (\is_object($v__) && ($v__ instanceof \std\basic_ratio)) {
			return (($v__->num() % $v__->$den()) === 0);
		}
		return \is_integer($v__);
	}

	function is_floating_point($v__)
	{
		if (($v__ instanceof \std\basic_ratio)) {
			return (($v__->num() % $v__->$den()) !== 0);
		}
		return \is_float($v__);
	}

	function is_array($v__)
	{ return \is_array($v__) || ($v__ instanceof \std\basic_iterable); }

	function is_string($v__)
	{ return \is_string($v__) || ($v__ instanceof \std\u8string); }

	function is_object($v__)
	{ return \is_object($v__); }

	function is_callable($v__)
	{
		if (\is_string($v__) && $v__ == ignore) {
			return false;
		}
		return \is_callable($v__);
	}

	function is_scalar($v__)
	{ return \is_scalar($v__); }

	function is_function($v__)
	{ return (\is_string($v__) && \function_exists($v__)) || (\is_object($v__) && ($v__ instanceof Closure)); }

	function is_arithmetic($v__)
	{ return \is_float($v__) || \is_integer($v__) || \is_bool($v__); }

	function is_compound($v__)
	{ return \is_resource($v__) || is_function($v__) || \is_object($v__) || \is_callable($v__); }

	function is_tuple($v__)
	{
		return (
				$v__ instanceof \std\tuple
			|| $v__ instanceof \std\pair
			|| $v__ instanceof \std\triad
			|| $v__ instanceof \std\quad
			|| $v__ instanceof \std\quint
		);
	}
	
	function is_countable($v__)
	{ return \is_array($v__) || ($v__ instanceof \Countable); }

	function is_iterable($v__)
	{ return ($v__ instanceof \std\basic_iterable); }

	function is_same($l, $r) {
		if (\is_resource($l) && \is_resource($r)) {
			return \get_resource_type($l) == \get_resource_type($r);
		}
		return \gettype($l) == \gettype($r);
	}
} /* EONS */

/* EOF */