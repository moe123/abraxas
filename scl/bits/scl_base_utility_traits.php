<?php
# -*- coding: utf-8 -*-

//
// scl_base_utility_traits.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace
{
	if ((int)(PHP_MAJOR_VERSION . PHP_MINOR_VERSION . PHP_RELEASE_VERSION) < 7200) {
		if (PHP_INT_SIZE >= 8) {
			define("PHP_FLOAT_EPSILON" , 2.220446e-16);
			define("PHP_FLOAT_MIN"     , 2.225074e-308);
			define("PHP_FLOAT_MAX"     , 1.797693e+308);
		} else {
			define("PHP_FLOAT_EPSILON" , 1.192093e-07);
			define("PHP_FLOAT_MIN"     , 1.175494e-38);
			define("PHP_FLOAT_MAX"     , 3.402823e+38);
		}
	}
}

namespace std
{
	define('BUILTIN_FLT_EPSILON'  , PHP_FLOAT_EPSILON);
	define('BUILTIN_FLT_SIZE'     , PHP_INT_SIZE);
	define('BUILTIN_FLT_MAX'      , PHP_FLOAT_MAX);
	define('BUILTIN_FLT_LOWEST'   , -PHP_FLOAT_MAX);
	define('BUILTIN_FLT_MIN'      , PHP_FLOAT_MIN);
	
	define('BUILTIN_SINT_EPSILON' , 0);
	define('BUILTIN_SINT_SIZE'    , PHP_INT_SIZE);
	define('BUILTIN_SINT_MAX'     , PHP_INT_MAX);
	define('BUILTIN_SINT_LOWEST'  , -PHP_INT_MAX);
	define('BUILTIN_SINT_MIN'     , PHP_INT_MIN);

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