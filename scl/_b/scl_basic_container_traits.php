<?php
# -*- coding: utf-8 -*-

//
// scl_basic_container_traits.php
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
	trait _T_langarray_container
	{
		var $_M_container = null;
		var $_M_size = -1;

		function __construct()
		{
			$this->_M_size = 0;
			$this->_M_container = [];
		}

		function __destruct()
		{
			$this->_M_size = 0;
			$this->_M_container = null;
		}
	} /* EOT */

	trait _T_langarray_mapreduce
	{
		function & enumerate(\Closure $f___, bool $r___ = false)
		{
			if ($this->_M_size) {
				if (static::container_category === forward_list) {
					$stop = false;
					if ($r___ === true) {
						for($i = $self->_M_size - 1; $i >= 0; $i--) {
							$val = $this->_F_get_at($this->_M_pos);
							$f___($key, $val, $stop);
							if ($stop) {
								break;
							}
						}
					} else {
						for($i = 0; $i < $self->_M_size; $i++) {
							$val = $this->_F_get_at($this->_M_pos);
							$f___($key, $val, $stop);
							if ($stop) {
								break;
							}
						}
					}
				} else {
					$stop = false;
					if ($r___ === true) {
						for (\end($this->_M_container); ($key = \key($this->_M_container)) !== null; \prev($this->_M_container)) {
							$val = \current($this->_M_container);
							$f___($key, $val, $stop);
							if ($stop) {
								break;
							}
						}
						\reset($this->_M_container);
					} else {
						foreach ($this->_M_container as $key => &$val) {
							$f___($key, $val, $stop);
							if ($stop) {
								break;
							}
						}
					}
				}
				return $this;
			}
		} /* EOT */

		/**
		* object map(\Closure $f___)
		* @param function (mixed $offset___, mixed $val) -> mixed (func)
		* @return object (new)
		*/
		function map(\Closure $f___)
		{
			$self = new static();
			if ($this->_M_size) {
				if (static::container_category === forward_list) {
					$a = array_map(
						  $f___
						, \range(0, $this->_M_size -1)
						, $this->_F_dump()
					);
					$self->_F_from_array($a);
				} else {
					$self->_M_container = array_map(
						  $f___
						, array_keys($this->_M_container)
						, $this->_M_container
					);
					if (static::container_category !== dict) {
						$self->_M_container = array_values($self->_M_container);
					}
					$self->_M_size = \count($self->_M_container);
				}
			}
			return $self;
		}

		/**
		* object filter(\Closure $f___)
		* @param function (mixed $offset___, mixed $val) -> bool (func)
		* @return object (new)
		*/
		function filter(\Closure $f___)
		{
			$self = new static();
			if ($this->_M_size) {
				if (static::container_category === forward_list) {
					$a = array_filter(
						  $this->_F_dump()
						, $f___
						, ARRAY_FILTER_USE_BOTH
					);
					$self->_F_from_array($a);
				} else {
					$self->_M_container = array_filter(
						  $this->_M_container
						, $f___
						, ARRAY_FILTER_USE_BOTH
					);
					if (static::container_category !== dict) {
						$self->_M_container = array_values($self->_M_container);
					}
					$self->_M_size = @count($self->_M_container);
				}
			}
			return $self;
		}

		/**
		* object reduce(\Closure $f___)
		* @param function (mixed $last , mixed $item) -> mixed (func)
		* @return object (new)
		*/
		function reduce(\Closure $f___)
		{
			$self = new static();
			if ($this->_M_size) {
				if (static::container_category === forward_list) {
					$self->_F_insert_last(
						array_reduce(
							  $this->_F_dump()
							, $f___
					));
				} else {
					$self->_M_container[] = array_reduce(
						  $this->_M_container
						, $f___
					);
					$self->_M_size = 1;
				}
			}
			return $self;
		}

		/**
		* object accumulate(\Closure $f___)
		* @param function (mixed $left , mixed $right) -> mixed (func)
		* @return object (new)
		*/
		function accumulate(\Closure $f___ = null)
		{
			$self = new static();
			if ($this->_M_size) {
				if (\is_null($f___)) {
					$f___ = function($l, $r) { return $l + $r; };
				}
				if (static::container_category === forward_list) {
					$self->_F_insert_last(
						array_reduce(
							  $this->_F_dump()
							, $f___
					));
				} else {
					$self->_M_container[] = array_reduce(
						  $this->_M_container
						, $f___
					);
					$self->_M_size = 1;
				}
			}
			return $self;
		}
	} /* EOT */

	trait _T_langarray_conformity
	{
		function _F_is_seq(array $container___, int $size___)
		{
			if (!$size___) {
				return true;
			}
			return array_keys($container___) === \range(0, $size___ - 1);
		}

		function _F_has_integer_keys(array $container___, int $size___)
		{
			if (!$size___) {
				return true;
			}
			return array_unique(
				array_map(
				  "\is_int"
				, array_keys($container___)
				)
			) === [ true ];
		}

		function _F_has_string_keys(array $container___, int $size___)
		{
			if (!$size___) {
				return true;
			}
			return array_unique(
				array_map(
				  "\is_string"
				, array_keys($container___)
				)
			) === [ true ];
		}

		function _F_has_object_keys(array $container___, int $size___)
		{
			if (!$size___) {
				return true;
			}
			return array_unique(
				array_map(
				  "\is_object"
				, array_keys($container___)
				)
			) === array(true);
		}

		function _F_is_assoc(array $container___, int $size___)
		{
			return (
				$this->_F_has_string_keys($container___, $size___) ||
				$this->_F_has_object_keys($container___, $size___) || 
				(
					$this->_F_has_integer_keys($container___, $size___) &&
					!$this->_F_is_seq($container___, $size___)
				)
			);
		}
	} /* EOT */

	trait _T_langarray_debug
	{
		function __debugInfo()
		{ return $this->_M_container; }
	} /* EOT */

	trait _T_langarray_serializable
	{
		function jsonSerialize()
		{ return $this->_M_container; }
	} /* EOT */

	trait _T_langarray_iterative
	{
		function getIterator()
		{ return new _C_fwditer_sequential_adaptor($this); }
	} /* EOT */

	trait _T_langarray_iterable
	{
		function begin(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			}
			return new _C_forward_iterator_langarray($this, $offset___);
		}

		function end(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
				if ($offset___ < 0) {
					$offset___ = 0;
				}
			}
			
			return new _C_forward_iterator_langarray($this, $offset___);
		}

		function rbegin($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
			}
			return new _C_reverse_iterator_langarray($this, $offset___);
		}

		function rend($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			} else {
				$offset___ = $this->_M_size - $offset___ - 1;
				if ($offset___ < -1) {
					$offset___ = -1;
				}
			}
			return new _C_reverse_iterator_langarray($this, $offset___);
		}

		function iterator()
		{ return new _C_forward_iterator_langarray($this, 0); }

		function reverse_iterator()
		{ return new _C_reverse_iterator_langarray($this, $this->_M_size); }
	} /* EOT */

	trait _T_countable
	{
		function count()
		{ return $this->_M_size; }
	} /* EOT */

	class _C_list_node
	{
		var $_M_data = null;
		var $_M_next = null;
		var $_M_prev = null;
	} /* EOC */

	trait _T_linkedlist_container
	{
		var $_M_f_node = null;
		var $_M_l_node = null;
		var $_M_container = null;
		var $_M_size = -1;

		function __construct()
		{
			$this->_M_size = 0;
			$this->_M_container = &$this;
		}

		function __destruct()
		{
			$this->_M_size = 0;
			$this->_M_container = null;
		}

		function _F_from_array(array &$a___, bool $assign = false)
		{
			if ($assign === true) {
				$this->_F_clear_all();
			}
			foreach ($a as &$v) {
				$this->_F_insert_last($v);
			}
		}

		function _F_swap(&$l___)
		{
			$fnode = $this->_M_f_node;
			$lnode = $this->_M_l_node;
			$sz = $this->_M_size;

			$this->_M_f_node = $l___->_M_f_node;
			$this->_M_l_node = $l___->_M_l_node;
			$this->_M_size = $l___->_M_size;

			$l___->_M_f_node = $fnode;
			$l___->_M_l_node = $lnode;
			$l___->_M_size = $sz;
		}

		function & _F_insert_first(&$d___)
		{
			$n = new _C_list_node;
			$n->_M_data = $d___;
			if ($this->_M_size < 1) {
				$this->_M_l_node = $n;
			} else {
				$this->_M_f_node->_M_prev = $n;
			}
			$n->_M_next = $this->_M_f_node;
			$this->_M_f_node = $n;
			++$this->_M_size;
			return $this;
		}

		function _F_insert_last(&$d___)
		{
			$n = new _C_list_node;
			$n->_M_data = $d___;
			if ($this->_M_size < 1) {
				$this->_M_f_node = $n;
			} else {
				$this->_M_l_node->_M_next = $n;
			}
			$n->_M_prev = $this->_M_l_node;
			$this->_M_l_node = $n;
			++$this->_M_size;
		}

		function _F_insert_after_data(&$p___, &$d___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				while ($c->_M_data != $p___) {
					$c = $c->_M_next;
					if ($c === null) {
						return false;
					}
				}
				$n = new _C_list_node;
				$n->_M_data = $d___;

				if ($c == $this->_M_l_node) {
					$n->_M_next = null;
					$this->_M_l_node = $n;
				} else {
					$n->_M_next = $c->_M_next;
					$c->_M_next->_M_prev = $n;
				}
				$n->_M_prev = $c;
				$c->_M_next = $n;
				++$this->_M_size;
				return true;
			}
			return false;
		}

		function _F_insert_at_index(int $i___, &$d___)
		{
			if ($i___ < 1) {
				$this->_F_insert_first($d___);
				return true;
			} elseif ($i___ >= $this->_M_size) {
				$this->_F_insert_last($d___);
				return true;
			}
			return $this->_F_insert_after_index($i___ -1, $d___);
		}

		function _F_insert_after_index(int $i___, &$d___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				if ($i___ >= $this->_M_size) {
					$i___ = $this->_M_size - 1;
				}
				$i = 0;
				while ($i < $i___) {
					$c = $c->_M_next;
					if ($c === null) {
						return false;
					}
					++$i;
				}

				$n = new _C_list_node;
				$n->_M_data = $d___;

				if ($c == $this->_M_l_node) {
					$n->_M_next = null;
					$this->_M_l_node = $n;
				} else {
					$n->_M_next = $c->_M_next;
					$c->_M_next->_M_prev = $n;
				}
				$n->_M_prev = $c;
				$c->_M_next = $n;
				++$this->_M_size;
				return true;
			}
			return false;
		}

		function _F_del_first()
		{
			if ($this->_M_size) {
				$tn = $this->_M_f_node;
				if ($this->_M_f_node->_M_next === null) {
					$this->_M_l_node = null;
				} else {
					$this->_M_f_node->_M_next->_M_prev = null;
				}
				$this->_M_f_node = $this->_M_f_node->_M_next;
				--$this->_M_size;
				return $tn;
			}
		}

		function _F_del_last()
		{
			if ($this->_M_size) {
				$tn = $this->_M_l_node;
				if ($this->_M_f_node->_M_next === null) {
					$this->_M_f_node = null;
				} else {
					$this->_M_l_node->_M_prev->_M_next = null;
				}
				$this->_M_l_node = $this->_M_l_node->_M_prev;
				--$this->_M_size;
				return $tn;
			}
			return null;
		}

		function _F_get_at(int $i___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				if ($i___ >= $this->_M_size) {
					$i___ = $i___ - ($this->_M_size - 1);
				}
				$i = 0;
				while ($i < $i___) {
					$c = $c->_M_next;
					if ($c === null) {
						return null;
					}
					++$i;
				}
				return $c->_M_data;
			}
			return null;
		}
		
		function _F_replace_data_at(int $i___, &$p___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				if ($i___ >= $this->_M_size) {
					$i___ = $i___ - ($this->_M_size - 1);
				}
				$i = 0;
				while ($i < $i___) {
					$c = $c->_M_next;
					if ($c === null) {
						return false;
					}
					++$i;
				}
				$c->_M_data = $p___;
			}
			return false;
		}

		function _F_find_data(&$p___)
		{
			$cnt = 0;
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				while ($c !== null) {
					$c = $c->_M_next;
					if ($c->_M_data == $p___) {
						++$cnt;
					}
				}
			}
			return $cnt;
		}

		function _F_index_of_data(&$p___, callable $f___ = null)
		{
			$f = $f___;
			if ($f___ == null) {
				$f = function(&$l, &$r) { return $l == $r; };
			}

			$r = -1;
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				while ($c !== null) {
					$c = $c->_M_next;
					if ($f($c->_M_data, $p___)) {
						return $r + 1;
					}
					++$r;
				}
			}
			return $r;
		}

		function _F_index_of_data_if(callable $f___ = null)
		{
			$f = $f___;
			if ($f___ === null) {
				$f = function(&$r) { return false; };
			}

			$r = -1;
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				while ($c !== null) {
					$c = $c->_M_next;
					if ($f($c->_M_data)) {
						return $r + 1;
					}
					++$r;
				}
			}
			return $r;
		}

		function _F_del_data(&$p___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				while ($c->_M_data != $p___) {
					$c = $c->_M_next;
					if ($c === null) {
						return $c;
					}
				}
				if ($c == $this->_M_f_node) {
					$this->_M_f_node = $c->_M_next;
				} else {
					$c->_M_prev->_M_next = $c->_M_next;
				}
				if ($c == $this->_M_l_node) {
					$this->_M_l_node = $c->_M_prev;
				} else {
					$c->_M_next->_M_prev = $c->_M_prev;
				}
				--$this->_M_size;
				return $c;
			}
			return null;
		}

		function _F_del_all_data(&$p___)
		{
			$cnt = $this->_F_find_data($p___);
			for ($i = 0; $i < $cnt; $i++) {
				$this->_F_del_data($p___);
			}
			return $cnt ? true : false;
		}

		function _F_del_at(int $i___)
		{
			if ($this->_M_size) {
				$c = $this->_M_f_node;
				if ($i___ >= $this->_M_size) {
					$i___ = $this->_M_size - 1;
				}
				$i = 0;
				while ($i < $i___) {
					$c = $c->_M_next;
					if ($c === null) {
						return $c;
					}
					++$i;
				}
				if ($c == $this->_M_f_node) {
					$this->_M_f_node = $c->_M_next;
				} else {
					$c->_M_prev->_M_next = $c->_M_next;
				}
				if ($c == $this->_M_l_node) {
					$this->_M_l_node = $c->_M_prev;
				} else {
					$c->_M_next->_M_prev = $c->_M_prev;
				}
				--$this->_M_size;
				return $c;
			}
			return null;
		}

		function _F_del_if(callable $f___)
		{
			$ret = false;
			$idx = [];
			for ($i = 0; $i < $this->_M_size; $i++) {
				$idx[] = $this->_F_index_of_data_if($f___);
			}
			foreach ($idx as &$v) {
				if ($v !== -1) {
					$this->_F_del_at($v);
					$ret = true;
				}
			}
			return $ret;
		}

		function _F_rev()
		{
			if ($this->_M_size) {
				if ($this->_M_f_node->_M_next != null) {
					$c = $this->_M_f_node;
					$n = null;
					while ($c !== null) {
						$p = $c->_M_next;
						$c->_M_next = $n;
						$n = $c;
						$c = $p;
					}
					$this->_M_f_node = $n;
				}
			}
		}

		function _F_dump(int $fwd___ = 1)
		{
			$a = [];
			if ($fwd___ === 1) {
				$c = $this->_M_f_node;
				while ($c !== null) {
					$a[] = $c->_M_data;
					$c = $c->_M_next;
				}
			} else {
				$c = $this->_M_l_node;
				while ($c !== null) {
					$a[] = $c->_M_data;
					$c = $c->_M_prev;
				}
			}
			return $a;
		}

		function _F_merge(&$l___, $fwd___ = 1)
		{
			if ($fwd___ === 1) {
				$c = $l___->_M_f_node;
				while ($c !== null) {
					_F_insert_last($c->_M_data);
					$c = $c->_M_next;
				}
			} else {
				$c = $l___->_M_l_node;
				while ($c !== null) {
					_F_insert_first($c->_M_data);
					$c = $c->_M_prev;
				}
			}
		}

		function _F_clear_all()
		{
			$this->_M_f_node = null;
			$this->_M_l_node = null;
			$this->_M_size = 0;
		}
	} /* EOT */

	trait _T_linkedlist_debug
	{
		function __debugInfo()
		{ return $this->_F_dump(); }
	} /* EOT */

	trait _T_linkedlist_serializable
	{
		function jsonSerialize()
		{ return $this->_F_dump(); }
	} /* EOT */

	trait _T_linkedlist_iterative
	{
		function getIterator()
		{ return new _C_fwditer_linkedlist_adaptor($this); }
	} /* EOT */

	trait _T_linkedlist_iterable
	{
		function begin(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			}
			return new _C_forward_iterator_linkedlist($this, $offset___);
		}

		function end(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			}
			return new _C_forward_iterator_linkedlist($this, $offset___);
		}

		function rbegin($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
			}
			return new _C_reverse_iterator_linkedlist($this, $offset___);
		}

		function rend($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			} else {
				$offset___ = $this->_M_size - $offset___ - 1;
			}
			return new _C_reverse_iterator_linkedlist($this, $offset___);
		}

		function iterator()
		{ return new _C_forward_iterator_linkedlist($this, 0); }

		function reverse_iterator()
		{ return new _C_reverse_iterator_linkedlist($this, $this->_M_size); }
	} /* EOT */

	trait _T_dict_iterative
	{
		function getIterator()
		{ return new _C_fwditer_associative_adaptor($this); }
	}

	trait _T_dict_iterable
	{
		function begin(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			}
			return new _C_forward_iterator_dict($this, $offset___);
		}

		function end(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			}
			return new _C_forward_iterator_dict($this, $offset___);
		}

		function rbegin($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
			}
			return new _C_reverse_iterator_dict($this, $offset___);
		}

		function rend($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			} else {
				$offset___ = $this->_M_size - $offset___ - 1;
			}
			return new _C_reverse_iterator_dict($this, $offset___);
		}

		function iterator()
		{ return new _C_forward_iterator_dict($this, 0); }

		function reverse_iterator()
		{ return new _C_reverse_iterator_dict($this, $this->_M_size); }
	} /* EOT */

	trait _T_map_iterative
	{
		function getIterator()
		{ return new _C_fwditer_sequential_adaptor($this); }
	} /* EOT */

	trait _T_map_iterable
	{
		function begin(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			}
			return new _C_forward_iterator_map($this, $offset___);
		}

		function end(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			}
			return new _C_forward_iterator_map($this, $offset___);
		}

		function rbegin($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
			}
			return new _C_reverse_iterator_map($this, $offset___);
		}

		function rend($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			} else {
				$offset___ = $this->_M_size - $offset___ - 1;
			}
			return new _C_reverse_iterator_map($this, $offset___);
		}

		function iterator()
		{ return new _C_forward_iterator_map($this, 0); }

		function reverse_iterator()
		{ return new _C_reverse_iterator_map($this, $this->_M_size); }
	} /* EOT */

	trait _T_tuple_utils
	{
		function _F_expandv(&$dest___, &$v___, &$sz___)
		{
			if ($v___ instanceof \std\tuple) {
				foreach ($v___->_M_container as $v) {
					$this->_F_expandv($dest___, $v, $sz___);
				}
			} else if ($v___ instanceof \std\quint) {
				$this->_F_expandv($dest___, $v___->first, $sz___);
				$this->_F_expandv($dest___, $v___->second, $sz___);
				$this->_F_expandv($dest___, $v___->third, $sz___);
				$this->_F_expandv($dest___, $v___->fourth, $sz___);
				$this->_F_expandv($dest___, $v___->fifth, $sz___);
			} else if ($v___ instanceof \std\quad) {
				$this->_F_expandv($dest___, $v___->first, $sz___);
				$this->_F_expandv($dest___, $v___->second, $sz___);
				$this->_F_expandv($dest___, $v___->third, $sz___);
				$this->_F_expandv($dest___, $v___->fourth, $sz___);
			} else if ($v___ instanceof \std\triad) {
				$this->_F_expandv($dest___, $v___->first, $sz___);
				$this->_F_expandv($dest___, $v___->second, $sz___);
				$this->_F_expandv($dest___, $v___->third, $sz___);
			} else if ($v___ instanceof \std\pair) {
				$this->_F_expandv($dest___, $v___->first, $sz___);
				$this->_F_expandv($dest___, $v___->second, $sz___);
			} else {
				$dest___[] = $v___;
				++$sz___;
			}
		}

		function _F_unpackv(&$args___)
		{
			foreach ($args___ as &$v) {
				$this->_F_expandv($this->_M_container, $v, $this->_M_size);
			}
		}
	} /* EOT */
} /* EONS */

/* EOF */