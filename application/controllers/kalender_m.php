<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kalender_m extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function bulan($mon,$tahun)
	{
		$data['tahun'] = $tahun;
		$data['mon'] = $mon;
		$data['kal_day']= $this->app_model->getSelectedData('tbl_kalender',array('id'=>$mon));
		$data['villa'] = $this->app_model->getAllData('tbl_villa');
		$data['interface'] = array('kalender_m');
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	
	}
	private function createDateRangeArray($strDateFrom,$strDateTo,$id_tamu)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)."_".$id_tamu); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom)."_".$id_tamu);
			}
		}
		return $aryRange;
	}
}

/* End of file kalender_m.php */
/* Location: ./application/controllers/kalender_m.php */