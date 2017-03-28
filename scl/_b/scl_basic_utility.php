<?php
# -*- coding: utf-8 -*-

//
// scl_basic_utility.php
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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_x" . DIRECTORY_SEPARATOR . "xunilib.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_exception.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_numeric_limits.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_type_traits.php";
} /* EONS */

namespace std
{
	const ignore      = '\std\ignore';
	const hash        = '\std\hash';
	const crc32       = '\std\crc32';
	const cast_int    = '\std\cast_int';
	const cast_long   = '\std\cast_long';
	const cast_bool   = '\std\cast_bool';
	const cast_float  = '\std\cast_float';
	const cast_double = '\std\cast_double';
	const cast_str    = '\std\cast_str';
	const cast_obj    = '\std\cast_obj';

	abstract class comparison_result
	{
		const same       = 0;
		const ascending  = -1;
		const descending = 1;
	} /* EOC */

	final class comparator
	{
		var $_M_f;

		function __invoke($l, $r)
		{ return $this->_M_f($l, $r); }

		function __construct(callable $f)
		{ $this->_M_f = $f; }

		function & swap(comparator &$comparator)
		{
			$f = $this->_M_f;
			$this->_M_f = $comparator->_M_f;
			$comparator->_M_f = $f;

			return $this;
		}
	} /* EOC */

	function ignore() { return function() { return null; }; }

	/* Returns integers from start to stop [inclusive] */
	function irange_lazy_n(int $start___, int $stop___ = null, int $step___ = 1) 
	{
		if (!$step___) {
			$step___ = 1;
		}
		if (\is_null($stop___)) {
			$stop___ = $start___;
			$start___ = 0;
		}
		for ($i = $start___; $i <= $stop___; $i += $step___) {
			yield $i;
		}
	}

	/* Returns integers from start to stop [exclusive] */
	function irange_lazy_p(int $start___, int $stop___ = null, int $step___ = 1) 
	{
		if (!$step___) {
			$step___ = 1;
		}
		if (\is_null($stop___)) {
			$stop___ = $start___;
			$start___ = 0;
		}
		for ($i = $start___; $i < $stop___; $i += $step___) {
			yield $i;
		}
	}

	/* Returns N integers from pos */
	function irange_lazy(int $pos___ , int $len___ = null, int $step___ = 1) 
	{
		if ($step___ == 0) {
			$step___ = 1;
		}
		if (\is_null($len___)) {
			$len___ = $pos___;
			$pos___ = 0;
		}
		if ($step___ < 0) {
			$step___ = -$step___;
			for ($i = ($pos___ + $len___- 1); $i > (($pos___ + $len___- 1) - $len___); $i -= $step___) {
				yield $i;
			}
		} else {
			for ($i = $pos___; $i < $pos___ + $len___; $i += $step___) {
				yield $i;
			}
		}
	}

	function sizeof($in___)
	{
		if (\is_array($in___)) {
			return \count($in___);
		} else if (is_iterable($in___)) {
			return $in___->_M_size;
		} else if (is_tuple($in___)()) {
			return tuple_size($in___)();
		} else if (\is_string($in___)) {
			return strlen($in___);
		} else if (\is_float($in___)) {
			return numeric_limits_float::size;
		} else if (\is_int($in___)) {
			return numeric_limits_int::size;
		}
		return -1;
	}

	function typeof($in___)
	{
		if (\is_resource($in___)) {
			return \get_resource_type($l) == \get_resource_type($r);
		}
		if (\is_object($in___)) {
			return get_class($in___);
		}
		return \gettype($in___);
	}

	function cast_int($x___) { return (int)$x___; }

	function cast_long($x___) { return (int)$x___; }

	function cast_bool($x___) { return (bool)$x___; }

	function cast_float($x___) { return (float)$x___; }

	function cast_double($x___) { return (double)$x___; }

	function cast_str($x___) { return (string)$x___; }

	function cast_obj($x___) { return (object)$x___; }

	function hash($v___)
	{
		return function () use ($v___) {
			if (\is_object($v___) || \is_array($v___)) {
				return \sha1(\serialize($v___));
			}
			if (\is_resource($v___)) {
				return \sha1(print_r($v___, true));
			}
			return \sha1(\strval($v___));
		};
	}

	function crc32($v___)
	{
		return function () use ($v___) {
			if (\is_object($v___) || \is_array($v___)) {
				return \crc32(\serialize($v___));
			}
			if (\is_resource($v___)) {
				return \crc32(print_r($v___, true));
			}
			return \crc32(\strval($v___));
		};
	}

	/*! callable */
	function random_int_generator(int $min___ = 0, int $max___ = 0)
	{
		return function () use ($min___, $max___) {
			return random_uniform_int($min___, $max___);
		};
	}

	/*! callable */
	function random_real_generator(float $min___ = 0.0, float $max___ = 1.0)
	{
		return function () use ($min___, $max___) {
			return random_uniform_real($min___, $max___);
		};
	}

	function random_device()
	{ return new random_device; }

	function cs00700(random_device $dev___ = null)
	{ return new cryptographically_secure_engine($dev___); }

	function mt19937(random_device $dev___ = null)
	{ return new mersenne_twister_engine($dev___); }

	function tuple_size($v___)
	{
		if (\is_object($v___)) {
			if ($v___ instanceof \std\tuple) {
				return $v___->_M_size;
			} else if ($v___ instanceof \std\pair) {
				return 2;
			} else if ($v___ instanceof \std\triad) {
				return 3;
			} else if ($v___ instanceof \std\quad) {
				return 4;
			} else if ($v___ instanceof \std\quint) {
				return 5;
			}
		}
		return -1;
	}

	function get(int $i___, $v___)
	{
		if (\is_object($v___) && $v___ instanceof \std\tuple) {
			if ($v___->_M_size && $i___ < $v___->_M_size) {
				return $v___->_M_container[$i___];
			}
		} else if (\is_object($v___) && $v___ instanceof \std\quint) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $i___ === 2 ? $v___->third : $i___ === 3 ? $v___->fourth : $v___->fifth;
		} else if (\is_object($v___) && $v___ instanceof \std\quad) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $i___ === 2 ? $v___->third : $v___->fourth;
		} else if (\is_object($v___) && $v___ instanceof \std\triad) {
			return $i___ === 0 ? $v___->first : $i___ === 1 ? $v___->second : $v___->third;
		} else if (\is_object($v___) && $v___ instanceof \std\pair) {
			return $i___ === 0 ? $v___->first : $v___->second;
		}
		return null;
	}

	function apply(callable $f___, tuple $tuple)
	{ return call_user_func_array($f___, $tuple->_M_container); }

	function tuple_cat(...$args___)
	{
		if (\is_array($args___) && \count($args___)) {
			return new tuple($args___, true);
		}
		return new tuple;
	}

	function make_lconv(
		  string $decimal_point___ = ""
		, string $thousands_sep___ = ""
		, array  $grouping___ = []
		, string $int_curr_symbol___ = ""
		, string $currency_symbol___ = ""
		, string $mon_decimal_point___ = ""
		, string $mon_thousands_sep___ = ""
		, array  $mon_grouping___ = []
		, string $positive_sign___ = ""
		, string $negative_sign___ = ""
		, int    $int_frac_digits___ = 0
		, int    $frac_digits___ = 0
		, int    $p_cs_precedes___ = 0
		, int    $p_sep_by_space___ = 0
		, int    $n_cs_precedes___ = 0
		, int    $n_sep_by_space___ = 0
		, int    $p_sign_posn___ = 0
		, int    $n_sign_posn___ = 0
	) {
		return new lconv(
			  $decimal_point___
			, $thousands_sep___
			, $grouping___
			, $int_curr_symbol___
			, $currency_symbol___
			, $mon_decimal_point___
			, $mon_thousands_sep___
			, $mon_grouping___
			, $positive_sign___
			, $negative_sign___
			, $int_frac_digits___
			, $frac_digits___
			, $p_cs_precedes___
			, $p_sep_by_space___
			, $n_cs_precedes___
			, $n_sep_by_space___
			, $p_sign_posn___
			, $n_sign_posn___
		);
	}

	function make_utsname(
		  string $sysname___  = ""
		, string $nodename___ = ""
		, string $release___  = ""
		, string $version___  = ""
		, string $machine___  = ""
	) {
		return new utsname(
			  $sysname___
			, $nodename___
			, $release___
			, $version___
			, $machine___
		);
	}

	function make_timeb(
		  int $time___ = 0
		, int $millitm___ = 0
		, int $timezone___ = 0
		, int $dstflag___ = 0
	) {
		return new timeb(
			  $time___
			, $millitm___
			, $timezone___
			, $dstflag___
		);
	}

	function make_tm(
		  int $tm_sec___   = 0
		, int $tm_min___   = 0
		, int $tm_hour___  = 0
		, int $tm_mday___  = 0
		, int $tm_mon___   = 0
		, int $tm_year___  = 0
		, int $tm_wday___  = 0
		, int $tm_yday___  = 0
		, int $tm_isdst___ = 0
	) {
		return new tm(
			  $tm_sec___
			, $tm_min___
			, $tm_hour___
			, $tm_mday___
			, $tm_mon___
			, $tm_year___
			, $tm_wday___
			, $tm_yday___
			, $tm_isdst___
		);
	}

	function make_timespec(int $sec___ = 0, int $nsec___ = 0)
	{ return new timespec($sec___, $nsec___); }

	function make_timeval(int $sec___ = 0, int $usec___ = 0)
	{ return new timeval($sec___, $usec___); }

	function make_xlocale(string $id___, int $mask___ = xlocale_mask::all)
	{ return newlocale($mask___, $id___); }

	function make_timezone(int $mwest___ = 0, int $dsttm___ = 0)
	{ return new timezone($mwest___, $dsttm___); }

	function make_collator(string $id___, int $lv___ = collator_level::natural)
	{ return new collator($id___, $lv___); }

	function make_locale(string $id___, int $lv___ = collator_level::natural, int $cat___ = locale_category::all)
	{ return new locale($id___, $lv___, $cat___); }

	function make_comparator(callable $f___)
	{ return new comparator($f___); }

	function make_ratio(...$args___)
	{ return new ratio(...$args___); }

	function make_irange(int $a___ , int $b___ = null, int $s___ = 1)
	{
		if (\is_null($a___)) {
			return new irange($a___);
		}
		return new irange($a___, $b___, $s___);
	}

	function make_vector(...$args___)
	{ return new vector($args___); }

	function make_ordered_set(...$args___)
	{ return new ordered_set($args___); }

	function make_forward_list(...$args___)
	{ return new forward_list($args___); }

	function make_ordered_list(...$args___)
	{ return new ordered_list($args___); }

	function make_dict(...$args___)
	{ return new dict($args___); }

	function make_tuple(...$args___)
	{ return new tuple($args___); }

	function make_pair($a1___, $a2___)
	{ return new pair($a1___, $a2___); }

	function make_triad($a1___, $a2___, $a3___)
	{ return new triad($a1___, $a2___, $a3___); }

	function make_quad($a1___, $a2___, $a3___, $a4___)
	{ return new quad($a1___, $a2___, $a3___, $a4___); }

	function make_quint($a1___, $a2___, $a3___, $a4___, $a5___)
	{ return new quint($a1___, $a2___, $a3___, $a4___, $a5___); }

	function iterable_copy(basic_iterable &$c___)
	{ return clone $c___; }
} /* EONS */

/* EOF */