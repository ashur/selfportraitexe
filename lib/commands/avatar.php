<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Bot\Twitter;
use Huxtable\CLI\Command;
use Huxtable\Core\Utils;
use Huxtable\Pixel;

/**
 * @command		avatar
 * @desc		Generate an avatar
 * @usage		avatar
 */
$commandAvatar = new Command( 'avatar', 'Generate an avatar', function()
{
	GLOBAL $bot;

	$dirTemp = $bot->getTempDirectory();

	/* Canvas */
	$canvasCols = 39;
	$canvasRows = $canvasCols;
	$canvasPixelSize = 16;

	$canvas = new Pixel\Canvas( $canvasCols, $canvasRows, $canvasPixelSize );

	/* Colors */
	$colorsLeft[] = '#0e1927';
	$colorsLeft[] = '#1e3236';
	$colorsLeft[] = '#283030';
	$colorsLeft[] = '#314943';
	$colorsLeft[] = '#3e3219';
	$colorsLeft[] = '#773922';

	$colorsRight[] = '#09331f';
	$colorsRight[] = '#31322a';
	$colorsRight[] = '#0f3748';
	$colorsRight[] = '#162e37';
	$colorsRight[] = '#251622';
	$colorsRight[] = '#0b4a2c';
	$colorsRight[] = '#6d2221';

	$colorsAll = array_merge( $colorsLeft, $colorsRight );

	for( $col = 0 * ($canvasCols / 3); $col < 1 * ($canvasCols / 3); $col++ )
	{
		for( $row = 0; $row < $canvasRows; $row++ )
		{
			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsLeft ) );
		}
	}

	for( $col = 1 * ($canvasCols / 3); $col < 2 * ($canvasCols / 3); $col++ )
	{
		for( $row = 0; $row < $canvasRows; $row++ )
		{
			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsAll ) );
		}
	}

	for( $col = 2 * ($canvasCols / 3); $col < 3 * ($canvasCols / 3); $col++ )
	{
		for( $row = 0; $row < $canvasRows; $row++ )
		{
			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsRight ) );
		}
	}

	/* Diskette */
	$colorsDiskette[] = '#f2b743';
	$colorsDiskette[] = '#f3bb4d';
	$colorsDiskette[] = '#f3be55';

	$excludedPixels[] = [31,7];
	$excludedPixels[] = [32,7];
	$excludedPixels[] = [32,8];
	$excludedPixels[] = [31,31];

	for( $col = 7; $col <= 32; $col++ )
	{
		for( $row = 7; $row <= 32; $row++ )
		{
			/* Exclusions */
			if( in_array( [$col, $row], $excludedPixels ) )
			{
				continue;
			}

			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsDiskette ) );
		}
	}

	/* Diskette Label */
	$colorsLabel[] = '#ffffff';
	$colorsLabel[] = '#fdfdfd';
	$colorsLabel[] = '#fbfbfb';

	for( $col = 10; $col <= 29; $col++ )
	{
		for( $row = 19; $row <= 32; $row++ )
		{
			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsLabel ) );
		}
	}

	/* Diskette Label Stripe */
	$colorsStripe[] = '#ff5500';
	$colorsStripe[] = '#e64d00';
	$colorsStripe[] = '#cc4400';

	for( $col = 10; $col <= 29; $col++ )
	{
		$canvas->drawAt( $col, 32, Utils::randomElement( $colorsStripe ) );
	}

	/* Diskette Inset */
	$colorsInset[] = '#eaa823';
	$colorsInset[] = '#e1a122';
	$colorsInset[] = '#d89b20';

	for( $col = 10; $col <= 26; $col++ )
	{
		for( $row = 7; $row <= 15; $row++ )
		{
			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsInset ) );
		}
	}

	/* Gate */
	$colorsGate[] = '#f4f0f0';
	$colorsGate[] = '#ebe8e8';
	$colorsGate[] = '#e8e4e4';

	$excludedPixels[] = [22,8];
	$excludedPixels[] = [23,8];
	$excludedPixels[] = [24,8];
	$excludedPixels[] = [22,9];
	$excludedPixels[] = [23,9];
	$excludedPixels[] = [24,9];
	$excludedPixels[] = [22,10];
	$excludedPixels[] = [23,10];
	$excludedPixels[] = [24,10];
	$excludedPixels[] = [22,11];
	$excludedPixels[] = [23,11];
	$excludedPixels[] = [24,11];
	$excludedPixels[] = [22,12];
	$excludedPixels[] = [23,12];
	$excludedPixels[] = [24,12];
	$excludedPixels[] = [22,13];
	$excludedPixels[] = [23,13];
	$excludedPixels[] = [24,13];

	for( $col = 13; $col <= 26; $col++ )
	{
		for( $row = 7; $row <= 14; $row++ )
		{
			/* Exclusions */
			if( in_array( [$col, $row], $excludedPixels ) )
			{
				continue;
			}

			$canvas->drawAt( $col, $row, Utils::randomElement( $colorsGate ) );
		}
	}

	$fileImage = $dirTemp->child( 'avatar.png' );
	$canvas->render( $fileImage );
});

return $commandAvatar;
