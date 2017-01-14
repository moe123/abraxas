<?php
# -*- coding: utf-8 -*-

//
// scl_base_iterator_traits.php
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
	trait _T_basic_iterator_traits
	{
		var $_M_offset = 0;
		var $_M_ptr = null;
	}

	final class _C_builtin_output_iterator_sequential_adaptor
		implements \Iterator
	{
		use _T_basic_iterator_traits;

		function __construct(basic_iteratable &$iterable___)
		{
			$this->_M_offset = 0;
			$this->_M_ptr = &$iterable___;
		}

		function rewind()
		{ $this->_M_offset = 0; }

		function current()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }

		function key()
		{ return $this->_M_offset; }

		function next()
		{ ++$this->_M_offset; }

		function valid()
		{
			if ($this->_M_offset >= 0 && $this->_M_offset < $this->_M_ptr->_M_size) {
				return true;
			}
			return false;
		}
	}

	final class _C_builtin_output_iterator_associative_adaptor
		implements \Iterator
	{
		use _T_basic_iterator_traits;

		function __construct(basic_iteratable &$iterable___)
		{
			$this->_M_offset = 0;
			$this->_M_ptr = &$iterable___;
		}

		function rewind()
		{
			\reset($this->_M_ptr->_M_container);
			$this->_M_offset = 0;
		}

		function current()
		{ return \current($this->_M_ptr->_M_container); }

		function key()
		{ return \key($this->_M_ptr->_M_container); }

		function next()
		{
			\next($this->_M_ptr->_M_container);
			++$this->_M_offset;
		}

		function valid()
		{ return \key($this->_M_ptr->_M_container) !== null; }
	}

	trait _T_forward_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___, int $start___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = $start___;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $distance___ = 1)
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

		function _F_is_last()
		{ return $this->_M_offset >= $this->_M_ptr->_M_size; }

		function & _F_offset()
		{ return $this->_M_offset; }
	}

	trait _T_forward_iterator_array_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }

		function _F_first()
		{ return $this->_M_offset; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }
	}

	trait _T_forward_iterator_linked_list_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_F_replace_data_at($this->_M_offset, $val___);
		}

		function _F_this()
		{ return $this->_M_ptr->_F_get_at($this->_M_offset); }

		function _F_first()
		{ return $this->_M_offset; }

		function _F_second()
		{ return $this->_M_ptr->_F_get_at($this->_M_offset); }
	}

	trait _T_forward_iterator_dict_traits
	{
		function _F_pos_assign($val___)
		{
			if (\is_object($val___) && $val___ instanceof \std\pair) {
				$this->_M_ptr->set_item($val___);
			} else {
				$this->_M_ptr->set($this->_M_ptr->get_index($this->_M_offset)->first, $val___);
				// _F_throw_builtin_error("Cannot assign value type error");
			}
		}

		function _F_this()
		{ return $this->_M_ptr->get_index($this->_M_offset); }

		function _F_first()
		{ return $this->_M_ptr->get_index($this->_M_offset)->first; }

		function _F_second()
		{ return $this->_M_ptr->get_index($this->_M_offset)->second; }
	}

	trait _T_forward_iterator_map_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }

		function _F_first()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]->first; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]->second; }
	}

	trait _T_inserter_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = 0;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $distance___ = 1)
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

		function _F_is_last()
		{ return $this->_M_offset >= $this->_M_ptr->_M_size; }

		function & _F_offset()
		{ return $this->_M_offset; }

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
					if ($this->_M_ptr::container_category === basic_iteratable_tag::front_insert_iterator) {
						_F_builtin_push_front($this->_M_ptr, $val___->second, $this->_M_ptr->get_index($this->_M_offset)->first);
					} else if ($this->_M_ptr::container_category === basic_iteratable_tag::back_insert_iterator) {
						_F_builtin_push_back($this->_M_ptr, $val___->second, $this->_M_ptr->get_index($this->_M_offset)->first);
					}
					// _F_throw_builtin_error("Cannot assign value type error");
				}
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::front_insert_iterator) {
				_F_builtin_push_front($this->_M_ptr, $val___);
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::back_insert_iterator) {
				_F_builtin_push_back($this->_M_ptr, $val___);
			}
		}

		function _F_this()
		{
			if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
				return $this->_M_ptr->get_index($this->_M_offset);
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_forward_list) {
				return $this->_M_ptr->_F_get_at($this->_M_offset);
			}
			return $this->_M_ptr->_M_container[$this->_M_offset];
		}

		function _F_first()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_M_ptr->get_index($this->_M_offset)->first;
			}
			return $this->_M_offset;
		}

		function _F_second()
		{
			if (
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iteratable_tag::basic_map
			) {
				return $this->_M_ptr->get_index($this->_M_offset)->second;
			} else if ($this->_M_ptr::container_category === basic_iteratable_tag::basic_forward_list) {
				return $this->_M_ptr->_F_get_at($this->_M_offset);
			}
			return $this->_M_ptr->_M_container[$this->_M_offset];
		}
	}

	trait _T_reverse_iterator_traits
	{
		function __construct(basic_iteratable &$iterable___, int $start___)
		{
			$this->_M_ptr = &$iterable___;
			$this->_M_offset = $start___ -1;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $distance___ = 1)
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

		function _F_is_last()
		{ return $this->_M_offset < 0; }

		function & _F_offset()
		{ return $this->_M_offset; }
	}
	
	trait _T_reverse_iterator_array_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }

		function _F_first()
		{ return $this->_M_offset; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }
	}

	trait _T_reverse_iterator_linked_list_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_F_replace_data_at($this->_M_offset, $val___);
		}

		function _F_this()
		{ return $this->_M_ptr->_F_get_at($this->_M_offset); }

		function _F_first()
		{ return $this->_M_offset; }

		function _F_second()
		{ return $this->_M_ptr->_F_get_at($this->_M_offset); }
	}

	trait _T_reverse_iterator_dict_traits
	{
		function _F_pos_assign($val___)
		{
			if (\is_object($val___) && $val___ instanceof \std\pair) {
				$this->_M_ptr->set_item($val___);
			} else {
				$this->_M_ptr->set($this->_M_ptr->get_index($this->_M_offset)->first, $val___);
				// _F_throw_builtin_error("Cannot assign value type error");
			}
		}

		function _F_this()
		{ return $this->_M_ptr->get_index($this->_M_offset); }

		function _F_first()
		{ return $this->_M_ptr->get_index($this->_M_offset)->first; }

		function _F_second()
		{ return $this->_M_ptr->get_index($this->_M_offset)->second; }
	}

	trait _T_reverse_iterator_map_traits
	{
		function _F_pos_assign($val___)
		{
			if (!_F_builtin_offset_exists($this->_M_ptr, $this->_M_offset)) {
				_F_throw_builtin_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_offset] = $val___;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]; }

		function _F_first()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]->first; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_offset]->second; }
	}
} /* EONS */

/* EOF */