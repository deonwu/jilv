<div class="grid">
<?php foreach($item_list as $item) {?>

<div class="col-lg-3 col-md-4">
	<div class="item clearfix">
    	<a class="thumbnail" href="/i/<?=$item['id']?><?=HTML_VIEW ? ".html" : "" ?>">
     		<img src="<?=$item['imgs'][0]?>" />
     	</a>
     	<div>
     		<?=$item['name']?>
     	</div>
     </div>
</div>

<?php }?>
</div>