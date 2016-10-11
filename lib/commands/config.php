<?php

use Huxtable\CLI\Command;
use Huxtable\CLI\Format;
use Huxtable\CLI\Input;
use Huxtable\Core\File;

/**
 * @command		config
 * @desc		Configure the local environment
 * @usage		config <domain> [<key> [<value>]]
 */
$commandConfig = new Command( 'config', "Configure the local environment for '{$appName}'", function( $query=null, $value=null )
{
	GLOBAL $bot;

	$config = $bot->getConfigObject();

	if( is_null( $query ) )
	{
		$configData = $config->getData();

		foreach( $configData as $domain => $domainItems )
		{
			echo $domain . PHP_EOL;

			foreach( $domainItems as $key => $value )
			{
				echo " • {$key}={$value}" . PHP_EOL;
			}

			echo PHP_EOL;
		}

		return;
	}

	/*
	 * Parse query
	 */
	$queryPieces = explode( '.', $query );
	$domain = $queryPieces[0];

	if( !isset( $queryPieces[1] ) )
	{
		$domainItems = $config->getDomain( $domain );
		if( is_null( $domainItems ) )
		{
			throw new Command\CommandInvokedException( "Unknown config domain '{$domain}'.", 1 );
		}

		foreach( $domainItems as $key => $value )
		{
			echo " • {$key}={$value}" . PHP_EOL;
		}

		return;
	}

	$key = $queryPieces[1];

	switch( $domain )
	{
		case 'twitter':
			$configKeys =
			[
				[ 'name' => 'consumerKey', 'description' => 'Consumer Key' ],
				[ 'name' => 'consumerSecret', 'description' => 'Consumer Secret' ],
				[ 'name' => 'accessToken', 'description' => 'Access Token' ],
				[ 'name' => 'accessTokenSecret', 'description' => 'Access Token Secret' ],
			];
			break;

		default:
			throw new Command\CommandInvokedException( "Unknown domain '{$domain}'.", 1 );
	}

	/*
	 * Read values
	 */
	if( is_null( $value ) )
	{
		$domainValues = $config->getDomain( $domain );
		if( !isset( $domainValues[$key] ) )
		{
			// Exit silently
			exit( 1 );
		}

		echo $domainValues[$key] . PHP_EOL;
		return;
	}

	/*
	 * Write values
	 */
	foreach( $configKeys as $configKey )
	{
		if( $configKey['name'] == $key )
		{
			$config->setValue( $domain, $key, $value );
			$config->write();

			return;
		}
	}

	throw new Command\CommandInvokedException( "Unsupported key '{$key}' for domain '{$domain}'" );
});

$commandConfig->setUsage( 'config <domain> [<key> [<value>]]' );

return $commandConfig;
