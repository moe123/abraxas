<?php
# -*- coding: utf-8 -*-

//
// scl_ratio.php
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
	final class ratio extends basic_ratio
	{
		use _T_multi_construct_traits;

		function __construct($num, int $den)
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function _F_ratio_2(int $num, int $den)
		{
			$this->_M_num = $num;
			$this->_M_den = $den;
			$this->_M_mir = $this->_M_num / $this->_M_den;
		}

		function num()
		{ return $this->_M_num; }

		function den()
		{ return $this->_M_den; }

		function mir()
		{ return $this->_M_mir; }

		function & swap(ratio &$ratio)
		{
			$num = $this->_M_num;
			$den = $this->_M_den;
			$mir = $this->_M_mir;

			$this->_M_num = $ratio->_M_num;
			$this->_M_den = $ratio->_M_den;
			$this->_M_mir = $ratio->_M_mir;

			$ratio->_M_num = $num;
			$ratio->_M_den = $den;
			$ratio->_M_mir = $mir;

			return $this;
		}
	} /* EOC */

	function atto()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_atto;
		}
		return $_S_ratio;
	}

	function femto()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_femto;
		}
		return $_S_ratio;
	}

	function pico()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_pico;
		}
		return $_S_ratio;
	}

	function nano()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_nano;
		}
		return $_S_ratio;
	}

	function micro()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_micro;
		}
		return $_S_ratio;
	}

	function milli()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_milli;
		}
		return $_S_ratio;
	}

	function centi()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_deci;
		}
		return $_S_ratio;
	}

	function deci()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_deci;
		}
		return $_S_ratio;
	}

	function unum()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_unum;
		}
		return $_S_ratio;
	}

	function deca()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_deca;
		}
		return $_S_ratio;
	}

	function hecto()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_hecto;
		}
		return $_S_ratio;
	}

	function kilo()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_kilo;
		}
		return $_S_ratio;
	}

	function mega()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_mega;
		}
		return $_S_ratio;
	}

	function giga()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_giga;
		}
		return $_S_ratio;
	}

	function tera()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_tera;
		}
		return $_S_ratio;
	}

	function peta()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_peta;
		}
		return $_S_ratio;
	}

	function exa()
	{
		static $_S_ratio = null;
		if (\is_null($_S_ratio)) {
			$_S_ratio = new _C_ratio_exa;
		}
		return $_S_ratio;
	}

	function & ratio_copy(basic_ratio $ratio)
	{
		$ra = new ratio;
		$this->_M_num = $ratio->num();
		$this->_M_den = $ratio->den();
		$this->_M_mir = $ratio->mir();
		return $ra;
	}

	function & ratio_muliply(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_F_builtin_ratio_multiply(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = $ra->_M_num / $ra->_M_den;
		return $ra;
	}

	function & ratio_divide(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_F_builtin_ratio_divide(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = $ra->_M_num / $ra->_M_den;
		return $ra;
	}

	function & ratio_add(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_F_builtin_ratio_add(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = $ra->_M_num / $ra->_M_den;
		return $ra;
	}

	function & ratio_subtract(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_F_builtin_ratio_subtract(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = $ra->_M_num / $ra->_M_den;
		return $ra;
	}

	function ratio_equal(basic_ratio $l, basic_ratio $r)
	{ return (int)($l->num() == $r->num() && $l->den() == $r->den()); }

	function ratio_not_equal(basic_ratio $l, basic_ratio $r)
	{ return (int)(!ratio_equal($l, $r)); }

	function ratio_less(basic_ratio $l, basic_ratio $r)
	{ return (int)($l->mir() < $r->mir()); }

	function ratio_less_equal(basic_ratio $l, basic_ratio $r)
	{ return (int)($l->mir() <= $r->mir()); }

	function ratio_greater(basic_ratio $l, basic_ratio $r)
	{ return (int)($l->mir() > $r->mir()); }

	function ratio_greater_equal(basic_ratio $l, basic_ratio $r)
	{ return (int)($l->mir() >= $r->mir()); }
} /* EONS */

/* EOF */