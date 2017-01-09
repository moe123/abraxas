# Abraxas
A digression to the world of scripting languages and PHP.

#### Brief
A Standard Container Library (`SCL`) influenced and freely inspired by the `C++ Standard Library` 
and the `C++ STL`. Providing the same five main components: `Algorithms`, `Containers`, `Functional`, `Iterators` and `Locale`.
(I/O and stream will come later i.e once the core-library is stable and meets the author expectations and satisfaction).

```php

$buf;

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

#### Caveats
In PHP, one of the difficulties is the lack of logical operator overloads on object, thus we adopted counterbalanced 
measures and designs such as adding more comparator callbacks in the `Algorithms` component. However, by default, we compare 
on type and value, hence re-introducing type safety on any internal structures.

#### Containers
It contains sequence containers and associative containers and maybe in the future public 
container adaptors: `forward_list`, `tuple`, `seq_list`, `vector`, `map`, `dict`, `set` are almost done.

```php

$v  = std\make_vector(1, 2, 3, 4, 5, 6, 7, 8, 9);

$it = $v->rbegin();

while ($it != $v->rend()) {
	std\cout($it->second())(" ");
	$it->advance(2);
}

std\cout(std\endl);

...

$it = std\begin($v, 1);

while ($it != std\end($v)) {
	std\cout($it->second())(" ");
	$it->next();
}

std\cout(std\endl);

...

$pos = std\find(std\begin_p($it), std\end($v), 3);

if ($pos != std\end($v)) {
	std\cout("\$v contains: 3")(std\endl);
}

$v  = std\make_vector(
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

std\sort(std\begin($v), std\end($v), std\make_locale("fr_FR.UTF-8"));

...

```

#### Iterators
Abraxas implements four different types of iterators:
Forward-Bidirectional, Reverse-Bidirectional, Back-Inserter and Front-Inserter.
Unlike the `C++ STL`, Abraxas `Iterators` implementation is not opaque to the `Algorithms` component.
Abraxas takes advantage of the internal container structure. All `Iterators` have a `first()` and `second()` member ; 
where `first()` is the key or index (depends on the container category) and `second()` the value.

#### Algorithms
A large number of algorithms have been already written, in the same way than `C++ STL`, it requires
a certain type of iterator. The design is an hybrid one, tacking advantages of 
existing builtin functions (not always, depends on performances, zero-copying/COW and what can 
be done in the most elegant way. The author choices control entirely the outcome of those; anyhow, 
this is transparent to the end-user).

#### Functors
A mixture of existing features and overloads.
```php

...

function not1(callable $f___)
{
	return function () use ($f___) {
		return !$f___(func_get_arg(0));
	};
}

function not2(callable $f___)
{
	return function () use ($f___) {
		return !$f___(func_get_arg(0), func_get_arg(1));
	};
}

function not_fn(callable $f___)
{
	return function () use ($f___) {
		return !call_user_func_array($f___, func_get_args());
	};
}

function invoke(callable $f___, ...$args___)
{
	if (\is_array($args___) && \count($args___)) {
		return call_user_func_array($f___, $args___);
	}
	return $f___();
}

function bond($cls___, string $f___)
{ return [$cls___, $f___]; }

function bind(callable $f___, ...$args___)
{
	return function () use ($f___, $args___) {
		if (\is_array($args___) && \count($args___)) {
			return call_user_func_array($f___, $args___);
		}
		return $f___();
	 };
}

...

```

#### Locale
A mixture of existing features and overloads, inspired by Boost.Locale.

### Requirements
PHP7 built with:
- Internationalization Functions (`ICU`).
- Multibyte String Functions (`mb_string`).

# EOF