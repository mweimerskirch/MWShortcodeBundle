<?php

namespace MW\Bundle\ShortcodeBundle\Twig\Extension;

use MW\Bundle\ShortcodeBundle\Helper\ShortcodeHelper;

/**
 * 
 *
 * @author Michel Weimerskirch
 */
class ShortcodeTwigExtension extends \Twig_Extension
{

    protected $helper;

    function __construct(ShortcodeHelper $helper)
    {
        $this->helper = $helper;
    }

    public function getFilters()
    {
        return array(
            'shortcodes' => new \Twig_Filter_Method($this, 'shortcodes'),
        );
    }

    public function shortcodes($content)
    {
        return $this->helper->doShortcodes($content);
    }

    public function getName()
    {
        return 'shortcodes';
    }

}
