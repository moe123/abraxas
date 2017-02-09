<?php
# -*- coding: utf-8 -*-

//
// _scl_xtime.php
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
	final class timeb
	{
		var $time;     /* seconds since the Epoch */
		var $millitm;  /* milliseconds since the Epoch */
		var $timezone; /* minutes west of Greenwich */
		var $dstflag;  /* non-zero if DST in effect */

		function __construct(
			  int $time___
			, int $millitm___
			, int $timezone___
			, int $dstflag___
		) {
			$this->time     = $time___;
			$this->millitm  = $millitm___;
			$this->timezone = $timezone___;
			$this->dstflag  = $dstflag___;
		}
	} /* EOC */

	final class timespec
	{
		var $tv_sec;  /* seconds */
		var $tv_nsec; /* nanoseconds */

		function __construct(int $sec___, int $nsec___)
		{
			$this->tv_sec  = $sec___;
			$this->tv_nsec = $nsec___;
		}
	} /* EOC */

	final class timeval
	{
		var $tv_sec;  /* seconds */
		var $tv_usec; /* microseconds */

		function __construct(int $sec___, int $usec___)
		{
			$this->tv_sec  = $sec___;
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
			$this->tz_dsttime     = $dsttm___;
		}
	} /* EOC */

	final class tm
	{
		var $_M_gmt = 0;

		var $tm_sec;        /* seconds after the minute 0-61  */
		var $tm_min;        /* minutes after the hour 0-59  */
		var $tm_hour;       /* hours since midnight 0-23  */
		var $tm_mday;       /* day of the month 1-31  */
		var $tm_mon;        /* months since January 0-11  */
		var $tm_year;       /* years since 1900 */
		var $tm_wday;       /* days since Sunday 0-6 */
		var $tm_yday;       /* days since January 1	0-365 */
		var $tm_isdst = -1; /* Daylight Saving Time flag */

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
		if (_F_builtin_os_darwin()) {
			if (false !== ($pos = \strpos($fmt___, "%P"))) {
				$i = 0;
				while (isset($fmt___[$i])) {
					if (
							$i == 0
						&& $fmt___[$i] == "%"
						&& $fmt___[$i + 1] == "P"
					) {
						$fmt___[$i + 1] = "p";
					} else if (
							isset($fmt___[$i + 1])
						&& $fmt___[$i] == "%"
						&& $fmt___[$i + 1] == "P"
						&& $fmt___[$i - 1] != "%"
					) {
						$fmt___[$i + 1] = "p";
					}
					++$i;
				}
			}
		}
		if ($tm___->_M_gmt) {
			$dest___ = \strftime($fmt___, timegm($tm___));
		} else {
			$dest___ = \strftime($fmt___, timelocale($tm___));
		}
		return memlen($dest___);
	}

	function strftime_l(string &$dest___, string $fmt___, tm &$tm___, locale_t &$xloc___)
	{
		uselocale($xloc);
		if ($tm___->_M_gmt) {
			$dest___ = \strftime($fmt___, timegm($tm___));
		} else {
			$dest___ = \strftime($fmt___, timelocale($tm___));
		}
		_F_builtin_unsetlocale($xloc___);
		return $dest___;
	}

	function strptime(string $buf___, string $fmt___, tm &$res___)
	{
		if (!_F_builtin_os_windows()) {
			$buflen = \strlen($buf___);
			if ($buflen) {
				$pt = \strptime($buf___, $fmt___);
				if ($pt !== false) {
					$res___->tm_sec   = \intval($pt["tm_sec"]);
					$res___->tm_min   = \intval($pt["tm_min"]);
					$res___->tm_hour  = \intval($pt["tm_hour"]);
					$res___->tm_mday  = \intval($pt["tm_mday"]);
					$res___->tm_mon   = \intval($pt["tm_mon"]);
					$res___->tm_year  = \intval($pt["tm_year"]);
					$res___->tm_wday  = \intval($pt["tm_wday"]);
					$res___->tm_yday  = \intval($pt["tm_yday"]);
					$res___->tm_isdst = -1;
					$res___->_M_gmt = -1;
					return $buf___[$buflen -1];
				}
			}
		}
		return null;
	}

	function strptime_l(string $buf___, string $fmt___, tm &$res___, locale_t &$xloc___)
	{
		if (!_F_builtin_os_windows()) {
			$buflen = \strlen($buf___);
			if ($buflen) {
				uselocale($xloc___);
				$pt = \strptime($buf___, $fmt___);
				_F_builtin_unsetlocale($xloc___);
				if ($lt !== false) {
					$res___->tm_sec   = \intval($pt["tm_sec"]);
					$res___->tm_min   = \intval($pt["tm_min"]);
					$res___->tm_hour  = \intval($pt["tm_hour"]);
					$res___->tm_mday  = \intval($pt["tm_mday"]);
					$res___->tm_mon   = \intval($pt["tm_mon"]);
					$res___->tm_year  = \intval($pt["tm_year"]);
					$res___->tm_wday  = \intval($pt["tm_wday"]);
					$res___->tm_yday  = \intval($pt["tm_yday"]);
					$res___->tm_isdst = -1;
					$res___->_M_gmt = -1;
					return $buf___[$buflen -1];
				}
			}
		}
		return null;
	}

	function ftime(timeb &$tb)
	{
		$r = \gettimeofday();
		if (\is_array($r)) {
			$tb->time     = \intval($r["sec"]);
			$tb->millitm  = \intval($r["usec"] / 1000);
			$tb->timezone = \intval($r["minuteswest"]);
			$tb->dstflag  = \intval($r["dsttime"]);
		} else {
			seterrno(EFAULT);
			return -1;
		}
		return 0;
	}

	function gettimeofday(timeval &$tv, timezone &$tz = null)
	{
		$r = \gettimeofday();
		if (\is_array($r)) {
			$tv->tv_sec  = \intval($r["sec"]);
			$tv->tv_usec = \intval($r["usec"]);
			if (!\is_null($tz)) {
				$tz->tz_minuteswest = \intval($r["minuteswest"]);
				$tz->tz_dsttime     = \intval($r["dsttime"]);
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
			  \intval($lt["tm_sec"])
			, \intval($lt["tm_min"])
			, \intval($lt["tm_hour"])
			, \intval($lt["tm_mday"])
			, \intval($lt["tm_mon"])
			, \intval($lt["tm_year"])
			, \intval($lt["tm_wday"])
			, \intval($lt["tm_yday"])
			, \intval($lt["tm_isdst"])
		);
	}

	function & localtime_r(int $time___, tm &$res___)
	{
		$lt = \localtime($time___, true);
		$res___->tm_sec   = \intval($lt["tm_sec"]);
		$res___->tm_min   = \intval($lt["tm_min"]);
		$res___->tm_hour  = \intval($lt["tm_hour"]);
		$res___->tm_mday  = \intval($lt["tm_mday"]);
		$res___->tm_mon   = \intval($lt["tm_mon"]);
		$res___->tm_year  = \intval($lt["tm_year"]);
		$res___->tm_wday  = \intval($lt["tm_wday"]);
		$res___->tm_yday  = \intval($lt["tm_yday"]);
		$res___->tm_isdst = \intval($lt["tm_isdst"]);
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
		);
	}

	function difftime(int $time1___, int $time0___)
	{ return \doubleval(time1 - time0); }

	function asctime(tm &$tm___)
	{
		$dest = "";
		if (!strftime($dest, "%a %b %H:%M:%S %Y", $tm___)) {
			return null;
		}
		return $dest;
	}

	function asctime_r(tm &$tm___, string &$dest___)
	{
		if (!strftime($dest___, "%a %b %H:%M:%S %Y", $tm___)) {
			return null;
		}
		return $dest___;
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
					$rem___->tv_sec  = \intval($r["seconds"]);
					$rem___->tv_nsec = \intval($r["nanoseconds"]);
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