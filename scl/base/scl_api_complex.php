<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_complex.php
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

declare(strict_types=1);

namespace std
{
	function _F_cabs(complex $z___) : float
	{ return \sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag); }

	function creal(complex $z___) : float
	{ return $z___->_M_real; }

	function cimag(complex $z___) : float
	{ return $z___->_M_imag; }

	function cabs(complex $z___) : float
	{ return \hypot($z___->_M_real, $z___->_M_imag); }

	function cnorm(complex $z___) : float
	{
		if (\is_infinite($z___->_M_real)) {
			// return \abs($z___->_M_real);
			return \INF;
		}
		if (\is_infinite($z___->_M_imag)) {
			//return \abs($z___->_M_imag);
			return \INF;
		}
		return $z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag;
	}

	function carg(complex $z___) : float
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

	function cexp(complex $z___) : complex
	{
		return new complex(
			  \exp($z___->_M_real) * \cos($z___->_M_imag)
			, \exp($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function clog(complex $z___) : complex
	{
		return new complex(
			  \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag))
			, \atan2($z___->_M_imag, $z___->_M_real)
		);
	}

	function clog10(complex $z___) : complex
	{
		$R = \log(\sqrt($z___->_M_real * $z___->_M_real + $z___->_M_imag * $z___->_M_imag));
		$I = \atan2($z___->_M_imag, $z___->_M_real);
		return new complex(
			  $R * (1.0 / \log(10))
			, $I * (1.0 / \log(10))
		);
	}

	function cpow(complex $z1___, complex $z2___) : complex
	{
		if (_F_FP_zeroed($z1___->_M_real, $z1___->_M_imag)) {
			return $x1;
		}
		//!# W (ϴ), R (ρ), B (β)
		$l = \log(\sqrt($z1___->_M_real * $z1___->_M_real + $z1___->_M_imag * $z1___->_M_imag));
		$W = \atan2($z1___->_M_imag, $z1___->_M_real);
		$R = \exp($l * $z2___->_M_real - $z2___->_M_imag * $W);
		$B = $W * $z2___->_M_real + $z2___->_M_imag * $l;
		return new complex($R * \cos($B), $R * \sin($B));
	}

	function csqrt(complex $z___) : complex
	{
		if (_F_FP_zeroed($z___->_M_real, $z___->_M_imag)) {
			return $x;
		}
		$a = \abs($z___->_M_real);
		$b = \abs($z___->_M_imag);
		$W = (($a >= $b)
			? \sqrt($a) * \sqrt(0.5 * (1.0 + \sqrt(1.0 + ($b / $a) * ($b / $a))))
			: \sqrt($b) * \sqrt(0.5 * (($a / $b) + \sqrt(1.0 + ($a / $b) * ($a / $b))))
		);
		if ($z___->_M_real > 0.0 || _F_FP_iszero($z___->_M_real)) {
			if (_F_FP_iszero($W)) {
				return new complex(
					  \NAN
					, \NAN
				);
			}
			return new complex(
				  $W
				, $z___->_M_imag / (2.0 * $W)
			);
		}
		$I = ($z___->_M_imag > 0.0 || _F_FP_iszero($I)) ? $W : -($W);
		if (_F_FP_iszero($I)) {
			return new complex(
				  \NAN
				, \NAN
			);
		}
		return new complex(
			  $z___->_M_imag / (2.0 * $I)
			, $I
		);
	}

	function cconj(complex $z___) : complex
	{ return new complex($z___->_M_real, -($z___->_M_imag)); }

	function cproj(complex $z___) : complex
	{
		$z = clone $z___;
		if (\is_infinite($z->_M_real) || \is_infinite($z->_M_imag)) {
			$z->_M_real = \INF;
			$z->_M_imag = copysign(0.0, $z->_M_imag);
		}
		return $z;
	}

	function cpolar(float $rho___, float $theta___ = 0.0) : complex
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

	function cinv(complex $z___) : complex 
	{
		$h = \hypot($z___->_M_real, $z___->_M_imag);
		if (_F_FP_iszero($h)) {
			return new complex(0.0, -(copysign(0.0, $z->_M_imag)));
		}
		$t = (1.0 / $h);
		return new complex(
			  ($z___->_M_real * $t * $t)
			, (-($z___->_M_imag) * $t * $t)
		);
	}

	function cneg(complex $z___) : complex 
	{ return new complex(-($z___->_M_real), -($z->_M_imag)); }

	function cadd(complex $z1___, complex $z2___) : complex 
	{
		$R = $z1___->_M_real + $z2___->_M_real;
		$I = $z1___->_M_imag + $z2___->_M_imag;
		return new complex($R, $I);
	}

	function csub(complex $z1___, complex $z2___) : complex 
	{
		$R = $z1___->_M_real - $z2___->_M_real;
		$I = $z1___->_M_imag - $z2___->_M_imag;
		return new complex($R, $I);
	}

	function cmul(complex $z1___, complex $z2___) : complex 
	{
		$R = ($z1___->_M_real * $z2___->_M_real) - ($z1___->_M_imag * $z2___->_M_imag);
		$I = ($z1___->_M_real * $z2___->_M_imag) + ($z2___->_M_real * $z1___->_M_imag);
		return new complex($R, $I);
	}

	function cdiv(complex $z1___, complex $z2___) : complex 
	{
		$d = $z2___->_M_real * $z2___->_M_real + $z2___->_M_imag * $z2___->_M_imag;
		if (_F_FP_iszero($d)) {
			return new complex(\NAN, \NAN);
		}
		$R = ($z1___->_M_real * $z2___->_M_real + $z1___->_M_imag * $z2___->_M_imag) / $d;
		$I = ($z1___->_M_imag * $z2___->_M_real - $z1___->_M_real * $z2___->_M_imag) / $d;
		return new complex($R, $I);
	}

	function cfadd(complex $z___, float $x___) : complex 
	{ return new complex(($z___->_M_real + $x___), $z___->_M_imag); }

	function cfsub(complex $z___, float $x___) : complex 
	{ return new complex(($z___->_M_real - $x___), $z___->_M_imag); }

	function cfmul(complex $z___, float $x___) : complex
	{
		if (\is_infinite($x___)) {
			return new complex(\INF, \INF);
		}
		if (\is_nan($x___)) {
			return new complex(\NAN, \NAN);
		}
		if (_F_FP_iszero($x___)) {
			return new complex(0.0, 0.0);
		}
		return new complex($z___->_M_real * x___, $z___->_M_imag * x___);
	}

	function cfdiv(complex $z___, float $x___) : complex
	{
		if (\is_infinite($x___)) {
			return new complex(\INF, \INF);
		}
		if (\is_nan($x___)) {
			return new complex(\NAN, \NAN);
		}
		if (_F_FP_iszero($x___)) {
			return new complex(0.0, 0.0);
		}
		return new complex($z___->_M_real / x___, $z___->_M_imag / x___);
	}

	function cfsqrt(float $x___) : complex
	{
		if ($x___ < 0.0) {
			return new complex(0.0, \sqrt(-($x___)));
		}
		return new complex(\sqrt($x___), 0.0);
	}

	function csec(complex $z___) : complex 
	{ return cinv(ccos($z___)); }

	function csech(complex $z___) : complex 
	{ return cinv(ccosh($z___)); }

	function ccsc(complex $z___) : complex 
	{ return cinv(csin($z___)); }

	function ccsch(complex $z___) : complex 
	{ return cinv(csinh($z___)); }

	function ccot(complex $z___) : complex 
	{ return cinv(ctan($z___)); }

	function ccoth(complex $z___) : complex 
	{ return cinv(ctanh($z___)); }

	function cacot(complex $z___) : complex 
	{ return catan(cinv($z___)); }

	function cacoth(complex $z___) : complex 
	{ return catanh(cinv($z___)); }

	function ccos(complex $z___) : complex
	{
		return new complex(
			  \cos($z___->_M_real) * \cosh($z___->_M_imag)
			, \sin($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function csin(complex $z___) : complex
	{
		return new complex(
			  \sin($z___->_M_real) * \cosh($z___->_M_imag)
			, \cos($z___->_M_real) * \sinh($z___->_M_imag)
		);
	}

	function ctan(complex $z___) : complex
	{
		$d = 1 + \pow(\tan($z___->_M_real), 2) * \pow(\tanh($z___->_M_imag), 2);
		return new complex(
			  \pow((1 / \cosh($z___->_M_imag)), 2) * \tan($z___->_M_real) / $d
			, \pow((1 / \cos($z___->_M_real)), 2) * \tanh($z___->_M_imag) / $d
		);
	}

	function ccosh(complex $z___) : complex
	{
		return new complex(
			  \cosh($z___->_M_real) * \cos($z___->_M_imag)
			, \sinh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function csinh(complex $z___) : complex
	{
		return new complex(
			  \sinh($z___->_M_real) * \cos($z___->_M_imag)
			, \cosh($z___->_M_real) * \sin($z___->_M_imag)
		);
	}

	function ctanh(complex $z___) : complex
	{
		$d = \cos($z___->_M_imag) * \cos($z___->_M_imag) + \sinh($z___->_M_real) * \sinh($z___->_M_real);
		return new complex(
			  \sinh($z___->_M_real) * \cosh($z___->_M_real) / $d
			, 0.5 * \sin(2 * $z___->_M_imag) / $d
		);
	}

	function cacos(complex $z___) : complex
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
		if (_F_FP_iszero($z___->_M_real)) {
			return new complex(\M_PI_2, -($z___->_M_imag));
		}
		$z = clog(cadd($z___, csqrt(csub(cpow($z___, new complex(2.0)), new complex(1.0)))));
		if (signbit($z___->_M_imag)) {
			return new complex(\abs($z->_M_imag), \abs($z->_M_real));
		}
		return new complex(\abs($z->_M_imag), -(\abs($z->_M_real)));
	}

	function casin(complex $z___) : complex
	{
		$z = casinh(new complex(-($z___->_M_imag), $z___->_M_real));
		return new complex($z->_M_imag, -($z->_M_real));
	}

	function catan(complex $z___) : complex
	{
		$z = catanh(new complex(-($z___->_M_imag), $z___->_M_real));
		return new complex($z->_M_imag, -($z->_M_real));
	}

	function cacosh(complex $z___) : complex
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

	function casinh(complex $z___) : complex
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
			if (_F_FP_iszero($z___->_M_imag)) {
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

	function catanh(complex $z___) : complex
	{
		if (\is_infinite($z___->_M_imag)) {
			return new complex(copysign(0.0, $z___->_M_real), copysign(\M_PI_2, $z___->_M_imag));
		}
		if (\is_nan($z___->_M_imag)) {
			if (\is_infinite($z___->_M_real) || _F_FP_iszero($z___->_M_real)) {
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
		if (_F_FP_isone(\abs($z___->_M_real)) && _F_FP_iszero($z___->_M_imag)) {
			return new complex(copysign(\INF, $z___->_M_real), copysign(0.0, $z___->_M_imag));
		}
		$z = cdiv(clog(cdiv(cadd(new complex(1.0), $z___) , csub(new complex(1.0), $z___))), new complex(2.0));
		return new complex(copysign($z->_M_real, $z___->_M_real), copysign($z->_M_imag, $z___->_M_imag));
	}
} /* EONS */

/* EOF */