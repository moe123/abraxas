<?php
# -*- coding: utf-8 -*-

//
// xutility_traits.php
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

namespace
{
	if (\intval(PHP_MAJOR_VERSION . PHP_MINOR_VERSION . PHP_RELEASE_VERSION) < 7200) {
		define('PHP_FLOAT_EPSILON', 0.000001);
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

	function _X_copy($v___)
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

	function _X_real_equal(float $l___, float $r___)
	{ return (\abs($l___ - $r___) < BUILTIN_FLT_EPSILON); }

	function _X_real_iszero(float $x___)
	{ return ($x___ == 0.0 || \abs($x___) < BUILTIN_FLT_EPSILON); }

	function _X_real_zeroed(...$args___)
	{
		$ret = false;
		foreach ($args___ as $x) {
			if ($x == 0.0 || \abs($x) < BUILTIN_FLT_EPSILON) {
				$ret = true;
			} else {
				$ret = false;
				break;
			}
		}
		return $ret;
	}

	trait _T_deep_copy
	{
		function __clone() {
			foreach($this as $k => $v) {
				$this->{$k} = _X_copy($v);
			}
		}
	}

	trait _T_multi_construct
	{
		function _F_ctor_call(&$argc___, &$argv___)
		{
			$rc = new \ReflectionClass($this);
			$cls = $rc->getShortName();
			unset($rc); 
			if (@\count($argv___[0]) === 2 && (
					$argv___[0][0] instanceof \std\basic_iterator &&
					$argv___[0][1] instanceof \std\basic_iterator
			)) {
				$ctor = $cls . "_2";
				if (@\method_exists($this, $ctor)) {
					$this->{$ctor}($argv___[0][0], $argv___[0][1]);
					return true;
				}
			} else {
				$ctor = $cls . "_" . $argc___;
				if (@\method_exists($this, $ctor)) {
					if (@\count($argv___[0]) === 1 && \is_array($argv___[0][0])) {
						$this->{$ctor}(...$argv___[0]);
						return true;
					}
					$this->{$ctor}(...$argv___);
					return true;
				}
				return false;
			}
			return false;
		}

		function _F_multi_construct($argc___, $argv___)
		{
			if ($argc___ > 0) {
				if (!$this->_F_ctor_call($argc___, $argv___)) {
					_X_throw_error("No matching constructor");
				}
			}
		}
	}
} /* EONS */

/* EOF */