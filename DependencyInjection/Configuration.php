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
        $rootNode = $treeBuilder->root('janisgruzis_ssh');

		$rootNode
			->children()
				->arrayNode('connections')
					->children()
						->scalarNode('host')
							->isRequired()
							->cannotBeEmpty()
						->end()
						->scalarNode('config')
							->cannotBeEmpty()
							->defaultValue('~/.ssh/config')
						->end()
						->scalarNode('username')
							->cannotBeEmpty()
						->end()
						->scalarNode('password')
							->cannotBeEmpty()
						->end()
					->end()
				->end()
			->end()
		;

        return $treeBuilder;
    }
}