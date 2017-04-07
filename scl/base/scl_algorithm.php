<?php
# -*- coding: utf-8 -*-

//
// scl_algorithm.php
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
	function swap(&$v1___, &$v2___)
	{
		$v0    = $v1___;
		$v1___ = $v2___;
		$v2___ = $v0;
	}

	function & clamp(
		           &$v___
		,          &$lo___
		,          &$hi___
		, callable  $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function (&$l, &$r) { return $l < $r; };
		}
		return $p($v___, $lo___) ? $lo___ : $p($hi___, $v___) ? $hi___ : $v___;
	}

	function iter_swap(basic_iterator &$it1___, basic_iterator &$it2___)
	{
		$v1 = $it1___->_F_this();
		$v2 = $it2___->_F_this();
		$it1___->_F_assign($v2);
		$it2___->_F_assign($v1);
	}

	function iter_distance(basic_iterator $first___, basic_iterator $last___)
	{
		$n = 0;
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___->_F_pos() >= $last___->_F_pos()) {
				$n = $last___->_F_pos() - $first___->_F_pos();
			} else {
				$it = clone $first___;
				while ($it != $last___) {
					$it->_F_next();
					++$n;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $n;
	}

	function iter_next(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_next();
			}
			return $it___;
		}
		return $it___->_F_next();
	}

	function iter_prev(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_prev();
			}
			return $it___;
		}
		return $it___->_F_prev();
	}

	function shuffle(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $gen___ = null
	) {
		$g = $gen___;
		if (\is_null($g)) {
			$g = new cryptographically_secure_engine;
		}
		$n  = $last___->_F_pos() - $first___->_F_pos();
		$d = new uniform_int_distribution;
		for ($i = ($n - 1); $i > 0; --$i) {
			_F_iter_swap_position($first___, $i, $d($g, 0, $i));
		}
	}

	function lower_bound(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $binaryPredicate___ = null
	) {
		$cnt = iter_distance($first___, $last___);
		if ($cnt > 0) {
			$step  = 1;
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, &$r) { return $l < $r; };
			}
			while ($cnt > 0) {
				$it = clone $first___; 
				$step = \intdiv($cnt, 2);
				if ($step < 1) {
					_F_throw_out_of_range("Out of Range error");
					return $first___;
				}
				$it->_F_advance($step);
				if ($p($it->_F_this(), $val___)) {
						$it->_F_next();
						$first___ = clone $it;
						$cnt -= $step + 1;
				} else {
					$cnt = $step;
				}
			}
		}
		return $first___;
	}

	function upper_bound(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $binaryPredicate___ = null
	) {
		$cnt = iter_distance($first___, $last___);
		if ($cnt > 0) {
			$step  = 1;
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function (&$l, $r) { return $l < $r; };
			}
			while ($cnt > 0) {
				$it = clone $first___; 
				$step = \intdiv($cnt, 2);
				if ($step < 1) {
					_F_throw_out_of_range("Out of Range error");
					return $first___;
				}
				$it->_F_advance($step);
				if (!$p($val___, $it->_F_this())) {
						$it->_F_next();
						$first___ = clone $it;
						$cnt -= $step + 1;
				} else {
					$cnt = $step;
				}
			}
		}
		return $first___;
	}

	function binary_search(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $binaryPredicate___ = null
	)
	{
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function (&$l, $r) { return $l < $r; };
		}
		$first___ = lower_bound($first___, $last___, $val___, $p);
		return (!($first___ == $last___) && !($p($val___, $first___->_F_this())));
	}

	function rotate(
		  basic_iterator $first___
		, basic_iterator $n_first___
		, basic_iterator $last___
	) {
		if ($first___ == $n_first___) {
			return $last___;
		}
		if ($n_first___ == $last___) {
			return $first___;
		}

		$next = clone $n_first___;
		while ($next != $last___) {
			iter_swap($first___, $next);
			$first___->_F_next();
			$next->_F_next();
			if ($first___ == $n_first___) {
				$n_first___ = clone $next;
			}
		}

		$ret = clone $first___;
		$next = clone $n_first___;
		while ($next != $last___) {
			iter_swap($first___, $next);
			$first___->_F_next();
			$next->_F_next();
			if ($first___ == $n_first___) {
				$n_first___ = clone $next;
			} else if($next == $last___) {
				$next = clone $n_first___;
			}
		}
		return $ret;
	}

	function rotate_copy(
		  basic_iterator $first___
		, basic_iterator $n_first___
		, basic_iterator $last___
		, basic_iterator $d_out_first___
	) {
		return copy(
			  $first___
			, clone $n_first___
			, copy($n_first___, $last___, $d_out_first___)
		);
	}

	function partition(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		while ($first___ != $last___) {
			while ($unaryPredicate___($first___->_F_this())) {
				$first___->_F_next();
				if ($first___ == $last___) {
					return $first___;
				}
			}
			do {
				$last___->_F_prev();
				if ($first___ == $last___) {
					return $first___;
				}
			} while (!$unaryPredicate___($last___->_F_this()));
			iter_swap($first___, $last___);
			$first___->_F_next();
		}
		return $first___;
	}

	function partition_point(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		$dist = iter_distance($first___, $last___);
		while ($dist > 0)
		{
			$it = clone $first___;
			$step = \intdiv($dist, 2);
			$it->_F_advance($step);
			if ($unaryPredicate___($it->_F_this())) {
				$first___ = clone $it->_F_next();
				$dist -= ($step + 1);
			} else {
				$dist = $step;
			}
		}
		return first;
	}

	function min(
		           &$a___
		,          &$b___
		, callable  $compare___ = null
	) {
		$p = $compare___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		return ($p($b___, $a___)) ? $b___ : $a___;
	}

	function max(
		           &$a___
		,          &$b___
		, callable  $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		return ($p($a___, $b___)) ? $b___ : $a___;
	}

	function minmax(
		           &$v1___
		,          &$v2___
		, callable  $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function (&$l, &$r) { return $l < $r; };
		}
		if ($p($v1___, $v2___)) {
			return new pair($v2___, $v1___);
		}
		return new pair($v1___, $v2___);
	}

	function min_element(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		if ($first___ == $last___) {
			return $last___;
		}
		$smallest = clone $first___;
		$first___->_F_next();
		for (; $first___ != $last___; $first___->_F_next()) {
			if ($p($first___->_F_this(), $smallest->_F_this())) {
				$smallest = clone $first___;
			}
		}
		return $smallest;
	}

	function max_element(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($comp)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		if ($first___ == $last___) {
			return $last___;
		}
		$largest = clone $first___;
		$first___->_F_next();
		for (; $first___ != $last___; $first___->_F_next()) {
			if ($p($largest->_F_this(), $first___->_F_this())) {
				$largest = clone $first___;
			}
		}
		return $largest;
	}

	function mismatch(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			while ($first1___ != $last1___) {
				if ($first1___->_F_this() != $first2___->_F_this()) {
					break;
				}
				$first1___->_F_next();
				$first2___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return new pair($first1___, $first2___);
	}

	function mismatch_b(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, callable       $binaryPredicate___ = null
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l == $r; };
			}
			while ($first1___ != $last1___) {
				if (!$p($first1___->_F_this(), $first2___->_F_this())) {
					break;
				}
				$first1___->_F_next();
				$first2___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return new pair($first1___, $first2___);
	}

	function prev_permutation(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___ == $last___) {
				return false;
			}
			$it0 = clone $last___;
			if ($first___ == $it0->_F_prev()) {
				return false;
			}
			while (true) {
				$it1 = clone $it0;
				if ($it1->_F_this() < $it0->_F_prev()->_F_this()) {
						$it2 = clone $last___;
						while (!($it2->_F_prev()->_F_this() < $it0->_F_this())) { /* NOP */ }
						iter_swap($it0, $it2);
						reverse($it1, $last___);
						return true;
				}
				if ($it0 == $first___) {
					reverse($first___, $last___);
					break;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function prev_permutation_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l < $r; };
			}
			if ($first___ == $last___) {
				return false;
			}
			$it0 = clone $last___;
			if ($first___ == $it0->_F_prev()) {
				return false;
			}
			while (true) {
				$it1 = clone $it0;
				if ($it1->_F_this() < $it0->_F_prev()->_F_this()) {
						$it2 = clone $last___;
						while (!($it2->_F_prev()->_F_this() < $it0->_F_this())) { /* NOP */ }
						iter_swap($it0, $it2);
						reverse($it1, $last___);
						return true;
				}
				if ($it0 == $first___) {
					reverse($first___, $last___);
					break;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function next_permutation(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$it0 = clone $last___;
			if ($first___ == $last___ || $first___ == $it0->_F_prev()) {
				return false;
			}
			while (true) {
				$it1 = clone $it0;
				if ($p($it0->_F_prev()->_F_this(), $it1->_F_this())) {
						$it2 = clone $last___;
						while (!$p($it0->_F_this(), $it2->_F_prev()->_F_this())) { /* NOP */ }
						iter_swap($it0, $it2);
						reverse($it1, $last___);
						return true;
				}
				if ($it0 == $first___) {
					reverse($first___, $last___);
					break;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function next_permutation_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l < $r; };
			}
			$it0 = clone $last___;
			if ($first___ == $last___ || $first___ == $it0->_F_prev()) {
				return false;
			}
			while (true) {
				$it1 = clone $it0;
				if ($p($it0->_F_prev()->_F_this(), $it1->_F_this())) {
						$it2 = clone $last___;
						while (!$p($it0->_F_this(), $it2->_F_prev()->_F_this())) { /* NOP */ }
						iter_swap($it0, $it2);
						reverse($it1, $last___);
						return true;
				}
				if ($it0 == $first___) {
					reverse($first___, $last___);
					break;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function is_permutation(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			for (; $first1___ != $last1___; $first1___->_F_next(), $first2___->_F_next()) {
				if (!($first1___->_F_this() == $first2___->_F_this())) {
					$c0 = iter_distance($first1___, $last1___);
					if ($c0 == 1) {
						return false;
					}
					$last2 = clone iter_next($first2___, $c0);
					$it0   = clone $first1___;
					for (; $it0 != $last1___; $it0->_F_next()) {
						$it1 = clone $first1___;
						for (; $it1 != $it0; $it1->_F_next()) {
							if ($it1->_F_this() == $it0->_F_this()) {
								goto JUMP_NEXT_;
							}
						}
						$c2 = 0;
						$it1 = clone $first2___;
						for (; $it1 != $last2; $it1->_F_next()) {
							if ($it0->_F_this() == $it1->_F_this()) {
								++$c2;
							}
						}
						if ($c2 == 0) {
							return false;
						}
						$c1 = 1;
						$it1 = clone $it0->_F_next();
						for (; $it1 != $last1___; $it1->_F_next()) {
							if ($it0->_F_this() == $it1->_F_this()) {
								++$c1;
							}
						}
						if ($c1 != $c2) {
							return false;
						}
				JUMP_NEXT_:
					}
				}
			}
			return true;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function is_permutation_b(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l == $r; };
			}
			for (; $first1___ != $last1___; $first1___->_F_next(), $first2___->_F_next()) {
				if (!$p($first1___->_F_this(), $first2___->_F_this())) {
					$c0 = iter_distance($first1___, $last1___);
					if ($c0 == 1) {
						return false;
					}
					$last2 = clone iter_next($first2___, $c0);
					$it0   = clone $first1___;
					for (; $it0 != $last1___; $it0->_F_next()) {
						$it1 = clone $first1___;
						for (; $it1 != $it0; $it1->_F_next()) {
							if ($p($it1->_F_this(), $it0->_F_this())) {
								goto JUMP_NEXT_;
							}
						}
						$c2 = 0;
						$it1 = clone $first2___;
						for (; $it1 != $last2; $it1->_F_next()) {
							if ($p($it0->_F_this(), $it1->_F_this())) {
								++$c2;
							}
						}
						if ($c2 == 0) {
							return false;
						}
						$c1 = 1;
						$it1 = clone $it0->_F_next();
						for (; $it1 != $last1___; $it1->_F_next()) {
							if ($p($it0->_F_this(), $it1->_F_this())) {
								++$c1;
							}
						}
						if ($c1 != $c2) {
							return false;
						}
				JUMP_NEXT_:
					}
				}
			}
			return true;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function swap_ranges(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
	) {
		while ($first1___ != $last1___) {
			iter_swap($first1___, $first2___);
			$first1___->_F_next();
			$first2___->_F_next();
		}
		return $first2___;
	}

	function copy(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$out___->_F_assign(_F_copy($first___->_F_this()));
				$out___->_F_next();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function copy_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$v = $first___->_F_this();
				if ($unaryPredicate___($v)) {
					$out___->_F_assign(_F_copy($v));
					$out___->_F_next();
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function copy_n(
		  basic_iterator $first___
		, int            $count___
		, basic_iterator $out___
	) {
		$i = 0;
		while ($i < $count___) {
			$out___->_F_assign(_F_copy($first___->_F_this()));
			$out___->_F_next();
			$first___->_F_next();
			++$i;
		}
		return $out___;
	}

	function copy_backward(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$out___->_F_assign(_F_copy($last___->_F_this()));
				$last___->_F_prev();
				$out___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function lazy_copy(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$out___->_F_assign($first___->_F_this());
				$out___->_F_next();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function lazy_copy_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$v = $first___->_F_this();
				if ($unaryPredicate___($v)) {
					$out___->_F_assign($v);
					$out___->_F_next();
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function lazy_copy_n(
		  basic_iterator $first___
		, int            $count___
		, basic_iterator $out___
	) {
		$i = 0;
		while ($i < $count___) {
			$out___->_F_assign($first___->_F_this());
			$out___->_F_next();
			$first___->_F_next();
			++$i;
		}
		return $out___;
	}

	function lazy_copy_backward(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$out___->_F_assign($last___->_F_this());
				$last___->_F_prev();
				$out___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function fill(basic_iterator $first___, basic_iterator $last___, $val___)
	{
		while ($first___ != $last___) {
			$first___->_F_assign($val___);
			$first___->_F_next();
		}
	}

	function fill_n(basic_iterator $first___, int $count___, $val___)
	{
		for ($i = 0; $i < $count___; $i++) {
			$first___->_F_assign($val___);
			$first___->_F_next();
		}
		return $first___;
	}

	function generate(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $generator___
	) {
		while ($first___ != $last___) {
			$first___->_F_assign($generator___());
			$first___->_F_next();
		}
	}

	function generate_n(
		  basic_iterator $first___
		, int            $count___
		, callable       $generator___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$first___->_F_assign($generator___());
			$first___->_F_next();
		}
	}

	function place_fill_n(
		  insert_iterator $out___
		, int             $count___
		,                 $val___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$out___->_F_assign($val___);
			$out___->_F_next();
		}
	}

	function place_generate_n(
		  insert_iterator $out___
		, int             $count___
		, callable        $generator___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$out___->_F_assign($generator___());
			$out___->_F_next();
		}
	}

	function place_iota(
		  insert_iterator $out___
		, int             $count___
		,                 $val___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$out___->_F_assign($val___);
			$out___->_F_next();
			++$val___;
		}
	}

	function place_iota_f(
		  insert_iterator $out___
		, int             $count___
		,                 $val___
		, callable        $nextOperation___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$out___->_F_assign($val___);
			$out___->_F_next();
			$val___ = $nextOperation___($val___);
		}
	}

	function iota(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
	) {
		while ($first___ != $last___) {
			$first___->_F_assign($val___);
			$first___->_F_next();
			++$val___;
		}
	}

	function iota_f(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $nextOperation___
	) {
		while ($first___ != $last___) {
			$first___->_F_assign($val___);
			$first___->_F_next();
			$val___ = $nextOperation___($val___);
		}
	}

	function merge(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		if (
			$first1___::iterator_category === $last1___::iterator_category &&
			$first2___::iterator_category === $last2___::iterator_category
		) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l < $r; };
			}
			while ($first1___ != $last1___) {
				if ($first2___ == $last2___) {
					return copy($first1___, $last1___, $out___);
				}
				if ($p($first2___->_F_this(), $first1___->_F_this())) {
					$out___->_F_assign($first2___->_F_this());
					$first2___->_F_next();
				} else {
					$out___->_F_assign($first1___->_F_this());
					$first1___->_F_next();
				}
				$out___->_F_next();
			}
			return copy($first2___, $last2___, $out___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function reverse(basic_iterator $first___, basic_iterator $last___)
	{
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___ && ($first___ != $last___->_F_prev())) {
				iter_swap($first___, $last___);
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
	}

	function unique(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___ == $last___) {
			return $last___;
		}
		$it = clone $first___;
		while ($first___->_F_next() != $last___) {
			if (!($it->_F_this() == $first___->_F_this()) && $it->_F_next() != $first___) {
				$it->_F_assign($first___->_F_this());
			}
		}
		$it->_F_next();
		return $it;
	}
	
	function unique_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l == $r; };
		}
		if ($first___ == $last___) {
			return $last___;
		}
		$it = clone $first___;
		while ($first___->_F_next() != $last___) {
			if (!$p($it->_F_this(), $first___->_F_this()) && $it->_F_next() != $first___) {
				$it->_F_assign($first___->_F_this());
			}
		}
		$it->_F_next();
		return $it;
	}

	function unique_copy(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___ == $last___) {
				return $out___;
			}
			$out___->_F_assign($first___->_F_this());
			while ($first___ != $last___) {
				$first___->_F_next();
				$v = $first___->_F_this();
				if ($out___->_F_this() != $v) {
					$out___->_F_next();
					$out___->_F_assign($v);
				}
			}
			$out___->_F_next();
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function unique_copy_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, &$r) { return $l == $r; };
			}
			if ($first___ == $last___) {
				return $out___;
			}
			$out___->_F_assign($first___->_F_this());
			while ($first___ != $last___) {
				$first___->_F_next();
				$v = $first___->_F_this();
				if (!$p($out___->_F_this(), $v)) {
					$out___->_F_next();
					$out___->_F_assign($v);
				}
			}
			$out___->_F_next();
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function accumulate(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $init___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$init___ = $init___ + $first___->_F_this();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $init___;
	}

	function accumulate_b(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $init___
		, callable       $binaryOperation___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$op = $binaryOperation___;
			if (\is_null($op)) {
				$op = function (&$l, $r) { return $l + $r; };
			}
			while ($first___ != $last___) {
				$init___ = $op($init___, $first___->_F_this());
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $init___;
	}

	function partial_sum(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
	) {
		if ($first___ == $last___) {
			return $out___;
		}
		$sum = $first___->_F_this();
		$out___->_F_assign($sum);
		while ($first___ != $last___) {
			$first___->_F_next();
			$sum = $sum + $first___->_F_this();
			$out___->_F_next();
			$out___->_F_assign($sum);
		}
		$out___->_F_next();
		return $out___;
	}

	function partial_sum_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
		, callable       $binaryOperation___ = null
	) {
		$op = $binaryOperation___;
		if (\is_null($op)) {
			$op = function ($l, $r) { return $l + $r; };
		}
		if ($first___ == $last___) {
			return $out___;
		}
		$sum = $first___->_F_this();
		$out___->_F_assign($sum);
		while ($first___->_F_next() != $last___) {
			$sum = $op($sum, $first___->_F_this());
			$out___->_F_next();
			$out___->_F_assign($sum);
		}
		$out___->_F_next();
		return $out___;
	}

	function inner_product(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		,                $init___
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			while ($first1___ != $last1___) {
				$init___ = $init___ + ($first1___->_F_this() * $first2___->_F_this());
				$first1___->_F_next();
				$first2___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $init___;
	}

	function inner_product_b(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		,                $init___
		, callable       $binaryOperation1___ = null
		, callable       $binaryOperation2___ = null
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			$op1 = $binaryOperation1___;
			$op2 = $binaryOperation2___;
			if (\is_null($op1)) {
				$op1 = function ($l, $r) { return $l + $r; };
			}
			if (\is_null($op2)) {
				$op2 = function ($l, $r) { return $l * $r; };
			}
			while ($first1___ != $last1___) {
				$init___ = $op1($init___, $op2($first1___->_F_this(), $first2___->_F_this()));
				$first1___->_F_next();
				$first2___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $init___;
	}

	function & find(basic_iterator $first___, basic_iterator $last___, $val___)
	{
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($first___->_F_this() == $val___) {
					return $first___;
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function & find_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($unaryPredicate___($first___->_F_this())) {
					return $first___;
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function & find_if_not(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if (!$unaryPredicate___($first___->_F_this())) {
					return $first___;
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function find_first_of(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $s_first___
		, basic_iterator $s_last___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l == $r; };
			}
			while ($first___ != $last___) {
				$it = clone $s_first___;
				while ($it != $s_last___) {
					if ($p($first___->_F_this(), $it->_F_this())) {
						return $first___;
					}
					$it->_F_next();
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function find_end(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $s_first___
		, basic_iterator $s_last___
	) {
		if ($s_first___ == $s_last___) {
			return $last___;
		}
		$it = clone $last___;
		while (true) {
			$search = search($first___, $last___, $s_first___, $s_last___);
			if ($search == $last___) {
					return $it;
			} else {
					$it = $search;
					$first___ = clone $it;
					$first___->_F_next();
			}
		}
		return $it;
	}

	function includes(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		for (; $first2___ != $last2___; $first1___->_F_next())
		{
			if (($first1___ == $last1___) || $p($first2___->_F_this(), $first1___->_F_this())) {
				return false;
			}
			if (!$p($first1___->_F_this(), $first2___->_F_this())) {
				$first2___->_F_next();
			}
		}
		return true;
	}

	function adjacent_find(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___ == $last___) {
				return $last___;
			}
			$next = clone $first___;
			$next->_F_next();
			while ($next != $last___) {
				if ($first___->_F_this() == $next->_F_this()) {
					return $first___;
				}
				$next->_F_next();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function adjacent_find_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l == $r; };
			}
			if ($first___ == $last___) {
				return $last___;
			}
			$next = clone $first___;
			$next->_F_next();
			while ($next != $last___) {
				if ($p($first___->_F_this(), $next->_F_this())) {
					return $first___;
				}
				$next->_F_next();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $last___;
	}

	function all_of(basic_iterator $first___, basic_iterator $last___, callable $unaryPredicate___)
	{ return find_if_not($first___, $last___, $unaryPredicate___) == $last___; }

	function any_of(basic_iterator $first___, basic_iterator $last___, callable $unaryPredicate___)
	{ return find_if($first___, $last___, $unaryPredicate___) != $last___; }

	function none_of(basic_iterator $first___, basic_iterator $last___, callable $unaryPredicate___)
	{ return find_if($first___, $last___, $unaryPredicate___) == $last___; }

	function for_each(basic_iterator $first___, basic_iterator $last___, callable $unaryFunction___)
	{
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$unaryFunction___($first___->_F_this());
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $unaryFunction___;
	}

	function for_each_n(
		  basic_iterator $first___
		, int            $count___
		, callable       $unaryFunction___
	) {
		for ($i = 0; $i < $count___; $i++) {
			$unaryFunction___($first___->_F_this());
			$first___->_F_next();
		}
		return $first___;
	}

	function search(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l == $r; };
		}
		while ($first1___ != $last1___) {
			$it1 = clone $first1___;
			$it2 = clone $first2___;
			while (true) {
				if ($it2 == $last2___) {
					return $first1___;
				}
				if ($it1 == $last1___) {
					return $last1___;
				}
				if (!$p($it1->_F_this(), $it2->_F_this())) {
					break;
				}
				$it1->_F_next();
				$it2->_F_next();
			}
			$first1___->_F_next();
		}
		return $last1___;
	}

	function search_n(
		  basic_iterator $first___
		, basic_iterator $last___
		, int            $count___
		,                $val___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l == $r; };
		}
		while ($first___ != $last___) {
			if (!$p($first___->_F_this(), $val___)) {
				continue;
			}
			$it = clone $first___;
			$cur_count = 0;
			while (true) {
				++$cur_count;
				if ($cur_count === $count___) {
					 return $it;
				}
				$first___->_F_next();
				if ($first___ == $last___) {
					return $last___;
				}
				if (!$p($first___->_F_this(), $val___)) {
					break;
				}
			}
			$first___->_F_next();
		}
		return $last___;
	}

	function equal(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, callable       $binaryPredicate___ = null
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l == $r; };
			}
			while ($first1___ != $last1___) {
				if (!$p($first1___->_F_this(), $first2___->_F_this())) {
					return false;
				}
				$first1___->_F_next();
				$first2___->_F_next();
			}
			return true;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function count_element(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
	) {
		$ret = 0;
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($first___->_F_this() == $val___) {
					$ret++;
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $ret;
	}

	function count_element_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		$ret = 0;
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($unaryPredicate___($first___->_F_pos(), $first___->_F_this())) {
					$ret++;
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $ret;
	}

	function count(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
	) { return count_element($first___, $last___, $val___); }

	function count_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) { return count_element_if($first___, $last___, $unaryPredicate___); }

	function set_intersection(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		if (
			$first1___::iterator_category === $last1___::iterator_category &&
			$first2___::iterator_category === $last2___::iterator_category
		) {
			while ($first1___ != $last1___ && $first2___ != $last2___) {
				if ($p($first1___->_F_this(), $first2___->_F_this())) {
						$first1___->_F_next();
				} else {
					if (!$p($first2___->_F_this(), $first1___->_F_this())) {
							$out___->_F_assign($first1___->_F_this());
							$out___->_F_next();
							$first1___->_F_next();
					}
					$first2___->_F_next();
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function set_difference(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		while ($first1___ != $last1___) {
			if (first2 == last2) {
				return copy($first1___, $last1___, $out___);
			}
			if ($p($first1___->_F_this(), $first2___->_F_this())) {
				$out___->_F_assign($first1___->_F_this());
				$out___->_F_next();
				$first1___->_F_next();
			} else {
				if (!$p($first2___->_F_this(), $first1___->_F_this())) {
					$first1___->_F_next();
				}
				$first2___->_F_next();
			}
		}
		return $out___;
	}

	function set_symmetric_difference(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		while ($first1___ != $last1___) {
			if ($first2___ == $last2___) {
				return copy($first1___, $last1___, $out___);
			}
			if ($p($first1___->_F_this(), $first2___->_F_this())) {
				$out___->_F_assign($first1___->_F_this());
				$out___->_F_next();
				$first1___->_F_next();
			} else {
				if ($p($first2___->_F_this(), $first1___->_F_this())) {
					$out___->_F_assign($first2___->_F_this());
					$out___->_F_next();
				} else {
					$first1___->_F_next();
				}
				$first2___->_F_next();
			}
		}
		return copy($first2___, $last2___, $out___);
	}

	function set_union(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, basic_iterator $out___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		while ($first1___ != $last1___) {
			if ($first2___ == $last2___)
				return copy($first1___, $last1___, $out___);
			if ($p($first2___->_F_this(), $first1___->_F_this())) {
				$out___->_F_assign($first2___->_F_this());
				$first2___->_F_next();
			} else {
				$out___->_F_assign($first1___->_F_this());
				if (!$p($first1___->_F_this(), $first2___->_F_this())) {
					$first2___->_F_next();
				}
				$first1___->_F_next();
			}
			$out___->_F_next();
		}
		return copy($first2___, $last2___, $out___);
	}

	function replace(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $old_value___
		,                $new_value___
	) {
		if ($first___ != $last___) {
			while ($first___ != $last___) {
				if ($first___->_F_this() == $old_value___) {
					$first___->_F_assign($new_value);
				}
				$first___->_F_next();
			}
		}
	}

	function replace_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
		, $new_value___
	) {
		if ($first___ != $last___) {
			while ($first___ != $last___) {
				if ($unaryPredicate___($first___->_F_this())) {
					$first___->_F_assign($new_value);
				}
				$first___->_F_next();
			}
		}
	}

	function remove(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
	) {
		$first___ = find_if($first___, $last___, $unaryPredicate___);
		if ($first___ != $last___) {
			$it = clone $first___;
			while ($it != $last___) {
				$v = $it->_F_this();
				if (!($v == $val___)) {
					$first___->_F_assign($v);
					$first___->_F_next();
				}
				$it->_F_next();
			}
		}
		return $first___;
	}

	function remove_if(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		$first___ = find_if($first___, $last___, $unaryPredicate___);
		if ($first___ != $last___) {
			$it = clone $first___;
			while ($it != $last___) {
				$v = $it->_F_this();
				if (!$unaryPredicate___($v)) {
					$first___->_F_assign($v);
					$first___->_F_next();
				}
				$it->_F_next();
			}
		}
		return $first___;
	}

	function transform(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $out___
		, callable       $unaryOperation___
	) {
		while ($first___ != $last___) {
			$out___->_F_assign(
				$unaryOperation___($first___->_F_this())
			);
			$out___->_F_next();
			$first___->_F_next();
		}
		return $out___;
	}

	function transform_b(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $out___
		, callable       $binaryOperation___
	) {
		while ($first1___ != $last1___) {
			$out___->_F_assign(
				$binaryOperation___($first1___->_F_this(), $first2___->_F_this())
			);
			$out___->_F_next();
			$first1___->_F_next();
			$first2___->_F_next();
		}
		return $out___;
	}

	function transform_s(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $out___
		, callable       $unaryOperation___
	) {
		while ($first1___ != $last1___) {
			$c = $unaryOperation___($first1___->_F_this());
			copy($c->begin(), $c->end(), $out___);
			$first1___->_F_next();
		}
	}

	function lexicographical_compare(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		while (($first1___ != $last1___) && ($first2___ != $last2___)) {
			if ($p($first1___->_F_this(), $first2___->_F_this())) {
				return 1;
			}
			if ($p($first2___->_F_this(), $first1___->_F_this())) {
				return 0;
			}
			$first1___->_F_next();
			$first2___->_F_next();
		}
		return ($first1___ == $last1___) && ($first2___ != $last2___);
	}

	function sort(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $compare___ = null
	) { _F_slice_sort($first___, $last___, $compare___); }

	function stable_sort(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $compare___ = null
	) { _F_slice_stable_sort($first___, $last___, $compare___); }
} /* EONS */

/* EOF */