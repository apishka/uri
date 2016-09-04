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
     * Construct
     *
     * @param string $uri
     */

    public function __construct($uri)
    {
        $this->_original_uri = $uri;
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

            $this->_scheme = Scheme::apishka($data['scheme']);
            $this->_host = Host::apishka($data['host']);
            $this->_port = Port::apishka($data['port']);
            $this->_user = User::apishka($data['user']);
            $this->_pass = Pass::apishka($data['pass']);
            $this->_path = Path::apishka($data['path']);
            $this->_query = Query::apishka($data['query']);
            $this->_fragment = Fragment::apishka($data['fragment']);
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
            $uri .= ':' . $port;

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
}
