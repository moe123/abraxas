<?php
# -*- coding: utf-8 -*-

//
// xrandom.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	const random_upper_bound  = '\std\random_upper_bound';
	const random_real_01      = '\std\random_real_01';
	const random_real_11      = '\std\random_real_11';

	const random              = '\std\random';
	const random_uniform_int  = '\std\random_uniform_int';
	const random_uniform_real = '\std\random_uniform_real';

	function _X_random_dev_1(int $nbytes___)
	{
		if (_X_os_nix() && $nbytes___ > 0) {
			$fp = @\fopen('/dev/urandom', 'rb');
			if ($fp === false) {
				$fp = @\fopen('/dev/random', 'rb');
			}
			if ($fp !== false) {
				if ($r = @\fread($fp, $nbytes___ * 2) !== false) {
					$i = 0;
					while ($i < $nbytes___) {
						$r = @\fread($fp, $nbytes___);
						++$i;
					}
					@\fclose($fp);
					return $r;
				}
				@\fclose($fp);
			}
		}
		return null;
	}

	function _X_random_dev_2(int $nbytes___)
	{
		if (_X_os_nix() && $nbytes___ > 0) {
			if (false !== ($fp = @\popen("`which dd` if=/dev/urandom bs=1 count=" . $nbytes___ . " 2> /dev/null", "r"))) {
				$r = @\stream_get_contents($fp);
				@\pclose($fp);
				return $r;
			}
		}
		return null;
	}

	function _X_random_dev_3(int $nbytes___)
	{
		if (_X_os_nix() && $nbytes___ > 0) {
			if (false !== ($fp = @\popen("`which openssl` rand " . $nbytes___ . " 2> /dev/null", "r"))) {
				$r = @\stream_get_contents($fp);
				@\pclose($fp);
				return $r;
			}
		}
		return null;
	}

	function _X_random_slot(float &$ent___)
	{
		static $_S_dev = null;
		if (\is_null($_S_dev)) {
			if (\function_exists('\random_bytes')) {
				$_S_dev[] = '\random_bytes';
				$_S_dev[] = 32.0;
			} else if (\function_exists('\mcrypt_create_iv')) {
				$_S_dev[] = '\mcrypt_create_iv';
				$_S_dev[] = 32.0;
			} else if (\function_exists('\openssl_random_pseudo_bytes')) {
				$_S_dev[] = '\openssl_random_pseudo_bytes';
				$_S_dev[] = 4.0;
			} else {
				seterrno(ENOSYS);
			}
		}
		$ent___ = $_S_dev[1];
		return  $_S_dev[0];
	}

	function random_upper_bound(int $upb___)
	{
		$x = \abs($upb___) + 1;
		$r = \mt_rand(0, 0x7FFFFFFE) % $x;
		$i = 0;
		while($r >= $x) {
			$r = \mt_rand(0, 0x7FFFFFFE) % $x;
		}
		return $r;
	}

	function random_real_01()
	{ return (random_upper_bound(0x7FFFFFFE) / 0x7FFFFFFE) * 1.0; }

	function random_real_11()
	{ return (2.0 * (random_upper_bound(0x7FFFFFFE) / 0x7FFFFFFE)) - 1.0; }

	function random(int $min___ = 0, int $max___ = 0, int $seed___ = 0)
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
			 _X_throw_invalid_argument("Invalid argument error");
		}
		return \mt_rand($min___, $max___);
	}

	function random_uniform_int(int $min___ = 0, int $max___ = 0)
	{
		if ($min___ === 0 && $max___ === 0) {
			$min___ = numeric_limits_int::min;
			$max___ = numeric_limits_int::max;
		}
		return \random_int($min___, $max___);
	}

	function random_uniform_real(float $min___ = 0.0, float $max___ = 1.0)
	{ return $min___ + (\mt_rand() / \mt_getrandmax()) * ($max___ - $min___); }
} /* EONS */

/* EOF */