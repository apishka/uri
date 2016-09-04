<?php namespace Apishka\Uri;

use Apishka\Uri\Component\Fragment;
use Apishka\Uri\Component\Host;
use Apishka\Uri\Component\Pass;
use Apishka\Uri\Component\Path;
use Apishka\Uri\Component\Port;
use Apishka\Uri\Component\Query;
use Apishka\Uri\Component\Scheme;
use Apishka\Uri\Component\User;

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
        $this->setOptions($options);
        $this->parse($uri);
    }

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Uri
     */

    protected function setOptions(array $options)
    {
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

        return $this;
    }

    /**
     * Apishka from provider
     *
     * @param mixed $provider
     * @param array $options
     *
     * @return Uri
     */

    public function __apishkaFromProvider($provider = null, array $options = array())
    {
        if ($provider === null)
            $provider = Provider\Globals::apishka();

        $this->setOptions($options);
        $this->parse($provider);

        return $this;
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

            $data = parse_url((string) $uri);
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
     * Set scheme
     *
     * @param mixed $scheme
     *
     * @return Scheme
     */

    public function setScheme($scheme)
    {
        $this->_scheme = ($scheme instanceof Scheme)
            ? $scheme
            : Scheme::apishka($scheme, $this->_options['scheme'])
        ;

        return $this;
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
     * Set host
     *
     * @param mixed $host
     *
     * @return Host
     */

    public function setHost($host)
    {
        $this->_host = ($host instanceof Host)
            ? $host
            : Host::apishka($host, $this->_options['host'])
        ;

        return $this;
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
     * Set user
     *
     * @param mixed $user
     *
     * @return User
     */

    public function setUser($user)
    {
        $this->_user = ($user instanceof User)
            ? $user
            : User::apishka($user, $this->_options['user'])
        ;

        return $this;
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
     * Set pass
     *
     * @param mixed $pass
     *
     * @return Pass
     */

    public function setPass($pass)
    {
        $this->_pass = ($pass instanceof Pass)
            ? $pass
            : Pass::apishka($pass, $this->_options['pass'])
        ;

        return $this;
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
     * Set port
     *
     * @param mixed $port
     *
     * @return Port
     */

    public function setPort($port)
    {
        $this->_port = ($port instanceof Port)
            ? $port
            : Port::apishka($port, $this->_options['port'])
        ;

        return $this;
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
     * Set path
     *
     * @param mixed $path
     *
     * @return Path
     */

    public function setPath($path)
    {
        $this->_path = ($path instanceof Path)
            ? $path
            : Path::apishka($path, $this->_options['path'])
        ;

        return $this;
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
     * Set query
     *
     * @param mixed $query
     *
     * @return Query
     */

    public function setQuery($query)
    {
        $this->_query = ($query instanceof Query)
            ? $query
            : Query::apishka($query, $this->_options['query'])
        ;

        return $this;
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
     * Set fragment
     *
     * @param mixed $fragment
     *
     * @return Fragment
     */

    public function setFragment($fragment)
    {
        $this->_fragment = ($fragment instanceof Fragment)
            ? $fragment
            : Fragment::apishka($fragment, $this->_options['fragment'])
        ;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        $uri = '';

        if (!$this->getScheme()->isEmpty())
            $uri = $this->getScheme() . ':';

        if (!$this->getHost()->isEmpty())
            $uri .= '//';

        if (!$this->getUser()->isEmpty())
        {
            $uri .= $this->getUser();

            if (!$this->getPass()->isEmpty())
                $uri .= ':' . $this->getPass();

            $uri .= '@';
        }

        if (!$this->getHost()->isEmpty())
            $uri .= $this->getHost();

        if (!$this->getPort()->isEmpty() && !$this->getScheme()->isDefaultPort($this->getPort()))
            $uri .= ':' . $this->getPort();

        return $uri . $this->getRelative();
    }

    /**
     * Get relative
     *
     * @return string
     */

    public function getRelative()
    {
        $relative = '';

        if (!$this->getPath()->isEmpty())
            $relative .= $this->getPath();

        if (!$this->getQuery()->isEmpty())
            $relative .= '?' . $this->getQuery();

        if (!$this->getFragment()->isEmpty())
            $relative .= '#' . $this->getFragment();

        return $relative;
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
     * Set query params
     *
     * @param array $values
     *
     * @return Uri
     */

    public function setQueryParams(array $values)
    {
        $this->getQuery()->setMulti($values);

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
