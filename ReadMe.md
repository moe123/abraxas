# Abraxas
A digression to the world of scripting languages and PHP.

<sub><sup>Perhaps one of the most significant advances made by Arabic mathematics began at this time 
with the work of al-Khwarizmi (1), namely the beginnings of algebra (2). It is important to 
understand just how significant this new idea was. It was a revolutionary move away from 
the Greek concept of mathematics which was essentially geometry. Algebra was a unifying 
theory which allowed rational numbers, irrational numbers, geometrical magnitudes, etc., 
to all be treated as "algebraic objects". It gave mathematics a whole new development path 
so much broader in concept to that which had existed before, and provided a vehicle for 
future development of the subject. Another important aspect of the introduction of 
algebraic ideas was that it allowed mathematics to be applied to itself in a way which had 
not happened before.</sup></sub>

<sub><sup>-- The MacTutor History of Mathematics archive --</sup></sub>

<sub><sup>1 - </sup></sub><sub><sup> In the twelfth century, Latin translations of his work on the Indian numerals introduced the decimal positional number system to the Western world. @see Liber Abaci ; Leonardo of Pisa, Fibonacci.</sup></sub>

<sub><sup>2 - </sup></sub><sub><sup>الجبر</sup></sub><sub><sup> : Al-kitāb al-mukhtaṣar fī ḥisāb al-ğabr wa’l-muqābala</sup></sub>


#### | Brief
A Standard Container Library (`SCL`) influenced and freely inspired by the `C++ Standard Library` 
and the `C++ STL`. Providing the same six main components: `Algorithms`, `Containers`, `Iterators`, `Functional`,  `I/O Streams` and `Locale`.

Extended functionalities:
- POSIX.1 symbolic error (errno)
- Utility library.
- Strings (binary and UTF-8).
- Math Numerics library (integral, real-floating-point, complex, rational)
- Localization and formatting (future).
- Binary Data container (packed-array) (future).
- Date and time (future).
- Filesystem (future).

```php
/* IEEE Std 1003.1-2001 like complex number arithmetic. */
function creal  (complex $z) : float;
function cimag  (complex $z) : float;
function cabs   (complex $z) : float;
function cnorm  (complex $z) : float;
function carg   (complex $z) : float;
function cexp   (complex $z) : complex;
function clog   (complex $z) : complex;
function clog10 (complex $z) : complex;
function cpow   (complex $z1, complex $z2) : complex;
function csqrt  (complex $z) : complex;
function cconj  (complex $z) : complex;
function cproj  (complex $z) : complex;
function cpolar (float $rho, float $theta = 0.0) : complex;
function cinv   (complex $z) : complex;
function cneg   (complex $z) : complex;
function cadd   (complex $z1, complex $z2) : complex;
function csub   (complex $z1, complex $z2) : complex;
function cmul   (complex $z1, complex $z2) : complex;
function cdiv   (complex $z1, complex $z2) : complex;
function cfadd  (complex $z, float $x) : complex;
function cfsub  (complex $z, float $x) : complex;
function cfmul  (complex $z, float $x) : complex;
function cfdiv  (complex $z, float $x) : complex;
function cfsqrt (float $x) : complex;
function csec   (complex $z) : complex;
function csech  (complex $z) : complex;
function ccsc   (complex $z) : complex;
function ccsch  (complex $z) : complex;
function ccot   (complex $z) : complex;
function ccoth  (complex $z) : complex;
function cacot  (complex $z) : complex;
function cacoth (complex $z) : complex;
function ccos   (complex $z) : complex;
function csin   (complex $z) : complex;
function ctan   (complex $z) : complex;
function ccosh  (complex $z) : complex;
function csinh  (complex $z) : complex;
function ctanh  (complex $z) : complex;
function cacos  (complex $z) : complex;
function casin  (complex $z) : complex;
function catan  (complex $z) : complex;
function cacosh (complex $z) : complex;
function casinh (complex $z) : complex;
function catanh (complex $z) : complex;
```

```php
/* Extended common mathematical, trigonometric templates with complex number support. */
function setsigngam     (int $signgam);
function & signgam      ();
function fesetround     (int $rndmode);
function fpclassify     (float $x);
function isnan          (float $x);
function isnormal       (float $x);
function isfinite       (float $x);
function isinf          (float $x);
function copysign       ($x, $y);
function isgreater      (float $x, float $y);
function isgreaterequal (float $x, float $y);
function isless         (float $x, float $y);
function islessequal    (float $x, float $y);
function islessgreater  (float $x, float $y);
function isunordered    (float $x, float $y);
function signbit        ($x);
function fabs           (float $x);
function fmod           (float $x, float $y);
function modf           (float $x, float &$iptr);
function fmax           (float $x, float $y);
function fmin           (float $x, float $y);
function fdim           (float $x, float $y);
function fma            (float $x, float $y, float $z);
function fdeg2rad       (float $x);
function frad2deg       (float $x);
function fsec           (float $x);
function fcsc           (float $x);
function fcot           (float $x);
function fsech          (float $x);
function fcsch          (float $x);
function fcoth          (float $x);
function facsc          (float $x);
function fasec          (float $x);
function facot          (float $x);
function fasech         (float $x);
function facsch         (float $x);
function facoth         (float $x);
function trunc          (float $x);
function nearbyint      (float $x);
function remainder      (float $x, float $y);
function hypot          (float $x, float $y);
function fact           (int $x);
function abs            ($x);
function real           ($x);
function imag           ($x);
function arg            ($x);
function sec            ($x);
function csc            ($x);
function cot            ($x);
function sech           (float $x);
function csch           ($x);
function coth           ($x);
function norm           ($x);
function conj           ($x);
function proj           ($x);
function polar          (float $rho, float $theta = 0.0);
function topolar        ($x, float &$rho, float &$theta);
function exp            ($x);
function exp2           ($x);
function expm1          (float $x);
function pow            ($x, $y);
function log            ($x);
function log2           (float $x);
function log10          ($x);
function log1p          (float $x);
function sqrt           ($x);
function cos            ($x);
function cosh           ($x);
function sin            ($x);
function sinh           ($x);
function tan            ($x);
function tanh           ($x);
function acos           ($x);
function acosh          ($x);
function asin           ($x);
function asinh          ($x);
function atan2          (float $x);
function atan           ($x);
function atanh          ($x);
function cbrt           (float $x);
function ftrt           (float $x);
function nthrt          (float $x, int $n);
function ceil           (float $x);
function floor          (float $x);
function round          (float $x);
function lrint          (float $x);
function logb           (float $x);
function ilogb          (float $x);
function lgamma_s       (float $x);
function lgamma_r       (float $x, int &$signp);
function lgamma         (float $x);
function tgamma         (float $x);
function beta           (float $x, float $y);
function frexp          (float $x, int &$e);
function ldexp          (float $x, int $n);
function erf            (float $x);
function erfc           (float $x);
function sincosf        (float $x, float &$sin, float &$cos);
```

```php

$buf = "";

while (std\stdcin($buf)) {
	std\stdcout($buf);
}

std\fwrite($buf, 1, 3, std\stderr);

...

std\fseek(std\stderr, 0, std\seek_set);

...

std\fprintln(std\stderr, "%s %s %s", "Hello", "World", "!");

...

while (!std\cin($buf)->eof()) {
	std\cout($buf);
}

...
```

#### | Caveats
In PHP, one of the difficulties is the lack of logical operator overloads on object, thus we adopted counterbalanced 
measures and designs such as adding more comparator callbacks in the `Algorithms` component.
We try as much as we can to re-introduce type safety on any internal structures (∩｀-´)⊃━☆ﾟ.*･｡ﾟ.

#### | Containers
It contains sequence containers and associative containers and maybe in the future public 
container adaptors: `forward_list`, `tuple`, `ordered_list`, `vector`, `ordered_map`, `dict`, `ordered_set` are almost done.

```php

$l  = std\make_ordered_list(
	  "Hémimorphite"
	, "Calcédoine"
	, "Pastèque"
	, "Fève de Cacao"
	, "Amétrine"
	, "Pêche"
	, "Amélanche"
	, "Fruit-à-pain"
	, "Pomélos"
	, "Magnésite"
	, "Nèfle du Japon"
	, "Séraphinite"
	, "Caïmite"
	, "Fèves"
	, "Galène"
	, "Célestine"
	, "Hématite"
	, "Mûre"
	, "Charoïte"
	, "Plaquebière"
	, "Hypersthène"
	, "Péridot"
	, "Améthyste"
	, "Nèfles"
	, "Angélite"
	, "Bois silicifié"
	, "Magnétite"
);

std\sort(std\begin($l), std\end($l), std\make_locale("fr_FR.UTF-8"));

foreach ($l as $item) {
	std\cerr($item)(std\endl);
}

...

$v = std\make_vector(0, 1 ,2);
std\place_generate_n(
	  std\front_inserter($v)
	, 5 
	, std\random_int_generator(100, 200)
);

std\place_generate_n(
	  std\back_inserter($v)
	, 5 
	, std\random_real_generator(-0.5, 0.7)
);

std\cout($v);

```

#### | Iterators
Abraxas implements five different types of iterators: `Forward-Bidirectional`, `Reverse-Bidirectional`, `Back-Inserter`, `Front-Inserter` and `Duo-Iterator`. Like the `C++ STL`, Abraxas `Iterators` implementation is now fully opaque to the `Algorithms` component. `Iterators` have a `first()` and `second()` member ; where `first()` is the key or numerical index (depends on the container category) and `second()` the value.

```php

$v  = std\make_vector(1, 2, 3, 4, 5, 6, 7, 8, 9);

$it = $v->rbegin();

while ($it != $v->rend()) {
	std\cout($it->second())(std\space);
	$it->advance(2);
}

std\cout(std\endl);

...

$it = std\begin($v, 1);

while ($it != std\end($v)) {
	std\cout($it->second())(std\tab);
	$it->next();
}

std\cout(std\endl);

...

$pos = std\find(std\begin_p($it), std\end($v), 3);

if ($pos != std\end($v)) {
	std\cout("\$v contains: 3")(std\endl);
}

...

// range & fast enumeration integration

foreach (std\irange_lazy(8, 10, 2) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

foreach (std\irange_lazy(8, 10, -2) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

$rg = std\make_irange(8, 10, 2);
$it = $rg->rbegin();

while ($it != $rg->rend()) {
	std\cout($it->second())(std\tab);
	$it->next();
}
std\cout(std\endl);

foreach (std\make_irange(8, 10, -2) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

// 8       10      12      14      16
// 17      15      13      11      9
// 16      14      12      10      8
// 17      15      13      11      9

...

// duo_iterator madness

$c1 = std\make_ordered_list();
$c2 = std\make_forward_list();
$c3 = std\make_ordered_list();
$c4 = std\make_forward_list();

std\copy($v->begin(2), $v->begin(4), std\duotator(
	  std\duotator(
		  std\back_inserter($c1)
		, std\front_inserter($c2)
	  )
	, std\duotator(
		  std\back_inserter($c3)
		, std\front_inserter($c4)
	  )
));

```

#### | Algorithms
A large number of algorithms have been already written <sub><sup>(1)</sup></sub>, in the same way than `C++ STL`, it requires
a certain type of iterator. The design is an hybrid one, tacking advantages of 
existing x functions (not always, depends on performances, zero-copying / COW and what can 
be done in the most elegant way. The author choices control entirely the outcome of those; anyhow, 
this is transparent to the end-user).

It should be noted that unlike the `C++ STL`, for convenience, (as everything is handled 
at runtime) `Iterators` are in a exhausted state after use (avoiding explicit parameter copies 
or intrusive hidden offset resets). Thus ; they can be reused ; @see `begin_p` or `end_p`
(however, for well-known reasons, reusing `Inserters` or `Duo-Iterator` is placed in the `undefined behavior` category ¯\\_(ツ)_/¯ ).

<sub><sup>1 - </sup></sub><sub><sup>std\accumulate, std\adjacent_find, std\all_of, std\any_of, std\binary_search, std\clamp, std\copy_backward, std\copy_if, std\copy_n, std\copy, std\count_if, std\count, std\equal_range, std\equal, std\fill_n, std\fill, std\find_end, std\find_first_of, std\find_if_not, std\find_if, std\find, std\for_each_n, std\for_each, std\generate_n, std\generate, std\heap_pop, std\heap_push, std\includes, std\inner_product, std\iota, std\is_permutation, std\is_sorted_until, std\is_sorted, std\iter_swap, std\lexicographical_compare, std\lower_bound, std\make_heap, std\max_element, std\max, std\merge, std\min_element, std\min, std\minmax_element, std\minmax, std\mismatch, std\next_permutation, std\none_of, std\partial_sum, std\partition_point, std\partition, std\prev_permutation, std\remove_if, std\remove, std\replace_if, std\replace, std\reverse, std\rotate_copy, std\rotate, std\search_n, std\search, std\set_difference, std\set_intersection, std\set_symmetric_difference, std\set_union, std\shuffle, std\sort_heap, std\sort, std\stable_sort, std\swap_ranges, std\swap, std\transform, std\unique_copy, std\unique, std\upper_bound</sup></sub>

```php
...
// unique

$v = std\make_vector(1, 2, 3, 1, 2, 3, 3, 4, 5, 4, 5, 6, 7);

std\sort($v->begin(), $v->end());
// [ 1, 1, 2, 2, 3, 3, 3, 4, 4, 5, 5, 6, 7 ]

$last = std\unique($v->begin(), $v->end());
// [ 1, 2, 3, 4, 5, 6, 7, x, x, x, x, x, x ]

$v->erase($last, $v->end());

std\cout($v)(std\endl);
// [ 1, 2, 3, 4, 5, 6, 7 ]

...

// rotate_copy

$sv = std\make_vector(1, 2, 3, 4, 5);
$pv = std\find($sv->begin(), $sv->end(), 3);
// pv offset 2

$dv = std\make_vector();
std\rotate_copy(
	  $sv->begin()
	, $pv
	, $sv->end()
	, std\back_inserter($dv)
);

std\cout($dv)(std\endl);
// [ 3 4 5 1 2 ]

$v = std\make_vector(2, 7, 3, 9, 4);
$lcm = std\span_lcm($v->begin(), $v->end());
std\cout($lcm)(std\endl);

...

$v  = std\make_vector(1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4);
$t1 = std\make_vector(1, 2, 3);
$t2 = std\make_vector(4, 5, 6);

$r = std\find_end($v->begin(), $v->end(), $t1->begin(), $t1->end());
if ($r == $v->end()) {
	std\cout("subsequence not found")(std\endl);
} else {
	std\cout("last subsequence is at: ")(std\distance($v->begin(), $r))(std\endl);
}
// last subsequence is at: 8

$r = std\find_end($v->begin(), $v->end(), $t2->begin(), $t2->end());
if ($r == $v->end()) {
	std\cout("subsequence not found")(std\endl);
} else {
	std\cout("last subsequence is at: ")(std\distance($v->begin(), $r))(std\endl);
}
// subsequence not found

...

$v1 = std\make_vector(1, 2, 3, 4, 5);
$v2 = std\make_vector(3, 4, 5, 6, 7);
$d0 = std\make_vector();

std\set_union(
	  $v1->begin()
	, $v1->end()
	, $v2->begin()
	, $v2->end()
	, std\front_inserter($d0)
);

$it = $d0->begin();
while ($it != $d0->end()) {
	std\cout($it->second())(std\space);
	$it->next();
}
std\cout(std\endl);
// 7 6 5 4 3 2 1

...

```

#### | Functional / Functors
A mixture of existing features and overloads.
```php

...

function fn(int $one, string $two, float $three, int $four) { 
	std\cerr(
		  $one 
		. std\endl
		. $two
		. std\endl
		. $three
		. std\endl
		. $four
		. std\endl
	);
}

$fn = std\bind(
	  std\bond('fn')
	, std\placeholders::_1
	, "hello"
	, std\placeholders::_3
	, -123
);

std\invoke($fn, 1, 0.8);
std\invoke($fn, 4, -0.1333);

...

$v = std\make_vector(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
$pv = std\partition(
	  $v->begin()
	, $v->end()
	, function(int $i) {
		return (($i % 2) === 0);
	}
);

$p_even = std\make_vector();
$p_odd  = std\make_vector();

std\copy($v->begin(), $pv, std\back_inserter($p_even));
std\copy($pv, $v->end(), std\front_inserter($p_odd));

std\cout($p_even)(std\endl);
// [ 0 8 2 6 4 ]

std\cout($p_odd)(std\endl);
// [ 9 1 7 3 5 ]

std\cout($v)(std\endl);
// [ 0 8 2 6 4 5 3 7 1 9 ]

...

```

#### | Locale
A mixture of existing features and overloads, inspired by Boost.Locale.

### Requirements
PHP7 built with:
- Internationalization Functions (`ICU`).
- Multibyte String Functions (`mb_string`).

# Files

### Base API
[scl_api_algorithm](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_algorithm.php?ts=3)<br>
[scl_api_baselib](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_baselib.php?ts=3)<br>
[scl_api_complex](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_complex.php?ts=3)<br>
[scl_api_container_traits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_container_traits.php?ts=3)<br>
[scl_api_endian](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_endian.php?ts=3)<br>
[scl_api_errno](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_errno.php?ts=3)<br>
[scl_api_exception](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_exception.php?ts=3)<br>
[scl_api_io](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_io.php?ts=3)<br>
[scl_api_iterator_traits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_iterator_traits.php?ts=3)<br>
[scl_api_locale](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_locale.php?ts=3)<br>
[scl_api_math](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_math.php?ts=3)<br>
[scl_api_mathdefs](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_mathdefs.php?ts=3)<br>
[scl_api_numeric](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_numeric.php?ts=3)<br>
[scl_api_operator_traits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_operator_traits.php?ts=3)<br>
[scl_api_ostype](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_ostype.php?ts=3)<br>
[scl_api_random](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_random.php?ts=3)<br>
[scl_api_signal](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_signal.php?ts=3)<br>
[scl_api_string](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_string.php?ts=3)<br>
[scl_api_time](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_time.php?ts=3)<br>
[scl_api_timezone](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_timezone.php?ts=3)<br>
[scl_api_unilib](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_unilib.php?ts=3)<br>
[scl_api_utility_traits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_utility_traits.php?ts=3)<br>
[scl_api_utsname](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_utsname.php?ts=3)<br>

### Basic implementation
[scl_basic_dict](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_dict.php?ts=3)<br>
[scl_basic_exception](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_exception.php?ts=3)<br>
[scl_basic_forward_list](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_forward_list.php?ts=3)<br>
[scl_basic_ios](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_ios.php?ts=3)<br>
[scl_basic_irange](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_irange.php?ts=3)<br>
[scl_basic_iterable](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_iterable.php?ts=3)<br>
[scl_basic_iterator](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_iterator.php?ts=3)<br>
[scl_basic_ordered_list](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_ordered_list.php?ts=3)<br>
[scl_basic_ordered_map](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_ordered_map.php?ts=3)<br>
[scl_basic_ordered_set](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_ordered_set.php?ts=3)<br>
[scl_basic_ratio](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_ratio.php?ts=3)<br>
[scl_basic_tuple](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_tuple.php?ts=3)<br>
[scl_basic_u8string](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_u8string.php?ts=3)<br>
[scl_basic_utility](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_utility.php?ts=3)<br>
[scl_basic_vector](https://github.com/moe123/abraxas/blob/master/scl/base/scl_basic_vector.php?ts=3)<br>

### Implementation
[scl_algorithm](https://github.com/moe123/abraxas/blob/master/scl/base/scl_algorithm.php?ts=3)<br>
[scl_any](https://github.com/moe123/abraxas/blob/master/scl/base/scl_any.php?ts=3)<br>
[scl_collation](https://github.com/moe123/abraxas/blob/master/scl/base/scl_collation.php?ts=3)<br>
[scl_collator](https://github.com/moe123/abraxas/blob/master/scl/base/scl_collator.php?ts=3)<br>
[scl_complex](https://github.com/moe123/abraxas/blob/master/scl/base/scl_complex.php?ts=3)<br>
[scl_dict](https://github.com/moe123/abraxas/blob/master/scl/base/scl_dict.php?ts=3)<br>
[scl_forward_list](https://github.com/moe123/abraxas/blob/master/scl/base/scl_forward_list.php?ts=3)<br>
[scl_functional](https://github.com/moe123/abraxas/blob/master/scl/base/scl_functional.php?ts=3)<br>
[scl_iostream](https://github.com/moe123/abraxas/blob/master/scl/base/scl_iostream.php?ts=3)<br>
[scl_irange](https://github.com/moe123/abraxas/blob/master/scl/base/scl_irange.php?ts=3)<br>
[scl_istream](https://github.com/moe123/abraxas/blob/master/scl/base/scl_istream.php?ts=3)<br>
[scl_iterator](https://github.com/moe123/abraxas/blob/master/scl/base/scl_iterator.php?ts=3)<br>
[scl_locale](https://github.com/moe123/abraxas/blob/master/scl/base/scl_locale.php?ts=3)<br>
[scl_numeric_limits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_numeric_limits.php?ts=3)<br>
[scl_numeric](https://github.com/moe123/abraxas/blob/master/scl/base/scl_numeric.php?ts=3)<br>
[scl_ordered_list](https://github.com/moe123/abraxas/blob/master/scl/base/scl_ordered_list.php?ts=3)<br>
[scl_ordered_set](https://github.com/moe123/abraxas/blob/master/scl/base/scl_ordered_set.php?ts=3)<br>
[scl_ostream](https://github.com/moe123/abraxas/blob/master/scl/base/scl_ostream.php?ts=3)<br>
[scl_pair](https://github.com/moe123/abraxas/blob/master/scl/base/scl_pair.php?ts=3)<br>
[scl_quad](https://github.com/moe123/abraxas/blob/master/scl/base/scl_quad.php?ts=3)<br>
[scl_quint](https://github.com/moe123/abraxas/blob/master/scl/base/scl_quint.php?ts=3)<br>
[scl_random](https://github.com/moe123/abraxas/blob/master/scl/base/scl_random.php?ts=3)<br>
[scl_ratio](https://github.com/moe123/abraxas/blob/master/scl/base/scl_ratio.php?ts=3)<br>
[scl_system_error](https://github.com/moe123/abraxas/blob/master/scl/base/scl_system_error.php?ts=3)<br>
[scl_triad](https://github.com/moe123/abraxas/blob/master/scl/base/scl_triad.php?ts=3)<br>
[scl_tuple](https://github.com/moe123/abraxas/blob/master/scl/base/scl_tuple.php?ts=3)<br>
[scl_type_traits](https://github.com/moe123/abraxas/blob/master/scl/base/scl_type_traits.php?ts=3)<br>
[scl_u8string](https://github.com/moe123/abraxas/blob/master/scl/base/scl_u8string.php?ts=3)<br>
[scl_vector](https://github.com/moe123/abraxas/blob/master/scl/base/scl_vector.php?ts=3)<br>

# EOF