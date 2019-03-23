<?php

use Huxtable\Core\File;

$pathBase		= __DIR__;
$pathLib		= $pathBase . '/lib';
$pathApp		= $pathLib  . '/Portrait';
$pathVendor		= $pathBase . '/vendor';
$pathTemp		= getenv( 'SELFPORTRAIT_TEMPDIR' );

/*
 * Initialize autoloading
 */
include_once( $pathApp . '/Autoloader.php' );
Portrait\Autoloader::register();

include_once( $pathVendor . '/huxtable/core/autoload.php' );
include_once( $pathVendor . '/huxtable/pixel/autoload.php' );

/*
 * Some basics
 */
$dirApp = new File\Directory( $pathBase );
$dirLib = $dirApp->childDir( 'lib' );

$pathTemp = str_replace( '~', getenv( 'HOME' ), $pathTemp );
if( $pathTemp == false )
{
	echo 'Missing required environment variable SELFPORTRAIT_TEMPDIR' . PHP_EOL;
	exit( 1 );
}
$dirTemp = new File\Directory( $pathTemp );
if( !$dirTemp->exists() )
{
    $dirTemp->create();
}

/*
 * Colors
 */

$colors['ink'] = '#222232';
$colors['canvas'] = '#ffffff';
$colors['matte'] = '#dddcdc';
$colors['pins'] = '#dddddd';
$colors['sheet'] = '#150329';
$colors['sheet_lowlight'] = '#431B56';
$colors['sheet_midlight'] = '#682E7A';

/*
 * Bot configuration
 */
$bot = new Portrait\Bot();
$bot->setColors( $colors );

/*
 * Generate the image
 */
$dirProject = $bot->getProjectDirectory();
$portraitFile = $dirProject->child( 'selfportrait.json' );
if( !$portraitFile->exists() )
{
	$portraitFile->create();
}

$portrait = Portrait\Portrait::getInstanceFromFile( $portraitFile );
$portrait->setBackgroundColor( $colors['canvas'] );

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
	$portrait->applyHash( $commitHash, $colors['ink'] );
	$bot->drawPortrait( $portrait );
}

/* Right */
$bot->drawPortraitFrame( 27 + $frameGutter );

/**
 * Render image
 */
$fileImage = $bot->renderPortrait( $dirTemp );

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
