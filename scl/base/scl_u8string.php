<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_u8string.php
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
	abstract class encoding extends basic_encoding
	{ /* NOP */ } /* EOC */

	final class u8string extends basic_u8string
	{
		use _T_multi_construct;

		static function & to_utf8(string &$s, int $encoding, int &$binlen)
		{
			$binlen = 0;
			if (strlen($s)) {
				if ($encoding !== basic_encoding::utf8) {
					$s = _F_u8gh_convert($s, $encoding);
				}
				$binlen = strlen($s);
				return $s;
			}
			return "";
		}

		static function & to_utf16(string &$s, int $encoding, int &$binlen)
		{
			$binlen = 0;
			if (strlen($s)) {
				if ($encoding !== basic_encoding::utf16) {
					$s = _F_u16gh_convert($s, $encoding);
				}
				$binlen = strlen($s);
				return $s;
			}
			return "";
		}

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function u8string_1(u8string &$u8)
		{ $this->assign($u8); }

		function u8string_2(string $s, int $encoding)
		{ $this->assign_s($s, $encoding); }

		function & assign(u8string &$u8)
		{
			$this->_M_container = $u8->_M_container;
			$this->_M_size      = $u8->_M_size;
			return $this;
		}

		function & assign_s(string $s, int $encoding = basic_encoding::utf8)
		{
			$binlen = 0;
			$s = u8string::to_utf8($s, $encoding, $binlen);
			if ($binlen) {
				$this->_M_container = _F_u8gh_split($s, $this->_M_size);
			}
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

		function & insert_s(int $pos, string $s, int $encoding = basic_encoding::utf8)
		{
			$u8 = new u8string($s, $encoding);
			$this->insert($u8, $pos);
			return $this;
		}

		function & swap(u8string &$u8)
		{
			$c                  = $this->_M_container;
			$sz                 = $this->_M_size;
			$this->_M_container = $u8->_M_container;
			$this->_M_size      = $u8->_M_size;
			$u8->_M_container   = $c;
			$u8->_M_size        = $sz;

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

		function substr_compare(u8string &$u8, $pos, $len = -1)
		{ return _F_u8gh_substr_cmp($this, $u8, $pos, $len); }

		function localized_substr_compare(u8string &$u8, locale &$loc, $pos, $len = -1)
		{ return _F_u8gh_substr_cmp($this, $u8, $pos, $len, $loc); }

		function compare(u8string &$u8)
		{ return _F_u8_cmp($this, $u8); }

		function localized_compare(u8string &$u8, locale &$loc)
		{ return _F_u8_cmp($this, $u8, $loc); }

		function compare_s(string $s8)
		{
			$u8 = (new u8string)->string_assign($s, $encoding);
			return _F_u8_cmp($this, $u8);
		}

		function localized_compare_s(string $s8, locale &$loc)
		{
			$u8 = (new u8string)->string_assign($s, $encoding);
			return _F_u8_cmp($this, $u8, $loc);
		}

		function find(u8string &$u8, int $pos = 0)
		{ return _F_u8_find($this, $u8, $pos); }

		function rfind(u8string &$u8, int $pos = 0)
		{ return _F_u8_rfind($this, $u8, $pos); }

		function & append(u8string &$u8)
		{
			if ($u8->_M_size) {
				if ($this->_M_size) {
					foreach ($u8->_M_container as &$v) {
						$this->_M_container[] = $v;
					}
					$this->_M_size      += $u8->_M_size;
				} else {
					$this->_M_container  = $u8->_M_container;
					$this->_M_size       = $u8->_M_size;
				}
			}
			return $this;
		}

		function & append_s(string $s, int $encoding = basic_encoding::utf8)
		{
			$binlen = 0;
			$s = u8string::to_utf8($s, $encoding, $binlen);
			if ($binlen) {
				$c = 0;
				$a = _F_u8gh_split($s, $c);
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

		function & prepend_s(string $s, int $encoding = basic_encoding::utf8)
		{
			$binlen = 0;
			$s = u8string::to_utf8($s, $encoding, $binlen);
			if ($binlen) {
				$c = 0;
				$a = _F_u8gh_split($s, $c);
				if ($this->_M_size && $c) {
					foreach ($this->_M_container as &$v) {
						$a[] = $v;
					}
					$this->_M_container  = $a;
					$this->_M_size      += $c;
				} else if ($c) {
					$this->_M_container  = $a;
					$this->_M_size       = $c;
				}
			}
			return $this;
		}

		function & reverse()
		{
			_F_reverse($this);
			return $this;
		}

		function str()
		{ return _F_u8gh_join($this->_M_container); }

		function data()
		{ return _F_u8gh_join($this->_M_container); }

		function bom()
		{ return _F_u8gh_get_bom(); }

		function & erase(basic_iterator $first, basic_iterator $last)
		{
			_F_splice($this, $first->_F_pos(), distance($first, $last));
			return $this;
		}

		function & slice_erase(int $start, int $end)
		{
			_F_splice($this, $start, ($end - $start));
			return $this;
		}

		function & clear()
		{
			_F_clear_all($this);
			return $this;
		}

		function size()
		{ return $this->_M_size; }

		function empty()
		{ return $this->_M_size > 0 ? false : true; }
	}
} /* EONS */

/* EOF */