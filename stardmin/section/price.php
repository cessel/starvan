<? $section = $GLOBALS['section']; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-2 col-md-3 col-sm-4">
			<p class='h3'>ЭТО <? echo $section; ?></p>
			<? echo get_stardmin_menu(); ?>
		</div>
		<div class="col-xs-12 col-lg-10 col-md-9 col-sm-8">
			<p class='h3'>Добавление нового прайса</p>
			
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
