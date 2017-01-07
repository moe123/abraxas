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
 
namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "builtin" . DIRECTORY_SEPARATOR . "scl_basic_builtin.php";
} /* EONS */

namespace std
{
	abstract class collation
	{
		const all = [
			"af"          => ["af_NA, af_ZA"],
			"ar"          => ["ar_001, ar_AE, ar_BH, ar_DZ, ar_EG, ar_IQ, ar_JO, ar_KW, ar_LB, ar_LY, ar_MA, ar_OM, ar_QA, ar_SA, ar_SD, ar_SY, ar_TN, ar_YE"],
			"as"          => ["as_IN"],
			"az"          => ["az_Latn, az_Latn_AZ"],
			"be"          => ["be_BY"],
			"bg"          => ["bg_BG"],
			"bn"          => ["bn_BD, bn_IN"],
			"bs"          => ["bs_BA"],
			"ca"          => ["ca_ES"],
			"cs"          => ["cs_CZ"],
			"cy"          => ["cy_GB"],
			"da"          => ["da_DK"],
			"de"          => ["de_AT, de_BE, de_CH, de_DE, de_LI, de_LU"],
			"dz"          => [],
			"ee"          => ["ee_GH, ee_TG"],
			"el"          => ["el_CY, el_GR"],
			"en"          => ["en_AS, en_AU, en_BB, en_BE, en_BM, en_BW, en_BZ, en_CA, en_GB, en_GU, en_HK, en_IE, en_IN, en_JM, en_MH, en_MP, en_MT, en_MU, en_NA, en_NZ, en_PH, en_PK, en_SG, en_TT, en_UM, en_VI, en_ZA, en_ZW"],
			"en_US"       => [],
			"en_US_POSIX" => [],
			"eo"          => [],
			"es"          => ["es_419, es_AR, es_BO, es_CL, es_CO, es_CR, es_DO, es_EC, es_ES, es_GQ, es_GT, es_HN, es_MX, es_NI, es_PA, es_PE, es_PR, es_PY, es_SV, es_US, es_UY, es_VE"],
			"et"          => ["et_EE"],
			"fa"          => ["fa_IR"],
			"fa_AF"       => [],
			"fi"          => ["fi_FI"],
			"fil"         => ["fil_PH"],
			"fo"          => ["fo_FO"],
			"fr"          => ["fr_BE, fr_BF, fr_BI, fr_BJ, fr_BL, fr_CD, fr_CF, fr_CG, fr_CH, fr_CI, fr_CM, fr_DJ, fr_FR, fr_GA, fr_GN, fr_GP, fr_GQ, fr_KM, fr_LU, fr_MC, fr_MF, fr_MG, fr_ML, fr_MQ, fr_NE, fr_RE, fr_RW, fr_SN, fr_TD, fr_TG"],
			"fr_CA"       => [],
			"gu"          => ["gu_IN"],
			"ha"          => ["ha_Latn, ha_Latn_GH, ha_Latn_NE, ha_Latn_NG"],
			"haw"         => ["haw_US"],
			"he"          => ["he_IL"],
			"hi"          => ["hi_IN"],
			"hr"          => ["hr_HR"],
			"hu"          => ["hu_HU"],
			"hy"          => ["hy_AM"],
			"ig"          => ["ig_NG"],
			"is"          => ["is_IS"],
			"ja"          => ["ja_JP"],
			"kk"          => ["kk_KZ"],
			"kl"          => ["kl_GL"],
			"km"          => ["km_KH"],
			"kn"          => ["kn_IN"],
			"ko"          => ["ko_KR"],
			"kok"         => ["kok_IN"],
			"ln"          => ["ln_CD, ln_CG"],
			"lt"          => ["lt_LT"],
			"lv"          => ["lv_LV"],
			"mk"          => ["mk_MK"],
			"ml"          => ["ml_IN"],
			"mr"          => ["mr_IN"],
			"mt"          => ["mt_MT"],
			"my"          => ["my_MM"],
			"nb"          => ["nb_NO"],
			"nn"          => ["nn_NO"],
			"nso"         => ["nso_ZA"],
			"om"          => ["om_ET, om_KE"],
			"or"          => ["or_IN"],
			"pa"          => ["pa_Arab, pa_Arab_PK, pa_Guru, pa_Guru_IN"],
			"pl"          => ["pl_PL"],
			"ps"          => ["ps_AF"],
			"ro"          => ["ro_RO, ro_MD"],
			"root"        => ["chr, chr_US, ga, ga_IE, id, id_ID, it, it_CH, it_IT, ka, ka_GE, ky, ky_KG, ms, ms_BN, ms_MY, nl, nl_AW, nl_BE, nl_CW, nl_NL, nl_SX, pt, pt_AO, pt_BR, pt_GW, pt_MZ, pt_PT, pt_ST, st, st_LS, st_ZA, sw, sw_KE, sw_TZ, xh, xh_ZA, zu, zu_ZA"],
			"ru"          => ["ru_MD, ru_RU, ru_UA"],
			"se"          => ["se_FI, se_NO"],
			"si"          => ["si_LK"],
			"sk"          => ["sk_SK"],
			"sl"          => ["sl_SI"],
			"sq"          => ["sq_AL"],
			"sr"          => ["sr_Cyrl, sr_Cyrl_BA, sr_Cyrl_ME, sr_Cyrl_RS"],
			"sr_Latn"     => ["sr_Latn_RS, sr_Latn_BA, sr_Latn_ME"],
			"sv"          => ["sv_FI, sv_SE"],
			"ta"          => ["ta_IN, ta_LK"],
			"te"          => ["te_IN"],
			"th"          => ["th_TH"],
			"tn"          => ["tn_ZA"],
			"to"          => ["to_TO"],
			"tr"          => ["tr_TR"],
			"uk"          => ["uk_UA"],
			"ur"          => ["ur_PK, ur_IN"],
			"vi"          => ["vi_VN"],
			"wae"         => ["wae_CH"],
			"yo"          => ["yo_NG"],
			"zh"          => ["zh_Hans, zh_Hans_CN, zh_Hans_SG"],
			"zh_Hant"     => ["zh_Hant_HK, zh_Hant_MO, zh_Hant_TW"]
		];
	}

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
	}

	abstract class collator_level
	{
		const primary    = \Collator::PRIMARY;
		const secondary  = \Collator::SECONDARY;
		const tertiary   = \Collator::TERTIARY;
		const quaternary = \Collator::QUATERNARY;
		const identical  = \Collator::IDENTICAL;
		const none       = \Collator::DEFAULT_STRENGTH;
	}

	final class collator
	{
		use _T_multi_construct_traits;

		var $_M_builtin_collator;
		var $_M_locale_id;
		var $_M_locale_name;

		function __invoke($l, $r)
		{ return $this->_M_builtin_collator->compare((string)$l, (string)$r); }

		function __toString()
		{ return $this->locale_id(); }

		function __construct($locale, int $collator_level = collator_level::none)
		{
			if ($locale instanceof \std\locale) {
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
		{ return $this->_M_builtin_collator->compare((string)$l, (string)$r); }

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

	function make_collator(string $locale_id, int $collator_level = collator_level::none)
	{ return new collator($locale_id, $collator_level); }

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

	function make_locale(string $locale_id, int $collator_level =  collator_level::none, int $caterory = locale_category::all)
	{ return new locale($locale_id, $collator_level, $caterory); }

	function setlocale(int $caterory, string $locale_id, int $collator_level =  collator_level::none)
	{
		return locale::set_global(
			make_locale(
				  $locale_id
				, $collator_level
				, $caterory
			)
		);
	}

	function getlocale()
	{ return locale::get_global(); }
} /* EONS */

/* EOF */