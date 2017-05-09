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
		const epsilon  = FLT_EPSILON;
		const size     = FLT_SIZE;
		const max      = FLT_MAX;
		const lowest   = FLT_LOWEST;
		const min      = FLT_MIN;
		const infinity = INFINITY;
		const digits   = FLT_MANT_DIG;
	} /* EOC */

	abstract class numeric_limits_double extends numeric_limits_float
	{ /* NOP */ }

	abstract class numeric_limits_int
	{
		const epsilon  = SINT_EPSILON;
		const size     = SINT_SIZE;
		const max      = SINT_MAX;
		const lowest   = SINT_LOWEST;
		const min      = SINT_MIN;
		const infinity = INFINITY;
		const digits   = (SINT_SIZE >= 8 ? (64 - 1) : (32 - 1));
	} /* EOC */

	abstract class numeric_limits_long extends numeric_limits_int
	{ /* NOP */ }
} /* EONS */

/* EOF */