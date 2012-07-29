<?php

class ApcCache implements ArrayAccess
{
	/**
	 * Current object instances (Singleton)
	 * @var array
	 */
	protected static $arrInstances = array();

	/**
	 * Instantiate a new apc cache object and return it (Factory)
	 * @param string
	 * @return ApcCache
	 */
	public static function getInstance($prefix)
	{
		if (!isset(self::$arrInstances[$prefix])) {
			self::$arrInstances[$prefix] = new self($prefix);
		}
		return self::$arrInstances[$prefix];
	}

	/**
	 * Check whether a variable is set
	 * @param string
	 * @return boolean
	 */
	protected $prefix;

	/**
	 * @param string $prefix
	 */
	private function __construct($prefix)
	{
		$this->prefix = $prefix;
	}

	public function __isset($k)
	{
		return apc_exists($this->prefix . ':' . $k);
	}

	/**
	 * Return a variable
	 * @param string
	 * @return mixed
	 */
	public function __get($k)
	{
		return apc_fetch($this->prefix . ':' . $k);
	}

	/**
	 * Set a variable
	 * @param string
	 * @param mixed
	 */
	public function __set($k, $v)
	{
		apc_store($this->prefix . ':' . $k, $v);
	}

	/**
	 * Unset an entry
	 * @param string
	 */
	public function __unset($k)
	{
		apc_delete($this->prefix . ':' . $k);
	}

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Whether a offset exists
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 *
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 *
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 */
	public function offsetExists($offset)
	{
		return $this->__isset($offset);
	}

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Offset to retrieve
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 *
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 *
	 * @return mixed Can return all value types.
	 */
	public function offsetGet($offset)
	{
		return $this->__get($offset);
	}

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Offset to set
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 *
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 *
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		return $this->__set($offset, $value);
	}

	/**
	 * (PHP 5 &gt;= 5.0.0)<br/>
	 * Offset to unset
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 *
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 *
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		$this->__unset($offset);
	}

	/**
	 * Prevent cloning of the object (Singleton)
	 */
	final private function __clone() {}
}