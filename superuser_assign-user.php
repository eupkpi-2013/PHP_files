<?php 

class User extends CI_Controller {

  public function __construct()
	{
		parent::__construct();
		$this->load->model('user_db');
		$this->load->helper('url');	
	}

	public function viewmetric()
	{
		$q = $_GET['q'];
		$current_kpi = str_replace("_", " ", strtok($q, "/"));
		$current_subkpi = str_replace("_", " ", strtok("/"));

		$data['kpi'] = $this->user_db->sidebar();
		$data['subkpi'] = $this->user_db->subsidebar();

		$data['current_kpi'] = $current_kpi;
		$data['current_subkpi'] = $current_subkpi;

		$data['metric'] = $this->user_db->query_metric($current_subkpi);
		$data['checker'] = "notempty";

		$next = false;

		for ($i = 0; $i < count($data['kpi']); $i++) {
			if ($current_kpi === $data['kpi'][$i]['kpi_name'] || $next) {
				$childkpi = $this->user_db->gen_query('kpi_name','kpi','parent_kpi='.$data['kpi'][$i]['kpi_id']);
				for ($j = 0; $j < $childkpi->num_rows; $j++) {
					if ($next) {
						$data['next'] = str_replace(" ", "_", $data['kpi'][$i]['kpi_name'])."/".str_replace(" ", "_", $childkpi->result_array()[$j]['kpi_name']);
						$next = false;
						break;
					}
					if ($current_subkpi === $childkpi->result_array()[$j]['kpi_name'])
						$next=true;
				}
			}
		}
	}

	public function viewedit()
	{
		$q = $_GET['q'];
		$data['kpi'] = $this->user_db->sidebar();
		$data['subkpi'] = $this->user_db->subsidebar();
		$data['metric'] = $this->user_db->query_metric($q);
		$data['checker'] = "notempty";
		
			$this->load->view('kpi/header');
			$this->load->view('kpi/banner');
			$this->load->view('kpi/navbar_superuser');
			$this->load->view('kpi/superuser_edit',$data);
			$this->load->view('kpi/footer');
	}

	// Assign ISCU to Metrics
	function assignISCU() {
		$this->load->model('user_db');
		$result = $this->user_db->assignISCU();
		
		$location = 'location:'.site_url('superuser_assign').'';
		header($location);		
	}

	public function view($page)
	{	
		$iscu_id = 1001;
		
			$data['kpi'] = $this->user_db->sidebar();
			$data['subkpi'] = $this->user_db->subsidebar();
			
			// Assign ISCU to Metrics
			$data['metric'] = $this->user_db->allmetric();
			$data['iscu'] = $this->user_db->iscu_sidebar();
			$data['checker'] = "empty";
		
			$user = strtok($page, "_");
	
			$this->load->view('kpi/header');
			$this->load->view('kpi/banner');
			$this->load->view('kpi/navbar_superuser');
			$this->load->view('kpi/'.$page,$data);
			$this->load->view('kpi/footer');
	}	
}

?>
