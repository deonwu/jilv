<div class="panel" >
	<div class="">
		<a href="#" class="btn btn-primary" id="add_topic_filter">添加</a>
	</div>
	
	<table class='table' id="topic_list_table">
		<tr>
			<th>ID</th>
			<th>图片</th>
			<th>名字</th>
			<th>搜索值</th>			
			<th>操作</th>	
			<th>上传人</th>
			<th>上传日期</th>			
		</tr>
<?php foreach($product_list as $p){?>
		<tr pid='<?=$p['id'] ?>' view_order='<?=$p['view_order']?>' <?=$p['status'] == 1 ? 'class="success"' : '' ?>>
			<td><?=$p['id']?></td>
			<td>
				<a href="<?=$p['pic_url']?>" class='thumbnail' style='max-width:300px;'><img src="<?=$p['pic_url']?>"></a>
			</td>
			<td>
				<?=$p['cate_label']?>
			</td>			
			<td>
				<?=$p['cate_value']?>
			</td>
			<td class='action' pid='<?=$p['id']?>'>
				<a href="#" class="edit btn btn-success">编辑</a>
				<?php if($p['status'] == 1){?>
				<a href="#" class="item_hide btn btn-success">暂停发布</a>				
				<?php }else {?>
				<a href="#" class="item_show btn btn-success">发布</a>
				<?php } ?>
				<a href="#" class="remove btn btn-danger">删除</a>
			</td>
			<td><?=$p['name']?></td>
			<td><?=$p['create_time']?></td>			
		</tr>
<?php }?>				
	</table>
	
</div>


<div class="modal fade" id="myTopicEditor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">目的地</h4>
      </div>
      <div class="modal-body">
		<form role="form">
		  <div class="form-group">
		    <label for="cate_label">名字</label>
		    <input type="text" name='cate_label' class="form-control" id="cate_label" placeholder="前端展示名字">
		  </div>
		  <div class="form-group">
		    <label for="cate_value">过滤条件</label>
		    <input type="text" name='cate_value' class="form-control" id="cate_value" placeholder="内部使用的过滤条件，默认为空">
		  </div>
		  <div class="form-group">
		    <label for="view_order">显示顺序</label>
		    <input type="number" name='view_order' id="view_order" value="1">
		    <p class="help-block">值小的排在前面</p>
		  </div>
		  <div class="form-group">
		    <label for="upload_img">图片文件</label>
		    <input type="file" id="upload_img" name='file'>
		    <p class="help-block">前端显示图片</p>
		    
		    <img class='preview' src='' style='width:100px;' />
		  </div>  
		</form>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消编辑</button>
        <button type="button" class="btn btn-primary save_btn">保存</button>
      </div>
    </div>
  </div>
</div>


