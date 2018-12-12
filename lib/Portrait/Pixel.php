<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Pixel\Canvas;

class Pixel
{
	/**
	 * @var	int
	 */
	public $cols = 0;

	/**
	 * @var	int
	 */
	public $rows = 0;

	/**
	 * @var	int
	 */
	public $xOffset = 0;

	/**
	 * @var	int
	 */
	public $yOffset = 0;

	/**
	 * @var	array
	 */
	public $subpixels = [];

	/**
	 * @param	int		$cols
	 * @param	int		$rows
	 * @param	int		$pixelSize
	 */
	public function __construct( $cols, $rows, $xOffset, $yOffset )
	{
		$this->cols = $cols;
		$this->rows = $rows;
		$this->xOffset = $xOffset;
		$this->yOffset = $yOffset;
	}

	/**
	 * @param	int		$col
	 * @param	int		$row
	 */
	public function clearSubpixel( $col, $row )
	{
		if( isset( $this->subpixels[$col][$row] ) )
		{
			unset( $this->subpixels[$col][$row] );
		}
	}

	/**
	 * @param	Pixels\Canvas	$canvas
	 * @param	int				$xOffset
	 * @param	int				$yOffset
	 */
	public function drawOnCanvas( Canvas &$canvas )
	{
		foreach( $this->subpixels as $col => $rows )
		{
			foreach( $rows as $row => $color )
			{
				$canvas->drawWithReflectionAt( $this->xOffset + $col, $this->yOffset + $row, $color );
			}
		}
	}

	/**
	 * @param	array	$pixelData
	 * @return	self
	 */
	static public function getInstanceFromData( array $pixelData )
	{
		$pixel = new self( $pixelData['cols'], $pixelData['rows'], $pixelData['xOffset'], $pixelData['yOffset'] );

		foreach( $pixelData['subpixels'] as $col => $rows )
		{
			foreach( $rows as $row => $color )
			{
				$pixel->setSubpixel( $col, $row, $color );
			}
		}

		return $pixel;
	}

	/**
	 * @param	string	$color
	 */
	public function setAllSubpixels( $color )
	{
		for( $col = 0; $col < $this->cols; $col++ )
		{
			for( $row = 0; $row < $this->rows; $row++ )
			{
				$this->subpixels[$col][$row] = $color;
			}
		}
	}

	/**
	 * @param	string	$char
	 * @param	string	$color
	 */
	public function setSubpixelsWithHexValue( $char, $color )
	{
		$bits['0'] = [0,0,0,0];
		$bits['1'] = [0,0,0,1];
		$bits['2'] = [0,0,1,0];
		$bits['3'] = [0,0,1,1];
		$bits['4'] = [0,1,0,0];
		$bits['5'] = [0,1,0,1];
		$bits['6'] = [0,1,1,0];
		$bits['7'] = [0,1,1,1];
		$bits['8'] = [1,0,0,0];
		$bits['9'] = [1,0,0,1];
		$bits['a'] = [1,0,1,0];
		$bits['b'] = [1,0,1,1];
		$bits['c'] = [1,1,0,0];
		$bits['d'] = [1,1,0,1];
		$bits['e'] = [1,1,1,0];
		$bits['f'] = [1,1,1,1];

		$subpixelCoordinates[0] = [0,0];	// 3
		$subpixelCoordinates[1] = [0,1];	// 2
		$subpixelCoordinates[2] = [1,0];	// 1
		$subpixelCoordinates[3] = [1,1];	// 0

		$subpixelBits = $bits[$char];

		foreach( $subpixelBits as $key => $bitValue )
		{
			$xCoordinate = $subpixelCoordinates[$key][0];
			$yCoordinate = $subpixelCoordinates[$key][1];

			if( $bitValue == 0 )
			{
				$this->clearSubpixel( $xCoordinate, $yCoordinate );
			}
			else
			{
				$this->setSubpixel( $xCoordinate, $yCoordinate, $color );
			}
		}
	}

	/**
	 * @param	int		$col
	 * @param	int		$row
	 * @param	string	$color
	 */
	public function setSubpixel( $col, $row, $color )
	{
		// Don't overdraw an already filled subpixel
		if( isset( $this->subpixels[$col][$row] ) )
		{
			return;
		}

		$this->subpixels[$col][$row] = $color;
	}
}
