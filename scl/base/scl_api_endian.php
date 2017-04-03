<?php
# -*- coding: utf-8 -*-

//
// scl_api_endian.php
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
	abstract class endian_utils
	{
		const big    = 1;
		const little = 2;
		const host   = 3;
	} /* EOC */

	function host_byte_order()
	{
		static $_S_bo = null;
		if (\is_null(null)) {
			$_S_bo = \unpack('S',"\x01\x00")[1] === 1 ? endian_utils::little : endian_utils::big;
		}
		return $_S_bo;
	}

	function pack_int8(int $x___)
	{ return \pack("c", $x___); }

	function unpack_int8($x___)
	{ return \unpack("c", $x___)[1]; }

	function pack_int8_v(...$v___)
	{ return \pack("c*", ...$v___); }

	function pack_uint8(int $x___)
	{ return \pack("C", $x___); }

	function unpack_uint8($x___)
	{ return \unpack("C", $x___)[1]; }

	function pack_uint8_v(...$v___)
	{ return \pack("C*", ...$v___); }

	function pack_int16(int $x___)
	{ return \pack("s", $x___); }

	function unpack_int16($x___, int $byte_order___ = endian_utils::host)
	{
		switch ($byte_order___) {
			case endian_utils::big:
			case endian_utils::little:
			{
				$x = \unpack("n", $x___); 
				$x = $x[1]; 
				if ($x >= \pow(2, 15)) {
					$x -= \pow(2, 16);
				}
				return $x;
			}
		}
		return \unpack("s", $x___)[1];
	}

	function pack_int16_v(...$v___)
	{ return \pack("s*", ...$v___); }

	function pack_uint16(int $x___, int $byte_order___ = endian_utils::host)
	{
		$m = "S";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "n";
			break;
			case endian_utils::little:
				$m = "v";
			break;
		}
		return \pack($m, $x___);
	}

	function unpack_uint16($x___, int $byte_order___ = endian_utils::host)
	{
		$m = "S";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "n";
			break;
			case endian_utils::little:
				$m = "v";
			break;
		}
		return \unpack($m, $x___)[1];
	}

	function pack_uint16_v(int $byte_order___, ...$v___)
	{
		$buf = "";
		$m = "S*";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "n*";
			break;
			case endian_utils::little:
				$m = "v*";
			break;
		}
		return \pack($m, ...$v___);
	}

	function pack_int32(int $x___)
	{ return \pack("l", $x___); }

	function unpack_int32($x___)
	{ return \unpack("l", $x___)[1]; }

	function pack_int32_v(...$v___)
	{ return \pack("l*", ...$v___); }

	function pack_uint32(int $x___, int $byte_order___ = endian_utils::host)
	{
		$m = "L";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "N";
			break;
			case endian_utils::little:
				$m = "V";
			break;
		}
		return \pack($m, $x___);
	}

	function unpack_uint32($x___, int $byte_order___ = endian_utils::host)
	{
		$m = "L";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "N";
			break;
			case endian_utils::little:
				$m = "V";
			break;
		}
		return \unpack($m, $x___)[1];
	}

	function pack_uint32_v(int $byte_order___, ...$v___)
	{
		$m = "L*";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "N*";
			break;
			case endian_utils::little:
				$m = "V*";
			break;
		}
		return \pack($m, ...$v___);
	}

	function pack_int64(int $x___)
	{ return \pack("q", $x___); }

	function pack_int64_v(...$v___)
	{ return \pack("q*", ...$v___); }

	function pack_uint64(int $x___, int $byte_order___ = endian_utils::host)
	{
		$m = "Q";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "J";
			break;
			case endian_utils::little:
				$m = "P";
			break;
		}
		return \pack($m, $x___);
	}

	function pack_uint64_v(int $byte_order___, ...$v___)
	{
		$m = "Q*";
		switch ($byte_order___) {
			case endian_utils::big:
				$m = "J*";
			break;
			case endian_utils::little:
				$m = "P*";
			break;
		}
		return \pack($m, ...$v___);
	}

	function pack_float(float $x___)
	{ return \pack("f", $x___); }

	function pack_float_v(...$v___)
	{ return \pack("f*", ...$v___); }

	function pack_double(float $x___)
	{ return \pack("d", $x___); }

	function pack_double_v(...$v___)
	{ return \pack("d*", ...$v___); }
} /* EONS */

/* EOF */