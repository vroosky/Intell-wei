<?php
session_start(); //启用session
if($_SESSION['user']){ // 检查用户是否登录
}
else{
    header("location: index.php"); // 未登录则定向到主页
}
$user = $_SESSION['user']; //注册用户值
?>
<table border="1" class="pure-table pure-table-bordered">
        <thead>
        <tr>
            <th>记录号</th>
            <th>管理账号</th>
            <th>车牌号</th>
            <th>类型</th>
            <th>净重</th>
            <th>时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <?php
        header("content-type:application/msexcel");
        header("content-disposition:filename=manage.xls");
        include "../connect.inc.php";
        $queryitem = mysql_query("Select * from manage order by manage_id desc");
        while($row = mysql_fetch_array($queryitem))
        {
            echo "<tr>";
            echo '<td align="center">'. $row['manage_id'] . "</td>";
            echo '<td align="center">'. $row['user_id'] . "</td>";
            echo '<td align="center">'. $row['carnum'] . "</td>";
            echo '<td align="center">'. $row['kind'] . "</td>";
            echo '<td align="center">'. $row['weight'] . "</td>";
            echo '<td align="center">'. $row['time'] . "</td>";
            echo '<td align="center">'. $row['remarks'] . "</td>";
            echo "</tr>";
        }
        ?>
</tbody>
</table>

