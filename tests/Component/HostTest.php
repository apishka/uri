<?php namespace ApishkaTest\Uri\Component;

use Apishka\Uri\Component\Host;

/**
 * Apishka test form form abstract test
 */

class HostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get host
     *
     * @param string $host
     * @param array  $options
     *
     * @return Host
     */

    protected function getHost($host, $options = array())
    {
        return new Host($host, $options);
    }

    /**
     * Test creation
     *
     * @dataProvider validHostProvider
     *
     * @param string $host
     * @param string $expected
     */

    public function testCreation($host, $expected)
    {
        $host = $this->getHost($host);

        $this->assertSame(
            $expected,
            (string) $host
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
            ['example.com', 'example.com'],
        );
    }
}
