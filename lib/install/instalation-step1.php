<? get_install_header(); ?>


<div class="container">
	<div class="row">
		<div class="col-xs-10">
			<h1>Установка Системы</h1>
			<h2>Введите параметры базы данных</h2>
			<form class="form-horizontal" action="/index.php" method="post">
				<input type="hidden" name='installstep' value="step2">
				<div class="form-group">
					<label for="DB_HOST" class="col-xs-4 control-label">Сервер базы данных</label>
					<div class="col-xs-6">
						<input type="text"  class="form-control"  name="DB_HOST" id="DB_HOST" value="" />
					</div>
				</div>
				<div class="form-group">
					<label for="DB_NAME" class="col-xs-4 control-label">Имя базы данных</label>
					<div class="col-xs-6">
						<input type="text"  class="form-control"  name="DB_NAME" id="DB_NAME" value="" />
					</div>
				</div>
				<div class="form-group">
					<label for="DB_USER" class="col-xs-4 control-label">Пользователь базы данных</label>
					<div class="col-xs-6">
						<input type="text"  class="form-control"  name="DB_USER" id="DB_USER" value="" />
					</div>
				</div>
				<div class="form-group">
					<label for="DB_PASS" class="col-xs-4 control-label">Пароль пользователя</label>
					<div class="col-xs-6">
						<input type="text"  class="form-control"  name="DB_PASS" id="DB_PASS" value="" />
					</div>
				</div>
				<p class="text-right">
					<button type="submit" class='btn btn-default install' href="#">Начать установку</button>
				</p>
			</form>
		</div>
	</div>
</div>


<? get_install_footer(); ?>

