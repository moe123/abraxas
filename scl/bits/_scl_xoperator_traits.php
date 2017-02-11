<?php
# -*- coding: utf-8 -*-

//
// _scl_xoperator_traits.php
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
	trait _T_builtin_array_int_operator_traits
	{
		function offsetSet($offset___, $val___)
		{
			if (\is_null($offset___)) {
				$this->_M_container[] = $val___;
				++$this->_M_size;
			} else if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				$this->_M_container[$offset___] = $val___;
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
		}

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return false;
		}

		function offsetUnset($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				_F_builtin_splice($this->_M_container, $offset___, 1);
				--$this->_M_size;
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
		}

		function offsetGet($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return $this->_M_container[$offset___];
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return null;
		}
	}

	trait _T_builtin_range_int_operator_traits
	{
		function offsetSet($offset___, $val___)
		{ /* NOP */ }

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return false;
		}

		function offsetUnset($offset___)
		{ /* NOP */ }

		function offsetGet($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return $offset___;
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return null;
		}
	}

	trait _T_builtin_array_immutable_int_operator_traits
	{
		function offsetSet($offset___, $val___)
		{ /* NOP */ }

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return _F_builtin_offset_exists(offset___);
		}

		function offsetUnset($offset___)
		{ /* NOP */ }

		function offsetGet($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return $this->_M_container[$offset___];
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return null;
		}
	}

	trait _T_builtin_set_int_operator_unique_traits
	{
		function offsetSet($offset___, $val___)
		{
			if (\is_null($offset___)) {
				if (!_F_builtin_value_exists($this, $val___)) {
					$this->_M_container[] = $val___;
					++$this->_M_size;
				}
			} else if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				if (!_F_builtin_value_exists($this, $val___)) {
					$this->_M_container[$offset___] = $val___;
				}
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
		}

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return false;
		}

		function offsetUnset($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				_F_builtin_splice($this->_M_container, $offset___, 1);
				--$this->_M_size;
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
		}

		function offsetGet($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return $this->_M_container[$offset___];
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return null;
		}
	}

	trait _T_builtin_array_string_operator_traits
	{
		function offsetSet($offset___, $val___)
		{
			if (\is_string($offset___) && \strlen(\trim($offset___))) {
				$exists = isset($this->_M_container[$offset___]);
				$this->_M_container[$offset___] = $val___;
				if (!$exists) {
					++$this->_M_size;
				}
			}
		}

		function offsetExists($offset___)
		{
			if (\is_string($offset___) && \strlen(\trim($offset___))) {
				return isset($this->_M_container[$offset___]);
			}
			return false;
		}

		function offsetUnset($offset___)
		{
			if (\is_string($offset___) && \strlen(\trim($offset___))) {
				if (isset($this->_M_container[$offset___])) {
					--$this->_M_size;
					unset($this->_M_container[$offset___]);
				}
			}
		}

		function offsetGet($offset___)
		{
			if (\is_string($offset___) && \strlen(\trim($offset___))) {
				return isset($this->_M_container[$offset___]) ? $this->_M_container[$offset___] : null;
			}
			return null;
		}
	}

	trait _T_builtin_linked_list_int_operator_traits
	{
		function offsetSet($offset___, $val___)
		{
			if (\is_null($offset___)) {
				$this->_F_insert_last($v___);
			} else if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				$this->_F_replace_data_at($offset___, $val___);
			} else {
				$this->_F_insert_last($v___);
			}
		}

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return false;
		}

		function offsetUnset($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				$this->_F_del_at($offset___);
			}
		}

		function offsetGet($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return $this->_F_get_at($offset___);
			}
			return null;
		}
	}
} /* EONS */

/* EOF */