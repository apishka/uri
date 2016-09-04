<?php namespace Apishka\Uri\Component;

/**
 * User
 */

class User
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
     */

    public function __construct($user)
    {
        $this->_user = $user;
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
}
