<?php
# -*- coding: utf-8 -*-

//
// scl_base_container_traits.php
//
// Copyright (C) 2017 Moe123. All rights reserved.
//
 
/*! 
 * @author     Moe123 2017.
 * @maintainer Moe123 2017.
 *
 * @copyright  (C) Moe123. All rights reserved.
 */

namespace std
{
	trait _T_builtin_array_container_traits
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
	}

	trait _T_builtin_array_functional_traits
	{
		function & enumerate(\Closure $f___, bool $r___ = false)
		{
			if ($this->_M_size) {
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

		/**
		* object map(\Closure $f___)
		* @param function (mixed $offset___, mixed $val) -> mixed (func)
		* @return object (new)
		*/
		function map(\Closure $f___)
		{
			$self = new static();
			if ($this->_M_size) {
				if (self::container_category === basic_iteratable_tag::basic_forward_list) {
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
					if (self::container_category !== basic_iteratable_tag::basic_dict) {
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
				if (self::container_category === basic_iteratable_tag::basic_forward_list) {
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
					if (self::container_category !== basic_iteratable_tag::basic_dict) {
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
				if (self::container_category === basic_iteratable_tag::basic_forward_list) {
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
	}

	trait _T_builtin_array_debug_traits
	{
		function __debugInfo()
		{ return $this->_M_container; }
	}

	trait _T_builtin_array_serializable_traits
	{
		function jsonSerialize()
		{ return $this->_M_container; }
	}

	trait _T_builtin_countable_traits
	{
		function count()
		{ return $this->_M_size; }
	}

	trait _T_builtin_array_iterative_traits
	{
		function getIterator()
		{ return new \ArrayIterator($this->_M_container); }
	}

	trait _T_builtin_array_iteratable_traits
	{
		function begin(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			}
			return new forward_iterator($this, $offset___);
		}

		function end(int $offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			}
			return new forward_iterator($this, $offset___);
		}

		function rbegin($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = $this->_M_size;
			} else {
				$offset___ = $this->_M_size - $offset___;
			}
			return new reverse_iterator($this, $offset___);
		}

		function rend($offset___ = -1)
		{
			if ($offset___ < 0) {
				$offset___ = 0;
			} else {
				$offset___ = $this->_M_size - $offset___ - 1;
			}
			return new reverse_iterator($this, $offset___);
		}

		function iterator()
		{ return new forward_iterator($this, 0); }

		function reverse_iterator()
		{ return new reverse_iterator($this, $this->_M_size); }
	}

	trait _T_builtin_array_conformity_traits
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
			) === array(true);
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
			) === array(true);
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
	}

	class _C_builtin_list_node
	{
		var $_M_data = null;
		var $_M_next = null;
		var $_M_prev = null;
	}

	trait _T_builtin_linked_list_container_traits
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
			$n = new _C_builtin_list_node;
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
			$n = new _C_builtin_list_node;
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
				while ($c->_M_data !== $p___) {
					$c = $c->_M_next;
					if ($c === null) {
						return false;
					}
				}
				$n = new _C_builtin_list_node;
				$n->_M_data = $d___;

				if ($c === $this->_M_l_node) {
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

				$n = new _C_builtin_list_node;
				$n->_M_data = $d___;

				if ($c === $this->_M_l_node) {
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
					if ($c->_M_data === $p___) {
						++$cnt;
					}
				}
			}
			return $cnt;
		}

		function _F_index_of_data(&$p___, callable $f___ = null)
		{
			$f = $f___;
			if ($f___ === null) {
				$f = function(&$l, &$r) { return $l === $r; };
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
				while ($c->_M_data !== $p___) {
					$c = $c->_M_next;
					if ($c === null) {
						return $c;
					}
				}
				if ($c === $this->_M_f_node) {
					$this->_M_f_node = $c->_M_next;
				} else {
					$c->_M_prev->_M_next = $c->_M_next;
				}
				if ($c === $this->_M_l_node) {
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
				if ($c === $this->_M_f_node) {
					$this->_M_f_node = $c->_M_next;
				} else {
					$c->_M_prev->_M_next = $c->_M_next;
				}
				if ($c === $this->_M_l_node) {
					$this->_M_l_node = $c->_M_prev;
				} else {
					$c->_M_next->_M_prev = $c->_M_prev;
				}
				--$this->_M_size;
				return $c;
			}
			return null;
		}

		function _F_del_if(callable $f__)
		{
			$ret = false;
			$idx = [];
			for ($i = 0; $i < $this->_M_size; $i++) {
				$idx[] = $this->_F_index_of_data_if($f__);
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
	}

	trait _T_builtin_linked_list_debug_traits
	{
		function __debugInfo()
		{ return $this->_F_dump(); }
	}

	trait _T_builtin_linked_list_serializable_traits
	{
		function jsonSerialize()
		{ return $this->_F_dump(); }
	}

	trait _T_builtin_linked_list_iterative_traits
	{
		function getIterator()
		{ return new \ArrayIterator($this->_F_dump()); }
	}
} /* EONS */

/* EOF */