<?php namespace Apishka\Uri;

use Apishka\Uri\Component\Scheme;
use Apishka\Uri\Component\Host;
use Apishka\Uri\Component\User;
use Apishka\Uri\Component\Pass;
use Apishka\Uri\Component\Port;
use Apishka\Uri\Component\Path;
use Apishka\Uri\Component\Query;
use Apishka\Uri\Component\Fragment;

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
     * Scheme
     *
     * @var Scheme
     */

    private $_scheme = null;

    /**
     * Host
     *
     * @var Host
     */

    private $_host = null;

    /**
     * User
     *
     * @var User
     */

    private $_user = null;

    /**
     * Pass
     *
     * @var Pass
     */

    private $_pass = null;

    /**
     * Port
     *
     * @var Port
     */

    private $_port = null;

    /**
     * Path
     *
     * @var Path
     */

    private $_path = null;

    /**
     * Query
     *
     * @var Query
     */

    private $_query = null;

    /**
     * Fragment
     *
     * @var Fragment
     */

    private $_fragment = null;

    /**
     * Original uri
     *
     * @var string
     */

    private $_original_uri = null;

    /**
     * Is parsed
     *
     * @var bool
     */

    private $_is_parsed = false;

    /**
     * Options
     *
     * @var array
     */

    private $_options = array();

    /**
     * Construct
     *
     * @param string $uri
     * @param array  $options
     */

    public function __construct($uri, $options = array())
    {
        $this->_original_uri = $uri;
        $this->_options = array_replace(
            array(
                'scheme'   => array(),
                'host'     => array(),
                'port'     => array(),
                'user'     => array(),
                'pass'     => array(),
                'path'     => array(),
                'query'    => array(),
                'fragment' => array(),
            ),
            $options
        );

        $this->parse($this->_original_uri);
    }

    /**
     * Parse
     *
     * @param string $uri
     *
     * @return Uri
     */

    protected function parse($uri)
    {
        if (!$this->_is_parsed)
        {
            $this->_is_parsed = true;

            $data = parse_url($uri);
            if ($data === false)
                throw new \InvalidArgumentException('Can\'t parse ' . var_export($uri, true));

            $data = array_replace(
                array(
                    'scheme'   => null,
                    'host'     => null,
                    'port'     => null,
                    'user'     => null,
                    'pass'     => null,
                    'path'     => null,
                    'query'    => null,
                    'fragment' => null,
                ),
                $data
            );

            $this->_scheme = Scheme::apishka($data['scheme'], $this->_options['scheme']);
            $this->_host = Host::apishka($data['host'], $this->_options['host']);
            $this->_port = Port::apishka($data['port'], $this->_options['port']);
            $this->_user = User::apishka($data['user'], $this->_options['user']);
            $this->_pass = Pass::apishka($data['pass'], $this->_options['pass']);
            $this->_path = Path::apishka($data['path'], $this->_options['path']);
            $this->_query = Query::apishka($data['query'], $this->_options['query']);
            $this->_fragment = Fragment::apishka($data['fragment'], $this->_options['fragment']);
        }

        return $this;
    }

    /**
     * Get scheme
     *
     * @return Scheme
     */

    public function getScheme()
    {
        return $this->_scheme;
    }

    /**
     * Get host
     *
     * @return Host
     */

    public function getHost()
    {
        return $this->_host;
    }

    /**
     * Get user
     *
     * @return User
     */

    public function getUser()
    {
        return $this->_user;
    }

    /**
     * Get pass
     *
     * @return Pass
     */

    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * Get port
     *
     * @return Port
     */

    public function getPort()
    {
        return $this->_port;
    }

    /**
     * Get path
     *
     * @return Path
     */

    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Get query
     *
     * @return Query
     */

    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * Get fragment
     *
     * @return Fragment
     */

    public function getFragment()
    {
        return $this->_fragment;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        $uri = '';

        $scheme = (string) $this->getScheme();
        if ($scheme)
            $uri = $scheme . ':';

        $host = (string) $this->getHost();
        if ($host)
            $uri .= '//';

        $user = (string) $this->getUser();
        $pass = (string) $this->getPass();
        if ($user)
        {
            $uri .= $user;

            if ($pass)
                $uri .= ':' . $pass;

            $uri .= '@';
        }

        if ($host)
            $uri .= $host;

        $port = (string) $this->getPort();
        if ($port)
        {
            if (!$this->getScheme()->isDefaultPort($port))
                $uri .= ':' . $port;
        }

        $path = (string) $this->getPath();
        if ($path)
            $uri .= $path;

        $query = (string) $this->getQuery();
        if ($query)
            $uri .= '?' . $query;

        $fragment = (string) $this->getFragment();
        if ($fragment)
            $uri .= '#' . $fragment;

        return $uri;
    }

    /**
     * Set query param
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return Uri
     */

    public function setQueryParam($key, $value)
    {
        $this->getQuery()->set($key, $value);

        return $this;
    }

    /**
     * Del query param
     *
     * @param mixed $key
     *
     * @return Uri
     */

    public function delQueryParam($key)
    {
        $this->getQuery()->del($key);

        return $this;
    }
}
