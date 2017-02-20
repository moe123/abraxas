<?php
# -*- coding: utf-8 -*-

//
// scl_random_device.php
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
	final class random_device
	{
		var $_M_dev = null;

		static function min() { return 0; }
		static function max() { return numeric_limits_int::max; }

		function __invoke()
		{ return \bin2hex($this->_M_dev(numeric_limits_int::size)); }

		function __construct()
		{
			if (function_exists('\random_bytes')) {
				$this->_M_dev = '\random_bytes';
			} else if (function_exists('\openssl_random_pseudo_bytes')) {
				$this->_M_dev = '\openssl_random_pseudo_bytes';
			} else if (function_exists('\mcrypt_create_iv')) {
				$this->_M_dev = '\mcrypt_create_iv';
			}
		}

		function entropy()
		{ return (float)(numeric_limits_int::size * 8.0); }
	} /* EOC */
} /* EONS */

/* EOF */