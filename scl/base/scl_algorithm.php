<?php
# -*- coding: utf-8, tab-width: 3 -*-

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

declare(strict_types=1);

namespace std
{
	/*!
		template<Type>
		void swap(Type a, Type b);
	*/
	function swap(&$a___, &$b___)
	{
		$c    = $a___;
		$a___ = $b___;
		$b___ = $c;
	}

	/*!
		template<Type, BinaryPredicate = less>
		Type & clamp(
			  Type            &v
			, Type            &lo
			, Type            &hi
			, BinaryPredicate  pred
		);
	*/
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

	/*!
		template<Iter1, Iter2>
		void iter_swap(Iter1 it1, Iter2 it2);
	*/
	function iter_swap(basic_iterator &$it1___, basic_iterator &$it2___)
	{
		$v1 = $it1___->_F_this();
		$v2 = $it2___->_F_this();
		$it1___->_F_assign($v2);
		$it2___->_F_assign($v1);
	}

	/*!
		template<Iter>
		int iter_distance(Iter first, Iter last);
	*/
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

	/*!
		template<Iter, Integer n = -1>
		void iter_next(Iter it, Integer  n);
	*/
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

	/*!
		template<Iter, Integer n = -1>
		void iter_prev(Iter it, Integer  n);
	*/
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

	/*!
		template<Iter, Integer>
		Type iter_access(Iter it, Integer  pos);
	*/
	function iter_access(basic_iterator &$it___, int $pos___)
	{
		$pos = $it___->_F_pos();
		$it___->_F_seek($pos___);
		$v = $it___->_F_this();
		$it___->_F_seek($pos);
		return $v;
	}

	/*!
		template<Iter, Integer>
		void iter_switch(Iter it, Integer  pos1, Integer  pos2);
	*/
	function iter_switch(basic_iterator &$it___, int $pos1___, int $pos2___)
	{
		$pos = $it___->_F_pos();

		$it___->_F_seek($pos1___);
		$v1 = $it___->_F_this();

		$it___->_F_seek($pos2___);
		$v2 = $it___->_F_this();

		$it___->_F_seek($pos1___);
		$it___->_F_assign($v2);

		$it___->_F_seek($pos2___);
		$it___->_F_assign($v1);

		$it___->_F_seek($pos);
	}

	/*!
		template<Iter, Integer, Type>
		void iter_assign(Iter it, Integer pos, Type val);
	*/
	function iter_assign(basic_iterator &$it___, int $pos___, $val___)
	{
		$pos = $it___->_F_pos();
		$it___->_F_seek($pos___);
		$it___->_F_assign($val___);
		$it___->_F_seek($pos);
	}

	/*!
		template<Iter,  UniformRandomNumberGenerator = cryptographically_secure_engine>
		void shuffle(
			  Iter                         first
			, Iter                         last
			, UniformRandomNumberGenerator gen
		);
	*/
	function shuffle(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $gen___ = null
	) {
		$g = $gen___;
		if (\is_null($g)) {
			$g = new cryptographically_secure_engine;
		}
		$n = $last___->_F_pos() - $first___->_F_pos();
		$d = new uniform_int_distribution;
		for ($i = ($n - 1); $i > 0; --$i) {
			iter_switch($first___, $i, $d($g, 0, $i));
		}
	}

	/*!
		template<Iter>
		void shuffle(Iter first, Iter last);
	*/
	function random_shuffle(
		  basic_iterator $first___
		, basic_iterator $last___
	) { shuffle($first___, $last___); }

	/*!
		template<Iter, Type, BinaryPredicate = less>
		Iter lower_bound(
			  Iter            first
			, Iter            last
			, Type            val
			, BinaryPredicate pred
		);
	*/
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

	/*!
		template<Iter, Type, BinaryPredicate = less>
		Iter upper_bound(
			  Iter            first
			, Iter            last
			, Type            val
			, BinaryPredicate pred
		);
	*/
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

	/*!
		template<Iter, Type, BinaryPredicate = less>
		bool binary_search(
			  Iter            first
			, Iter            last
			, Type            val
			, BinaryPredicate pred
		);
	*/
	function binary_search(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function (&$l, $r) { return $l < $r; };
		}
		$first___ = lower_bound($first___, $last___, $val___, $p);
		return (!($first___ == $last___) && !($p($val___, $first___->_F_this())));
	}

	/*!
		template<Iter>
		Iter rotate(Iter first, Iter n_first, Iter last);
	*/
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

	/*!
		template<Iter, OutputIter>
		OutputIter rotate_copy(
			  Iter       first
			, Iter       n_first
			, Iter       last
			, OutputIter d_out_first
		);
	*/
	function rotate_copy(
		  basic_iterator $first___
		, basic_iterator $n_first___
		, basic_iterator $last___
		, basic_iterator $d_out_first___
	) {
		return lazy_copy(
			  $first___
			, clone $n_first___
			, copy(
				  $n_first___
				, $last___
				, $d_out_first___
		));
	}

	/*!
		template<Iter, UnaryPredicate>
		Iter partition(Iter first, Iter last, UnaryPredicate pred);
	*/
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

	/*!
		template<Iter, UnaryPredicate>
		Iter partition_point(Iter first, Iter last, UnaryPredicate pred);
	*/
	function partition_point(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		$cnt = iter_distance($first___, $last___);
		while ($cnt > 0) {
			$it = clone $first___;
			$step = \intdiv($cnt, 2);
			$it->_F_advance($step);
			if ($unaryPredicate___($it->_F_this())) {
				$first___ = clone $it->_F_next();
				$cnt -= ($step + 1);
			} else {
				$cnt = $step;
			}
		}
		return $first___;
	}

	/*!
		template<Iter, UnaryPredicate>
		bool is_partitioned(Iter first, Iter last, UnaryPredicate pred);
	*/
	function is_partitioned(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		for (; $first___ != $last___; $first___->_F_next()) {
			if (!$unaryPredicate___($first___->_F_this())) {
				break;
			}
		}
		if ( $first___ == $last___ ) {
			return true;
		}
		$first___->_F_next();
		for (; $first___ != $last___; $first___->_F_next()) {
			if ($unaryPredicate___($first___->_F_this())) {
				return false;
			}
		}
		return true;
	}

	/*!
		template<Type, BinaryPredicate = less>
		Type min(Type &a, Type &b, BinaryPredicate pred);
	*/
	function min(
		           &$a___
		,          &$b___
		, callable  $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		return ($p($b___, $a___)) ? $b___ : $a___;
	}

	/*!
		template<Type, BinaryPredicate = less>
		Type max(Type &a, Type &b, BinaryPredicate pred);
	*/
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

	/*!
		template<Type>
		pair<Type, Type> minmax(Type a, Type b);
	*/
	function minmax(&$a___, &$b___) {
		if ($a___ < $b___) {
			return new pair($b___, $a___);
		}
		return new pair($a___, $b___);
	}

	/*!
		template<Type, BinaryPredicate = less>
		pair<Type, Type> minmax_b(Type a, Type b, BinaryPredicate pred);
	*/
	function minmax_b(
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

	/*!
		template<Iter>
		Iter min_element(Iter first, Iter last);
	*/
	function min_element(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___ == $last___) {
			return $last___;
		}
		$smallest = clone $first___;
		$first___->_F_next();
		for (; $first___ != $last___; $first___->_F_next()) {
			if ($first___->_F_this() < $smallest->_F_this()) {
				$smallest = clone $first___;
			}
		}
		return $smallest;
	}

	/*!
		template<Iter, BinaryPredicate = less>
		Iter min_element_b(Iter first, Iter last, BinaryPredicate pred);
	*/
	function min_element_b(
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

	/*!
		template<Iter>
		Iter max_element(Iter first, Iter last);
	*/
	function max_element(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___ == $last___) {
			return $last___;
		}
		$largest = clone $first___;
		$first___->_F_next();
		for (; $first___ != $last___; $first___->_F_next()) {
			if ($largest->_F_this() < $first___->_F_this()) {
				$largest = clone $first___;
			}
		}
		return $largest;
	}

	/*!
		template<Iter, BinaryPredicate = less>
		Iter max_element_b(Iter first, Iter last, BinaryPredicate pred);
	*/
	function max_element_b(
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

	/*!
		template<Iter>
		pair<Iter, Iter> minmax_element(Iter first, Iter last);
	*/
	function minmax_element(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		$pair_it = new pair(clone $first___, clone $first___);
		if ($first___ != $last___) {
			if ($first___->_F_next() != $last___) {
				 if ($first___->_F_this() < $pair_it->first->_F_this()) {
					$pair_it->first = clone $first___;
				} else {
					$pair_it->second = clone $first___;
				}
				while ($first___->_F_next() != $last___) {
					$it = clone $first___;
					if ($first___->_F_next() == $last___) {
						if ($it->_F_this() < $pair_it->first->_F_this()) {
							$pair_it->first = clone $it;
						} else if (!($it->_F_this() < $pair_it->second->_F_this())) {
							$pair_it->second = clone $it;
						}
						break;
					} else {
						if ($first___->_F_this() < $it->_F_this()) {
							if ($first___->_F_this() < $pair_it->first->_F_this()) {
								$pair_it->first = clone $first___;
							}
							if ($it->_F_this() < $pair_it->second->_F_this()) {
								$pair_it->second = clone $it;
							}
						} else {
							if ($it->_F_this() < $pair_it->first->_F_this()) {
								$pair_it->first = clone $it;
							}
							if ($first___->_F_this() < $pair_it->second->_F_this()) {
								$pair_it->second = clone $first___;
							}
						}
					}
				}
			}
		}
		return $pair_it;
	}

	/*!
		template<Iter, BinaryPredicate = less>
		pair<Iter, Iter> minmax_element(
			  Iter first
			, Iter last
			, BinaryPredicate pred
		);
	*/
	function minmax_element_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		$pair_it = new pair(clone $first___, clone $first___);
		if ($first___ != $last___) {
			if ($first___->_F_next() != $last___) {
				 if ($p($first___->_F_this(), $pair_it->first->_F_this())) {
					$pair_it->first = clone $first___;
				} else {
					$pair_it->second = clone $first___;
				}
				while ($first___->_F_next() != $last___) {
					$it = clone $first___;
					if ($first___->_F_next() == $last___) {
						if ($p($it->_F_this(), $pair_it->first->_F_this())) {
							$pair_it->first = clone $it;
						} else if (!$p($it->_F_this(), $pair_it->second->_F_this())) {
							$pair_it->second = clone $it;
						}
						break;
					} else {
						if ($p($first___->_F_this(), $it->_F_this())) {
							if ($p($first___->_F_this(), $pair_it->first->_F_this())) {
								$pair_it->first = clone $first___;
							}
							if (!$p($it->_F_this(), $pair_it->second->_F_this())) {
								$pair_it->second = clone $it;
							}
						} else {
							if ($p($it->_F_this(), $pair_it->first->_F_this())) {
								$pair_it->first = clone $it;
							}
							if (!$p($first___->_F_this(), $pair_it->second->_F_this())) {
								$pair_it->second = clone $first___;
							}
						}
					}
				 }
			}
		}
		return $pair_it;
	}

	/*!
		template<Iter1, Iter2>
		pair<Iter1, Iter2> mismatch(Iter1 first1, Iter1 last2, Iter2 first2);
	*/
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

	/*!
		template<Iter1, Iter2, BinaryPredicate = equal_to>
		pair<Iter1, Iter2> mismatch_b(
			  Iter1 first1
			, Iter1 last2
			, Iter2 first2
			, BinaryPredicate pred
		);
	*/
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

	/*!
		template<Iter>
		bool prev_permutation(Iter first, Iter last);
	*/
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

	/*!
		template<Iter, BinaryPredicate = less>
		bool prev_permutation_b(Iter first, Iter last, BinaryPredicate pred);
	*/
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

	/*!
		template<Iter>
		bool next_permutation(Iter first, Iter last);
	*/
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

	/*!
		template<Iter, BinaryPredicate = less>
		bool next_permutation_b(Iter first, Iter last, BinaryPredicate pred);
	*/
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

	/*!
		template<Iter1, Iter2>
		bool is_permutation(Iter1 first1, Iter1 last1, Iter2 first2);
	*/
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
								goto NEXT_ITER;
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
				NEXT_ITER:
					}
				}
			}
			return true;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	/*!
		template<Iter1, Iter2, BinaryPredicate = equal_to>
		bool is_permutation_b(
			  Iter1 first1
			, Iter1 last1
			, Iter2 first2
			, BinaryPredicate pred
		);
	*/
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
								goto NEXT_ITER;
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
				NEXT_ITER:
					}
				}
			}
			return true;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	/*!
		template<Iter1, Iter2>
		Iter2 swap_ranges(Iter1 first1, Iter1 last1, Iter2 first2);
	*/
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

	/*!
		template<Iter, OutputIter>
		OutputIter copy(Iter first, Iter last, OutputIter out);
	*/
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

	/*!
		template<Iter, OutputIter, UnaryPredicate>
		OutputIter copy_if(
			  Iter           first
			, Iter           last
			, OutputIter     out
			, UnaryPredicate pred
		);
	*/
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

	/*!
		template<Iter, Integer, OutputIter>
		OutputIter copy_n(Iter first, Integer count, OutputIter out);
	*/
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

	/*!
		template<Iter, OutputIter>
		OutputIter copy_backward(Iter first, Iter last, OutputIter out);
	*/
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

	/*!
		template<Iter, OutputIter>
		OutputIter lazy_copy(Iter first, Iter last, OutputIter out);
	*/
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

	/*!
		template<Iter, OutputIter, UnaryPredicate>
		OutputIter lazy_copy_if(
			  Iter           first
			, Iter           last
			, OutputIter     out
			, UnaryPredicate pred
		);
	*/
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

	/*!
		template<Iter, Integer, OutputIter>
		OutputIter lazy_copy_n(Iter first, Integer count, OutputIter out);
	*/
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

	/*!
		template<Iter, OutputIter>
		OutputIter lazy_copy_backward(Iter first, Iter last, OutputIter out);
	*/
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

	/*!
		template<Iter, Type>
		void fill(Iter first, Iter last, Type val);
	*/
	function fill(basic_iterator $first___, basic_iterator $last___, $val___)
	{
		while ($first___ != $last___) {
			$first___->_F_assign($val___);
			$first___->_F_next();
		}
	}

	/*!
		template<Iter, Integer, Type>
		Iter fill_n(Iter first, Integer count, Type val);
	*/
	function fill_n(basic_iterator $first___, int $count___, $val___)
	{
		for ($i = 0; $i < $count___; $i++) {
			$first___->_F_assign($val___);
			$first___->_F_next();
		}
		return $first___;
	}

	/*!
		template<Iter, Generator>
		void generate(Iter first, Iter last, Generator gen);
	*/
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

	/*!
		template<Iter, Integer, Generator>
		void generate_n(Iter first, Integer count, Generator gen);
	*/
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

	/*!
		template<OutputIter, Integer, Type>
		void place_fill_n(OutputIter out, Integer count, Type val);
	*/
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

	/*!
		template<OutputIter, Integer, Generator>
		void place_generate_n(OutputIter out, Integer count, Generator gen);
	*/
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

	/*!
		template<OutputIter, Integer, Type>
		void place_generate_n(OutputIter out, Integer count, Type val);
	*/
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

	/*!
		template<OutputIter, Integer, Type, IncrementalOperation>
		void place_generate_n(
			  OutputIter out
			, Integer count
			, Type val
			, IncrementalOperation op
		);
	*/
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

	/*!
		template<Iter, Type>
		void iota(Iter first, Iter last, Type val);
	*/
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

	/*!
		template<Iter, Type, IncrementalOperation>
		void iota_f(
			  Iter first
			, Iter last
			, Type val
			, IncrementalOperation op
		);
	*/
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
		for (; $first2___ != $last2___; $first1___->_F_next()) {
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

	function equal_range(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $val___
		, callable       $binaryPredicate___ = null
	) {
		if ($first1___::iterator_category === $last1___::iterator_category) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function ($l, $r) { return $l < $r; };
			}
			while ($cnt != 0) {
				$step = \intdiv($cnt, 2);
				$it = clone $first___;
				$it->_F_advance($step);
				if ($p($it->_F_this(), $val___)) {
					$first___ = clone $it->_F_next();
					$cnt -= ($step + 1);
				} else if ($p($val___, $it->_F_this())) {
					$last___ = clone $it;
					$cnt = $step;
				} else {
					$it2 = clone $it;
					return new pair(
						lower_bound($first___, $it, $val___, $p),
						upper_bound($it2->_F_next(), $last___, $val___, $p)
					);
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return new pair($first___, $first___);
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
				return lazy_copy($first1___, $last1___, $out___);
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
				return lazy_copy($first1___, $last1___, $out___);
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
		return lazy_copy($first2___, $last2___, $out___);
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
			if ($first2___ == $last2___) {
				return lazy_copy($first1___, $last1___, $out___);
			}
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
		return lazy_copy($first2___, $last2___, $out___);
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
			lazy_copy($c->begin(), $c->end(), $out___);
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

	function heap_siftup(
		  basic_iterator $first___
		, basic_iterator $last___
		, int            $len___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		if ($len___ > 1) {
			$len___ = \intdiv(($len___ - 2), 2);
			$it = clone $first___;
			$it->_F_advance($len___);
			if ($p($it->_F_this(), $last___->_F_prev()->_F_this())) {
				$top = $last___->_F_this();
				do {
					$last___->_F_assign($it->_F_this());
					$last___ = clone $it;
					if ($len___ == 0) {
						break;
					}
					$len___ = \intdiv(($len___ - 1), 2);
					$it = clone $first___;
					$it->_F_advance($len___);
				} while ($p($it->_F_this(), $top));
				$last___->_F_assign($top);
			}
		}
	}

	function heap_siftdown(
		  basic_iterator $first___
		, basic_iterator $last___
		, basic_iterator $start___
		, int            $len___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		$child_pos = $start___->_F_pos() - $first___->_F_pos();
		if ($len___ < 2 || \indiv(($len___ - 2), 2) < $child_pos) {
			return;
		}
		$child_pos = 2 * $child_pos + 1;
		$child_it = clone $first___;
		$child_it->_F_advance($child_pos);

		$it = clone $child_it;
		$it->_F_next();
		if (($child_pos + 1) < $len___ && $p($child_it->_F_this(), $it->_F_this())) {
			$child_it->_F_next();
			++$child_pos;
		}
		if ($p($child_it->_F_this(), $start___->_F_this())) {
			return;
		}
		$top = $start___->_F_this();
		do {
			$start___->_F_assign($child_it->_F_this());
			$start___ = clone $child_it;
			if (\intdiv(($len___ - 2), 2) < $child_pos) {
				break;
			}
			$child_pos = 2 * $child_pos + 1;
			$child_it = clone $first___;
			$child_it->_F_advance($child_pos);
			$it = clone $child_it;
			$it->_F_next();
			if (($child_pos + 1) < $len___ && $p($child_it->_F_this(), $it->_F_this())) {
				$child_it->_F_next();
				++$child_pos;
			}
		} while (!$p($child_it->_F_this(), $top));
		$start___->_F_assign($top);
	}

	function push_heap(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		heap_siftup(
			  $first___
			, $last___
			, ($last___->_F_pos() - $first___->_F_pos())
			, $p
		);
	}

	function pop_heap(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		$n  = $last___->_F_pos() - $first___->_F_pos();
		if ($n > 1) {
			iter_swap($first___, $last___->_F_prev());
			$start = clone $first___;
			heap_siftdown(
				  $first___
				, $last___
				, $start
				, ($n - 1)
				, $p
			);
		}
	}

	function sort_heap(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		$n  = $last___->_F_pos() - $first___->_F_pos();
		for (; $n > 1; $last___->_F_prev(), --$n) {
			iter_swap($first___, $last___->_F_prev());
			$start = clone $first___;
			heap_siftdown($first___, $last___, $start, ($n - 1), $p);
		}
	}

	function make_heap(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		$n  = $last___->_F_pos() - $first___->_F_pos();
		if ($n > 1) {
			for ($step = \intdiv(($n - 2), 2); $step >= 0; --$step) {
				$start = clone $first___;
				$start->_F_advance($step);
				heap_siftdown($first___, $last___, $start, $n, $p);
			}
		}
	}

	function sample(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, insert_iterator $out___
		, int             $n___
		, callable        $gen___ = null
	) {
		if (
			   $first___::iterator_category === $last___::iterator_category
			&& $n___ >= 0
		) {
			$g = $gen___;
			if (\is_null($g)) {
				$g = new cryptographically_secure_engine;
			}
			$n = iter_distance($first___, $last___);
			$d = new uniform_int_distribution;
			for ($n___ = min($n___, $n); $n___ != 0 ; $first___->_F_next()) {
				$r = $d($g, 0,  --$n);
				if ($r < $n___) {
					$out___->_F_assign($first___->_F_this());
					$out___->_F_next();
					--$n___;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}

	function reduce(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $init___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if (\is_null($init___)) {
				$init___ = $first___->_F_this();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return accumulate($first___, $last___, $init___);
	}

	function reduce_b(
		  basic_iterator $first___
		, basic_iterator $last___
		,                $init___
		, callable       $binaryOperation___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if (\is_null($init___)) {
				$init___ = $first___->_F_this();
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return accumulate_b($first___, $last___, $init___, $binaryOperation___);
	}

	function is_sorted_until(
		  basic_iterator $first___
		, basic_iterator $last___
	) {
		if ($first___ != $last___) {
			$it = clone $last___;
			while ($it->_F_next() != $last___) {
				if ($it->_F_this() < $last___->_F_this()) {
					return $it;
				}
				$last___ = clone $it;
			}
		}
		return $last___;
	}

	function is_sorted_until_b(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		$p = $binaryPredicate___;
		if (\is_null($p)) {
			$p = function ($l, $r) { return $l < $r; };
		}
		if ($first___ != $last___) {
			$it = clone $last___;
			while ($it->_F_next() != $last___) {
				if ($p($it->_F_this(), $last___->_F_this())) {
					return $it;
				}
				$last___ = clone $it;
			}
		}
		return $last___;
	}

	function is_sorted(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		if (\is_null($binaryPredicate___)) {
			return is_sorted_until($first___, $last___) == $last___;
		}
		return is_sorted_until_b($first___, $last___, $binaryPredicate___) == $last___;
	}

	function linear_sort(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		for (; $first___ != $last___; $first___->_F_next()) {
			iter_swap(
				  $first___
				, min_element_b(clone $first___, $last___, $binaryPredicate___)
			);
		}
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