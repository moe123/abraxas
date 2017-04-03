<?php
# -*- coding: utf-8 -*-

//
// scl_ordered_set.php
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
	final class ordered_set extends basic_ordered_set
	{
		use _T_multi_construct;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function ordered_set_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->insert_value($val);
			}
		}

		function ordered_set_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign($first, $last); }

		function & reserve(int $size, $fill = null)
		{
			_F_reserve($this, $size, $fill);
			return $this;
		}

		function & insert_value($val)
		{
			if (!_F_value_exists($this, $val)) {
				_F_push_front($this, $val);
			}
			return $this;
		}
		
		function & insert(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_value($first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(set &$oset)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $oset->_M_container;
			$this->_M_size = $oset->_M_size;

			$oset->_M_container = $c;
			$oset->_M_size = $sz;

			return $this;
		}

		function & assign_from(set &$oset)
		{
			_F_clear_all($this);
			foreach ($oset->_M_container as &$val) {
				$this->insert_value($val);
			}
			return $this;
		}

		function & assign(basic_iterator $first, basic_iterator $last)
		{
			_F_clear_all($this);
			$this->merge($first, $last);
			return $this;
		}

		function & merge_from(set &$oset)
		{
			foreach ($oset->_M_container as &$val) {
				$this->insert_value($val);
			}
			return $this;
		}

		function & merge(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_value($first->_F_this());
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
				_F_splice($this, $index, $len);
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function & erase(basic_iterator $first, basic_iterator $last)
		{
			_F_splice($this, $first, distance($first, $last));
			return $this;
		}

		function & clear()
		{
			_F_clear_all($this);
			return $this;
		}

		function size()
		{ return $this->_M_size; }

		function empty()
		{ return $this->_M_size > 0 ? false : true; }
	} /* EOC */
} /* EONS */

/* EOF */