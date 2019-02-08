<?php 

class Bomb {
	private $_timer;

	public function getTimer(){
		return $this -> _timer;
	}
	public function setTimer($timer){
		$this -> _timer = $timer;
	}


	public function tictactictac(){
		$this -> _timer -= 1;
		switch ($this ->_timer){
			case 0:
			$this -> explosionBomb();
			break;
			case 1:
			echo "ATTENTION LA BOMBE VA EXPLOSER<br>";
			break;
		}
		
	}

	public function explosionBomb(){
	echo "la bombe a explosé, les terroristes ont gagné<br>";
	}
}