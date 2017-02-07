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
We try as much as we can to re-introduce type safety on any internal structures.

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
	, std\urandom(100, 200)
);

std\place_generate_n(
	  std\back_inserter($v)
	, 5 
	, std\urandom(300, 500)
);

std\cout($v);

```

#### [*] Iterators
Abraxas implements four different types of iterators: Forward-Bidirectional, Reverse-Bidirectional, Back-Inserter and 
Front-Inserter. Like the `C++ STL`, Abraxas `Iterators` implementation is now fully opaque to the `Algorithms` component. 
`Iterators` have a `first()` and `second()` member ; where `first()` is the key or numerical index (depends on the container 
category) and `second()` the value.

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

```

#### [*] Algorithms
A large number of algorithms have been already written, in the same way than `C++ STL`, it requires
a certain type of iterator. The design is an hybrid one, tacking advantages of 
existing builtin functions (not always, depends on performances, zero-copying / COW and what can 
be done in the most elegant way. The author choices control entirely the outcome of those; anyhow, 
this is transparent to the end-user). Unlike the `C++ STL`, for convenience, (as everything is handled 
at runtime) `Iterators` are in a exhausted state after use (avoiding explicit parameter copies 
or intrusive hidden offset resets). Thus ; they can be reused ; @see `begin_p` or `end_p`
(however, for well-known reasons, reusing `Inserters` is placed in the `undefined behavior` category ¯\_(ツ)_/¯ ).

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
	  std\bond1('fn')
	, std\placeholders::_1
	, "hello"
	, std\placeholders::_3
	, -123
);

std\invoke($fn, 1, 0.8);
std\invoke($fn, 4, -0.1333);

...

```

#### [*] Locale
A mixture of existing features and overloads, inspired by Boost.Locale.

### Requirements
PHP7 built with:
- Internationalization Functions (`ICU`).
- Multibyte String Functions (`mb_string`).

### Files

##### Base container and API bindings
> [___scl_base_algorithm](./scl/bits/___scl_base_algorithm.php)<br>
> [___scl_base_container_traits](./scl/bits/___scl_base_container_traits.php)<br>
> [___scl_base_endian](./scl/bits/___scl_base_endian.php)<br>
> [___scl_base_iterator_traits](./scl/bits/___scl_base_iterator_traits.php)<br>
> [___scl_base_operator_traits](./scl/bits/___scl_base_operator_traits.php)<br>
> [___scl_base_utility_traits](./scl/bits/___scl_base_utility_traits.php)<br>

##### Suitable syscalls
> [___scl_cerrno](./scl/bits/___scl_cerrno.php)<br>
> [___scl_clocale](./scl/bits/___scl_clocale.php)<br>
> [___scl_csignal](./scl/bits/___scl_csignal.php)<br>
> [___scl_cstdio](./scl/bits/___scl_cstdio.php)<br>
> [___scl_cstdlib](./scl/bits/___scl_cstdlib.php)<br>
> [___scl_cstring](./scl/bits/___scl_cstring.php)<br>
> [___scl_ctime](./scl/bits/___scl_ctime.php)<br>
> [___scl_cunistd](./scl/bits/___scl_cunistd.php)<br>
> [___scl_cutsname](./scl/bits/___scl_cutsname.php)<br>

##### Basic implementation
> [scl_basic_dict](./scl/bits/scl_basic_dict.php)<br>
> [scl_basic_exception](./scl/bits/scl_basic_exception.php)<br>
> [scl_basic_forward_list](./scl/bits/scl_basic_forward_list.php)<br>
> [scl_basic_ios](./scl/bits/scl_basic_ios.php)<br>
> [scl_basic_iteratable](./scl/bits/scl_basic_iteratable.php)<br>
> [scl_basic_map](./scl/bits/scl_basic_map.php)<br>
> [scl_basic_seqlist](./scl/bits/scl_basic_seqlist.php)<br>
> [scl_basic_set](./scl/bits/scl_basic_set.php)<br>
> [scl_basic_tuple](./scl/bits/scl_basic_tuple.php)<br>
> [scl_basic_utility](./scl/bits/scl_basic_utility.php)<br>
> [scl_basic_vector](./scl/bits/scl_basic_vector.php)<br>

##### Implementation
> [scl_algorithm](./scl/bits/scl_algorithm.php)<br>
> [scl_collation](./scl/bits/scl_collation.php)<br>
> [scl_collator](./scl/bits/scl_collator.php)<br>
> [scl_dict](./scl/bits/scl_dict.php)<br>
> [scl_forward_list](./scl/bits/scl_forward_list.php)<br>
> [scl_functional](./scl/bits/scl_functional.php)<br>
> [scl_iostream](./scl/bits/scl_iostream.php)<br>
> [scl_istream](./scl/bits/scl_istream.php)<br>
> [scl_iterator](./scl/bits/scl_iterator.php)<br>
> [scl_locale](./scl/bits/scl_locale.php)<br>
> [scl_numeric_limits](./scl/bits/scl_numeric_limits.php)<br>
> [scl_ostream](./scl/bits/scl_ostream.php)<br>
> [scl_pair](./scl/bits/scl_pair.php)<br>
> [scl_quad](./scl/bits/scl_quad.php)<br>
> [scl_quint](./scl/bits/scl_quint.php)<br>
> [scl_seqlist](./scl/bits/scl_seqlist.php)<br>
> [scl_set](./scl/bits/scl_set.php)<br>
> [scl_system_error](./scl/bits/scl_system_error.php)<br>
> [scl_triad](./scl/bits/scl_triad.php)<br>
> [scl_tuple](./scl/bits/scl_tuple.php)<br>
> [scl_type_traits](./scl/bits/scl_type_traits.php)<br>
> [scl_u8string](./scl/bits/scl_u8string.php)<br>
> [scl_vector](./scl/bits/scl_vector.php)<br>

##### Public front-end
> [algorithm](./scl/algorithm.php)<br>
> [dict](./scl/dict.php)<br>
> [exception](./scl/exception.php)<br>
> [forward_list](./scl/forward_list.php)<br>
> [functional](./scl/functional.php)<br>
> [iostream](./scl/iostream.php)<br>
> [iterator](./scl/iterator.php)<br>
> [limits](./scl/limits.php)<br>
> [locale](./scl/locale.php)<br>
> [seqlist](./scl/seqlist.php)<br>
> [set](./scl/set.php)<br>
> [tuple](./scl/tuple.php)<br>
> [vector](./scl/vector.php)<br>

# EOF