<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_locale.php
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

declare(strict_types=1);

namespace std
{
	abstract class local_info
	{
		const language    = 0;
		const description = 1;
		const region      = 2;
		const script      = 3;
		const variant     = 4;
	} /* EOC */

	final class locale
	{
		use _T_multi_construct;

		static $_S_global;

		var $_M_id;
		var $_M_name;
		var $_M_collator;
		var $_M_caterory;

		static function canonicalize_id(string $locale_id)
		{
			if ($locale_id === null || $locale_id === "" || $locale_id === 0) {
				$locale_id = \ini_get('intl.default_locale');
				if ($locale_id === false || \strlen($locale_id) < 1) {
					$locale_id = "en_US_POSIX";
				}
			} else if ($locale_id == "C" || $locale_id == "POSIX") {
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
				, collator_level::natural
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
			locale::$_S_global = clone $locale;
			locale::$_S_global->_M_id = $locale_id;
			return locale::$_S_global;
		}

		static function get_global()
		{
			if (!isset(locale::$_S_global)) {
				$locale_id = \setlocale(locale_category::all, "");
				if ($locale_id === "C") {
					$locale_id = "en_US_POSIX";
				}

				locale::$_S_global = new locale(
					  $locale_id
					, collator_level::natural
					, locale_category::all
				);
			}
			return locale::$_S_global;
		}

		static function get_classic()
		{ return new locale("C"); }

		static function get_posix()
		{ return new locale("en_US_POSIX"); }

		function __invoke($l, $r)
		{ return $this->_M_collator->compare($l, $r); }

		function __toString()
		{ return $this->_M_id; }

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function locale_1(locale &$locale)
		{
			$this->_M_id       = $locale->_M_id;
			$this->_M_name     = $locale->_M_name;
			$this->_M_collator = $locale->_M_collator;
			$this->_M_caterory = $locale->_M_caterory;
		}

		function locale_2(string $locale_id, int $collator_level)
		{
			$this->_M_id       = $locale_id;
			$this->_M_name     = locale::canonicalize_id($locale_id);
			$this->_M_collator = new collator($this, $collator_level);
			$this->_M_caterory = locale_category::all;
		}

		function locale_3(string $locale_id, int $collator_level, int $category)
		{
			$this->_M_id       = $locale_id;
			$this->_M_name     = locale::canonicalize_id($locale_id);
			$this->_M_collator = new collator($this, $collator_level);
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

		function info(int $local_info)
		{
			$info = null;
			switch ($local_info) {
				case local_info::language:
					$info = \Locale::getDisplayLanguage($this->_M_id, $this->_M_name);
				break;
				case local_info::description:
					$info = \Locale::getDisplayName($this->_M_id, $this->_M_name);
				break;
				case local_info::region:
					$info = \Locale::getDisplayRegion($this->_M_id, $this->_M_name);
				break;
				case local_info::script:
					$info = \Locale::getDisplayScript($this->_M_id, $this->_M_name);
				break;
				case local_info::variant:
					$info = \Locale::getDisplayVariant($this->_M_id, $this->_M_name);
				break;
			}
			return $info;
		}

		function xlocale(int $mask = xlocale_mask::all)
		{ return newlocale($mask, $this->_M_id); }

		function & swap(locale &$locale)
		{
			$id       = $this->_M_id;
			$name     = $this->_M_name;
			$collator = $this->_M_collator;
			$caterory = $this->_M_collator;

			$this->_M_id       = $locale->_M_id;
			$this->_M_name     = $locale->_M_name;
			$this->_M_collator = $locale->_M_collator;
			$this->_M_caterory = $locale->_M_caterory;

			$locale->_M_id       = $id;
			$locale->_M_name     = $name;
			$locale->_M_collator = $collator;
			$locale->_M_caterory = $caterory;

			return $this;
		}
	} /* EOC */

	function set_locale(
		  string $locale_id
		, int    $caterory       = locale_category::all
		, int    $collator_level =  collator_level::natural
	) {
		return locale::set_global(
			new locale(
				  $locale_id
				, $collator_level
				, $caterory
			)
		);
	}

	function get_locale()
	{ return locale::get_global(); }
} /* EONS */

/* EOF */