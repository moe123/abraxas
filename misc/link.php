<?php
# -*- coding: utf-8 -*-

declare (strict_types = 1);
declare (ticks        = 1);

set_include_path(
	  get_include_path()
	. PATH_SEPARATOR
	.'scl'
);

require_once "algorithm.php";
require_once "numeric.php";
require_once "ratio.php";
require_once "exception.php";
require_once "iostream.php";
require_once "irange.php";
require_once "locale.php";
require_once "vector.php";
require_once "ordered_list.php";
require_once "ordered_set.php";
require_once "forward_list.php";
require_once "random.php";

$dev = new std\random_device;

$fn = std\bond('entropy', $dev);
print_r($fn());
print_r($dev);
// std\xexit(0);

echo std\xformatln("{2} {1} '{'} {0}", "world", "hello", 0.4);

// print_r(std\is_callable(std\null_callable));
// print_r(std\is_callable(std\bond('std\xformat')));

$l = std\make_ratio(3, 4);
$r = std\make_ratio(2, -3);

$n = std\make_ratio(-0.66666666666667);

print_r($l);
print_r($r);
print_r($n);

//std\xexit(0);

$n1 = $l->num();
$d1 = $l->den();
$n2 = $r->num();
$d2 = $r->den();
std\_F_builtin_ratio_reduce($n1, $d1, $n2, $d2);

//std\cout($n1)("/")($d1)(std\tab)($n2)("/")($d2);

$a = std\ratio_subtract($l, $r);
print_r($a);

print_r($r);
print_r($l);

$a = std\ratio_subtract($r, $l);
print_r($a);

std\cout(std\endl);
//std\xexit(0);

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

//std\xexit(0);

std\cout(std\xnanoseconds())(std\endl);
foreach (std\xrange_n(1, 3) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

foreach (std\xrange_p(5, 9) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

foreach (std\xrange(8, 3) as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);

$rg = std\make_irange(8, 3);
$it = $rg->rbegin();

while ($it != $rg->rend()) {
	std\cout($it->second())(std\tab);
	$it->next();
}
std\cout(std\endl);

foreach ($rg as $i) {
	std\cout($i)(std\tab);
}
std\cout(std\endl);
std\cout(std\xnanoseconds())(std\endl);

//std\xexit(0);

$tb = std\make_timeb();
var_dump(std\tzset());
std\ftime($tb);
var_dump($tb);

$buf = "";
$tm0 = std\gmtime(std\time());
if (std\strftime($buf, "%d.%m.%Y.%z", $tm0)) {
	var_dump($tm0);
	$tm1 = std\make_tm();
	if (null != std\strptime($buf, "%d.%m.%Y.%z", $tm1)) {
		var_dump($tm1);
	}
}

$delay = std\make_timespec(0, 50000000);

var_dump(std\nanosleep($delay));
var_dump(std\endl);
var_dump(std\endl);
var_dump(std\gmtime(std\time()));
var_dump(std\endl);
var_dump(std\localtime(std\time()));
var_dump(std\endl);

// std\abort();

function trap()
{ std\assert(3 == 2); }
// trap();
std\assert(2 == 2);

$v = std\make_vector(0, 1 , 2);
std\place_fill_n(
	  std\front_inserter($v)
	, 5
	, 8
);

std\place_generate_n(
	  std\front_inserter($v)
	, 5
	, std\random_int_generator(100, 200)
);

std\place_generate_n(
	  std\back_inserter($v)
	, 5
	, std\random_int_generator(-300, 500)
);

std\place_generate_n(
	  std\back_inserter($v)
	, 8
	, std\random_real_generator(-1.2, 1.3)
);

std\cout($v);

function fn(int $one, string $two, bool $three, int $four) { 
	std\cerr($one, std\ios_base::hex)(std\endl)
		($two)(std\endl)
			($three, std\ios_base::alpha)(std\endl)
			($three)(std\endl)
				($four, std\ios_base::fixed)(std\endl);
}

$fn = std\bind(
	std\bond('fn')
	, std\placeholders::_1
	, "hello"
	, std\placeholders::_3
	, 0.00000099988888888
);

std\invoke($fn, 16, 0.8);
std\invoke($fn, 4, 0);

//\ini_set('log_errors', "1");
//\ini_set('display_errors', "1");

$sv = std\make_vector(1, 2, 3, 4, 5);
$pv = std\find($sv->begin(), $sv->end(), 3);
$dv = std\make_vector();
std\rotate_copy(
	  $sv->begin()
	, $pv
	, $sv->end()
	, std\back_inserter($dv)
);
std\cout($dv)(std\endl);

$v = std\make_vector();
$v->reserve(10, std\ignore);

std\cout($v)(std\endl);

$v = std\make_vector(2, 7, 3, 9, 4);

//print_r($v->begin());
print_r($v->rbegin());
//print_r($v->end());
print_r($v->rend());
std\cout(
	std\lcm_r($v->begin(), $v->end(5))
)(std\endl);

$v  = std\make_vector(1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3);
$t1 = std\make_vector(1, 2, 3);
$t2 = std\make_vector(4, 5, 6);

$r = std\find_end($v->begin(), $v->end(), $t1->begin(), $t1->end());
if ($r == $v->end()) {
	std\cout("subsequence not found")(std\endl);
} else {
	std\cout("last subsequence is at: ")(std\distance($v->begin(), $r))(std\endl);
}

$r = std\find_end($v->begin(), $v->end(), $t2->begin(), $t2->end());
if ($r == $v->end()) {
	std\cout("subsequence not found")(std\endl);
} else {
	std\cout("last subsequence is at: ")(std\distance($v->begin(), $r))(std\endl);
}

$v1 = std\make_vector('a', 'b', 'c', 'f', 'h', 'x');
$v2 = std\make_vector('a', 'b', 'c');
$v3 = std\make_vector('a', 'c');
$v4 = std\make_vector('g');
$v5 = std\make_vector('a', 'c', 'g');
$v6 = std\make_vector('A', 'B', 'C');

function cmp_nocase($l , $r)
{ return \strtolower($l) < \strtolower($r); }

foreach ($v2 as $i) {
	std\cout($i)(std\space);
}
std\cout(": ")
	(std\includes($v1->begin(), $v1->end(), $v2->begin(), $v2->end()))
(std\endl);

foreach ($v3 as $i) {
	std\cout($i)(std\space);
}
std\cout(": ")
	(std\includes($v1->begin(), $v1->end(), $v3->begin(), $v3->end()))
(std\endl);

foreach ($v4 as $i) {
	std\cout($i)(std\space);
}
std\cout(": ")
	(std\includes($v1->begin(), $v1->end(), $v4->begin(), $v4->end()))
(std\endl);

foreach ($v5 as $i) {
	std\cout($i)(std\space);
}
std\cout(": ")
	(std\includes($v1->begin(), $v1->end(), $v5->begin(), $v5->end()))
(std\endl);

foreach ($v6 as $i) {
	std\cout($i)(std\space);
}
std\cout(": ")
	(std\includes($v1->begin(), $v1->end(), $v6->begin(), $v6->end(), std\bond('cmp_nocase')))
(std\endl);

$v = std\make_vector(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
std\cout("Original vector: ")(std\endl);
foreach ($v as $i) {
	std\cout($i)(std\space);
}
std\cout(std\endl);
std\cout("Partition: ")(std\endl);
$pv = std\partition(
	  $v->begin()
	, $v->end()
	, function(int $i) { return (($i % 2) === 0); }
);

$p_even = std\make_vector();
$p_odd  = std\make_vector();

print_r($pv);

std\copy($v->begin(), $pv, std\back_inserter($p_even));
std\copy(
	  std\iterator_copy($pv)
	, $v->end()
	, std\front_inserter($p_odd)
);

print_r($p_even);
print_r($p_odd);
print_r($v);

$f1_even = std\make_ordered_list();
$f2_even = std\make_forward_list();
$f3_even = std\make_ordered_list();
$f4_even = std\make_forward_list();

std\copy($v->begin(), $pv, std\pair_iterator(
	std\pair_iterator(
		  std\back_inserter($f1_even)
		, std\front_inserter($f2_even)
	),
	std\pair_iterator(
		  std\back_inserter($f3_even)
		, std\front_inserter($f4_even)
	)
));

print_r($f1_even);
print_r($f2_even);
print_r($f3_even);
print_r($f4_even);

print_r(std\utf8_glyph_split("Ilık süt", 3));
print_r(std\utf8_glyph_split("hello"));
print_r(std\utf8_glyph_substring("Ilık süt", 2, 3));

/* EOF */