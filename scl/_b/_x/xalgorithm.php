<?php
# -*- coding: utf-8 -*-

//
// xalgorithm.php
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
	function _X_compare(
		  basic_iteratable &$c1___
		, basic_iteratable &$c2___
		, callable          $compare___ = null
	) {
		$r = _X_u8gh_cmp(\strval($s1___), \strval($s2___), $compare___);
		if ($r < 0) {
			return comparison_result::ascending;
		}
		if ($r > 0) {
			return comparison_result::descending;
		}
		return comparison_result::same;
	}

	function _X_compare_s(
		  string   $u8s1___
		, string   $u8s2___
		, callable $compare___ = null
	) {
		$r = _X_u8gh_cmp($u8s1___, $u8s2___, $compare___);
		if ($r < 0) {
			return comparison_result::ascending;
		}
		if ($r > 0) {
			return comparison_result::descending;
		}
		return comparison_result::same;
	}

	function _X_compare_r(
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
				$first1___->_M_ptr::container_category === basic_iteratable_tag::basic_u8string &&
				$first2___->_M_ptr::container_category === basic_iteratable_tag::basic_u8string
		)) {
			$s1 = _X_u8gh_substr(
				\strval($first1___->_M_ptr)
				, $first1___->_F_pos()
				, distance($first1___, $last1___)
			);
			$s2 = _X_u8gh_substr(
				\strval($first2___->_M_ptr)
				, $first2___->_F_pos()
				, distance($first2___, $last2___)
			);
			$r = _X_u8gh_cmp($s1, $s2, $compare___);
			if ($r < 0) {
				return comparison_result::ascending;
			}
			if ($r > 0) {
				return comparison_result::descending;
			}
			return comparison_result::same;
		}
		_X_throw_invalid_argument("Invalid type error");
		return comparison_result::ascending;
	}

	function _X_sort(
		  basic_iteratable &$c___
		, callable $compare___ = null
	) {
		if ($c___->_M_size) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				if (!\is_null($compare___)) {
					\uksort($c___->_M_container, $compare___);
				} else {
					\ksort($c___->_M_container);
				}
			} else if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_sort_r(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $compare___ = null
	) {
		if (
			$first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$first___::iterator_category === basic_iterator_tag::insert_iterator
		) {
			_X_throw_invalid_argument("Invalid type error");
		}
		if ($first___->_M_ptr->_M_size) {
			if ($first___->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				_X_sort($first___->_M_ptr, $compare___);
				$first___->_F_seek_end();
				$last___->_F_seek_end();
			} else if ($first___->_M_ptr::container_category === basic_iteratable_tag::basic_forward_list) {
				$slice = array_slice(
					  $first___->_M_ptr->_F_dump()
					, $first___->_M_offset
					, distance($first___, $last___)
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
					, $first___->_M_offset
					, distance($first___, $last___)
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

	function _X_stable_sort(
		  basic_iteratable &$c___
		, callable $compare___ = null
	) {
		if ($c___->_M_size > 1) {
			$comp = $compare___;
			if (\is_null($comp)) {
				$comp = function($l, $r) { \strcmp(\strval($l), \strval($r)); };
			}
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				$a1 = array_keys($c___->_M_container);
				$a2 = [];
				$c___->_M_size = _X_merge_usort(
					  $a1
					, $c___->_M_size
					, $comp
				);
				foreach ($a1 as $k) {
					$a2[$k] = $c___->_M_container[$k];
				}
				$c___->_M_container = $a2;
			} else if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$a = $c___->_F_dump();
				_X_merge_usort(
					  $a
					, $c___->_M_size
					, $comp
				);
				$c___->_F_from_array($a, true);
			} else {
				$c___->_M_size = _X_merge_usort(
					  $c___->_M_container
					, $c___->_M_size
					, $comp
				);
			}
		}
	}

	function _X_intersection(
		  basic_iteratable $c1___
		, basic_iteratable $c2___
		, insert_iterator $out_first___
	) {
		if (
			$out_first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$out_first___::iterator_category === basic_iterator_tag::ostream_iterator
		) {
			_X_throw_invalid_argument("Invalid type error");
		}
		if ($c1___->_M_size && $c2___->_M_size) {
			$c1 = null;
			$c2 = null;
			if ($c1___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c1 = $c1___->_F_dump();
			}
			if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c2 = $c2___->_F_dump();
			}
			if ($out_first___->_M_ptr::container_category === basic_iteratable_tag::basic_forward_list) {
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
			_X_throw_invalid_argument("Invalid type error");
		}
		return $out_first___;
	}

	function _X_difference(
		  basic_iteratable $c1___
		, basic_iteratable $c2___
		, insert_iterator $out_first___
	) {
		if (
			$out_first___::iterator_category === basic_iterator_tag::duo_iterator ||
			$out_first___::iterator_category === basic_iterator_tag::ostream_iterator
		) {
			_X_throw_invalid_argument("Invalid type error");
		}
		if ($c1___->_M_size && $c2___->_M_size) {
			$c1 = null;
			$c2 = null;
			if ($c1___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c1 = $c1___->_F_dump();
			}
			if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c2 = $c2___->_F_dump();
			}
			if ($out_first___->_M_ptr::container_category === basic_iteratable_tag::basic_forward_list) {
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
			_X_throw_invalid_argument("Invalid type error");
		}
		return $out_first___;
	}

	function _X_unique(basic_iteratable &$c___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$a = \array_unique($c___->_F_dump(), SORT_REGULAR);
				$c___->_F_from_array($a, true);
			} else {
				if (\is_null($binaryPredicate___)) {
					$c___->_M_container = \array_unique($c___->_M_container, SORT_REGULAR);
					$c___->_M_size = \count($c___->_M_container);
				} else {
					_X_unique_b($c___, $binaryPredicate___);
				}
			}
		}
	}

	function _X_unique_b(basic_iteratable &$c___, callable $binaryPredicate___ = null)
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

	function _X_reverse(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_rev();
			} else {
				$c___->_M_container = \array_reverse($c___->_M_container);
			}
		}
	}

	function _X_insert(basic_iteratable &$c___, int $pos___, $val___)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
			$c___->_F_insert_at_index($pos___, $val___);
		} else {
			\array_splice($c___->_M_container, $position, 0, $val___);
			$c___->_M_size = \count($c___->_M_container);
		}
	}

	function _X_slice(basic_iteratable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			$slice = null;
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_splice(basic_iteratable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_merge_usort(
		  array &$a___
		, callable $compare___
	) {
		$sz = \count($a___);
		if ($sz > 1) {
			$mid = \intval($sz / 2);
			$a_1 = \array_slice($a___, 0, $mid);
			$a_2 = \array_slice($a___, $mid);

			_X_merge_usort($a_1, $compare___);
			_X_merge_usort($a_2, $compare___);

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

	function _X_push_front(basic_iteratable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_push_back(basic_iteratable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_pop_front(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_first();
			} else {
				\array_shift($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}

	function _X_pop_back(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_last();
			} else {
				\array_pop($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}
	
	function _X_offset_exists(basic_iteratable &$c___, $offset___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
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

	function _X_value_exists(basic_iteratable &$c___, $val___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 0) {
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
					return $c___->_F_find_data($val___) > 0 ? true : false;
				} else {
					/*
					foreach ($c___->_M_container as $k => $v) {
						if ($v == $val__) {
							return true;
						}
					}
					*/
					return \in_array($val___, $c___->_M_container);
				}
			} else {
				if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_offsets(basic_iteratable &$c1___, basic_iteratable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iteratable_tag::basic_dict) {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
					$a = \array_keys($c1___->_M_container);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \array_keys($c1___->_M_container);
					$c2___->_M_size = $c1___->_M_size;
				}
			} else {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
					$a = \range(0, $c1___->_M_size -1);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \range(0, $c1___->_M_size -1);
					$c2___->_M_size = $c1___->_M_size;
				}
			}
		}
	}

	function _X_values(basic_iteratable &$c1___, basic_iteratable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iteratable_tag::basic_forward_list) {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_reindex(basic_iteratable &$c___)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_dict) {
			_X_throw_invalid_argument("Invalid type error");
		} else {
			if ($c___::container_category !== basic_iteratable_tag::basic_forward_list) {
				$c___->_M_container = \array_values($c___->_M_container);
			}
		}
	}

	function _X_remove(basic_iteratable &$c___, $val___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_all_data($val___);
			} else {
				if ($c___::container_category === basic_iteratable_tag::basic_dict) {
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
						_X_splice($c___, $v, 1);
					}
				}
			}
		}
	}

	function _X_remove_first_n(basic_iteratable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
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
					_X_splice($c___, $v, 1);
				}
			}
		}
	}

	function _X_remove_first(basic_iteratable &$c___, $val___)
	{ _X_remove_first_n($c___, $val___, 1); }

	function _X_remove_last_n(basic_iteratable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				_X_throw_invalid_argument("Invalid type error");
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
					_X_splice($c___, $v, 1);
				}
			}
		}
	}

	function _X_remove_last(basic_iteratable &$c___, $val___)
	{ _X_remove_last_n($c___, $val___, 1); }

	function _X_remove_if(basic_iteratable &$c___, callable $unaryPredicate___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				_X_throw_invalid_argument("Invalid type error");
			} else {
				$idx = [];
				for ($i = 0; $i < $c___->_M_size; $i++) {
					if ($unaryPredicate___($c___->_M_container[$i])) {
						$idx[] = $i;
					}
				}
				foreach ($idx as &$v) {
					_X_splice($c___, $v, 1);
				}
			}
		}
	}

	function _X_reserve(basic_iteratable &$c___, int $sz___, $val___ = ignore)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_dict) {
			_X_throw_invalid_argument("Invalid type error");
		} else {
			_X_clear_all($c___);
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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

	function _X_clear_all(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_clear_all();
			} else {
				$c___->_M_container = [];
				$c___->_M_size = 0;
			}
		}
	}

	const _N_encodingtab = [
		  "auto"
		, "UTF-8"
		, "UTF-32"
		, "UTF-32BE"
		, "UTF-32LE"
		, "UTF-16"
		, "UTF-16BE"
		, "UTF-16LE"
		, "ISO-8859-1"
		, "ISO-8859-2"
		, "ISO-8859-3"
		, "ISO-8859-4"
		, "ISO-8859-5"
		, "ISO-8859-6"
		, "ISO-8859-7"
		, "ISO-8859-8"
		, "ISO-8859-9"
		, "ISO-8859-10"
		, "ISO-8859-13"
		, "ISO-8859-14"
		, "ISO-8859-15"
		, "ISO-8859-16"
	];

	function _X_u8gh_len($c___)
	{
		$cp = \ord($c___);
		if ($cp < 0x80) { return 1; }
		else if (($cp & 0xE0) == 0xC0) { return 2; }
		else if (($cp & 0xF0) == 0xE0) { return 3; }
		else if (($cp & 0xF8) == 0xF0) { return 4; }
		else if (($cp & 0xFC) == 0xF8) { return 5; }
		else if (($cp & 0xFE) == 0xFC) { return 6; }
		_X_throw_error("Invalid UTF-8 codepoint");
		return 0;
	}

	function _X_u8gh_offset($c___)
	{ return _X_u8gh_len(c) -1; }

	function _X_u8gh_is_valid(string &$s___)
	{
		for ($i = 0 ; i < memlen($s___) ; $i++) {
			if (_X_u8gh_len($s___[$i]) === 0) {
				return false;
			}
		}
		return true;
	}

	function _X_u8gh_pos(string $s1___, string $s2___, int $pos = 0)
	{
		if (false === ($found = \mb_strpos($s1___, $s2___, $pos, "UTF-8"))) {
			$found = -1;
		}
		return $found;
	}

	function _X_u8gh_ipos(string $s1___, string $s2___, int $pos = 0)
	{
		if (false === ($found = \mb_stripos($s1___, $s2___, $pos, "UTF-8"))) {
			$found = -1;
		}
		return $found;
	}

	function _X_u8gh_coll(string $s1___, string $s2___, locale_t $xloc___ = null)
	{
		if (\is_null($xloc___)) {
			return strcoll($s1___, $s2___);
		}
		return strcoll_l($s1___, $s2___, $xloc___);
	}

	function _X_u8gh_have_bom(string &$s___)
	{
		$r = false;
		if (isset($s___[2])) {
			$b1 = \ord($s___[0]);
			$b2 = \ord($s___[1]);
			$b3 = \ord($s___[2]);
			if ($b1 == 0xEF && $b2 == 0xBB && $b3 == 0xBF) {
				$r = true;
			}
		}
		return $r;
	}

	function _X_u8gh_get_bom()
	{ return \chr(0xEF) . \chr(0xBB) . \chr(0xBF); }

	function _X_u8gh_add_bom(string &$s___)
	{
		if (!_X_u8gh_have_bom($s___)) {
			$s___ = _X_u8gh_get_bom() . $s___;
		}
	}

	function _X_u8gh_del_bom(string &$s___)
	{
		if (_X_u8gh_have_bom($s___)) {
			$s___ = memsub($s___, 3, memlen($s___));
		}
	}

	function _X_u8gh_guess(string $s___)
	{
		if (false !== ($enc = \mb_detect_encoding($s___, "auto"))) {
			return \array_search($enc, _N_encodingtab[$enc]);
		}
		return -1;
	}

	function _X_u8gh_is_utf8(string $s___)
	{  return _X_u8gh_guess($s___) == 1; }

	function _X_u8gh_check(string $s___, int $enc___)
	{  return _X_u8gh_guess($s___) == $enc___; }

	function _X_u8gh_convert(string $s___, int $enc___)
	{ return \mb_convert_encoding($s___, "UTF-8", _N_encodingtab[$enc___]); }

	function _X_u8gh_count(string $s___)
	{
		$out = [];
		@\preg_match_all("/./u", $s___, $out);
		return \count($out[0]);
	}

	function _X_u8gh_split(string $s___, int &$cnt___, int $l___ = 1)
	{
		if ($l___ > 1) {
			$out = [];
			@\preg_match_all("/./u", $s___, $out);
			$arr = \array_chunk($out[0], $l___);
			$out = \array_map('\implode', $arr);
			$cnt = \count($out);
			return $out;
		}
		$out = @\preg_split("//u", $s___, -1, PREG_SPLIT_NO_EMPTY);
		$cnt___ = \count($out);
		return $out;
	}

	function _X_u8gh_subv(string $s___, int $pos___, int $len___ = -1)
	{
		$out = [];
		@\preg_match_all("/./u", $s___, $out);
		return \array_slice($out[0], $pos___, $len___ < 1 ? null : $len___);
	}

	function _X_u8gh_substr(string $s___, int $pos___, int $len___ = -1)
	{ return @\implode('', _X_u8gh_subv($s___, $pos___, $len___)); }

	function _X_u8gh_cmp(string $s1___, string $s2___, $cmp___ = null)
	{
		if (\is_null($loc___)) {
			return \strcmp($s1___, $s2___);
		}
		return $cmp___($s1___, $s2___);
	}

	function _X_u8gh_substr_cmp(
		  string $s1___
		, string $s2___
		, int $pos___ = 0
		, int $len___ = -1
		, $cmp___ = null
	) {
		if (\is_null($cmp___)) {
			if ($len___ < 1) {
				return \substr_compare($s1___, $s2___, $pos___);
			}
			return \substr_compare($s1___, $s2___, $pos___, $len___);
		}
		$s1 = _X_u8gh_substr($s1___, $pos___, $len___);
		$s2 = _X_u8gh_substr($s2___, $pos___, $len___);
		return $cmp___($s1, $s2);
	}

	function _X_u8_find(basic_u8string &$s1___, basic_u8string &$s2___, int $pos = 0)
	{ return _X_u8gh_pos(\strval($s1___), \strval($s2___), $pos); }

	function _X_u8_rfind(basic_u8string &$s1___, basic_u8string &$s2___, int $pos = 0)
	{ return _X_u8gh_ipos(\strval($s1___), \strval($s2___), $pos); }

	function _X_u8_cmp(basic_u8string &$s1___, basic_u8string &$s2___, callable $cmp___ = null)
	{
		if (\is_null($loc___)) {
			return \strcmp(\strval($s1___), \strval($s2___));
		}
		return $cmp___($s1___, $s2___);
	}

	function _X_u8_substr_cmp(
		  basic_u8string &$s1___
		, basic_u8string &$s2___
		, int $pos___ = 0
		, int $len___ = -1
		, callable $cmp___ = null
	) {
		if ($pos___ == 0 && $len___ < 1) {
			return _X_u8_cmp($s1___, $s2___, $cmp___);
		}
		if (\is_null($cmp___)) {
			if ($len___ == numeric_limits_int::max) {
				return \substr_compare(\strval($s1___), \strval($s2___), $pos___);
			}
			return \substr_compare(\strval($s1___), \strval($s2___), $pos___, $len___);
		}
		$s1 = _X_u8gh_substr(\strval($s1___), $pos___, $len___);
		$s2 = _X_u8gh_substr(\strval($s2___), $pos___, $len___);
		return $cmp___($s1, $s2);
	}

	function _X_u8gh_to_u16(string $s___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo === endian_utils::little ? "UTF-16LE" : "UTF-16BE")
			, "UTF-8"
		);
	}

	function _X_u8gh_to_u32(string $s___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo === endian_utils::little ? "UTF-32LE" : "UTF-32BE")
			, "UTF-8"
		);
	}

	function _X_u16gh_convert(string $s___, int $enc___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo ? "UTF-16LE" : "UTF-16BE")
			, _N_encodingtab[$enc___]
		);
	}

	function _X_u32gh_convert(string $s___, int $enc___, int $byte_order___ = endian_utils::big)
	{
		$bo = $byte_order___;
		if ($bo === endian_utils::host) {
			$bo = host_byte_order();
		}
		return \mb_convert_encoding(
			  $s___
			, ($bo ? "UTF-32LE" : "UTF-32BE")
			, _N_encodingtab[$enc___]
		);
	}
} /* EONS */

/* EOF */