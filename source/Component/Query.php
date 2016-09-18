<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * Query
 */

class Query extends ComponentAbstract implements \ArrayAccess
{
    /**
     * Query
     *
     * @var string
     */

    private $_query = array();

    /**
     * Construct
     *
     * @param string $query
     * @param array  $options
     */

    public function __construct($query, $options = array())
    {
        $this->setOptions($options);
        $this->parse($query);
    }

    /**
     * Parse
     *
     * @param string $query
     *
     * @return Query this
     */

    protected function parse($query)
    {
        if (is_array($query))
        {
            $this->_query = $query;
        }
        else
        {
            parse_str($query, $this->_query);
        }

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) http_build_query($this->__toArray());
    }

    /**
     * To array
     *
     * @return array
     */

    public function __toArray()
    {
        return $this->_query;
    }

    /**
     * Set
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return Query
     */

    public function set($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * Set multi
     *
     * @param array $values
     *
     * @return Query
     */

    public function setMulti(array $values)
    {
        foreach ($values as $key => $value)
            $this->set($key, $value);

        return $this;
    }

    /**
     * Get
     *
     * @param mixed $key
     *
     * @return mixed
     */

    public function get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Has
     *
     * @param mixed $key
     *
     * @return bool
     */

    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Del
     *
     * @param mixed $key
     *
     * @return Query
     */

    public function del($key)
    {
        $this->offsetUnset($key);

        return $this;
    }

    /**
     * Apply
     *
     * @param array $values
     *
     * @return Query
     */

    public function apply(array $values)
    {
        foreach ($values as $key => $value)
        {
            if ($value === false)
            {
                $this->offsetUnset($key);
            }
            else
            {
                $this->offsetSet($key, $value);
            }
        }

        return $this;
    }

    /**
     * Offset exists
     *
     * @param mixed $offset
     *
     * @return bool
     */

    public function offsetExists($offset)
    {
        $parent = &$this->prepareCompositeParent($offset, $key);

        return isset($parent[$key]);
    }

    /**
     * Offset get
     *
     * @param mixed $offset
     *
     * @return mixed
     */

    public function offsetGet($offset)
    {
        $parent = &$this->prepareCompositeParent($offset, $key);

        return $parent[$key] ?? null;
    }

    /**
     * Offset set
     *
     * @param mixed $offset
     * @param mixed $value
     */

    public function offsetSet($offset, $value)
    {
        $parent = &$this->prepareCompositeParent($offset, $key);

        $parent[$key] = $value;
    }

    /**
     * Offset unset
     *
     * @param mixed $offset
     */

    public function offsetUnset($offset)
    {
        $parent = &$this->prepareCompositeParent($offset, $key);

        if ($parent !== null)
            unset($parent[$key]);
    }

    /**
     * Prepare composite parent
     *
     * @param mixed $offset
     * @param mixed $key
     *
     * @return &array
     */

    protected function &prepareCompositeParent($offset, &$key)
    {
        if (is_array($offset))
        {
            $query = null;

            $curr = &$this->_query;
            foreach ($offset as $key)
            {
                $query = &$curr;
                $curr = &$curr[$key];
            }

            return $query;
        }

        $key = $offset;
        return $this->_query;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return empty($this->_query);
    }
}
