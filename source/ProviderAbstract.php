<?php

namespace Apishka\Uri;

/**
 * Provider abstract
 */
abstract class ProviderAbstract
{
    /**
     * Traits
     */
    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getUri();
    }
}
