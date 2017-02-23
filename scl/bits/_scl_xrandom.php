<?php
# -*- coding: utf-8 -*-

//
// _scl_xrandom.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xunistd.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xiterator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xcontainer_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xoperator_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xutility_traits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xalgorithm.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_exception.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_numeric_limits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_type_traits.php";
} /* EONS */

namespace std
{
	function _F_builtin_random_slot(float &$ent___)
	{
		static $_S_dev = null;
		if (\is_null($_S_dev)) {
			if (function_exists('\random_bytes')) {
				$_S_dev[] = '\random_bytes';
				$_S_dev[] = 32.0;
			} else if (function_exists('\mcrypt_create_iv')) {
				$_S_dev[] = '\mcrypt_create_iv';
				$_S_dev[] = 32.0;
			} else if (function_exists('\openssl_random_pseudo_bytes')) {
				$_S_dev[] = '\openssl_random_pseudo_bytes';
				$_S_dev[] = 4.0;
			}
		}
		$ent___ = $_S_dev[1];
		return  $_S_dev[0];
	}

	function _F_builtin_random()
	{ return \mt_rand(0, 0x7FFFFFFE); }

	function _F_builtin_random_u(int $upb___)
	{
		$x = \abs($upb___) + 1;
		$r = _F_builtin_random() % $x;
		$i = 0;
		while($r >= $x) {
			$r = _F_builtin_random() % $x;
		}
		return $r;
	}

	function _F_builtin_random01()
	{ return ( _F_builtin_random_u(0x7FFFFFFE) / 0x7FFFFFFE) * 1.0; }

	function _F_builtin_random11()
	{ return (2.0 * ( _F_builtin_random_u(0x7FFFFFFE) / 0x7FFFFFFE)) - 1.0; }

	function xrandom(int $min___ = 0, int $max___ = 0, int $seed___ = 0)
	{
		if ($seed___ != 0) {
			\mt_srand($seed);
		} else {
			\mt_srand();
		}
		if (!$max___) {
			return \mt_rand();
		}
		if ($min___ < 0) {
			$min___ = 0;
		}
		if ($max___ > \mt_getrandmax()) {
			$max___ = \mt_getrandmax();
		}
		if ($max___ < $min___) {
			 _F_builtin_throw_invalid_argument("Invalid argument error");
		}
		return \mt_rand($min___, $max___);
	}

	function xrandom_u(int $min___ = 0, int $max___ = 0)
	{
		if ($min___ === 0 && $max___ === 0) {
			$min___ = numeric_limits_int::min;
			$max___ = numeric_limits_int::max;
		}
		return \random_int($min___, $max___);
	}

	function xrandom_u_real(float $min___ = 0.0, float $max___ = 1.0)
	{ return $min___ + (\mt_rand() / \mt_getrandmax()) * ($max___ - $min___); }

	function random()
	{ return _F_builtin_random(); }
} /* EONS */

/* EOF */