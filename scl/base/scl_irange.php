<?php
# -*- coding: utf-8 -*-

//
// scl_irange.php
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
	final class irange extends basic_irange
	{
		use _T_multi_construct;

		function __construct()
		{ 
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function irange_1(int $len___)
		{
			for ($i = 0; $i < $len___; $i++) {
				$this->_M_container[] = $i;
				++$this->_M_size;
			}
		}

		function irange_2(int $pos___, int $len___)
		{
			for ($i = $pos___; $i < $len___ + $pos___; $i++) {
				$this->_M_container[] = $i;
				++$this->_M_size;
			}
		}

		function irange_3(int $pos___, int $len___, int $step___)
		{
			if ($step___ == 0) {
				$step___ = 1;
			}
			if ($step___ < 0) {
				$step___ = -$step___;
				for ($i = ($pos___ + $len___- 1); $i > (($pos___ + $len___- 1) - $len___); $i -= $step___) {
					$this->_M_container[] = $i;
					++$this->_M_size;
				}
			} else {
				for ($i = $pos___; $i < $len___ + $pos___; $i += $step___) {
					$this->_M_container[] = $i;
					++$this->_M_size;
				}
			}
		}

		function & swap(irange &$irg)
		{
			$c  = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $irg->_M_container;
			$this->_M_size      = $irg->_M_size;

			$irg->_M_container = $c;
			$irg->_M_size      = $sz;

			return $this;
		}

		function size()
		{ return $this->_M_size; }
	} /* EOC */
} /* EONS */

/* EOF */