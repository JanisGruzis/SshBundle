<?php

namespace JanisGruzis\SshBundle\Tests\Controller;

use JanisGruzis\SshBundle\DependencyInjection\Configuration;
use JanisGruzis\SshBundle\Factory\SessionFactory;

class SessionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBadSession()
    {
		$factory = new SessionFactory();
		$session = $factory->getSession([
			'type' => 'foo.bar',
		]);
		$this->assertNull($session);
    }

	/**
	 * @param $config
	 * @dataProvider getSessionDataProvider
	 */
	public function testGetSession($config)
	{
		$factory = new SessionFactory();
		$session = $factory->getSession($config);

		$class = 'Ssh\\Session';
		$this->assertInstanceOf($class, $session);
	}

	public function getSessionDataProvider()
	{
		return [
			[
				[
					'type' => 'none',
					'host' => 'foo.com',
					'username' => 'foo',
				],
			],
			[
				[
					'type' => 'password',
					'host' => 'foo.com',
					'username' => 'foo',
					'password' => 'bar',
				],
			],
			[
				[
					'type' => 'config',
					'config' => __DIR__ . '/../Files/config',
					'host_name' => 'bar_foo_com',
					'username' => 'foo',
					'password' => 'bar',
				],
			],
			[
				[
					'type' => 'agent',
					'host' => 'foo.com',
					'username' => 'foo',
				],
			],
			[
				[
					'type' => 'public_key',
					'host' => 'foo.com',
					'username' => 'foo',
					'pass_phrase' => 'bar',
					'public_key_file' => __DIR__ . '/../Files/id_dsa.pub',
					'private_key_file' => __DIR__ . '/../Files/id_dsa',
				],
			],
			[
				[
					'type' => 'hostbased',
					'host' => 'foo.com',
					'hostname' => 'bar.foo.com',
					'username' => 'foo',
					'pass_phrase' => 'bar',
					'local_username' => 'bar',
					'public_key_file' => __DIR__ . '/../Files/id_dsa.pub',
					'private_key_file' => __DIR__ . '/../Files/id_dsa',
				],
			],
		];
	}
}
