<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Core\File;
use Huxtable\Pixel;
use Spyc;

class Bot
{
	/**
	 * @var	Huxtable\Pixel\Canvas
	 */
	protected $canvas;

	/**
	 * @var	Huxtable\Core\File\File
	 */
	protected $dirProject;

	/**
	 * @return	void
	 */
	public function __construct()
	{
		/* Directories */
		$pathProject = dirname( dirname( __DIR__ ) );
		$this->dirProject = new File\Directory( $pathProject );

		/* Canvas */
		$canvasCols = 116;
		$canvasRows = 82;
		$canvasPixelSize = 5;

		$this->canvas = new Pixel\Canvas( $canvasCols, $canvasRows, $canvasPixelSize );
		$this->canvas->setBackgroundGradient( '#eeedec', '#eee9df' );
	}

	/**
	 * @param	Portrait\Portrait	$portrait
	 */
	public function drawPortrait( Portrait $portrait )
	{
		$this->canvas->compositeCanvas( $portrait->getCanvas(), 210, 135 );
	}

	/**
	 * This is ridiculous and I'm very ashamed :(
	 */
	public function drawPortraitCover()
	{
		$xOffset = 26;
		$yOffset = 16;
		$frameCols = 62;
		$frameRows = 40;

		$colorHighlightLow = '#ac0001';
		$colorHighlightMid = '#ac0001';
		$colorHighlightHigh = '#ff0000';
		$colorPins = '#000000';
		$colorSheetBase = '#e30000';
		$colorSheetShadow = '#d5cec2';

		// Shadow
		$this->canvas->fillRectangle( $xOffset, $yOffset + $frameRows + 8, $frameCols, 2, $colorSheetShadow );
		$this->canvas->fillRectangle( $xOffset + 2, $yOffset + $frameRows + 10, 8, 1, $colorSheetShadow );
		$this->canvas->fillRectangle( $xOffset + 20, $yOffset + $frameRows + 10, 4, 1, $colorSheetShadow );
		$this->canvas->fillRectangle( $xOffset + 40, $yOffset + $frameRows + 10, 4, 1, $colorSheetShadow );
		$this->canvas->fillRectangle( $xOffset + 54, $yOffset + $frameRows + 10, 8, 1, $colorSheetShadow );

		// Base
		$this->canvas->fillRectangle( $xOffset +  0, $yOffset +  0, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  3, $yOffset +  0, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  6, $yOffset +  0, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  9, $yOffset +  1, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 12, $yOffset +  1, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 15, $yOffset +  2, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 18, $yOffset +  3, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 21, $yOffset +  3, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 24, $yOffset +  4, 3, $frameRows + 7, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 27, $yOffset +  4, 3, $frameRows + 8, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 30, $yOffset +  5, 4, $frameRows + 8, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 34, $yOffset +  4, 3, $frameRows + 8, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 36, $yOffset +  4, 4, $frameRows + 7, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 39, $yOffset +  3, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 42, $yOffset +  3, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 45, $yOffset +  2, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 48, $yOffset +  1, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 51, $yOffset +  1, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 54, $yOffset +  0, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 57, $yOffset +  0, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 60, $yOffset +  0, 3, $frameRows, $colorSheetBase );

		// Lower
		$this->canvas->fillRectangle( $xOffset +  0, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  3, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  6, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset +  9, $yOffset +  9, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 12, $yOffset +  8, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 15, $yOffset +  8, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 18, $yOffset +  9, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 21, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 40, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 43, $yOffset +  9, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 46, $yOffset +  8, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 49, $yOffset +  8, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 52, $yOffset +  9, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 55, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 58, $yOffset + 10, 3, $frameRows, $colorSheetBase );
		$this->canvas->fillRectangle( $xOffset + 61, $yOffset + 10, 2, $frameRows, $colorSheetBase );

		// Pins
		$this->canvas->drawAt( $xOffset + 1, $yOffset + 1, $colorPins );
		$this->canvas->drawAt( $xOffset + 1, $yOffset + 2, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset + $frameCols - 1, $yOffset + 1, $colorPins );
		$this->canvas->drawAt( $xOffset + $frameCols - 1, $yOffset + 2, $colorHighlightLow );

		// Highlights
		$xOffset_fold1 = $xOffset + 3;
		$yOffset_fold1 = $yOffset + 6;

		$this->canvas->drawAt( $xOffset_fold1 + 0, $yOffset_fold1 + 0, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 0, $yOffset_fold1 + 1, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 0, $yOffset_fold1 + 2, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 0, $yOffset_fold1 + 3, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 1, $yOffset_fold1 + 4, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 1, $yOffset_fold1 + 5, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 1, $yOffset_fold1 + 6, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 1, $yOffset_fold1 + 7, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 2, $yOffset_fold1 + 8, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 2, $yOffset_fold1 + 9, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 2, $yOffset_fold1 + 10, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 3, $yOffset_fold1 + 11, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 3, $yOffset_fold1 + 12, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 3, $yOffset_fold1 + 13, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 4, $yOffset_fold1 + 14, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 4, $yOffset_fold1 + 15, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 4, $yOffset_fold1 + 16, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 5, $yOffset_fold1 + 17, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 5, $yOffset_fold1 + 18, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 5, $yOffset_fold1 + 19, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 6, $yOffset_fold1 + 20, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 6, $yOffset_fold1 + 21, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 6, $yOffset_fold1 + 22, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 7, $yOffset_fold1 + 23, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 7, $yOffset_fold1 + 24, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 8, $yOffset_fold1 + 25, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 8, $yOffset_fold1 + 26, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 9, $yOffset_fold1 + 27, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 9, $yOffset_fold1 + 28, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 10, $yOffset_fold1 + 29, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold1 + 10, $yOffset_fold1 + 30, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold1 + 11, $yOffset_fold1 + 31, $colorHighlightMid );

		// Fold 2
		$xOffset_fold2 = $xOffset + 8;
		$yOffset_fold2 = $yOffset + 7;

		$this->canvas->drawAt( $xOffset_fold2 + 0, $yOffset_fold2 + 0, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold2 + 1, $yOffset_fold2 + 1, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 2, $yOffset_fold2 + 1, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold2 + 3, $yOffset_fold2 + 2, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 4, $yOffset_fold2 + 2, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold2 + 5, $yOffset_fold2 + 3, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 6, $yOffset_fold2 + 3, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 7, $yOffset_fold2 + 3, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold2 + 8, $yOffset_fold2 + 4, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 9, $yOffset_fold2 + 4, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 10, $yOffset_fold2 + 4, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold2 + 11, $yOffset_fold2 + 5, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 12, $yOffset_fold2 + 5, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold2 + 13, $yOffset_fold2 + 5, $colorHighlightLow );

		// Fold 3a
		$xOffset_fold3 = $xOffset + 8;
		$yOffset_fold3 = $yOffset + 12;

		$this->canvas->drawAt( $xOffset_fold3 + 0, $yOffset_fold3 + 0, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold3 + 0, $yOffset_fold3 + 1, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold3 + 0, $yOffset_fold3 + 2, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold3 + 1, $yOffset_fold3 + 3, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold3 + 1, $yOffset_fold3 + 4, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold3 + 2, $yOffset_fold3 + 5, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold3 + 2, $yOffset_fold3 + 6, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold3 + 3, $yOffset_fold3 + 7, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold3 + 3, $yOffset_fold3 + 8, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold3 + 4, $yOffset_fold3 + 9, $colorHighlightLow );

		// Fold 3b
		$xOffset_fold3 = $xOffset + 13;
		$yOffset_fold3 = $yOffset + 21;

		// $this->canvas->drawAt( $xOffset_fold3 + 13, $yOffset_fold3 + 11, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 14, $yOffset_fold3 + 11, $colorHighlightLow );
		//
		// $this->canvas->drawAt( $xOffset_fold3 + 15, $yOffset_fold3 + 12, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 16, $yOffset_fold3 + 12, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 17, $yOffset_fold3 + 12, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 18, $yOffset_fold3 + 12, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 19, $yOffset_fold3 + 12, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 20, $yOffset_fold3 + 12, $colorHighlightLow );
		//
		// $this->canvas->drawAt( $xOffset_fold3 + 21, $yOffset_fold3 + 11, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 22, $yOffset_fold3 + 11, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 23, $yOffset_fold3 + 11, $colorHighlightLow );
		//
		// $this->canvas->drawAt( $xOffset_fold3 + 24, $yOffset_fold3 + 10, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 25, $yOffset_fold3 + 10, $colorHighlightLow );
		// $this->canvas->drawAt( $xOffset_fold3 + 26, $yOffset_fold3 + 10, $colorHighlightLow );
		//
		// $this->canvas->drawAt( $xOffset_fold3 + 27, $yOffset_fold3 +  9, $colorHighlightLow );

		// Fold 4
		$xOffset_fold4 = $xOffset + 57;
		$yOffset_fold4 = $yOffset + 3;

		$this->canvas->drawAt( $xOffset_fold4 -  0, $yOffset_fold4 + 0, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 -  1, $yOffset_fold4 + 1, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 -  2, $yOffset_fold4 + 1, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 -  3, $yOffset_fold4 + 2, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 -  4, $yOffset_fold4 + 2, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 -  5, $yOffset_fold4 + 3, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 -  6, $yOffset_fold4 + 3, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 -  7, $yOffset_fold4 + 4, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 -  8, $yOffset_fold4 + 4, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 -  9, $yOffset_fold4 + 5, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 10, $yOffset_fold4 + 5, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 11, $yOffset_fold4 + 5, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 - 12, $yOffset_fold4 + 6, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 13, $yOffset_fold4 + 6, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 14, $yOffset_fold4 + 6, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 15, $yOffset_fold4 + 6, $colorHighlightMid );

		$this->canvas->drawAt( $xOffset_fold4 - 16, $yOffset_fold4 + 7, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 17, $yOffset_fold4 + 7, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 18, $yOffset_fold4 + 7, $colorHighlightMid );
		$this->canvas->drawAt( $xOffset_fold4 - 19, $yOffset_fold4 + 7, $colorHighlightMid );

		// Fold 5
		$xOffset_fold5 = $xOffset + 60;
		$yOffset_fold5 = $yOffset + 7;

		$this->canvas->drawAt( $xOffset_fold5 + 0, $yOffset_fold5 + 0, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 + 0, $yOffset_fold5 + 1, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 + 0, $yOffset_fold5 + 2, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 1, $yOffset_fold5 + 3, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 1, $yOffset_fold5 + 4, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 1, $yOffset_fold5 + 5, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 2, $yOffset_fold5 + 6, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 2, $yOffset_fold5 + 7, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 2, $yOffset_fold5 + 8, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 3, $yOffset_fold5 + 9, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 3, $yOffset_fold5 + 10, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 4, $yOffset_fold5 + 11, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 4, $yOffset_fold5 + 12, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 5, $yOffset_fold5 + 13, $colorHighlightLow );
		$this->canvas->drawAt( $xOffset_fold5 - 5, $yOffset_fold5 + 14, $colorHighlightLow );

		$this->canvas->drawAt( $xOffset_fold5 - 6, $yOffset_fold5 + 15, $colorHighlightLow );

		// Fold 6
		$xOffset_fold6 = $xOffset + 57;
		$yOffset_fold6 = $yOffset + 14;

		// $this->canvas->drawAt( $xOffset_fold6 + 0, $yOffset_fold6 + 0, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 + 0, $yOffset_fold6 + 1, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 + 0, $yOffset_fold6 + 2, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 0, $yOffset_fold6 + 3, $colorHighlightMid );
		//
		// $this->canvas->drawAt( $xOffset_fold6 - 1, $yOffset_fold6 + 4, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 1, $yOffset_fold6 + 5, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 1, $yOffset_fold6 + 6, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 1, $yOffset_fold6 + 7, $colorHighlightMid );
		//
		// $this->canvas->drawAt( $xOffset_fold6 - 2, $yOffset_fold6 + 8, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 2, $yOffset_fold6 + 9, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 2, $yOffset_fold6 + 10, $colorHighlightMid );
		//
		// $this->canvas->drawAt( $xOffset_fold6 - 3, $yOffset_fold6 + 11, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 3, $yOffset_fold6 + 12, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 3, $yOffset_fold6 + 13, $colorHighlightMid );
		//
		// $this->canvas->drawAt( $xOffset_fold6 - 4, $yOffset_fold6 + 14, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 4, $yOffset_fold6 + 15, $colorHighlightMid );
		// $this->canvas->drawAt( $xOffset_fold6 - 4, $yOffset_fold6 + 16, $colorHighlightMid );
	}

	/**
	 * @param	int		$xOffset
	 */
	public function drawPortraitFrame( $xOffset )
	{
		$yOffset = 17;
		$frameCols = 60;
		$frameRows = 44;

		$colorFrameShadow = '#d5cec2';

		/* Shadow */
		$this->canvas->fillRectangle( $xOffset + 1, $yOffset + 1, $frameCols + 0, $frameRows + 0, $colorFrameShadow );

		/* Frame */
		$this->canvas->fillRectangle( $xOffset + 1, $yOffset + 0, $frameCols + 0, $frameRows + 0, '#725240' );

		/* Matte */
		$this->canvas->fillRectangle( $xOffset + 3, $yOffset + 2, $frameCols - 4, $frameRows - 4, '#ffffff' );
		/* Canvas */
		$this->canvas->fillRectangle( $xOffset + 5, $yOffset + 4, $frameCols - 8, $frameRows - 8, '#000000' );
	}

	/**
	 *
	 */
	public function drawTitleCard()
	{
		$xOffset = 51;
		$yOffset = 66;

		/* Shadow */
		$this->canvas->fillRectangle( $xOffset + 0, $yOffset + 1, 14, 9, '#00000006' );
		/* Card */
		$this->canvas->fillRectangle( $xOffset + 0, $yOffset + 0, 14, 9, '#ffffff' );

		/* "Text" Row 1 */
		$this->canvas->fillRectangle( $xOffset + 2, $yOffset + 2, 4, 1, '#8f8f8f' );
		$this->canvas->fillRectangle( $xOffset + 7, $yOffset + 2, 1, 1, '#8f8f8f' );
		$this->canvas->fillRectangle( $xOffset + 9, $yOffset + 2, 3, 1, '#8f8f8f' );

		/* "Text" Row 2 */
		$this->canvas->fillRectangle( $xOffset + 2, $yOffset + 4, 2, 1, '#dfdfdf' );
		$this->canvas->fillRectangle( $xOffset + 5, $yOffset + 4, 1, 1, '#dfdfdf' );
		$this->canvas->fillRectangle( $xOffset + 7, $yOffset + 4, 5, 1, '#dfdfdf' );

		/* "Text" Row 3 */
		$this->canvas->fillRectangle( $xOffset + 2, $yOffset + 6, 5, 1, '#dfdfdf' );
		$this->canvas->fillRectangle( $xOffset + 8, $yOffset + 6, 4, 1, '#dfdfdf' );
	}

	/**
	 * @param	string	$command
	 * @return	array
	 */
	public function executeGitCommand( $command )
	{
		chdir( $this->dirProject );

		exec( "git {$command} 2>&1", $output, $exit );

		$result['output'] = $output;
		$result['exit'] = $exit;

		return $result;
	}

	/**
	 * @return	string
	 */
	public function getCurrentCommitHash()
	{
		$commitHash = null;
		$result = $this->executeGitCommand( 'log --pretty=format:"%H" -n 1' );

		if( $result['exit'] == 0 )
		{
			$commitHash = $result['output'][0];
		}

		return $commitHash;
	}

	/**
	 * @return	Huxtable\Core\File\Directory
	 */
	public function getProjectDirectory()
	{
		return $this->dirProject;
	}

	/**
	 * @param	string	$message
	 */
	public function gitCommitWithMessage( $message )
	{
		$result = $this->executeGitCommand( "commit -m '{$message}'" );
	}

	/**
	 * @param	boolean		$setUpstream
	 */
	public function gitPush( $setUpstream )
	{
		$pushCommand = $setUpstream ? 'push --set-upstream origin selfportraitexe' : 'push';

		$result = $this->executeGitCommand( $pushCommand );
	}

	/**
	 * @return	void
	 */
	public function gitStageAllFiles()
	{
		$this->executeGitCommand( 'add .' );
	}

	/**
	 * @return	void
	 */
	public function gitStagePortraitFile()
	{
		$this->executeGitCommand( 'add selfportrait.json' );
	}

	/**
	 * Draw the portrait to disk
	 * @return	Huxtable\Core\File\File
	 */
	public function renderPortrait( File\Directory $dirTemp )
	{
		$fileImage = $dirTemp->child( 'portrait.png' );
		$this->canvas->render( $fileImage );

		return $fileImage;
	}

	/**
	 * @return	void
	 */
	public function writePortrait( Portrait $portrait, File\File $portraitFile )
	{
		$encodedPortrait = json_encode( $portrait, JSON_PRETTY_PRINT );
		echo $encodedPortrait . PHP_EOL;
	}
}
