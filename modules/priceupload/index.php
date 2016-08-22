<h1>Это модуль "Priceupload"</h1>
<? 
$pr=file($_SERVER['DOCUMENT_ROOT']."/modules/priceupload/pr");
foreach($pr as $str)
	{
		$price[]=explode("	",mb_convert_encoding($str, "UTF-8", "windows-1251"));
	}
//$pr = mb_convert_encoding($pr, "UTF-8", "windows-1251");
//$price= explode("	",$pr);
print_r($price);

//git add comment for priceupload2

?>