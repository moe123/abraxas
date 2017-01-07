<?php
# -*- coding: utf-8 -*-

//
// scl_builtin_utility_traits.php
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
	trait _T_multi_construct_traits
	{
		function _F_multi_construct($argc___, $argv___)
		{
			if ($argc___) {
				$r = new \ReflectionClass($this);
				$n = $r->getShortName();
				$ln = $r->getName();
				unset($r);
				if (@method_exists($this, $ctor = "_F_" . $n . "_" . $argc___)) {
					try {
						@call_user_func_array(array($this, $ctor), $argv___);
					} catch(\Throwable $ex) {
						_F_throw_builtin_error(
							"No matching constructor for initialization of '"
							. $ln
							. "', "
							. $ex -> getMessage()
						);
					}
				} else {
					_F_throw_builtin_error("No matching constructor for initialization of '"
						. $ln
						. "'"
					);
				}
			}
		}
	}
} /* EONS */
/* EOF */