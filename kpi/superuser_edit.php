<div id="user-contents" class="contents">	
	<div id="user-kpimenu" class="accordion lefted">
		<?php foreach ($kpi as $kpi_item): 
			 echo "<div><h3>".$kpi_item['kpi_name']."</h3><ul>";
				 foreach ($subkpi as $subkpi_item): 
					
						if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
						{
							$url1 = str_replace(" ", "_", $kpi_item['kpi_name']);
							$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
							echo "<div><li><a href='edit?q=".$url1."/".$url2."'>".$subkpi_item['kpi_name']."</a></div></li>"; 
						}
					
				 endforeach; 
			 echo "</ul></div>";
		      endforeach; 
		?>
	</div>
	<div id="user-inside" class="lefted">
		<?php
			if($checker=='notempty'):
				$ctr = 0;
				foreach($metric as $metric_item):
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
									$subparent = $subkpi_item['kpi_name'];
									echo "<h2>".$parent." > ".$subparent."</h2>";
									echo "<table class='kpitable'><tr>
										  <th>Metric Name</th>
										  <th>Data Type</th></tr>";
									$ctr = 1;
								}
							
					         }
					
					endforeach;
									echo "<tr>";
									echo "<td>".$metric_item['field_name']."</td>
										  <td>Text</td>";
									echo "</tr>";
					
				endforeach;
								   echo "</table>";
								   $url1 = str_replace(" ","_", $parent);
								   $url2 = str_replace(" ","_", $subparent);
								   echo "<a href='editvalue?q=".$url1."/".$url2."'><button class='righted'>Edit</button>";
			
			elseif($checker=='editing'):
				$kpi_id = strtok($path, "/");
				$subkpi_id = strtok("/");
				
				$kpi_id = str_replace("_", " ", $kpi_id);
				$subkpi_id = str_replace("_", " ", $subkpi_id);
				
				echo "<h2>".$kpi_id." > ".$subkpi_id."</h2>";
				echo "<form method='post' action='changevalue'><table>";
				echo "<tr><td><label>".$kpi_id."</label><input value='".$kpi_id."' name='kpi'></input><input type='hidden' value='".$kpi_value_id['kpi_id']."' name='kpi_id'></input></td><td><a href='deactivate?q=1/".$kpi_value_id['kpi_id']."'><input type='button'>Deactivate</input></a></td></tr>";
				echo "<tr><td><label>".$subkpi_id."</label><input value='".$subkpi_id."' name='subkpi'></input><input type='hidden' value='".$subkpi_value_id['kpi_id']."' name='subkpi_id'></input></td><td><a href='deactivate?q=2/".$subkpi_value_id['kpi_id']."'><input type='button'>Deactivate</input></a></td></tr>";
				echo "</table><table class='kpitable'>
					  <tr><th>Metric Name</th>
					  <th>Data Type</th></tr>";
						foreach($metric as $metric_item2):
							echo "<tr><td><input value='".$metric_item2['field_name']."' name='metric[]'></td><input type='hidden' value='".$metric_item2['field_id']."' name='metric_id[]'></input>";
							echo "<td><select>
									  <option>Text</option>
									  <option>Integer</option>
									  <option>Boolean</option>
									  <option>Time Range</option>
									  </select></td> 
								  <td><a href='deactivate?q=3/".$metric_item2['field_id']."'><input type='button'>Deactivate</input></a>
								  </td></tr>";
						endforeach;
				echo "</table>";
				echo "<button class='righted'>Save</button></form>";
			else:
				echo "<p>Choose a KPI on the left.</p><br>
					  <button>Add KPI</button>";
			endif;
		?>
	</div>
</div>