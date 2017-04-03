<?php
# -*- coding: utf-8 -*-

//
// api_unilib.php
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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_errno.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_endian.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_ostype.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_math.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_numeric.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_complex.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_locale.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_random.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_signal.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_string.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_time.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_timezone.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_utsname.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_io.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "api_baselib.php";
} /* EONS */

namespace std
{
	function clock_millisleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___ * 1000 * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function clock_microsleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___ * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function clock_nanosleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function clock_millitime()
	{
		if (_F_os_64bit()) {
			$tm = \explode(' ', \microtime());
			return (\intval($tm[1]) * 1000) + (\intval(\round($tm[0] * 1000)));
		}
		$tm = \explode(' ', \microtime());
		return \sprintf('%d%03d', \intval($tm[1]), \intval($tm[0] * 1000));
	}

	function clock_microtime()
	{
		if (_F_os_64bit()) {
			$tm = \explode(' ', \microtime());
			return (\intval($tm[1])) * 1000000 + (\intval(\round($tm[0] * 1000000)));
		}
		$tm = \explode(' ', \microtime());
		return \sprintf('%d%06d', \intval($tm[1]), \intval($tm[0] * 1000000));
	}

	function clock_nanotime()
	{
		if (_F_os_64bit()) {
			$tm = \explode(' ', \microtime());
			return (\intval($tm[1])) * 1000000000 + (\intval(\round($tm[0] * 1000000000)));
		}
		$tm = \explode(' ', \microtime());
		return \sprintf('%d%09d', \intval($tm[1]), \intval($tm[0] * 1000000000));
	}

	function gethostname(string &$dest___, int $destsz___ = -1)
	{
		if (false !== ($dest___ = \gethostname())) {
			return 0;
		}
		$dest___ = null;
		seterrno(EFAULT);
		return -1;
	}

	function getdomainname(string &$dest___, int $destsz___ = -1)
	{
		if (_F_os_windows()) {
			$cmd = "wmic computersystem get domain";
		} else {
			$cmd = "`which domainname`";
		}
		if (false !== ($dest___ = \exec($cmd))) {
			if (memlen($dest___) < 1) {
				if (false !== ($dest___ = \gethostname())) {
					return 0;
				}
				$dest___ = null;
				seterrno(EFAULT);
				return -1;
			}
			return 0;
		}
		$dest___ = null;
		seterrno(EFAULT);
		return -1;
	}

	function usleep(int $usecs___)
	{
		if (true !== \time_nanosleep(0, $usecs___ * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function unlink(string $fname___)
	{
		if (true !== \unlink($fname___)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function readlink(string $fpath___, string &$dest___, int $destsz___ = -1)
	{
		if (\is_link($fpath___ )) {
			if (false !== ($dest___ = \readlink($fpath___))) {
				return memlen($dest___);
			}
			seterrno(EIO);
		} else {
			seterrno(EINVAL);
		}
		$dest___ = null;
		return -1;
	}

	function link(string $path___, string $link___)
	{
		if (\link($path___, $link___)) {
			return 0;
		}
		seterrno(EFAULT);
		return -1;
	}

	function symlink(string $path___, string $link___)
	{
		if (\symlink($path___, $link___)) {
			return 0;
		}
		seterrno(EFAULT);
		return -1;
	}

	function fftruncate($fp___, int $len___)
	{
		if (\is_resource($fp___)) {
			if (false !== ($off = \ftell($fp___))) {
				if (true !== \ftruncate($fp___, $len___)) {
					seterrno(EACCES);
					\fseek($fp___, $off, \SEEK_CUR);
					return -1;
				}
				\fseek($fp___, $off, \SEEK_CUR);
			} else {
				seterrno(EFAULT);
				return -1;
			}
		} else {
			seterrno(EBADF);
			return -1;
		}
		return 0;
	}

	function ffsync($fp___)
	{
		if (\fflush($fp___)) {
			return 0;
		}
		seterrno(EINVAL);
		return -1;
	}

	function sync()
	{
		\fflush(\STDOUT);
		\fflush(\STDERR);
		\fflush(\STDIN);
	}

	function truncate(string $fpath___, int $len___)
	{
		if (false !== ($fp = \fopen($fpath___, 'r+'))) {
			if (true !== \ftruncate($fp___, $len___)) {
				seterrno(EACCES);
				\fclose($fp);
				return -1;
			}
			\fclose($fp);
			return 0;
		}
		seterrno(EINVAL);
		return -1;
	}

	function getpid()
	{
		if (\function_exists('\posix_getpid')) {
			return posix_getpid();
		} else {
			return \getmypid();
		}
		return -1;
	}

	function getppid()
	{
		if (\function_exists('\posix_getppid')) {
			return posix_getppid();
		} else if (_F_os_windows()) {
			return \intval(\exec("`wmic.exe process where (processid=" . \getmypid() . ") get parentprocessid"));
		} else {
			return \intval(\exec("`which ps` -o ppid= " . \getmypid() . " | xargs"));
		}
		return -1;
	}
} /* EONS */

/* EOF */