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
```

@see [Complex](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_complex.php?ts=3)<br>
<sub><sup>std\creal, std\cimag, std\cabs, std\cnorm, std\carg, std\cexp, std\clog, std\clog10, std\cpow, std\csqrt, std\cconj, std\cproj, std\cpolar, std\cinv, std\cneg, std\cadd, std\csub, std\cmul, std\cdiv, std\cfadd, std\cfsub, std\cfmul, std\cfdiv, std\cfsqrt, std\csec, std\csech, std\ccsc, std\ccsch, std\ccot, std\ccoth, std\cacot, std\cacoth, std\ccos, std\csin, std\ctan, std\ccosh, std\csinh, std\ctanh, std\cacos, std\casin, std\catan, std\cacosh, std\casinh, std\catanh</sub></sup>

```php
/* Extended mathematical, trigonometric templates with complex support. */
```

@see [Math](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_math.php?ts=3) | [Mathdefs](https://github.com/moe123/abraxas/blob/master/scl/base/scl_api_mathdefs.php?ts=3)<br>
<sub><sup>std\setsigngam, std\signgam, std\fesetround, std\fpclassify, std\isnan, std\isnormal, std\isfinite, std\isinf, std\copysign, std\isgreater, std\isgreaterequal, std\isless, std\islessequal, std\islessgreater, std\isunordered, std\signbit, std\fabs, std\fmod, std\modf, std\fmax, std\fmin, std\fdim, std\fma, std\fdeg2rad, std\frad2deg, std\fsec, std\fcsc, std\fcot, std\fsech, std\fcsch, std\fcoth, std\facsc, std\fasec, std\facot, std\fasech, std\facsch, std\facoth, std\trunc, std\nearbyint, std\remainder, std\hypot, std\fact, std\abs, std\real, std\imag, std\arg, std\sec, std\csc, std\cot, std\sech, std\csch, std\coth, std\norm, std\conj, std\proj, std\polar, std\topolar, std\exp, std\exp2, std\expm1, std\pow, std\log, std\log2, std\log10, std\log1p, std\sqrt, std\cos, std\cosh, std\sin, std\sinh, std\tan, std\tanh, std\acos, std\acosh, std\asin, std\asinh, std\atan2, std\atan, std\atanh, std\cbrt, std\ftrt, std\nthrt, std\ceil, std\floor, std\round, std\lrint, std\logb, std\ilogb, std\lgamma_s, std\lgamma_r, std\lgamma, std\tgamma, std\beta, std\frexp, std\ldexp, std\erf, std\erfc, std\sincosf</sub></sup>

#### | Caveats
In PHP, one of the difficulties is the lack of logical operator overloads on object, thus we adopted counterbalanced 
measures and designs such as adding more comparator callbacks in the `Algorithms` component.
We try as much as we can to re-introduce type safety on any internal structures (∩｀-´)⊃━☆ﾟ.*･｡ﾟ.

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
Abraxas implements five different types of iterators: `Forward-Bidirectional`, `Reverse-Bidirectional`, `Back-Inserter`, `Front-Inserter` and `Zip-Iterator`. Like the `C++ STL`, Abraxas `Iterators` implementation is now fully opaque to the `Algorithms` component. `Iterators` have a `first()` and `second()` member ; where `first()` is the key or numerical index (depends on the container category) and `second()` the value.

@Note: unlike the STL, we use `forward` as opposed to `reverse` ; every Abraxas `Iterators` are by design `bidirectional`, `inputtable` and `random accessible` i.e their functions are driven by usage not by implementation.

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

// zip_iterator

$c1 = std\make_ordered_list();
$c2 = std\make_forward_list();
$c3 = std\make_ordered_list();
$c4 = std\make_forward_list();

std\copy($v->begin(2), $v->begin(4), std\zip_iterator(
	  std\zip_iterator(
		  std\back_inserter($c1)
		, std\front_inserter($c2)
	  )
	, std\zip_iterator(
		  std\back_inserter($c3)
		, std\front_inserter($c4)
	  )
));

```

#### | Algorithms
A large number of algorithms have been already written <sub><sup>(1)</sup></sub>, in the same way than `C++ STL`, it requires
a certain type of iterator. The design is a hybrid one, tacking advantages of 
existing builtin functions (not always, depends on performances, zero-copying / COW and what can 
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