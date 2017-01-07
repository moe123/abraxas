<?php
# -*- coding: utf-8 -*-

//
// scl_tuple.php
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
	final class tuple extends basic_tuple
	{
		use _T_multi_construct_traits;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function _F_tuple_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				if ($obj instanceof \std\quint) {
					$this->_M_container[] = $obj->first;
					$this->_M_container[] = $obj->second;
					$this->_M_container[] = $obj->third;
					$this->_M_container[] = $obj->fourth;
					$this->_M_container[] = $obj->fifth;
					$tuple->_M_size += 5;
				} else if ($obj instanceof \std\quad) {
					$this->_M_container[] = $obj->first;
					$this->_M_container[] = $obj->second;
					$this->_M_container[] = $obj->third;
					$this->_M_container[] = $obj->fourth;
					$tuple->_M_size += 4;
				} else if ($obj instanceof \std\triad) {
					$this->_M_container[] = $obj->first;
					$this->_M_container[] = $obj->second;
					$this->_M_container[] = $obj->third;
					$tuple->_M_size += 3;
				} else if ($obj instanceof \std\pair) {
					$this->_M_container[] = $obj->first;
					$this->_M_container[] = $obj->second;
					$tuple->_M_size += 2;
				} else {
					$this->_M_container[] = $val;
					++$tuple->_M_size;
				}
			}
		}

		function & swap(tuple &$tuple)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;
			$this->_M_container = $tuple->_M_container;
			$this->_M_size = $tuple->_M_size;
			$tuple->_M_container = $c;
			$tuple->_M_size = $sz;
			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */