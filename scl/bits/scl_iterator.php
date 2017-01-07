<?php
# -*- coding: utf-8 -*-

//
// scl_iterator.php
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
	abstract class basic_iterator_tag
	{
		const basic_iterator          = 10;
		const forward_iterator        = 20;
		const reverse_iterator        = 30;

		const insert_iterator         = 40;
		const back_insert_iterator    = 50;
		const front_insert_iterator   = 60;
	}

	abstract class basic_iterator
	{ const iterator_category = basic_iterator_tag::basic_iterator; }

	abstract class insert_iterator extends basic_iterator
	{ const iterator_category = basic_iterator_tag::insert_iterator; }

	final class forward_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::forward_iterator;

		use basic_iterator_traits;
		use forward_iterator_traits;
	}

	final class reverse_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::reverse_iterator;

		use basic_iterator_traits;
		use reverse_iterator_traits;
	}

	final class front_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::front_insert_iterator;

		use basic_iterator_traits;
		use inserter_iterator_traits;
	}

	final class back_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::back_insert_iterator;

		use basic_iterator_traits;
		use inserter_iterator_traits;
	}

	function back_inserter(basic_iteratable $iterable___)
	{ return new back_insert_iterator($iterable___); }

	function front_inserter(basic_iteratable $iterable___)
	{ return new front_insert_iterator($iterable___); }

	function distance(basic_iterator $first___, basic_iterator $last___)
	{
		$n = 0;
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___->_M_offset >= $last___->_M_offset) {
				$n = $last___->_M_offset - $first___->_M_offset;
			} else {
				$it = clone $first___;
				while ($it != $last___) {
					$it->_F_next();
					++$n;
				}
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $n;
	}

	function advance(basic_iterator $it___, int $distance___)
	{ $it___->_F_advance($distance___); }

	function next(basic_iterator $it___)
	{ return $it___->_F_next(); }

	function prev(basic_iterator $it___)
	{ return $it___->_F_prev(); }

	function begin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->begin($offset___); }

	function end(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->end($offset___); }

	function rbegin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->rbegin($offset___); }

	function rend(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->rend($offset___); }

	function & begin_p(forward_iterator $it___)
	{ return $it___->_F_seek_begin(); }

	function & end_p(forward_iterator $it___)
	{ return $it___->_F_seek_end(); }

	function & rbegin_p(reverse_iterator $it___)
	{ return $it___->_F_seek_begin(); }

	function & rend_p(reverse_iterator $it___)
	{ return $it___->_F_seek_end(); }
} /* EONS */

/* EOF */