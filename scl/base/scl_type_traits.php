<?php
# -*- coding: utf-8, tab-width: 3 -*-

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
	const string_type     = "string";
	const array_type      = "array";
	const object_type     = "object";
	const resource_type   = "resource";
	const null_type       = "NULL";
	const int_type        = "int";
	const long_type       = "int";
	const difference_type = "int";
	const bool_type       = "boolean";
	const size_type       = "int";
	const float_type      = "double";
	const double_type     = "double";

	function is_null($v___)
	{ return \is_null($v___) || (\is_string($v___) && $v___ === ignore); }

	function is_integral($v___)
	{
		if (\is_object($v___) && ($v___ instanceof \std\basic_ratio)) {
			return (($v___->num() % $v___->$den()) === 0);
		}
		return \is_integer($v___);
	}

	function is_floating_point($v___)
	{
		if (($v___ instanceof \std\basic_ratio)) {
			return (($v___->num() % $v___->$den()) !== 0);
		}
		return \is_float($v___);
	}

	function is_array($v___)
	{ return \is_array($v___) || ($v___ instanceof \std\basic_iterable); }

	function is_string($v___)
	{ return \is_string($v___) || ($v___ instanceof \std\u8string); }

	function is_object($v___)
	{ return \is_object($v___); }

	function is_callable($v___)
	{
		if (\is_string($v___) && $v___ == ignore) {
			return false;
		}
		return \is_callable($v___);
	}

	function is_scalar($v___)
	{ return \is_scalar($v___); }

	function is_function($v___)
	{ return (\is_string($v___) && \function_exists($v___)) || (\is_object($v___) && ($v___ instanceof Closure)); }

	function is_arithmetic($v___)
	{ return \is_float($v___) || \is_integer($v___) || \is_bool($v___); }

	function is_compound($v___)
	{ return \is_resource($v___) || is_function($v___) || \is_object($v___) || \is_callable($v___); }

	function is_tuple($v___)
	{
		return (
				$v___ instanceof \std\tuple
			|| $v___ instanceof \std\pair
			|| $v___ instanceof \std\triad
			|| $v___ instanceof \std\quad
			|| $v___ instanceof \std\quint
		);
	}

	function is_pod($v___)
	{ return \is_scalar($v___); }

	function is_signed($v___)
	{ return (\is_numeric($v___) && (strval($v___)[0] == '-' || strval($v___)[0] == '+')); }

	function is_unsigned($v___)
	{ return !(is_signed($v___)); }

	function is_abstract($v___)
	{
		if (\is_object($v___)) {
			$rc = new \ReflectionClass($v___);
			return $rc->isAbstract();
		}
		return false;
	}
	
	function is_countable($v___)
	{ return \is_array($v___) || ($v___ instanceof \Countable); }

	function is_iterable($v___)
	{ return ($v___ instanceof \std\basic_iterable); }

	function is_same($l, $r) {
		if (\is_resource($l) && \is_resource($r)) {
			return \get_resource_type($l) == \get_resource_type($r);
		}
		return \gettype($l) == \gettype($r);
	}
} /* EONS */

/* EOF */