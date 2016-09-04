<?php namespace Apishka\Uri\Component;

use Apishka\Uri\ComponentAbstract;

/**
 * User
 */

class User extends ComponentAbstract
{
    /**
     * Traits
     */

    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * User
     *
     * @var string
     */

    private $_user;

    /**
     * Construct
     *
     * @param string $user
     * @param array  $options
     */

    public function __construct($user, $options = array())
    {
        $this->setOptions($options);
        $this->parse($user);
    }

    /**
     * Parse
     *
     * @param string $user
     *
     * @return User this
     */

    protected function parse($user)
    {
        $this->_user = (string) $user;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */

    public function __toString()
    {
        return (string) $this->_user;
    }

    /**
     * Is empty
     *
     * @return bool
     */

    public function isEmpty()
    {
        return $this->_user === '';
    }
}
