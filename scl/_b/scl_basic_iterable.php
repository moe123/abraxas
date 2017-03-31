<?php
# -*- coding: utf-8 -*-

//
// scl_basic_iterable.php
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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_utility.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_iterator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_ios.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_iterator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collation.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_locale.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_functional.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_algorithm.php";
} /* EONS */

namespace std
{
	abstract class basic_iterable_tag
	{
		const basic_iterable   = 0;
		const basic_forward_list = 3;
		const basic_ordered_list = 1;
		const basic_ordered_set  = 1;
		const basic_vector       = 1;
		const basic_irange       = 1;
		const basic_u8string     = 5;
		const basic_ordered_map  = 7;
		const basic_dict         = 9;
		const basic_tuple        = 10;
	}

	abstract class basic_iterable
	{
		const container_category = basic_iterable_tag::basic_iterable;
	} /* EOC */
} /* EONS */

/* EOF */