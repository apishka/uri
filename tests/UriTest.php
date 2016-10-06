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
        return Uri::fromUri($uri);
    }

    /**
     * Test valid url
     *
     * @dataProvider providerValidUri
     *
     * @param string $uri
     * @param string $expected
     */

    public function testValidUri($uri, $expected)
    {
        $uri = $this->getUri($uri);

        $this->assertSame(
            $expected,
            (string) $uri
        );
    }

    /**
     * Provider valid uri
     *
     * @return array
     */

    public function providerValidUri()
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
     *
     * @dataProvider providerAddQueryParams
     *
     * @param array $params
     * @param string $expected
     */

    public function testAddQueryParams($params, $expected)
    {
        $uri = $this->getUri('/some/path');

        $uri->setQueryParams($params);

        $this->assertSame(
            '/some/path' . $expected,
            (string) $uri
        );
    }

    /**
     * Provider add query params
     *
     * @return array
     */

    public function providerAddQueryParams()
    {
        return array(
            array(
                array(
                    'param1' => 'value1',
                    'param2' => 'value2',
                ),
                '?param1=value1&param2=value2'
            ),
            array(
                array(
                    'param1' => null,
                ),
                ''
            ),
            array(
                array(
                    'param1' => '',
                ),
                '?param1='
            )
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
