<?php

namespace MarsRover;
use MarsRover\Rover\Orientation;
use MarsRover\Rover\Position;
use MarsRover\Rover\Debug;

define('DEBUG', false);

class Rover {
	public $orientation;
	public $position;

	public function __construct(int $x, int $y) {
		$this->orientation = new Orientation();
		$this->position = new Position($x, $y);

		new Debug($this->position, $this->orientation);
	}

	public function handle($commands) {
		foreach($commands as $command) {
			switch($command) {
				case 'f':
					$this->position = $this->position->forward($this->orientation);
				break;
				case 'b':
					$this->position = $this->position->back($this->orientation);
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

			new Debug($this->position, $this->orientation);
		}
	}


}