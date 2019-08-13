<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_numeric.php
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

	function & median_value(
		           &$a___
		,          &$b___
		,          &$c___
		, callable  $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function (&$l, &$r) { return $l < $r; };
		}
		if ($p($a___, $b___)) {
			if ($p($b___, $c___)) {
				return $b___;
			} else if ($p($a___, $c___)) {
				return $c___;
			}
			return $a___;
		} else if ($p($a___, $c___)) {
			return $a___;
		} else if ($p($b___, $c___)) {
			return $c___;
		}
		return $b___;
	}

	function span_lcm(
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

	function span_median(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if (0 < ($dist = iter_distance($first___, $last___))) {
				$med  = 0.0;
				if (($dist % 2) == 0) {
					$med = ((
						  iter_access($first___, \intdiv($dist, 2))
						+ iter_access($first___, (\intdiv($dist, 2) - 1))
					) / 2.0);
				} else {
					$med = iter_access($first___, \intdiv($dist, 2));
				}
				return $med;
			}
			return 0.0;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_middle(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$pos      = $first___->_M_pos;
			$largest  = max_element($first___, $last___);
			$first___->_F_seek($pos);
			$smallest = min_element($first___, $last___);
			$first___->_F_seek($pos);
			return ($largest->_F_this() - $smallest->_F_this());
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_mean(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$dist = iter_distance($first___, $last___);
			if (0 < $dist) {
				$sum  = 0.0;
				while ($first___ != $last___) {
					$sum += $first___->_F_this();
					$first___->_F_next();
				}
				return $sum / $dist;
			}
			return 0.0;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_sum(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$sum  = 0.0;
			while ($first___ != $last___) {
				$sum += $first___->_F_this();
				$first___->_F_next();
			}
			return $sum;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_variance(
		  basic_iterator $first___
		, basic_iterator $last___
		, bool           $unbiased___ = true
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$dist = iter_distance($first___, $last___);
			if (0 < $dist) {
				$mean = mean((clone $first___), $last___);
				$sum  = 0.0;
				while ($first___ != $last___) {
					$sum += \pow($first___->_F_this() - $mean, 2);
					$first___->_F_next();
				}
				if (1 < $dist && $unbiased___) {
					return ($sum / ($dist - 1));
				}
				return ($sum / $dist);
			}
			return 0.0;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_covariance(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, bool           $unbiased___ = true
	) {
		if (
			$first1___::iterator_category === $last1___::iterator_category &&
			$first2___::iterator_category === $last2___::iterator_category
		) {
			$dist  = \max(
				  iter_distance($first1___, $last1___)
				, iter_distance($first2___, $last2___)
			);
			if (0 < $dist) {
				$mean1 = mean((clone $first1___), $last1___);
				$mean2 = mean((clone $first2___), $last2___);
				$sum   = 0.0;
				while ($first1___ != $last1___ && $first2___ != $last2___) {
					$sum += ($first1___->_F_this() - $mean1) * ($first2___->_F_this() - $mean2);
				}
				if (1 < $dist && $unbiased___) {
					return ($sum / ($dist - 1));
				}
				return ($sum / $dist);
			}
			return 0.0;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function span_standard_deviation(
		  basic_iterator $first___
		, basic_iterator $last___
		, bool           $unbiased___ = true
	) { return \sqrt(span_variance($first___, $last___, $unbiased___)); }
} /* EONS */
/* EOF */