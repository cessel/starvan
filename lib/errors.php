<?php
function errors($status='on')
	{
		if ($status='on')
			{
				ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
				error_reporting(E_ALL); // E_ALL - отображаем ВСЕ ошибки
			}
		else
			{
				ini_set('display_errors', 'Off'); // теперь сообщений НЕ будет
			}
	}
?>
