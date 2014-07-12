
<h4> 

<a class="btn btn-default pull-left prev" href="#" month="<?=$c->preMonth() ?>"><i class="icon-angle-left"></i></a>
<span><?=$c->year . "-" . $c->month ?></span>
<a class="btn btn-default pull-right next" href="#" month="<?=$c->nextMonth() ?>"><i class="icon-angle-right"></i></a>

</h4>
<?php
	$c->display();
?>