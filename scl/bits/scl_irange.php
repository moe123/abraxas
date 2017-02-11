<?php
# -*- coding: utf-8 -*-

//
// scl_irange.php
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
	final class irange extends basic_irange
	{
		function __construct(int $pos___ , int $len___ = null, int $step___ = 1)
		{
			parent::__construct();
			if (!$step___) {
				$step___ = 1;
			}
			if (is_null($len___)) {
				$len___ = $pos___;
				$pos___ = 0;
			}
			for ($i = $pos___; $i < $len___ + $pos___; $i += $step___) {
				$this->_M_container[] = $i;
				++$this->_M_size;
			}
		}

		function & swap(irange &$irg)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $irg->_M_container;
			$this->_M_size = $irg->_M_size;

			$irg->_M_container = $c;
			$irg->_M_size = $sz;

			return $this;
		}

		function size()
		{ return $this->_M_size; }
	} /* EOC */
} /* EONS */

/* EOF */