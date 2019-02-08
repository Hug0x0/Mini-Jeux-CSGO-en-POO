<?php

require "personnage.php";
require "weapon.php";
require "equipement.php";
require "terroriste.php";
require "antiterro.php";
require "bomb.php";

//arsenal nil nlul nul les commentaires !!!@@@@@@@@@@@@@@@@@@@@@@@@

session_start();

$bazooka = new Weapon("bazooka", 10, 10, 1);
$pistolet = new Weapon("pistolet", 2, 67, 5);
$mickael = new Terroriste("Micka" , "homme", 60);
$melec = new Antiterro("Melec" , "homme", 100);

//test session

//$_SESSION['melec'] = serialize($melec);

//$sessionTest = $_SESSION['melecAntiterro'];

//echo "test session: " . $sessionTest -> getName();

$kevlar = new Equipement("kevlar" , 5, 5);
$helmet = new Equipement("helmet" , 5, 2);

echo "Liste des armes : <br>" . $bazooka -> getName() . " qui inflige  :  " .  $bazooka -> getDamage() . " de dégats <br> " . $pistolet -> getName() . " qui inflige  :  " .  $pistolet -> getDamage() . " de dégats <br><br> ";

echo " Joueurs : <br>" . $mickael -> getName() . "<br>" . $melec -> getName() . "<br><br>";

echo " Création de personnage : <br>";

$mickael -> showPersonnage();
echo("<br>");
$melec -> showPersonnage();

echo("<br>");
$mickael -> setWeapon($bazooka);
$melec -> setWeapon($pistolet);

$mickael -> setEquipement($kevlar);
$melec -> setEquipement($kevlar);
//echo $mickael -> getWeapon() -> getDamage();
$melec -> setAmmoStock(['pistolet' => 16]);
$mickael-> setAmmoStock(['bazooka' => 10]);
//$mickael -> shootEnnemy($melec);
$turn = 0;
$message_de_fin = "fin de jeu";
$defaultTimer = 6;
$tnt = $mickael -> triggerBomb();
echo "Mika a posé la bombe !<br>";
$tnt -> setTimer($defaultTimer);
echo "La bombe explose dans " . $defaultTimer . " eminutes<br><br>";

while(($melec -> getHealthPoint() > 0 ) && ($mickael -> getHealthPoint() > 0 )){
    if($turn == 0){
        //ANTITERRO
        
       //TRY DEFUSE
        $melec -> tryDefuseBomb($tnt , $defaultTimer);

        if($melec->getWeapon() -> getMunition() <= 0){
            echo "Melec n'a plus de balle et ne peut pas attaquer";
            if($melec -> getAmmoStock($melec -> getWeapon() -> getName()) > 0){
                $melec -> reload(1);
                echo "Melec à recharger<br>";
            }
            else{
                
                echo "Melec n'a plus de balle et ne peut pas attaquer <br>";
                echo "plus de balle fin de jeu";
                break;
            }
        }
        else{
            echo "Melec tir avec: " . $melec -> getWeapon() -> getName() . "<br>";
            $melec -> shootEnnemy($mickael);
            if($message_de_fin == "fin de partie"){
                echo $message_de_fin;
                break;
            }
        }
        $turn = 1;
        echo "<br>";
    }
    else{
        if($mickael->getWeapon() -> getMunition() <= 0){
            if($mickael-> getAmmoStock($mickael-> getWeapon() -> getName()) > 0){
                $mickael -> reload(1);
                echo "Mika à rechargé";
                
            }
            else{
            echo "mika n'a plus de balle et ne peut pas attaquer<br>";
            echo 'plus de balle fin de jeu';
            break;

                
            }
        }
        else{
            echo "Micka attaque avec: " . $mickael -> getWeapon() -> getName() . "<br>";
            $mickael -> shootEnnemy($melec);
        }

        $turn = 0;
        
        echo "<br>";
        $tnt -> tictactictac();
        if($tnt -> getTimer() == 0){
            echo $message_de_fin;
            break;
        }
        //if bombetour = vie bombetour{
           // echo "La bombe a explosé -, le policier est mort."
            //break;
        }

        echo "<br><br>";


}

