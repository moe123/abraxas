<?php
# -*- coding: utf-8 -*-

//
// xutsname.php
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
	final class utsname
	{
		var $sysname  = ""; /* Name of this implementation of the operating system. */
		var $nodename = ""; /* Name of this node within the communications network to which this node is attached, if any. */
		var $release  = ""; /* Current release level of this implementation. */
		var $version  = ""; /* Current version level of this release. */
		var $machine  = ""; /* Name of the hardware type on which the system is running. */

		function __construct(
			  string $sysname___
			, string $nodename___
			, string $release___
			, string $version___
			, string $machine___
		) {
			$this->sysname  = $sysname___;
			$this->nodename = $nodename___;
			$this->release  = $release___;
			$this->version  = $version___;
			$this->machine  = $machine___;
		}
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