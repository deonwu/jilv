<?php V ('shop/header.php');?>

<div class = "col-lg-12" style="padding:0px;">

    <div class = "col-lg-2 col-md-2 sidebar-nav" style="padding:0px;">
            
            
            <?php V('shop/left_nav.php');?>
    </div >
                
    <div class = "col-lg-10 col-md-10 ">
    	
    	<div class="panel panel-default">
	    	<div class="panel-heading">
	      		<h4 class="panel-title">
	      			注册成为供应商
	      		</h4>
   		 	</div>
			<div class="panel-body">
				<?php include 'enter_alert.php';?>
		
		
				<?php include 'enter_form.php';?>
		
   
			</div>
		</div>
 	</div><!-- col-lg-11 -->                 
</div>
             







<!-- 此部分为js加载地区控件 -->
<script src="<?=$THEME_URL?>/js/continent.js"></script>
<script>
       
//几大洲长度
var a_l=continents.length;

var continent = document.getElementById("continent");
var country = document.getElementById("country");
var city = document.getElementById("city");


for_add(continent,continents,a_l);


continent.addEventListener("change",function(){
	var that = this;
	var _index = that.selectedIndex;
	country.length = 1;
	city.length = 1;
	if(_index != 0){
		that.setAttribute("data-continent-id",continents[_index-1]);
		var children_l = continents[_index-1]["countries"].length;
		for_add(country,continents[_index-1]["countries"],children_l);
	}
},false)

country.addEventListener("change",function(){
	var _parent_index = continent.selectedIndex;
	var that = this;
	var _index = that.selectedIndex;
	city.length = 1;
	if(_index != 0){
		that.setAttribute("data-country-id",continents[_parent_index-1]["countries"][_index-1]);
		var children_l = continents[_parent_index-1]["countries"][_index-1]["cities"].length;
		for_add(city,continents[_parent_index-1]["countries"][_index-1]["cities"],children_l);
	}
},false)

city.addEventListener("change",function(){
	var _parent_index = continent.selectedIndex;
	var _country_index = country.selectedIndex;
	var that = this;
	var _index = that.selectedIndex;
	if(_index != 0){
		that.setAttribute("data-city-id",continents[_parent_index-1]["countries"][_country_index-1]["cities"][_index-1]);
	}
},false)	


function for_add(obj,arr,l){

		for(var i = 0; i < l; i++){
			var newOption = new Option(arr[i].name,i);
			obj.add(newOption,undefined);
		}
	
}

</script>

<!-- 此部分为根据数据库里的地址显示到界面上 -->
<script>

<?php if ($enter){?>

render_continents("<?=$enter['continent']?>","<?=$enter['country']?>","<?=$enter['city']?>");

<?php }?>

function render_continents(param1,param2,param3){
	var CURRENT = {
			continent : param1,
			country : param2,
			city : param3,
	};

	//注册 continent
	var c = continents;
	var i = register(c,$("#continent"),CURRENT.continent);
	for_add(country,c[i].countries,c[i].countries.length);

	//注册coutry
	var t = c[i].countries;
	var j = register(t,$("#country"),CURRENT.country);
	for_add(city,t[j].cities,t[j].cities.length);

	//注册city
	var y = t[j].cities;
	var h = register(y,$("#city"),CURRENT.city);
}


function register(obj,$_new,current){

    for(var $i=0;$i<obj.length;$i++){

        if (obj[$i].name == current){

        	$_new.find("option").each(function($j,item){          
                 if($(item).text() == obj[$i].name){
                       item.selected=true;
                 }
             })             

            return $i;
            
        }
    }    
	
}


</script> 





<?php V ('shop/footer.php');?>

