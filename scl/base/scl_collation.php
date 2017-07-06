<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_collation.php
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
} /* EONS */

/* EOF */