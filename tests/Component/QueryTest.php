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
     * @dataProvider validHostProvider
     *
     * @param string $data
     * @param string $expected
     */

    public function testCreation($data, $expected)
    {
        $query = $this->getQuery($data);

        $this->assertSame(
            $expected,
            (string) $query
        );
    }

    /**
     * Valid host provider
     *
     * @return array
     */

    public function validHostProvider()
    {
        return array(
            ['param1=value1&param2=value2', 'param1=value1&param2=value2'],
        );
    }
}
