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
		use _T_builtin_tuple_utils_traits;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function _F_tuple_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				_F_builtin_push_back($this->_M_container, $val);
			}
		}

		function _F_tuple_2(array $list_initializer, bool $concat)
		{
			if ($concat === true) {
				$this->_F_unpackv($list_initializer);
			} else {
				foreach ($list_initializer as &$val) {
					_F_builtin_push_back($this->_M_container, $val);
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