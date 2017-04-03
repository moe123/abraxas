<?php
# -*- coding: utf-8 -*-

//
// libx_timezone.php
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
	const _N_zonetab = [
		[ "offset" => (12 * 60)        , "stdzone" => "NZST", "dlzone" => "NZDT"    ], /* New Zealand */
		[ "offset" => (10 * 60)        , "stdzone" => "AEST", "dlzone" => "AEDT"    ], /* Aust: Eastern */
		[ "offset" => ((9 * 60) + 30)  , "stdzone" => "ACST", "dlzone" => "ACDT"    ], /* Aust: Central */
		[ "offset" => (9 * 60)         , "stdzone" => "JST" , "dlzone" =>  null     ], /* Japan */
		[ "offset" => (8 * 60)         , "stdzone" => "AWST", "dlzone" => "AWDT"    ], /* Aust: Western */
		[ "offset" => (8 * 60)         , "stdzone" => "ULAT", "dlzone" => "ULAST"   ], /* Ulaanbaatar */
		[ "offset" => (7 * 60)         , "stdzone" => "HOVT", "dlzone" => "HOVST"   ], /* Khovd */
		[ "offset" => ((6 * 60) + 30)  , "stdzone" => "MMT" , "dlzone" =>  null     ], /* Myanmar */
		[ "offset" => (6 * 60)         , "stdzone" => "OMST", "dlzone" =>  null     ], /* Omsk */
		[ "offset" => ((5 * 60) + 45)  , "stdzone" => "NPT" , "dlzone" =>  null     ], /* Nepal */
		[ "offset" => ((5 * 60) + 30)  , "stdzone" => "IST" , "dlzone" =>  null     ], /* Indian */
		[ "offset" => (5 * 60)         , "stdzone" => "ORAT", "dlzone" =>  null     ], /* Oral */
		[ "offset" => ((3 * 60) + 30)  , "stdzone" => "IRST", "dlzone" => "IRDT"    ], /* Iran */
		[ "offset" => (2 * 60)         , "stdzone" => "EET" , "dlzone" => "EET DST" ], /* Eastern European */
		[ "offset" => (1 * 60)         , "stdzone" => "MET" , "dlzone" => "MET DST" ], /* Middle European */
		[ "offset" => (0 * 60)         , "stdzone" => "WET" , "dlzone" => "WET DST" ], /* Western European */
		[ "offset" => ((-3 * 60) + 30) , "stdzone" => "NST" , "dlzone" => "NST"     ], /* Newfoundland */
		[ "offset" => (-4 * 60)        , "stdzone" => "AST" , "dlzone" => "ADT"     ], /* Atlantic */
		[ "offset" => (-5 * 60)        , "stdzone" => "EST" , "dlzone" => "EDT"     ], /* Eastern */
		[ "offset" => (-6 * 60)        , "stdzone" => "CST" , "dlzone" => "CDT"     ], /* Central */
		[ "offset" => (-7 * 60)        , "stdzone" => "MST" , "dlzone" => "MDT"     ], /* Mountain */
		[ "offset" => (-8 * 60)        , "stdzone" => "PST" , "dlzone" => "PDT"     ], /* Pacific */
		[ "offset" => (-9 * 60)        , "stdzone" => "AKST", "dlzone" => "AKDT"    ], /* Alaska */
		[ "offset" => (-9 * 60)        , "stdzone" => "YST" , "dlzone" => "YDT"     ], /* Yukon */
		[ "offset" => (-10 * 60)       , "stdzone" => "HST" , "dlzone" => "HDT"     ], /* Hawaiian */
		[ "offset" => (-11 * 60)       , "stdzone" => "SST" , "dlzone" =>  null     ], /* Samoa */
		[ "offset" => (-12 * 60)       , "stdzone" => "BIT" , "dlzone" =>  null     ], /* Baker Island */
	];

	function _F_tztab(int $zone___, int $dst___)
	{
		foreach (_N_zonetab as &$v) {
			if ($v["offset"] ==  -($zone___)) {
				if ($dst___ && !\is_null($v["dlzone"])) {
					return $v["dlzone"];
				}
				if (!$dst___ && !\is_null($v["stdzone"])) {
					return $v["stdzone"];
				}
			}
		}
		$ch_sign = '-';
		if ($zone___ < 0) {
			$zone___ = -($zone___);
			$ch_sign = '+';
		}
		seterrno(EINVAL);
		return \sprintf("GMT%s%d:%02d"
			, $ch_sign
			, \intval($zone___ / 60)
			, \intval($zone___ % 60)
		);
	}

	function _F_tzname(string $tzabbr___)
	{
		if ($tzabbr___ != "GMT" && $tzabbr___ != "UTC") {
			if (false !== ($tz = \timezone_name_from_abbr($tzabbr___))) {
				seterrno(NOERR);
				return $tz;
			}
		}
		return "Europe/London";
	}

	function _F_tzsys_1()
	{
		if (!_F_os_windows()) {
			if (false !== ($tz = @\readlink("/etc/localtime"))) {
				if (false !== ($tz = \substr($tz, 20))) {
					seterrno(NOERR);
					return $tz;
				}
			}
		} else {
			return _F_tzsys_2();
		}
		seterrno(EINVAL);
		return _F_tzsys_2();
	}

	function _F_tzsys_2()
	{
		if (_F_os_windows()) {
			$cmd = "tzutil /g";
		} else {
			$cmd = "`which ls` -l /etc/localtime|/usr/bin/cut -d'/' -f7,8";
		}
		if (false !== ($tz = \exec($cmd))) {
			seterrno(NOERR);
			return $tz;
		}
		seterrno(EINVAL);
		return _F_tzsys_3();
	}

	function _F_tzsys_3()
	{
		if (!_F_os_windows()) {
			if (false !== ($tz = \exec("`which date` +%Z | xargs"))) {
				if (false !== ($tz != \timezone_name_from_abbr($tz))) {
					seterrno(NOERR);
					return $tz;
				}
			}
		}
		seterrno(EINVAL);
		return _F_tzsys_4();
	}

	function _F_tzsys_4()
	{
		if (false !== ($tz = \getenv("TZNAME"))) {
			seterrno(NOERR);
			return $tz;
		}
		if (false !== ($tz = \getenv("TZ"))) {
			seterrno(NOERR);
			return $tz;
		}
		seterrno(EINVAL);
		return _F_tzsys_5();
	}

	function _F_tzsys_5()
	{
		$l = \file_get_contents("http://ip-api.com/json");
		$a = \json_decode($l, true);
		if (!\is_null($a) && isset($a["timezone"])) {
			seterrno(NOERR);
			return $a["timezone"];
		}
		seterrno(EINVAL);
		return _F_tzname("GMT");
	}

	function tzsys()
	{ return _F_tzsys_1(); }

	function tzname()
	{ return \date_default_timezone_get(); }
	
	function tzoffset()
	{
		$tz = new \DateTimeZone(\date_default_timezone_get());
		$tm = new \DateTime("now", $tz);
		return $tz->getOffset($tm);
	}

	function tzdaylight()
	{
		$tz = new \DateTimeZone(\date_default_timezone_get());
		$tm = new \DateTime("now", $tz);
		$ts = $tz->getTransitions();
		$st = $tm->format('U');
		foreach ($ts as $k => &$v) {
			if ($v["ts"] > $st) {
				return $ts[($k -1)]['isdst'] ? 1 : 0;
			}
		}
		seterrno(EINVAL);
		return 0;
	}

	function tzset()
	{
		static $_S_tz = null;
		if (\is_null($_S_tz)) {
			$_S_tz = \date_default_timezone_get();
			if ($_S_tz == "GMT" || $_S_tz == "UTC") {
				$_S_tz = tzsys();
				if (!\date_default_timezone_set($_S_tz)) {
					$_S_tz = "GMT";
					seterrno(EINVAL);
					\date_default_timezone_set($_S_tz);
				}
			}
		}
		return $_S_tz;
	}

	function tzsetwall()
	{ return tzset(); }

	function timezone(int $zone___, int $dst___)
	{ return _F_tztab($zone___, $dst___); }
} /* EONS */

/* EOF */