<?php
# -*- coding: utf-8 -*-

//
// scl_u8string.php
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
	final class u8string extends basic_u8string
	{
		use _T_multi_construct_traits;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function u8string_1(u8string &$u8)
		{ $this->assign($u8); }

		function u8string_2(string $s, int $encoding)
		{ $this->assign_str($s, $encoding); }

		function & assign(u8string &$u8)
		{
			$this->_M_container = $u8->_M_container;
			$this->_M_size      = $u8->_M_size;
			return $this;
		}

		function & assign_str(string $s, int $encoding = basic_encoding::utf8)
		{
			if ($encoding !== basic_encoding::utf8) {
				$s = _F_builtin_u8gh_convert($s, $encoding);
			}
			$this->_M_container = _F_builtin_u8gh_split($s, $this->_M_size);
			return $this;
		}

		function & insert(u8string &$u8, int $pos)
		{
			if ($pos >= 0 && $pos < $this->_M_size) {
				if ($u8->_M_size) {
					if ($pos == ($this->_M_size -1)) {
						$this->_M_container += $u8->_M_container;
						$this->_M_size      += $u8->_M_size;
					} else {
						\array_splice($this->_M_container, $pos, 1, $u8->_M_container);
						$this->_M_size += $u8->_M_size;
					}
				}
			} else if ($pos >= 0 && $u8->_M_size) {
				$this->_M_container = $u8->_M_container;
				$this->_M_size      = $u8->_M_size;
			}
			return $this;
		}

		function & insert_str(string $s, int $pos, int $encoding = basic_encoding::utf8)
		{
			$u8 = new u8string($s, $encoding);
			$this->insert($u8, $pos);
			return $this;
		}

		function & swap(u8string &$u8)
		{
			$c = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $u8->_M_container;
			$this->_M_size = $u8->_M_size;

			$u8->_M_container = $c;
			$u8->_M_size = $sz;

			return $this;
		}

		function & substr(int $pos, int $len = numeric_limits_int::max)
		{
			$u8 = new u8string;
			if ($len === numeric_limits_int::max) {
				$u8->_M_container = \array_slice($this->_M_container, $pos);
			} else {
				$u8->_M_container = \array_slice($this->_M_container, $pos, $len);
			}
			$u8->_M_size = \count($u8->_M_container);
			return $u8;
		}

		function compare(u8string &$u8)
		{ return _F_builtin_u8_cmp($this, $u8); }

		function localized_compare(u8string &$u8, locale &$loc)
		{ return _F_builtin_u8_cmp($this, $u8, $loc); }

		function find(u8string &$u8, int $pos = 0)
		{ return _F_builtin_u8_find($this, $u8, $pos); }

		function rfind(u8string &$u8, int $pos = 0)
		{ return _F_builtin_u8_rfind($this, $u8, $pos); }

		function & append(u8string &$u8)
		{
			if ($u8->_M_size) {
				if ($this->_M_size) {
					foreach ($u8->_M_container as &$v) {
						$this->_M_container[] = $v;
					}
					$this->_M_size      += $u8->_M_size;
				} else {
					$this->_M_container = $u8->_M_container;
					$this->_M_size      = $u8->_M_size;
				}
			}
			return $this;
		}

		function & append_str(string $s, int $encoding = basic_encoding::utf8)
		{
			if (strlen($s)) {
				if ($encoding !== basic_encoding::utf8) {
					$s = _F_builtin_u8gh_convert($s, $encoding);
				}
				$c = 0;
				$a = _F_builtin_u8gh_split($s, $c);
				if ($this->_M_size && $c) {
					foreach ($a as &$v) {
						$this->_M_container[] = $v;
					}
					$this->_M_size += $c;
				} else if ($c) {
					$this->_M_container = $a;
					$this->_M_size      = $c;
				}
			}
			return $this;
		}

		function & prepend(u8string &$u8)
		{
			if ($u8->_M_size) {
				if ($this->_M_size) {
						$buf = $u8->_M_container;
						foreach ($this->_M_container as &$v) {
							$buf[] = $v;
						}
						$this->_M_container = $buf;
						$this->_M_size     += $u8->_M_size;
				} else {
					$this->_M_container = $u8->_M_container;
					$this->_M_size      = $u8->_M_size;
				}
			}
			return $this;
		}

		function & prepend_str(string $s, int $encoding = basic_encoding::utf8)
		{
			if (strlen($s)) {
				if ($encoding !== basic_encoding::utf8) {
					$s = _F_builtin_u8gh_convert($s, $encoding);
				}
				$c = 0;
				$a = _F_builtin_u8gh_split($s, $c);
				if ($this->_M_size && $c) {
					foreach ($this->_M_container as &$v) {
						$a[] = $v;
					}
					$this->_M_container = $a;
					$this->_M_size     += $c;
				} else if ($c) {
					$this->_M_container = $a;
					$this->_M_size      = $c;
				}
			}
			return $this;
		}

		function & reverse()
		{
			_F_builtin_reverse($this);
			return $this;
		}

		function bom()
		{ return _F_builtin_u8gh_get_bom(); }

		function & clear()
		{
			_F_builtin_clear_all($this);
			return $this;
		}

		function size()
		{ return $this->_M_size; }

		function empty()
		{ return $this->_M_size > 0 ? false : true; }
	}
} /* EONS */

/* EOF */