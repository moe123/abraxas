<?php
# -*- coding: utf-8 -*-

//
// scl_builtin_algorithm.php
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
	function _F_builtin_sort(
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

	function _F_builtin_sort_r(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $compare___ = null
	) {
		if ($first___->_M_ptr->_M_size) {
			if ($first___->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				_F_builtin_sort($first___->_M_ptr, $compare___);
				$first___->_F_seek_end();
				$last___->_F_seek_end();
			} else if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
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
					$first___->_F_pos_assign($slice[$i]);
					$first___->_F_next();
					++$i;
				}
			} else {
				$slice = array_slice(
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
					$first___->_F_pos_assign($slice[$i]);
					$first___->_F_next();
					++$i;
				}
			}
		}
	}

	function _F_builtin_stable_sort(
		  basic_iteratable &$c___
		, callable $compare___ = null
	) {
		if ($c___->_M_size > 1) {
			$comp = $compare___;
			if (\is_null($comp)) {
				$comp = function(&$l, &$r) { \strcmp((string)$l, (string)$r); };
			}
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				$a1 = array_keys($c___->_M_container);
				$a2 = [];
				$c___->_M_size = _F_builtin_merge_usort(
					  $a1
					, $c___->_M_size
					, $comp
				);
				foreach ($a1 as $k) {
					$a2[$k] = $c___->_M_container[$k];
				}
				$c___->_M_container = $a2;
			} else if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$a = $c___->_M_ptr->_F_dump();
				_F_builtin_merge_usort(
					  $a
					, $c___->_M_size
					, $comp
				);
				$c___->_M_ptr->_F_from_array($a, true);
			} else {
				$c___->_M_size = _F_builtin_merge_usort(
					  $c___->_M_container
					, $c___->_M_size
					, $comp
				);
			}
		}
	}

	function _F_builtin_intersection(
		  basic_iteratable $c1___
		, basic_iteratable $c2___
		, insert_iterator $out_first___
	) {
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
				$a = array_values(
					array_intersect(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_F_from_array($a, true);
				$out_first___->_F_seek_end();
			} else {
				$out_first___->_M_ptr->_M_container = array_values(
					array_intersect(
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

	function _F_builtin_difference(
		  basic_iteratable $c1___
		, basic_iteratable $c2___
		, insert_iterator $out_first___
	) {
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
				$a = array_values(
					array_diff(
						  \is_null($c1) ? $c1___->_M_container : $c1
						, \is_null($c2) ? $c2___->_M_container : $c2
					)
				);
				$out_first___->_M_ptr->_F_from_array($a, true);
				$out_first___->_F_seek_end();
			} else {
				$out_first___->_M_ptr->_M_container = array_values(
					array_diff(
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

	function _F_builtin_unique(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$a = array_unique($c___->_F_dump(), SORT_REGULAR);
				$c___->_F_from_array($a, true);
			} else {
				$c___->_M_container = array_unique($c___->_M_container, SORT_REGULAR);
				$c___->_M_size = \count($c___->_M_container);
			}
		}
	}

	function _F_builtin_unique_b(basic_iteratable &$c___, callable $binaryPredicate___ = null)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				// TODO
				return;
			}
			$p = $binaryPredicate___;
			if (\is_null($p)) {
				$p = function(&$l, &$r) { return $l === $r; };
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

	function _F_builtin_reverse(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 1) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_rev();
			} else {
				$c___->_M_container = array_reverse($c___->_M_container);
			}
		}
	}

	function _F_builtin_insert(basic_iteratable &$c___, int $pos___, $val___)
	{
		array_splice($c___->_M_container, $position, 0, $val___);
		$c___->_M_size = \count($c___->_M_container);
	}

	function _F_builtin_slice(basic_iteratable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			$slice = null;
			if ($len___ === numeric_limits_int::max) {
				$slice = array_slice($c___->_M_container, $pos___);
			} else {
				$slice = array_slice($c___->_M_container, $pos___, $len___);
			}
			$c___->_M_container = $slice;
			$c___->_M_size = \count($c___->_M_container);
		}
	}

	function _F_builtin_splice(basic_iteratable &$c___, int $pos___, int $len___ = numeric_limits_int::max)
	{
		if ($c___->_M_size > 0) {
			$slice = null;
			if ($len___ === numeric_limits_int::max) {
				$slice = array_splice($c___->_M_container, $pos___);
			} else {
				$slice = array_splice($c___->_M_container, $pos___, $len___);
			}
			$c___->_M_size = \count($c___->_M_container);
		}
	}

	function _F_builtin_merge_usort(
		array &$a___
		, callable $compare___
	) {
		$sz = \count($a___);
		if ($sz > 1) {
			$mid = $sz / 2;
			$a_1 = array_slice($a___, 0, $mid);
			$a_2 = array_slice($a___, $mid);

			_F_builtin_merge_usort($a_1, $compare___);
			_F_builtin_merge_usort($a_2, $compare___);

			if ($compare___(\end($a_1), $a_2[0]) < 1) {
				$a___ = array_merge($a_1, $a_2);
				return \count($a___);
			} else {
				$a___ = [];
				$i_1 = 0;
				$i_2 = 0;
				while ($i_1 < \count($a_1) && $i_2 <\ count($a_2)) {
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

	function _F_builtin_push_front(basic_iteratable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
			$c___->_F_insert_first($val___);
		} else {
			if (\is_null($key)) {
				if ($c___->_M_size > 0) {
					$c___->_M_size = array_unshift($c___->_M_container, $val___);
				}
			} else {
				if ($c___->_M_size > 0) {
					$c___->_M_container = array($key => $val___) + $c___->_M_container;
				} else {
					$c___->_M_container = array($key => $val___);
				}
				++$c___->_M_size;
			}
		}
	}

	function _F_builtin_push_back(basic_iteratable &$c___, $val___, $key = null)
	{
		if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
			$c___->_F_insert_last($val___);
		} else {
			if (\is_null($key)) {
				$c___->_M_container[$c___->_M_size] = $val___;
			} else {
				if ($c___->_M_size > 0) {
					$c___->_M_container = $c___->_M_container + array($key => $val___);
				} else {
					$c___->_M_container = array($key => $val___);
				}
			}
			++$c___->_M_size;
		}
	}

	function _F_builtin_pop_front(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_first();
			} else {
				array_shift($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}

	function _F_builtin_pop_back(basic_iteratable &$c___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_last();
			} else {
				array_pop($c___->_M_container);
				--$c___->_M_size;
			}
		}
	}
	
	function _F_builtin_offset_exists(basic_iteratable &$c___, $offset___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_dict) {
				return array_key_exists($c___->_M_container, $offset___);
			} else {
				if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
					return true;
				}
			}
		}
		return false;
	}

	function _F_builtin_offsets(basic_iteratable &$c1___, basic_iteratable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iteratable_tag::basic_dict) {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
					$a = array_keys($c1___->_M_container);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = array_keys($c1___->_M_container);
					$c2___->_M_size = $c1___->_M_size;
				}
			} else {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
					$a = \range(0, $this->_M_size -1);
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = \range(0, $this->_M_size -1);
					$c2___->_M_size = $c1___->_M_size;
				}
			}
		}
	}

	function _F_builtin_values(basic_iteratable &$c1___, basic_iteratable &$c2___)
	{
		if ($c1___->_M_size > 0) {
			if ($c1___::container_category === basic_iteratable_tag::basic_forward_list) {
				if ($c2___::container_category === basic_iteratable_tag::basic_forward_list) {
					$a = array_keys($c1___->_F_dump());
					$c2___->_F_from_array($a, true);
				} else {
					$c2___->_M_container = array_keys($c1___->_F_dump());
					$c2___->_M_size = $c1___->_M_size;
				}
			} else {
				$c2___->_M_container = array_values($c1___->_M_container);
				$c2___->_M_size = $c1___->_M_size;
			}
		}
	}

	function _F_builtin_remove(basic_iteratable &$c___, $val___)
	{
		if ($c___->_M_size > 0) {
			if ($c___::container_category === basic_iteratable_tag::basic_forward_list) {
				$c___->_F_del_all_data($val___);
			} else {
				$idx = [];
				for ($i = 0; $i < $c___->_M_size; $i++) {
					if ($c___->_M_container[$i] === $val___) {
						$idx[] = $i;
					}
				}
				foreach ($idx as &$v) {
					_F_builtin_splice($c___, $v, 1);
				}
			}
		}
	}

	function _F_builtin_remove_first_n(basic_iteratable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			$idx = [];
			$j = 0;
			for ($i = 0; $i < $c___->_M_size; $i++) {
				if ($c___->_M_container[$i] === $val___) {
					$idx[] = $i;
					++$j;
				}
				if ($j >= $n___) {
					break;
				}
			}
			foreach ($idx as &$v) {
				_F_builtin_splice($c___, $v, 1);
			}
		}
	}

	function _F_builtin_remove_first(basic_iteratable &$c___, $val___)
	{ _F_builtin_remove_first_n($c___, $val___, 1); }

	function _F_builtin_remove_last_n(basic_iteratable &$c___, $val___, $n___)
	{
		if ($c___->_M_size > 0) {
			$idx = [];
			$j = 0;
			for ($i = $c___->_M_size - 1; $i >= 0; $i--) {
				if ($c___->_M_container[$i] === $val___) {
					$idx[] = $i;
					++$j;
				}
				if ($j >= $n___) {
					break;
				}
			}
			foreach ($idx as &$v) {
				_F_builtin_splice($c___, $v, 1);
			}
		}
	}

	function _F_builtin_remove_last(basic_iteratable &$c___, $val___)
	{ _F_builtin_remove_last_n($c___, $val___, 1); }

	function _F_builtin_remove_if(basic_iteratable &$c___, callable $unaryPredicate)
	{
		if ($c___->_M_size > 0) {
			$idx = [];
			for ($i = 0; $i < $c___->_M_size; $i++) {
				if ($unaryPredicate($c___->_M_container[$i])) {
					$idx[] = $i;
				}
			}
			foreach ($idx as &$v) {
				_F_builtin_splice($c___, $v, 1);
			}
		}
	}

	function _F_builtin_clear_all(basic_iteratable &$c___)
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
} /* EONS */

/* EOF */