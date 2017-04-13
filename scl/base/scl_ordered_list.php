<?php
# -*- coding: utf-8 -*-

//
// scl_ordered_list.php
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
	final class ordered_list extends basic_ordered_list
	{
		use _T_multi_construct;

		function __construct()
		{ 
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function ordered_list_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->push_back($val);
			}
		}

		function ordered_list_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign($first, $last); }

		function & reserve(int $size, $fill = null)
		{
			_F_reserve($this, $size, $fill);
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

		function & push_front($val)
		{
			_F_push_front($this, $val);
			return $this;
		}

		function & pop_front()
		{
			_F_pop_front($this);
			return $this;
		}

		function & push_back($val)
		{
			_F_push_back($this, $val);
			return $this;
		}

		function & pop_back()
		{
			_F_pop_back($this);
			return $this;
		}

		function & insert_at(int $index, $val)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				_F_insert($this, $index, $val);
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function & insert(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					_F_insert($this, $first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(ordered_list &$olist)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $olist->_M_container;
			$this->_M_size = $olist->_M_size;

			$olist->_M_container = $c;
			$olist->_M_size = $sz;

			return $this;
		}

		function & assign_from(ordered_list &$olist)
		{
			_F_clear_all($this);
			foreach ($olist->_M_container as &$val) {
				$this->push_back($val);
			}
			return $this;
		}

		function & assign(basic_iterator $first, basic_iterator $last)
		{
			_F_clear_all($this);
			$this->merge($first, $last);
			return $this;
		}

		function & merge_from(ordered_list &$olist)
		{
			foreach ($olist->_M_container as &$val) {
				$this->push_back($val);
			}
			return $this;
		}

		function & merge(basic_iterator $first, basic_iterator $last)
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

		function & slice(int $start, int $end)
		{
			_F_slice($this, $start, ($$end - $start));
			return $this;
		}

		function & splice(
			  int            $start
			, basic_iterator $first
			, basic_iterator $last
		) {
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_at($start, $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & slice_sort(int $start, int $end, callable $compare = null)
		{
			if ($this->_M_size) {
				_F_slice_sort(
					  $this
					, $this->begin($start)
					, $this->end($end)
					, $compare
				);
			}
			return $this;
		}

		function & sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_sort_all($this, $compare);
			}
			return $this;
		}

		function & stable_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_stable_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_reverse($this);
				_F_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse_stable_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_reverse($this);
				_F_stable_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse()
		{
			_F_reverse($this);
			return $this;
		}

		function & unique()
		{
			_F_unique($this);
			return $this;
		}

		function & unique_if(callable $binaryPredicate)
		{
			_F_unique_b($this, $binaryPredicate);
			return $this;
		}

		function & remove($val)
		{
			_F_remove($this, $val);
			return $this;
		}

		function & remove_if(callable $unaryPredicate)
		{
			_F_remove_if($this, $unaryPredicate);
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
			_F_splice($this, $first->_F_pos(), distance($first, $last));
			return $this;
		}

		function & slice_erase(int $start, int $end)
		{
			_F_splice($this, $start, ($end - $start));
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