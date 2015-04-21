<?php

namespace JanisGruzis\SshBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('janis_gruzis_ssh');

		$rootNode
			->children()
				->arrayNode('connections')
					->useAttributeAsKey('name')
					->prototype('array')
						->children()
							->scalarNode('type')
								->isRequired()
								->validate()
								->ifNotInArray(['public_key', 'none', 'password', 'config', 'agent'])
									->thenInvalid('Invalid ssh connection type.')
								->end()
							->end()
							->scalarNode('host_name')->end()
							->scalarNode('host')->end()
							->scalarNode('public_key_file')->end()
							->scalarNode('private_key_file')->end()
							->scalarNode('config')->end()
							->scalarNode('username')->end()
							->scalarNode('pass_phrase')->end()
							->scalarNode('password')->end()
							->scalarNode('hostname')->end()
							->scalarNode('local_username')->end()
						->end()
					->end()
				->end()
			->end()
		;

        return $treeBuilder;
    }
}
