<?php
# -*- coding: utf-8 -*-

//
// xerrno.php
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
	define('std\NOERR',             0); /* No error set */
	define('std\EPERM',             1); /* Operation not permitted */
	define('std\ENOENT',            2); /* No such file or directory */
	define('std\ESRCH',             3); /* No such process */
	define('std\EINTR',             4); /* Interrupted system call */
	define('std\EIO',               5); /* Input/output error */
	define('std\ENXIO',             6); /* Device not configured */
	define('std\E2BIG',             7); /* Argument list too long */
	define('std\ENOEXEC',           8); /* Exec format error */
	define('std\EBADF',             9); /* Bad file descriptor */
	define('std\ECHILD',           10); /* No child processes */
	define('std\EDEADLK',          11); /* Resource deadlock avoided */
	define('std\ENOMEM',           12); /* Cannot allocate memory */
	define('std\EACCES',           13); /* Permission denied */
	define('std\EFAULT',           14); /* Bad address */
	define('std\ENOTBLK',          15); /* Block device required */
	define('std\EBUSY',            16); /* Device / Resource busy */
	define('std\EEXIST',           17); /* File exists */
	define('std\EXDEV',            18); /* Cross-device link */
	define('std\ENODEV',           19); /* Operation not supported by device */
	define('std\ENOTDIR',          20); /* Not a directory */
	define('std\EISDIR',           21); /* Is a directory */
	define('std\EINVAL',           22); /* Invalid argument */
	define('std\ENFILE',           23); /* Too many open files in system */
	define('std\EMFILE',           24); /* Too many open files */
	define('std\ENOTTY',           25); /* Inappropriate ioctl for device */
	define('std\ETXTBSY',          26); /* Text file busy */
	define('std\EFBIG',            27); /* File too large */
	define('std\ENOSPC',           28); /* No space left on device */
	define('std\ESPIPE',           29); /* Illegal seek */
	define('std\EROFS',            30); /* Read-only file system */
	define('std\EMLINK',           31); /* Too many links */
	define('std\EPIPE',            32); /* Broken pipe */

	/* math software */
	define('std\EDOM',             33); /* Numerical argument out of domain */
	define('std\ERANGE',           34); /* Result too large */

	/* non-blocking and interrupt i/o */
	define('std\EAGAIN',           35); /* Resource temporarily unavailable */
	define('std\EWOULDBLOCK',      35); /* Operation would block */
	define('std\EINPROGRESS',      36); /* Operation now in progress */
	define('std\EALREADY',         37); /* Operation already in progress */

	/* ipc/network software -- argument errors */
	define('std\ENOTSOCK',         38); /* Socket operation on non-socket */
	define('std\EDESTADDRREQ',     39); /* Destination address required */
	define('std\EMSGSIZE',         40); /* Message too long */
	define('std\EPROTOTYPE',       41); /* Protocol wrong type for socket */
	define('std\ENOPROTOOPT',      42); /* Protocol not available */
	define('std\EPROTONOSUPPORT',  43); /* Protocol not supported */
	define('std\ESOCKTNOSUPPORT',  44); /* Socket type not supported */
	define('std\ENOTSUP',          45); /* Operation not supported */
	define('std\EPFNOSUPPORT',     46); /* Protocol family not supported */
	define('std\EAFNOSUPPORT',     47); /* Address family not supported by protocol family */
	define('std\EADDRINUSE',       48); /* Address already in use */
	define('std\EADDRNOTAVAIL',    49); /* Can't assign requested address */

	/* ipc/network software -- operational errors */
	define('std\ENETDOWN',         50); /* Network is down */
	define('std\ENETUNREACH',      51); /* Network is unreachable */
	define('std\ENETRESET',        52); /* Network dropped connection on reset */
	define('std\ECONNABORTED',     53); /* Software caused connection abort */
	define('std\ECONNRESET',       54); /* Connection reset by peer */
	define('std\ENOBUFS',          55); /* No buffer space available */
	define('std\EISCONN',          56); /* Socket is already connected */
	define('std\ENOTCONN',         57); /* Socket is not connected */
	define('std\ESHUTDOWN',        58); /* Can't send after socket shutdown */
	define('std\ETOOMANYREFS',     59); /* Too many references: can't splice */
	define('std\ETIMEDOUT',        60); /* Operation timed out */
	define('std\ECONNREFUSED',     61); /* Connection refused */
	define('std\ELOOP',            62); /* Too many levels of symbolic links */
	define('std\ENAMETOOLONG',     63); /* File name too long */
	define('std\EHOSTDOWN',        64); /* Host is down */
	define('std\EHOSTUNREACH',     65); /* No route to host */
	define('std\ENOTEMPTY',        66); /* Directory not empty */

	/*! Quotas & mush */
	define('std\EPROCLIM',         67); /* Too many processes */
	define('std\EUSERS',           68); /* Too many users */
	define('std\EDQUOT',           69); /* Disc quota exceeded */

	/*! Network File System */
	define('std\ESTALE',           70); /* Stale NFS file handle */
	define('std\EREMOTE',          71); /* Too many levels of remote in path */
	define('std\EBADRPC',          72); /* RPC struct is bad */
	define('std\ERPCMISMATCH',     73); /* RPC version wrong */
	define('std\EPROGUNAVAIL',     74); /* RPC prog. not avail */
	define('std\EPROGMISMATCH',    75); /* Program version wrong */
	define('std\EPROCUNAVAIL',     76); /* Bad procedure for program */
	define('std\ENOLCK',           77); /* No locks available */
	define('std\ENOSYS',           78); /* Function not implemented */
	define('std\EFTYPE',           79); /* Inappropriate file type or format */
	define('std\EAUTH',            80); /* Authentication error */
	define('std\ENEEDAUTH',        81); /* Need authenticator */

	/*! Intelligent device errors */
	define('std\EPWROFF',          82); /* Device power is off */
	define('std\EDEVERR',          83); /* Device error, e.g. paper out */
	define('std\EOVERFLOW',        84); /* Value too large to be stored in data type */

	/*! Program loading errors */
	define('std\EBADEXEC',         85); /* Bad executable */
	define('std\EBADARCH',         86); /* Bad CPU type in executable */
	define('std\ESHLIBVERS',       87); /* Shared library version mismatch */
	define('std\EBADMACHO',        88); /* Malformed Macho file */
	define('std\ECANCELED',        89); /* Operation canceled */
	define('std\EIDRM',            90); /* Identifier removed */
	define('std\ENOMSG',           91); /* No message of desired type */ 
	define('std\EILSEQ',           92); /* Illegal byte sequence */
	define('std\ENOATTR',          93); /* Attribute not found */
	define('std\EBADMSG',          94); /* Bad message */
	define('std\EMULTIHOP',        95); /* Reserved */
	define('std\ENODATA',          96); /* No message available on STREAM */
	define('std\ENOLINK',          97); /* Reserved */
	define('std\ENOSR',            98); /* No STREAM resources */
	define('std\ENOSTR',           99); /* Not a STREAM */
	define('std\EPROTO',          100); /* Protocol error */
	define('std\ETIME',           101); /* STREAM ioctl timeout */
	define('std\EOPNOTSUPP',      102); /* Operation not supported on socket */
	define('std\ENOPOLICY',       103); /* No such policy registered */
	define('std\ENOTRECOVERABLE', 104);  /* State not recoverable */
	define('std\EOWNERDEAD',      105); /* Previous owner died */
	define('std\EQFULL',          106); /* Interface output queue is full */
	define('std\ELAST',           106); /* Must be equal largest errno */
	
	$GLOBALS["^std@_g_errno"] = 0;
	$GLOBALS["^std@_g_strerror"] = [];

	$GLOBALS["^std@_g_strerror"][NOERR]           = "";
	$GLOBALS["^std@_g_strerror"][EPERM]           = "Operation not permitted";
	$GLOBALS["^std@_g_strerror"][ENOENT]          = "No such file or directory";
	$GLOBALS["^std@_g_strerror"][ESRCH]           = "No such process";
	$GLOBALS["^std@_g_strerror"][EINTR]           = "Interrupted system call";
	$GLOBALS["^std@_g_strerror"][EIO]             = "Input/output error";
	$GLOBALS["^std@_g_strerror"][ENXIO]           = "Device not configured";
	$GLOBALS["^std@_g_strerror"][E2BIG]           = "Argument list too long";
	$GLOBALS["^std@_g_strerror"][ENOEXEC]         = "Exec format error";
	$GLOBALS["^std@_g_strerror"][EBADF]           = "Bad file descriptor";
	$GLOBALS["^std@_g_strerror"][ECHILD]          = "No child processes";
	$GLOBALS["^std@_g_strerror"][EDEADLK]         = "Resource deadlock avoided";
	$GLOBALS["^std@_g_strerror"][ENOMEM]          = "Cannot allocate memory";
	$GLOBALS["^std@_g_strerror"][EACCES]          = "Permission denied";
	$GLOBALS["^std@_g_strerror"][EFAULT]          = "Bad address";
	$GLOBALS["^std@_g_strerror"][ENOTBLK]         = "Block device required";
	$GLOBALS["^std@_g_strerror"][EBUSY]           = "Device / Resource busy";
	$GLOBALS["^std@_g_strerror"][EEXIST]          = "File exists";
	$GLOBALS["^std@_g_strerror"][EXDEV]           = "Cross-device link";
	$GLOBALS["^std@_g_strerror"][ENODEV]          = "Operation not supported by device";
	$GLOBALS["^std@_g_strerror"][ENOTDIR]         = "Not a directory";
	$GLOBALS["^std@_g_strerror"][EISDIR]          = "Is a directory";
	$GLOBALS["^std@_g_strerror"][EINVAL]          = "Invalid argument";
	$GLOBALS["^std@_g_strerror"][ENFILE]          = "Too many open files in system";
	$GLOBALS["^std@_g_strerror"][EMFILE]          = "Too many open files";
	$GLOBALS["^std@_g_strerror"][ENOTTY]          = "Inappropriate ioctl for device";
	$GLOBALS["^std@_g_strerror"][ETXTBSY]         = "Text file busy";
	$GLOBALS["^std@_g_strerror"][EFBIG]           = "File too large";
	$GLOBALS["^std@_g_strerror"][ENOSPC]          = "No space left on device";
	$GLOBALS["^std@_g_strerror"][ESPIPE]          = "Illegal seek";
	$GLOBALS["^std@_g_strerror"][EROFS]           = "Read-only file system";
	$GLOBALS["^std@_g_strerror"][EMLINK]          = "Too many links";
	$GLOBALS["^std@_g_strerror"][EPIPE]           = "Broken pipe";

	/* math software */
	$GLOBALS["^std@_g_strerror"][EDOM]            = "Numerical argument out of domain";
	$GLOBALS["^std@_g_strerror"][ERANGE]          = "Result too large";

	/* non-blocking and interrupt i/o */
	$GLOBALS["^std@_g_strerror"][EAGAIN]          = "Resource temporarily unavailable";
	$GLOBALS["^std@_g_strerror"][EWOULDBLOCK]     = "Operation would block";
	$GLOBALS["^std@_g_strerror"][EINPROGRESS]     = "Operation now in progress";
	$GLOBALS["^std@_g_strerror"][EALREADY]        = "Operation already in progress";

	/* ipc/network software -- argument errors */
	$GLOBALS["^std@_g_strerror"][ENOTSOCK]        = "Socket operation on non-socket";
	$GLOBALS["^std@_g_strerror"][EDESTADDRREQ]    = "Destination address required";
	$GLOBALS["^std@_g_strerror"][EMSGSIZE]        = "Message too long";
	$GLOBALS["^std@_g_strerror"][EPROTOTYPE]      = "Protocol wrong type for socket";
	$GLOBALS["^std@_g_strerror"][ENOPROTOOPT]     = "Protocol not available";
	$GLOBALS["^std@_g_strerror"][EPROTONOSUPPORT] = "Protocol not supported";
	$GLOBALS["^std@_g_strerror"][ESOCKTNOSUPPORT] = "Socket type not supported";
	$GLOBALS["^std@_g_strerror"][ENOTSUP]         = "Operation not supported";
	$GLOBALS["^std@_g_strerror"][EOPNOTSUPP]      = "Operation not supported on socket";
	$GLOBALS["^std@_g_strerror"][EPFNOSUPPORT]    = "Protocol family not supported";
	$GLOBALS["^std@_g_strerror"][EAFNOSUPPORT]    = "Address family not supported by protocol family";
	$GLOBALS["^std@_g_strerror"][EADDRINUSE]      = "Address already in use";
	$GLOBALS["^std@_g_strerror"][EADDRNOTAVAIL]   = "Can't assign requested address";

	/* ipc/network software -- operational errors */
	$GLOBALS["^std@_g_strerror"][ENETDOWN]        = "Network is down";
	$GLOBALS["^std@_g_strerror"][ENETUNREACH]     = "Network is unreachable";
	$GLOBALS["^std@_g_strerror"][ENETRESET]       = "Network dropped connection on reset";
	$GLOBALS["^std@_g_strerror"][ECONNABORTED]    = "Software caused connection abort";
	$GLOBALS["^std@_g_strerror"][ECONNRESET]      = "Connection reset by peer";
	$GLOBALS["^std@_g_strerror"][ENOBUFS]         = "No buffer space available";
	$GLOBALS["^std@_g_strerror"][EISCONN]         = "Socket is already connected";
	$GLOBALS["^std@_g_strerror"][ENOTCONN]        = "Socket is not connected";
	$GLOBALS["^std@_g_strerror"][ESHUTDOWN]       = "Can't send after socket shutdown";
	$GLOBALS["^std@_g_strerror"][ETOOMANYREFS]    = "Too many references: can't splice";
	$GLOBALS["^std@_g_strerror"][ETIMEDOUT]       = "Operation timed out";
	$GLOBALS["^std@_g_strerror"][ECONNREFUSED]    = "Connection refused";
	$GLOBALS["^std@_g_strerror"][ELOOP]           = "Too many levels of symbolic links";
	$GLOBALS["^std@_g_strerror"][ENAMETOOLONG]    = "File name too long";
	$GLOBALS["^std@_g_strerror"][EHOSTDOWN]       = "Host is down";
	$GLOBALS["^std@_g_strerror"][EHOSTUNREACH]    = "No route to host";
	$GLOBALS["^std@_g_strerror"][ENOTEMPTY]       = "Directory not empty";

	/* quotas & mush */
	$GLOBALS["^std@_g_strerror"][EPROCLIM]        = "Too many processes";
	$GLOBALS["^std@_g_strerror"][EUSERS]          = "Too many users";
	$GLOBALS["^std@_g_strerror"][EDQUOT]          = "Disc quota exceeded";

	/* Network File System */
	$GLOBALS["^std@_g_strerror"][ESTALE]          = "Stale NFS file handle";
	$GLOBALS["^std@_g_strerror"][EREMOTE]         = "Too many levels of remote in path";
	$GLOBALS["^std@_g_strerror"][EBADRPC]         = "RPC struct is bad";
	$GLOBALS["^std@_g_strerror"][ERPCMISMATCH]    = "RPC version wrong";
	$GLOBALS["^std@_g_strerror"][EPROGUNAVAIL]    = "RPC prog. not avail";
	$GLOBALS["^std@_g_strerror"][EPROGMISMATCH]   = "Program version wrong";
	$GLOBALS["^std@_g_strerror"][EPROCUNAVAIL]    = "Bad procedure for program";

	$GLOBALS["^std@_g_strerror"][ENOLCK]          = "No locks available";
	$GLOBALS["^std@_g_strerror"][ENOSYS]          = "Function not implemented";

	$GLOBALS["^std@_g_strerror"][EFTYPE]          = "Inappropriate file type or format";
	$GLOBALS["^std@_g_strerror"][EAUTH]           = "Authentication error";
	$GLOBALS["^std@_g_strerror"][ENEEDAUTH]       = "Need authenticator";

	/* Intelligent device errors */
	$GLOBALS["^std@_g_strerror"][EPWROFF]         = "Device power is off";
	$GLOBALS["^std@_g_strerror"][EDEVERR]         = "Device error, e.g. paper out";
	$GLOBALS["^std@_g_strerror"][EOVERFLOW]       = "Value too large to be stored in data type";

	/* Program loading errors */
	$GLOBALS["^std@_g_strerror"][EBADEXEC]        = "Bad executable";
	$GLOBALS["^std@_g_strerror"][EBADARCH]        = "Bad CPU type in executable";
	$GLOBALS["^std@_g_strerror"][ESHLIBVERS]      = "Shared library version mismatch";
	$GLOBALS["^std@_g_strerror"][EBADMACHO]       = "Malformed Macho file";
	$GLOBALS["^std@_g_strerror"][ECANCELED]       = "Operation canceled";
	$GLOBALS["^std@_g_strerror"][EIDRM]           = "Identifier removed";
	$GLOBALS["^std@_g_strerror"][ENOMSG]          = "No message of desired type"; 
	$GLOBALS["^std@_g_strerror"][EILSEQ]          = "Illegal byte sequence";
	$GLOBALS["^std@_g_strerror"][ENOATTR]         = "Attribute not found";
	$GLOBALS["^std@_g_strerror"][EBADMSG]         = "Bad message";
	$GLOBALS["^std@_g_strerror"][EMULTIHOP]       = "Reserved";
	$GLOBALS["^std@_g_strerror"][ENODATA]         = "No message available on STREAM";
	$GLOBALS["^std@_g_strerror"][ENOLINK]         = "Reserved";
	$GLOBALS["^std@_g_strerror"][ENOSR]           = "No STREAM resources";
	$GLOBALS["^std@_g_strerror"][ENOSTR]          = "Not a STREAM";
	$GLOBALS["^std@_g_strerror"][EPROTO]          = "Protocol error";
	$GLOBALS["^std@_g_strerror"][ETIME]           = "STREAM ioctl timeout";
	$GLOBALS["^std@_g_strerror"][EOPNOTSUPP]      = "Operation not supported on socket";
	$GLOBALS["^std@_g_strerror"][ENOPOLICY]       = "No such policy registered";
	$GLOBALS["^std@_g_strerror"][ENOTRECOVERABLE] = "State not recoverable";
	$GLOBALS["^std@_g_strerror"][EOWNERDEAD]      = "Previous owner died";
	$GLOBALS["^std@_g_strerror"][EQFULL]          = "Interface output queue is full";
	$GLOBALS["^std@_g_strerror"][ELAST]           = "Must be equal largest errno";

	$GLOBALS["^std@_g_errno"] = NOERR;

	function seterrno(int $errno___)
	{ $GLOBALS["^std@_g_errno"] = $errno___; }

	function & errno()
	{ return $GLOBALS["^std@_g_errno"]; }
} /* EONS */

/* EOF */