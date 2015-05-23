<?php

namespace JanisGruzis\SshBundle\Tests\Controller;

use JanisGruzis\SshBundle\DependencyInjection\JanisGruzisSshExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class JanisGruzisSshExtensionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @param array $config
	 * @param array $services
	 * @dataProvider loadDataProvider
	 */
    public function testLoad(array $config, array $services)
    {
		$container = new ContainerBuilder();
		$extension = new JanisGruzisSshExtension();
		$extension->load($config, $container);

		$this->assertEquals(
			sort($services),
			sort($container->getServiceIds())
		);

		foreach ($services as $service)
		{
			$this->assertTrue($container->has($service));
		}
    }

	public function loadDataProvider()
	{
		return [
			[
				[],
				[]
			],
			[
				[
					'janis_gruzis_ssh' => []
				],
				[]
			],
			[
				[
					'janis_gruzis_ssh' => [
						'connections' => []
					]
				],
				[]
			],
			[
				[
					'janis_gruzis_ssh' => [
						'connections' => [
							'simple' => [
								'type' => 'none',
								'host' => 'foo.com',
								'username' => 'foo',
							]
						]
					]
				],
				[
					'ssh.session.simple',
				]
			],
			[
				[
					'janis_gruzis_ssh' => [
						'connections' => [
							'none' => [
								'type' => 'none',
								'host' => 'foo.com',
								'username' => 'foo',
							],
							'password' => [
								'type' => 'password',
								'host' => 'foo.com',
								'username' => 'foo',
								'password' => 'bar',
							],
							'config' => [
								'type' => 'config',
								'config' => '~/.ssh/config',
								'host_name' => 'bar_foo_com',
								'username' => 'foo',
								'password' => 'bar',
							],
							'agent' => [
								'type' => 'agent',
								'host' => 'foo.com',
								'username' => 'foo',
							],
							'public_key' => [
								'type' => 'public_key',
								'host' => 'foo.com',
								'username' => 'foo',
								'pass_phrase' => 'bar',
								'public_key_file' => './.ssh/id_dsa.pub',
								'private_key_file' => './.ssh/id_dsa',
							],
							'hostbased' => [
								'type' => 'hostbased',
								'host' => 'foo.com',
								'hostname' => 'bar.foo.com',
								'username' => 'foo',
								'pass_phrase' => 'bar',
								'local_username' => 'bar',
								'public_key_file' => './.ssh/id_dsa.pub',
								'private_key_file' => './.ssh/id_dsa',
							],
						]
					]
				],
				[
					'ssh.session.none',
					'ssh.session.password',
					'ssh.session.config',
					'ssh.session.agent',
					'ssh.session.public_key',
					'ssh.session.hostbased',
				]
			]
		];
	}
}
