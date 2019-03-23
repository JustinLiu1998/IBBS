<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/23
 * Time: 14:49
 */
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';

$template['title'] = 子版块列表;
$template['css'] = array('css/index.css');

$conn = connect();
?>
<?php include 'inc/header.inc.php'?>
    <div id="main">
        <div class="title">子版块列表</div>
        <table class="list">
            <tr>
                <th>排序</th>
                <th>版块名称</th>
                <th>所属父版块</th>
                <th>版主</th>
                <th>操作</th>
            </tr>
            <?php
                $query = "select ism.id,ism.module_name,ifm.module_name as father_module_name,ism.member_id from ibbs_son_module as ism join ibbs_father_module as ifm on ism.father_module_id=ifm.id order by ifm.id";
                $result = execute($conn, $query);
                while ($data = mysqli_fetch_assoc($result)) {
$html = <<<JN
                    <tr>
                        <td><input type="text" class="sort" name="sort"></td>
                        <td>{$data['module_name']}&nbsp;[id:&nbsp;{$data['id']}]</td>
                        <td>{$data['father_module_name']}</td>
                        <td>{$data['member_id']}</td>
                        <td><a href="#">[访问]</a>&nbsp;&nbsp;<a href="son_module_update.php?id={$data['id']}">[编辑]</a>&nbsp;&nbsp;<a href="#">[删除]</a></td>
                    </tr>
JN;
                    echo $html;
                }
            ?>
        </table>
    </div>
<?php include 'inc/footer.inc.php'?>