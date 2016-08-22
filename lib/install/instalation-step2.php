<? get_install_header(); ?>

<?php

		$link = mysql_connect($_POST['DB_HOST'], $_POST['DB_USER'], $_POST['DB_PASS'])
				or die("<p class='text-error bg-error' >Could not connect: " . mysql_error()."</p>");
		if($link)
			{
				$settings=
				"
				<?php
define('DB_HOST','".$_POST['DB_HOST']."'); 
define('DB_USER','".$_POST['DB_USER']."');
define('DB_PASS','".$_POST['DB_PASS']."');
define('DB_NAME','".$_POST['DB_NAME']."');
?>

				
				";
				$handle = fopen($_SERVER['DOCUMENT_ROOT']."/lib/settings.php","w+");
				fclose($handle);
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/lib/settings.php",trim($settings));
			}
		
?>
<div class="container">
	<div class="row">
		<div class="col-xs-10">
			<h1 class="result text-success bg-success">Соединение с базой данных успешно установлено...</h1>
			<h2 class="result1"></h2>
			<h2 class="result2"></h2>
			<h2 class="result3"></h2>
			<h2 class="result4"></h2>
			<a class='btn btn-default btn-next hide'></a>
		</div>
		
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
	

	$.post('http://<? echo $_SERVER['HTTP_HOST']; ?>/lib/install/ajax/install.php',{'install_ajax':1},function(data)
		{
			if(data!=1)
				{
					$(".result1").html(data);
					$(".btn-next").html("Повторить");
					$(".btn-next").removeClass("hide");
					$(".btn-next").attr('href','/index.php');
					return;
				}
			else
				{
					var msg = "<span class='text-success bg-success'>Подготовка базы данных завершена...</span>";
					$(".result1").html(msg);
					$.post('http://<? echo $_SERVER['HTTP_HOST']; ?>/lib/install/ajax/install.php',{'install_ajax':2},function(data)
						{
									
							if(data!=1)
								{
									$(".result2").html(data);
									$(".btn-next").html("Повторить");
									$(".btn-next").removeClass("hide");
									$(".btn-next").attr('href','/index.php');
									return;
								}
							else
								{
									msg = "<span class='text-success bg-success'>Создание таблиц завершено...</span>";
									$(".result2").html(msg);
									$.post('http://<? echo $_SERVER['HTTP_HOST']; ?>/lib/install/ajax/install.php',{'install_ajax':3},function(data)
										{
											if(data!=1)
												{
													$(".result2").html(data);
													$(".btn-next").html("Повторить");
													$(".btn-next").removeClass("hide");
													$(".btn-next").attr('href','/index.php');
													return;
												}
											else
												{
													msg = "<span class='text-success bg-success'>Загрузка данных завершена...</span>";
													$(".result3").html(msg);
													$.post('http://<? echo $_SERVER['HTTP_HOST']; ?>/lib/install/ajax/install.php',{'install_ajax':4},function(data)
														{
															if(data!=1)
																{
																	$(".result4").html(data);
																	$(".btn-next").html("Повторить");
																	$(".btn-next").removeClass("hide");
																	$(".btn-next").attr('href','/index.php');
																	return;
																}
															else
																{
																	msg = "<span class='text-success bg-success'>Установка завершена.</span>";
																	$(".result4").html(msg);
																	$(".btn-next").attr('href','/index.php');
																	$(".btn-next").html("Завершение установки");
																	$(".btn-next").removeClass("hide");
																	
																	
																}
														});	
												}
										});
								}

				});
			}
		});
	
	
	
	
});
</script>
<? get_install_footer(); ?>



