<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_any.php
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
	final class any
	{
		var $_M_val  = null;
		var $_M_type = null;

		function __toString()
		{ return \strval($_M_type); }

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