<?php
# -*- coding: utf-8 -*-

//
// scl_basic_exception.php
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
	trait _T_x_exception 
	{
		function what() { return $this->getMessage(); }
		
		function rethrow() {
			throw new static($this->getMessage());
		}
	}

	class basic_exception extends \Exception
	{ use _T_x_exception; }

	class x_error extends \Error
	{ use _T_x_exception; }

	class x_type_error extends \TypeError
	{ use _T_x_exception; }

	class runtime_error extends \Exception
	{ use _T_x_exception; }

	class overflow_error extends runtime_error
	{ /* NOP */ }

	class underflow_error extends runtime_error
	{ /* NOP */ }

	class logic_error extends basic_exception
	{ /* NOP */ }

	class invalid_argument extends logic_error
	{ /* NOP */ }

	class domain_error extends logic_error
	{ /* NOP */ }

	class length_error extends logic_error
	{ /* NOP */ }

	class out_of_range extends logic_error
	{ /* NOP */ }

	function _X_throw_error(string $what)
	{ throw new x_error($what); }

	function _X_throw_type_error(string $what)
	{ throw new x_type_error($what); }

	function _F_throw_logic_error(string $what)
	{ throw new logic_error($what); }

	function _F_throw_invalid_argument(string $what)
	{ throw new invalid_argument($what); }

	function _F_throw_domain_error(string $what)
	{ throw new domain_error($what); }

	function _F_throw_length_error(string $what)
	{ throw new length_error($what); }

	function _F_throw_out_of_range(string $what)
	{ throw new out_of_range($what); }

	function _F_throw_overflow_error(string $what)
	{ throw new overflow_error($what); }
} /* EONS */

/* EOF */