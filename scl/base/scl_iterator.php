<?php
# -*- coding: utf-8 -*-

//
// scl_iterator.php
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
	function back_inserter(basic_iterable $iterable___)
	{ return new back_insert_iterator($iterable___); }

	function front_inserter(basic_iterable $iterable___)
	{ return new front_insert_iterator($iterable___); }

	function stream_inserter(callable $ostream___, string $sep___ = '')
	{
		if (\is_string($ostream___)) {
			$ostream___ = $ostream___();
		}
		if (!($ostream___ instanceof \std\basic_ostream)) {
			_F_throw_invalid_argument("Invalid argument error");
		}
		return new ostream_iterator($ostream___, $sep___);
	}

	function duotator(basic_iterator $first1___, basic_iterator $first2___)
	{ return new duo_iterator($first1___, $first2___); }

	function iterator_copy(basic_iterator &$it___)
	{ return clone $it___; }

	function distance(basic_iterator $first___, basic_iterator $last___)
	{ return iter_distance($first___, $last___); }

	function advance(basic_iterator $it___, int $dist___)
	{ $it___->_F_advance($dist___); }

	function next(basic_iterator $it___, int $n___ = -1)
	{ return iter_next($it___, $n___); }

	function prev(basic_iterator $it___, int $n___ = -1)
	{ return iter_prev($it___, $n___); }

	function begin(basic_iterable &$iterable___, $offset___ = -1)
	{ return $iterable___->begin($offset___); }

	function end(basic_iterable &$iterable___, $offset___ = -1)
	{ return $iterable___->end($offset___); }

	function rbegin(basic_iterable &$iterable___, $offset___ = -1)
	{ return $iterable___->rbegin($offset___); }

	function rend(basic_iterable &$iterable___, $offset___ = -1)
	{ return $iterable___->rend($offset___); }

	function & begin_p(forward_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_begin($offset___); }

	function & end_p(forward_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_end($offset___); }

	function & rbegin_p(reverse_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_begin($offset___); }

	function & rend_p(reverse_iterator $it___, $offset___ = -1)
	{ return $it___->_F_seek_end($offset___); }
} /* EONS */

/* EOF */