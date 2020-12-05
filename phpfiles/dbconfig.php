<?php

try{

    $db=new PDO("mysql: hostname=localhost; dbname=filemanagment; charset=utf8","root","");

}catch(PDOException $e){

    echo $e->getMessage();
}

?>