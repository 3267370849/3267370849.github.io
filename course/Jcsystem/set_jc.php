<?php 
include("../includes/common.php");
$title='教程管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php
$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">新增教程</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./set_jc.php?my=add_submit" method="POST">
<div class="form-group">
<label>*名称:</label><br>
<input type="text" class="form-control" name="name" value="" required>
</div>
<div class="form-group">
<label>*教程地址:</label><br>
<input type="text" class="form-control" name="url" value="" required>
</div>
<div class="form-group">
<label>*是否显示:</label><br>
<select class="form-control" name="active"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<br/>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
echo '<br/><a href="./set_jc.php">>>返回教程列表</a>';
echo '</div></div>
<script>
$("select[name=\'is_curl\']").change(function(){
	if($(this).val() == 1){
		$("#curl_display").css("display","inherit");
	}else{
		$("#curl_display").css("display","none");
	}
});
function Addstr(id, str) {
	$("#"+id).val($("#"+id).val()+str);
}
</script>';
}
elseif($my=='edit')
{
$id=$_GET['id'];
$row=$DB->get_row("select * from web_jc where id='$id' limit 1");
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改教程信息</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./set_jc.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>教程名称:</label><br>
<input type="text" class="form-control" name="name" value="'.$row['name'].'" required>
</div>
<div class="form-group">
<label>教程地址:</label><br>
<input type="text" class="form-control" name="url" value="'.$row['url'].'" required>
</div>
<div class="form-group">
<label>是否显示:</label><br>
<select class="form-control" name="active" default="'.$row['active'].'"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<br/>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./set_jc.php">>>返回教程列表</a>';
echo '</div></div>
<script>
$("select[name=\'is_curl\']").change(function(){
	if($(this).val() == 1){
		$("#curl_display").css("display","inherit");
	}else{
		$("#curl_display").css("display","none");
	}
});
function Addstr(id, str) {
	$("#"+id).val($("#"+id).val()+str);
}
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>';
}
elseif($my=='add_submit')
{
$name=$_POST['name'];
$url=$_POST['url'];
$active=$_POST['active'];
if($name==NULL or $url==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$sql="insert into `web_jc` (`name`,`url`,`active`) values ('".$name."','".$url."','".$active."')";
if($DB->query($sql)){
	showmsg('添加教程成功！<br/><br/><a href="./set_jc.php">>>返回教程列表</a>',1);
}else
	showmsg('添加教程失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=$_GET['id'];
$rows=$DB->get_row("select * from web_jc where id='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$name=$_POST['name'];
$url=$_POST['url'];
$active=$_POST['active'];
if($name==NULL or $url==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update web_jc set name='$name',url='$url',active='$active' where id='{$id}'"))
	showmsg('修改教程成功！<br/><br/><a href="./set_jc.php">>>返回教程列表</a>',1);
else
	showmsg('修改教程失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=$_GET['id'];
$sql="DELETE FROM web_jc WHERE id='$id'";
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./set_jc.php">>>返回教程列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from web_jc");
$sql=" 1";
$con='系统共有 <b>'.$numrows.'</b> 个教程<br/><a href="./set_jc.php?my=add" class="btn btn-primary">新增教程</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>名称</th><th>地址</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM web_jc WHERE{$sql} order by id asc");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['name'].'</td><td>'.$res['url'].'</td><td>'.($res['active']==1?'<font color=green>显示中</font>':'<font color=red>未显示</font>').'</td><td><a href="./set_jc.php?my=edit&id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./set_jc.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此教程吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php }?>
    </div>
  </div>