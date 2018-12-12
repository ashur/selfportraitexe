<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Core\File;
use Huxtable\Pixel\Canvas;

class Portrait
{
	/**
	 * @var	Huxtable\Pixel\Canvas
	 */
	protected $canvas;

	/**
	 * @var	int
	 */
	public $id = 0;

	/**
	 * @var	array
	 */
	public $pixels = [];

	/**
	 */
	public function __construct()
	{
		$canvasCols = 16;
		$canvasRows = 12;
		$pixelSize = 10;

		$this->canvas = new Canvas( $canvasCols, $canvasRows, $pixelSize );
		$this->canvas->setBackgroundColor( '#000000' );

		/* Create pixels */
		$xOffset = 0;
		$yOffset = 0;

		for( $row = 0; $row <= 5; $row++ )
		{
			for( $col = 0; $col <= 3; $col++ )
			{
				$this->pixels[] = new Pixel( 2, 2, $xOffset + $col * 2, $yOffset + $row * 2 );
			}
		}
	}

	/**
	 * @param	string	$hashString
	 */
	public function applyHash( $hashString )
	{
		$hashColor = substr( $hashString, 0, 6 );
		$hashChars = substr( $hashString, 6 );

		for( $p = 0; $p < count( $this->pixels ); $p++ )
		{
			if( !isset( $hashChars[$p] ) )
			{
				break;
			}

			$pixel = &$this->pixels[$p];
			$hashChar = $hashChars[$p];

			$pixel->setSubpixelsWithHexValue( $hashChar, "#{$hashColor}" );
		}
	}

	/**
	 * @return	Huxtable\Pixel\Canvas
	 */
	public function getCanvas()
	{
		foreach( $this->pixels as $pixel )
		{
			$pixel->drawOnCanvas( $this->canvas );
		}

		return $this->canvas;
	}

	/**
	 * @param	Huxtable\Core\File\File		$file
	 * @return	self
	 */
	static public function getInstanceFromFile( File\File $file )
	{
		$portrait = new self();

		$portraitData = json_decode( $file->getContents(), true );
		if( isset( $portraitData['pixels'] ) )
		{
			$portrait->setPixels( $portraitData['pixels'] );
		}

		$portrait->id = $portraitData['id'];

		return $portrait;
	}

	/**
	 * Overwrite pixels array
	 *
	 * @param	array	$pixels
	 */
	public function setPixels( array $pixels )
	{
		foreach( $pixels as $index => $pixelData )
		{
			$pixel = Pixel::getInstanceFromData( $pixelData );
			$this->pixels[$index] = $pixel;
		}
	}
}
