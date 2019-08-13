<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_exception.php
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
	class basic_exception extends _C_exception
	{ /* NOP */ } /* EOC */

	class runtime_error extends _C_runtime_error
	{ /* NOP */ } /* EOC */

	class logic_error extends _C_logic_error
	{ /* NOP */ } /* EOC */

	class overflow_error extends _C_overflow_error
	{ /* NOP */ } /* EOC */

	class underflow_error extends _C_underflow_error
	{ /* NOP */ } /* EOC */

	class invalid_argument extends _C_invalid_argument
	{ /* NOP */ } /* EOC */

	class domain_error extends _C_domain_error
	{ /* NOP */ } /* EOC */

	class length_error extends _C_length_error
	{ /* NOP */ } /* EOC */

	class out_of_range extends _C_out_of_range
	{ /* NOP */ } /* EOC */
} /* EONS */
/* EOF */