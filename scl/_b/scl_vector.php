<?php
# -*- coding: utf-8 -*-

//
// scl_vector.php
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
	final class vector extends basic_vector
	{
		use _T_multi_construct;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function vector_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->push_back($val);
			}
		}

		function vector_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign_r($first, $last); }

		function & reserve(int $size, $fill = null)
		{
			_F_builtin_reserve($this, $size, $fill);
			return $this;
		}

		function front()
		{
			if ($this->_M_size) {
				return $this->_M_container[0];
			}
			_F_throw_out_of_range("Out of Range error");
			return null;
		}

		function back()
		{
			if ($this->_M_size) {
				return $this->_M_container[$this->_M_size - 1];
			}
			_F_throw_out_of_range("Out of Range error");
			return null;
		}

		function at(int $index)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				return $this->_M_container[$index];
			}
			_F_throw_out_of_range("Out of Range error");
			return null;
		}

		function & push_back($val)
		{
			_F_builtin_push_back($this, $val);
			return $this;
		}

		function & pop_back()
		{
			_F_builtin_pop_back($this);
			return $this;
		}

		function & insert(int $index, $val)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				_F_builtin_insert($this, $index, $val);
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
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

		function & swap(vector &$vec)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $vec->_M_container;
			$this->_M_size = $vec->_M_size;

			$vec->_M_container = $c;
			$vec->_M_size = $sz;

			return $this;
		}

		function & assign(vector &$vec)
		{
			_F_builtin_clear_all($this);
			foreach ($vec->_M_container as &$val) {
				$this->push_back($val);
			}
			return $this;
		}

		function & assign_r(basic_iterator $first, basic_iterator $last)
		{
			_F_builtin_clear_all($this);
			$this->merge_r($first, $last);
			return $this;
		}

		function & merge(vector &$vec)
		{
			foreach ($vec->_M_container as &$val) {
				$this->push_back($val);
			}
			return $this;
		}

		function & merge_r(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->push_back($first->_F_this());
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