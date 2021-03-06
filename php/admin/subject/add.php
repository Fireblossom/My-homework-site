<?php 

require_once("../../config.php");

session_start();

$user = $_SESSION["account"];
$type = $_SESSION["type"];

if($type != "admin"){
    die ("请重新登录");
}

$db = pdo_init();

$sql = "select id,name,collage from datab_clerk";

$stat = $db->query($sql);

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>添加产品</title>
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css" />
</head>
<body>
	<div class="container">
        <div class="row">
        	<div class="col-xs-12">
                <nav class="navbar navbar-default" role="navigation">
                	<div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">销售管理系统</span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">销售管理系统</a>
                        </div>
                        <div class="collapse navbar-collapse">
                        	<ul class="nav navbar-nav navbar-right">
                        		<li>
                                    <p class="navbar-text"><?php echo $user; ?></p>
                                </li>
                        	</ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-12">
            <ol class="breadcrumb">
              <li>管理员</li>
              <li>顾客管理</li>
              <li class="active">添加产品</li>
            </ol>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-3">
                <div class="list-group">
                    <a href="/admin/subject/list.php" class="list-group-item active">产品管理</a>
                    <a href="/admin/clerk/list.php" class="list-group-item">业务员管理</a>
                    <a href="/admin/customer/list.php" class="list-group-item">顾客管理</a>
                </div>
            </div>
        	<div class="col-xs-9">
                <form class="form-horizontal" role="form" method='post' action='checkadd.php'>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">产品名</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="产品名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCollage" class="col-sm-2 control-label">所属部门</label>
                        <div class="col-sm-10">
                            <input name="collage" type="text" class="form-control" id="inputCollage" placeholder="所属部门">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="inputTeacher" class="col-sm-2 control-label">负责业务员</label>
                        <div class="col-sm-10">
                            <select name="teacher" id="inputTeacher" class="form-control">
                            <?php foreach($stat as $value){ 
                                $teacher_info = $value["id"] . $value["name"] . $value["collage"];
                            ?>
                            
                        		<option value="<?php echo $value["id"]; ?>"><?php echo $teacher_info; ?></option>
                                
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">确认</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
    <!-- javascript file -->
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>