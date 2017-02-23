<?php
# -*- coding: utf-8 -*-

//
// _scl_xutility_traits.php
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
	if (\intval(PHP_MAJOR_VERSION . PHP_MINOR_VERSION . PHP_RELEASE_VERSION) < 7200) {
		define('PHP_FLOAT_EPSILON', 0.00009);
		define('PHP_FLOAT_MIN'    , \floatval(PHP_INT_MIN));
		define('PHP_FLOAT_MAX'    , \floatval(PHP_INT_MAX));
	}
} /* EONS */

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

	function _F_builtin_deep_copy($v___)
	{
		if (\is_resource($v___) || !\is_object($v___)) {
			return $v___;
		}
		if (\is_array($v___)) {
			$a = [];
			foreach ($v___ as $k => $v) {
				$a[$k] = $this->_F_deep_copy($v);
			}
			return $a;
		}
		return clone $v___;
	}

	function _F_builtin_real_equal(float $l___, float $r___)
	{ return \intval(\abs($l___ - $r___) < BUILTIN_FLT_EPSILON); }

	trait _T_deep_copy_traits
	{
		function __clone() {
			foreach($this as $k => $v) {
				$this->{$k} = _F_builtin_deep_copy($v);
			}
		}
	}

	trait _T_multi_construct_traits
	{
		function _F_multi_construct($argc___, $argv___)
		{
			if ($argc___) {
				$r = new \ReflectionClass($this);
				$n = $r->getShortName();
				$ln = $r->getName();
				unset($r);
				if (\method_exists($this, $ctor = "_F_" . $n . "_" . $argc___)) {
					try {
						\call_user_func_array(array($this, $ctor), $argv___);
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