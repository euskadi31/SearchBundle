<?php
/*
 * This file is part of the SearchBundle package.
 *
 * (c) Axel Etcheverry <axel@etcheverry.biz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Euskadi31\Bundle\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('euskadi31_search');

        $rootNode
            ->children()
                ->scalarNode('engine')
                    ->isRequired()
                    ->defaultValue('Search\Engine\SphinxQL')
                ->end()
                ->arrayNode('server')
                    ->isRequired()
                    ->children()
                        ->scalarNode('host')->defaultValue('localhost')->end()
                        ->scalarNode('port')->defaultValue(9306)->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
