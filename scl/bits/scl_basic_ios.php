<?php
# -*- coding: utf-8 -*-

//
// scl_basic_ios.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_string_base.php";
} /* EONS */

namespace std
{
	const stdin  = \STDIN;
	const stdout = \STDOUT;
	const stderr = \STDERR;

	const seek_set     = \SEEK_SET;
	const seek_end     = \SEEK_END;
	const seek_cur     = \SEEK_CUR;

	function fopen(string $f___ , string $m___)
	{ return (($fp = \fopen($f___, $m___)) !== false) ? $fp : null; }

	function fclose($h___)
	{ return \fclose($h___) === true ? 0 : -1; }

	function fflush($h___)
	{ return \fflush($h___) === true ? 0 : -1; }

	function fseek($h___, int $offset___, int $orig___)
	{ return \fseek($h___, $offset___, $orig___); }

	function fwrite($in___, int $siz___, int $cnt___, $h___)
	{
		$n = 0;
		if ($n = \fwrite($h___, $in___, $siz___ * $cnt___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fputs($in___, $h___)
	{
		$n = 0;
		if ($n = \fwrite($h___, $in___) === false) {
			$n = -1;
		}
		return $n;
	}

	function puts($in___)
	{
		$n = 0;
		if ($n = \fwrite(\STDOUT, $in___) === false) {
			$n = -1;
		}
		return $n;
	}

	function fread(&$buf___, int $siz___, int $cnt___, $h___)
	{
		$n = 0;
		if ($buf___ = \fread($h___, $siz___ * $cnt___) === false) {
			$buf___ = null;
			$n = -1;
		} else {
			$n = \std\memlen($buf___);
		}
		return $n;
	}

	function & fgets(&$buf___, int $n___, $h___)
	{
		if ($buf___ = \fgets($h___, $n___) === false) {
			$buf___ = null;
		}
		return $buf___;
	}

	function fgetc($h___)
	{ return \ord(\fgetc($h___)); }

	function ftell($h___)
	{ return \ftell($h___); }

	function feof($h___)
	{ return \feof($h___) === true ? 1 : 0;}

	function fputc(int $ch___, $h___)
	{ return (\fwrite($h___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function stdcin(&$buf___)
	{ return (($buf___ = \fgets(\STDIN)) !== false) ? true : false; }

	function stdcout($in___)
	{ return (($n = \fwrite(\STDOUT, $in___)) !== false) ? $n : -1; }

	function stdcerr($in___)
	{ return (($n = \fwrite(\STDERR, $in___)) !== false) ? $n : -1; }

	function stdcout_fmt($in___, ...$args___)
	{ return (($n = \fwrite(\STDOUT, \vsprintf($in___, $args___))) !== false) ? $n : -1; }

	function stdcerr_fmt($in___, ...$args___)
	{ return (($n = \fwrite(\STDERR, \vsprintf($in___, $args___))) !== false) ? $n : -1; }

	function putc(int $ch___, $h___)
	{ return (\fwrite($h___, \chr($ch___)) !== false) ? $ch___ : -1; }

	function putchar(int $ch___)
	{ return (\fwrite(\STDOUT, \chr($ch___)) !== false) ? $ch___ : -1; }

	function println(string $fmt___, ...$args___)
	{ return \vfprintf(\STDOUT, $fmt___ . \PHP_EOL, $args___); }

	function fprintln($h___, string $fmt___, ...$args___)
	{ return \vfprintf($h___, $fmt___ . \PHP_EOL, $args___); }

	function printf($h___, string $fmt___, ...$args___)
	{ return \vfprintf(\STDOUT, $fmt___, $args___); }

	function fprintf($h___, string $fmt___, ...$args___)
	{ return \vfprintf($h___, $fmt___, $args___); }

	function vfprint($h___, string $fmt___, $args___)
	{ return \vfprintf($h___, $fmt___, $args___); }

	function vfprintf($h___, string $fmt___, $args___)
	{ return \vfprintf($h___, $fmt___, $args___); }

	function vfprintln($h___, string $fmt___, $args___)
	{ return \vfprintf($h___, $fmt___ . \PHP_EOL, $args___); }

	const endl  = char_utils::eol;

	abstract class ios_base
	{
		/* seekdir */
		const beg     = \SEEK_SET;
		const end     = \SEEK_END;
		const cur     = \SEEK_CUR;

		/* openmode */
		const app     = 1 << 0;
		const binary  = 1 << 1;
		const bin     = 1 << 1;
		const in      = 1 << 2;
		const out     = 1 << 3;
		const trunc   = 1 << 4;
		const ate     = 1 << 5;

		/* iostate */
		const goodbit = 0;
		const badbit  = 1 << 0;
		const failbit = 1 << 1;
		const eofbit  = 1 << 2;
	} /* EOC */

	abstract class basic_ios
	{
		var $_M_locale = null;
		var $_M_sstate = ios_base::goodbit;

		function imbue(locale &$locale___)
		{ $this->_M_locale = $locale___; }

		function getloc()
		{ return $this->_M_locale; }

		function good()
		{ return $this->_M_sstate === 0; }

		function eof()
		{ return ($this->_M_sstate & ios_base::eofbit) !== 0; }

		function fail()
		{ return ($this->_M_sstate & (ios_base::badbit|ios_base::failbit)) !== 0; }

		function bad()
		{ return ($this->_M_sstate & ios_base::badbit) !== 0; }

		function rdstate()
		{ return $this->_M_sstate; }

		function setstate(int $state___)
		{ $this->clear($this->_M_sstate| $state___); }

		function clear(int $state___ = ios_base::goodbit)
		{ $this->_M_sstate = $state___; }
	} /* EOC */

	abstract class basic_istream extends basic_ios
	{
		var $_M_handle_g;
		var $_M_count_g = 0;

		function __invoke(&$d___, int $c___ = -1)
		{
			$this->read($d___, $c___);
			return $this;
		}

		function & read(&$d___, int $c___)
		{
			if ($c___ > 0) {
				$d___ = \fread($this->_M_handle_g, $d___, $c___);
			} else {
				$d___ = \fread($this->_M_handle_g, $d___);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
			} else {
				$this->_M_count_g = memlen($d___);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function & get(&$d___, int $c___)
		{
			if ($c___ > 0) {
				$d___ = \fgets($this->_M_handle_g, $c___);
			} else {
				$d___ = \fgets($this->_M_handle_g);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
			} else {
				$this->_M_count_g = memlen($d___);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function & getline(&$d___, int $c___, string $delim___ = null)
		{
			if (isset($delim___)) {
				$d___ = \stream_get_line($this->_M_handle_g, $c___, $delim___);
			} else {
				$d___ = \stream_get_line($this->_M_handle_g, $c___);
			}
			
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
			} else {
				$this->_M_count_g = memlen($d___);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function tellg()
		{
			$r = \ftell($this->_M_handle_g);
			if ($r === false) {
				$r = -1;
			}
			return $r;
		}

		function gcount()
		{ return $this->_M_count_g; }
	} /* EOC */

	abstract class basic_ostream extends basic_ios
	{
		var $_M_handle_p;
		var $_M_count_p = 0;

		function __invoke($d___, int $c___ = -1)
		{
			$this->write($d___, $c___);
			return $this;
		}

		function & write($d___, int $c___)
		{
			$r = false;
			if ($c___ > 0) {
				$r = \fwrite($this->_M_handle_p, $d___, $c___);
			} else {
				$r = \fwrite($this->_M_handle_p, $d___);
			}
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
			} else {
				$this->_M_count_p = memlen($r);
			}
			return $this;
		}
		
		function & flush()
		{
			if (\fflush($this->_M_handle_p) === false) {
				$this->setstate(ios_base::badbit);
				$this->_M_count_p = 0;
			}
			return $this;
		}

		function tellp()
		{
			$r = \ftell($this->_M_handle_p);
			if ($r === false) {
				$r = -1;
			}
			return $r;
		}
		
		function pcount()
		{ return $this->_M_count_p ; }
	} /* EOC */

	class _C_ostream_cin extends basic_istream
	{
		function __invoke(&$d___, int $c___ = -1)
		{ return $this->get($d___, $c___); }

		function __construct()
		{ $this->_M_handle_g = \STDIN; }
	} /* EOC */

	class _C_ostream_cout extends basic_ostream
	{
		function __construct()
		{ $this->_M_handle_p = \STDOUT; }
	} /* EOC */

	class _C_ostream_cerr extends basic_ostream
	{
		function __construct()
		{ $this->_M_handle_p = \STDERR; }
	} /* EOC */

	function & cin(&$d___)
	{
		static $is = null;
		if (\is_null($is)) {
			$is = new _C_ostream_cin;
		}
		$is = $is($d___);
		return $is;
	}

	function & cout($d___)
	{
		static $os = null;
		if (\is_null($os)) {
			$os = new _C_ostream_cout;
		}
		$os = $os($d___);
		return $os;
	}

	function & cerr($d___)
	{
		static $os = null;
		if (\is_null($s)) {
			$os = new _C_ostream_cerr;
		}
		$os = $os($d___);
		return $os;
	}
} /* EONS */

/* EOF */