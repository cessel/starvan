<? $section = $GLOBALS['section']; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-2 col-md-3 col-sm-4">
			<p class='h3'>ЭТО <? echo $section; ?></p>
			<? echo get_stardmin_menu(); ?>
		</div>
		<div class="col-xs-12 col-lg-10 col-md-9 col-sm-8">
			<p class='h3'>Добавление нового прайса</p>
			
			<form id='price_settings' method="post" >
			<label>Название прайса</label>
			<input class='form-control' id='new_price_name' name='new_price_name'  onchange='import_disable();return false;'>
			<? get_encoding_list(); ?>
			<label>Выберите Символ разделения столбцов</label>
			<select  class='form-control' id='new_price_delim' name='new_price_delim'  onchange='import_disable();return false;'>
				<option value=';'>;</option>
				<option value=','>,</option>
			</select>
			<label>Выберите количество столбцов в прайсе</label>
			<?
				$rows=15;
				for($i=2;$i<$rows;$i++)
					{
						echo '<label class="radio-inline">';
						echo '<input type="radio" class="row_nums" name="row_num" id="row_num_'.($i+1).'" value="'.($i+1).'"> '.($i+1);
						echo '</label>';
					}
			
			?>
			<div class='cols_result'></div>
			</form>
			<label>Выберите файл</label>
			<form id='price_upload' method="post" action="" enctype="multipart/form-data">
				<input type='file' class='form-control' id='new_price_file' name=uploadfile>
				<p class='ajax-respond'></p>
				<a href='##@@' class="btn btn-default checkfile-btn">Проверить параметры импорта</a>
				<a href='##@@' class="btn btn-danger importfile-btn" disabled>Импорт нового прайс листа в базу данных</a>
			</form>
			
		</div>
	</div>
</div>
