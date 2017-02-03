<?php
# -*- coding: utf-8 -*-

//
// ___scl_cxlocale.php
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
	abstract class xlocale_category
	{
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
		var $u_category = xlocale_category::all;
		var $u_mask     = 0;
		var $u_name_id  = null;
		var $u_restore  = 0;
	}

	function & newlocale(int $locmask___, string $locid___, locale_t &$base___ = null)
	{
		$xloc = new locale_t;
		if ($locmask___ & xlocale_mask::collate) {
			$xloc->u_category = xlocale_category::collate;
		} else if ($locmask___ & xlocale_mask::ctype) {
			$xloc->u_category = xlocale_category::ctype;
		} else if ($locmask___ & xlocale_mask::monetary) {
			$xloc->u_category = xlocale_category::monetary;
		} else if ($locmask___ & xlocale_mask::numeric) {
			$xloc->u_category = xlocale_category::numeric;
		} else if ($locmask___ & xlocale_mask::time) {
			$xloc->u_category = xlocale_category::time;
		} else if ($locmask___ & xlocale_mask::messages) {
			$xloc->u_category = xlocale_category::messages;
		}
		$xloc->u_mask     = $locmask___;
		$xloc->u_name_id  = $old;
		$xloc->u_restore  = 1;
		return $xloc;
	}

	function & uselocale(locale_t &$xloc___)
	{
		$cat = $xloc___->u_category;
		$old = \setlocale($cat, "");
		if ($xloc___->u_name_id == $old) {
			$xloc___->u_restore  = 0;
			return $xloc___;
		}
		if (\strlen($old) < 1) {
			$cat = xlocale_category::all;
			$xloc->u_mask = xlocale_mask::all;
			$old = \setlocale($cat, "");
			if (\strlen($old) < 1) {
				$old = "C";
			}
		}
		\setlocale($cat, $xloc___->u_name_id);
		$xloc___->u_category = $cat;
		$xloc___->u_name_id  = $old;
		$xloc___->u_restore  = 1;
		return $xloc___;
	}

	function freelocale(locale_t &$xloc___)
	{
		if ($xloc->u_restore) {
			\setlocale(
				  $xloc->u_category
				, $xloc->u_name_id
			);
		}
		$xloc___ = null;
	}
} /* EONS */

/* EOF */