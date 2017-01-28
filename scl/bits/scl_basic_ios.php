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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_errno.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_stdio.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_base_stdlib.php";
} /* EONS */

namespace std
{
	const endl       = char_utils::eol;
	const space      = char_utils::sp;
	const tab        = char_utils::ht;
	const tabulation = char_utils::ht;

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

		/* fmtflags */
		const nomask      = 0;
		const alpha       = 1 << 1;
		const dec         = 1 << 4;
		const hex         = 1 << 6;
		const oct         = 1 << 7;
		const fixed       = 1 << 8;
		const scientific  = 1 << 9;
	} /* EOC */

	abstract class basic_ios
	{
		var $_M_locale = null;
		var $_M_sstate = ios_base::goodbit;
		var $_M_fmtflags = ios_base::nomask;

		function & _F_put(&$v___) 
		{
			if ($this->_M_fmtflags != ios_base::nomask && (\is_float($v___) || \is_integer($v___) || \is_bool($v___))) {
				if (\is_bool($v___) && (($this->_M_fmtflags & ios_base::alpha) != 0)) {
					$v___ = $v___ ? 'true' : 'false';
				} else if (\is_bool($v___)) {
					$v___ = $v___ ? 1 : 0;
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::scientific) != 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::SCIENTIFIC);
					$v___ = \numfmt_format($numfmt, $v___);
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::fixed) != 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::DECIMAL);
					\numfmt_set_attribute($numfmt, \NumberFormatter::MIN_FRACTION_DIGITS, 20);
					$v___ = \numfmt_format($numfmt, $v___);
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::hex) != 0)) {
					$v___ = "0x" . \bin2hex(\pack('f', $v___));
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::hex) != 0)) {
					$v___ = "0x" . \dechex($v___);
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::oct) != 0)) {
					$v___ = \decoct($v___);
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::alpha) != 0)) {
					$v___ = \chr($v___);
				}
			} else if (\is_bool($v___)) {
				$v___ = $v___ ? 1 : 0;
			}
			return $v___;
		}

		function & fmtflags_assign(int $fls___)
		{
			$this->_M_fmtflags = $fls___;
			return $this;
		}

		function & fmtflags_clear()
		{
			$this->_M_fmtflags = ios_base::nomask;
			return $this;
		}

		function flags(int $fl___ = ios_base::nomask)
		{
			if ($fl___ == ios_base::nomask) {
				return $this->_M_fmtflags;
			}
			$fl = $this->_M_fmtflags;
			$this->_M_fmtflags = $fl___;
			return $fl;
		}

		function setf(int $fl___, int $mask___ = ios_base::nomask)
		{
			if ($mask___ == ios_base::nomask) {
				$fl = $this->_M_fmtflags;
				$this->_M_fmtflags |= $fl___;
				return $fl;
			}
			$fl = $this->_M_fmtflags;
			$this->unsetf($mask___);
			$this->_M_fmtflags |= $fl___ & $mask___;
			return $fl;
		}

		function unsetf(int $mask___)
		{
			$this->_M_fmtflags &= ~$mask___;
			return $this->_M_fmtflags;
		}

		function imbue(locale &$locale___)
		{ $this->_M_locale = $locale___; }

		function getloc()
		{ return $this->_M_locale; }

		function good()
		{ return $this->_M_sstate == 0; }

		function eof()
		{ return ($this->_M_sstate & ios_base::eofbit) != 0; }

		function fail()
		{ return ($this->_M_sstate & (ios_base::badbit|ios_base::failbit)) != 0; }

		function bad()
		{ return ($this->_M_sstate & ios_base::badbit) != 0; }

		function rdstate()
		{ return $this->_M_sstate; }

		function setstate(int $state___)
		{ $this->clear($this->_M_sstate|$state___); }

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

		function & read(&$d___, int $c___ = -1)
		{
			if ($c___ > 0) {
				$d___ = \fread($this->_M_handle_g, $d___, $c___);
			} else {
				$d___ = \fread($this->_M_handle_g, $d___);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
				$this->_M_count_g = 0;
			} else {
				$this->_M_count_g = memlen($d___);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function readsome(&$d___, int $c___ = -1)
		{
			$this->read($d___, $c___);
			return $this->_M_count_g;
		}

		function & get(&$d___, int $c___ = 1)
		{
			if ($c___ > 0) {
				$d___ = \fgets($this->_M_handle_g, $c___);
			} else {
				$d___ = \fgets($this->_M_handle_g);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
				$this->_M_count_g = 0;
			} else {
				$this->_M_count_g = memlen($d___);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function unget()
		{
			if ($this->_M_count_g > 0) {
				if (-1 == \fseek($this->_M_handle_g, -$this->_M_count_g, \SEEK_CUR)) {
					$this->setstate(ios_base::badbit|ios_base::failbit);
					$this->_M_count_g = 0;
				}
			}
			return $this;
		}

		function peek()
		{
			$d = "";
			$this->get($d);
			$this->unget();
			return $d;
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
				$this->_M_count_g = 0;
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
			$this->clear(ios_base::goodbit);
			$r = \ftell($this->_M_handle_g);
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$r = -1;
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $r;
		}

		function & seekg(int $off___, int $seekdir___ = ios_base::beg)
		{
			$this->clear(ios_base::goodbit);
			if (-1 == \fseek($this->_M_handle_g, $off___, $seekdir___)) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function gcount()
		{ return $this->_M_count_g; }
	} /* EOC */

	abstract class basic_ostream extends basic_ios
	{
		var $_M_handle_p;
		var $_M_count_p = 0;

		function __invoke($d___, int $fls___ = ios_base::nomask)
		{ return $this->fmtflags_assign($fls___)->write($d___)->fmtflags_clear(); }

		function & write($d___, int $c___ = -1)
		{
			$r = false;
			if ($c___ > 0) {
				$r = \fwrite($this->_M_handle_p, $this->_F_put($d___), $c___);
			} else {
				$r = \fwrite($this->_M_handle_p, $this->_F_put($d___));
			}
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
			} else {
				$this->_M_count_p = $r;
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

	class basic_istringstream extends basic_istream
	{
		function __construct(string &$buf)
		{
			$this->_M_handle_g = \tmpfile();
			$r = \fwrite($this->_M_handle_g, $buf);
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
			}
		}

		function __destruct()
		{ \fclose($this->_M_handle_g); }

		function str()
		{ return \stream_get_contents($this->_M_handle_g); }

		function swap(basic_istringstream &$iss)
		{
			$h = $this->_M_handle_g;
			$this->_M_handle_g = $iss->_M_handle_g;
			$iss->_M_handle_g = $h;
		}
	}

	class basic_ostringstream extends basic_ostream
	{
		function __construct()
		{ $this->_M_handle_p = \tmpfile(); }

		function __destruct()
		{ \fclose($this->_M_handle_p); }

		function & put($ch___)
		{
			$this->write($ch___);
			return $this;
		}

		function str()
		{ return \stream_get_contents($this->_M_handle_p); }

		function swap(basic_ostringstream &$oss)
		{
			$h = $this->_M_handle_p;
			$this->_M_handle_p = $oss->_M_handle_p;
			$oss->_M_handle_p = $h;
		}
	}

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

	function & cin(&$d___ = null)
	{
		static $is = null;
		if (\is_null($is)) {
			$is = new _C_ostream_cin;
		}
		if (!\is_null($d___)) {
			$is = $is($d___);
		}
		return $is;
	}

	function & cout($d___ = null, int $fl___ = ios_base::nomask)
	{
		static $os = null;
		if (\is_null($os)) {
			$os = new _C_ostream_cout;
		}
		if (!\is_null($d___)) {
			$os = $os($d___, $fl___);
		}
		return $os;
	}

	function & cerr($d___ = null, int $fl___ = ios_base::nomask)
	{
		static $os = null;
		if (\is_null($os)) {
			$os = new _C_ostream_cerr;
		}
		if (!\is_null($d___)) {
			$os = $os($d___, $fl___);
		}
		return $os;
	}
} /* EONS */

/* EOF */