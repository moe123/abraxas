<?php
# -*- coding: utf-8 -*-

//
// scl_collator.php
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
	abstract class collator_mode
	{
		const normalization = \Collator::NORMALIZATION_MODE;
			const normalization_on        = \Collator::ON;
			const normalization_off       = \Collator::OFF;
			const normalization_reset     = \Collator::DEFAULT_VALUE;

		const alternate    = \Collator::ALTERNATE_HANDLING;
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

	final class collator
	{
		var $_M_builtin_collator;
		var $_M_locale_id;
		var $_M_locale_name;

		function __invoke($l, $r)
		{ return $this->_M_builtin_collator->compare(\strval($l), \strval($r)); }

		function __toString()
		{ return $this->locale_id(); }

		function __construct($locale, int $collator_level = collator_level::natural)
		{
			if (\is_object($locale) && $locale instanceof \std\locale) {
				$this->_M_locale_id = $locale->_M_id;
			} else if (\is_string($locale)) {
				$this->_M_locale_id = $locale;
			} else {
				_F_throw_builtin_error("No matching constructor for initialization of 'collator'");
			}
			$this->_M_locale_name = locale::canonicalize_id($this->_M_locale_id);
			$this->_M_builtin_collator = new \Collator($this->_M_locale_name);
			$this->set_level($collator_level);
		}

		function locale_id()
		{ return $this->_M_locale_id; }

		function locale_name()
		{ return $this->_M_locale_name; }

		function name()
		{ return $this->_M_builtin_collator->getLocale(\Locale::VALID_LOCALE); }

		function set_mode(int $mode, int $mode_value)
		{ $this->_M_builtin_collator->setAttribute($mode, $mode_value); }

		function get_mode(int $mode)
		{ $this->_M_builtin_collator->getAttribute($mode); }

		function set_level(int $level)
		{ $this->_M_builtin_collator->setStrength($level); }

		function get_level()
		{ return $this->_M_builtin_collator->getStrength(); }

		function compare($l, $r)
		{ return $this->_M_builtin_collator->compare(\strval($l), \strval($r)); }

		function & swap(collator &$collator)
		{
			$coll = $this->_M_builtin_collator;
			$lcid  = $this->_M_locale_id;
			$lcnm  = $this->_M_locale_name;

			$this->_M_builtin_collator = $collator->_M_builtin_collator;
			$this->_M_locale_id = $collator->_M_locale_id;
			$this->_M_locale_name = $collator->_M_locale_name;

			$collator->_M_builtin_collator = $coll;
			$collator->_M_locale_id = $lcid;
			$collator->_M_locale_name = $lcnm;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */