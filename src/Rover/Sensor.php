<?php

namespace MarsRover\Rover;
use MarsRover\Rover\Position;

interface Sensor {
	public function isObstacle(Position $position);
}