<?php
# -*- coding: utf-8 -*-

//
// scl_set.php
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
	final class set extends basic_set
	{
		use _T_multi_construct_traits;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function _F_set_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->insert($val);
			}
		}

		function _F_set_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign_r($first, $last); }

		function & reserve(int $size)
		{
			_F_builtin_reserve($this, $size);
			return $this;
		}

		function & insert($val)
		{
			if (!_F_builtin_value_exists($this, $val)) {
				_F_builtin_push_front($this, $val);
			}
			return $this;
		}
		
		function & insert_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert($first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(set &$set)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $set->_M_container;
			$this->_M_size = $set->_M_size;

			$set->_M_container = $c;
			$set->_M_size = $sz;

			return $this;
		}

		function & assign(set &$set)
		{
			_F_builtin_clear_all($this);
			foreach ($set->_M_container as &$val) {
				$this->insert($val);
			}
			return $this;
		}

		function & assign_r(basic_iterator $first, basic_iterator $last)
		{
			_F_builtin_clear_all($this);
			$this->merge_r($first, $last);
			return $this;
		}

		function & merge(set &$set)
		{
			foreach ($set->_M_container as &$val) {
				$this->insert($val);
			}
			return $this;
		}

		function & merge_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert($first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & erase_at(int $index, $len = 1)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				if (($index + $len) > $this->_M_size) {
					_F_throw_out_of_range("Out of Range error");
				}
				_F_builtin_splice($this, $index, $len);
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function erase_one(int $index)
		{
			$this->erase_at($index);
			return $this;
		}

		function & erase_from(basic_iterator $first)
		{
			_F_builtin_splice($this, $first->_F_pos());
			return $this;
		}

		function & erase_r(basic_iterator $first, basic_iterator $last)
		{
			_F_builtin_splice($this, $first->_F_pos(), distance($first, $last));
			return $this;
		}

		function & clear()
		{
			_F_builtin_clear_all($this);
			return $this;
		}

		function size()
		{ return $this->_M_size; }

		function empty()
		{ return $this->_M_size > 0 ? false : true; }
	} /* EOC */
} /* EONS */

/* EOF */