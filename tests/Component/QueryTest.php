<?php namespace ApishkaTest\Uri\Component;

use Apishka\Uri\Component\Query;

/**
 * Apishka test form form abstract test
 */

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get host
     *
     * @param mixed $query
     * @param array $options
     *
     * @return Host
     */

    protected function getQuery($query, $options = array())
    {
        return new Query($query, $options);
    }

    /**
     * Test creation
     *
     * @dataProvider providerToString
     *
     * @param string $data
     * @param string $expected
     */

    public function testToString($data, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Valid query provider
     *
     * @return array
     */

    public function providerToString()
    {
        return array(
            ['param1=value1&param2=value2', 'param1=value1&param2=value2'],
            [['param1' => 'value1', 'param2' => 'value2'], 'param1=value1&param2=value2'],
        );
    }

    /**
     * Test to array
     *
     * @dataProvider providerToArray
     *
     * @param string $data
     * @param string $expected
     */

    public function testToArray($data, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->__toArray()
        );
    }

    /**
     * Provider to array
     *
     * @return array
     */

    public function providerToArray()
    {
        return array(
            ['param1=value1&param2=value2', ['param1' => 'value1', 'param2' => 'value2']],
        );
    }

    /**
     * Test set
     *
     * @dataProvider providerSet
     *
     * @param array  $data
     * @param string $key
     * @param mixed  $value
     * @param string $expected
     */

    public function testSet($data, $key, $value, $expected)
    {
        $query = $this->getQuery($data);

        $query->set($key, $value);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Test offset set
     *
     * @dataProvider providerSet
     *
     * @param array  $data
     * @param string $key
     * @param mixed  $value
     * @param string $expected
     */

    public function testOffsetSet($data, $key, $value, $expected)
    {
        $query = $this->getQuery($data);

        $query[$key] = $value;

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider set
     *
     * @return array
     */

    public function providerSet()
    {
        return array(
            ['param1=value1&param2=value2', 'param3', 'value3', 'param1=value1&param2=value2&param3=value3'],
            ['param1=value1&param2=value2', 'param1', 'value1.1', 'param1=value1.1&param2=value2'],
        );
    }

    /**
     * Test get
     *
     * @dataProvider providerGet
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testGet($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->get($key)
        );
    }

    /**
     * Test offset get
     *
     * @dataProvider providerGet
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testOffsetGet($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query[$key]
        );
    }

    /**
     * Provider get
     *
     * @return array
     */

    public function providerGet()
    {
        return array(
            ['param1=value1&param2=value2', 'param3', null],
            ['param1=value1&param2=value2', 'param1', 'value1'],
        );
    }

    /**
     * Test del
     *
     * @dataProvider providerDel
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testDel($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $query->del($key);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Test offset del
     *
     * @dataProvider providerDel
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testOffsetUnset($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        unset($query[$key]);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider del
     *
     * @return array
     */

    public function providerDel()
    {
        return array(
            ['param1=value1&param2=value2', 'param3', 'param1=value1&param2=value2'],
            ['param1=value1&param2=value2', 'param1', 'param2=value2'],
        );
    }

    /**
     * Test has
     *
     * @dataProvider providerHas
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testHas($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->has($key)
        );
    }

    /**
     * Test offset exists
     *
     * @dataProvider providerHas
     *
     * @param array  $data
     * @param string $key
     * @param string $expected
     */

    public function testOffsetExists($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            isset($query[$key])
        );
    }

    /**
     * Provider get
     *
     * @return array
     */

    public function providerHas()
    {
        return array(
            ['param1=value1&param2=value2', 'param3', false],
            ['param1=value1&param2=value2', 'param1', true],
        );
    }

    /**
     * Test is empty
     *
     * @dataProvider providerIsEmpty
     *
     * @param array  $data
     * @param string $expected
     */

    public function testIsEmpty($data, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->isEmpty()
        );
    }

    /**
     * Provider is empty
     *
     * @return array
     */

    public function providerIsEmpty()
    {
        return array(
            ['param1=value1&param2=value2', false],
            ['', true],
            [[], true],
        );
    }
}
