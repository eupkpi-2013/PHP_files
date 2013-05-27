<script>
	function buttoncheck(button_id)
	{
		$("#buttoncheck_id").val(button_id);
		$("#verifyform").attr('action', 'select');
		$("#verifyform").submit();
	}
</script>

<div id="user-contents" class="contents">	
	
	<div id="user-kpimenu" class="accordion menu lefted">
	<?php foreach ($userid as $userid_item): 
				echo "<div><a href='verify?q=auditor_verify_".$userid_item['user_id']."'><h3>".$userid_item['user_id']."</h3></a></div>";  
		  endforeach; ?>
	</div>
	
	<div id="user-inside" class="inside">
		<form method="post" id="verifyform" action="">
		<?php 
			if($checker!='empty'):
				echo "<form method='post' id='verifyform' action=''>";
				foreach ($kpi as $kpi_item):
					echo "<div class='ratingsdiv'> <h3>".$kpi_item['kpi_name']."</h3>";
						foreach ($subkpi as $subkpi_item):
							if($subkpi_item['parent_kpi']==$kpi_item['kpi_id'])
							{
								echo "<div>".$subkpi_item['kpi_name']."<table>";
									$ctr = 0;
									foreach ($metric as $metric_item):
										if($metric_item['kpi_id']==$subkpi_item['kpi_id'])
										{
											echo "<tr>";
											echo "<td>".$metric_item['field_name']."</td>";
											
											if($user_id==$metric_item['user_id'])
											{
													
												if($subchecker=='uneditable')	
												{
													echo "<td>".$metric_item['value']."</td>";
												    echo "<td><input type='checkbox' value='".$metric_item['field_id']."/".$metric_item['value']."' name='valueselected[]'></td>";	
												} else
												{
													$exist = 0;
													foreach($editvalues as $editvalues_item):
														if($editvalues_item['field_id']==$metric_item['field_id'])
														{
															echo "<td><input type='text' name='edited[]' value='".$metric_item['value']."'><input type='hidden' name='edited_id[]' value='".$metric_item['field_id']."'></td>";
															echo "<td><input type='checkbox' checked></td>";
															$exist = 1;
														}
													endforeach;
													
													if($exist==0)
													{
														echo "<td>".$metric_item['value']."</td>";
												        echo "<td><input type='checkbox' value='".$metric_item['field_id']."/".$metric_item['value']."' name='valueselected[]'></td>";

													}
												}
												
											}
											echo "<tr>";
										}
									$ctr++;
									endforeach;
								echo "</table></div>";
							}
						endforeach;
					echo "</div>";
				endforeach;
				echo "<input type='hidden' name='user_id' value='".$user_id."'>";
				
					if($subchecker=='uneditable'):
			?>
					<input type="hidden" id="buttoncheck_id" name="buttoncheck_name" value="">
					<button class="righted" type="button" onclick="buttoncheck(1)">Edit Selected</button>
					<button class="righted" type="button" onclick="buttoncheck(2)">Reject Selected</button>
					<button class="righted" type="button" onclick="buttoncheck(3)">Approve All</button>
			<?php
					else:
			?>
					<input type="hidden" id="buttoncheck_id" name="buttoncheck_name" value="">
					<button class="righted" type="button" onclick="buttoncheck(4)">OK</button>
			<?php
					endif;
			?>
			</form>
			<?php
			else:
				echo "<h2>eUP KPI: After 2 months</h2><p>Choose a User on the left.</p><br>";
		
		    endif;
		    ?>
	</div>
</div>