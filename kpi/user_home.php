<div id="user-contents" class="contents">
	<h1>Welcome, User</h1>
	<div>
		<ul>Please rate the following KPIs:
		<?php foreach ($update as $update_item):
				$kpi = strtok($update_item['update_value'], "/");
				$subkpi = strtok("/");
				$kpi = str_replace("_"," ", $kpi);
				$subkpi = str_replace("_"," ", $subkpi);
				
				echo "<li><a href='rate?q=".$update_item['update_value']."'>".$kpi."-".$subkpi."</a></li>";
			  endforeach;
		?>
		</ul>
	</div>
	<div>
		<ul>Recent reports:
		<li><a href="user_results.html">Report1</a></li>
		<li><a href="user_results.html">Report2</a></li>
		<li><a href="user_results.html">Report3</a></li>
		</ul>
	</div>
</div>