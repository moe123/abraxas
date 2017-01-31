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
	class timespec
	{
		var $tv_sec;  /* seconds */
		var $tv_nsec; /* nanoseconds */

		function __construct(int $sec___, int $nsec___)
		{
			$this->tv_sec = $sec___;
			$this->tv_nsec = $nsec___;
		}
	} /* EOC */

	class tm
	{
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
			$this->tm_sec = $tm_sec___;
			$this->tm_min = $tm_min___;
			$this->tm_hour = $tm_hour___;
			$this->tm_mday = $tm_mday___;
			$this->tm_mon = $tm_mon___;
			$this->tm_year = $tm_year___;
			$this->tm_wday = $tm_wday___;
			$this->tm_yday = $tm_yday___;
			$this->tm_isdst = $tm_isdst___;
		}
	} /* EOC */

	function time(int &$tloc___ = null)
	{
		$t = \time();
		if (!is_null($tloc___)) {
			$tloc = &$t;
		}
		return $t;
	}

	function nanosleep(timespec &$req___, timespec &$rem___ = null)
	{
		$r = null;
		if ($req___->tv_sec >= 0 && ($req___->tv_nsec >= 0 && $req___->tv_nsec <= 999999999)) {
			if (!is_null($rem___)) {
				$rem___->tv_sec = $req___->tv_sec;
				$rem___->tv_nsec = $req___->tv_nsec;
			}
			if (false === ($r = \time_nanosleep($req___->tv_sec, $req___->tv_nsec))) {
				seterrno(EFAULT);
				return -1;
			}
			if (\is_array($r)) {
				if (!is_null($rem___)) {
					$rem___->tv_sec = $r['seconds'];
					$rem___->tv_nsec = $r['nanoseconds'];
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