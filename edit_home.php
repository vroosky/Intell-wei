<html lang="en">
<?php
/**
 * Created by PhpStorm.
 * User: shenya
 * Date: 16-4-7
 * Time: 下午5:59
 */
include "head.php";
?>
<?php
session_start(); //启用session
if($_SESSION['duser']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // redirects if user is not logged in
}
$duser = $_SESSION['duser']; //assigns user value
?>
<body>
<div class="container">
    <header>
        <div class="logo" >贵阳学院汽车衡智能称重系统</div>
        <nav class="float-right">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                    <li><a href="home.php">返回</a></li>
                    <li><a href="logout.php">退出登录</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 align="center">个人信息修改</h2>
    <div class="pure-skin-shenya">
    <table class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>驾驶证号</th>
            <th>车牌号</th>
            <th>姓名</th>
            <th>生日</th>
            <th>驾照类型</th>
            <th>部门</th>
            <th>电话</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($duser)) {
            $id = $duser;
            $_SESSION['id'] = $id;
            $id_exists = true;
            include "connect.inc.php";//连接到数据库
            $query = mysql_query("Select * from driver Where driver_id='$id'"); // SQL请求
            $count = mysql_num_rows($query);
            if ($count > 0) {
                while ($row = mysql_fetch_array($query)) {
                    echo "<tr>";
                    echo '<td align="center">' . $row['driver_id'] . "</td>";
                    echo '<td align="center">' . $row['carnum'] . "</td>";
                    echo '<td align="center">' . $row['name'] . "</td>";
                    echo '<td align="center">' . $row['bday'] . "</td>";
                    echo '<td align="center">' . $row['dkind'] . "</td>";
                    echo '<td align="center">' . $row['part'] . "</td>";
                    echo '<td align="center">' . $row['telnum'] . "</td>";
                    echo "</tr>";
                    $driver_id=$row['driver_id'];
                    $dpassword=$row['dpassword'];
                    $carnum=$row['carnum'];
                    $name=$row['name'];
                    $bday=$row['bday'];
                    $dkind =$row['dkind'];
                    $part=$row['part'];
                    $telnum=$row['telnum'];
                }

            }
            else
            {
                $id_exists = false;
            }
        }
        ?>
        </tbody>
    </table>
        </div>
    <?php
    $carnum_query=mysql_query("SELECT carnum FROM car") or die ("Error Occurred");
    ?>
    <br/>
    <br/>
    <form class="pure-form pure-form-aligned" action="editdriver.php" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label for="driver_id">驾驶证号</label>
                <?php
                echo '<input readonly id="driver_id" type="text" value="'.$driver_id.'" name="driver_id">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="carnum">车牌号</label>
                <?php
                echo '<input readonly id="carnum" type="text" value="'.$carnum.'" name="carnum" required="required>'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="dpassword">密码</label>
                <?php
                echo '<input id="dpassword" type="text" value="'.$dpassword.'" name="dpassword">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="name">姓名</label>
                <?php
                echo '<input id="name" type="text" value="'.$name.'" name="name" required="required>'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="bday">出生日期</label>
                <?php
                echo '<input id="bday" type="date" value="'.$bday.'" name="bday">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="dkind">驾照类型</label>
                <?php
                echo '<input id="dkind" type="text" value="'.$dkind.'" name="dkind">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="part">所属部门</label>
                <?php
                echo '<input readonly id="part" type="text" value="'.$part.'" name="part">'
                ?>
            </div>
            <div class="pure-control-group">
                <label for="telnum">电话号码</label>
                <?php
                echo '<input id="telnum" type="text" value="'.$telnum.'" name="telnum">'
                ?>
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary">提交</button>
            </div>
        </fieldset>
    </form>
    <?php
    include "footer.php";
    ?>
</div>
</body>
</html>