<?php
# -*- coding: utf-8 -*-

//
// vector.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

declare(strict_types=1);

namespace
{
	
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_base_iterator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_iterator.php";
}

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_basic_iteratable.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_basic_vector.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_vector.php";

	$v = std\make_vector(0, 1 ,2);
	std\place_fill_n(
		  std\front_inserter($v)
		, 5
		, 8
	);

	std\place_generate_n(
		  std\front_inserter($v)
		, 5 
		, std\urandom(100,200)
	);

	std\place_generate_n(
		  std\back_inserter($v)
		, 5 
		, std\urandom(300,500)
	);

	std\cout($v);

	function fn(int $one, string $two, float $three, int $foor) { 
		std\cerr(
			  $one 
			. std\endl
			. $two
			. std\endl
			. $three
			. std\endl
			. $foor
			. std\endl
		);
	}

	$fn = std\bind(
		std\bond1('fn')
		, std\placeholders::_1
		, "hello"
		, std\placeholders::_3
		, -123
	);

	std\invoke($fn, 1, 0.8);
	std\invoke($fn, 4, -0.1333);

} /* EONS */

/* EOF */