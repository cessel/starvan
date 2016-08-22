<?
session_start();
header('Content-type: text/html; charset=utf-8'); 
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php";
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");

$stages = stages_info(array('contract_id'=>$_POST['contract_id']));

//echo "CONTRACT_DATA: ID = ".$_POST['contract_id'];
?>
<p class="h5">Данные по этапам</p>
<table class='table table-striped table-condensed'>
<tr>
<td>ID</td>
<td>Название</td>
<td>Стоимость</td>
<td>Дата начала</td>
<td>Дата окончания</td>
</tr>
<?
foreach($stages as $stage)
{ ?>
<tr>
<td><? echo $stage['id']; ?></td>	
<td><? echo $stage['name']; ?></td>
	
<td>
<? if($stage['cost_fix']!=0) {echo $stage['cost_fix'];}
   else {echo $stage['cost_plan'];}?>
</td>
<td>
<? if($stage['start_date']=='0000-00-00 00:00:00'||$stage['start_date']==0) { ?>
<? echo "Этап не начат";?>
<? } else { ?>
<? echo date("d.m.Y",strtotime($stage['start_date'])); ?>
<?  } ?>
</td>
<td>
<? if($stage['end_date']=='0000-00-00 00:00:00'||$stage['end_date']==0) { ?>
<? echo "Этап не окончен";?>
<? } else { ?>
<? echo date("d.m.Y",strtotime($stage['end_date'])); ?>
<?  } ?>
</td>
</tr>	
	
	
<? } ?>


</table>


