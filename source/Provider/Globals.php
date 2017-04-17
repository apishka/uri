<?php

namespace Apishka\Uri\Provider;

use Apishka\Uri\ProviderAbstract;

/**
 * Globals
 */

class Globals extends ProviderAbstract
{
    /**
     * Server
     *
     * @var array
     */

    private $_server = null;

    /**
     * Construct
     *
     * @param mixed $server
     */

    public function __construct($server = null)
    {
        $this->_server = $server ?? $_SERVER;
    }

    /**
     * Create a new instance from the environment
     *
     * @param array $server
     */

    public function getUri()
    {
        return $this->fetchServerScheme($this->_server)
            . '://'
            . $this->fetchServerUserInfo($this->_server)
            . $this->fetchServerHost($this->_server)
            . $this->fetchServerPort($this->_server)
            . $this->fetchServerRequestUri($this->_server)
        ;
    }

    /**
     * Returns the environment scheme
     *
     * @param array $server
     *
     * @return string
     */

    public function fetchServerScheme(array $server)
    {
        $server += ['HTTPS' => ''];
        $res = filter_var($server['HTTPS'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        return ($res !== false) ? 'https' : 'http';
    }

    /**
     * Returns the environment user info
     *
     * @param array $serverR
     *
     * @return string
     */

    public function fetchServerUserInfo(array $server)
    {
        $server += ['PHP_AUTH_USER' => null, 'PHP_AUTH_PW' => null, 'HTTP_AUTHORIZATION' => null];

        if ('' !== $server['HTTP_AUTHORIZATION'] && 0 === strpos(strtolower($server['HTTP_AUTHORIZATION']), 'basic'))
        {
            $res = explode(':', base64_decode(substr($server['HTTP_AUTHORIZATION'], 6)), 2);
            $login = array_shift($res);
            $pass = array_shift($res);

            return $this->buildUserInfo(rawurlencode($login), rawurlencode($pass));
        }

        return $this->buildUserInfo(rawurlencode($server['PHP_AUTH_USER']), rawurlencode($server['PHP_AUTH_PW']));
    }

    /**
     * Returns the environment host
     *
     * @param array $server
     *
     * @throws \InvalidArgumentException If the host can not be detected
     *
     * @return string
     */

    public function fetchServerHost(array $server)
    {
        if (isset($server['HTTP_HOST']))
            return $this->fetchServerHostname($server['HTTP_HOST']);

        if (isset($server['SERVER_ADDR']))
            return (string) $server['SERVER_ADDR'];

        throw new \InvalidArgumentException('Host could not be detected');
    }

    /**
     * Returns the environment hostname
     *
     * @param string $host the environment server hostname
     *                     the port info can sometimes be
     *                     associated with the hostname
     *
     * @return string
     */

    public function fetchServerHostname($host)
    {
        preg_match(',^(([^(\[\])]*):)?(?<host>.*)?$,', strrev($host), $matches);

        return strrev($matches['host']);
    }

    /**
     * Returns the environment port
     *
     * @param array $server
     *
     * @return string
     */

    public function fetchServerPort(array $server)
    {
        $server += ['HTTP_HOST' => '', 'SERVER_PORT' => ''];
        if (preg_match(',^(?<port>([^(\[\])]*):),', strrev($server['HTTP_HOST']), $matches))
            return strrev($matches['port']);

        return ':' . $server['SERVER_PORT'];
    }

    /**
     * Returns the environment path
     *
     * @param array $server
     *
     * @return string
     */

    public function fetchServerRequestUri(array $server)
    {
        if (isset($server['REQUEST_URI']))
            return $server['REQUEST_URI'];

        $server += ['PHP_SELF' => '', 'QUERY_STRING' => ''];
        if ('' !== $server['QUERY_STRING'])
            $server['QUERY_STRING'] = '?' . $server['QUERY_STRING'];

        return $server['PHP_SELF'] . $server['QUERY_STRING'];
    }

    /**
     * Format the user info
     *
     * @param string $user
     * @param string $pass
     *
     * @return string
     */

    protected function buildUserInfo($user, $pass)
    {
        $userinfo = $user;
        if (in_array($userinfo, [null, ''], true))
            return '';

        if (!in_array($pass, [null, ''], true))
            $userinfo .= ':' . $pass;

        return $userinfo . '@';
    }
}
