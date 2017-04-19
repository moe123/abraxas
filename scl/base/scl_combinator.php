<?php
# -*- coding: utf-8 -*-

//
// scl_combinator.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @brief      Functional combinators library,  \(^o^)/ @Haskell.
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	function & each_in(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			for_each($first___, $last___, $unaryFunction___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & every_of(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$res = false;
			while($first___ != $last___) {
				if (!$unaryFunction___($first___->_F_this())) {
					$res = false;
					break;
				}
				$res = true;
			}
			return $res;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function & some_of(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$res = false;
			while($first___ != $last___) {
				if ($unaryFunction___($first___->_F_this())) {
					$res = true;
					break;
				}
				$res = false;
			}
			return $res;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return false;
	}

	function & apply_to(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			transform($first___, $last___, clone $first___, $unaryFunction___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function flat_to(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_iterator  $out___
		, callable $unaryOperation___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				$c = $unaryOperation___($first___->_F_this());
				lazy_copy($c->begin(), $c->end(), $out___);
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function to_one(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$it = clone $first___;
			sort($it, $last___);
			$it = unique_b($first___, $last___, $binaryPredicate___);
			$it___->_M_ptr->erase($it, $last___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function filter(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			filter_if_not($first___, $last___,
				function (&$v) use($unaryPredicate___) {
					return !$unaryPredicate___($v);
				}
			);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function filter_not(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$it = remove_if($first___, $last___, $unaryPredicate___);
			$it___->_M_ptr->erase($it, $last___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function foldr(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_ostream   $out___
		, callable        $binaryOperation___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___ == $last___) {
				_F_throw_invalid_argument("Invalid type error");
			} else {
				$buf = $first___->_F_this();
				$first___->_F_next();
				while ($first___ != $last___) {
					$buf = $binaryOperation___($buf, $first___->_F_this());
					$first___->_F_next();
				}
				$out___($buf);
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function foldl(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_ostream   $out___
		,                 $init___
		, callable        $binaryOperation___
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			$buf = $init___;
			while ($first___ != $last___) {
				$buf = $binaryOperation___($buf, $first___->_F_this());
				$first___->_F_next();
			}
			$out___($buf);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function combine_to(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_ostream   $out___
		, string          $join___ = ','
	) {
		if ($first___::iterator_category === $last___::iterator_category) {
			lazy_copy($first___, $last___, stream_inserter($out___, $join___));
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}
} /* EONS */

/* EOF */