<?php

require "personnage.php";
require "weapon.php";
require "equipement.php";

//arsenal


$bazooka = new Weapon("bazooka", 100, 10, 1);
$pistolet = new Weapon("pistolet", 2, 67, 15);
$mickael = new Personnage("Micka" , "homme", 60);
$melec = new Personnage("Melec" , "homme", 100);
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
$message_de_fin = "eff";


while(($melec -> getHealthPoint() > 0 ) && ($mickael -> getHealthPoint() > 0 )){
    if($turn == 0){
       
        if($melec->getWeapon() -> getMunition() <= 0){
            echo "Melec n'a plus de balle et ne peut pas attaquer";
            if($melec -> getAmmoStock($melec -> getWeapon() -> getName()) > 0){
                $melec -> reload(1);
                echo "melec à recharger<br>";
            }
            else{
                
                echo "melec n'a plus de balle et ne peut pas attaquer <br>";
                echo "plus de ballein de jeu";
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
            echo "micka attaque avec: " . $mickael -> getWeapon() -> getName() . "<br>";
            $mickael -> shootEnnemy($melec);
        }

        $turn = 0;
    }  
}
