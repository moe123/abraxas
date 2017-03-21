<?php
# -*- coding: utf-8 -*-

//
// scl_random.php
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
	final class random_device
	{
		var $_M_dev = null;
		var $_M_ent = 0.0;
		var $_M_ini = 0x0;

		static function min() { return 0; }
		static function max() { return 0x7FFFFFFF; }

		function __invoke()
		{ return ($this->_M_dev)(4); }

		function __construct()
		{
			$this->_M_dev = _X_random_slot($this->_M_ent);
			$this->_M_ini = \bin2hex(($this->_M_dev)(16));
		}

		function entropy()
		{ return $this->_M_ent; }
	} /* EOC */

	final class cryptographically_secure_engine 
	{
		var $_M_dev = null;

		static function min()
		{ return 0; }

		static function max()
		{ return 0x7FFFFFFF; }

		function __construct(random_device $dev = null)
		{
			$this->_M_dev = null;
			$this->discard(1);
		}

		function __destruct()
		{ $this->_M_dev = null; }

		function __invoke(int $a = 0, int $b = -1)
		{
			if ($a < 0) {
				$a = cryptographically_secure_engine::min();
			}

			if ($b < 1) {
				$b = cryptographically_secure_engine::max();
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return @\random_int($a, $b);
		}

		function seed(int $x = -1)
		{ /* NOP */ }

		function discard(int $n)
		{
			for ($i = 0; $i < $n; $i++) {
				@\random_int(
					  mersenne_twister_engine::min()
					, mersenne_twister_engine::max()
				);
			}
		}
	} /* EOC */

	final class mersenne_twister_engine 
	{
		var $_M_dev = null;

		static function min()
		{ return 0; }

		static function max()
		{ return \mt_getrandmax(); }

		function __construct(random_device $dev = null)
		{
			$this->_M_dev = \is_null($dev) ? new random_device : $dev;
			$this->discard(1);
		}

		function __destruct()
		{ $this->_M_dev = null; }

		function __invoke(int $a = 0, int $b = -1)
		{
			if ($a < 0) {
				$a = mersenne_twister_engine::min();
			}

			if ($b < 1) {
				$b = mersenne_twister_engine::max();
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return \mt_rand($a, $b);
		}

		function seed(int $x = -1)
		{
			if ($x < 1) {
				$hex .= \bin2hex(($this->_M_dev)(8));
				for ($i = 0; $i < strlen($hex); $i++) {
					$x += \ord($hex[$i]);
				}
			}
			@\mt_srand($x, \MT_RAND_MT19937);
		}

		function discard(int $n)
		{
			for ($i = 0; $i < $n; $i++) {
				@\mt_rand(
					  mersenne_twister_engine::min()
					, mersenne_twister_engine::max()
				);
			}
		}
	} /* EOC */

	final class uniform_int_distribution
	{
		var $_M_a;
		var $_M_b;
		var $_M_r;

		function min() { return $this->_M_a; }
		function max() { return $this->_M_b; }

		function __construct(int $a = 0, int $b = -1)
		{
			$this->_M_a = $a;
			$this->_M_b = $b;
			$this->_M_r = 0;
		}

		function __invoke(callable $gen, int $a = 0, int $b = -1)
		{
			if ($this->_M_r > 0) {
				$this->_M_r = 0;
				$gen->seed();
				$gen->discard(1);
			}

			if ($a <= 0 && $b < 1) {
				return $gen($this->_M_a, $this->_M_b);
			}
			return $gen($a, $b);
		}

		function reset()
		{ $this->_M_r = 1; }

		function a()
		{ return $this->_M_a; }

		function b()
		{ return $this->_M_a; }
	} /* EOC */

	final class uniform_real_distribution
	{
		var $_M_a;
		var $_M_b;
		var $_M_r;

		function min() { return $this->_M_a; }
		function max() { return $this->_M_b; }

		function __construct(float $a = 0.0, float $b = 1.0)
		{
			$this->_M_a = $a;
			$this->_M_b = $b;
			$this->_M_r = 0;
		}

		function __invoke(callable $gen, float $a = 0.0, float $b = 0.0)
		{
			if ($this->_M_r > 0) {
				$this->_M_r = 0;
				$gen->seed();
				$gen->discard(1);
			}

			if (\abs($a - $b) < numeric_limits_float::epsilon) {
				return (
					  $this->_M_a
					+ ($gen($gen::min(), $gen::max()) / $gen::max())
					* ($this->_M_b - $this->_M_a)
				);
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return ($a + ($gen($gen::min(), $gen::max()) / $gen::max()) * ($b - $a));
		}

		function reset()
		{ $this->_M_r = 1; }

		function a()
		{ return $this->_M_a; }

		function b()
		{ return $this->_M_a; }
	} /* EOC */
} /* EONS */

/* EOF */