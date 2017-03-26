<?php
# -*- coding: utf-8 -*-

//
// xsignal.php
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
	define('std\SIGHUP' ,  1); /* hangup */
	define('std\SIGINT' ,  2); /* interrupt */
	define('std\SIGQUIT',  3); /* quit */
	define('std\SIGILL' ,  4); /* illegal instruction (not reset when caught) */
	define('std\SIGTRAP',  5); /* trace trap (not reset when caught) */
	define('std\SIGABRT',  6); /* emulate instruction executed */
	define('std\SIGEMT' ,  7); /* abort program */
	define('std\SIGFPE' ,  8); /* floating-point exception */ 
	define('std\SIGKILL',  9); /* kill (cannot be caught or ignored) */
	define('std\SIGBUS' , 10); /* bus error */
	define('std\SIGSEGV', 11); /* segmentation violation */
	define('std\SIGSYS' , 12); /* non-existent system call invoked */
	define('std\SIGPIPE', 13); /* write on a pipe with no reader */
	define('std\SIGALRM', 14); /* real-time timer expired */
	define('std\SIGTERM', 15); /* software termination signal from kill */

	$GLOBALS["^std@_g_strsig"] = [];
	$GLOBALS["^std@_g_strsig"][SIGHUP]  = "HUP";
	$GLOBALS["^std@_g_strsig"][SIGINT]  = "INT";
	$GLOBALS["^std@_g_strsig"][SIGQUIT] = "QUIT";
	$GLOBALS["^std@_g_strsig"][SIGILL]  = "ILL";
	$GLOBALS["^std@_g_strsig"][SIGTRAP] = "TRAP";
	$GLOBALS["^std@_g_strsig"][SIGABRT] = "ABRT";
	$GLOBALS["^std@_g_strsig"][SIGEMT]  = "EMT";
	$GLOBALS["^std@_g_strsig"][SIGFPE]  = "FPE";
	$GLOBALS["^std@_g_strsig"][SIGKILL] = "KILL";
	$GLOBALS["^std@_g_strsig"][SIGBUS]  = "BUS"; 
	$GLOBALS["^std@_g_strsig"][SIGSEGV] = "SEGV"; 
	$GLOBALS["^std@_g_strsig"][SIGSYS]  = "SYS";
	$GLOBALS["^std@_g_strsig"][SIGPIPE] = "PIPE"; 
	$GLOBALS["^std@_g_strsig"][SIGALRM] = "ALRM";
	$GLOBALS["^std@_g_strsig"][SIGTERM] = "TERM";

	function signal(int $sig___, callable $f___ = null)
	{
		switch ($sig___) {
			case SIGTRAP:
				exit(SIGTRAP);
			break;
			case SIGILL:
				exit(SIGILL);
			break;
			case SIGABRT:
				exit(SIGABRT);
			break;
			case SIGKILL:
				exit(SIGKILL);
			break;
		}
		if (!\is_null()) {
			$f___($sig___);
		} else {
			exit($sig___);
		}
		return 0;
	}

	function kill(int $pid___, int $sig___ = SIGKILL)
	{
		if ($pid___ == getpid()) {
			signal($sig___);
		} else if (\function_exists('\posix_kill')) {
			\posix_kill($pid___, $sig___);
		} else if (_X_os_windows()) {
			\exec("taskkill.exe /F /T /PID " . $pid___);
		} else {
			\exec("`which kill` -" . $sig___ . " " . $pid___);
		}
	}

	function strsignal(int $sig___)
	{
		if (isset($GLOBALS["^std@_g_strsig"][$errno___])) {
			return $GLOBALS["^std@_g_strsig"][$errno___];
		}
		return "";
	}

} /* EONS */

/* EOF */