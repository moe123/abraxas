<?php
# -*- coding: utf-8 -*-

//
// scl_basic_iteratable.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xiterator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xcontainer_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xoperator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xutility_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xalgorithm.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_exception.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_utility.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_ios.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_numeric_limits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_type_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_iterator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collation.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_locale.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_functional.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_algorithm.php";
} /* EONS */

namespace std
{
	abstract class basic_iteratable_tag
	{
		const basic_iteratable   = 0;
		const basic_forward_list = 3;
		const basic_seqlist     = 1;
		const basic_vector       = 1;
		const basic_set          = 1;
		const basic_map          = 5;
		const basic_dict         = 9;
	}

	abstract class basic_iteratable
	{
		const container_category = basic_iteratable_tag::basic_iteratable;
	} /* EOC */
} /* EONS */

/* EOF */