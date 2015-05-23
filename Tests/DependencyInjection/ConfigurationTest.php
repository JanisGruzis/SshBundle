<?php

namespace JanisGruzis\SshBundle\Tests\Controller;

use JanisGruzis\SshBundle\DependencyInjection\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testGetConfigTreeBuilder()
    {
		$configuration = new Configuration();
		$treeBuilder = $configuration->getConfigTreeBuilder();

		$this->assertInstanceOf(
			'Symfony\\Component\\Config\\Definition\\Builder\\TreeBuilder',
			$treeBuilder
		);
    }
}
