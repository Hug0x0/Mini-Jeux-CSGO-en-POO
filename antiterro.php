<?php 

class Antiterro extends Personnage{
	public function tryDefuseBomb($bomb, $defaultTimer){
		$trydefuse = rand(0,4);
		if($trydefuse == 4){
			$bomb -> setTimer($defaultTimer);
			echo "Désamorçage réussi <br><br><br>";
		}	
		else{
			echo "Désamorçage echoué <br><br><br>";
		}

	}

	
}