<? $section = $GLOBALS['section']; 
$sql="SELECT * FROM `sv_orders` WHERE 1";
$result = sql($sql);
$orders_info = $result->fetch_row();
$sort = array('criterion'=>'avail','dir'=>'desc');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-2 col-md-3 col-sm-4">
			<p class='h3'>ЭТО <? echo $section; ?></p>
			<? echo get_stardmin_menu(); ?>
		</div>
		<div class="col-xs-12 col-lg-10 col-md-9 col-sm-8">
			<p class='h3'></p>
			<? get_stardmin_ordertable_sort($sort); ?>
		</div>
				
		
		
		
		
		
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>
