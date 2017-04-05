<?php
# -*- coding: utf-8 -*-

//
// scl_basic_ratio.php
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
	abstract class basic_ratio_tag
	{
		const basic_ratio = 0;
		const const_ratio = 1;
	}

	abstract class basic_ratio
	{
		const container_category = basic_ratio_tag::basic_ratio;

		const num = 0;
		const den = 0;
		const mir = 0.0;

		function num()
		{ return static::num; }

		function den()
		{ return static::den; }

		function mir()
		{ return static::mir; }

	} /* EOC */

	final class _C_ratio_unum extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1;
		const mir = 1.0;
	} /* EOC */

	final class _C_ratio_atto extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000000000000000000;
		const mir = 0.000000000000000001;
	} /* EOC */

	final class _C_ratio_femto extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000000000000000;
		const mir = 0.000000000000001;
	} /* EOC */

	final class _C_ratio_pico extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000000000000;
		const mir = 0.000000000001;
	} /* EOC */

	final class _C_ratio_nano extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000000000;
		const mir = 0.000000001;
	} /* EOC */

	final class _C_ratio_micro extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000000;
		const mir = 0.000001;
	} /* EOC */

	final class _C_ratio_milli extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 1000;
		const mir = 0.001;
	} /* EOC */

	final class _C_ratio_centi extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 100;
		const mir = 0.01;
	} /* EOC */

	final class _C_ratio_deci extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1;
		const den = 10;
		const mir = 0.1;
	} /* EOC */

	final class _C_ratio_deca extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 10;
		const den = 1;
		const mir = 10.0;
	} /* EOC */

	final class _C_ratio_hecto extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 100;
		const den = 1;
		const mir = 100.0;
	} /* EOC */

	final class _C_ratio_kilo extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000;
		const den = 1;
		const mir = 1000.0;
	} /* EOC */

	final class _C_ratio_mega extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000000;
		const den = 1;
		const mir = 1000000.0;
	} /* EOC */

	final class _C_ratio_giga extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000000000;
		const den = 1;
		const mir = 1000000000.0;
	} /* EOC */

	final class _C_ratio_tera extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000000000000;
		const den = 1;
		const mir = 1000000000000.0;
	} /* EOC */

	final class _C_ratio_peta extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000000000000000;
		const den = 1;
		const mir = 1000000000000000.0;
	} /* EOC */

	final class _C_ratio_exa extends basic_ratio
	{
		const container_category = basic_ratio_tag::const_ratio;

		const num = 1000000000000000000;
		const den = 1;
		const mir = 1000000000000000000.0;
	} /* EOC */
} /* EONS */

/* EOF */