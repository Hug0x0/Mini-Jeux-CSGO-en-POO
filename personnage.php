<?php

class Personnage{
    private $_name;
    private $_gender;
    private $_weapon;
    private $_health_point;
    private $_equipement;
    private $_ammo_stock;

    public function __construct(string $name, string $gender, $health_point){
        $this->setName($name);
        $this->setGender($gender);
        $this->setHealthPoint($health_point);
    }

    private function setName($name){
        $this -> _name = $name;
    }
    private function setGender($gender){
        $this -> _gender = $gender;
    }
    public function setHealthPoint($_health_point) {
        $this -> _health_point = $_health_point;
    }
    public function setWeapon($weapon){
        $this -> _weapon = $weapon;
    }
    public function setEquipement($equipement){
        $this -> _equipement = $equipement;
    }
    public function setAmmoStock($ammoStock){
        $this -> _ammo_stock = $ammoStock;
    }

    public function reduceAmmoStock($weapon, $value){
        $this -> _ammo_stock[$weapon] -= $value;
    }

    //setWeapon

    public function getName(){
        return $this -> _name;
    }
    public function getGender(){
        return $this -> _gender;
    }
    public function getHealthPoint(){
        return $this -> _health_point;
    }

    public function getWeapon(){
        return $this -> _weapon;
    }
    public function getEquipement(){
        return $this -> _equipement;
    }
    public function getAmmoStock($arme){
        return $this->_ammo_stock[$arme];
    }


    public function showPersonnage(){
        echo $this-> getName() . " a été créé<br>Il a " . $this -> getHealthPoint() . " hp et c'est un " . $this -> getGender() . "<br>";
    }

    //getWeapon
    public function shootEnnemy(personnage $ennemy){
        
        $damageReal = 0;
        for ( $i = 1; $i <= $this -> getWeapon() -> getCapacity(); $i ++){
            $random = rand(0, 5);
            $damageReal += (($this-> getWeapon()-> getDamage())*$random) ;
            echo " dégat balle n°" . $i . " : " . $damageReal . "<br>";
        }
        //$damageReal = (($this-> getWeapon()-> getDamage())*$random) ;
        
        $damageArmor = $damageReal - ($this -> getEquipement() -> getArmor());

        $getWeapon = $this-> getWeapon();
       
        $message_de_fin = " fin de partie";

        echo "dégats reels : " . $damageReal . "<br>";
        echo "armure : " . $this -> getEquipement() -> getArmor() . "<br>";
        echo "dégats armor : " . $damageArmor . "<br>";

        $this -> getWeapon() -> setMunition(($this -> getWeapon() -> getMunition()) - $this -> getWeapon() -> getCapacity());

        echo "Il reste " . $this -> getWeapon() -> getMunition() . " munitions<br>";

        if($damageArmor < 0){
            echo "L'amure fonctionne 0 dégats <br>";
        }
        else{
            $ennemy -> setHealthPoint($ennemy-> getHealthPoint() - $damageArmor);

            if($ennemy -> getHealthPoint() <= 0){
                echo $ennemy -> getName() . " est mort <br>" . "<br>" . $message_de_fin . " " . $this -> getName() . " à gagné ! ";
            }
            else{
                echo $ennemy -> getName() . " à perdu de la vie, vie restante : " . $ennemy -> getHealthPoint() . "<br><br>";
            }
           
        }
       
        

    }

    public function reload ($NB_chargeur){
        echo "melec recharge de " . $NB_chargeur * $this -> getWeapon() -> getCapacity() . "<br>" ;
        
        $this -> getWeapon() -> setMunition($this -> getWeapon() -> getCapacity());
        
        echo $this -> getName() . " à " . $this -> getWeapon() -> getMunition() . " balles dans son chargeur de " . $this -> getWeapon() -> getName() . "<br>";
        
        echo "ammostock" . $this -> getAmmoStock($this -> getWeapon() -> getName()) . "<br>";

        $this -> reduceAmmoStock($this -> getWeapon() -> getName(), 1);
        
        echo $this -> getName() . " à " . $this -> _ammo_stock[$this -> getWeapon() -> getName()] . " chargeurs dans son Stock<br>";
    
        echo "ammostock apres rechargement" . $this -> getAmmoStock($this -> getWeapon() -> getName()) . "<br>";

        echo "munition dans l'arme " . $this -> getWeapon() -> getMunition() . "<br>";
    }
}
