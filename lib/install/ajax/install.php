<? 
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php";
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");
switch($_POST['install_ajax'])
{
	case 1:
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_access`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_contract`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_nir`
		";		
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_users`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_contract_types`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_contract_status`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_client`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_employees`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_grnti`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_post`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_depart`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_direction`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_stage`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_project_work`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_report`
		";
		$sql[]=
		"
			DROP TABLE IF EXISTS `nir_budget`
		";
		foreach($sql as $s)
			{
				sql($s);	
			}
		echo 1;
		break;
	case 2:
	
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_access`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`code` CHAR(10) NOT NULL,
				`page` CHAR(50) NOT NULL,
				`level` int(2) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_contract`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				`labor` int(8) NOT NULL,
				`cost` int(20) NOT NULL,
				`start_date` DATETIME NOT NULL,
				`end_date` DATETIME NOT NULL,
				`type` int(8) NOT NULL,
				`status` int(8) NOT NULL,
				`nir_id` int(8) NULL DEFAULT NULL,
				`client` int(8) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_nir`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				`labor_plan` int(8) NULL DEFAULT NULL,
				`cost_plan` int(20) NULL DEFAULT NULL,
				`end_date_fact` DATETIME NULL DEFAULT NULL,
				`funds_gain` int(20) NULL DEFAULT NULL,
				`desc` VARCHAR(255) NULL DEFAULT NULL,
				`nir_boss` int(8) NULL DEFAULT NULL,
				`nir_expert` int(8) NULL DEFAULT NULL,
				`grnti` int(8) NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_users`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`username` CHAR(50) NOT NULL UNIQUE,
				`password` CHAR(50) NOT NULL UNIQUE,
				`access_code` CHAR(15) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_contract_types`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`type` CHAR(50) NOT NULL UNIQUE,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_contract_status`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_client`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(255) NOT NULL UNIQUE,
				`sphere` CHAR(128) NOT NULL,
				`stage_agree_delay` int(8) NULL DEFAULT NULL,
				`final_agree_delay` int(8) NULL DEFAULT NULL,
				`manager` int(8) NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_employees`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`user_id` int(8) NOT NULL UNIQUE,
				`fam` CHAR(50) NOT NULL,
				`name` CHAR(50) NOT NULL,
				`sname` CHAR(50) NOT NULL,
				`birth` DATETIME NULL DEFAULT NULL,
				`phone` CHAR(25) NULL DEFAULT NULL,
				`email` CHAR(50) NULL DEFAULT NULL,
				`post` int(8) NOT NULL,
				`depart` int(8) NULL DEFAULT NULL,
				`tabel_num` int(16) NOT NULL UNIQUE,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_grnti`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_post`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				`rate` int(15) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_depart`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(255) NOT NULL UNIQUE,
				`boss` int(8) NOT NULL,
				`direction` int(8) NULL DEFAULT NULL,
				`average_rate` int(16) NULL DEFAULT NULL,
				`parent` int(8) NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_direction`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_stage`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT ,
				`code` CHAR(50) NOT NULL UNIQUE,
				`name` CHAR(50) NOT NULL UNIQUE,
				`labor_plan` int(8) NULL DEFAULT NULL,
				`labor` int(8) NULL DEFAULT NULL,
				`cost_plan` int(20) NULL DEFAULT NULL,
				`cost_fix` int(20) NULL DEFAULT NULL,
				`agree_date` DATETIME NULL DEFAULT NULL,
				`start_date` DATETIME NULL DEFAULT NULL,
				`end_date` DATETIME NULL DEFAULT NULL,
				`end_date_fact` DATETIME NULL DEFAULT NULL,
				`parent` int(8) NULL DEFAULT NULL,
				`nir_id` int(8) NOT NULL,
				`desc` VARCHAR(255) NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_project_work`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`stage_id` int(8) NOT NULL,
				`emp_id` int(8) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_budget`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`nir_id` int(8) NOT NULL,
				`stage_id` int(8) NOT NULL,
				`depart_id` int(8) NOT NULL,
				`labor` int(8) NOT NULL,
				`cost` int(16) NULL DEFAULT NULL,
				`month` CHAR(5) NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";
		$sql[]=
		"
		CREATE TABLE IF NOT EXISTS `nir_report`
			(
				`id` int(8) NOT NULL AUTO_INCREMENT,
				`stage_id` int(8) NOT NULL,
				`emp_id` int(8) NOT NULL,
				`date` DATETIME NULL DEFAULT NULL,
				`hours` int(2) NOT NULL,
				`result` CHAR(128) NULL DEFAULT NULL,
				`comment` CHAR(255) NOT NULL,
				PRIMARY KEY (`id`)
			)
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		";

		foreach($sql as $s)
			{
				sql($s);	
			}
		echo 1;
		break;
	case 3:
		$sql[]=
		"
		INSERT INTO `nir_access`
			(`id`, `code`, `page`, `level`)
		VALUES
			('','root','users','1'),
			('','root','contracts','1'),
			('','root','contract-status','1'),
			('','root','finances','1'),
			('','root','nir','1'),
			('','root','nir-planing','1'),
			('','root','nir-labor','1'),
			('','root','emp-distribution','1'),
			('','root','monthwork','1'),
			('','root','report','1'),
			('','boss','users','0'),
			('','boss','contracts','1'),
			('','boss','contract-status','1'),
			('','boss','finances','1'),
			('','boss','nir','0'),
			('','boss','nir-planing','0'),
			('','boss','nir-labor','0'),
			('','boss','emp-distribution','0'),
			('','boss','monthwork','0'),
			('','boss','report','0'),
			('','rp','users','0'),
			('','rp','contracts','0'),
			('','rp','contract-status','0'),
			('','rp','finances','0'),
			('','rp','nir','1'),
			('','rp','nir-planing','1'),
			('','rp','nir-labor','1'),
			('','rp','emp-distribution','0'),
			('','rp','monthwork','0'),
			('','rp','report','0'),
			('','no','users','0'),
			('','no','contracts','0'),
			('','no','contract-status','0'),
			('','no','finances','0'),
			('','no','nir','0'),
			('','no','nir-planing','0'),
			('','no','nir-labor','0'),
			('','no','emp-distribution','1'),
			('','no','monthwork','1'),
			('','no','report','1'),
			('','emp','users','0'),
			('','emp','contracts','0'),
			('','emp','contract-status','0'),
			('','emp','finances','0'),
			('','emp','nir','0'),
			('','emp','nir-planing','0'),
			('','emp','nir-labor','0'),
			('','emp','emp-distribution','0'),
			('','emp','monthwork','1'),
			('','emp','report','1'),
			('','fin','users','0'),
			('','fin','contracts','0'),
			('','fin','contract-status','0'),
			('','fin','finances','1'),
			('','fin','nir','0'),
			('','fin','nir-planing','0'),
			('','fin','nir-labor','0'),
			('','fin','emp-distribution','0'),
			('','fin','monthwork','0'),
			('','fin','report','0')
		";
		$sql[]=
		"
		INSERT INTO `nir_contract`
			(`id`,`code`,`name`,`labor`,`cost`,`start_date`,`end_date`,`type`,`status`,`nir_id`,`client`)
		VALUES
			('','К1-241','Договор К1-241','230','1000000','2015-01-15','2015-05-15','0','0','0','1'),
			('','Л-234','Договор Л-234','300','1500000','2015-01-16','2015-05-16','1','1','1','1'),
			('','П-174','Договор П-174','440','1400000','2015-01-17','2015-05-17','1','2','2','1'),
			('','Н-211','Договор Н-211','600','12000000','2015-01-18','2015-05-18','2','3','3','2'),
			('','Н12-11А6','Договор Н12-11А6','280','1300000','2015-01-19','2015-05-19','2','4','4','3'),
			('','ОК-12','Договор ОК-12','140','800000','2015-01-20','2015-05-20','1','5','5','4')
		";		
		$sql[]=
		"
		INSERT INTO `nir_nir`
			(`id`, `code`, `name`, `labor_plan`, `cost_plan`, `end_date_fact`, `funds_gain`, `desc`, `nir_boss`, `nir_expert`, `grnti`)
		VALUES
			('','Ш167-2','НИР1','','','2015-05-15','1000000','0','0','0','0'),
			('','Ш197-2','НИР2','','','2015-05-16','500000','1','1','1','1'),
			('','Ш17-2','НИР3','','','2015-05-17','400000','2','2','2','1'),
			('','М1-2','НИР4','','','2015-05-18','340000','3','3','3','1'),
			('','Р18-2','НИР5','','','2015-05-19','100000','4','4','4','3'),
			('','К25-2','НИР6','','','2015-05-20','1000000','5','5','5','2')
		";	
		$sql[]=
		"
		INSERT INTO `nir_users`
			(`id`, `username`, `password`, `access_code`)
		VALUES
			('','admin','".myhash('admin')."','root'),
			('','boss','".myhash('boss')."','boss'),
			('','nir_boss','".myhash('nir_boss')."','rp'),
			('','depart_boss','".myhash('depart_boss')."','no'),
			('','employee','".myhash('employee')."','emp'),
			('','employee2','".myhash('employee2')."','emp'),
			('','fin','".myhash('fin')."','fin')
		";	
		$sql[]=
		"
		INSERT INTO `nir_contract_types`
			(`id`, `type`)
		VALUES
			('','Вид договора 1'),
			('','Вид договора 2'),
			('','Вид договора 3'),
			('','Вид договора 4'),
			('','Вид договора 5'),
			('','Вид договора 6')
		";	
		$sql[]=
		"
		INSERT INTO `nir_contract_status`
			(`id`, `code`, `name`)
		VALUES
			('','new','Новый договор'),
			('','tz_agreed','ТЗ согласовано'),
			('','agreed','Согласован'),
			('','concluded','Заключен'),
			('','in_progress','В работе'),
			('','canceled','Отменен')
		";	
		$sql[]=
		"
		INSERT INTO `nir_client`
			(`id`, `code`, `name`, `sphere`, `stage_agree_delay`, `final_agree_delay`, `manager`)
		VALUES
			('','КЛ-932','ООО \"ААА\"','ДПЛА','5','15','1'),
			('','КЛ-МО2','Мин. Обороны','Военпром','10','15','4'),
			('','КЛ-АА32','\"Алмаз-Антей\"','Военпром','7','12','3'),
			('','КЛ-ХР1','ГКНПЦ им. Хруничева','Аэрокосмический комплекс','0','0','2'),
			('','КЛ-У785','МАИ','Образование','2','5','5'),
			('','КЛ-УВЗ','Уралвагонзавод','Военпром','15','15','6')
		";	
		$sql[]=
		"
		INSERT INTO `nir_employees`
			(`id`, `user_id`, `fam`, `name`, `sname`, `birth`, `phone`, `email`, `post`, `depart`, `tabel_num`)
		VALUES
			('','1','Админов','Админ','Админыч','1985-01-15','+79166682262','admin@firm.ru','0','0','000000'),
			('','2','Гендиров','Гендир','Гендирович','1970-01-16','+70000000000','boss@firm.ru','1','1','000001'),
			('','3','Проектов','Проект ','Проектович','1968-01-17','+70000000000','rp@firm.ru','2','2','000002'),
			('','4','Отделов ','Отдел','Отделович','1978-01-18','+70000000000','no@firm.ru','3','3','000003'),
			('','5','Работников  ','Работник','Работникович','1983-01-19','+70000000000','empp@firm.ru','4','4','000004'),
			('','6','Работникова  ','Работника','Работниковна','1983-01-19','+70000000000','empp@firm.ru','4','4','000005'),
			('','7','Финансов ','Финанс ','Финансович','1980-01-20','+70000000000','fin@firm.ru','5','5','000006')
		";	
		
		$sql[]=
		"
		INSERT INTO `nir_grnti`
			(`id`, `code`, `name`)
		VALUES
			('','55.67.39','ПРИБОРЫ МИКРОКЛИМАТА'),
			('','55.47.03','АЭРОДИНАМИКА ЛЕТАТЕЛЬНЫХ АППАРАТОВ'),
			('','55.68','ПРОИЗВОДСТВО ОРУЖИЯ'),
			('','55.49.29','КОНСТРУКЦИЯ РАКЕТ И КОСМИЧЕСКИХ АППАРАТОВ'),
			('','55.42.42','РЕАКТИВНЫЕ И ТУРБОРЕАКТИВНЫЕ ДВИГАТЕЛИ')
		";	
		$sql[]=
		"
		INSERT INTO `nir_post`
			(`id`, `code`, `name`, `rate`)
		VALUES
			('','admin','Администратор','60000'),
			('','boss','Руководитель предприятия','150000'),
			('','nir_boss','Руководитель прокта','100000'),
			('','depart_boss','Начальник отдела','80000'),
			('','employee','Сотрудник отдела','50000'),
			('','fin','Бухгалтер','70000')
		";	
		$sql[]=
		"
		INSERT INTO `nir_depart`
			(`id`, `code`, `name`, `boss`, `direction`, `average_rate`, `parent`)
		VALUES
			('','depart1','Управление','1','1','',''),
			('','depart2','Отдел разработки 1','2','2','',''),
			('','depart3','Отдел разработки 1.1','3','3','','1'),
			('','depart4','Отдел разработки 1.2','4','4','','1'),
			('','depart5','IT-отдел','0','0','',''),
			('','depart6','Финансовый отдел','6','1','','')
		";	
		$sql[]=
		"
		INSERT INTO `nir_direction`
			(`id`, `code`, `name`)
		VALUES
			('','it','Информационные технологии '),
			('','firm_management','Управление предприятием'),
			('','m_c_develop','Военная и гражданская разработка'),
			('','m_develop','военная разработка'),
			('','c_develop','гражданская разработка')
		";	
		$sql[]=
		"
		INSERT INTO `nir_stage`
			(`id`, `code`, `name`, `labor_plan`, `labor`, `cost_plan`, `cost_fix`, `agree_date`, `start_date`, `end_date`, `end_date_fact`, `parent`, `nir_id`, `desc`)

		VALUES
('','ЭТАП 01','ЭТАП 01','30','30','1000000','','2015-01-15','2015-01-15','2015-05-15','2015-05-15','','0',''),
('','ЭТАП 02','ЭТАП 02','40','40','1500000','','2015-01-16','2015-01-16','2015-05-16','2015-05-18','0','0',''),
('','ЭТАП 03','ЭТАП 03','50','50','1400000','','','','2015-05-17','','0','0',''),
('','ЭТАП 04','ЭТАП 04','20','20','12000000','','2015-01-18','2015-01-18','2015-05-18','','','0',''),
('','ЭТАП 11','ЭТАП 11','10','10','1300000','1300000','','','2015-05-19','','','1',''),
('','ЭТАП 12','ЭТАП 12','15','15','800000','','2015-01-20','2015-01-20','2015-05-20','2015-05-15','4','1',''),
('','ЭТАП 13','ЭТАП 13','24','24','1000000','','2015-01-15','2015-01-15','2015-05-15','2015-05-15','','1',''),
('','ЭТАП 21','ЭТАП 21','36','36','1500000','','2015-01-16','2015-01-16','2015-05-16','2015-05-18','','2',''),
('','ЭТАП 22','ЭТАП 22','25','25','1400000','','','','2015-05-17','','','2',''),
('','ЭТАП 23','ЭТАП 23','41','41','12000000','','2015-01-18','2015-01-18','2015-05-18','','','2',''),
('','ЭТАП 31','ЭТАП 31','36','36','1300000','','','','2015-05-19','','','3',''),
('','ЭТАП 32','ЭТАП 32','62','62','800000','','2015-01-20','2015-01-20','2015-05-20','2015-05-15','10','3',''),
('','ЭТАП 33','ЭТАП 33','20','20','1000000','1000000','2015-01-15','2015-01-15','2015-05-15','2015-05-15','10','3',''),
('','ЭТАП 41','ЭТАП 41','50','50','1500000','','2015-01-16','2015-01-16','2015-05-16','2015-05-18','','4',''),
('','ЭТАП 42','ЭТАП 42','150','150','1400000','','','','2015-05-17','','','4',''),
('','ЭТАП 51','ЭТАП 51','60','60','12000000','','2015-01-18','2015-01-18','2015-05-18','','','5',''),
('','ЭТАП 52','ЭТАП 52','50','50','1300000','1300000','','','2015-05-19','','17','5',''),
('','ЭТАП 53','ЭТАП 53','40','40','800000','800000','2015-01-20','2015-01-20','2015-05-20','2015-05-15','','5','')
		";	
		$sql[]=
		"
		INSERT INTO `nir_project_work`
			(`id`, `stage_id`, `emp_id`)
		VALUES
			('','0','4'),
			('','0','5'),
			('','1','4'),
			('','1','5'),
			('','2','4'),
			('','2','5'),
			('','3','4'),
			('','3','5'),
			('','4','4'),
			('','4','5'),
			('','5','4'),
			('','6','4'),
			('','7','4'),
			('','8','4'),
			('','9','4'),
			('','10','4'),
			('','10','5'),
			('','11','4'),
			('','11','5'),
			('','12','4'),
			('','12','5'),
			('','13','4'),
			('','13','5'),
			('','14','4'),
			('','14','5'),
			('','15','4'),
			('','15','5'),
			('','16','4'),
			('','16','5'),
			('','17','4')
		";	
		$sql[]=
		"
		INSERT INTO `nir_budget`
			(`id`, `nir_id`, `stage_id`, `depart_id`, `labor`, `cost`, `month`)
		VALUES
			('','6','1','2','50','','11/14'),
			('','6','2','2','50','','12/14'),
			('','6','3','2','50','','10/14'),
			('','6','4','2','50','','12/14'),
			('','1','5','2','50','','9/14'),
			('','1','6','3','50','','11/14'),
			('','1','7','4','50','','10/14'),
			('','2','8','4','50','','10/14'),
			('','2','9','3','50','','9/14'),
			('','2','10','3','50','','11/14'),
			('','3','11','3','50','','11/14'),
			('','3','12','4','50','','12/14'),
			('','3','13','4','50','','12/14'),
			('','4','14','4','50','','11/14'),
			('','4','15','4','50','','11/14'),
			('','5','16','2','50','','11/14'),
			('','5','17','2','50','','11/14'),
			('','6','1','3','50','','11/14'),
			('','6','2','3','50','','12/14'),
			('','6','3','3','50','','10/14'),
			('','6','4','3','50','','12/14'),
			('','1','5','3','50','','9/14'),
			('','1','6','4','50','','11/14'),
			('','1','7','2','50','','10/14'),
			('','2','8','2','50','','10/14'),
			('','2','9','2','50','','9/14'),
			('','2','10','2','50','','11/14'),
			('','3','11','2','50','','11/14'),
			('','3','12','3','50','','12/14'),
			('','3','13','3','50','','12/14'),
			('','4','14','3','50','','11/14'),
			('','4','15','3','50','','11/14'),
			('','5','16','4','50','','11/14'),
			('','5','17','4','50','','11/14')
		";	
		$sql[]=
		"
		INSERT INTO `nir_report`
			(`id`, `stage_id`, `emp_id`, `date`, `hours`, `result`, `comment`)
		VALUES
			('','0','4','42025','8','ok','Все окей!')
		";	

 		foreach($sql as $s)
			{
				sql($s);	
			}
		echo 1;
		break;
	case 4:
		$handle = fopen($_SERVER['DOCUMENT_ROOT']."/lib/install/install_flag.php","w+");
		ftruncate ($handle,0);
		fclose($handle);
		echo 1;
		break;
}
?>