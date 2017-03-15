<?php
# -*- coding: utf-8 -*-

//
// scl_dict.php
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
	final class dict extends basic_dict
	{
		use _T_multi_construct;

		function __construct()
		{ 
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function dict_1(array $list_initializer)
		{
			$c = \count($list_initializer);
			if (($c & 1) != 0) {
				_X_throw_invalid_argument("Invalid type error");
			}
			for ($i = 0; $i < $c; $i += 2) {
				$this->set(
					  $list_initializer[$i]
					, $list_initializer[$i + 1]
				);
			}
		}

		function dict_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign_r($first, $last); }

		function keys()
		{
			$vec = new vector;
			_X_offsets($this, $vec);
			return $vec;
		}

		function values()
		{
			$vec = new vector;
			_X_values($this, $vec);
			return $vec;
		}

		function key_at(int $index)
		{
			if ($this->_M_size > 0 && $index < $this->_M_size) {
				$idx = 0;
				foreach ($this->_M_container as $k => &$v) {
					if ($idx === $index) {
						return $k;
					}
					++$idx;
				}
			}
			_X_throw_out_of_range("Out of Range error");
			return null;
		}

		function value_at(int $index)
		{
			if ($this->_M_size > 0 && $index < $this->_M_size) {
				$idx = 0;
				foreach ($this->_M_container as &$v) {
					if ($idx === $index) {
						return $v;
					}
					++$idx;
				}
			}
			_X_throw_out_of_range("Out of Range error");
			return null;
		}

		function item_at(int $index)
		{
			if ($this->_M_size > 0 && $index < $this->_M_size) {
				$idx = 0;
				foreach ($this->_M_container as $k => &$v) {
					if ($idx === $index) {
						return new pair($k, $v);
					}
					++$idx;
				}
			}
			_X_throw_out_of_range("Out of Range error");
			return null;
		}

		function index_of_key(string $key)
		{
			if ($this->_M_size > 0) {
				$idx = 0;
				foreach ($this->_M_container as $k => &$v) {
					if ($key === $k) {
						return $idx;
					}
					++$idx;
				}
			}
			_X_throw_logic_error("Key does not exist error");
			return -1;
		}

		function first_index_of_value(string $val)
		{
			if ($this->_M_size > 0) {
				$idx = 0;
				foreach ($this->_M_container as $k => &$v) {
					if ($val == $v) {
						return $idx;
					}
					++$idx;
				}
			}
			_X_throw_logic_error("Value does not exist error");
			return -1;
		}

		function has_key(string $key)
		{ return _X_offset_exists($this->_M_container, $key); }

		function del(string $key)
		{ unset($this->_M_container[$key]); }

		function pop(string $key)
		{
			if (_X_offset_exists($this->_M_container, $key)) {
				$pop = $this->_M_container[$key];
				unset($this->_M_container[$key]);
				return $pop;
			}
			_X_throw_logic_error("Key does not exist error");
			return null;
		}

		function items()
		{
			$vec = new vector;
			if ($this->_M_size > 0) {
				foreach ($this->_M_container as $k => &$val) {
					$vec[] = new pair($k, $val);
				}
			}
			return $vec;
		}

		function pop_item(string $key)
		{
			if (_X_offset_exists($this->_M_container, $key)) {
				$pop_item = new pair($key, $this->_M_container[$key]);
				unset($this->_M_container[$key]);
				return $pop_item;
			}
			_X_throw_logic_error("Key does not exist error");
			return null;
		}

		function get(string $key)
		{
			if (_X_offset_exists($this->_M_container, $key)) {
				return $this->_M_container[$key];
			}
			_X_throw_logic_error("Key does not exist error");
			return null;
		}

		function get_item(string $key)
		{
			if (_X_offset_exists($this->_M_container, $key)) {
				return new pair($key, $this->_M_container[$key]);
			}
			_X_throw_logic_error("Key does not exist error");
			return null;
		}

		function & set(string $key, $val)
		{
			$exists = _X_offset_exists($this->_M_container, $key);
			$this->_M_container[$key] = $val;
			if (!$exists) {
				++$this->_M_size;
			}
			return $this;
		}

		function & set_item(pair &$pair)
		{
			$exists = _X_offset_exists($this->_M_container, $pair->first);
			$this->_M_container[$pair->first] = $pair->second;
			if (!$exists) {
				++$this->_M_size;
			}
			return $this;
		}

		function & swap(dict &$dict)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $dict->_M_container;
			$this->_M_size = $dict->_M_size;

			$dict->_M_container = $c;
			$dict->_M_size = $sz;

			return $this;
		}

		function & assign(dict &$dict)
		{
			$this->clear();
			foreach ($dict->_M_container as $k => &$val) {
				$this->set($k, $val);
			}
			return $this;
		}

		function & assign_r(basic_iterator $first, basic_iterator $last)
		{
			$this->clear();
			$this->update_r($first, $last);
			return $this;
		}

		function & update(dict &$dict)
		{
			foreach ($dict->_M_container as $k => &$val) {
				$this->set($k, $val);
			}
			return $this;
		}

		function & update_r(basic_iterator $first, basic_iterator $last)
		{
			if (
				$first::iterator_category === basic_iterator_tag::duo_iterator ||
				$first::iterator_category === basic_iterator_tag::ostream_iterator
			) {
				_X_throw_invalid_argument("Invalid type error");
			}
			if ($first::iterator_category === $last::iterator_category) {
				if ($first->_M_ptr::container_category === basic_iteratable_tag::basic_dict) {
					while ($first != $last) {
						$this->set($first->first(), $first->second());
						$first->next();
					}
				} else if ($first->_M_ptr::container_category === basic_iteratable_tag::basic_ordered_map) {
					while ($first != $last) {
						$this->set(
							  $first->second()->first
							, $first->second()->second
						);
						$first->next();
					}
				} else {
					_X_throw_invalid_argument("Invalid type error");
				}
			} else {
				_X_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & clear()
		{
			_X_clear_all($this);
			return $this;
		}

		function size()
		{ return $this->_M_size; }

		function empty()
		{ return $this->_M_size > 0 ? false : true; }
	} /* EOC */
} /* EONS */

/* EOF */