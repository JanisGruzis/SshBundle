<?php

namespace JanisGruzis\SshBundle\Factory;

use Ssh\Authentication\Agent;
use Ssh\Authentication\HostBasedFile;
use Ssh\Authentication\Password;
use Ssh\Authentication\None;
use Ssh\Authentication\PublicKeyFile;
use Ssh\Configuration;
use Ssh\SshConfigFileConfiguration;
use Ssh\Session;

/**
 * Create ssh session.
 * @package JanisGruzis\SshBundle\Factory
 */
class SessionFactory
{
	/**
	 * Get ssh session from configuration.
	 * @param array $config
	 * @return \Ssh\Session
	 * @throws \Exception
	 */
	public static function getSession(array $config)
	{
		$session = null;

		switch ($config['type'])
		{
			case 'public_key':
				$session = self::getPublicKeyFileSession($config);
				break;
			case 'none':
				$session = self::getNoneSession($config);
				break;
			case 'password':
				$session = self::getPasswordSession($config);
				break;
			case 'config':
				$session = self::getConfigSession($config);
				break;
			case 'agent':
				$session = self::getAgentSession($config);
				break;
			case 'hostbased':
				$session = self::getHostbasedSession($config);
				break;
		}

		return $session;
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getConfigSession($config)
	{
		$configuration = new SshConfigFileConfiguration($config['config'], $config['host_name']);
		$authentication = $configuration->getAuthentication(
			(isset($config['password']) ? $config['password'] : null),
			(isset($config['username']) ? $config['username'] : null)
		);

		return new Session($configuration, $authentication);
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getPasswordSession($config)
	{
		$configuration = new Configuration($config['host']);
		$authentication = new Password($config['username'], $config['password']);

		return new Session($configuration, $authentication);
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getNoneSession($config)
	{
		$configuration = new Configuration($config['host']);
		$authentication = new None($config['username']);

		return new Session($configuration, $authentication);
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getAgentSession($config)
	{
		$configuration = new Configuration($config['host']);
		$authentication = new Agent($config['username']);

		return new Session($configuration, $authentication);
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getPublicKeyFileSession($config)
	{
		$configuration = new Configuration($config['host']);
		$authentication = new PublicKeyFile(
			$config['username'],
			$config['public_key_file'],
			$config['private_key_file'],
			isset($config['pass_phrase']) ? $config['pass_phrase'] : null
		);

		return new Session($configuration, $authentication);
	}

	/**
	 * @param $config
	 * @return Session
	 */
	protected static function getHostbasedSession($config)
	{
		$configuration = new Configuration($config['host']);
		$authentication = new HostBasedFile(
			$config['username'],
			$config['hostname'],
			$config['public_key_file'],
			$config['private_key_file'],
			isset($config['pass_phrase']) ? $config['pass_phrase'] : null,
			isset($config['local_username']) ? $config['local_username'] : null
		);

		return new Session($configuration, $authentication);
	}
}