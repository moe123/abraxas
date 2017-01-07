<?php
# -*- coding: utf-8 -*-

//
// scl_type_traits.php
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
	function is_null($v__)
	{ return \is_null($v__); }

	function is_integral($v__)
	{ return \is_integer($v__); }

	function is_floating_point($v__)
	{ return \is_float($v__); }

	function is_array($v__)
	{ return \is_array($v__) || (\is_object($v__) && ($v__ instanceof \std\basic_iteratable)); }

	function is_string($v__)
	{ return \is_string($v__) || (\is_object($v__) && ($v__ instanceof \std\u8string)); }

	function is_object($v__)
	{ return \is_object($v__); }

	function is_callable($v__)
	{ return \is_callable($v__); }

	function is_scalar($v__)
	{ return \is_scalar($v__); }

	function is_function($v__)
	{ return (\is_string($v__) && \function_exists($v__)) || (\is_object($v__) && ($v__ instanceof Closure)); }

	function is_arithmetic($v__)
	{ return \is_float($v__) || \is_integer($v__); }

	function is_compound($v__)
	{ return \is_resource($v__) || is_function($v__) || \is_object($v__) || \is_callable($v__); }

} /* EONS */

/* EOF */