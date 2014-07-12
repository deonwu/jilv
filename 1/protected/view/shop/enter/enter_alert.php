<?php if($enter['shop_id'] > 0){?>




<?php if (!$enter['verify_status']){?>
    <div class="alert alert-warning">
	              商家入驻信息正在审核中，
	               审核通过后才能，录入旅游活动信息。
    </div>
<?php }elseif ($enter['verify_status'] === '2'){

        $refund_arr = explode(";",$enter['refund_proof']);
   
?>    
    <div class="alert alert-danger" style='color:red'>
	    <strong> 已被管理员驳回 </strong><br/>  
                    	    
             <div style="background-color:white;display:block;padding:10px;color:black;margin-top:10px;">         
        	          <p>驳回原因:&nbsp;&nbsp;<?=$enter['refund_excuse']?></p>
        	          <p>驳回材料:&nbsp;&nbsp;   
        	             <?php if ($refund_arr){?>
        	 
                            	 <?php foreach ($refund_arr as $refund){?>
                            	     <a href="<?=$refund?>" target="_blank">点击查看</a>
                            	 <?php }?>
        	 
        	             <?php }?> 
        	         </p>
        	</div>        
	</div>
    	                
    	    
<?php }?>

    	    
    	    
    	    
    	    
    	    
    	    
    	    
    	    
    	    
    	    
    	    
<?php } ?>