<?php
# -*- coding: utf-8 -*-

//
// scl_numeric_limits.php
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
	abstract class numeric_limits_float
	{
		const epsilon = BUILTIN_FLT_EPSILON;
		const size    = BUILTIN_FLT_SIZE;
		const max     = BUILTIN_FLT_MAX;
		const lowest  = BUILTIN_FLT_LOWEST;
		const min     = BUILTIN_FLT_MIN;
	}

	abstract class numeric_limits_double extends numeric_limits_float
	{ /* NOP */ }

	abstract class numeric_limits_int
	{
		const epsilon = BUILTIN_SINT_EPSILON;
		const size    = BUILTIN_SINT_SIZE;
		const max     = BUILTIN_SINT_MAX;
		const lowest  = BUILTIN_SINT_LOWEST;
		const min     = BUILTIN_SINT_MIN;
	}

	abstract class numeric_limits_long extends numeric_limits_int
	{ /* NOP */ }
} /* EONS */

/* EOF */