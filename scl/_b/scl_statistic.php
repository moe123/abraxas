<?php
# -*- coding: utf-8 -*-

//
// scl_statistic.php
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
	function median(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$med  = 0.0;
			if (1 < ($dist = distance($first___, $last___))) {
				if (($dist % 2) == 0) {
					$med  = iter_value_at_position($first___, $dist / 2);
					$med += iter_value_at_position($first___, (($dist / 2) - 1));
					$med /= 2.0;
				} else {
					$med = iter_value_at_position($first___, $dist / 2);
				}
			}
			return $med;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return \NAN;
	}

	function midrange(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		$largest  = max_element(clone $first___, $last___);
		$smallest = min_element($first___, $last___);
		return ($largest->_F_this() - $smallest->_F_this());
	}

	function mean(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$dist = distance($first___, $last___);
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

	function summation(
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

	function variance(
		  basic_iterator $first___
		, basic_iterator $last___
		, bool           $unbiased___ = true
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$dist = distance($first___, $last___);
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

	function covariance(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, bool           $unbiased___ = true
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$dist  = max(
				distance($first1___, $last1___)
				, distance($first2___, $last2___)
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

	function standard_deviation(
		  basic_iterator $first___
		, basic_iterator $last___
		, bool           $unbiased___ = true
	) { return \sqrt(variance($first___, $last___, $unbiased___)); }
} /* EONS */

/* EOF */