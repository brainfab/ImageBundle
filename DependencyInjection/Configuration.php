<?php namespace SmallTeam\ImageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('smallteam_image');

        $rootNode
            ->children()
                ->scalarNode('base_dir')->defaultValue('%kernel.root_dir%/../web/uploads')->end()
                ->scalarNode('image_engine')->defaultValue('SmallTeam\Engines\GDImageEngine')->end()
                ->scalarNode('imagick_path')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
