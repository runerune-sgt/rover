<?php

namespace MarsRover\Rover;
use MarsRover\Rover\Position;

class FakeSensor implements Sensor {
	private $obstacles = [];

	public function addObstacle(Position $position) {
		$this->obstacles[] = $position;
	}

	public function isObstacle(Position $position) {
		foreach($this->obstacles as $obstacle) {
			if($position->x === $obstacle->x && $position->y === $obstacle->y) {
				return true;
			}
		}

		return false;
	}

}