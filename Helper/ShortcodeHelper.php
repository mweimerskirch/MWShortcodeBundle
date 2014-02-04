<?php

namespace MW\Bundle\ShortcodeBundle\Helper;

use Symfony\Component\Templating\Helper\HelperInterface;

/**
 *
 *
 * @author Michel Weimerskirch
 */
class ShortcodeHelper implements HelperInterface
{

    private static $shortcodes = array();

    public static function addShortcodeType($alias, $shortcode)
    {
        self::$shortcodes[$alias] = $shortcode;
    }

    private function getShortcodeNamesRegex()
    {
        $shortcode_names = array_keys(self::$shortcodes);
        $shortcode_names_regex = join('|', array_map('preg_quote', $shortcode_names));

        return $shortcode_names_regex;
    }

    public function doShortcodes($content)
    {
        $shortcode_names_regex = $this->getShortcodeNamesRegex();
        $content = preg_replace_callback("/\[($shortcode_names_regex)( [^\]]*)?\](?:(.+?)?\[\/\\1\])?/", array($this, 'replaceShortcode'), $content);

        return $content;
    }

    public function replaceShortcode($code)
    {
        $alias = $code[1];
        $atts = (isset($code[2])) ? $code[2] : "";

        $options = array();
        foreach (explode(" ", $atts) as $att) {
            $att = trim($att);
            if (!$att) {
                continue;
            }
            list($name, $value) = explode('=', $att);
            $options[trim($name)] = trim($value);
        }

        return self::$shortcodes[$alias]->parse($options);
    }

    /**
     * {@inheritDoc}
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * {@inheritDoc}
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'shortcode';
    }

}
