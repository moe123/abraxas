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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_stdio.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_stdlib.php";
} /* EONS */

namespace std
{
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