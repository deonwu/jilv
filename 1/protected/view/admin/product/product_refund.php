<?php V ('admin/header.php');?>
<?php 

$sex_array = array('1'=>'男','2'=>'女');
$status = array(0=>'未审核',1=>'审核通过');

?>

<div class = "col-lg-12 clearfix" style="padding:0px;">

    <div class = "col-lg-2 col-md-2 sidebar-nav" style="padding:0px;">
             <?php V ('admin/left_nav.php');?>
     </div >
         
     <div class = "col-lg-10 col-md-10 ">
      
              <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4>【<strong>驳回处理</strong>】 <strong style='color:red'>&nbsp;&nbsp;<?=$product['name']?></strong></h4>
                      </div>
                      <div class="panel-body">
                                      
                                   <div class="form" role="form" id="refund_product">
                                   
                                        <input type="hidden" name="id" value="<?=$product['id']?>">
                                        
                                        
                                        <?php $refund = json_decode($product['refund_content'],true)?>
                                        
                                        
                                        <div class="form-group control-group">
                                            <label for="inputPassword3" class="control-label"><?=$must?>驳回原因</label>
                                            <div class="controls">
                                               <textarea name="refund_excuse" class="form-control" style="width:400px;min-height:150px;" check-type="required"><?=$refund['refund_excuse']?></textarea> 
                                              
                                            </div>
                                        </div>
                                          
                                          
                                        <div class="form-group control-group refund">
                                            <label for="inputPassword3" class="control-label"><?=$must?>凭证</label>
                                            <div class="controls">
                                              <input type="file" name="file" class="up_excuse">
                                              <input type='hidden' name="refund_proof">
                                            </div>
                                        </div>
                                          
                                       
                                       <div class="form-group pic_list">
                                       <?php if ($refund['refund_proof']){
                                            $pic_array = explode(";",$refund['refund_proof']);  
                                             foreach ($pic_array as $pic){?>
                                     
                                     <div class="item">
                                         <img src="<?=$pic?>!190">
                                         <input type='hidden' name='img' value='<?=$pic?>'>
                                         <span class="del"> <i class='icon-remove-sign' style='font-size:2em;'></i></span>
                                     </div>
                                       

                                       <?php }
                                        }?>
                                       
                                       </div>   
                                          
                                          
                                         <div class="form-group" style="text-align:center">
                                        			<a class="btn btn-info save">保存</a>
                                          </div>	 
            
                                    </div>

                      </div>
              </div>
                         
      </div>
      
      
    
    
    
    
      
</div>

<?php V ('admin/footer.php');?>