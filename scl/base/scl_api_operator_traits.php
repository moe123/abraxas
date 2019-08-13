<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_operator_traits.php
//
// Copyright (C) 2017-2019 Moe123. All rights reserved.
//
 
/*!
 * @project    Abraxas (Standard Container Library).
 * @author     Moe123 2019.
 * @maintainer Moe123 2019.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	trait _T_langarray_int_operator
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
				_F_splice($this->_M_container, $offset___, 1);
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

	trait _T_langarray_immutable_int_operator
	{
		function offsetSet($offset___, $val___)
		{ /* NOP */ }

		function offsetExists($offset___)
		{
			if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				return true;
			}
			return false;;
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

	trait _T_irange_int_operator
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
				return $this->_M_container[$offset___];
			} else {
				_F_throw_out_of_range("Out of Range error");
			}
			return null;
		}
	}

	trait _T_set_int_operator_unique
	{
		function offsetSet($offset___, $val___)
		{
			if (\is_null($offset___)) {
				if (!_F_entry_exists($this, $val___)) {
					$this->_M_container[] = $val___;
					++$this->_M_size;
				}
			} else if (\is_integer($offset___) && ($offset___ >= 0 && $offset___ < $this->_M_size)) {
				if (!_F_entry_exists($this, $val___)) {
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
				_F_splice($this->_M_container, $offset___, 1);
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

	trait _T_langarray_string_operator
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

	trait _T_linkedlist_int_operator
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