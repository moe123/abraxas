<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_random.php
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

declare(strict_types=1);

namespace std
{
	define('std\GRND_RANDOM'   , 1);
	define('std\GRND_NONBLOCK' , 2);

	const random_uniform_int  = '\std\random_uniform_int';
	const random_uniform_real = '\std\random_uniform_real';

	const random              = '\std\random';
	const srandom             = '\std\srandom';
	const rand                = '\std\rand';
	const rand                = '\std\srand';

	function _F_random_dev_1(int $nbytes___)
	{
		if (_F_os_nix() && $nbytes___ > 0) {
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

	function _F_random_dev_2(int $nbytes___)
	{
		if (_F_os_nix() && $nbytes___ > 0) {
			if (false !== ($fp = @\popen("`which dd` if=/dev/urandom bs=1 count=" . $nbytes___ . " 2> /dev/null", "r"))) {
				$r = @\stream_get_contents($fp);
				@\pclose($fp);
				return $r;
			}
		}
		return null;
	}

	function _F_random_dev_3(int $nbytes___)
	{
		if (_F_os_nix() && $nbytes___ > 0) {
			if (false !== ($fp = @\popen("`which openssl` rand " . $nbytes___ . " 2> /dev/null", "r"))) {
				$r = @\stream_get_contents($fp);
				@\pclose($fp);
				return $r;
			}
		}
		return null;
	}

	function _F_random_slot(float &$ent___)
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

	function _F_random(int $min___ = 0, int $max___ = 0, int $seed___ = 0)
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
			 _F_throw_invalid_argument("Invalid argument error");
		}
		return \mt_rand($min___, $max___);
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

	function random()
	{ return _F_random(0, \mt_rand(), 0); }

	function srandom(int $seed___)
	{ return _F_random(0, \mt_rand(), $seed___); }

	function rand()
	{ return _F_random(0, \mt_rand(), 0); }

	function srand(int $seed___)
	{ return _F_random(0, \mt_rand(), $seed___); }

	function getrandom(&$dest___, int $dlen___, int $flgs___)
	{
		if ($dlen___ > 0) {
			if (_F_os_nix()) {
				$dest___ = _F_random_dev_1($dlen___);
				if (\is_null($dest___)) {
					$dest___ = _F_random_dev_2($dlen___);
					if (\is_null($dest___)) {
						$dest___ = _F_random_dev_3($dlen___);
					}
					if (\is_null($dest___)) {
						seterrno(EFAULT);
						return -1;
					}
				}
			} else {
				$entropy = 0;
				$device = _F_random_slot($entropy);
				$dest___ = $device($dlen___);
			}
			return 0;
		}
		seterrno(EIO);
		return -1;
	}

	function getentropy(&$dest___, int $dlen___)
	{
		if ($dlen___ < 1 || $dlen___ > 256) {
			seterrno(EIO);
			return -1;
		}
		return getrandom($dest___, $dlen___, GRND_RANDOM);
	}
} /* EONS */
/* EOF */