<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_exception.php
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

declare(strict_types=1);

namespace std
{
	class basic_exception extends _C_exception
	{ /* NOP */ }

	class runtime_error extends _C_runtime_error
	{ /* NOP */ }

	class logic_error extends _C_logic_error
	{ /* NOP */ }

	class overflow_error extends _C_overflow_error
	{ /* NOP */ }

	class underflow_error extends _C_underflow_error
	{ /* NOP */ }

	class invalid_argument extends _C_invalid_argument
	{ /* NOP */ }

	class domain_error extends _C_domain_error
	{ /* NOP */ }

	class length_error extends _C_length_error
	{ /* NOP */ }

	class out_of_range extends _C_out_of_range
	{ /* NOP */ }
} /* EONS */

/* EOF */