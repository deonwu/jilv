<?php V("cate/header.php");  ?>
<?php 
	if(DEBUG){
		echo var_export($_SERVER, true);
	}
?>

<div class="row">

<div class = "col-lg-12 col-md-12">

		<h1><?=$item['name']?></h1>
</div>

<div class = "col-lg-12 col-md-12">
        
        
     <div class = "col-lg-3 col-md-3 sidebar-nav" id="cate_nav_bar">
            <?php V ('cate/nav_bar.php');?>
     </div >

      <div class = "col-lg-9 col-md-9 hd" >
           
           <div id="filter_bar">
	  <nav class="navbar navbar-default" role="navigation">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">价格排序</a></li>
            <li><a href="#">发布时间</a></li>
           
            <li><a href="?view=row"><i class="icon-align-justify"></i></a></li>            
            <li><a href="?view=grid"><i class="icon-table"></i></a></li>
            
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="输入搜索关键字">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
          </form>
          
        </div><!-- /.navbar-collapse -->
      </nav>
      
           </div>
           
           <div class="item_list">
				<?php include "item_list_{$view}.php"; ?>           
           </div>
   
     </div><!-- col-lg-11 -->


     
</div>	

</div>

<script src="/static/js/product/item_detail.js"></script>


<?php V("cate/footer.php"); ?>