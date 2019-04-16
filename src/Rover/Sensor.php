<?php

declare(strict_types=1);

namespace MarsRover\Rover;

interface Sensor {
	public function isObstacle(Position $position);
}