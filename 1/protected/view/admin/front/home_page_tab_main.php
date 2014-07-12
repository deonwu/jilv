<div class="panel" >
	<div class="input-group">
	  <span class="input-group-addon">上传首页背景</span>
	  <input id="main_file" type="file" name='file' class="form-control" placeholder="新背景图片">
	</div>
	
	<table class='table' id="main_pic_table">
		<tr>
			<th>图片编号</th>
			<th>图片</th>
			<th>操作</th>
			<th>上传人</th>
			<th>上传日期</th>			
		</tr>
<?php foreach($main_pics as $p){?>
		<tr <?=$p['active'] == 1 ? 'class="success"' : '' ?>>
			<td><?=$p['id']?></td>
			<td>
				<a href="<?=$p['url']?>" class='thumbnail' style='max-width:300px;'><img src="<?=$p['url']?>"></a>
			</td>
			<td class='action' pid='<?=$p['id']?>'>
				<a href="#" class="active btn btn-success">发布</a>
				<a href="#" class="remove btn btn-danger">删除</a>
			</td>
			<td><?=$p['name']?></td>
			<td><?=$p['create_time']?></td>			
		</tr>
<?php }?>				
	</table>

</div>