<div id="user-contents" class="contents">	
	
	<div id="user-kpimenu" class="accordion lefted">
	<?php foreach ($userid as $userid_item): 
				echo "<div><a href='verify?q=auditor_verify_".$userid_item['user_id']."'><h3>".$userid_item['user_id']."</h3></a></div>";  
		  endforeach; ?>
	</div>
	
	<div id="user-inside" class="lefted">
		<?php 
			if($checker!='empty'):
			echo "<div class='ratingsdiv'><table><tr><td><h3>Put name here</h3></td>";
				
				//current results
				foreach($period as $period_item):
					if($period_item['active']==1)
					{
						echo "<td><h3>".$period_item['results_name']."</h3></td>";
					}
				endforeach;
				
				//previous results
				foreach($period as $period_item1):
					if($period_item1['active']==0)
					{
						echo "<td><h3>".$period_item1['results_name']."</h3></td>";
					}
				endforeach;
					echo "</tr>";
			
				foreach ($kpi as $kpi_item):
					echo "<tr><td><h3>".$kpi_item['kpi_name']."</h3></td></tr>";
						foreach ($subkpi as $subkpi_item):
							if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
							{
								echo "<tr><td><h3>".$subkpi_item['kpi_name']."</h3></td></tr>";
									foreach ($metric as $metric_item):
										if($metric_item['kpi_id']==$subkpi_item['kpi_id'])
										{
											echo "<tr>";
											echo "<td>".$metric_item['field_name']."</td>";
											
											if($user_id==$metric_item['user_id'])
											{
												
												//current results
												foreach($period as $period_item3):
												
													if($period_item3['active']==1)
													{
														if($period_item3['results_id']==$metric_item['results_id'])
														{
															echo "<td>".$metric_item['value']."</td>";
														} else {
															echo "<td></td>";
														}
													}
												endforeach;
												
												//previous results
												foreach($period as $period_item2):
												
													if($period_item2['active']==0)
													{
														if($period_item2['results_id']==$metric_item['results_id'])
														{
															echo "<td>".$metric_item['value']."</td>";
														} else {
															echo "<td></td>";
														}
													}
												endforeach;
											}
											echo "</tr>";
										}
									endforeach;
							}
						endforeach;
				endforeach;
			echo "</table>/div>";
			else:
				echo "<h2>eUP KPI: After 2 months</h2><p>Choose a User on the left.</p><br>";
		
		    endif;
		?>
	</div>
</div>