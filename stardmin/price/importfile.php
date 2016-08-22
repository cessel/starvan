 <?
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/a.charset.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
$error=0;
$col_names[]="Не использовать";
$col_names[]="Артикул";
$col_names[]="Производитель";
$col_names[]="Номер запчасти";
$col_names[]="Наименование запчасти";
$col_names[]="Количество";
$col_names[]="Цена";
$col_names[]="Применимость";
$col_names[]="Кроссы";
$col_names[]="Примечания";

$postarr=$_POST;
//print_r($_POST); 
$counter=100;
//$postarr['index'];
$pricepath=$postarr['new_file_name_0'];
$price_arr=file($pricepath);
$maxindex=count($price_arr);
$index=$postarr['index'];
$nowmaxindex=$index+$counter;
if($nowmaxindex>$maxindex)
	{
		$nowmaxindex=$maxindex;
	}
if($maxindex>$index)
	{
		for($k=0;$k<count($col_names);$k++)
			{
				if(array_search($col_names[$k],$postarr))
					{
						$used[$col_names[$k]]=array_search($col_names[$k],$postarr);
					}
				else
					{
						$used[$col_names[$k]]='';
					}
				
			}
		$preg_pattern='/[+=_\\\|}{\]\["\':?\/.><)(*&\^%$#@!~`]/';
		$preg_pattern2='/[+=_\\\|}{\]\["\':?\/><)(*&\^%$#@!~`]/';
		for($i=$index;$i<$nowmaxindex;$i++)
			{
				
				$sql_art = "SELECT `artikul` FROM `sv_parts` ORDER BY id DESC LIMIT 1";
				$result_art = sql($sql_art);
				$art = $result_art->fetch_row();
				$art_num=explode('sv',$art[0]);
				$price_str=mb_convert_encoding($price_arr[$i],'UTF8',$postarr['encode_select']);
				$csv=str_getcsv($price_str,$postarr['new_price_delim']);
				foreach($csv as $c)
					{
						$csv_new=array();
						$c=str_replace(',', ';', $c);
						$c=preg_replace($preg_pattern, '', $c);
						$c=trim($c);
						$csv_new[]=$c;
					}
				
				$sql="INSERT INTO `sv_parts`(`id`, `artikul`, `manufacturer`, `partnumber`, `name`, `quantity`, `price`, `application`, `cross`, `partname`, `note`, `discount_flag`) VALUES ('','newsv".($art_num[1]+1)."','".$csv_new[$used[$col_names[2]]]."','".$csv_new[$used[$col_names[3]]]."','".$csv_new[$used[$col_names[4]]]."','".$csv_new[$used[$col_names[5]]]."','".$csv_new[$used[$col_names[6]]]."','".$csv_new[$used[$col_names[7]]]."','".$csv_new[$used[$col_names[8]]]."','','".$csv_new[$used[$col_names[9]]]."','0')";
				$result = sql($sql);
				
				//$data=$sql;

				$index_new=$i+1;
			}
	}
else
	{
		$error='END';
	}


echo '{"index":"'.$index_new.'","data":"'.$data.'","data_base":"'.$postarr['index'].'","error":"'.$error.'"}';

 ?>