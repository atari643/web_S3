<?php
session_start();
 if(isset($_POST["name"]) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && isset($_POST["password"]) && isset($_POST["countrys"]) || isset($_POST["otherCountry"])) {
      include 'connect.php';
      if(isset($_POST["otherCountry"])) {
          $sql ="INSERT INTO country (name)
          Value (:name)";
          $stmt = $pdo->prepare($sql);
          $name = $_POST['otherCountry'];
          $stmt->bindParam(':name', $name);
          $stmt->execute();

      }
      $sql ="INSERT INTO user (name, email, password, register_date, admin, country_id)
      Value (:name, :email, :password, :register_date, :admin, 
      (select id from country where name=:names LIMIT 1))";
      $query = $pdo->prepare($sql);
      $selected=$_POST["countrys"];
      if(isset($_POST["otherCountry"])){
          $selected=$_POST["otherCountry"];
      }
      $query->execute([
      'name'=>$_POST["name"], 
      'email'=>$_POST["email"], 
      'password'=>$_POST["password"], 
      'register_date'=> date('Y/m/d h:i:s', time()), 
      'admin'=>0, 
    'names'=>$selected]);
        header('Location: ../TD3&TD4/formulaireUser.php');

 

 }

?>