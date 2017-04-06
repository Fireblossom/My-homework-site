<?php 

require_once("./config.php");

session_start();

if(!(isset($_REQUEST["account"]) || isset($_REQUEST["password"]))){
    die ("请输入账号密码");
}

$account = $_REQUEST["account"];
$password = $_REQUEST["password"];
$type = $_REQUEST["type"];

try{
    $db = pdo_init();
    $sql = "";
    if($type == "admin"){
        $sql = "select count(*) from datab_admin where username=:id and password=md5(:password)";
    }elseif($type == "student"){
        $sql = "select count(*) from datab_customer where id=:id and password=md5(:password)";
    }elseif($type == "teacher"){
        $sql = "select count(*) from datab_clerk where id=:id and password=md5(:password)";
    }
    
    //$sql = "select count(*) from htu_".$type." where username=:id and password=md5(:password)";
    $stat = $db->prepare($sql);
    
    $stat->bindParam(':id',$account);
    $stat->bindParam(':password',$password);
    $stat->execute();
    $row = $stat->fetch(PDO::FETCH_BOTH);
    if($row["count"] == 1){
        $_SESSION["account"] = $account;
        $_SESSION["type"] = $type;
        $router = array(
            "teacher" => "clerk/subject/list.php",
            "student" => "customer/choose/list.php",
            "admin" => "admin/customer/list.php"
        );
        $url = "location:".$router[$type];
        header($url);
    }else{
        die ("登陆错误");
    }
}catch (PDOException $ex) {
    print_r($ex);
}

?>