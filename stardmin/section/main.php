<? $section = $GLOBALS['section']; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-lg-3 col-md-4 col-sm-5">
			<p class='h3'>ЭТО <? echo $section; ?></p>
			<? echo get_stardmin_menu(); ?>
		</div>
		<div class="col-xs-12 col-lg-9 col-md-4 col-sm-5">

			<? $html = file_get_contents('http://porkaska.cessel.bget.ru/autozap_page.php'); 
			$saw = new nokogiri($html);
			$maincat = $saw->get('div#uzList div.Node1')->toArray();
			//$subcat = $saw->get('div#uzList div.Node2 a.titleNode')->toArray();
			foreach ($maincat as $cat)
				{
					echo '*'.$cat['div']['a'][0]['#text'].'<br>';
					$id_a = explode('nodemain',$cat['id']);
					$id=$id_a[1];
					$subcat[$id] = $saw->get('div#nodenid'.$id.' div.Node2')->toArray();
					//print_r($subcat[$id]);
					 foreach ($subcat[$id] as $subcats)
						{
							echo '!'.$subcats['div'][0]['a']['#text'].'<br>';
							$subsubid_a = explode('nids',$subcats['div'][1]['id']);
							$subsubid = $subsubid_a[1];
							$subcatsub[$subsubid] = $saw->get('div#nodesnids'.$subsubid.' div.Node3')->toArray();
							foreach ($subcatsub[$subsubid] as $subsubcats)
								{
									foreach ($subsubcats['a'] as $ssbcats)
										{
											echo '!!'.$ssbcats['#text'].'<br>';
										}
									//print_r($subsubcats);
								}
						}
				}



?>
		</div>
	</div>
</div>
