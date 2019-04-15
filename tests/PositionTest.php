<?php

namespace MarsRover;
use MarsRover\Rover\Orientation;

use PHPUnit\Framework\TestCase;
use MarsRover\Rover\Position;

class PositionTest extends TestCase {
	public function testMoveFwd() {
		$pos = new Position(2, 2);
		$orientation = new Orientation(1, -1);

		self::assertEquals(1, $pos->forward($orientation)->x);
		self::assertEquals(3, $pos->forward($orientation)->y);
	}

	public function testMoveBack() {
		$pos = new Position(2, 2);
		$orientation = new Orientation(1, -1);

		self::assertEquals(3, $pos->back($orientation)->x);
		self::assertEquals(1, $pos->back($orientation)->y);
	}

	public function testWrapPositive() {
		$pos = new Position(12, 7);

		self::assertEquals(2, $pos->x);
		self::assertEquals(2, $pos->y);
	}

	public function testWrapNegative() {
		$pos = new Position(-7, -12);

		self::assertEquals(3, $pos->x);
		self::assertEquals(3, $pos->y);
	}

}