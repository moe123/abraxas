<?php
# -*- coding: utf-8 -*-

//
// scl_iterator.php
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
	abstract class basic_iterator_tag
	{
		const basic_iterator          = 10;
		const forward_iterator        = 20;
		const reverse_iterator        = 30;

		const insert_iterator         = 40;
		const pair_iterator           = 40;
		const back_insert_iterator    = 50;
		const front_insert_iterator   = 60;
	}

	abstract class basic_iterator
	{ const iterator_category = basic_iterator_tag::basic_iterator; }

	abstract class forward_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::forward_iterator;
		
		use _T_basic_iterator_traits;
		use _T_forward_iterator_traits;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }

		function & assign($val___)
		{
			$this->_F_pos_assign($v___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_offset > 0) {
				--$this->_M_offset;
			}
			return $this;
		}

		function & next()
		{
			return $this->_F_advance(1);
			return $this;
		}
	}

	final class _C_forward_iterator_array extends forward_iterator
	{ use _T_forward_iterator_builtin_array_traits; }

	final class _C_forward_iterator_linked_list extends forward_iterator
	{ use _T_forward_iterator_linked_list_traits; }

	final class _C_forward_iterator_dict extends forward_iterator
	{ use _T_forward_iterator_dict_traits; }

	final class _C_forward_iterator_map extends forward_iterator
	{ use _T_forward_iterator_map_traits; }

	abstract class insert_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::insert_iterator;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }

		function & assign($val___)
		{
			$this->_F_pos_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_offset > 0) {
				--$this->_M_offset;
			}
			return $this;
		}

		function & next()
		{
			$this->advance(1);
			return $this;	
		}
	}

	abstract class reverse_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::reverse_iterator;

		use _T_basic_iterator_traits;
		use _T_reverse_iterator_traits;
		
		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }
		
		function & assign($val___)
		{
			$this->_F_pos_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_offset < $this->_M_ptr->_M_size -1) {
				++$this->_M_offset;
			}
			return $this;
		}

		function & next()
		{
			$this->_F_advance(1);
			return $this;
		}
	}

	final class _C_reverse_iterator_array extends reverse_iterator
	{ use _T_reverse_iterator_builtin_array_traits; }

	final class _C_reverse_iterator_linked_list extends reverse_iterator
	{ use _T_reverse_iterator_linked_list_traits; }

	final class _C_reverse_iterator_dict extends reverse_iterator
	{ use _T_reverse_iterator_dict_traits; }

	final class _C_reverse_iterator_map extends reverse_iterator
	{ use _T_reverse_iterator_map_traits; }

	final class _C_front_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::front_insert_iterator;

		use _T_basic_iterator_traits;
		use _T_inserter_iterator_traits;
	}

	final class _C_back_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::back_insert_iterator;

		use _T_basic_iterator_traits;
		use _T_inserter_iterator_traits;
	}

	final class _C_pair_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::pair_iterator;

		use _T_basic_iterator_traits;
		use _T_pair_iterator_traits;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }
		
		function & assign($val___)
		{
			$this->_F_pos_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			$this->_F_prev();
			return $this;
		}

		function & next()
		{
			$this->_F_next();
			return $this;
		}
	}

	function back_inserter(basic_iteratable $iterable___)
	{ return new _C_back_insert_iterator($iterable___); }

	function front_inserter(basic_iteratable $iterable___)
	{ return new _C_front_insert_iterator($iterable___); }

	function pair_iterator(basic_iterator $first1___, basic_iterator $first2___)
	{ return new _C_pair_iterator($first1___, $first2___); }

	function & iterator_copy(basic_iterator &$it___)
	{ return clone $it___; }

	function distance(basic_iterator $first___, basic_iterator $last___)
	{
		$n = 0;
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___->_M_offset >= $last___->_M_offset) {
				$n = $last___->_M_offset - $first___->_M_offset;
			} else {
				$it = clone $first___;
				while ($it != $last___) {
					$it->_F_next();
					++$n;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $n;
	}

	function advance(basic_iterator $it___, int $dist___)
	{ $it___->_F_advance($dist___); }

	function next(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_next();
			}
			return $it___;
		}
		return $it___->_F_next();
	}

	function prev(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_prev();
			}
			return $it___;
		}
		return $it___->_F_prev();
	}

	function begin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->begin($offset___); }

	function end(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->end($offset___); }

	function rbegin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->rbegin($offset___); }

	function rend(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->rend($offset___); }

	function & begin_p(forward_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_begin($offset___); }

	function & end_p(forward_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_end($offset___); }

	function & rbegin_p(reverse_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_begin($offset___); }

	function & rend_p(reverse_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_end($offset___); }
} /* EONS */

/* EOF */