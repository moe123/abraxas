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
		use _T_multi_construct;

		var $_M_num = 1;
		var $_M_den = 1;
		var $_M_mir = 1;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function ratio_1(float $x)
		{
			_X_ratio_nearest($x, $this->_M_num, $this->_M_den);
			$this->_M_mir = \floatval($this->_M_num / $this->_M_den);
		}

		function ratio_2(int $num, int $den)
		{
			if ($den < 0) {
				$this->_M_num = -($num);
				$this->_M_den = -($den);
			} else {
				$this->_M_num = $num;
				$this->_M_den = $den;
			}
			if ($this->_M_den == 0) {
				_F_throw_overflow_error("Divide by zero error");
			}
			$this->_M_mir = \floatval($this->_M_num / $this->_M_den);
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

	function & atto()
	{
		static $_S_atto = null;
		if (\is_null($_S_atto)) {
			$_S_atto = new _C_ratio_atto;
		}
		return $_S_atto;
	}

	function & femto()
	{
		static $_S_femto = null;
		if (\is_null($_S_femto)) {
			$_S_femto = new _C_ratio_femto;
		}
		return $_S_femto;
	}

	function & pico()
	{
		static $_S_pico = null;
		if (\is_null($_S_pico)) {
			$_S_pico = new _C_ratio_pico;
		}
		return $_S_pico;
	}

	function & nano()
	{
		static $_S_nano = null;
		if (\is_null($_S_nano)) {
			$_S_nano = new _C_ratio_nano;
		}
		return $_S_nano;
	}

	function & micro()
	{
		static $_S_micro = null;
		if (\is_null($_S_micro)) {
			$_S_micro = new _C_ratio_micro;
		}
		return $_S_micro;
	}

	function & milli()
	{
		static $_S_milli = null;
		if (\is_null($_S_milli)) {
			$_S_milli = new _C_ratio_milli;
		}
		return $_S_milli;
	}

	function & centi()
	{
		static $_S_centi = null;
		if (\is_null($_S_centi)) {
			$_S_centi = new _C_ratio_centi;
		}
		return $_S_centi;
	}

	function & deci()
	{
		static $_S_deci = null;
		if (\is_null($_S_deci)) {
			$_S_deci = new _C_ratio_deci;
		}
		return $_S_deci;
	}

	function & unum()
	{
		static $_S_unum = null;
		if (\is_null($_S_unum)) {
			$_S_unum = new _C_ratio_unum;
		}
		return $_S_unum;
	}

	function & deca()
	{
		static $_S_deca = null;
		if (\is_null($_S_deca)) {
			$_S_deca = new _C_ratio_deca;
		}
		return $_S_deca;
	}

	function & hecto()
	{
		static $_S_hecto = null;
		if (\is_null($_S_hecto)) {
			$_S_hecto = new _C_ratio_hecto;
		}
		return $_S_hecto;
	}

	function & kilo()
	{
		static $_S_kilo = null;
		if (\is_null($_S_kilo)) {
			$_S_kilo = new _C_ratio_kilo;
		}
		return $_S_kilo;
	}

	function & mega()
	{
		static $_S_mega = null;
		if (\is_null($_S_mega)) {
			$_S_mega = new _C_ratio_mega;
		}
		return $_S_mega;
	}

	function & giga()
	{
		static $_S_giga = null;
		if (\is_null($_S_giga)) {
			$_S_giga = new _C_ratio_giga;
		}
		return $_S_giga;
	}

	function & tera()
	{
		static $_S_tera = null;
		if (\is_null($_S_tera)) {
			$_S_tera = new _C_ratio_tera;
		}
		return $_S_tera;
	}

	function & peta()
	{
		static $_S_peta = null;
		if (\is_null($_S_peta)) {
			$_S_peta = new _C_ratio_peta;
		}
		return $_S_peta;
	}

	function & exa()
	{
		static $_S_exa = null;
		if (\is_null($_S_exa)) {
			$_S_exa = new _C_ratio_exa;
		}
		return $_S_exa;
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
		_X_ratio_multiply(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = \floatval($ra->_M_num / $ra->_M_den);
		return $ra;
	}

	function & ratio_divide(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_X_ratio_divide(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = \floatval($ra->_M_num / $ra->_M_den);
		return $ra;
	}

	function & ratio_add(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_X_ratio_add(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = \floatval($ra->_M_num / $ra->_M_den);
		return $ra;
	}

	function & ratio_subtract(basic_ratio $l, basic_ratio $r)
	{
		$ra = new ratio;
		_X_ratio_subtract(
			  $l->num()
			, $l->den()
			, $r->num()
			, $r->den()
			, $ra->_M_num
			, $ra->_M_den
		);
		$ra->_M_mir = \floatval($ra->_M_num / $ra->_M_den);
		return $ra;
	}

	function ratio_equal(basic_ratio $l, basic_ratio $r)
	{
		if ($l->den() == $r->den()) {
			return ($l->num() == $r->num());
		}
		/*
		// reducing or not reducing greedy? else let php 
		// handling floating-point equality which seems to be fine-ish.
		$n1 = $l->num();
		$d1 = $l->den();
		$n2 = $r->num();
		$d2 = $r->den();
		_X_ratio_reduce($n1, $d1, $n2, $d2);
		return $n1 == $n2;
		*/
		return ($l->mir() == $r->mir());
	}

	function ratio_not_equal(basic_ratio $l, basic_ratio $r)
	{ return (!ratio_equal($l, $r)); }

	function ratio_less(basic_ratio $l, basic_ratio $r)
	{
		if ($l->den() == $r->den()) {
			return ($l->num() < $r->num());
		}
		return ($l->mir() < $r->mir());
	}

	function ratio_less_equal(basic_ratio $l, basic_ratio $r)
	{
		if ($l->den() == $r->den()) {
			return ($l->num() <= $r->num());
		}
		return ($l->mir() <= $r->mir());
	}

	function ratio_greater(basic_ratio $l, basic_ratio $r)
	{
		if ($l->den() == $r->den()) {
			return ($l->num() > $r->num());
		}
		return ($l->mir() > $r->mir());
	}

	function ratio_greater_equal(basic_ratio $l, basic_ratio $r)
	{
		if ($l->den() == $r->den()) {
			return ($l->num() >= $r->num());
		}
		return ($l->mir() >= $r->mir());
	}
} /* EONS */

/* EOF */