<?php
# -*- coding: utf-8 -*-

//
// xostype.php
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
	function _X_os_windows()
	{ return (\strtolower(\substr(\PHP_OS, 0, 3)) == "win"); }

	function _X_os_darwin()
	{ return (\strtolower(\PHP_OS) == "darwin"); }

	function _X_os_bsd()
	{
		return (
			   \strtolower(\substr(\PHP_OS, -3)) == "bsd"
			|| \strtolower(\PHP_OS) == "dragonfly"
		);
	}

	function _X_os_solaris()
	{ return (\strtolower(\PHP_OS) == "SunOS"); }

	function _X_os_linux()
	{ return (\strtolower(\PHP_OS) == "linux"); }

	function _X_os_minix()
	{ return (\strtolower(\PHP_OS) == "minix"); }

	function _X_os_qnx()
	{ return (\strtolower(\PHP_OS) == "qnx"); }

	function _X_os_unix()
	{ return (\strtolower(\PHP_OS) == "unix"); }

	function _X_os_nix()
	{
		return (
			   _X_os_darwin()
			|| _X_os_bsd()
			|| _X_os_solaris()
			|| _X_os_linux()
			|| _X_os_minix()
			|| _X_os_qnx()
			|| _X_os_unix()
		);
	}

	function _X_os_32bit()
	{ return (\PHP_INT_SIZE == 4); }

	function _X_os_64bit()
	{ return (\PHP_INT_SIZE >= 8); }
} /* EONS */

/* EOF */