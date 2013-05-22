<?php

  Class User_db extends CI_Model {
	
		public function __construct()
		{
			parent::__construct();
			$config['hostname'] = "localhost";
			$config['username'] = "root";
			$config['password'] = "";
			$config['database'] = "testkpi";
			$config['dbdriver'] = "mysql";
			$config['dbprefix'] = "";
			$config['pconnect'] = FALSE;
			$config['db_debug'] = TRUE;
			
			$this->load->database($config);
		}
		
		public function sidebar()
		{
			$query = $this->db->get_where('KPI', array('leaf_node'=> 0));
			return $query->result_array();
		}
		
		public function subsidebar()
		{
			$query = $this->db->get_where('KPI', array('leaf_node'=> 1));
			return $query->result_array();
		}
		
		public function query_metric($q)
		{
			$kpi = strtok($q, "/");
			$subkpi = strtok("/");
			
			$kpi = str_replace("_", " ", $kpi);
			$subkpi = str_replace("_", " ", $subkpi);
		
			$query = $this->db->get_where('KPI', array('kpi_name'=> $subkpi));
			$query_item = $query->row_array();
		
			$query = $this->db->get_where('fields', array('kpi_id'=> $query_item['kpi_id']));
			return $query->result_array();
		}
		
		public function sidebar_verify()
		{
				$query = $this->db->get('updates');
				return $query->result_array();
		}
		
		public function update_value($q)
		{
			$trash = strtok($q ,"_");
			$trash = strtok("_");
			$userid = strtok("_");
			
			$query = $this->db->get_where('updates', array('account_id'=> $userid));
			return $query->result_array();
		}
		
		public function verify_value($q)
		{
			$trash = strtok($q ,"_");
			$trash = strtok("_");
			$userid = strtok("_");
			
			$query = $this->db->get_where('field_values', array('user_id'=> $userid));
			return $query->result_array();
		}
		
		public function results_value()
		{
			$query = $this->db->get_where('results', array('active'=> 1));
			return $query->result_array();
		}
		
		public function updates($iscu_id)
		{
			$query = $this->db->get_where('updates', array('iscu_id'=> $iscu_id));
			return $query->result_array();
		}
		
		public function javascript()
		{
			$query = $this->db->get('fields');
		}
		
		// Create/Add KPIs/Sub-KPIs/Metrics
		function addKPI() {
			$this->load->database();

			$kpi = $this->input->post("kpi_name");
			$radio = $this->input->post("radio");
			
			$this->db->query("INSERT INTO KPI (kpi_name, project_id, leaf_node) VALUES ('$kpi', '1', '0')");
		}

		function addSubKPI() {
			$this->load->database();

			$subkpi = $this->input->post("subkpi_name");
			$id = $this->input->post("id");
			
			$this->db->query("INSERT INTO KPI (kpi_name, parent_kpi, leaf_node, project_id) VALUES ('$subkpi', '$id', '1', '1')");
		}

		function addMetric() {
			$this->load->database();
       
			$id = $this->input->post("id");

			$metricCount = 0;
			
			while(isset($_POST["metric_name".$metricCount])){
				$metric = $this->input->post("metric_name".$metricCount);
				$this->db->query("INSERT INTO fields (kpi_id, field_name, type, active) VALUES ('$id', '$metric', 'int', '1')");        
				$metricCount++;
			}

			$query = $this->db->query("SELECT parent_kpi FROM KPI WHERE kpi_id='$id'");
			$query = $query->result_array();
			return $query[0];
		}
		
		public function getKpiId($kpi_name){
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM KPI WHERE kpi_name='$kpi_name'");
			$query = $query->result_array();
			return $query[0];
		}
		
		public function getSubKpiId($subkpi_name){
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM KPI WHERE kpi_name='$subkpi_name'");
			$query = $query->result_array();
			return $query[0];
		}
		
		public function getMetricId($metric_name){
			$this->load->database();
			
			$query = $this->db->query("SELECT * FROM KPI WHERE kpi_name='$metric_name'");
			$query = $query->result_array();
			return $query[0];
		}
		
		// Assign ISCU to Metrics
		public function iscu_sidebar()
		{
			$query = $this->db->get_where('ISCU', array('project_id'=> 1));
			return $query->result_array();
		}
		
		public function allmetric()
		{
			$query = $this->db->order_by('field_id', 'asc')->get('fields');
			return $query->result_array();
		}
		
		function assignISCU() {
			$this->load->database();
       
			$kpi = $this->input->post("kpi");
			$subkpi = $this->input->post("subkpi");			
			$metric = $this->input->post("metric");
			
			$iscu = $this->input->post("iscu");
			$query = $this->db->query("SELECT iscu_id FROM iscu WHERE iscu='$iscu'");
			$query = $query->result_array();
			$iscu_id = $query[0]['iscu_id'];
			
			foreach ($metric as $metric_id):
				$this->db->query("INSERT INTO iscu_field (iscu_id, field_id) VALUES ('$iscu_id', '$metric_id')"); 
			endforeach;
		}
	}
?>
