<?php
# -*- coding: utf-8 -*-

//
// scl_seq_list.php
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
	final class seq_list extends basic_seq_list
	{
		use _T_multi_construct_traits;

		function __construct()
		{ 
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function _F_seq_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->push_back($val);
			}
		}

		function _F_seq_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign_r($first, $last); }

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
			_F_builtin_push_front($this, $val);
			return $this;
		}

		function & pop_front()
		{
			_F_builtin_pop_front($this);
			return $this;
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
					_F_builtin_insert($this, $first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(seq &$seq)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $seq->_M_container;
			$this->_M_size = $seq->_M_size;

			$seq->_M_container = $c;
			$seq->_M_size = $sz;

			return $this;
		}

		function & assign(seq &$seq)
		{
			_F_builtin_clear_all($this);
			foreach ($seq->_M_container as &$val) {
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

		function & merge(seq &$seq)
		{
			foreach ($seq->_M_container as &$val) {
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

		function & slice(int $pos, int $len)
		{
			_F_builtin_slice($this, $pos, $len);
			return $this;
		}

		function & slice_r(basic_iterator $first, basic_iterator $last)
		{
			_F_builtin_slice($this, $first->_F_pos(), distance($first, $last));
			return $this;
		}

		function & splice(
			  basic_iterator $pos
			, seq &$seq
			, basic_iterator $first = null
			, basic_iterator $last = null
		) {
			if ($first === null) {
				$first = $seq->begin();
			}
			if ($last === null) {
				$first = $seq->end();
			}
			if ($first::iterator_category === $last::iterator_category) {
				$index = $pos->_F_pos();
				while ($first != $last) {
					$this->insert($index, $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & reverse()
		{
			_F_builtin_reverse($this);
			return $this;
		}

		function & unique()
		{
			_F_builtin_unique($this);
			return $this;
		}

		function & unique_if(callable $binaryPredicate)
		{
			_F_builtin_unique_b($this, $binaryPredicate);
			return $this;
		}

		function & remove($val)
		{
			_F_builtin_remove($this, $val);
			return $this;
		}

		function & remove_if(callable $unaryPredicate)
		{
			_F_builtin_remove_if($this, $unaryPredicate);
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