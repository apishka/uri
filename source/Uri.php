<?php namespace Apishka\Uri;

/**
 * Uri
 */

class Uri
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Uri
     *
     * @var string
     */

    private $_uri = null;

    /**
     * Construct
     *
     * @param string $uri
     */

    public function __construct($uri)
    {
        $this->_uri = $uri;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        $result = '';

        $scheme = (string) $this->getScheme();
        if ($scheme)
            $result = $scheme . ':';

        $host = (string) $this->getHost();
        if ($host)
            $result .= '//';

        $user = (string) $this->getUser();
        $pass = (string) $this->getPass();
        if ($user && $pass)
            $result .= $user . '@' . $pass . ':';

        if ($host)
            $result .= $host;

        $port = (int) $this->getPort();
        if ($port)
            $result .= ':' . $port;

        $path = (string) $this->getPath();
        if ($path)
            $result .= $path;

        $query = (string) $this->getQuery();
        if ($query)
            $result .= '?' . $query;

        $fragment = (string) $this->getFragment();
        if ($fragment)
            $result .= '#' . $fragment;

        return $result;
    }
}
