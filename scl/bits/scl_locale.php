<?php
# -*- coding: utf-8 -*-

//
// scl_locale.php
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
	abstract class locale_category
	{
		const collate  = \LC_COLLATE;
		const ctype    = \LC_CTYPE;
		const monetary = \LC_MONETARY;
		const numeric  = \LC_NUMERIC;
		const time     = \LC_TIME;
		const messages = \LC_MESSAGES;
		const all      = \LC_ALL;
	} /* EOC */

	final class locale
	{
		use _T_multi_construct_traits;

		static $_M_global;

		var $_M_id;
		var $_M_name;
		var $_M_collator;
		var $_M_caterory = locale_category::all;

		static function canonicalize_id(string $locale_id)
		{
			if (
				   $locale_id === null
				|| $locale_id === ""
				|| $locale_id === 0
			) {
				$locale_id = \ini_get('intl.default_locale');
				if ($locale_id === false || \strlen($locale_id) < 1) {
					$locale_id = "en_US_POSIX";
				}
			} else if ($locale_id === "C") {
				$locale_id = "en_US_POSIX";
			}
			return \Locale::canonicalize($locale_id);
		}

		static function set_default(locale &$locale)
		{
			\Locale::setDefault($locale->_M_name);
			return $locale;
		}

		static function get_default()
		{
			return new locale(
				  \Locale::getDefault()
				, collator_level::none
			);
		}

		static function set_global(locale $locale)
		{
			$locale_id = $locale->_M_id;
			if ($locale_id === "en_US_POSIX") {
				$locale_id = "C";
			}

			\setlocale(
				  $locale->_M_caterory !== locale_category::all
						? locale_category::all
						: $locale->_M_caterory
				, $locale_id
			);
			locale::$_M_global = clone $locale;
			locale::$_M_global->_M_id = $locale_id;
			return locale::$_M_global;
		}

		static function get_global()
		{
			if (!isset(locale::$_M_global)) {
				$locale_id = \setlocale(locale_category::all, "");
				if ($locale_id === "C") {
					$locale_id = "en_US_POSIX";
				}

				locale::$_M_global = new locale(
					  $locale_id
					, collator_level::none
					, locale_category::all
				);
			}
			return locale::$_M_global;
		}

		static function get_classic()
		{ return make_locale("C"); }

		function __invoke($l, $r)
		{ return $this->_M_collator->compare($l, $r); }

		function __toString()
		{ return $this->_M_id; }

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function _F_locale_1(locale &$locale)
		{
			$this->_M_id = $locale->_M_id;
			$this->_M_name = $locale->_M_name;
			$this->_M_collator = $locale->_M_collator;
			$this->_M_caterory = $locale->_M_caterory;
		}

		function _F_locale_2(string $locale_id, int $collator_level)
		{
			$this->_M_id = $locale_id;
			$this->_M_name = locale::canonicalize_id($locale_id);
			$this->_M_collator = make_collator($this->_M_id, $collator_level);
		}

		function _F_locale_3(string $locale_id, int $collator_level, int $category)
		{
			$this->_M_id = $locale_id;
			$this->_M_name = locale::canonicalize_id($locale_id);
			$this->_M_collator = make_collator($this->_M_id, $collator_level);
			$this->_M_caterory = $category;
		}

		function id()
		{ return $this->_M_id; }

		function name()
		{ return $this->_M_name; }

		function caterory()
		{ return $this->_M_caterory; }

		function & collator()
		{ return $this->_M_collator; }

		function & swap(locale &$locale)
		{
			$id = $this->_M_id;
			$name = $this->_M_name;
			$collator = $this->_M_collator;
			$caterory = $this->_M_collator;

			$this->_M_id = $locale->_M_id;
			$this->_M_name = $locale->_M_name;
			$this->_M_collator = $locale->_M_collator;
			$this->_M_caterory = $locale->_M_caterory;

			$locale->_M_id = $id;
			$locale->_M_name = $name;
			$locale->_M_collator = $collator;
			$locale->_M_caterory = $caterory;

			return $this;
		}
	} /* EOC */
} /* EONS */

/* EOF */