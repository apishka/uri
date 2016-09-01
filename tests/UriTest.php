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
     */

    public function testCreation()
    {
        $this->getUri('http://example.com/');
    }
}
