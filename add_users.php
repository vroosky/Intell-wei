<html lang="zh">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午8:57
 */
include "head.php";
session_start(); //启用session
if($_SESSION['user']and $_SESSION['perm']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户值
?>
    <body>
    <div class="container">
        <header>
            <div class="logo" >贵阳学院汽车衡智能称重系统</div>
            <nav class="float-right">
                <div class="pure-menu pure-menu-open pure-menu-horizontal">
                    <ul>
                        <li><a href="users.php">返回</a></li>
                        <li><a href="logout.php">退出登录</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <h2 align="center">添加用户</h2>
        <form class="pure-form pure-form-aligned" action="add_users.php" method="POST">
            <fieldset>
                <div class="pure-control-group">
                    <label for="user_id">账号</label>
                    <input id="user_id" type="text" placeholder="账号" name="user_id" required="required">
                </div>
                <div class="pure-control-group">
                    <label for="name">姓名</label>
                    <input id="name" type="text" placeholder="姓名" name="username" required="required">
                </div>

                <div class="pure-control-group">
                    <label for="password">密 纹</label>
                    <input id="password" type="password" placeholder="密码" name="password" required="required">
                </div>
                <div class="pure-control-group">
                    <label for="perm">权限码</label>
                    <input id="perm" type="text" placeholder="权限" name="perm" required="required">
                </div>

                <div class="pure-controls">
                    <button type="submit" class="pure-button pure-button-primary" type="submit" value="Register">提交</button>
                </div>
            </fieldset>
        </form>
        <?php
        include "footer.php";
        ?>    </div>
    </body>
    </html>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $perm = $_POST['perm'];
    $bool = true;

    require 'connect.inc.php'; //连接到数据库
    $query = mysql_query("Select * from users"); //获取用户表
    while($row = mysql_fetch_array($query)) //显示用户数据
    {
        $table_users = $row['username']; //逐行对比完成
        if($username == $table_users) // 检测用户是否存在
        {
            $bool = false; // sets bool to false
            Print '<script charset="utf-8">alert("用户名已存在！");</script>'; //提示用户存在
            Print '<script>window.location.assign("add_users.php");</script>'; // 重定向注册页面
        }
    }

    if($bool) // checks if bool is true
    {
        mysql_query("INSERT INTO users (user_id,username, password,perm) VALUES ('$user_id','$username','$password','$perm');"); //在用户表中写入所有的数据
        Print '<script charset="utf-8">alert("添加成功！");</script>'; // 提示用户
        Print '<script>window.location.assign("users.php");</script>'; // 重定向到register.php
    }

}
?>
