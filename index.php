<?php

require "personnage.php";
require "weapon.php";
require "equipement.php";
require "terroriste.php";
require "antiterro.php";
require "bomb.php";


//arsenal nil nlul nul les commentaires !!!@@@@@@@@@@@@@@@@@@@@@@@@

$bazooka = new Weapon("bazooka", 10, 10, 1);
$pistolet = new Weapon("pistolet", 2, 67, 5);
$mickael = new Terroriste("Micka" , "homme", 60);
$melec = new Antiterro("Melec" , "homme", 100);

$micaName = $mickael -> getName();
$micaHp = $mickael -> getHealthPoint();


$melecName = $melec -> getName();
$melecHp = $melec -> getHealthPoint();

$bazooka = new Weapon("bazooka", 10, 10, 1);
$pistolet = new Weapon("pistolet", 2, 67, 5);

$mickael -> setWeapon($bazooka);
$melec -> setWeapon($pistolet);

$kevlar = new Equipement("kevlar" , 5, 5);
$helmet = new Equipement("helmet" , 5, 2);

$mickael -> setEquipement($kevlar);
$melec -> setEquipement($helmet);

$micaEquipement = $mickael -> getEquipement() -> getName();
$melecEquipement = $melec -> getEquipement() -> getName();

$melec -> setAmmoStock(['pistolet' => 16]);
$mickael-> setAmmoStock(['bazooka' => 10]);

$turn = 0;
$message_de_fin = "fin de jeu";
$defaultTimer = 6;
$tnt = $mickael -> triggerBomb();

$tnt -> setTimer($defaultTimer);

?>  


<!DOCTYPE html>
<html>
    <head>
            <link href="https://fonts.googleapis.com/css?family=Righteous" rel="index.css">
            <link rel="stylesheet" href="index.css">
            <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
            <link rel="stylesheet" href="style.css">

            <title> Game CSGO PHP</title>
    
    </head>
<body>

<div id="top"></div>
<div>
<center>
    <h1>🔫 CSGO VIE 🔫</h1>
  <div class= "flex" style="margin-left: 30rem;">
        <div id="divTerro">
            <button onclick="createTerrorist()" id="buttonTerro">Creation du terroriste micael</button>
            <div id="terro">En attente du terroriste</div>
            <div onclick="setWeaponTerro()" id="setWeaponTerro">En attente de création du terroriste</div>
            <div onclick="setEquipementTerro()" id=setEquipementTerro></div>
        </div>
                                                                                                                         
        <div class="divAnti">
            <button onclick="createAntiTerrorist()" id="buttonAnti">Creation de l'antiterroriste melec</button>
            <div id="antiterro">En attente de l'antiterroriste</div>
            <div onclick="setWeaponAnti()" id="setWeaponAntiTerro">En attente de création de l'antiterroriste</div>
            <div onclick="setEquipementAnti()" id=setEquipementAnti></div>
        </div>
    </div>
    <button class="button-three" onclick="beginGame()">Commencer la partie</button>
    <div style="display: none;"id="jeu">
<br>
<h3>
    <div>

<?php 
        echo "Mika a posé la bombe !<br>";
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
                }
                echo "<br><br>";

        }
?>
</div>
<br>
<div class="sub-main">
      <button class="button-one" onclick='window.location.reload(false)'><a href="#top">
Relancer le jeu</button></a>
    </div>


</center></h3>
</div>
<div>
<img src="image/bazooka.gif"> 
</div>
</body>

<script>
    let micaHp = <?php echo $micaHp ?>;
    var micaName = "<?php echo $micaName ?>"

    

    let melecHp = <?php echo $melecHp ?>;
    let melecName = "<?php echo $melecName ?>"


    

    function createAntiTerrorist(){
        
        document.getElementById("antiterro").innerHTML = melecName + " l' antiterroriste à " + melecHp + " hp" ;
        document.getElementById("setWeaponAntiTerro").innerHTML = "Choix de l'arme" ;
    }
    function createTerrorist(){
        document.getElementById("terro").innerHTML = micaName + " le terroriste à " + micaHp + " hp" ;
        document.getElementById("setWeaponTerro").innerHTML = "Choix de l'arme" ;

    } 
    function setWeaponAnti(){
        document.getElementById("setWeaponAntiTerro").innerHTML = "Vous avez un Pistolet";
        document.getElementById("setEquipementAnti").innerHTML = "Prenez votre équipement";
    }
    function setWeaponTerro(){
        document.getElementById("setWeaponTerro").innerHTML = "Vous avez un Bazooka";
        document.getElementById("setEquipementTerro").innerHTML = "Prenez votre équipement";
    }

    function setEquipementTerro(){
        document.getElementById("setEquipementTerro").innerHTML = "Vous avez un gilet en kevlar";
    }

       function setEquipementAnti(){
        document.getElementById("setEquipementAnti").innerHTML = "Vous avez un casque";
    }

    function beginGame(){
        document.getElementById("jeu").style.display="inline"
    }
    
</script>
</html>










