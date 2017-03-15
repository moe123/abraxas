<?php
# -*- coding: utf-8 -*-

//
// scl_random.php
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

namespace std
{
	final class random_device
	{
		var $_M_dev = null;
		var $_M_ent = 0.0;
		var $_M_ini = 0x0;

		static function min() { return 0; }
		static function max() { return 0x7FFFFFFE; }

		function __invoke()
		{ return ($this->_M_dev)(4); }

		function __construct()
		{
			$this->_M_dev = _X_random_slot($this->_M_ent);
			$this->_M_ini = \bin2hex(($this->_M_dev)(16));
		}

		function entropy()
		{ return $this->_M_ent; }
	} /* EOC */
} /* EONS */

/* EOF */