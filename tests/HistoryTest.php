<?php

namespace MarsRover;
use PHPUnit\Framework\TestCase;
use MarsRover\Rover\Orientation;
use MarsRover\Rover\Position;
use MarsRover\Rover\History;


class HistoryTest extends TestCase {
	public function testPushState() {
		$history = new History();

		$position = new Position(2, 4);
		$orientation = new Orientation(0, 1);

		$history->push($position, $orientation);

		self::assertEquals($position, $history->registry[0]->position);
		self::assertEquals($orientation, $history->registry[0]->orientation);
	}


}