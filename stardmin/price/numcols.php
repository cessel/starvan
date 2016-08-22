			<?
			$rows=$_POST['rows'];
			
			echo "<p class='h4'>Выберите столбцы соответствующие столбцам из прайса</p>";
			
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
				
				for($i=0;$i<$rows;$i++)
					{	
						echo "<label>Стобец ".($i+1)."</label>";
						echo "<select id='".$i."' name='".$i."' class='form-control name_cols' onchange='import_disable();return false;'>";
						for($j=0;$j<count($col_names);$j++)
							{	
								if(($i==$j)&&($i!=0)){$selected='selected';}
								else {$selected='';}
								if (($i==0)&&($j==1)){$selected='selected';}
								
								echo "<option id='".$i."_".$j."' ".$selected.">".$col_names[$j]."</option>";
							}
						echo "</select><br>";
					}
			
			?>
