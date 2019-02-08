<?php 

class Terroriste extends Personnage{
	public function triggerBomb(){
		$tnt = new Bomb();
		return $tnt;
	}
}