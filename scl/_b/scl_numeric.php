<?php
# -*- coding: utf-8 -*-

//
// scl_numeric.php
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
	function gcd(int $m___, int $n___)
	{
		if ($m___ === 0 && $n___ === 0) {
			return 0;
		}
		if ($n___ === 0) {
			return $m___;
		}
		return _F_gcd($m___, $n___);
	}
	
	function lcm(int $m___, int $n___)
	{
		if ($m___ === 0 || $n___ === 0) {
			return 0;
		}
		return _F_lcm($m___, $n___);
	}

	function lcm_r(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		$m = [];
		$n = 0;
		while ($first___ != $last___) {
			$m[] = $first___->_F_this();
			$first___->_F_next();
			$n++;
		}
		return _F_lcmv($m, $n);
	}
} /* EONS */

/* EOF */