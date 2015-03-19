<?php
/*
 * This file is part of the SearchBundle package.
 *
 * (c) Axel Etcheverry <axel@etcheverry.biz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Euskadi31\Bundle\SearchBundle\Tests\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Euskadi31\Bundle\SearchBundle\DependencyInjection\Euskadi31SearchExtension;

class Euskadi31SearchExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Euskadi31SearchExtension
     */
    protected $extension;

    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     *
     */
    protected function initContainer()
    {
        $this->extension = new Euskadi31SearchExtension();
        $this->container = new ContainerBuilder();
        $this->container->register('event_dispatcher', new EventDispatcher());
        $this->container->registerExtension($this->extension);
        $this->container->setParameter('kernel.debug', true);
    }

    /**
     * @param ContainerBuilder $container
     * @param $resource
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../_files/'));
        $loader->load($resource . '.yml');
    }

    public function testSearchConfig()
    {
        $this->initContainer();
        $this->loadConfiguration($this->container, 'search_config');

        $this->container->compile();

        $this->assertTrue($this->container->has('search'));
        $search = $this->container->get('search');
        $this->assertInstanceOf('Search\Engine\SphinxQL', $search);
    }
}
