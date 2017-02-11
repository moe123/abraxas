<?php
# -*- coding: utf-8 -*-

//
// _scl_xostype.php
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
	function _F_builtin_os_windows()
	{
		if (\strtoupper(\substr(\PHP_OS, 0, 3)) == "WIN") {
			return true;
		}
		return false;
	}

	function _F_builtin_os_darwin()
	{
		if (\strtoupper(\PHP_OS) == "DARWIN") {
			return true;
		}
		return false;
	}
} /* EONS */

/* EOF */