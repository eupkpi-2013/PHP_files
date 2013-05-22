<div id="user-contents" class="contents">	
	<div id="user-kpimenu" class="accordion menu lefted">
		<?php
		foreach ($kpi as $kpi_item): 
			echo "<div><h3>".$kpi_item['kpi_name']."</h3><ul class='accordion-list'>";
				foreach ($subkpi as $subkpi_item): 
					
					if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
					{
						$url1 = str_replace(" ", "_", $kpi_item['kpi_name']);
						$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
						echo "<div><li><a href='edit?q=".$url1."/".$url2."'>".$subkpi_item['kpi_name']."</a></li></div>"; 
					}
				
				endforeach; 
			echo "<div><li><a href='superuser_addsubkpi?id=".$kpi_item['kpi_id']."'><button>Add SubKPI</button></a></li></div>";
			echo "</ul></div>";
		endforeach; 
		?>
	</div>
	<div id="user-inside" class="inside">
		<?php
			if($checker=='notempty'):
				//print_r("<pre>"); print_r($submetric); print_r("</pre>");
				
				echo '<h2>'.$current_kpi.' > '.$current_subkpi.'</h2>';
				echo '<table class="kpitable">
					  <tr>
						<th>Metric Name</th>
						<th>Data Type</th>
						<th>Status</th>
					  </tr>';
				foreach ($metric as $metric_item):
					echo '<tr><td>'.$metric_item['field_name'].'</td><td>Text</td><td>'.($metric_item['active'] ? 'Active' : 'Inactive').'</td></tr>';
					if ( $metric_item['has_breakdown'] ):
						echo '<table class="submetrictable">
								<tr>
								<th>SubMetric Name</th>
								<th>Data Type</th>
								<th>Status</th>
								</tr>';
						foreach ($submetric as $submetric_item):
							if ( $submetric_item['field_id']==$metric_item['field_id'] ):
								echo '<tr><td>'.$submetric_item['breakdown_name'].'</td><td>Text</td><td>'.($submetric_item['active'] ? 'Active' : 'Inactive').'</td></tr>';
							endif;
						endforeach;
						echo '</table>';
					endif;
				endforeach;
				echo '</table>';
				
				echo '<a href="editvalue?q='.str_replace(" ", "_", $current_kpi).'/'.str_replace(" ", "_", $current_subkpi).'"><button class="righted">Edit</button></a>';
			
			elseif($checker=='editing'):
				
				echo "<h2>".$kpi_value_id['kpi_name']." > ".$subkpi_value_id['kpi_name']."</h2>";
				echo "<form method='post' action='changevalue'><table>";
				echo "<tr><td><label>KPI Name</label><input value='".$kpi_value_id['kpi_name']."' name='kpi'></input><input type='hidden' value='".$kpi_value_id['kpi_id']."' name='kpi_id'></input></td>";
				
				if ($kpi_value_id['active']) echo "<td><a href='deactivate?q=1/".$kpi_value_id['kpi_id']."'><button type='button'>Deactivate</button></a></td>";
				
				echo "</tr>";
				
				echo "<tr><td><label>SubKPI Name</label><input value='".$subkpi_value_id['kpi_name']."' name='subkpi'></input><input type='hidden' value='".$subkpi_value_id['kpi_id']."' name='subkpi_id'></input></td>";
				
				if ($subkpi_value_id['active']) echo "<td><a href='deactivate?q=2/".$subkpi_value_id['kpi_id']."'><button type='button'>Deactivate</button></a></td>";
				
				echo "</tr>";
				
				echo "</table>";
				echo "<table class='kpitable' id='metric'>
					  <tr><th>Metric Name</th>
					  <th>Data Type</th>
					  <th><button type='button' onClick=addRow('metric')>Add Metric</button></th></tr>";
					foreach($metric as $metric_item2):
						echo "<tr><td><input value='".$metric_item2['field_name']."' name='metric[]'></td><input type='hidden' value='".$metric_item2['field_id']."' name='metric_id[]'></input>";
						echo "<td><select>
								  <option>Text</option>
								  <option>Integer</option>
								  <option>Boolean</option>
								  <option>Time Range</option>
								  </select></td>";
						if ($metric_item2['active']) echo "<td><a href='deactivate?q=3/".$metric_item2['field_id']."'><button type='button'>Deactivate</button></a>
						</td>";
						echo "</tr>";
						if ( $metric_item2['has_breakdown'] ):
							echo "<table class='kpitable' id='submetric'><tr><th>SubMetric Name</th><th>Data Type</th><th><button type='button' onClick=addRow('submetric')>Add SubMetric</button></th></tr>";
							foreach ($submetric as $submetric_item):
								if ( $metric_item2['field_id']==$submetric_item['field_id'] ):
									echo "<tr><td><input value='".$submetric_item['breakdown_name']."' name='submetric[]'></input></td><input type='hidden' value='".$submetric_item['breakdown_id']."' name='submetric_id[]'></input>";
									echo "<td><select>
									<option>Text</option>
									<option>Integer</option>
									<option>Boolean</option>
									<option>Time Range</option></select>
									</td><td>".($submetric_item['active'] ? "<a href='deactivate?q=4/".$submetric_item['breakdown_id']."'><button type='button'>Deactivate</button></a>" : "" )."</td></tr>";
								endif;
							endforeach;
							echo "</table>";
						endif;
					endforeach;
				echo "</table>";
				echo "<button class='righted'>Save</button></form>";
			else:
				echo "<p>Choose a KPI to edit on the left.</p><br>
					  <a href='superuser_addkpi'><button>Add KPI</button></a>";
			endif;
		?>
	</div>
</div>

<script>


// Add Table Row
var currentRowCount=1;
function addRow(tableID) {
 
    var table = document.getElementById(tableID);
 
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
 
    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "text";
	element1.setAttribute("name", tableID+"_name[]");
	cell1.appendChild(element1);
	
	var cell2 = row.insertCell(1);
	var element2 = document.createElement("select");
	
	var choices = new Array();
	choices[0] = "Text";
	choices[1] = "Integer";
	choices[2] = "Boolean";
	choices[3] = "Time Range";
	
	for (var i=0; i<4; i++) {
		var option = document.createElement("option");
		option.text = choices[i];
		option.value = choices[i];
		
		element2.appendChild(option);
	}
	
	cell2.appendChild(element2);
			
	table.rows[0].cells[0].childNodes[0].checked = false;
	currentRowCount++;
}
</script>