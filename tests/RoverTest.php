<?php

namespace MarsRover;

use PHPUnit\Framework\TestCase;
use MarsRover\Rover;

class RoverTest extends TestCase {
	public function setUp(int $x = 0, int $y = 0) {
		$this->rover = new Rover($x, $y);
	}

	public function testMoveForward() {
		$this->rover->handle(['f']);

		self::assertEquals(0, $this->rover->position->x);
		self::assertEquals(1, $this->rover->position->y);

		$this->rover->handle(['f']);

		self::assertEquals(2, $this->rover->position->y);
	}

	public function testMoveBackward() {
		$this->setUp(2, 2);

		$this->rover->handle(['b']);

		self::assertEquals(1, $this->rover->position->y);
	}

	public function testTurnRight() {
		$this->setUp(2, 2);

		$this->rover->handle(['r']);
		self::assertEquals([0, -1], $this->rover->orientation->vector);

		$this->rover->handle(['f']);
		self::assertEquals(1, $this->rover->position->x);

		$this->rover->handle(['r']);
		self::assertEquals([-1, 0], $this->rover->orientation->vector);

		$this->rover->handle(['f']);
		self::assertEquals(1, $this->rover->position->y);
	}

	public function testTurnLeft() {
		$this->setUp(2, 2);

		$this->rover->handle(['l']);
		self::assertEquals([0, 1], $this->rover->orientation->vector);

		$this->rover->handle(['f']);
		self::assertEquals(3, $this->rover->position->x);
		self::assertEquals(2, $this->rover->position->y);

		$this->rover->handle(['l']);
		self::assertEquals([-1, 0], $this->rover->orientation->vector);

		$this->rover->handle(['f']);
		self::assertEquals(3, $this->rover->position->x);
		self::assertEquals(1, $this->rover->position->y);
	}

	public function testTurnNorthEastMoveFwd() {
		$this->setUp(2, 2);

		$this->rover->orientation->vector = [1, 1];
		$this->rover->handle(['f']);

		self::assertEquals(3, $this->rover->position->x);
		self::assertEquals(3, $this->rover->position->y);
	}

	public function testTurnNorthEastMoveBack() {
		$this->setUp(2, 2);

		$this->rover->orientation->vector = [1, 1];
		$this->rover->handle(['b']);

		self::assertEquals(1, $this->rover->position->x);
		self::assertEquals(1, $this->rover->position->y);
	}

	public function testIncorrectCommand() {
		static::expectException(\InvalidArgumentException::class);
		$this->rover->handle(['INVALID']);
	}


}