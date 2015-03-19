<?php
/*
 * This file is part of the SearchBundle package.
 *
 * (c) Axel Etcheverry <axel@etcheverry.biz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Euskadi31\Bundle\SearchBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\ContainerBuilderDebugDumpPass;
use Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\CompilerDebugDumpPass;
use Euskadi31\Bundle\SearchBundle\DependencyInjection\Compiler\RegisterListenersPass;

class Euskadi31SearchBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterListenersPass(), PassConfig::TYPE_BEFORE_REMOVING);

        if ($container->getParameter('kernel.debug')) {
            $container->addCompilerPass(new ContainerBuilderDebugDumpPass(), PassConfig::TYPE_AFTER_REMOVING);
            $container->addCompilerPass(new CompilerDebugDumpPass(), PassConfig::TYPE_AFTER_REMOVING);
        }
    }
}
