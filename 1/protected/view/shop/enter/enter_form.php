
<?php 
$must = "<span class='red'>*</span>";
$subject_array = array('旅行社', '组织','企业','机构', '个体');
?>


<style>

.form-control{width:400px;}
h4{font-weight:bold;width:80%;padding-bottom: 10px;}
.control-label{font-weight: normal;}
.red{color:red;font-weight:bold;padding-right: 2px;vertical-align: middle;font-size: 1.3em;}
img{max-width:220px;max-height:200px;overflow:hidden;}

</style>

<div class="form-horizontal" id="business-enter" role="form">
   				
   
               <input type="hidden" name="id" value="<?=$enter['id']?>">
               
               <h4 style="border-bottom:1px solid #ccc;">1.商家名称</h4> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"><?=$must?>运营主体</label>
                <div class="col-sm-10">
            
                        <?php foreach ($subject_array as $i=>$subject){?>
                          <label class="radio-inline">
                            <input type="radio" name="subject" id="optionsRadios1" value="<?=$subject?>" <?=($enter['subject'] == $subject || (!$enter && $i==0)) ? "checked='checked'":''?>><?=$subject?>
                          </label>
                       
                        <?php }?>
                </div>
              </div>
            
              <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>商家名称</label>
                <div class="col-sm-10 controls">
                  <input type="text" class="form-control" name="shop_name" value="<?=$enter['shop_name']?>" placeholder="商家名称，公共产品页面可见" check-type="required" required-message="商家名称不能为空！">
                	<span class="label label-info">
                		商家名称会显示在网站页面上，请不要使用特殊字符，如逗号等。
                	</span>
                	
                </div>
              </div>
              
              
              
              
              
              <h4 style="border-bottom:1px solid #ccc">2.联系方式</h4> 
              <div class="form-group control-group">
              	
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>姓氏</label>
                <div class="col-sm-10 controls">
                  <input type="text" class="form-control" name="surname" value="<?=$enter['surname']?>" placeholder="姓氏" check-type="required" required-message="不能为空！">
                    <span class="label label-info">
                		你的个人资料将会严格保密。
                	</span>
                </div>
 
              </div>
              
              <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>名字</label>
                <div class="col-sm-10 controls">
                  <input type="text" class="form-control" name="forename" value="<?=$enter['forename']?>" placeholder="名字" check-type="required" required-message="不能为空！">
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>性别</label>
                <div class="col-sm-10">
                     <select name="sex" class="form-control">
                         <option value="1" <?=$enter['sex'] =='1' ? "selected='selected'":""?>>先生</option>
                         <option value="2" <?=$enter['sex'] =='2' ? "selected='selected'":""?>>女士</option>
                     </select>
                </div>
              </div>
              
              
               <div class="form-group control-group up-pic">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>身份认证</label>
                <div class="col-sm-10 ">
                     <input type='file' name="file" class="up-auth"  value="<?=$enter['authentication']?>">
                     <input type="hidden" name="authentication" value="<?=$enter['authentication']?>">
                     <img src="<?=$enter['authentication'] ? $enter['authentication'].'!190':''?>">
                     
                     <span class="label label-info">
                		请上传运营者身份证或护照的清晰彩色原件照片。
                	 </span>
                </div>
              </div>
              
              <hr/>
              
              <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>工商注册名称</label>
                <div class="col-sm-10 controls">
                  <input type="text" class="form-control" name="registration_name" value="<?=$enter['registration_name']?>"  check-type="required" required-message="工商注册名称不能为空！" placeholder="工商注册名称">
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">邮政编码</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="postcode" value="<?=$enter['postcode']?>" placeholder="邮政编码">
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>所在地</label>
                <div class="col-sm-10" style='padding-left: 30px;'>
                          
                                 <div class="form-group address_p rel control-group">
                                            		    <select id="continent" name="continent" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="3">
                                                              <option value="-1">--洲--</option>
                                                        </select>    
                                                        
                        		 </div>
                        		  
                        		  
                        		   <div class="form-group address_p rel">
                                          <select id="country" name="country" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="4">
                                              <option value="-1">--国家--</option>
                                           </select>
                                        
                        		  </div>
            		  
                        		  
                        		   <div class="form-group address_p rel">
                                        <select id="city" name="city" check-type="required" class=" form-control" style="max-width: 300px;" tabindex="5">
                                          <option value="-1">--城市--</option>
                                        </select> 
                                        
                        		  </div>
                          
                </div>
              </div>
              
              <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>详细地址</label>
                <div class="col-sm-10 controls">
                  <textarea class="form-control" name="address"  check-type="required" required-message="详细地址不能为空！"><?=$enter['address']?></textarea>
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">网站地址</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="web_url" ><?=$enter['web_url']?></textarea>
                </div>
              </div>
              
               <div class="form-group control-group up-pic">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>营业执照</label>
                <div class="col-sm-10 ">
                     <input type='file' name="file" class="up-license"  value="<?=$enter['license']?>">
                     <input type="hidden" name="license" value="<?=$enter['license']?>">
                     <img src="<?=$enter['license'] ? $enter['license'].'!190':''?>">
                     
                    <span class="label label-info">
                		请上传合法有效的营业执照清晰彩色原件扫描件
                	 </span>
                </div>
              </div>
              
              <hr/>
              
               <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>电话</label>
                <div class="col-sm-10 controls">
                  <input type="text" class="form-control" name="tel" value="<?=$enter['tel']?>" check-type="mobile" >
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">QQ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="qq" value="<?=$enter['qq']?>">
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">微信</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="wx" value="<?=$enter['wx']?>">
                </div>
              </div>
              
               <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">微博</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="wb" value="<?=$enter['wb']?>">
                </div>
              </div>
              
              
               <h4 style="border-bottom:1px solid #ccc">3.提交上传</h4> 
                <div class="form-group control-group up-pic">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>头像</label>
                <div class="col-sm-10 " >
                     <input type='file' name="file" class="up-logo"  value="<?=$enter['logo']?>">
                     <input type="hidden" name="logo" value="<?=$enter['logo']?>">
                     <img src="<?=$enter['logo'] ? $enter['logo'].'!w348':''?>">
                     
                     <span class="label label-info">
                		头像在网站页面可见，禁止上传带有联系方式的头像。
                	 </span>
                </div>
              </div>
              
                 <div class="form-group control-group">
                <label for="inputPassword3" class="col-sm-2 control-label"><?=$must?>商家简介</label>
                <div class="col-sm-10 controls">
                  <textarea class="form-control" name="description" check-type="required" required-message="商家简介不能为空！"><?=$enter['description']?></textarea>
                </div>
              </div>
              
              
              
              <h4 style="border-bottom:1px solid #ccc">4.确认入驻条款和条件</h4> 
              <div class="form-group">
                <div class=" col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="clause" <?=$enter ? "checked":''?>> 我已阅读《极旅入驻协议》并同意。
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class=" col-sm-10">
                  <button type="button" id="confirm-enter" class="btn btn-block btn-info">提交入驻</button>
                </div>
              </div>

              
    </div><!-- form-horizontal -->