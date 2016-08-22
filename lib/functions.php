<?
function get_title()
	{
		global $content;
		echo $content;
	}

function get_header_files()
	{
			
		echo "<script src='http://yastatic.net/jquery/2.2.0/jquery.min.js' type='text/javascript' ></script>";
		echo "<script src='http://yastatic.net/bootstrap/3.3.6/js/bootstrap.min.js' type='text/javascript' ></script>";
		echo "<link href='http://yastatic.net/bootstrap/3.3.6/css/bootstrap.min.css' type='text/css' rel='stylesheet' />";

	}
function get_includes()
	{
		$includes = scandir($_SERVER['DOCUMENT_ROOT']."/includes/");
		foreach ( $includes as $file )
			{
				$extension=explode('.',$file);
				switch ($extension[count($extension)-1])
					{
						case "css":
							echo "<link href='http://".$_SERVER['HTTP_HOST']."/includes/".$file."' type='text/css' rel='stylesheet' />";
							break;
						case "js":
							echo "<script src='http://".$_SERVER['HTTP_HOST']."/includes/".$file."' type='text/javascript' ></script>";
							break;
						default:
							break;
					}
			}
	}
function get_header()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/theme/header.php");
	}
function get_footer()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/theme/footer.php");
	}
function get_module($modulename)
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/modules/".$modulename."/index.php");
	}
function get_loginform()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/loginform.php");
	}
function get_backend()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/backend.php");
	}
function get_stardmin_mainsection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/main.php");
	}
function get_stardmin_ordersection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/order.php");
	}
function get_stardmin_pricesection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/price.php");
	}
function get_stardmin_zapssection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/zaps.php");
	}
function get_stardmin_clienssection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/cliens.php");
	}
function get_stardmin_settingssection()
	{
		$inc = new Includer;
		$inc->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/section/settings.php");
	}
function get_stardmin_menu($args = array ("Главная" => "main","Заказы" => "order","Прайсы" => "price","Запчасти" => "zaps","Клиенты" => "clients","Пользователи и настройки" => "settings"))
	{
		$section=$GLOBALS['section'];
		$menu="<div  class='list-group'>";
		foreach ($args as $name => $url)
			{
				 if($section==$url){$a = 'active';} 
				 else {$a = '';}
				$menu.="<a href='/stardmin/".$url."/' class='list-group-item ".$a."'>".$name."</a>";
			}
		$menu.="</div>";
		return $menu;
	}
function get_client($client_id)
	{
		$include = new Includer;
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
		$sql="SELECT * FROM `sv_clients` WHERE `id` = '".$client_id."'";
		$result = sql($sql);
		return $client = $result->fetch_assoc();

	}
function get_part($part_id)
	{
		$include = new Includer;
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
		$sql="SELECT * FROM `sv_parts` WHERE `id` = '".$part_id."'";
		$result = sql($sql);
		return $part = $result->fetch_assoc();

	}
function get_order_status($order_status_id)
	{
		$include = new Includer;
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
		$sql="SELECT * FROM `sv_order_status` WHERE `id` = '".$order_status_id."'";
		$result = sql($sql);
		$status = $result->fetch_assoc();
		return $status['name'];
	}
function get_order_parts_quantity($json,$part_id)
	{
		$parts_arr = json_decode($json, true);
		return $parts_arr[$part_id];
	}
function get_orders()
	{
		$include = new Includer;
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
		$sql="SELECT * FROM `sv_orders` WHERE 1";
		$result = sql($sql);
		while ($row = $result->fetch_assoc()) 
			{
				$parts_arr = json_decode($row['parts_id'],true);
				//print_r($parts_arr);
				foreach($parts_arr as $part_id => $q)
					{
						$parts[$part_id]=get_part($part_id);
						$parts[$part_id]['order_quantity'] = get_order_parts_quantity($row['parts_id'],$part_id);
					}
				
				
				$client = get_client($row['client_id']);
				$orders[$row['id']] = array
					(
						'id' => $row['id']
						,'datetime' => $row['datetime']
						,'parts' => $parts
						,'client' => $client
						,'discount' => $row['discount']
						,'status' => get_order_status($row['status'])
					);
			}
		return $orders;
	}
function get_ordertable_title($echo='0')
	{
		$title="<thead>";
		$title.="<tr>";
		$title.="<th><a href='#order_id'>Номер заказа</a></th>";
		$title.="<th><a href='#date'>Дата заказа</a></th>";
		$title.="<th><a href='#partnumber'>Номер запчасти</a></th>";
		$title.="<th><a href='#partmanuf'>Производитель запчасти</a></th>";
		$title.="<th><a href='#parts'>Наименование запчасти</a></th>";
		$title.="<th><a href='#quantity'>Количество</a></th>";
		$title.="<th><a href='#price'>Цена</a></th>";
		$title.="<th><a href='#sum'>Сумма</a></th>";
		$title.="<th><a href='#status'>Статус</a></th>";
		$title.="</tr>";
		$title.="</thead>";
		if ($echo != 0)
			{echo $title;}
		return $title;
	}
function get_ordertable_order($order,$echo='0')
	{
		$date=date("d.m.Y H:i", $order['datetime']);
		$orderstable="<tbody>";
		
		foreach ($order['parts'] as $part)
			{
				$discount=$order['discount'];
				if($part['discount_flag']==0) 
					{$discount=0;}
				$price=$part['price']*(1-($discount/100));
				$sum=$price*$part['order_quantity'];
				$orderstable.="<tr>";
				$orderstable.="<td><a href='#odred_id_".$order['id']."' class='odred_id_".$order['id']."'>".$order['id']."</a></td>";
				$orderstable.="<td><a href='#date_".$order['id']."' class='date_".$order['id']."'>".$date."</a></td>";
				$orderstable.="<td><a href='#partnumber_".$order['id']."' class='partnumber_".$order['id']."'>".$part['partnumber']."</a></td>";
				$orderstable.="<td><a href='#partmanuf_".$order['id']."' class='partmanuf_".$order['id']."'>".$part['manufacturer']."</a></td>";
				$orderstable.="<td><a href='#parts_".$order['id']."' class='parts_".$order['id']."'>".$part['name']."</a></td>";
				$orderstable.="<td><a href='#quantity_".$order['id']."'  class='quantity_".$order['id']."'>".$part['order_quantity']."</a></td>";
				$orderstable.="<td><a href='#price_".$order['id']."' class='price_".$order['id']."'>".$price."</a></td>";
				$orderstable.="<td><a href='#sum_".$order['id']."' class='sum_".$order['id']."'>".$sum."</a></td>";
				$orderstable.="<td><a href='#status_".$order['id']."' class='status_".$order['id']."'>".$order['status']."</a></td>";
				$orderstable.="</tr>";
			}
		$orderstable.="</tbody>";
		if ($echo != 0)
			{echo $orderstable;}
		return $orderstable;
	}

function get_stardmin_ordertable_sort($sort)
	{
		$include = new Includer;
		$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
		$orders = get_orders();
		echo "<div class='table-responsive'>";
		echo "<table class='table table-hover'>";

		get_ordertable_title(1);
		foreach ($orders as $order)
			{
				get_ordertable_order($order,1);
			}
		echo "</table>";
		echo "</div>";
		
		
	}
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
function str2url($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}
function get_encoding_list() {
	echo "<label>Выберите кодировку</label>";
	$encode = array ("UTF-8","CP-1251","ISO-8859-1","ASCII","ArmSCII-8","BIG-5","CP50220","CP50220raw","CP50221","CP50222","CP51932","CP850","CP866","CP932","CP936","CP950","EUC-CN","EUC-JP","EUC-JP-2004","EUC-KR","EUC-TW","GB18030","HZ","ISO-2022-JP","ISO-2022-JP-2004","ISO-2022-JP-MOBILE#KDDI","ISO-2022-JP-MS","ISO-2022-KR","ISO-8859-10","ISO-8859-13","ISO-8859-14","ISO-8859-15","ISO-8859-16","ISO-8859-2","ISO-8859-3","ISO-8859-4","ISO-8859-5","ISO-8859-6","ISO-8859-7","ISO-8859-8","ISO-8859-9","JIS","JIS-ms","KOI8-R","KOI8-U","SJIS","SJIS-2004","SJIS-Mobile#DOCOMO","SJIS-Mobile#KDDI","SJIS-Mobile#SOFTBANK","SJIS-mac","SJIS-win","UCS-2","UCS-2BE","UCS-2LE","UCS-4","UCS-4BE","UCS-4LE","UHC","UTF-16","UTF-16BE","UTF-16LE","UTF-32","UTF-32BE","UTF-32LE","UTF-7","UTF-8-Mobile#DOCOMO","UTF-8-Mobile#KDDI-A","UTF-8-Mobile#KDDI-B","UTF-8-Mobile#SOFTBANK","UTF7-IMAP","Windows-1252","Windows-1254","eucJP-win");	
	echo "<select id='encode_select' name='encode_select' class='form-control encoding_types' onchange='import_disable();return false;'>";
		for($i=0;$i<count($encode);$i++)
			{	
				echo "<option>".$encode[$i]."</option>";
			}
	echo "</select><br>";
	}
function backup_database_tables($host,$user,$pass,$name,$tables)
{
 
    @$link = mysql_connect($host,$user,$pass);
    mysql_select_db($name,$link);
 
    //Получаем все таблицы
    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
 
    //Цикл по всем таблицам и формирование данных
	$return='';
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);
 
        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
 
        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }
 
    //Сохраняем файл
    $handle = fopen('db_backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
	
}
	
		












?>
