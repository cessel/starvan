<?php

$uploaddir = 'uploads/';
$filename=$_FILES['uploadfile']['name'];
$uploadfile = $uploaddir . ($filename);
$error=0;
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) 
	{
    
		$filename_explode=explode('.',$filename);
		if ($filename_explode[count($filename_explode)-1]==='csv')
			{
				$error=0;
				$return = "Файл корректен и был успешно загружен.";
			}
		else
			{	
				$error = "Файл неверного типа. Необходимо загружать файлы в формате CSV!<br>";
				if (unlink($uploadfile))
					{
						$error .= "Файл успешно удален с сервера.";
						echo '{"data":"'.$return.'","num_cols_inprice":"'.$num_cols.'","error":"'.$error.'","uploadfile":"'.$uploadfile.'"}';
						exit();
					}
				else
					{
						$error .= "Ошибка удаления файла! Проверте файл на сервере!";
						echo '{"data":"'.$return.'","num_cols_inprice":"'.$num_cols.'","error":"'.$error.'","uploadfile":"'.$uploadfile.'"}';
						exit();
					}
			}
	} 
else 
	{
		$error = "Возможная атака с помощью файловой загрузки!";
		echo '{"data":"'.$return.'","num_cols_inprice":"'.$num_cols.'","error":"'.$error.'","uploadfile":"'.$uploadfile.'"}';
		exit();
	}

$h=fopen($uploadfile,'r');

$data = fgetcsv($h,0,';');
$num_cols=count($data);
if ($num_cols<=2)
	{
		$data='';
		$data = fgetcsv($h,0,',');
		$num_cols=count($data);
		if ($num_cols<=2)
			{
				$error='Кол-во столбцов: '.$num_cols.'| '.$filename_explode[count($filename_explode)-1].'| Слишком мало столбцов в прайсе';
				echo '{"data":"'.$return.'","num_cols_inprice":"'.$num_cols.'","error":"'.$error.'","uploadfile":"'.$uploadfile.'"}';
				exit();
			}
	}
fclose($h);	
echo '{"data":"'.$return.'","num_cols_inprice":"'.$num_cols.'","error":"'.$error.'","uploadfile":"'.$uploadfile.'"}';
?>