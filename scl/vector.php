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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_basic_iteratable.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_basic_vector.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "bits" . DIRECTORY_SEPARATOR . "scl_vector.php";

	$delay = std\make_timespec(1, 50000000);
	
	print_r(std\nanosleep($delay));

	function foo()
	{ std\assert(3 == 2); }

	$v = std\make_vector(0, 1 ,2);
	std\place_fill_n(
		  std\front_inserter($v)
		, 5
		, 8
	);

	foo();

	std\assert(2 == 2);

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

	function fn(int $one, string $two, bool $three, int $four) { 
		std\cerr($one, std\ios_base::hex)(std\endl)
			($two)(std\endl)
				($three, std\ios_base::alpha)(std\endl)
				($three)(std\endl)
					($four, std\ios_base::fixed)(std\endl);
	}

	$fn = std\bind(
		std\bond1('fn')
		, std\placeholders::_1
		, "hello"
		, std\placeholders::_3
		, 0.00000099988888888
	);

	std\invoke($fn, 16, 0.8);
	std\invoke($fn, 4, 0);

	std\cerr(std\EPROCLIM);

	//\ini_set('log_errors', "1");
	//\ini_set('display_errors', "1");

	$f1 = fopen('php://memory', 'w+');
	fwrite($f1, 'foo1');
	fwrite($f1, 'bar1');

	$f2 = fopen('php://memory', 'w+');
	fwrite($f2, 'foo2');
	fwrite($f2, 'bar2');
	
	rewind($f1);
	$contents = stream_get_contents($f1);	
	print_r(stream_get_meta_data($f1));
	print_r(get_resource_type($f1));
	echo "\n" . $contents . "\n";
	fclose($f1);

	rewind($f2);
	$contents = stream_get_contents($f2);
	print_r(stream_get_meta_data($f2));
	print_r(get_resource_type($f2));
	echo "\n" . $contents . "\n";
	fclose($f2);

} /* EONS */

/* EOF */