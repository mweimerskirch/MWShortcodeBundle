<?php

namespace MW\Bundle\ShortcodeBundle\Shortcode;

/**
 * 
 *
 * @author Michel Weimerskirch
 */
abstract class BaseShortcode
{

    abstract public function parse($options);

}
