<?php
# -*- coding: utf-8 -*-

//
// scl_base_algorithm.php
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
	function _F_compare(
		  basic_iterable &$c1___
		, basic_iterable &$c2___
		, callable          $compare___ = null
	) {
		if (
			$c1___::container_category === basic_iterable_tag::basic_u8string &&
			$c2___::container_category === basic_iterable_tag::basic_u8string
		) {
			$r = _F_u8gh_cmp(\strval($c1__), \strval($c2___), $compare___);
			if ($r < 0) {
				return comparison_result::ascending;
			}
			if ($r > 0) {
				return comparison_result::descending;
			}
			return comparison_result::same;
		}
		if ($c1___ < $c2___) {
			return comparison_result::ascending;
		}
		if ($c1___ > $c2___) {
			return comparison_result::descending;
		}
		return comparison_result::same;
	}

	function _F_string_compare(
		  string   $u8s1___
		, string   $u8s2___
		, callable $compare___ = null
	) {
		$r = _F_u8gh_cmp($u8s1___, $u8s2___, $compare___);
		if ($r < 0) {
			return comparison_result::ascending;
		}
		if ($r > 0) {
			return comparison_result::descending;
		}
		return comparison_result::same;
	}

	function _F_range_compare(
		  basic_iterator $first1___
		, basic_iterator $last1___
		, basic_iterator $first2___
		, basic_iterator $last2___
		, callable       $compare___ = null
	) {
		if ((
				$first1___::iterator_category !== basic_iterator_tag::duo_iterator &&
				$first2___::iterator_category !== basic_iterator_tag::insert_iterator
			) && (
				$first1___->_M_ptr::container_category === basic_iterable_tag::basic_u8string &&
				$first2___->_M_ptr::container_category === basic_iterable_tag::basic_u8string
		)) {
			$s1 = _F_u8gh_substr(
				\strval($first1___->_M_ptr)
				, $first1___->_F_pos()
				, iter_distance($first1___, $last1___)
			);
			$s2 = _F_u8gh_substr(
				\strval($first2___->_M_ptr)
				, $first2___->_F_pos()
				, iter_distance($first2___, $last2___)
			);
			$r = _F_u8gh_cmp($s1, $s2, $compare___);
			if ($r < 0) {
				return comparison_result::ascending;
			}
			if ($r > 0) {
				return comparison_result::descending;
			}
			return comparison_result::same;
		}
		_F_throw_invalid_argument("Invalid type error");
		return comparison_result::ascending;
	}

	function _F_sort_all(
		  basic_iterable &$c___
		, callable $compare___ = null
	) {
		if ($c___->_M_size) {
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				if (!\is_null($compare___)) {
					\uksort($c___->_M_container, $compare___);
				} else {
					\ksort($c___->_M_container);
				}
			} else if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$a = $c___->_F_dump();
				if (!\is_null($compare___)) {
					\usort($a, $compare___);
				} else {
					\sort($a);
				}
				$c___->_F_from_array($a, true);
			} else {
				if (!\is_null($compare___)) {
					\usort($c___->_M_container, $compare___);
				} else {
					\sort($c___->_M_container);
				}
			}
		}
	}

	function _F_range_sort(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $compare___ = null
	) {
		if (
			$first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$first___::iterator_category === basic_iterator_tag::insert_iterator
		) {
			_F_throw_invalid_argument("Invalid type error");
		}
		if ($first___->_M_ptr->_M_size) {
			if ($first___->_M_ptr::container_category === basic_iterable_tag::basic_dict) {
				_F_sort_all($first___->_M_ptr, $compare___);
				$first___->_F_seek_end();
				$last___->_F_seek_end();
			} else if ($first___->_M_ptr::container_category === basic_iterable_tag::basic_forward_list) {
				$slice = array_slice(
					  $first___->_M_ptr->_F_dump()
					, $first___->_M_pos
					, iter_distance($first___, $last___)
				);
				if (!\is_null($compare___)) {
					\usort($slice, $compare___);
				} else {
					\sort($slice);
				}
				$i = 0;
				while ($first___ != $last___) {
					$first___->_F_assign($slice[$i]);
					$first___->_F_next();
					++$i;
				}
			} else {
				$slice = \array_slice(
					$first___->_M_ptr->_M_container
					, $first___->_M_pos
					, iter_distance($first___, $last___)
				);
				if (!\is_null($compare___)) {
					\usort($slice, $compare___);
				} else {
					\sort($slice);
				}
				$i = 0;
				while ($first___ != $last___) {
					$first___->_F_assign($slice[$i]);
					$first___->_F_next();
					++$i;
				}
			}
		}
	}

	function _F_stable_sort(
		  basic_iterable &$c___
		, callable $compare___ = null
	) {
		if ($c___->_M_size > 1) {
			$comp = $compare___;
			if (\is_null($comp)) {
				$comp = function($l, $r) { \strcmp(\strval($l), \strval($r)); };
			}
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				$a1 = array_keys($c___->_M_container);
				$a2 = [];
				$c___->_M_size = _F_merge_usort(
					  $a1
					, $c___->_M_size
					, $comp
				);
				foreach ($a1 as $k) {
					$a2[$k] = $c___->_M_container[$k];
				}
				$c___->_M_container = $a2;
			} else if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$a = $c___->_F_dump();
				_F_merge_usort(
					  $a
					, $c___->_M_size
					, $comp
				);
				$c___->_F_from_array($a, true);
			} else {
				$c___->_M_size = _F_merge_usort(
					  $c___->_M_container
					, $c___->_M_size
					, $comp
				);
			}
		}
	}

	function _F_intersection(
		  basic_iterable $c1___
		, basic_iterable $c2___
		, insert_iterator $out_first___
	) {
		if (
			$out_first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$out_first___::iterator_category === basic_iterator_tag::ostream_iterator
		) {
			_F_throw_invalid_argument("Invalid type error");
		}
		if ($c1___->_M_size && $c2___->_M_size) {
			$c1 = null;
			$c2 = null;
			if ($c1___::container_category === basic_iterable_tag::basic_forward_list) {
				$c1 = $c1___->_F_dump();
			}
			if ($c2___::container_category === basic_iterable_tag::basic_forward_list) {
				$c2 = $c2___->_F_dump();
			}
			if ($out_first___->_M_ptr::container_category === basic_iterable_tag::basic_forward_list) {
				$a = \array_values(
					\array_intersect(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_F_from_array($a, true);
				$out_first___->_F_seek_end();
			} else {
				$out_first___->_M_ptr->_M_container = \array_values(
					\array_intersect(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_M_size = \count($out_first___->_M_ptr->_M_container);
				$out_first___->_F_seek_end();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out_first___;
	}

	function _F_difference(
		  basic_iterable $c1___
		, basic_iterable $c2___
		, insert_iterator $out_first___
	) {
		if (
			$out_first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$out_first___::iterator_category === basic_iterator_tag::ostream_iterator
		) {
			_F_throw_invalid_argument("Invalid type error");
		}
		if ($c1___->_M_size && $c2___->_M_size) {
			$c1 = null;
			$c2 = null;
			if ($c1___::container_category === basic_iterable_tag::basic_forward_list) {
				$c1 = $c1___->_F_dump();
			}
			if ($c2___::container_category === basic_iterable_tag::basic_forward_list) {
				$c2 = $c2___->_F_dump();
			}
			if ($out_first___->_M_ptr::container_category === basic_iterable_tag::basic_forward_list) {
				$a = \array_values(
					\array_diff(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_F_from_array($a, true);
				$out_first___->_F_seek_end();
			} else {
				$out_first___->_M_ptr->_M_container = \array_values(
					\array_diff(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_M_size = \count($out_first___->_M_ptr->_M_container);
				$out_first___->_F_seek_end();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out_first___;
	}

	function _F_unique(basic_iterable &$c___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$a = \array_unique($c___->_F_dump(), SORT_REGULAR);
				$c___->_F_from_array($a, true);
			} else {
				if (\is_null($binaryPredicate___)) {
					$c___->_M_container = \array_unique($c___->_M_container, SORT_REGULAR);
					$c___->_M_size = \count($c___->_M_container);
				} else {
					_F_unique_b($c___, $binaryPredicate___);
				}
			}
		}
	}

	function _F_unique_b(basic_iterable &$c___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 1) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function(&$l, &$r) { return $l == $r; };
			}
			$o = [];
			$c = \count($c___->_M_container);
			for ($i = 0; $i < $c; $i++) {
				$t = $c___->_M_container[$i];
				$j = $i;
				for ($k = 0; $k < $c; $k++) {
					if ($k != $j) {
						if (!$p($t, $c___->_M_container[$k])) {
							$o[] = $c___->_M_container[$k];
						}
					}
				}
			}
			$c___->_M_container = $o;
			$c___->_M_size = \count($c___->_M_container);
		}
	}

	function _F_reverse(basic_iterable &$c___)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$c___->_F_rev();
			} else {
				$c___->_M_container = \array_reverse($c___->_M_container);
			}
		}
	}

	function _F_insert(basic_iterable &$c___, int $pos___, $val___)
	{
		if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
			$c___->_F_insert_at_index($pos___, $val___);
		} else {
			\array_splice($c___->_M_container, $position, 0, $val___);
			$c___->_M_size = \count($c___->_M_container);
		}
	}

	function _F_slice(basic_iterable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			$slice = null;
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				if ($len___ === numeric_limits_int::max) {
					$slice = \array_slice($c___->_F_dump(), $pos___);
				} else {
					$slice = \array_slice($c___->_F_dump(), $pos___, $len___);
				}
				$c___->_F_from_array($slice, true);
			} else {
				if ($len___ === numeric_limits_int::max) {
					$slice = \array_slice($c___->_M_container, $pos___);
				} else {
					$slice = \array_slice($c___->_M_container, $pos___, $len___);
				}
				$c___->_M_container = $slice;
				$c___->_M_size = \count($c___->_M_container);
			}
		}
	}

	function _F_splice(basic_iterable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$a = $c___->_F_dump();
				if ($len___ === numeric_limits_int::max) {
					\array_splice($a, $pos___);
				} else {
					\array_splice($a, $pos___, $len___);
				}
				$c___->_F_from_array($a, true);
			} else {
				if ($len___ === numeric_limits_int::max) {
					\array_splice($c___->_M_container, $pos___);
				} else {
					\array_splice($c___->_M_container, $pos___, $len___);
				}
				$c___->_M_size = \count($c___->_M_container);
			}
		}
	}

	function _F_merge_usort(
		  array &$a___
		, callable $compare___
	) {
		$sz = \count($a___);
		if ($sz > 1) {
			$mid = \intdiv($sz, 2);
			$a_1 = \array_slice($a___, 0, $mid);
			$a_2 = \array_slice($a___, $mid);

			_F_merge_usort($a_1, $compare___);
			_F_merge_usort($a_2, $compare___);

			if ($compare___(\end($a_1), $a_2[0]) < 1) {
				$a___ = \array_merge($a_1, $a_2);
				return \count($a___);
			} else {
				$a___ = [];
				$i_1 = 0;
				$i_2 = 0;
				while ($i_1 < \count($a_1) && $i_2 < \count($a_2)) {
					if ($compare___($a_1[$i_1], $a_2[$i_2]) != 1) {
						$a___[] = $a_1[$i_1++];
					}
					else {
						$a___[] = $a_2[$i_2++];
					}
				}
				while ($i_1 < \count($a_1)) { 
					$a___[] = $a_1[$i_1++];
				}
				while ($i_2 < \count($a_2)) {
					$a___[] = $a_2[$i_2++];
				}
				return \count($a___);
			}
		}
		return $sz;
	}

	function _F_push_front(basic_iterable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
			$c___->_F_insert_first($val___);
		} else {
			if (\is_null($key)) {
				if ($c___->_M_size > 0) {
					$c___->_M_size = \array_unshift($c___->_M_container, $val___);
				} else {
					$c___->_M_container[] = $val___;
					++$c___->_M_size;
				}
			} else {
				if ($c___->_M_size > 0) {
					$c___->_M_container = [ $key => $val___ ] + $c___->_M_container;
				} else {
					$c___->_M_container = [ $key => $val___ ];
				}
				++$c___->_M_size;
			}
		}
	}

	function _F_push_back(basic_iterable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
			$c___->_F_insert_last($val___);
		} else {
			if (\is_null($key)) {
				$c___->_M_container[$c___->_M_size] = $val___;
			} else {
				if ($c___->_M_size > 0) {
					$c___->_M_container = $c___->_M_container + [ $key => $val___ ];
				} else {
					$c___->_M_container = [ $key => $val___ ];
				}
			}
			++$c___->_M_size;
		}
	}

	function _F_pop_front(basic_iterable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$c___->_F_del_first();
			} else {
				\array_shift($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}

	function _F_pop_back(basic_iterable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$c___->_F_del_last();
			} else {
				\array_pop($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}
	
	function _F_offset_exists(basic_iterable &$c___, $offset___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				if (\is_null($binaryPredicate___)) {
					return \array_key_exists($c___->_M_container, $offset___);
				} else {
					foreach ($c___->_M_container as $k => $v) {
						if ($binaryPredicate___($k, $offset___)) {
							return true;
						}
					}
				}
			} else {
				if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $c___->_M_size)) {
					return true;
				}
			}
		}
		return false;
	}

	function _F_value_exists(basic_iterable &$c___, $val___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 0) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
					return $c___->_F_find_data($val___) > 0 ? true : false;
				} else {
					/*
					foreach ($c___->_M_container as $k => $v) {
						if ($v == $val___) {
							return true;
						}
					}
					*/
					return \in_array($val___, $c___->_M_container);
				}
			} else {
				if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
					return $c___->_F_index_of_data($val___, $p) != -1 ? true : false;
				} else {
					foreach ($c___->_M_container as $k => $v) {
						if ($p($v, $val___)) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

	function _F_offsets(basic_iterable &$c1___, basic_iterable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iterable_tag::basic_dict) {
				if ($c2___::container_category === basic_iterable_tag::basic_forward_list) {
					$a = \array_keys($c1___->_M_container);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \array_keys($c1___->_M_container);
					$c2___->_M_size = $c1___->_M_size;
				}
			} else {
				if ($c2___::container_category === basic_iterable_tag::basic_forward_list) {
					$a = \range(0, $c1___->_M_size -1);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \range(0, $c1___->_M_size -1);
					$c2___->_M_size = $c1___->_M_size;
				}
			}
		}
	}

	function _F_values(basic_iterable &$c1___, basic_iterable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iterable_tag::basic_forward_list) {
				if ($c2___::container_category === basic_iterable_tag::basic_forward_list) {
					$a = \array_values($c1___->_F_dump());
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \array_values($c1___->_F_dump());
					$c2___->_M_size = $c1___->_M_size;
				}
			} else {
				$c2___->_M_container = \array_values($c1___->_M_container);
				$c2___->_M_size = $c1___->_M_size;
			}
		}
	}

	function _F_reindex(basic_iterable &$c___)
	{
		if ($c___::container_category === basic_iterable_tag::basic_dict) {
			_F_throw_invalid_argument("Invalid type error");
		} else {
			if ($c___::container_category !== basic_iterable_tag::basic_forward_list) {
				$c___->_M_container = \array_values($c___->_M_container);
			}
		}
	}

	function _F_remove(basic_iterable &$c___, $val___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$c___->_F_del_all_data($val___);
			} else {
				if ($c___::container_category === basic_iterable_tag::basic_dict) {
					$keys = [];
					foreach ($c___->_M_container as $k => &$v) {
						if ($v == $val___) {
							$keys[] = $k;
						}
					}
					unset($v);
					foreach ($keys as &$v) {
						unset($c___->_M_container[$v]);
					}
				} else {
					$idx = [];
					for ($i = 0; $i < $c___->_M_size; $i++) {
						if ($c___->_M_container[$i] == $val___) {
							$idx[] = $i;
						}
					}
					foreach ($idx as &$v) {
						_F_splice($c___, $v, 1);
					}
				}
			}
		}
	}

	function _F_remove_first_n(basic_iterable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				$keys = [];
				$j = 0;
				foreach ($c___->_M_container as $k => &$v) {
					if ($v == $val___) {
						$keys[] = $k;
						++$j;
					}
					if ($j >= $n___) {
						break;
					}
				}
				unset($v);
				foreach ($keys as &$v) {
					unset($c___->_M_container[$v]);
				}
			} else {
				$idx = [];
				$j = 0;
				for ($i = 0; $i < $c___->_M_size; $i++) {
					if ($c___->_M_container[$i] == $val___) {
						$idx[] = $i;
						++$j;
					}
					if ($j >= $n___) {
						break;
					}
				}
				foreach ($idx as &$v) {
					_F_splice($c___, $v, 1);
				}
			}
		}
	}

	function _F_remove_first(basic_iterable &$c___, $val___)
	{ _F_remove_first_n($c___, $val___, 1); }

	function _F_remove_last_n(basic_iterable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				_F_throw_invalid_argument("Invalid type error");
			} else {
				$idx = [];
				$j = 0;
				for ($i = $c___->_M_size - 1; $i >= 0; $i--) {
					if ($c___->_M_container[$i] == $val___) {
						$idx[] = $i;
						++$j;
					}
					if ($j >= $n___) {
						break;
					}
				}
				foreach ($idx as &$v) {
					_F_splice($c___, $v, 1);
				}
			}
		}
	}

	function _F_remove_last(basic_iterable &$c___, $val___)
	{ _F_remove_last_n($c___, $val___, 1); }

	function _F_remove_if(basic_iterable &$c___, callable $unaryPredicate___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_dict) {
				_F_throw_invalid_argument("Invalid type error");
			} else {
				$idx = [];
				for ($i = 0; $i < $c___->_M_size; $i++) {
					if ($unaryPredicate___($c___->_M_container[$i])) {
						$idx[] = $i;
					}
				}
				foreach ($idx as &$v) {
					_F_splice($c___, $v, 1);
				}
			}
		}
	}

	function _F_reserve(basic_iterable &$c___, int $sz___, $val___ = ignore)
	{
		if ($c___::container_category === basic_iterable_tag::basic_dict) {
			_F_throw_invalid_argument("Invalid type error");
		} else {
			_F_clear_all($c___);
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				for ($i = 0 ; $i <= $sz___; $i++) {
					$c___->_F_insert_last($val___);
				}
				
			} else {
				for ($i = 0 ; $i <= $sz___; $i++) {
					$c___->_M_container[] = $val___;
					++$c___->_M_size;
				}
			}
		}
	}

	function _F_clear_all(basic_iterable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iterable_tag::basic_forward_list) {
				$c___->_F_clear_all();
			} else {
				$c___->_M_container = [];
				$c___->_M_size = 0;
			}
		}
	}
} /* EONS */

/* EOF */