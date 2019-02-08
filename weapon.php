<?php

class Weapon {
   private $_name;
   private $_damage;
   private $_munition;
   private $_capacity;

public function __construct($name, $damage, $munition, $capacity){
    $this -> setName($name);
    $this -> setDamage($damage);
    $this -> setMunition($munition);
    $this -> setCapacity($capacity);
}

private function setName($name){
    $this -> _name = $name;
}
private function setDamage($damage){
    $this -> _damage = $damage;
}
public function setMunition($munition){
	$this -> _munition = $munition;
}
private function setCapacity($capacity){
	$this -> _capacity = $capacity;
}

public function getName(){
    return $this -> _name;
}
public function getDamage(){
    return $this -> _damage;
}
public function getMunition(){
	return $this -> _munition;
}
public function getCapacity(){
	return $this -> _capacity;
}
}