<style>
#generate_source{
	margin:10px;padding:10px;
}

#generate_source tr td{
	padding-top: 10px;
}

</style>
<div class="form-horizontal" role="form" style="margin-top:20px; background-color:rgb(250, 239, 218);width:80%;" >

    <table  id="generate_source">
        <tbody>
                <tr>
                    <td>时间段</td>
                    <td><input class = "form-control" name= "start_date" value ="<?=$price_one['start_date'] ?>" type= "date"/></td>
                    <td style="text-align: center">至</td>
                    <td><input class = "form-control" name= "end_date" value ="<?=$price_one['end_date'] ?>" type= "date"/></td>
                </tr>
                
                <tr>
                    <td>成人价</td>
                    <td>
                          <div class = "input-group " style= " width:200px;" >
                                  <input type = "text" class= "form-control" name = "adult_price"  >
                                  <span class = "input-group-addon"> 元</span>
                           </div >
                    </td>
                    
                    <td>儿童价</td>
                    <td>
                          <div class = "input-group " style= " width:200px;" >
                                  <input type = "text" class= "form-control" name = "child_price" >
                                  <span class = "input-group-addon"> 元</span>
                           </div >
                    </td>
                    
                </tr>
                
                
                 <tr>
                    <td></td>
                    <td>

                          <input type = "text" class= "form-control" value="<?=$price_one['adult_descrip'] ?>" name ="adult_descrip" style= " width:200px;" placeholder="说明">

                    </td>
                    
                    <td></td>
                    <td>
                         <input type = "text" class= "form-control" value="<?=$price_one['child_descrip'] ?>" name ="child_descrip" style= " width:200px;" placeholder="说明">
                    </td>
                    
                </tr>
                
                
                
                <tr>
                    <td>数量</td>
                    <td colspan="2">
                         <input type = "text" class= "form-control"  style= " width:150px " name = "inventory" >
                    </td>
                    
                     <td><a class = "btn btn-success" id= "generate_price" >生成 </a ></td>
                    
                </tr>
                
              
 
        </tbody>
    </table>


    <div class="calender" style="display:none;" id="calender">
			<div id="price_calender"></div>  
			
			<div id="calender_editor" style="display:none;">
                    <div class="adult_price"><label>成人价</label><span><input name="adult_price" value="1"/></span></div>
                    <div class="child_price"><label>儿童</label><span><input name="child_price" value="1"/></span></div>
                    <div class="inventory"><label>数量</label><span><input name="inventory" value="1"/></span></div>
                    <div><a class="btn btn-default save">保存</a></div>
			</div>           
     </div>








</div>