<?php
# -*- coding: utf-8 -*-

//
// scl_pair.php
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
		var $_M_fn = null;
		var $_M_nb = 4;

		static function min() { return 0; }
		static function max() { return numeric_limits_int::max; }

		function __invoke()
		{ return \bin2hex($this->_M_fn($this->_M_nb)); }

		function __construct()
		{
			if (function_exists('\random_bytes')) {
				$this->_M_fn = '\random_bytes';
			} else if (function_exists('\openssl_random_pseudo_bytes')) {
				$this->_M_fn = '\openssl_random_pseudo_bytes';
			} else if (function_exists('\mcrypt_create_iv')) {
				$this->_M_fn = '\mcrypt_create_iv';
			}
			if (_F_builtin_os_64bit()) {
				$this->_M_nb = 8;
			}
		}

		function entropy()
		{ return (float)($this->_M_nb * 8.0); }
	} /* EOC */
} /* EONS */

/* EOF */