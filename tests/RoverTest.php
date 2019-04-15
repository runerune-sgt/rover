<?php

use PHPUnit\Framework\TestCase;
use MarsRover\Rover;
use MarsRover\Rover\Orientation;
use MarsRover\Rover\Position;
use MarsRover\Rover\Sensor;
use MarsRover\Rover\FakeSensor;

class RoverTest extends TestCase {
	public function setUp(int $x = 0, int $y = 0) {
		$orientation = new Orientation();
		$position = new Position($x, $y);

		$this->sensor = new FakeSensor();

		$this->rover = new Rover($orientation, $position, $this->sensor);
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

	public function testMoveBackwardTwice() {
		$this->setUp(2, 2);

		$this->rover->handle(['b', 'b']);

		self::assertEquals(0, $this->rover->position->y);
		self::assertEquals(2, $this->rover->position->x);
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

	public function testObstacleCollision() {
		$this->sensor->addObstacle(new Position(0, 1));

		$this->rover->handle(['f', 'f', 'f']);

		self::assertEquals(0, $this->rover->position->x);
		self::assertEquals(0, $this->rover->position->y);
	}

	public function testObstacleCollisionBackwards() {
		$this->sensor->addObstacle(new Position(0, 1));

		$this->rover->handle(['l', 'l', 'b']);

		self::assertEquals(0, $this->rover->position->x);
		self::assertEquals(0, $this->rover->position->y);
	}


}