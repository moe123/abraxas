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
	function back_inserter(basic_iteratable $iterable___)
	{ return new back_insert_iterator($iterable___); }

	function front_inserter(basic_iteratable $iterable___)
	{ return new front_insert_iterator($iterable___); }

	function stream_inserter(basic_ostream $ostream___, string $sep___ = '')
	{ return new ostream_iterator($ostream___, $sep___ ); }

	function duotator(basic_iterator $first1___, basic_iterator $first2___)
	{ return new duo_iterator($first1___, $first2___); }

	function iterator_copy(basic_iterator &$it___)
	{ return clone $it___; }

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

	function advance(basic_iterator $it___, int $dist___)
	{ $it___->_F_advance($dist___); }

	function next(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_next();
			}
			return $it___;
		}
		return $it___->_F_next();
	}

	function prev(basic_iterator $it___, int $n___ = -1)
	{
		if ($n > 1) {
			for ($i = 0; $i < $n; $i++) {
				$it___->_F_prev();
			}
			return $it___;
		}
		return $it___->_F_prev();
	}

	function begin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->begin($offset___); }

	function end(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->end($offset___); }

	function rbegin(basic_iteratable &$iterable___, $offset___ = -1)
	{ return $iterable___->rbegin($offset___); }

	function rend(basic_iteratable &$iterable___, $offset___ = -1)
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