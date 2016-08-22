 echo "<h2>".$_GET['module']."</h2>"; 
echo "<h2>".$_GET['content']."</h2>"; 
echo "<h3>Вы искали:</h2>";
echo "<h2>".$_GET['search']."</h2>"; 
echo "<h4>".$_GET['partname']." фирмы ".$_GET['manufacturer']." для ".$_GET['mark']." ".$_GET['model']."</h4>";















?>


<form id='simple_search'>
<input type='text' id='search'>
<a href='#' class='btn btn-default search'>Найти</a>
</form>
<a href='#full_search' data-toggle='collapse'>Расширенный поиск</a>
<div id="full_search" class='collapse'>
<form id='full_search'>
<input type='text' id='partname'>
<input type='text' id='manufacturer'>
<input type='text' id='mark'>
<input type='text' id='model'>
<a href='#' class='btn btn-default search'>Найти</a>
</form>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
		$(".search").click(function(e) {
			var form = $(this).parent();
			var search_arr;
			var target;
			if (form.attr('id')=='simple_search')
				{
					search_arr[0] = form.children().eq(0).val();
					target = "poisk-po-catalogu";
				}
			else
				{
					search_arr[0] = form.children().eq(0).val();
					search_arr[1] = form.children().eq(1).val();
					search_arr[2] = form.children().eq(2).val();
					search_arr[3] = form.children().eq(3).val();
					target = "poisk-po-catalogu-rashireniy";
				}
			var uri='';
			for(var i=0;i<search_arr.lenght;i++)
				{
					uri=uri+'/'.search_arr[i];
				}
			window.location.href="/+target+/"+uri+"/";
		});
	});
</script>