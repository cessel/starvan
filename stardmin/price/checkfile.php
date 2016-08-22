<?
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/a.charset.php");

errors('on');

//print_r($_POST);
//echo "<hr>";
$postarr=$_POST;
if(!isset($_POST['new_file_name_0']))
	{
		echo('{"error":"Сначала выберите и загрузите прайс"}');
		exit();
	}
if(!isset($_POST['row_num']))
	{
		echo('{"error":"Укажите количество стобцов в прайсе"}');
		exit();
	}
$fakepath=$_POST['new_file_name_0'];
$new_price_delim=$_POST['new_price_delim'];
$fakepath_arr=explode('\\',$fakepath);

$filename=trim($fakepath_arr[count($fakepath_arr)-1]);

$h=fopen($filename,'r');
$counter=0;
while ((($data = fgetcsv($h,0,$new_price_delim))!=FALSE)&&($counter<50))
	{
		$counter++;
		$data_rus = '';
		foreach ($data as $d)
			{
				$d_rus=mb_convert_encoding($d,'UTF8',$postarr['encode_select']);
				//$d_rus=$d;
				$data_rus[]=$d_rus;
			}
		$price_arr[]=$data_rus;
	}
	
fclose($h);

	$table="<div class='table-responsive'>";
	$table.="<table class='table table-hover table-condensed'>";
	$table.="<thead>";
	$table.="<tr>";
		
	for ($i=0;$i<$postarr['row_num'];$i++)
		{
			if ($postarr[$i]!='Не использовать')
				{
					$table.="<th><a href='#thead'>".$postarr[$i]."</a></th>";
					$used[]=$i;
				}
		}
	$table.="</tr>";
	$table.="</thead>";
	
	$table.="<tbody>";
	if (count($price_arr)>15) {$num_check_rows=15;}
	else {$num_check_rows=count($price_arr);}
	 
	for ($i=0;$i<$num_check_rows;$i++)
		{
			$table.="<tr>";
			if ((count($price_arr[$i])<3))
				{
					echo '{"error":"Количество столбцов не корректно: '.count($price_arr[$i]).'. Необходимо как минимум 3 столбца. Попробуйте поменять разделитель столбцов"}';
					exit();
				}
			else if(count($used)>count($price_arr[$i]))
				{
					echo '{"error":"Количество столбцов не соответствует количеству столбцов в прайс-листе их там: '.count($price_arr[$i]).'"}';
					exit();
				}
			if(count($used)>count($price_arr[$i]))
				{$num_cols=count($price_arr[$i]);}
			else
				{
					$num_cols=count($used);
				}
			for ($j=0;$j<$num_cols;$j++)
				{
					$table.="<td>".$price_arr[$i][$used[$j]]."</td>";
				}
			$table.="</tr>";
		}
	$table.="</tbody>";
	$table.="</table>";
	
	//echo '{"table":"'.$table.'","data":"'.$postarr.'","filename":"'.$filename.'","error":"0"}';
	echo '{"table":"'. str_replace('"',"'",$table).'","filename":"'.$filename.'","error":"0"}';
?>