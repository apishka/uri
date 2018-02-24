<?php

namespace ApishkaTest\Uri\Component;

use Apishka\Uri\Component\Host;

/**
 * Apishka test form form abstract test
 */
class HostTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Get host
     *
     * @param string $host
     * @param array  $options
     *
     * @return Host
     */
    protected function getHost($host, $options = [])
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
        return [
            ['example.com', 'example.com'],
            [[null, 'example.com'], 'example.com'],
            [['www', 'example.com'], 'www.example.com'],
        ];
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
        $host = $this->getHost($data);

        $this->assertSame(
            $expected,
            $host->isEmpty()
        );
    }

    /**
     * Provider is empty
     *
     * @return array
     */
    public function providerIsEmpty()
    {
        return [
            ['', true],
            [null, true],
            ['example.com', false],
        ];
    }
}
