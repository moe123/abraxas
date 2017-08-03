<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_system_error.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_api_errno.php";
} /* EONS */

namespace std
{
	abstract class errc
	{
		const address_family_not_supported        = EAFNOSUPPORT;
		const address_in_use                      = EADDRINUSE;
		const address_not_available               = EADDRNOTAVAIL;
		const already_connected                   = EISCONN;
		const argument_list_too_long              = E2BIG;
		const argument_out_of_domain              = EDOM;
		const bad_address                         = EFAULT;
		const bad_file_descriptor                 = EBADF;
		const bad_message                         = EBADMSG;
		const broken_pipe                         = EPIPE;
		const connection_failure_aborted          = ECONNABORTED;
		const connection_already_in_progress      = EALREADY;
		const connection_refused                  = ECONNREFUSED;
		const connection_reset                    = ECONNRESET;
		const cross_device_link                   = EXDEV;
		const destination_address_required        = EDESTADDRREQ;
		const device_or_resource_busy             = EBUSY;
		const directory_not_empty                 = ENOTEMPTY;
		const executable_format_error             = ENOEXEC;
		const file_already_exists                 = EEXIST;
		const file_too_large                      = EFBIG;
		const filename_too_long                   = ENAMETOOLONG;
		const function_not_supported              = ENOSYS;
		const host_unreachable                    = EHOSTUNREACH;
		const identifier_removed                  = EIDRM;
		const illegal_byte_sequence               = EILSEQ;
		const inappropriate_io_control_operation  = ENOTTY;
		const interrupted                         = EINTR;
		const invalid_argument                    = EINVAL;
		const invalid_seek                        = ESPIPE;
		const io_error                            = EIO;
		const is_a_directory                      = EISDIR;
		const message_size                        = EMSGSIZE;
		const network_down                        = ENETDOWN;
		const network_reset                       = ENETRESET;
		const network_unreachable                 = ENETUNREACH;
		const no_buffer_space                     = ENOBUFS;
		const no_child_process                    = ECHILD;
		const no_link                             = ENOLINK;
		const no_lock_available                   = ENOLCK;
		const no_message_available                = ENODATA;
		const no_message                          = ENOMSG;
		const no_protocol_option                  = ENOPROTOOPT;
		const no_space_on_device                  = ENOSPC;
		const no_stream_resources                 = ENOSR;
		const no_such_device_or_address           = ENXIO;
		const no_such_device                      = ENODEV;
		const no_such_file_or_directory           = ENOENT;
		const no_such_process                     = ESRCH;
		const not_a_directory                     = ENOTDIR;
		const not_a_socket                        = ENOTSOCK;
		const not_a_stream                        = ENOSTR;
		const not_connected                       = ENOTCONN;
		const not_enough_memory                   = ENOMEM;
		const not_supported                       = ENOTSUP;
		const operation_canceled                  = ECANCELED;
		const operation_in_progress               = EINPROGRESS;
		const operation_not_permitted             = EPERM;
		const operation_not_supported             = EOPNOTSUPP;
		const operation_would_block               = EWOULDBLOCK;
		const owner_dead                          = EOWNERDEAD;
		const permission_denied                   = EACCES;
		const protocol_error                      = EPROTO;
		const protocol_not_supported              = EPROTONOSUPPORT;
		const read_only_file_system               = EROFS;
		const resource_deadlock_would_occur       = EDEADLK;
		const resource_unavailable_try_again      = EAGAIN;
		const result_out_of_range                 = ERANGE;
		const state_not_recoverable               = ENOTRECOVERABLE;
		const stream_timeout                      = ETIME;
		const text_file_busy                      = ETXTBSY;
		const timed_out                           = ETIMEDOUT;
		const too_many_files_open_in_system       = ENFILE;
		const too_many_files_open                 = EMFILE;
		const too_many_links                      = EMLINK;
		const too_many_symbolic_link_levels       = ELOOP;
		const value_too_large                     = EOVERFLOW;
		const wrong_protocol_type                 = EPROTOTYPE;
	} /* EOC */
} /* EONS */

/* EOF */