<?php

namespace MW\Bundle\ShortcodeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * 
 *
 * @author Michel Weimerskirch
 */
class ShortcodePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('templating.helper.shortcode');
        foreach ($container->findTaggedServiceIds('mw.shortcode') as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall('addShortcodeType', array($attributes['alias'], new Reference($id)));
            }
        }
    }

}
