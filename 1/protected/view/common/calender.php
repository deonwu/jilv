
<h1> 

<a class="btn btn-default pull-left prev"><i class="icon-angle-left"></i></a>
<span><?=$c->year . "-" . $c->month ?></span>
<a class="btn btn-default pull-right next"><i class="icon-angle-right"></i></a>

</h1>
<script type="text/javascript">

	var CUR_ITEM_ID = '<?=$_REQUEST['item_id']?>';

</script>
<?php
	$c->display();
?>