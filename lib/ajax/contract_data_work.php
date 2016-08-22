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


		<? foreach($stages as $stage)
			{ 
					$id = $stage['id'];
				
					$plan_percent = 100;
					$fact_percent = ($stage['labor']/$stage['labor_plan'])*$plan_percent;
					if($fact_percent<$plan_percent)
						{
							$color="red";	
						}
					else
						{
							$color="blue";	
						}
					$name=$stage['name'];
					$func_name="stage_".$id;
			 	am_chart_generator($id,$plan_percent,$fact_percent,$color,$name); ?>
				<div class="row">
					<div class="col-xs-12">
						<div id="chart_div_am_<? echo $id; ?>" style="width: auto; height: 150px;"></div>
					</div>
				</div>
		<?	} ?>










<?
/*
?>

					<script type='text/javascript'>
							function gogogo()
								{
									<?
									foreach($stages as $stage)
										{
											echo "stage_".$stage['id']."();";
										}
									?>	
								}
						</script>


		<? foreach($stages as $stage)
			{ 
					$id = $stage['id'];
				
					$plan_percent = 100;
					$fact_percent = ($stage['labor']/$stage['labor_plan'])*$plan_percent;
					if($fact_percent<$plan_percent)
						{
							$color="red";	
						}
					else
						{
							$color="blue";	
						}
					$name=$stage['name'];
					$func_name="stage_".$id;
			 	echo contract_dynamic($id,"'',".$plan_percent.",".$fact_percent,$color,$name,$func_name); ?>
				<div class="row">
					<div class="col-xs-12">
						<div id="chart_div<? echo $stage['id']; ?>" style="width: auto; height: 100px;"></div>
					</div>
				</div>
		<?	} ?>

*/