<div id="user-contents" class="contents">
	<div id="user-kpimenu" class="accordion menu lefted">
		<?php foreach ($kpi as $kpi_item): 
			 echo "<div><h3>".$kpi_item['kpi_name']."</h3><ul>";
				 foreach ($subkpi as $subkpi_item): 
					
						if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
						{
							$url1 = str_replace(" ", "_", $kpi_item['kpi_name']);
							$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
							echo "<div><li><a href='settarget?q=".$url1."/".$url2."'>".$subkpi_item['kpi_name']."</a></div></li>"; 
						}
					
				 endforeach; 
			 echo "</ul></div>";
		      endforeach; 
		?>
	</div>
	<?php
		if($checker=='empty') {
			echo "<div id='user-inside' class='inside'>
					<h3>Edit Targets</h3>
					<p>Choose a KPI on the left.</p><br>
				  </div>";
		} else if($checker=='notempty') {
			$ctr = 0;
				foreach ($metric as $metric_item): 
		
				 
				 foreach ($subkpi as $subkpi_item): 
						 
							if($subkpi_item['kpi_id']==$metric_item['kpi_id'])
							 {
								foreach ($kpi as $kpi_item):
									if($kpi_item['kpi_id']==$subkpi_item['parent_kpi'])
									{
										$parent = $kpi_item['kpi_name'];
									}
								endforeach;
								
								if($ctr==0)
								{
									$url1 = str_replace(" ", "_", $parent);
									$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
									$path = $url1."/".$url2;
									echo "<h2>".$parent." > ".$subkpi_item['kpi_name']."</h2>
										  <table><tr>
											<th>Metric Name</th>
											<th>Target</th>
										  </tr>";
									$ctr = 1;
								}
					         }
							
				 endforeach;
				 
				 echo "<tr>
						<td>".$metric_item['field_name']."</td>
						<td>".$metric_item['target']."</td>
					  </tr>";
				 
				endforeach;
				
				echo "</table>";
					
				echo "<a href='edittarget?q=".$path."'><button class='righted'>Edit</button>";
		} else if($checker="set") {
			$ctr = 0;
			foreach ($metric as $metric_item): 
		
				 
				 foreach ($subkpi as $subkpi_item): 
						 
							if($subkpi_item['kpi_id']==$metric_item['kpi_id'])
							 {
								foreach ($kpi as $kpi_item):
									if($kpi_item['kpi_id']==$subkpi_item['parent_kpi'])
									{
										$parent = $kpi_item['kpi_name'];
									}
								endforeach;
								
								if($ctr==0)
								{
									$url1 = str_replace(" ", "_", $parent);
									$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
									$path = $url1."/".$url2;
									echo "<h2>".$parent." > ".$subkpi_item['kpi_name']."</h2>
										  <table><tr>
											<th>Metric Name</th>
											<th>Target</th>
										  </tr>";
									echo "<form method='post' action='save'>";
									$ctr = 1;
								}
					         }
							
				 endforeach;
				 
				 echo "<tr>
						<td>".$metric_item['field_name']."</td>
						<td><input type='number'  min='0' value='".$metric_item['target']."' name='target[]'></input>
							<input type='hidden' value='".$metric_item['field_id']."' name='id[]'></input></td>
					  </tr>";
				 
			endforeach;
				
				echo "</table>";
				echo "<button class='righted'>Save</button></form>";
		
		}
	?>
	
</div>