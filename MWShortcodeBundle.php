<?php

namespace MW\Bundle\ShortcodeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MW\Bundle\ShortcodeBundle\DependencyInjection\Compiler\ShortcodePass;

/**
 * 
 *
 * @author Michel Weimerskirch
 */
class MWShortcodeBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ShortcodePass());
    }

}
