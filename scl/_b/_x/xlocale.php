<?php
# -*- coding: utf-8 -*-

//
// xlocale.php
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
	final class lconv
	{
		var $decimal_point;
		var $thousands_sep;
		var $grouping;
		var $int_curr_symbol;
		var $currency_symbol;
		var $mon_decimal_point;
		var $mon_thousands_sep;
		var $mon_grouping;
		var $positive_sign;
		var $negative_sign;
		var $int_frac_digits;
		var $frac_digits;
		var $p_cs_precedes;
		var $p_sep_by_space;
		var $n_cs_precedes;
		var $n_sep_by_space;
		var $p_sign_posn;
		var $n_sign_posn;

		function __construct(
			  string $decimal_point___
			, string $thousands_sep___
			, array  $grouping___
			, string $int_curr_symbol___
			, string $currency_symbol___
			, string $mon_decimal_point___
			, string $mon_thousands_sep___
			, array  $mon_grouping___
			, string $positive_sign___
			, string $negative_sign___
			, int    $int_frac_digits___
			, int    $frac_digits___
			, int    $p_cs_precedes___
			, int    $p_sep_by_space___
			, int    $n_cs_precedes___
			, int    $n_sep_by_space___
			, int    $p_sign_posn___
			, int    $n_sign_posn___
		) {
			$this->decimal_point      = $decimal_point___;
			$this->thousands_sep      = $thousands_sep___;
			$this->grouping           = $grouping___;
			$this->int_curr_symbol    = $int_curr_symbol___;
			$this->currency_symbol    = $currency_symbol___;
			$this->mon_decimal_point  = $mon_decimal_point___;
			$this->mon_thousands_sep  = $mon_thousands_sep___;
			$this->mon_grouping       = $mon_grouping___;
			$this->positive_sign      = $positive_sign___;
			$this->negative_sign      = $negative_sign___;
			$this->int_frac_digits    = $int_frac_digits___;
			$this->frac_digits        = $frac_digits___;
			$this->p_cs_precedes      = $p_cs_precedes___;
			$this->p_sep_by_space     = $p_sep_by_space___;
			$this->n_cs_precedes      = $n_cs_precedes___;
			$this->n_sep_by_space     = $n_sep_by_space___;
			$this->p_sign_posn        = $p_sign_posn___;
			$this->n_sign_posn        = $n_sign_posn___;
		}
	} /* EOC */

	abstract class locale_category
	{
		const none     = 0;
		const collate  = \LC_COLLATE;
		const ctype    = \LC_CTYPE;
		const monetary = \LC_MONETARY;
		const numeric  = \LC_NUMERIC;
		const time     = \LC_TIME;
		const messages = \LC_MESSAGES;
		const all      = \LC_ALL;
	} /* EOC */

	abstract class xlocale_mask
	{
		const none     = 0;
		const collate  = 1 << 0;
		const ctype    = 1 << 1;
		const monetary = 1 << 2;
		const numeric  = 1 << 3;
		const time     = 1 << 4;
		const messages = 1 << 5;
		const all      = xlocale_mask::collate
			| xlocale_mask::ctype
			| xlocale_mask::monetary
			| xlocale_mask::numeric
			| xlocale_mask::time
			| xlocale_mask::messages
		;
	} /* EOC */

	final class locale_t
	{
		var $u_mask = xlocale_mask::all;
		var $u_data = [];
	}

	function _X_unsetlocale(locale_t &$xloc___)
	{
		if ($xloc___->u_data[0]["^std@_u_rst"]) {
			\setlocale(
				  $xloc___->u_data[0]["^std@_u_cat"]
				, $xloc___->u_data[0]["^std@_u_nid"]
			);
		}
	}

	function & newlocale(int $locmask___, string $locid___, locale_t &$base___ = null)
	{
		$xloc = new locale_t;
		if ($locmask___ & xlocale_mask::all) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::all;
		} else if ($locmask___ & xlocale_mask::collate) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::collate;
		} else if ($locmask___ & xlocale_mask::ctype) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::ctype;
		} else if ($locmask___ & xlocale_mask::monetary) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::monetary;
		} else if ($locmask___ & xlocale_mask::numeric) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::numeric;
		} else if ($locmask___ & xlocale_mask::time) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::time;
		} else if ($locmask___ & xlocale_mask::messages) {
			$xloc->u_data[0]["^std@_u_cat"] = locale_category::messages;
		}
		$xloc->u_mask                   = $locmask___;
		$xloc->u_data[0]["^std@_u_nid"] = $locid___;
		$xloc->u_data[0]["^std@_u_rst"] = 1;

		return $xloc;
	}

	function & uselocale(locale_t &$xloc___)
	{
		$cat = $xloc___->u_data[0]["^std@_u_cat"];
		$old = \setlocale($cat, "");
		if ($xloc___->u_data[0]["^std@_u_nid"] == $old) {
			$xloc___->u_data[0]["^std@_u_rst"] = 0;
			return $xloc___;
		}
		if (\strlen($old) < 1) {
			$cat = locale_category::all;
			$xloc___->u_mask = xlocale_mask::all;
			$old = \setlocale($cat, "");
			if (\strlen($old) < 1) {
				$old = "C";
			}
		}
		\setlocale($cat, $xloc___->u_data[0]["^std@_u_nid"]);

		$xloc___->u_data[0]["^std@_u_cat"] = $cat;
		$xloc___->u_data[0]["^std@_u_nid"]  = $old;
		$xloc___->u_data[0]["^std@_u_rst"]  = 1;

		return $xloc___;
	}

	function duplocale(locale_t &$xloc___)
	{ return clone $xloc___; }

	function freelocale(locale_t &$xloc___)
	{
		_F_unsetlocale($xloc___);
		$xloc___ = null;
	}

	function localeconv()
	{
		$lc = \localeconv();
		return new lconv(
			  $lc["decimal_point"]
			, $lc["thousands_sep"]
			, $lc["grouping"]
			, $lc["int_curr_symbol"]
			, $lc["currency_symbol"]
			, $lc["mon_decimal_point"]
			, $lc["mon_thousands_sep"]
			, $lc["mon_grouping"]
			, $lc["positive_sign"]
			, $lc["negative_sign"]
			, $lc["int_frac_digits"]
			, $lc["frac_digits"]
			, intval($lc["p_cs_precedes"])
			, intval($lc["p_sep_by_space"])
			, intval($lc["n_cs_precedes"])
			, intval($lc["n_sep_by_space"])
			, $lc["p_sign_posn"]
			, $lc["n_sign_posn"]
		);
	}

	function & localeconv_l(locale_t &$xloc___)
	{
		uselocale($xloc___);
		$lc = localeconv();
		_X_unsetlocale($xloc___);
		return $lc;
	}

	function & setlocale(int $cat___, string $locid___) {
		if (false === ($loc = \setlocale($cat___, $locid___))) {
			$loc = null;
		}
		return $loc;
	}
} /* EONS */

/* EOF */