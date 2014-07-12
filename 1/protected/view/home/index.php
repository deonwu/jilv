<?php include 'header.php';?>

<<style>
<!--
.body .ui-nav .cover{
	background-image:url(<?=$main_pic?>!home);
}
-->
</style>

<div class="body">

<div class="ui-nav"> 
    <div class="cover">
        <div class="container" style="margin: 0 auto;position: relative;">
                <div class="box">
                    <div class="search-box">
                        <h2>搜索你想去的目的地</h2>
                        <form >
   
                                <div class="input-group search-form">
                                  <input type="text" class="form-control" placeholder="您想去哪个城市旅游?">
                                  <span class="input-group-addon" style="background-color: #009dd5;border: 1px solid #009dd5;">搜索</span>
                                </div>    
                           
                        </form>
                    </div>
                
                </div>
        </div>
    
    
    </div>
    <div class="banner">
        <div class="container">
            <h3 class='text-center'>“最接地气”体验式旅行、发现世界新玩法！</h3>
            <ul class="list-inline">
                <li><h5 class="text-left">发现</h5><p>足不出户、先知天下</p></li>
                <li><h5 class="text-left">计划</h5><p>抛开攻略，轻松计划旅行</p></li>
                <li><h5 class="text-left">预定</h5><p>在线预定，快乐出行</p></li>
            </ul>
        </div>
    </div>


</div>


<div class="ui-content">
    
    <div class="activity">
            <div class="container">
            
                      <h1>热门活动</h1>
                      <div class="row">
                        <?php $i = 0; 
                        	foreach($product_list as $p){
							$i++;
						?> 
                              <div class="col-xs-4 col-md-4 pic">
                                <a href="/cf/<?=$p['id']?>.html" class="thumbnail">
                                  <img src="<?=$p['pic_url']?>!w348">
                                </a>
                                    
                                 <span><?=$p['cate_label']?></span>
                              </div>
                        <?php }?>
                           
                      	<?php for(;$i<9;$i++){?> 
                              <div class="col-xs-4 col-md-4 pic">
                                <a href="/cate.html" class="thumbnail">
                                  <img src="<?=$THEME_URL ?>/img/demo.jpg">
                                </a>
                                    
                                 <span>热气球</span>   
                              </div>
                           <?php }?>
                      </div>
              </div>
            
            
    
    </div>

    <div class="city">
             <div class="container">
            
                <div class="panel panel-default" style="border:none">
                      <h3>热门城市</h3>
                           <div class="row">
	                        <?php $i = 0; 
	                        	foreach($dest_list as $p){
								$i++;
							?> 
	                              <div class="col-xs-4 col-md-4 pic">
	                                <a href="/cf/<?=$p['id']?>.html" class="thumbnail">
	                                  <img src="<?=$p['pic_url']?>!w348">
	                                </a>
	                                    
	                                 <span><?=$p['cate_label']?></span>
	                              </div>
	                        <?php }?>
                                                   
                               <?php for(;$i<9;$i++){?> 
                              <div class="col-xs-4 col-md-4 pic">
                                <a href="/cate.html" class="thumbnail">
                                  <img src="<?=$THEME_URL ?>/img/city.jpg">
                                </a>
                                    
                                 <span>曼谷</span>   
                              </div>
                              <?php }?>
                            </div>
                </div>
            
            
            </div>
    
    </div>

</div>


<div class="container">
	<div class="row good">
		<div class="col-xs-12 col-md-4 clearfix">
			<img src="/static/img/f1.png" style="float:left;">
			<div class="f_label">
				靠谱<br/>
				精选终端商家直销<br/>
				资质认证层层把关
			</div>
		</div>
		<div class="col-xs-12 col-md-4 clearfix">
			<img src="/static/img/f2.png" style="float:left;">
			<div class="f_label">
				专业<br/>
				精选终端商家直销<br/>
				资质认证层层把关
			</div>
		</div>
		<div class="col-xs-12 col-md-4 clearfix">
			<img src="/static/img/f3.png" style="float:left;">
			<div class="f_label">
				透明<br/>
				精选终端商家直销<br/>
				资质认证层层把关
			</div>
		</div>				
	</div>
</div>

</div>









<?php include 'footer.php';?>		
			