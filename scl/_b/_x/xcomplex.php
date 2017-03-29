<?php
# -*- coding: utf-8 -*-

//
// xcomplex.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//

/*!
 * @project    Abraxas (Standard Container Library).
 * @brief      Complex numbers and associated mathematical functions:
 *             hyperbolic, trigonometric, exponential, power.
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	function ccos(complex $z___)
	{
		return new complex(
			  \cos($z___->_M_real) * \cosh($z___->_M_imag)
			, \sin($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function csin(complex $z___)
	{
		return new complex(
			  \sin($z___->_M_real) * \cosh($z___->_M_imag)
			, \cos($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function ctan(complex $z___)
	{
		$d = 1 + \pow(\tan($z___->_M_real), 2) * \pow(\tanh($z___->_M_imag), 2);
		return new complex(
			  \pow((1 / \cosh($z___->_M_imag)), 2) * \tan($z___->_M_real) / $d
			, \pow((1 / \cos($z___->_M_real)), 2) * \tanh($z___->_M_imag) / $d
		);
	}

	function ccosh(complex $z___)
	{
		return new complex(
			  \cosh($z___->_M_real) * \cos($z___->_M_imag)
			, \sinh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function csinh(complex $z___)
	{
		return new complex(
			  \sinh($z___->_M_real) * \cos($z___->_M_imag)
			, \cosh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function ctanh(complex $z___)
	{
		$d = \cos($z___->_M_imag) * \cos($z___->_M_imag) + \sinh($z___->_M_real) * \sinh($z___->_M_real);
		return new complex(
			  \sinh($z___->_M_real) * \cosh($z___->_M_real) / $d
			, 0.5 * \sin(2 * $z___->_M_imag) / $d
		);
	}

	function cexp(complex $z___)
	{
		return new complex(
			  \exp($z___->_M_real) * \cos($z___->_M_imag)
			, \exp($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function clog(complex $z___)
	{
		return new complex(
			  \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag))
			, \atan2($z___->_M_imag, $z___->_M_real)
		);
	}

	function clog10(complex $z___)
	{
		$R = \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag));
		$I = \atan2($z___->_M_imag, $z___->_M_real);
		return new complex(
			  $R * (1.0 / \log(10))
			, $I * (1.0 / \log(10))
		);
	}

	function cabs(complex $z___)
	{
		/* return \sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag); */
		return \hypot($z___->_M_real, $z___->_M_imag);
	}

	function cnorm(complex $z___)
	{
		if (\is_infinite($z___->_M_real))
			return \abs($z___->_M_real);
		if (\is_infinite($z___->_M_imag))
			return \abs($z___->_M_imag);
		return $z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag;
	}

	function carg(complex $z___)
	{
		if (\is_nan($z___->_M_real) || \is_nan($z___->_M_imag)) {
			return \NAN;
		}
		$A = \atan2($z___->_M_imag, $z___->_M_real);
		if (\M_PI < $A || $A < (\M_PI * - 1)) {
			return \INF;
		}
		return $A;
	}

	function cpow(complex $z1___, complex $z2___) 
	{
		if (_X_real_zeroed($z1___->_M_real, $z1___->_M_imag)) {
			return $x1;
		}
		//!# W (ϴ), R (ρ), B (β)
		$l = \log(\sqrt($z1___->_M_real * $z1___->_M_real + $z1___->_M_imag * $z1___->_M_imag));
		$W = \atan2($z1___->_M_imag, $z1___->_M_real);
		$R = \exp($l * $z2___->_M_real - $z2___->_M_imag * $W);
		$B = $W * $z2___->_M_real + $z2___->_M_imag * $l;

		return new complex($R * \cos($B), $R * \sin($B));
	}

	function csqrt(complex $z___) 
	{
		if (_X_real_zeroed($z___->_M_real, $z___->_M_imag)) {
			return $x;
		}

		$a = \abs($z___->_M_real);
		$b = \abs($z___->_M_imag);

		$W = (($a >= $b)
			? \sqrt($a) * \sqrt(0.5 * (1.0 + \sqrt(1.0 + ($b / $a) * ($b / $a))))
			: \sqrt($b) * \sqrt(0.5 * (($a / $b) + \sqrt(1.0 + ($a / $b) * ($a / $b))))
		);

		if ($z___->_M_real > 0.0 || _X_real_iszero($z___->_M_real)) {
			return new complex(
				  $W
				, $z___->_M_imag / (2.0 * $W)
			);
		}

		$I = ($z___->_M_imag > 0.0 || _X_real_iszero($z___->_M_imag)) ? $W : -($W);
		return new complex(
			  $z___->_M_imag / (2.0 * $I)
			, $I
		);
	}

	function cconj(complex $z___)
	{ return new complex($z___->_M_real, -($z___->_M_imag)); }

	function cproj(complex $z___)
	{
		$z = clone $z___;
		if (\is_infinite($z->_M_real) || \is_infinite($z->_M_imag)) {
			$z->_M_real = \INF;
			$z->_M_imag = copysign(0.0, $z->_M_imag);
		}
		return $z;
	}

	function cpolar(float $rho___, float $theta___ = 0.0)
	{
		if (\is_nan($rho___) || signbit($rho___)) {
			return new complex(\NAN, \NAN);
		}

		if (\is_nan($theta___)) {
			if (\is_infinite($rho___)) {
					return new complex($rho___, $theta___);
			}
			return new complex($theta___, $theta___);
		}

		if (\is_infinite($theta___)) {
			if (\is_infinite($rho___)) {
					return new complex($rho___, \NAN);
			}
			return new complex(\NAN, \NAN);
		}

		$R = $rho___ * \cos($theta___);
		if (\is_nan($R)) {
			$R = 0.0;
		}
			
		$I = $rho___ * \sin($theta___);
		if (\is_nan($I)) {
			$I = 0.0;
		}
		return new complex($R, $I);
	}

	function cinv(complex $z___) 
	{
		$h = \hypot($z___->_M_real, $z___->_M_imag);
		if (_X_real_iszero($h)) {
			return new complex(0.0, -(copysign(0.0, $z->_M_imag)));
		}
		$t = (1.0 / $h);
		return new complex(
			  ($z___->_M_real * $t * $t)
			, (-($z___->_M_imag) * $t * $t)
		);
	}

	function cneg(complex $z___) 
	{ return new complex(-($z___->_M_real), -($z->_M_imag)); }

	function cadd(complex $z1___, complex $z2___) 
	{
		$R = $z1___->_M_real + $z2___->_M_real;
		$I = $z1___->_M_imag + $z2___->_M_imag;
		return new complex($R, $I);
	}

	function csub(complex $z1___, complex $z2___) 
	{
		$R = $z1___->_M_real - $z2___->_M_real;
		$I = $z1___->_M_imag - $z2___->_M_imag;
		return new complex($R, $I);
	}

	function cmul(complex $z1___, complex $z2___) 
	{
		$R = ($z1___->_M_real * $z2___->_M_real) - ($z1___->_M_imag * $z2___->_M_imag);
		$I = ($z1___->_M_real * $z2___->_M_imag) + ($z2___->_M_real * $z1___->_M_imag);
		return new complex($R, $I);
	}

	function cdiv(complex $z1___, complex $z2___) 
	{
		$d = $z2___->_M_real * $z2___->_M_real + $z2___->_M_imag * $z2___->_M_imag;
		if (_X_real_iszero($d)) {
			return new complex(\NAN, \NAN);
		}
		$R = ($z1___->_M_real * $z2___->_M_real + $z1___->_M_imag * $z2___->_M_imag) / $d;
		$I = ($z1___->_M_imag * $z2___->_M_real - $z1___->_M_real * $z2___->_M_imag) / $d;
		return new complex($R, $I);
	}

	function csec(complex $z___) 
	{ return cinv(ccos($z___)); }

	function ccosec(complex $z___) 
	{ return cinv(csin($z___)); }

	function ccotan(complex $z___) 
	{ return cinv(ctan($z___)); }

	function creal(complex $z___)
	{ return $z___->_M_real; }

	function cimag(complex $z___)
	{ return $z___->_M_imag; }

	function cacos(complex $z___)
	{
		if (\is_infinite($z___->_M_real)) {
			if (\is_nan($z___->_M_imag)) {
				return new complex($z___->_M_imag, $z___->_M_real);
			}

			if (\is_infinite($z___->_M_imag)) {
				if ($z___->_M_real < 0.0) {
					return new complex(0.75 * \M_PI, -($z___->_M_imag));
				}
				return new complex(0.25 * \M_PI, -($z___->_M_imag));
			}

			if ($z___->_M_real < 0.0) {
				return new complex(\M_PI, signbit($z___->_M_imag) ? -($z___->_M_real) : $z___->_M_real);
			}
			return new complex(0.0, signbit($z___->_M_imag) ? $z___->_M_real : -($z___->_M_real));
		}

		if (\is_nan($z___->_M_real)) {
			if (\is_infinite($z___->_M_imag)) {
				return new complex($z___->_M_real, -($z___->_M_imag));
			}
			return new complex($z___->_M_real, $z___->_M_real);
		}

		if (\is_infinite($z___->_M_imag)) {
			return new complex(\M_PI_2, -($z___->_M_imag));
		}

		if (_X_real_iszero($z___->_M_real)) {
			return new complex(\M_PI_2, -($z___->_M_imag));
		}

		$z = clog(cadd($z___, csqrt(csub(cpow($z___, new complex(2.0)), new complex(1.0)))));
		if (signbit($z___->_M_imag)) {
			return new complex(\abs($z->_M_imag), \abs($z->_M_real));
		}
		return new complex(\abs($z->_M_imag), -(\abs($z->_M_real)));
	}

	function cacosh(complex $z___)
	{
		if (\is_infinite($z___->_M_real)) {
			if (\is_nan($z___->_M_imag)) {
				return new complex(\abs($z___->_M_real), $z___->_M_imag);
			}

			if (\is_infinite($z___->_M_imag)) {
				if ($z___->_M_real > 0.0) {
					return new complex($z___->_M_real, copysign(\M_PI * 0.25, $z___->_M_imag));
				}
				return new complex(-($z___->_M_real), copysign(\M_PI * 0.75, $z___->_M_imag));
			}

			if ($z___->_M_real < 0.0) {
				return new complex(-($z___->_M_real), copysign(\M_PI, $z___->_M_imag));
			}
			return new complex($z___->_M_real, copysign(0.0, $z___->_M_imag));
		}

		if (\is_nan($z___->_M_real)) {
			if (\is_infinite($z___->_M_imag)) {
				return new complex(\abs($z___->_M_imag), $z___->_M_real);
			}
			return new complex($z___->_M_real, $z___->_M_real);
		}

		if (\is_infinite($z___->_M_imag)) {
			return new complex(\abs($z___->_M_imag), copysign(\M_PI_2, $z___->_M_imag));
		}

		$z = clog(cadd($z___, csqrt(csub(cpow($z___, new complex(2.0)), new complex(1.0)))));

		return new complex(copysign($z->_M_real, 0.0), copysign($z->_M_imag, $z___->_M_imag));
	}

	function casin(complex $z___)
	{
		$z = casinh(new complex(-($z___->_M_imag), $z___->_M_real));
		return new complex($z->_M_imag, -($z->_M_real));
	}

	function casinh(complex $z___)
	{
		if (\is_infinite($z___->_M_real)) {
			if (\is_nan($z___->_M_imag)) {
				return $z___;
			}

			if (\is_infinite($z___->_M_imag)) {
				return new complex($z___->_M_real, copysign(\M_PI * 0.25, $z___->_M_imag));
			}
			return new complex($z___->_M_real, copysign(0.0, $z___->_M_imag));
		}

		if (\is_nan($z___->_M_real)) {
			if (\is_infinite($z___->_M_imag)) {
				return new complex($z___->_M_imag, $z___->_M_real);
			}

			if (_X_real_iszero($z___->_M_imag)) {
				return $z___;
			}
			return new complex($z___->_M_real, $z___->_M_real);
		}

		if (\is_infinite($z___->_M_imag)) {
			return new complex(copysign($z___->_M_imag, $z___->_M_real), copysign(\M_PI_2, $z___->_M_imag));
		}
		
		$z = clog(cadd($z___, csqrt(csub(cpow($z___, new complex(2.0)), new complex(1.0)))));

		return new complex(copysign($z->_M_real, $z___->_M_real), copysign($z->_M_imag, $z___->_M_imag));
	}

	function catan(complex $z___)
	{
		$z = catanh(new complex(-($z___->_M_imag), $z___->_M_real));
		return new complex($z->_M_imag, -($z->_M_real));
	}

	function catanh(complex $z___)
	{
		if (\is_infinite($z___->_M_imag))
		{
			return new complex(copysign(0.0, $z___->_M_real), copysign(\M_PI_2, $z___->_M_imag));
		}

		if (\is_nan($z___->_M_imag)) {
			if (\is_infinite($z___->_M_real) || $z___->_M_real == 0) {
				return new complex(copysign(0.0, $z___->_M_real), $z___->_M_imag);
			}
			return new complex($z___->_M_imag, $z___->_M_imag);
		}

		if (\is_nan($z___->_M_real)) {
			return new complex($z___->_M_real, $z___->_M_real);
		}

		if (\is_infinite($z___->_M_real)) {
			return new complex(copysign(0.0, $z___->_M_real), copysign(\M_PI_2, $z___->_M_imag));
		}

		if (\abs($z___->_M_real) == _Tp(1) && $z___->_M_imag == 0.0) {
			return new complex(copysign(\INF, $z___->_M_real), copysign(0.0, $z___->_M_imag));
		}

		$z = cdiv(clog(cdiv(cadd(new complex(1.0), $z___) , csub(new complex(1.0), $z___))), new complex(2.0));

		return new complex(copysign($z->_M_real, $z___->_M_real), copysign($z->_M_imag, $z___->_M_imag));
	}
} /* EONS */

/* EOF */