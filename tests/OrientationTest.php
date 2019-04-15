<?php

namespace MarsRover;

use PHPUnit\Framework\TestCase;
use MarsRover\Rover\Orientation;

class OrientationTest extends TestCase {
	public function testGetOrientation() {
		$pos = new Orientation(-1, 0);
		self::assertEquals(2, $pos->determine_orientation());

		$pos = new Orientation(0, 1);
		self::assertEquals(3, $pos->determine_orientation());
	}

	public function testWrongOrientationXConstructor() {
		static::expectException(\InvalidArgumentException::class);
		$pos = new Orientation(-2, 0);
	}

	public function testWrongOrientationYConstructor() {
		static::expectException(\InvalidArgumentException::class);
		$pos = new Orientation(0, 2);
	}

	public function testSetOrientation() {
		$pos = new Orientation(-1, 0);

		self::assertEquals([1, 0], $pos->orient(0));
		self::assertEquals([0, -1], $pos->orient(1));
	}

	public function testTurn() {
		$pos = new Orientation(1, 0);

		$pos = $pos->turn(Orientation::TURN_LEFT);
		self::assertEquals([0, 1], $pos->vector);

		$pos = $pos->turn(Orientation::TURN_RIGHT);
		self::assertEquals([1, 0], $pos->vector);
	}


}