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
            ['?test=xxx', '?test=xxx'],
            ['#hello', '#hello'],
        );
    }

    /**
     * Test add query params
     */

    public function testAddQueryParams()
    {
        $uri = $this->getUri('/some/path');
        $uri->setQueryParams(
            array(
                'param1' => 'value1',
                'param2' => 'value2',
            )
        );

        $this->assertSame(
            '/some/path?param1=value1&param2=value2',
            (string) $uri
        );
    }

    /**
     * Test add query params
     */

    public function testFullUri()
    {
        $uri = $this
            ->getUri('/some/path?with=params')
            ->setScheme('https')
            ->setHost(['test', 'example.com'])
        ;

        $this->assertSame(
            'https://test.example.com/some/path?with=params',
            (string) $uri
        );
    }
}
