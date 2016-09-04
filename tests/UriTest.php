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
     */

    public function testCreation($expect, $uri)
    {
        $uri = $this->getUri($uri);

        $this->assertSame(
            $expect,
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
            ['', '?#'],
            ['', '?'],
            ['', '#'],
            ['https://яндекс.рф', 'https://яндекс.рф'],
        );
    }
}
