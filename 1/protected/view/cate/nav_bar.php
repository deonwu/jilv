
<div class="panel panel-default">
    <div class="panel-heading">服务时间</div>
    <div class="panel-body">
    	<div>从<input name="start_time"></div>
    	<div>到<input name="end_time" ></div>
    </div>
</div>


<?php 
	$dest = $dest > 0 ? $dest : 0;
	$product_type = $product_type > 0 ? $product_type : 0;
	$lang = $lang > 0 ? $lang : 0;
	$active_time = $active_time > 0 ? $active_time : 0;
	$user_type = $user_type > 0 ? $user_type : 0;

	$q = $_SERVER['QUERY_STRING'];
	
	$suffix = HTML_VIEW ? ".html?{$q}" : "?{$q}";
	
?>
<div class="panel panel-default">
    <div class="panel-heading">目的地</div>
    <div class="panel-body">
    	<a <?=(0 == $dest) ? 'class="cur"' : '' ?> href="/cf/<?="0-{$product_type}-{$lang}-{$active_time}-{$user_type}{$suffix}" ?>">全部</a>
    <?php foreach($cats_group['dest'] as $c) {
    	$cur = $c['id'] == $dest ? 'class="cur"' : '';
    ?>
    	<a <?=$cur?> href="/cf/<?="{$c['id']}-{$product_type}-{$lang}-{$active_time}-{$user_type}{$suffix}" ?>"><?=$c['cate_label']?></a>
    <?php } ?>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">产品分类</div>
    <div class="panel-body">
    	<a <?=(0 == $product_type) ? 'class="cur"' : '' ?> href="/cf/<?="{$dest}-0-{$lang}-{$active_time}-{$user_type}{$suffix}" ?>">全部</a>
    <?php foreach($cats_group['product_type'] as $c) {
    	$cur = $c['id'] == $product_type ? 'class="cur"' : '';
    ?>
    	<a <?=$cur?> href="/cf/<?="{$dest}-{$c['id']}-{$lang}-{$active_time}-{$user_type}{$suffix}" ?>"><?=$c['cate_label']?></a>
    <?php } ?>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">服务语言</div>
    <div class="panel-body">
    	<a <?=(0 == $lang) ? 'class="cur"' : '' ?> href="/cf/<?="{$dest}-{$product_type}-0-{$active_time}-{$user_type}{$suffix}" ?>">全部</a>
    <?php foreach($cats_group['lang'] as $c) {
    	$cur = $c['id'] == $lang ? 'class="cur"' : '';
    ?>
    	<a <?=$cur?> href="/cf/<?="{$dest}-{$product_type}-{$c['id']}-{$active_time}-{$user_type}{$suffix}" ?>"><?=$c['cate_label']?></a>
    <?php } ?>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">活动时间</div>
    <div class="panel-body">
    	<a <?=(0 == $active_time) ? 'class="cur"' : '' ?> href="/cf/<?="{$dest}-{$product_type}-{$lang}-0-{$user_type}{$suffix}" ?>">全部</a>
    <?php foreach($cats_group['active_time'] as $c) {
    	$cur = $c['id'] == $active_time ? 'class="cur"' : '';
    ?>
    	<a <?=$cur?> href="/cf/<?="{$dest}-{$product_type}-{$lang}-{$c['id']}-{$user_type}{$suffix}" ?>"><?=$c['cate_label']?></a>
    <?php } ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">适合群体</div>
    <div class="panel-body">
    	<a <?=(0 == $user_type) ? 'class="cur"' : '' ?> href="/cf/<?="{$dest}-{$product_type}-{$lang}-{$active_time}-0{$suffix}" ?>">全部</a>
    <?php foreach($cats_group['user_type'] as $c) {
    	$cur = $c['id'] == $user_type ? 'class="cur"' : '';
    ?>
    	<a <?=$cur?> href="/cf/<?="{$dest}-{$product_type}-{$lang}-{$active_time}-{$c['id']}{$suffix}" ?>"><?=$c['cate_label']?></a>
    <?php } ?>
    </div>
</div>

