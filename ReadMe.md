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


#### [*] Brief
A Standard Container Library (`SCL`) influenced and freely inspired by the `C++ Standard Library` 
and the `C++ STL`. Providing the same five main components: `Algorithms`, `Containers`, `Functional`, `Iterators` and `Locale`.
(I/O and stream will come later i.e once the core-library is stable and meets the author expectations and satisfaction).

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

#### [*] Caveats
In PHP, one of the difficulties is the lack of logical operator overloads on object, thus we adopted counterbalanced 
measures and designs such as adding more comparator callbacks in the `Algorithms` component.
We try as much as we can to re-introduce type safety on any internal structures (∩｀-´)⊃━☆ﾟ.*･｡ﾟ.

#### [*] Containers
It contains sequence containers and associative containers and maybe in the future public 
container adaptors: `forward_list`, `tuple`, `seq_list`, `vector`, `map`, `dict`, `set` are almost done.

```php

$l  = std\make_seq_list(
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

std\sort_r(std\begin($l), std\end($l), std\make_locale("fr_FR.UTF-8"));

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

#### [*] Iterators
Abraxas implements five different types of iterators: `Forward-Bidirectional`, `Reverse-Bidirectional`, `Back-Inserter`, `Front-Inserter` and `Pair-Iterator`. Like the `C++ STL`, Abraxas `Iterators` implementation is now fully opaque to the `Algorithms` component. `Iterators` have a `first()` and `second()` member ; where `first()` is the key or numerical index (depends on the container category) and `second()` the value.

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

foreach (std\xrange(8, 10, 2) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

foreach (std\xrange(8, 10, -2) as $i) {
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

// pair_iterator madness

$c1 = std\make_ordered_list();
$c2 = std\make_forward_list();
$c3 = std\make_ordered_list();
$c4 = std\make_forward_list();

std\copy($v->begin(2), $v->begin(4), std\pair_iterator(
	std\pair_iterator(
		  std\back_inserter($c1)
		, std\front_inserter($c2)
	),
	std\pair_iterator(
		  std\back_inserter($c3)
		, std\front_inserter($c4)
	)
));

```

#### [*] Algorithms
A large number of algorithms have been already written, in the same way than `C++ STL`, it requires
a certain type of iterator. The design is an hybrid one, tacking advantages of 
existing builtin functions (not always, depends on performances, zero-copying / COW and what can 
be done in the most elegant way. The author choices control entirely the outcome of those; anyhow, 
this is transparent to the end-user).

It should be noted that unlike the `C++ STL`, for convenience, (as everything is handled 
at runtime) `Iterators` are in a exhausted state after use (avoiding explicit parameter copies 
or intrusive hidden offset resets). Thus ; they can be reused ; @see `begin_p` or `end_p`
(however, for well-known reasons, reusing `Inserters` or `Pair-Iterators` is placed in the `undefined behavior` category ¯\\_(ツ)_/¯ ).

```php
...
// unique_r

$v = std\make_vector(1, 2, 3, 1, 2, 3, 3, 4, 5, 4, 5, 6, 7);

std\sort_r($v->begin(), $v->end());
// [ 1, 1, 2, 2, 3, 3, 3, 4, 4, 5, 5, 6, 7 ]

$last = std\unique_r($v->begin(), $v->end());
// [ 1, 2, 3, 4, 5, 6, 7, x, x, x, x, x, x ]

$v->erase_r($last, $v->end());

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
$lcm = std\lcm_r($v->begin(), $v->end());
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

```

#### [*] Functional / Functors
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

#### [*] Locale
A mixture of existing features and overloads, inspired by Boost.Locale.

### Requirements
PHP7 built with:
- Internationalization Functions (`ICU`).
- Multibyte String Functions (`mb_string`).

### Files

##### Suitable syscalls
> [_scl_xendian](./scl/bits/_scl_xendian.php?ts=3)<br>
> [_scl_xerrno](./scl/bits/_scl_xerrno.php?ts=3)<br>
> [_scl_xlocale](./scl/bits/_scl_xlocale.php?ts=3)<br>
> [_scl_xostype](./scl/bits/_scl_xostype.php?ts=3)<br>
> [_scl_xsignal](./scl/bits/_scl_xsignal.php?ts=3)<br>
> [_scl_xstdio](./scl/bits/_scl_xstdio.php?ts=3)<br>
> [_scl_xstdlib](./scl/bits/_scl_xstdlib.php?ts=3)<br>
> [_scl_xstring](./scl/bits/_scl_xstring.php?ts=3)<br>
> [_scl_xtime](./scl/bits/_scl_xtime.php?ts=3)<br>
> [_scl_xtimezone](./scl/bits/_scl_xtimezone.php?ts=3)<br>
> [_scl_xunistd](./scl/bits/_scl_xunistd.php?ts=3)<br>
> [_scl_xutsname](./scl/bits/_scl_xutsname.php?ts=3)<br>

##### Base container and API bindings
> [_scl_xalgorithm](./scl/bits/_scl_xalgorithm.php?ts=3)<br>
> [_scl_xcontainer_traits](./scl/bits/_scl_xcontainer_traits.php?ts=3)<br>
> [_scl_xiterator_traits](./scl/bits/_scl_xiterator_traits.php?ts=3)<br>
> [_scl_xoperator_traits](./scl/bits/_scl_xoperator_traits.php?ts=3)<br>
> [_scl_xutility_traits](./scl/bits/_scl_xutility_traits.php?ts=3)<br>

##### Basic implementation
> [basic_dict](./scl/bits/scl_basic_dict.php?ts=3)<br>
> [basic_exception](./scl/bits/scl_basic_exception.php?ts=3)<br>
> [basic_forward_list](./scl/bits/scl_basic_forward_list.php?ts=3)<br>
> [basic_ios](./scl/bits/scl_basic_ios.php?ts=3)<br>
> [basic_irange](./scl/bits/scl_basic_irange.php?ts=3)<br>
> [basic_iteratable](./scl/bits/scl_basic_iteratable.php?ts=3)<br>
> [basic_ordered_list](./scl/bits/scl_basic_ordered_list.php?ts=3)<br>
> [basic_ordered_map](./scl/bits/scl_basic_ordered_map.php?ts=3)<br>
> [basic_ordered_set](./scl/bits/scl_basic_ordered_set.php?ts=3)<br>
> [basic_ratio](./scl/bits/scl_basic_ratio.php?ts=3)<br>
> [basic_tuple](./scl/bits/scl_basic_tuple.php?ts=3)<br>
> [basic_utility](./scl/bits/scl_basic_utility.php?ts=3)<br>
> [basic_vector](./scl/bits/scl_basic_vector.php?ts=3)<br>

##### Implementation
> [algorithm](./scl/bits/scl_algorithm.php?ts=3)<br>
> [collation](./scl/bits/scl_collation.php?ts=3)<br>
> [collator](./scl/bits/scl_collator.php?ts=3)<br>
> [dict](./scl/bits/scl_dict.php?ts=3)<br>
> [forward_list](./scl/bits/scl_forward_list.php?ts=3)<br>
> [functional](./scl/bits/scl_functional.php?ts=3)<br>
> [iostream](./scl/bits/scl_iostream.php?ts=3)<br>
> [irange](./scl/bits/scl_irange.php?ts=3)<br>
> [istream](./scl/bits/scl_istream.php?ts=3)<br>
> [iterator](./scl/bits/scl_iterator.php?ts=3)<br>
> [locale](./scl/bits/scl_locale.php?ts=3)<br>
> [numeric_limits](./scl/bits/scl_numeric_limits.php?ts=3)<br>
> [numeric](./scl/bits/scl_numeric.php?ts=3)<br>
> [ordered_list](./scl/bits/scl_ordered_list.php?ts=3)<br>
> [ordered_set](./scl/bits/scl_ordered_set.php?ts=3)<br>
> [ostream](./scl/bits/scl_ostream.php?ts=3)<br>
> [pair](./scl/bits/scl_pair.php?ts=3)<br>
> [quad](./scl/bits/scl_quad.php?ts=3)<br>
> [quint](./scl/bits/scl_quint.php?ts=3)<br>
> [random](./scl/bits/scl_random.php?ts=3)<br>
> [ratio](./scl/bits/scl_ratio.php?ts=3)<br>
> [system_error](./scl/bits/scl_system_error.php?ts=3)<br>
> [triad](./scl/bits/scl_triad.php?ts=3)<br>
> [tuple](./scl/bits/scl_tuple.php?ts=3)<br>
> [type_traits](./scl/bits/scl_type_traits.php?ts=3)<br>
> [u8string](./scl/bits/scl_u8string.php?ts=3)<br>
> [vector](./scl/bits/scl_vector.php?ts=3)<br>

##### Public front-end
> [algorithm](./scl/algorithm.php?ts=3)<br>
> [collator](./scl/collator.php?ts=3)<br>
> [dict](./scl/dict.php?ts=3)<br>
> [exception](./scl/exception.php?ts=3)<br>
> [forward_list](./scl/forward_list.php?ts=3)<br>
> [functional](./scl/functional.php?ts=3)<br>
> [iostream](./scl/iostream.php?ts=3)<br>
> [irange](./scl/irange.php?ts=3)<br>
> [iterator](./scl/iterator.php?ts=3)<br>
> [limits](./scl/limits.php?ts=3)<br>
> [locale](./scl/locale.php?ts=3)<br>
> [numeric](./scl/numeric.php?ts=3)<br>
> [ordered_list](./scl/ordered_list.php?ts=3)<br>
> [ordered_set](./scl/ordered_set.php?ts=3)<br>
> [random](./scl/random.php?ts=3)<br>
> [ratio](./scl/ratio.php?ts=3)<br>
> [tuple](./scl/tuple.php?ts=3)<br>
> [vector](./scl/vector.php?ts=3)<br>

# EOF