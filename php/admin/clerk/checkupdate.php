<?php 

require_once("../../config.php");

session_start();

$user = $_SESSION["account"];
$type = $_SESSION["type"];

if($type != "admin"){
    die ("�����µ�¼");
}
//print_r ($_POST);

$id = $_POST["id"];
$name = $_POST["name"];
$collage = $_POST["collage"];
$password = $_POST["password"];

try{
    
    $db = pdo_init();
    $sql = "update datab_clerk set name=:name,collage=:collage,password=md5(:password) where id=:id";
    $stat = $db->prepare($sql);
    $stat->bindParam(':id',$id);
    $stat->bindParam(':name',$name);
    $stat->bindParam(':collage',$collage);
    $stat->bindParam(':password',$password);
    $stat->execute();
    
    $url = "location:list.php";
    header($url);
}catch (PDOException $ex) {
    die("�޸�ʧ��");
}


?>