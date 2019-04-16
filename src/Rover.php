<?php

declare(strict_types=1);

namespace MarsRover;
use MarsRover\Rover\Orientation;
use MarsRover\Rover\Position;
use MarsRover\Rover\Sensor;

class Rover {
	public $orientation;
	public $position;
	public $sensor;

	public function __construct(Orientation $orientation, Position $position, Sensor $sensor) {
		$this->position = $position;
		$this->orientation = $orientation;
		$this->sensor = $sensor;
	}

	public function handle($commands) {
		foreach($commands as $command) {
			switch($command) {
				case 'f':
					$new_position = $this->position->forward($this->orientation);

					if(!$this->sensor->isObstacle($new_position)) {
						$this->position = $this->position->forward($this->orientation);
					}
				break;
				case 'b':
					$new_position = $this->position->back($this->orientation);

					if(!$this->sensor->isObstacle($new_position)) {
						$this->position = $this->position->back($this->orientation);
					}
				break;
				case 'l':
					$this->orientation = $this->orientation->turn(Orientation::TURN_LEFT);
				break;
				case 'r':
					$this->orientation = $this->orientation->turn(Orientation::TURN_RIGHT);
				break;
				default:
					throw new \InvalidArgumentException('Unknown command.', 101);
			}
		}
	}
}