<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Bot\Twitter;
use Huxtable\CLI\Command;

/**
 * @command		tweet
 * @desc		Generate a portrait and tweet it
 * @usage		tweet
 */
$commandTweet = new Command( 'tweet', 'Generate a portrait and tweet it', function()
{
	GLOBAL $bot;

	$dirProject = $bot->getProjectDirectory();
	$portraitFile = $dirProject->child( 'selfportrait.json' );
	if( !$portraitFile->exists() )
	{
		$portraitFile->create();
	}

	$portrait = Portrait::getInstanceFromFile( $portraitFile );

	$commitHash = $bot->getCurrentCommitHash();
	$commitShortHash = $commitHash != null ? substr( $commitHash, 0, 8 ) : 'the beginning';

	/*
	 * Draw portrait frames
	 */
	$frameGutter = 79;

	/* Left */
	if( $portrait->id > 1 )
	{
		$bot->drawPortraitFrame( 27 - $frameGutter );
	}

	/* Center, with title card */
	$bot->drawPortraitFrame( 27 );
	$bot->drawTitleCard();

	/* Cover center frame (very first tweet only) */
	if( $portrait->id == 0 )
	{
		$bot->drawPortraitCover();
	}
	/* Draw the portrait */
	else
	{
		$portrait->applyHash( $commitHash );
		$bot->drawPortrait( $portrait );
	}

	/* Right */
	$bot->drawPortraitFrame( 27 + $frameGutter );

	$fileImage = $bot->renderPortrait();

	/*
	 * Update portrait file
	 */
	$portrait->id++;
	$jsonPortrait = json_encode( $portrait );
	$portraitFile->putContents( $jsonPortrait );

	/* Commit and push changes to selfportrait.json */
	if( $commitHash != null )
	{
		$bot->gitStagePortraitFile();
		$bot->gitCommitWithMessage( "self portrait at {$commitShortHash}" );

		$setUpstream = false;
	}
	else
	{
		$bot->gitStageAllFiles();
		$bot->gitCommitWithMessage( 'initial commit' );

		$setUpstream = true;
	}

	$bot->gitPush( $setUpstream );

	/*
	 * Tweet
	 */
	$tweet = new Twitter\Tweet();
	$tweet->attachMedia( $fileImage );

	/* Post it */
	try
	{
		$bot->postTweetToTwitter( $tweet );
	}
	catch( \Exception $e )
	{
		throw new Command\CommandInvokedException( $e->getMessage(), 1 );
	}
});

return $commandTweet;
