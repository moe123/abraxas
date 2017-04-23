<?php
# -*- coding: utf-8 -*-

//
// scl_collator.php
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
	abstract class collator_mode
	{
		const normalization = \Collator::NORMALIZATION_MODE;
			const normalization_on        = \Collator::ON;
			const normalization_off       = \Collator::OFF;
			const normalization_reset     = \Collator::DEFAULT_VALUE;

		const alternate     = \Collator::ALTERNATE_HANDLING;
			const alternate_on            = \Collator::SHIFTED;
			const alternate_off           = \Collator::NON_IGNORABLE;
			const alternate_reset         = \Collator::DEFAULT_VALUE;

		const backwards     = \Collator::FRENCH_COLLATION;
			const backwards_on            = \Collator::ON;
			const backwards_off           = \Collator::OFF;
			const backwards_reset         = \Collator::DEFAULT_VALUE;

		const numeric       = \Collator::NUMERIC_COLLATION;
			const numeric_on              = \Collator::ON;
			const numeric_off             = \Collator::OFF;
			const numeric_reset           = \Collator::DEFAULT_VALUE;

		const caselower     = \Collator::CASE_FIRST;
			const caselower_on            = \Collator::LOWER_FIRST;
			const caselower_off           = \Collator::UPPER_FIRST;
			const caselower_reset         = \Collator::DEFAULT_VALUE;

		const caseupper     = \Collator::CASE_FIRST;
			const caseupper_on            = \Collator::UPPER_FIRST;
			const caseupper_off           = \Collator::LOWER_FIRST;
			const caseupper_reset         = \Collator::DEFAULT_VALUE;

		const caselevel     = \Collator::CASE_LEVEL;
			const caselevel_on            = \Collator::ON;
			const caselevel_off           = \Collator::OFF;
			const caselevel_reset         = \Collator::DEFAULT_VALUE;
	} /* EOC */

	abstract class collator_level
	{
		const natural    = \Collator::DEFAULT_STRENGTH;
		const identical  = \Collator::IDENTICAL;
		const primary    = \Collator::PRIMARY;
		const secondary  = \Collator::SECONDARY;
		const tertiary   = \Collator::TERTIARY;
		const quaternary = \Collator::QUATERNARY;
	} /* EOC */

	abstract class collator_flag
	{
		const regular   = \Collator::SORT_REGULAR;
		const numeric   = \Collator::SORT_NUMERIC;
		const character = \Collator::SORT_STRING;
	} /* EOC */

	final class collator
	{
		var $_M_collator;
		var $_M_locale_id;
		var $_M_locale_name;
		var $_M_flag;

		function __invoke($l, $r)
		{ return $this->compare($l, $r); }

		function __toString()
		{ return $this->locale_id(); }

		function __construct(
			  locale $locale
			, int    $collator_level = collator_level::natural
			, int    $collator_flag  = collator_flag::regular
		) {
			$this->_M_locale_id        = $locale->_M_id;
			$this->_M_locale_name      = locale::canonicalize_id($this->_M_locale_id);
			$this->_M_collator = new \Collator($this->_M_locale_name);
			$this->set_level($collator_level);
			$this->set_flag($collator_flag);
		}

		function locale_id()
		{ return $this->_M_locale_id; }

		function locale_name()
		{ return $this->_M_locale_name; }

		function name()
		{ return $this->_M_collator->getLocale(\Locale::VALID_LOCALE); }

		function set_mode(int $mode, int $mode_value)
		{ $this->_M_collator->setAttribute($mode, $mode_value); }

		function get_mode(int $mode)
		{ $this->_M_collator->getAttribute($mode); }

		function set_level(int $level)
		{ $this->_M_collator->setStrength($level); }

		function get_level()
		{ return $this->_M_collator->getStrength(); }

		function set_flag(int $flag)
		{ $this->_M_flag = $flag; }

		function get_flag()
		{ return $this->_M_flag; }

		function compare($l, $r)
		{
			if (false === ($r = $this->_M_collator->compare(\strval($l), \strval($r), $this->_M_flag))) {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $r;
		}

		function & swap(collator &$collator)
		{
			$coll  = $this->_M_collator;
			$lcid  = $this->_M_locale_id;
			$lcnm  = $this->_M_locale_name;

			$this->_M_collator    = $collator->_M_collator;
			$this->_M_locale_id   = $collator->_M_locale_id;
			$this->_M_locale_name = $collator->_M_locale_name;

			$collator->_M_collator    = $coll;
			$collator->_M_locale_id   = $lcid;
			$collator->_M_locale_name = $lcnm;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */