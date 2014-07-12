<?php 

    if($product_info['verify_status'] === '2'){
        
        $refund_arr = explode(";",$product_info['refund_proof']);
?>
        


     <div class="alert alert-danger" style='color:red'>
	    <strong> 已被管理员驳回 </strong><br/>  
                    	    
             <div style="background-color:white;display:block;padding:10px;color:black;margin-top:10px;">         
        	          <p>驳回原因:&nbsp;&nbsp;<?=$product_info['refund_excuse']?></p>
        	          <p>驳回材料:&nbsp;&nbsp;   
        	             <?php if ($refund_arr){?>
        	 
                            	 <?php foreach ($refund_arr as $refund){?>
                            	     <a href="<?=$refund?>" target="_blank">点击查看</a>
                            	 <?php }?>
        	 
        	             <?php }?> 
        	         </p>
        	</div>        
	</div>








<?php     
    }
?>