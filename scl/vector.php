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

	$v = std\make_vector();
	std\place_generate_n(
		  std\back_inserter($v)
		, 10 
		, function () {return std\urandom(0,200); }
	);
	std\cout($v);

} /* EONS */

/* EOF */