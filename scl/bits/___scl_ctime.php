<?php
# -*- coding: utf-8 -*-

//
// ___scl_ctime.php
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
	final class timespec
	{
		var $tv_sec;  /* seconds */
		var $tv_nsec; /* nanoseconds */

		function __construct(int $sec___, int $nsec___)
		{
			$this->tv_sec = $sec___;
			$this->tv_nsec = $nsec___;
		}
	} /* EOC */

	final class timeval
	{
		var $tv_sec;  /* seconds */
		var $tv_usec; /* microseconds */

		function __construct(int $sec___, int $usec___)
		{
			$this->tv_sec = $sec___;
			$this->tv_usec = $usec___;
		}
	} /* EOC */

	final class timezone
	{
		var $tz_minuteswest; /* minutes west of Greenwich */
		var $tz_dsttime;     /* type of DST correction */

		function __construct(int $mws___, int $dsttm___)
		{
			$this->tz_minuteswest = $mws___;
			$this->tz_dsttime = $dsttm___;
		}
	} /* EOC */

	final class tm
	{
		var $_M_gmt = 0;

		var $tm_sec;   /* seconds after the minute 0-61  */
		var $tm_min;   /* minutes after the hour 0-59  */
		var $tm_hour;  /* hours since midnight 0-23  */
		var $tm_mday;  /* day of the month 1-31  */
		var $tm_mon;   /* months since January 0-11  */
		var $tm_year;  /* years since 1900 */
		var $tm_wday;  /* days since Sunday 0-6 */
		var $tm_yday;  /* days since January 1	0-365 */
		var $tm_isdst; /* Daylight Saving Time flag */

		function __construct(
			  int $tm_sec___
			, int $tm_min___
			, int $tm_hour___
			, int $tm_mday___
			, int $tm_mon___
			, int $tm_year___
			, int $tm_wday___
			, int $tm_yday___
			, int $tm_isdst___
		) {
			$this->tm_sec   = $tm_sec___;
			$this->tm_min   = $tm_min___;
			$this->tm_hour  = $tm_hour___;
			$this->tm_mday  = $tm_mday___;
			$this->tm_mon   = $tm_mon___;
			$this->tm_year  = $tm_year___;
			$this->tm_wday  = $tm_wday___;
			$this->tm_yday  = $tm_yday___;
			$this->tm_isdst = $tm_isdst___;
		}
	} /* EOC */

	function _F_tzsys_1()
	{
		if (\strtoupper(\substr(\PHP_OS, 0, 3)) != "WIN") {
			if (false !== ($tz = @\readlink("/etc/localtime"))) {
				if (false !== ($tz = @\substr($tz, 20))) {
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
		if (\strtoupper(\substr(\PHP_OS, 0, 3)) == "WIN") {
			$cmd = "tzutil /g";
		} else {
			$cmd = "`which ls` -l /etc/localtime|/usr/bin/cut -d\"/\" -f7,8";
		}
		if (false !== ($tz = \exec($cmd))) {
			return $tz;
		}
		seterrno(EINVAL);
		return _F_tzsys_3();
	}

	function _F_tzsys_3()
	{
		if (\strtoupper(\substr(\PHP_OS, 0, 3)) != "WIN") {
			if (false !== ($tz = \exec("`which date` +%Z | xargs"))) {
				$l = \timezone_abbreviations_list();
				foreach($l as $k => $v) {
					if (\strtolower($k) == \strtolower($tz)) {
						$tz = $v[0]["timezone_id"];
						return $tz;
					}
				}
			}
		}
		seterrno(EINVAL);
		return _F_tzsys_4();
	}

	function _F_tzsys_4()
	{
		if (false !== ($tz = @\getenv("TZ"))) {
			return $tz;
		}
		seterrno(EINVAL);
		return "UTC";
	}

	function tzsys()
	{ return _F_tzsys_1(); }

	function tzname()
	{ return  @\date_default_timezone_get(); }
	
	function tzoffset()
	{
		$tz = new \DateTimeZone(@\date_default_timezone_get());
		$tm = new \DateTime("now", $tz);
		return $tz->getOffset($tm);
	}

	function tzdaylight()
	{
		$tz = new \DateTimeZone(@\date_default_timezone_get());
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
		$tz = @\date_default_timezone_get();
		if ($tz == "UTC") {
			$tz = tzsys();
			if (!@\date_default_timezone_set($tz)) {
				$tz = "UTC";
				!@\date_default_timezone_set($tz);
			}
		}
		return $tz;
	}

	function tzsetwall()
	{ return tzset(); }

	function time(int &$tloc___ = null)
	{
		$t = \time();
		if (!\is_null($tloc___)) {
			$tloc = &$t;
		}
		return $t;
	}

	function strftime(string &$dest___, string $fmt___, tm &$tm___)
	{
		if ($tm___->_M_gmt) {
			$dest___ = @\strftime($fmt___, timegm($tm___));
		} else {
			$dest___ = @\strftime($fmt___, timelocale($tm___));
		}
		return memlen($dest___);
	}

	function strftime_l(string &$dest___, string $fmt___, tm &$tm___, string $locid___)
	{
		$l = \setlocale(\LC_TIME, "");
		if (\strlen($l) < 1) {
			$l = "C";
		}
		\setlocale(\LC_TIME, $locid___);
		if ($tm___->_M_gmt) {
			$dest___ = @\strftime($fmt___, timegm($tm___));
		} else {
			$dest___ = @\strftime($fmt___, timelocale($tm___));
		}
		\setlocale(\LC_TIME, $l);
		return $dest___;
	}

	function gettimeofday(timeval &$tv, timezone &$tz = null)
	{
		$r = \gettimeofday();
		if (\is_array($r)) {
			$tv->tv_sec  = $r["sec"];
			$tv->tv_usec = $r["usec"];
			if (!\is_null($tz)) {
				$tz->tz_minuteswest = $r["minuteswest"];
				$tz->tz_dsttime     = $r["dsttime"];
			}
		} else {
			seterrno(EFAULT);
			return -1;
		}
		return 0;
	}

	function localtime(int $time___)
	{
		$lt = \localtime($time___, true);
		return new tm(
			  $lt["tm_sec"]
			, $lt["tm_min"]
			, $lt["tm_hour"]
			, $lt["tm_mday"]
			, $lt["tm_mon"]
			, $lt["tm_year"]
			, $lt["tm_wday"]
			, $lt["tm_yday"]
			, $lt["tm_isdst"]
		);
	}

	function & localtime_r(int $time___, tm &$res___)
	{
		$lt = \localtime($time___, true);
		$res___->tm_sec   = $lt["tm_sec"];
		$res___->tm_min   = $lt["tm_min"];
		$res___->tm_hour  = $lt["tm_hour"];
		$res___->tm_mday  = $lt["tm_mday"];
		$res___->tm_mon   = $lt["tm_mon"];
		$res___->tm_year  = $lt["tm_year"];
		$res___->tm_wday  = $lt["tm_wday"];
		$res___->tm_yday  = $lt["tm_yday"];
		$res___->tm_isdst = $lt["tm_isdst"];
		return $res___;
	}

	function gmtime(int $time___)
	{
		$dt    = \gmdate("s|i|H|d|m|Y|w|z|I", $time___);
		$gt    = \explode("|", $dt);
		$gt[4] = \intval($gt[4]);
		$gt[5] = \intval($gt[5]);
		$gt[4] -= 1;
		$gt[5] -= 1900;

		$tm = new tm(
			  \intval($gt[0])
			, \intval($gt[1])
			, \intval($gt[2])
			, \intval($gt[3])
			, $gt[4]
			, $gt[5]
			, \intval($gt[6])
			, \intval($gt[7])
			, \intval($gt[8])
		);
		$tm->_M_gmt = 1;
		return $tm;
	}

	function & gmtime_r(int $time___, tm &$res___)
	{
		$dt    = \gmdate("s|i|H|d|m|Y|w|z|I", $time___);
		$gt    = \explode("|", $dt);
		$gt[4] = \intval($gt[4]);
		$gt[5] = \intval($gt[5]);
		$gt[4] -= 1;
		$gt[5] -= 1900;

		$res___->tm_sec   = \intval($gt[0]);
		$res___->tm_min   = \intval($gt[1]);
		$res___->tm_hour  = \intval($gt[2]);
		$res___->tm_mday  = \intval($gt[3]);
		$res___->tm_mon   = $gt[4];
		$res___->tm_year  = $gt[5];
		$res___->tm_wday  = \intval($gt[6]);
		$res___->tm_yday  = \intval($gt[7]);
		$res___->tm_isdst = \intval($gt[8]);
		$res___->_M_gmt   = 1;
		return $res___;
	}

	function timelocale(tm &$tm___)
	{
		return \mktime(
			  $tm___->tm_hour
			, $tm___->tm_min
			, $tm___->tm_sec
			, $tm___->tm_mon + 1
			, $tm___->tm_mday
			, $tm___->tm_year + 1900
			, $tm___->tm_isdst
		);
	}

	function timegm(tm &$tm___)
	{
		return \gmmktime(
			  $tm___->tm_hour
			, $tm___->tm_min
			, $tm___->tm_sec
			, $tm___->tm_mon + 1
			, $tm___->tm_mday
			, $tm___->tm_year + 1900
			, $tm___->tm_isdst
		);
	}

	function nanosleep(timespec &$req___, timespec &$rem___ = null)
	{
		$r = null;
		if ($req___->tv_sec >= 0 && ($req___->tv_nsec >= 0 && $req___->tv_nsec <= 999999999)) {
			if (!\is_null($rem___)) {
				$rem___->tv_sec = $req___->tv_sec;
				$rem___->tv_nsec = $req___->tv_nsec;
			}
			if (false === ($r = \time_nanosleep($req___->tv_sec, $req___->tv_nsec))) {
				seterrno(EFAULT);
				return -1;
			}
			if (\is_array($r)) {
				if (!\is_null($rem___)) {
					$rem___->tv_sec  = $r["seconds"];
					$rem___->tv_nsec = $r["nanoseconds"];
				}
				seterrno(EINTR);
				return -1;
			}
		} else {
			seterrno(EINVAL);
			return -1;
		}
		return 0;
	}
} /* EONS */

/* EOF */