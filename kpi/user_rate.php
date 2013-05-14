<?php
	echo "<script type='text/javascript'>";
	foreach ($metric as $metric_item): 
		echo "$(document).ready(function(){


			   $('#metric".$metric_item['field_id']."-viewprev-button').click(function(){
			   $('.metric".$metric_item['field_id']."-prev').toggle();});
			   
			   });";
	endforeach; 
	echo "</script>";
?>

<div id="user-contents" class="contents">	
	<div id="user-kpimenu" class="accordion lefted">
		<?php foreach ($kpi as $kpi_item): 
			 echo "<div><h3>".$kpi_item['kpi_name']."</h3><ul>";
				 foreach ($subkpi as $subkpi_item): 
					
						if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
						{
							$url1 = str_replace(" ", "_", $kpi_item['kpi_name']);
							$url2 = str_replace(" ", "_", $subkpi_item['kpi_name']);
							echo "<div><li><a href='rate?q=".$url1."/".$url2."'>".$subkpi_item['kpi_name']."</a></div></li>"; 
						}
					
				 endforeach; 
			 echo "</ul></div>";
		      endforeach; 
		?>
	</div>	
	
	
	<div id="user-inside" class="lefted">
		<table>
		<?php		
			if($checker!='empty'):
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
									echo "<h2>".$parent." > ".$subkpi_item['kpi_name']."</h2>";
									$ctr = 1;
								}
							
					         }
					
				 endforeach; 
				
				
					echo "<tr><td>".$metric_item['field_name']."<td><td><input type='text'></input></td><td>
					      <button id='metric".$metric_item['field_id']."-viewprev-button'>View Previous Ratings</button></td></tr>
						  <tr class='hidden metric".$metric_item['field_id']."-prev'><td>Baseline</td><td>500</td></tr>
						  <tr class='hidden metric".$metric_item['field_id']."-prev'><td>Target</td>
						  <td>200</td></tr><tr class='hidden metric".$metric_item['field_id']."-prev'><td>Migration</td><td>500</td></tr>";
				
			     endforeach;		
		
			else:
				echo "<h2>eUP KPI: After 2 months</h2><p>Choose a KPI on the left.</p><br><button>View your previous ratings</button>";
		
		
		    endif; ?>
		</table>
		<?php
			if($checker!='empty'): 
				echo "<a href='user_rate_kpi1-3.html'><button class='righted'>Next</button>";
		
		 endif; ?>
		
	</div>
</div>

<!--javascripts-->
<script>


</script>

