<?php
# -*- coding: utf-8 -*-

//
// scl_basis_iterator_traits.php
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
	trait basic_iterator_traits
	{
		var $_M_ptr = null;
		var $_M_offset = 0;
	}

	trait forward_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___, int $start___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = $start___;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function first()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->first;
			}
			return $this->_F_offset();
		}

		function second()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->second;
			}
			return $this->_F_this();
		}

		function & advance(int $distance___ = 1)
		{
			if ($distance___ < 1) {
				return;
			}
			for ($i = 0 ; $i < $distance___ ; $i++) {
				$this->_M_offset++;
			}
			if ($this->_M_offset > $this->_M_ptr->_M_size) {
				_F_throw_out_of_range("Out of Range error");
			}
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
		{ return $this->advance(1); }

		function & _F_advance(int $distance___ = 1)
		{ return $this->advance($distance___); }

		function & _F_pos()
		{ return $this->_M_offset; }

		function & _F_seek(int $offset___)
		{
			$this->_M_offset = $offset___;
			return $this;
		}

		function & _F_seek_begin()
		{ return $this->_F_seek(0); }

		function & _F_seek_end()
		{ return $this->_F_seek($this->_M_ptr->_M_size); }

		function & _F_next()
		{
			++$this->_M_offset;
			return $this;
		}

		function & _F_prev()
		{
			--$this->_M_offset;
			return $this;
		}

		function _F_last()
		{ return $this->_M_offset >= $this->_M_ptr->_M_size; }

		function & _F_offset()
		{ return $this->_M_offset; }

		function _F_this()
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				return $this->_M_ptr->get_index($this->_M_offset);
			}
			return $this->_M_ptr->_M_container[$this->_M_offset];
		}

		function _F_pos_assign($val___)
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				if (\is_object($val___) && $val___ instanceof \std\pair) {
					$this->_M_ptr->set_item($val___);
				} else {
					_F_throw_builtin_error("Cannot assign value type error");
				}
			} else {
				if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
					_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
				}
				$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
			}
		}
	}

	trait inserter_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = 0;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function first()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->first;
			}
			return $this->_F_offset();
		}

		function second()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->second;
			}
			return $this->_F_this();
		}

		function & advance(int $distance___ = 1)
		{
			if ($distance___ < 1) {
				return;
			}
			for ($i = 0 ; $i < $distance___ ; $i++) {
				$this->_M_offset++;
			}
			if ($this->_M_offset > $this->_M_ptr->_M_size) {
				_F_throw_out_of_range("Out of Range error");
			}
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
		{ return $this->advance(1); }

		function & _F_advance(int $distance___ = 1)
		{ return $this->advance($distance___); }

		function & _F_pos()
		{ return $this->_M_offset; }

		function & _F_seek(int $offset___)
		{
			$this->_M_offset = $offset___;
			return $this;
		}

		function & _F_seek_begin()
		{ return $this->_F_seek(0); }

		function & _F_seek_end()
		{ return $this->_F_seek($this->_M_ptr->_M_size); }

		function & _F_next()
		{
			++$this->_M_offset;
			return $this;
		}

		function & _F_prev()
		{
			--$this->_M_offset;
			return $this;
		}

		function _F_last()
		{ return $this->_M_offset >= $this->_M_ptr->_M_size; }

		function & _F_offset()
		{ return $this->_M_offset; }

		function _F_this()
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				return $this->_M_ptr->get_index($this->_M_offset);
			}
			return $this->_M_ptr->_M_container[$this->_M_offset];
		}

		function _F_pos_assign($val___)
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				if (\is_object($val___) && $val___ instanceof \std\pair) {
					if ($this->_M_ptr::container_category === basic_iteratable_tag::front_insert_iterator) {
						_F_builtin_push_front($this->_M_ptr, $val___->second, $val___->first);
					} else if ($this->_M_ptr::container_category === basic_iteratable_tag::back_insert_iterator) {
						_F_builtin_push_back($this->_M_ptr, $val___->second, $val___->first);
					}
				} else {
					_F_throw_builtin_error("Cannot assign value type error");
				}
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::front_insert_iterator) {
				_F_builtin_push_front($this->_M_ptr, $val___);
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::back_insert_iterator) {
				_F_builtin_push_back($this->_M_ptr, $val___);
			}
		}
	}

	trait reverse_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___, int $start___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = $start___ -1;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function first()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->first;
			}
			return $this->_F_offset();
		}

		function second()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_F_this()->second;
			}
			return $this->_F_this();
		}

		function & advance(int $distance___ = 1)
		{
			if ($distance___ < 1) {
				return;
			}
			for ($i = 0 ; $i < $distance___ ; $i++) {
				--$this->_M_offset;
			}
			if ($this->_M_offset < -1) {
				_F_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function prev()
		{
			if ($this->_M_offset < $this->_M_ptr->_M_size -1) {
				++$this->_M_offset;
			}
			return $this;
		}

		function next()
		{ return $this->advance(1); }

		function & _F_advance(int $distance___ = 1)
		{ return $this->advance($distance___); }

		function & _F_pos()
		{ return $this->_M_offset; }

		function & _F_seek(int $offset___)
		{
			$this->_M_offset = $offset___;
			return $this;
		}

		function & _F_next()
		{
			$this->_M_offset--;
			return $this;
		}

		function & _F_prev()
		{
			$this->_M_offset++;
			return $this;
		}

		function & _F_seek_begin()
		{ return $this->_F_seek($this->_M_ptr->_M_size -1); }

		function & _F_seek_end()
		{ return $this->_F_seek(-1); }

		function _F_last()
		{ return $this->_M_offset < 0; }

		function & _F_offset()
		{ return $this->_M_offset; }

		function _F_this()
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				return $this->_M_ptr->get_index($this->_M_offset);
			}
			return $this->_M_ptr->_M_container[$this->_M_offset];
		}

		function _F_pos_assign($val___)
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				if (\is_object($val___) && $val___ instanceof \std\pair) {
					$this->_M_ptr->set_item($val___);
				} else {
					_F_throw_builtin_error("Cannot assign value type error");
				}
			} else {
				if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
					_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
				}
				$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
			}
		}
	}
} /* EONS */

/* EOF */