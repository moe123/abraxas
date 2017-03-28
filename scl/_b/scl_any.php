<?php
# -*- coding: utf-8 -*-

//
// scl_any.php
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
	final class any
	{
		var $_M_val  = null;
		var $_M_type = null;

		function __construct($val = null)
		{
			$this->_M_val  = ($val instanceof \std\any) ? $val->_M_val : $val;
			$this->_M_type = typeof($this->_M_val);
		}

		function reset()
		{
			$this->_M_val  = null;
			$this->_M_type = typeof($this->_M_val);	
		}
 
		function has_value()
		{ return !\is_null($this->_M_val); }

		function type()
		{ return $this->_M_type; }

		function & swap(any &$any)
		{
			$val  = $this->_M_val;
			$type = $this->_M_type;

			$this->_M_val  = $any->_M_val;
			$this->_M_type = $any->_M_type;

			$any->_M_val  = $val;
			$any->_M_type = $type;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */