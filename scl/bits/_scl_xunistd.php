<?php
# -*- coding: utf-8 -*-

//
// _scl_xunistd.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xerrno.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xsignal.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xstring.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xstdio.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xtime.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xstdlib.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xlocale.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "_scl_xutsname.php";
} /* EONS */

namespace std
{
	function xexit(int $status = 0)
	{ exit($status); }

	function xmillisleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___ * 1000 * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function xmicrosleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___ * 1000)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
	}

	function xnanosleep(int $n___)
	{
		if (true !== \time_nanosleep(0, $n___)) {
			seterrno(EINTR);
			return -1;
		}
		return 0;
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
		if (\strtoupper(\substr(\PHP_OS, 0, 3)) == "WIN") {
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

	function ffsynk($fp___)
	{
		if (\fflush($fp___)) {
			return 0;
		}
		seterrno(EINVAL);
		return -1;
	}

	function synk()
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