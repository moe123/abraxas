<?php
# -*- coding: utf-8 -*-

//
// ___scl_cunistd.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_cerrno.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_csignal.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_cstring.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_cstdio.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_ctime.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_cstdlib.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "___scl_cxlocale.php";
} /* EONS */

namespace std
{
	function _exit(int $status)
	{ exit($status); }

	function usleep(int $usecs___)
	{
		if (true !== \time_nanosleep(0, $usecs___ * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function unlink(string $filen___)
	{
		if (true !== \unlink($filen___)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function getpid()
	{
		if (function_exists('\posix_getpid')) {
			return posix_getpid();
		} else {
			return \getmypid();
		}
		return -1;
	}

	function getppid()
	{
		if (function_exists('\posix_getppid')) {
			return posix_getppid();
		} else {
			return \intval(\exec("`which ps` -o ppid= " . \getmypid() . " | xargs"));
		}
		return -1;
	}
} /* EONS */

/* EOF */