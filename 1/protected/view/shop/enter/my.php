<?php V ('shop/header.php');?>
<link rel="stylesheet" href="/static/css/shop/my.css">

<div class="body">

    <div class="hot">
        <div class="container">
            <div class="panel panel-default">
                  <div class="panel-heading">活动专区</div>
                  <div class="panel-body">
                    
                        <div class="row">
                            <?php for ($i=0;$i<3;$i++){?>
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                  <img src="/static/img/demon2.png">
                                  <div class="caption">
                                    <p>4月22旅游订制活动即将上线，届时所有订单将开放给顾问进行抢单</p>
                                    <p><a href="#" class="btn btn-default" role="button">查看详情</a></p>
                                  </div>
                                </div>
                              </div>
                              <?php }?>
                        </div>
                    
                    
                    
                    
                    
                  </div>
            </div>
        </div>
    </div>


    <div class="data">
    
        <div class="container">
                <div class="panel panel-default">
                      <div class="panel-heading">核心数据</div>
                      <div class="panel-body">
                                
                                    <table class="med-list-o" style="width:100%">
                						<tbody>
                							<tr>
                								<td align="center" width="25%">
                									<p>浏览量(PV)</p>
                									<p class="mt10">
                										<span class="balance f24">2</span>
                									</p>
                									
                									<div class="yestoday" style="width:100%;background-color:#f5f5f5">
                									
                									    <span>昨日：4</span><br/>
                									    <span>超越50%的店</span>
                									
                									</div>
                									
                									
                								</td>
                								
                								<td align="center" width="25%">
                									<p>访客数(UV)</p>
                									<p class="mt10">
                										<span class="balance f24">2</span>
                									</p>
                									
                									<div class="yestoday" style="width:100%;background-color:#f5f5f5">
                									
                									    <span>昨日：4</span><br/>
                									    <span>超越50%的店</span>
                									
                									</div>
                								</td>
                								
                								<td align="center" width="25%">
                									<p>订单数(转化率)</p>
                									<p class="mt10">
                										<span class="balance f24">0</span>
                									</p>
                									
                									<div class="yestoday" style="width:100%;background-color:#f5f5f5">
                									
                									    <span>昨日：4</span><br/>
                									    <span>超越50%的店</span>
                									
                									</div>
                								</td>
                								
                								
                								<td align="center" width="25%">
                									<p>支付成交金额</p>
                									<p class="mt10">
                										<span class="balance f24">0</span>
                									</p>
                									
                									<div class="yestoday" style="width:100%;background-color:#f5f5f5">
                									
                									    <span>昨日：4</span><br/>
                									    <span>超越50%的店</span>
                									
                									</div>
                								</td>
                								
                							</tr>
                						</tbody>
        					</table>
                                
                                
                                
                                
                                
                      </div>
                </div>
        </div>
    
    </div>

</div>

<?php V ('shop/footer.php');?>
