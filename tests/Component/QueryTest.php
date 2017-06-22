<?php

namespace ApishkaTest\Uri\Component;

use Apishka\Uri\Component\Query;

/**
 * Apishka test form form abstract test
 */

class QueryTest extends \PHPUnit\Framework\TestCase
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
            ['', 'param1', '', 'param1='],
            ['', 'param1', null, ''],
        );
    }

    /**
     * Test set composite
     *
     * @dataProvider providerSetComposite
     *
     * @param array  $data
     * @param array  $key
     * @param mixed  $value
     * @param string $expected
     */

    public function testSetComposite($data, $key, $value, $expected)
    {
        $query = $this->getQuery($data);

        $query->set($key, $value);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider del composite
     *
     * @return array
     */

    public function providerSetComposite()
    {
        return array(
            ['param[1]=value1&param[2]=value2', ['param', '1'], 'value1.1', 'param%5B1%5D=value1.1&param%5B2%5D=value2'],
            ['param[1]=value1&param[2]=value2', ['param'], 'value', 'param=value'],
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
     * Test get composite
     *
     * @dataProvider providerGetComposite
     *
     * @param array  $data
     * @param array  $key
     * @param string $expected
     */

    public function testGetComposite($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->get($key)
        );
    }

    /**
     * Provider del composite
     *
     * @return array
     */

    public function providerGetComposite()
    {
        return array(
            ['param[1]=value1&param[2]=value2', ['param', '1'], 'value1'],
            ['param[1]=value1&param[2]=value2', ['param'], ['1' => 'value1', '2' => 'value2']],
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
     * Test del composite
     *
     * @dataProvider providerDelComposite
     *
     * @param array  $data
     * @param array  $key
     * @param string $expected
     */

    public function testDelComposite($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $query->del($key);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider del composite
     *
     * @return array
     */

    public function providerDelComposite()
    {
        return array(
            ['param[1]=value1&param[2]=value2', ['param', '1'], 'param%5B2%5D=value2'],
            ['param[min]=value1&param[max]=value2', ['param'], ''],
            ['param[min]=value1&param[max]=value2', ['param', 'max'], 'param%5Bmin%5D=value1'],
            ['param[]=value1&param[]=value2', ['param', 0], 'param%5B1%5D=value2'],
            ['param=value1', [], 'param=value1'],
            ['param=value1', ['foo'], 'param=value1'],
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
     * Test has composite
     *
     * @dataProvider providerHasComposite
     *
     * @param array  $data
     * @param array  $key
     * @param string $expected
     */

    public function testHasComposite($data, $key, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            $query->has($key)
        );
    }

    /**
     * Provider del composite
     *
     * @return array
     */

    public function providerHasComposite()
    {
        return array(
            ['param[1]=value1&param[2]=value2', ['param', '1'], true],
            ['param[1]=value1&param[2]=value2', ['param', 'min'], false],
            ['param[]=value1&param[]=value2', ['param', '0'], true],
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

    /**
     * Test set mutli
     *
     * @dataProvider providerSetMulti
     *
     * @param array  $data
     * @param mixed  $values
     * @param string $expected
     */

    public function testSetMulti($data, $values, $expected)
    {
        $query = $this->getQuery($data);

        $query->setMulti($values);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider set multi
     *
     * @return array
     */

    public function providerSetMulti()
    {
        return array(
            ['param1=value1&param2=value2', [], 'param1=value1&param2=value2'],
            ['', ['param1' => 'value1', 'param2' => 'value2'], 'param1=value1&param2=value2'],
            ['param1=value1&param2=value2', ['param3' => 'value3'], 'param1=value1&param2=value2&param3=value3'],
        );
    }

    /**
     * Test apply
     *
     * @dataProvider providerApply
     *
     * @param mixed  $data
     * @param array  $values
     * @param string $expected
     */

    public function testApply($data, $values, $expected)
    {
        $query = $this->getQuery($data);

        $query->apply($values);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Provider apply
     *
     * @return array
     */

    public function providerApply()
    {
        return array(
            ['param1=value1&param2=value2', ['param1' => false, 'param2' => 'value2.2'], 'param2=value2.2'],
        );
    }
}
