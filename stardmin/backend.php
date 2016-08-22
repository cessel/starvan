 
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<p class='h3'>БЭКЕНД</p>
			<button class='signout-btn btn-default btn'>Выход</button>
		</div>
	</div>
</div>

<? 

@$GLOBALS['section'] = $_GET['section'];
if(!isset($GLOBALS['section']))
	{$GLOBALS['section'] = 'main';}
$section = $GLOBALS['section'];


switch ($section) {
case 'main':
    get_stardmin_mainsection();
    break;
case 'order':
    get_stardmin_ordersection();
    break;
case 'price':
    get_stardmin_pricesection();
    break;
case 'zaps':
    get_stardmin_zapssection();
    break;
case 'cliens':
    get_stardmin_clienssection();
    break;
case 'settings':
    get_stardmin_settingssection();
    break;
default:
    get_stardmin_mainsection();
    break;

}

















?>