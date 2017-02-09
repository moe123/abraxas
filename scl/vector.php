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

	$buf = "";
	$tm0 = std\gmtime(std\time());
	if (std\strftime($buf, "%d.%m.%Y.%z", $tm0)) {
		print_r($tm0);
		$tm1 = std\make_tm();
		if (null != std\strptime($buf, "%d.%m.%Y.%z", $tm1)) {
			print_r($tm1);
		}
	}


	std\abort();

	$fmt___ = "%P %P %P %%P %P %";
	$i = 0;
	while (isset($fmt___[$i])) {
		if (
			   $i == 0
			&& $fmt___[$i] == "%"
			&& $fmt___[$i + 1] == "P"
		) {
			$fmt___[$i + 1] = "p";
		} else if (
			   isset($fmt___[$i + 1])
			&& $fmt___[$i] == "%"
			&& $fmt___[$i + 1] == "P"
			&& $fmt___[$i - 1] != "%"
		) {
			$fmt___[$i + 1] = "p";
		}
		++$i;
	}
	print_r("\n");
	print_r($fmt___ . "\n");

	std\abort();

	$delay = std\make_timespec(0, 50000000);
	
	print_r(std\nanosleep($delay));
	print_r(std\endl);
	print_r(std\tzset());
	print_r(std\endl);
	print_r(std\gmtime(std\time()));
	print_r(std\endl);
	print_r(std\localtime(std\time()));
	print_r(std\endl);

	function trap()
	{ std\assert(3 == 2); }
	// trap();
	std\assert(2 == 2);

	$v = std\make_vector(0, 1 , 2);
	std\place_fill_n(
		  std\front_inserter($v)
		, 5
		, 8
	);

	std\place_generate_n(
		  std\front_inserter($v)
		, 5
		, std\random_int_generator(100, 200)
	);

	std\place_generate_n(
		  std\back_inserter($v)
		, 5
		, std\random_int_generator(-300, 500)
	);

	std\place_generate_n(
		  std\back_inserter($v)
		, 8
		, std\random_real_generator(-1.2, 1.3)
	);

	std\cout($v);

	std\abort();

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

	$sv = std\make_vector(1, 2, 3, 4, 5);
	$pv = std\find($sv->begin(), $sv->end(), 3);
	$dv = std\make_vector();
	std\rotate_copy(
		  $sv->begin()
		, $pv
		, $sv->end()
		, std\back_inserter($dv)
	);
	std\cout($dv)(std\endl);
} /* EONS */

/* EOF */