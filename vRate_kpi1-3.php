<div id="user-contents" class="contents">	
	<div id="user-kpimenu" class="accordion lefted">
		<div><h3>KPI1</h3>
			<ul>
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=1');?>>Sub KPI1</a></li></div>
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=1-2');?>>Sub KPI2</a></li></div>	
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=1-3');?>>Sub KPI3</a></li></div>	
			</ul>
		</div>
		<div><h3>KPI2</h3>
			<ul>
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=2');?>>Sub KPI1</a></li></div>	
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=2-2');?>>Sub KPI2</a></li></div>	
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=2-3');?>>Sub KPI3</a></li></div>	
			</ul>
		</div>
		<div><h3>KPI3</h3>
			<ul>
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=3');?>>Sub KPI1</a></li></div>	
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=3-2');?>> Sub KPI2</a></li></div>	
			<div><li><a href=<?php echo site_url('index.php/Rate/kpi?q=3-3');?>>Sub KPI3</a></li></div>	
			</ul>
		</div>
	</div>
	<div id="user-inside" class="lefted">
		<h2>KPI1 > Sub KPI3</h2>
		<table>
		<tr>
			<td>Metric1</td>
			<td><input type="text"></input></td>
		</tr>
		<tr>
			<td>Metric2</td>
			<td><input type="text"></input></td>
		</tr>
		<tr>
			<td>Metric3</td>
			<td><input type="text"></input></td>
		</tr>
		</table>
		<a href=<?php echo site_url('index.php/Rate/kpi?q=2');?>><button class="righted">Next</button>
	</div>
</div>