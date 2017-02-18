<?php
# -*- coding: utf-8 -*-

//
// scl_basic_forward_list.php
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
	final class forward_list extends basic_forward_list
	{
		use _T_multi_construct_traits;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function _F_forward_list_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->push_back($val);
			}
		}

		function _F_forward_list_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign_r($first, $last); }

		function & reserve(int $size)
		{
			_F_builtin_reserve($this, $size);
			return $this;
		}

		function & push_front($val)
		{
			$this->_F_insert_first($val);
			return $this;
		}

		function & push_back($val)
		{
			$this->_F_insert_last($val);
			return $this;
		}

		function & pop_front()
		{
			$this->_F_del_first();
			return $this;
		}

		function & pop_back()
		{
			$this->_F_del_last();
			return $this;
		}

		function at(int $index)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				return $this->_F_get_at($index);
			}
			_F_throw_out_of_range("Out of Range error");
			return null;
		}

		function & insert(int $index, $val)
		{
			$this->_F_insert_at_index($index, $val);
			return $this;
		}

		function & insert_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert($first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & insert_after(int $index, $val)
		{
			$this->_F_insert_after_index($index, $val);
			return $this;
		}
		
		function & insert_after_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_after($first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(forward_list &$fwdl)
		{
			$this->_F_swap($fwdl);
			return $this;
		}

		function & assign(forward_list &$fwdl)
		{
			_F_builtin_clear_all($this);
			$this->_F_merge($fwdl, $val);
			return $this;
		}

		function & assign_r(basic_iterator $first, basic_iterator $last)
		{
			$this->_F_clear_all();
			$this->merge_r($first, $last);
			return $this;
		}

		function & merge(forward_list &$fwdl)
		{
			$this->_F_merge($fwdl, $val);
			return $this;
		}

		function & merge_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->push_back($first->second());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & remove($val)
		{
			$cnt = $this->_F_find_data($val);
			for ($i = 0; $i < $cnt; $i++) {
				$this->_F_del_data($val);
			}
			return $this;
		}

		function & remove_if(callable $unaryPredicate)
		{
			$this->_F_del_if($unaryPredicate);
			return $this;
		}

		function & erase_at(int $index)
		{
			$this->_F_del_at($index);
			return $this;
		}

		function & erase_after(int $index)
		{
			$this->_F_del_at($index + 1);
			return $this;
		}

		function & erase_before(int $index)
		{
			$this->_F_del_at($index - 1);
			return $this;
		}

		function & sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_builtin_sort($this, $compare);
			}
			return $this;
		}

		function & reverse()
		{
			$this->_F_rev();
			return $this;
		}

		function empty()
		{ return ($this->_M_f_node === null); }

		function size()
		{ return $this->_M_size; }

		function & clear()
		{
			_F_builtin_clear_all($this);
			return $this;
		}
	}
} /* EONS */

/* EOF */