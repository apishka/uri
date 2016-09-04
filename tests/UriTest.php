<?php namespace ApishkaTest\Uri;

use Apishka\Uri\Uri;

/**
 * Apishka test form form abstract test
 */

class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get uri
     *
     * @param string $uri
     *
     * @return Uri
     */

    protected function getUri($uri)
    {
        return new Uri($uri);
    }

    /**
     * Test is sent
     *
     * @dataProvider validUriProvider
     *
     * @param string $uri
     * @param string $expected
     */

    public function testCreation($uri, $expected)
    {
        $uri = $this->getUri($uri);

        $this->assertSame(
            $expected,
            (string) $uri
        );
    }

    /**
     * Valid uri provider
     *
     * @return array
     */

    public function validUriProvider()
    {
        return array(
            ['http://example.com/', 'http://example.com/'],
            ['/', '/'],
            ['?#', ''],
            ['?', ''],
            ['#', ''],
            ['https://яндекс.рф', 'https://яндекс.рф'],
            ['http://example.com:80/path', 'http://example.com/path'],
            ['HTTP://EXAMPLE.COM/path', 'http://example.com/path'],
        );
    }
}
