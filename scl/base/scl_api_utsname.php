<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_utsname.php
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
	final class utsname
	{
		var $sysname  = ""; /* Name of this implementation of the operating system. */
		var $nodename = ""; /* Name of this node within the communications network to which this node is attached, if any. */
		var $release  = ""; /* Current release level of this implementation. */
		var $version  = ""; /* Current version level of this release. */
		var $machine  = ""; /* Name of the hardware type on which the system is running. */
	} /* EOC */

	function uname(utsname &$n___)
	{
		$n___->sysname  = \php_uname('s');
		$n___->nodename = \php_uname('n');
		$n___->release  = \php_uname('r');
		$n___->version  = \php_uname('v');
		$n___->machine  = \php_uname('m');
		return 0;
	}
} /* EONS */
/* EOF */