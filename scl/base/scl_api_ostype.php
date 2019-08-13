<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_ostype.php
//
// Copyright (C) 2017-2019 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @author     Moe123 2019.
 * @maintainer Moe123 2019.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	function _F_os_windows()
	{ return (\strtolower(\substr(\PHP_OS, 0, 3)) == "win"); }

	function _F_os_darwin()
	{ return (\strtolower(\PHP_OS) == "darwin"); }

	function _F_os_bsd()
	{
		return (
			   \strtolower(\substr(\PHP_OS, -3)) == "bsd"
			|| \strtolower(\PHP_OS) == "dragonfly"
		);
	}

	function _F_os_solaris()
	{ return (\strtolower(\PHP_OS) == "SunOS"); }

	function _F_os_linux()
	{ return (\strtolower(\PHP_OS) == "linux"); }

	function _F_os_minix()
	{ return (\strtolower(\PHP_OS) == "minix"); }

	function _F_os_qnx()
	{ return (\strtolower(\PHP_OS) == "qnx"); }

	function _F_os_unix()
	{ return (\strtolower(\PHP_OS) == "unix"); }

	function _F_os_nix()
	{
		return (
			   _F_os_darwin()
			|| _F_os_bsd()
			|| _F_os_solaris()
			|| _F_os_linux()
			|| _F_os_minix()
			|| _F_os_qnx()
			|| _F_os_unix()
		);
	}

	function _F_os_32bit()
	{ return (\PHP_INT_SIZE == 4); }

	function _F_os_64bit()
	{ return (\PHP_INT_SIZE >= 8); }
} /* EONS */
/* EOF */