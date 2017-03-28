<?php
# -*- coding: utf-8 -*-

//
// scl_complex.php
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
	final class complex
	{
		var $_M_complex = null;

		//#! Base Arithmetic functions.

		static function abs(complex $c)
		{ return cabs($c->_M_complex); }

		static function arg(complex $c)
		{ return carg($c->_M_complex); }

		static function norm(complex $c)
		{ return cnorm($c->_M_complex); }

		static function conj(complex $c)
		{
			$z = cconj($c->_M_complex);
			return new complex(creal($z), cimag($z));
		}

		static function proj(complex $c)
		{
			$z = proj($c->_M_complex);
			return new complex(creal($z), cimag($z));
		}

		static function polar(float $rho, float $theta = 0.0)
		{
			$z = cpolar($rho, $theta);
			return new complex(creal($z), cimag($z));
		}

		//#! Exponential functions.

		static function exp(complex $c)
		{
			$z = cexp($c->_M_complex);
			return new complex(creal($z), cimag($z));
		}

		static function log(complex $c)
		{
			$z = clog($c->_M_complex);
			return new complex(creal($z), cimag($z));
		}

		static function log10(complex $c)
		{
			$z = clog10($c->_M_complex);
			return new complex(creal($z), cimag($z));
		}

		function __construct(float $real, float $imag)
		{ $this->_M_complex = cmplx($real, $imag); }

		function real()
		{ return creal($this->_M_complex); }
 		
		function imag()
		{ return cimag($this->_M_complex); }
	} /* EOC */
} /* EONS */

/* EOF */