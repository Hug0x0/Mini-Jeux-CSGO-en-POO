<?php

class Equipement {
    private $_name;
    private $_armor;
    private $_durabilite;

    public function __construct($name, $armor, $durabilite){
        $this -> setName($name);
        $this -> setArmor($armor);
        $this -> setDurabilite($durabilite);

    }
    private function setName($name){
        $this -> _name = $name; 
    }
    private function setArmor($armor){
        $this -> _armor = $armor;
    }
    private function setDurabilite($durabilite){
        $this -> _durabilite = $durabilite;
    }
    public function getName(){
        return $this -> _name;
    }
    public function getArmor(){
        return $this -> _armor;
    }
    public function getDurabilite(){
        return $this -> _durabilite;
    }

    public function damageShield(equipement $ennemyShield){
        $random = rand(0, 5);
        $damage = ($this -> durabilite($degats)  * $random);











        /*echo "dégats dans le shield " . $damageRealShield;

        $ennemy -> setHealthPoint($enemy -> getHealthPoint() - $damageReal);

        $ennemy -> setHealthPoint($ennemy -> getHealthPoint() - $damageReal);
        echo $ennemy -> getName() . " à perdu de la vie, vie restante: " . $ennemy -> getHealthPoint() . "<br>";

        echo "L'arme a " . $this -> getWeapon() -> getMunition() . "munitions<br>";

        $this -> getWeapon() -> setMunition(($this -> getWeapon() -> getMunition()) - $this -> getWeapon() -> getCapacity());

        echo "il reste " . $this -> getWeapon() -> getMunition() . "munitions<br>";        
*/
        
    }




} 