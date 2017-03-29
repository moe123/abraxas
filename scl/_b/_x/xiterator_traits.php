<?php
# -*- coding: utf-8 -*-

//
// xiterator_traits.php
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
	trait _T_basic_iterator
	{
		var $_M_pos = 0;
		var $_M_ptr = null;
	}

	final class _C_fwditer_sequential_adaptor
		implements \Iterator
	{
		use _T_basic_iterator;

		function __construct(basic_iterable &$iterable___)
		{
			$this->_M_pos = 0;
			$this->_M_ptr = &$iterable___;
		}

		function rewind()
		{ $this->_M_pos = 0; }

		function current()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }

		function key()
		{ return $this->_M_pos; }

		function next()
		{ ++$this->_M_pos; }

		function valid()
		{
			if ($this->_M_pos >= 0 && $this->_M_pos < $this->_M_ptr->_M_size) {
				return true;
			}
			return false;
		}
	}

	final class _C_fwditer_linkedlist_adaptor
		implements \Iterator
	{
		use _T_basic_iterator;

		function __construct(basic_iterable &$iterable___)
		{
			$this->_M_pos = 0;
			$this->_M_ptr = &$iterable___;
		}

		function rewind()
		{ $this->_M_pos = 0; }

		function current()
		{ return $this->_M_ptr->_F_get_at($this->_M_pos); }

		function key()
		{ return $this->_M_pos; }

		function next()
		{ ++$this->_M_pos; }

		function valid()
		{
			if ($this->_M_pos >= 0 && $this->_M_pos < $this->_M_ptr->_M_size) {
				return true;
			}
			return false;
		}
	}

	final class _C_fwditer_associative_adaptor
		implements \Iterator
	{
		use _T_basic_iterator;

		function __construct(basic_iterable &$iterable___)
		{
			$this->_M_pos = 0;
			$this->_M_ptr = &$iterable___;
		}

		function rewind()
		{
			\reset($this->_M_ptr->_M_container);
			$this->_M_pos = 0;
		}

		function current()
		{ return \current($this->_M_ptr->_M_container); }

		function key()
		{ return \key($this->_M_ptr->_M_container); }

		function next()
		{
			\next($this->_M_ptr->_M_container);
			++$this->_M_pos;
		}

		function valid()
		{ return \key($this->_M_ptr->_M_container) !== null; }
	}

	interface _I_bidirectional_iterator
	{
		function & _F_advance(int $dist___ = 1);
		function & _F_pos();

		function & _F_seek(int $offset___);
		function & _F_seek_begin(int $offset___ = -1);
		function & _F_seek_end(int $offset___ = -1);

		function & _F_next();
		function & _F_prev();
		
		function _F_is_out();

		function & _F_assign($val___);

		function _F_this();
		function _F_first();
		function _F_second();
	}

	trait _T_forward_iterator
	{
		function __construct(basic_iterable &$iterable___, int $start___)
		{
			$this->_M_pos = $start___ < 0 ? 0 : $start___;
			$this->_M_ptr = &$iterable___;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $dist___ = 1)
		{
			if ($dist___ < 1) {
				return $this;
			}
			for ($i = 0 ; $i < $dist___ ; $i++) {
				$this->_M_pos++;
			}
			if ($this->_M_pos > $this->_M_ptr->_M_size) {
				_X_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function & _F_pos()
		{ return $this->_M_pos; }

		function & _F_seek(int $offset___)
		{
			$this->_M_pos = $offset___;
			return $this;
		}

		function & _F_seek_begin(int $offset___ = -1)
		{
			$this->_F_seek($offset___ < 0 ? 0 : $offset___);
			return $this;
		}

		function & _F_seek_end(int $offset___ = -1)
		{
			$this->_F_seek(
				$offset___ < 0 ? $this->_M_ptr->_M_size : $this->_M_ptr->_M_size - $offset___
			);
			return $this;
		}

		function & _F_next()
		{
			++$this->_M_pos;
			return $this;
		}

		function & _F_prev()
		{
			--$this->_M_pos;
			return $this;
		}

		function _F_is_out()
		{ return $this->_M_pos > $this->_M_ptr->_M_size; }
	}

	trait _T_forward_iterator_langarray
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_pos] = $val___;
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }

		function _F_first()
		{ return $this->_M_pos; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }
	}

	trait _T_forward_iterator_linkedlist
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_F_replace_data_at($this->_M_pos, $val___);
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_F_get_at($this->_M_pos); }

		function _F_first()
		{ return $this->_M_pos; }

		function _F_second()
		{ return $this->_M_ptr->_F_get_at($this->_M_pos); }
	}

	trait _T_forward_iterator_dict
	{
		function & _F_assign($val___)
		{
			if ($val___ instanceof \std\pair) {
				$this->_M_ptr->set_item($val___);
			} else {
				$this->_M_ptr->set($this->_M_ptr->item_at($this->_M_pos)->first, $val___);
				// _X_throw_error("Cannot assign value type error");
			}
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->item_at($this->_M_pos); }

		function _F_first()
		{ return $this->_M_ptr->item_at($this->_M_pos)->first; }

		function _F_second()
		{ return $this->_M_ptr->item_at($this->_M_pos)->second; }
	}

	trait _T_forward_iterator_map
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_pos] = $val___;
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }

		function _F_first()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]->first; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]->second; }
	}

	trait _T_inserter_iterator
	{
		function __construct(basic_iterable &$iterable___)
		{
			$this->_M_pos = 0;
			$this->_M_ptr = &$iterable___;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $dist___ = 1)
		{
			if ($dist___ < 1) {
				return $this;
			}
			for ($i = 0 ; $i < $dist___ ; $i++) {
				$this->_M_pos++;
			}
			if ($this->_M_pos > $this->_M_ptr->_M_size) {
				_X_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function & _F_pos()
		{ return $this->_M_pos; }

		function & _F_seek(int $offset___)
		{
			$this->_M_pos = $offset___;
			return $this;
		}

		function & _F_seek_begin(int $offset___ = -1)
		{
			$this->_F_seek($offset___ < 0 ? 0 : $offset___);
			return $this;
		}

		function & _F_seek_end(int $offset___ = -1)
		{
			$this->_F_seek(
				$offset___ < 0 ? $this->_M_ptr->_M_size : $this->_M_ptr->_M_size - $offset___
			);
			return $this;
		}

		function & _F_next()
		{
			++$this->_M_pos;
			return $this;
		}

		function & _F_prev()
		{
			--$this->_M_pos;
			return $this;
		}

		function _F_is_out()
		{ return $this->_M_pos > $this->_M_ptr->_M_size; }

		function & _F_assign($val___)
		{
			if ($this->_M_ptr::container_category === basic_iterable_tag::basic_dict) {
				if ($val___ instanceof \std\pair) {
					if (static::iterator_category === basic_iterator_tag::front_insert_iterator) {
						_X_push_front($this->_M_ptr, $val___->second, $val___->first);
					} else if (static::iterator_category === basic_iterator_tag::back_insert_iterator) {
						_X_push_back($this->_M_ptr, $val___->second, $val___->first);
					}
				} else {
					if (static::iterator_category === basic_iterator_tag::front_insert_iterator) {
						_X_push_front($this->_M_ptr, $val___->second, $this->_M_ptr->item_at($this->_M_pos)->first);
					} else if (static::iterator_category === basic_iterator_tag::back_insert_iterator) {
						_X_push_back($this->_M_ptr, $val___->second, $this->_M_ptr->item_at($this->_M_pos)->first);
					}
					// _X_throw_error("Cannot assign value type error");
				}
			} else if (static::iterator_category === basic_iterator_tag::front_insert_iterator) {
				_X_push_front($this->_M_ptr, $val___);
			} else if (static::iterator_category === basic_iterator_tag::back_insert_iterator) {
				_X_push_back($this->_M_ptr, $val___);
			}
			return $this;
		}

		function _F_this()
		{
			if ($this->_M_ptr::container_category === basic_iterable_tag::basic_dict) {
				return $this->_M_ptr->item_at($this->_M_pos);
			} else if ($this->_M_ptr::container_category === basic_iterable_tag::basic_forward_list) {
				return $this->_M_ptr->_F_get_at($this->_M_pos);
			}
			return $this->_M_ptr->_M_container[$this->_M_pos];
		}

		function _F_first()
		{
			if (
				$this->_M_ptr::container_category === basic_iterable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iterable_tag::basic_ordered_map
			) {
				return $this->_M_ptr->item_at($this->_M_pos)->first;
			}
			return $this->_M_pos;
		}

		function _F_second()
		{
			if (
				$this->_M_ptr::container_category === basic_iterable_tag::basic_dict ||
				$this->_M_ptr::container_category === basic_iterable_tag::basic_ordered_map
			) {
				return $this->_M_ptr->item_at($this->_M_pos)->second;
			} else if ($this->_M_ptr::container_category === basic_iterable_tag::basic_forward_list) {
				return $this->_M_ptr->_F_get_at($this->_M_pos);
			}
			return $this->_M_ptr->_M_container[$this->_M_pos];
		}
	}

	trait _T_reverse_iterator
	{
		function __construct(basic_iterable &$iterable___, int $start___)
		{
			$this->_M_pos = ($start___ < 0) ? -1 : ($start___ -1);
			$this->_M_ptr = &$iterable___;
		}

		function __destruct()
		{ $this->_M_ptr = null; }

		function & _F_advance(int $dist___ = 1)
		{
			if ($dist___ < 1) {
				return $this;
			}
			for ($i = 0 ; $i < $dist___ ; $i++) {
				--$this->_M_pos;
			}
			if ($this->_M_pos < -1) {
				_X_throw_out_of_range("Out of Range error");
			}
			return $this;
		}

		function & _F_pos()
		{ return $this->_M_pos; }

		function & _F_seek(int $offset___)
		{
			$this->_M_pos = $offset___;
			return $this;
		}

		function & _F_next()
		{
			$this->_M_pos--;
			return $this;
		}

		function & _F_prev()
		{
			$this->_M_pos++;
			return $this;
		}

		function & _F_seek_begin(int $offset___ = -1)
		{
			$this->_F_seek($offset___ < 0 
				? ($this->_M_ptr->_M_size -1) : ($this->_M_ptr->_M_size -1) - $offset___);
			return $this;
		}

		function & _F_seek_end(int $offset___ = -1)
		{
			$this->_F_seek(
				$offset___ < 0 ? -1 : $offset___
			);
			return $this;
		}

		function _F_is_out()
		{ return $this->_M_pos < -1; }
	}
	
	trait _T_reverse_iterator_langarray
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_pos] = $val___;
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }

		function _F_first()
		{ return $this->_M_pos; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }
	}

	trait _T_reverse_iterator_linkedlist
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_F_replace_data_at($this->_M_pos, $val___);
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_F_get_at($this->_M_pos); }

		function _F_first()
		{ return $this->_M_pos; }

		function _F_second()
		{ return $this->_M_ptr->_F_get_at($this->_M_pos); }
	}

	trait _T_reverse_iterator_dict
	{
		function & _F_assign($val___)
		{
			if ($val___ instanceof \std\pair) {
				$this->_M_ptr->set_item($val___);
			} else {
				$this->_M_ptr->set($this->_M_ptr->item_at($this->_M_pos)->first, $val___);
				// _X_throw_error("Cannot assign value type error");
			}
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->item_at($this->_M_pos); }

		function _F_first()
		{ return $this->_M_ptr->item_at($this->_M_pos)->first; }

		function _F_second()
		{ return $this->_M_ptr->item_at($this->_M_pos)->second; }
	}

	trait _T_reverse_iterator_map
	{
		function & _F_assign($val___)
		{
			if (!_X_offset_exists($this->_M_ptr, $this->_M_pos)) {
				_X_throw_error("Cannot assign a value to a non existing offset error");
			}
			$this->_M_ptr->_M_container[$this->_M_pos] = $val___;
			return $this;
		}

		function _F_this()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]; }

		function _F_first()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]->first; }

		function _F_second()
		{ return $this->_M_ptr->_M_container[$this->_M_pos]->second; }
	}

	trait _T_ostream_iterator
	{
		var $_M_ostr     = null;
		var $_M_sep      = '';
		var $_M_have_sep = 0;
		var $_M_init     = 0;

		function __construct(basic_ostream $os___, string $sep___ = '')
		{
			$this->_M_ptr  = null;
			$this->_M_ostr = $os___;
			$this->_M_sep  = $sep___;
			if (\strlen($this->_M_sep)) {
				$this->_M_have_sep = 1;
			}
			$this->_M_init = 0;
		}

		function __destruct()
		{
			$this->_M_ptr  = null;
			$this->_M_ostr = null;
			$this->_M_sep  = null;
		}

		function & _F_advance(int $dist___ = 1)
		{
			++$this->_M_pos;
			return $this;
		}

		function & _F_pos()
		{ return $this->_M_pos; }

		function & _F_seek(int $offset___)
		{ return $this; }

		function & _F_next()
		{
			++$this->_M_pos;
			return $this;
		}

		function & _F_prev()
		{ return $this; }

		function & _F_seek_begin(int $offset___ = -1)
		{ return $this; }

		function & _F_seek_end(int $offset___ = -1)
		{ return $this; }

		function _F_is_out()
		{ return !$this->_M_ostr->good(); }

		function & _F_assign($val___)
		{
			if ($this->_M_init == 0) {
				$this->_M_init = 1;
			} else if ($this->_M_have_sep) {
				($this->_M_ostr)($this->_M_sep);
			}
			($this->_M_ostr)($val___);
			return $this;
		}

		function _F_this()
		{ return $this->_M_pos; }

		function _F_first()
		{ return $this->_M_pos; }

		function _F_second()
		{ return $this->_M_pos; }
	}

	trait _T_duo_iterator
	{
		var $_M_first  = null;
		var $_M_second = null;

		function __construct(basic_iterator $first1___, basic_iterator $first2___)
		{
			$this->_M_ptr    = null;
			$this->_M_first  = $first1___;
			if ($first1___ === $first2___) {
				$this->_M_second = clone $first2___;
			} else {
				$this->_M_second = $first2___;
			}
		}

		function __destruct()
		{
			$this->_M_ptr    = null;
			$this->_M_first  = null;
			$this->_M_second = null;
		}

		function & _F_advance(int $dist___ = 1)
		{
			$this->_M_pos += $dist___;
			$this->_M_first->_F_advance($dist___);
			$this->_M_second->_F_advance($dist___);
			return $this;
		}

		function & _F_pos()
		{ return $this->_M_pos; }

		function & _F_seek(int $offset___)
		{
			$this->_M_first->_F_seek($offset___);
			$this->_M_second->_F_seek($offset___);
			return $this;
		}

		function & _F_next()
		{
			++$this->_M_pos;
			$this->_M_first->_F_next();
			$this->_M_second->_F_next();
			return $this;
		}

		function & _F_prev()
		{
			--$this->_M_pos;
			$this->_M_first->_F_prev();
			$this->_M_second->_F_prev();
			return $this;
		}

		function & _F_seek_begin(int $offset___ = -1)
		{
			$this->_M_first->_F_seek_begin($offset___);
			$this->_M_second->_F_seek_begin($offset___);
			return $this;
		}

		function & _F_seek_end(int $offset___ = -1)
		{
			$this->_M_first->_F_seek_end($offset___);
			$this->_M_second->_F_seek_end($offset___);
			return $this;
		}

		function _F_is_out()
		{ return ($this->_M_first->_F_is_out() || $this->_M_second->_F_is_out()); }

		function & _F_assign($val___)
		{
			$this->_M_first->_F_assign($val___);
			$this->_M_second->_F_assign($val___);
			return $this;
		}

		function _F_this()
		{ return new pair($this->_M_first->_F_this(), $this->_M_second->_F_this()); }

		function _F_first()
		{ return new pair($this->_M_first->_F_first(), $this->_M_second->_F_first()); }

		function _F_second()
		{ return new pair($this->_M_first->_F_second(), $this->_M_second->_F_second()); }
	}
} /* EONS */

/* EOF */