<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kalender_transaksi extends CI_Controller {
	
	//ditambahkan 11:05 di kotabumi
	//tambah kalender
	//@adin
	function __construct(){
		parent::__construct();	
		$this->load->library('calendar', $this->_setting());
	}	
	
	function index($year = null, $mon = null){		
		
		//get calender		
		$year = (empty($year) || !is_numeric($year))?  date('Y') :  $year;
		$mon  = (empty($mon) || !is_numeric($mon))?  date('m') :  $mon;
		
		$date = $this->app_model->getCalendar($year, $mon);
		$date_m = array(
			10 => '',
			12 => ''
		);

		@$dateselected = $this->app_model->manualQuery("
			SELECT tgl_cekin,tgl_cekout,id_tamu FROM tbl_transaksi 
			WHERE kode_villa = '{$this->session->userdata('kalender_kode_villa')}'
				AND 
			(
				(MONTH(tgl_cekin) = {$mon} and MONTH(tgl_cekout) = {$mon}+1)
				or
				(MONTH(tgl_cekin) = {$mon} and MONTH(tgl_cekout) = {$mon})
				or
				(MONTH(tgl_cekin) = {$mon}-1 and MONTH(tgl_cekout) = {$mon})
			)
			ORDER BY tgl_cekin ASC
		");
		$datarange = array();
		$i=0;
		foreach ($dateselected->result() as $do):
			$dr = $this->createDateRangeArray($do->tgl_cekin,$do->tgl_cekout,$do->id_tamu);
			$datarange = array_merge($datarange,$dr);
			// echo $do->id_tamu;
		endforeach;
		// echo $do->id_tamu;
		// print_r ($a);
		/*$ = array_merge (
				for ($i=0;$i<$dateselected->num_rows();$i++)
				{
					(${"dr"}[$i]);
				}
		);*/
			// echo $dateselected->num_rows();
			// echo $datarange[0];
			// print_r ($datarange);
			// print_r ($dr[1]);
		
		//PISAHKAN RANK TANGGAL BEDA BULAN
		$years = Array();
		$months = Array();
		$date_create = array();
		foreach($datarange as $d) {
			list($y,$m) = explode("-",$d);
			$years[$y][] = $d;
			if ($m==$mon):
				$months[$y."-".$m][] = $d;
				$date_create[(int) end(explode('-',$d))] = $this->app_model->getSelectedData('tbl_tamu',array('id_tamu'=>end(explode('_',$d))))->row()->nama_tamu;
			endif;
		}
		// $years = array_values($years);
		// $months = array_values($months);
		// print_r ($date_create);
		// echo $months[0];
		// var_dump($years,$months);
		
		//create date cara normal / biasa
		if (isset($datarange)) :
			// $date_create = array();
			foreach($datarange as $row){
				// $date_create[(int) end(explode('-',$row))] = $row;
			}
			// return $data;
		else:
			// $date_create = array();
		endif;
		
		$data = array(
					'notes' => $this->calendar->generate($year, $mon, $date_create),
					'year'  => $year,
					'mon'   => $mon
				);
		$data['dt_villa'] = $this->app_model->getAllData('tbl_villa');
		$data['interface'] = array('kalender_transaksi');
		$data['template'] = 'satucolumn';
		$data['komponen_top'] = array('navbar','forcelogin');
		$this->load->view('index',$data);
	}
	
	
	// untuk konversi nama bulan
	function _month($mon){
		$mon = (int) $mon;
		switch($mon){
			case 1 : $mon = 'Januari'; Break;
			case 2 : $mon = 'Februari'; Break;
			case 3 : $mon = 'Maret'; Break;
			case 4 : $mon = 'April'; Break;
			case 5 : $mon = 'Mei'; Break;
			case 6 : $mon = 'Juni'; Break;
			case 7 : $mon = 'Juli'; Break;
			case 8 : $mon = 'Agustus'; Break;
			case 9 : $mon = 'September'; Break;
			case 10 : $mon = 'Oktober'; Break;
			case 11 : $mon = 'November'; Break;
			case 12 : $mon = 'Desember'; Break;
		}
		return $mon;
	}
	
	// setting tampilan kalender
	function _setting(){
		return array(
			'start_day' 		=> 'sunday',
			'show_next_prev' 	=> true,
			'next_prev_url' 	=> site_url('kalender_transaksi/index'),
			'month_type'   		=> 'long',
            'day_type'     		=> 'short',
			'template' 			=> '{table_open}<table class="date">{/table_open}
								   {heading_row_start}&nbsp;{/heading_row_start}
								   {heading_previous_cell}<caption><a href="{previous_url}" class="prev_date" title="Previous Month">&lt;&lt;</a>{/heading_previous_cell}
								   {heading_title_cell}{heading}{/heading_title_cell}
								   {heading_next_cell}<a href="{next_url}" class="next_date"  title="Next Month">&gt;&gt;</a></caption>{/heading_next_cell}
								   {heading_row_end}<col class="weekend_sun"><col class="weekday" span="5"><col class="weekend_sat">{/heading_row_end}
								   {week_row_start}<thead><tr>{/week_row_start}
								   {week_day_cell}<th>{week_day}</th>{/week_day_cell}
								   {week_row_end}</tr></thead><tbody>{/week_row_end}
								   {cal_row_start}<tr>{/cal_row_start}
								   {cal_cell_start}<td>{/cal_cell_start}
								   {cal_cell_content}<a class="booked" data-container="body" data-toggle="popover" data-placement="right" data-content="{content}">{day}</a>{/cal_cell_content} 
								   {cal_cell_no_content_today}{day}<br/><span class="label label-info">TODAY</span>{/cal_cell_no_content_today}
								   {cal_cell_blank}&nbsp;{/cal_cell_blank}
								   {cal_cell_end}</td>{/cal_cell_end}
								   {cal_row_end}</tr>{/cal_row_end}								   
								   {table_close}</tbody></table>{/table_close}								   
								   ');
	}
	

	function notfound()
	{
		ECHO "not found";
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
	function villa_sess($kode_villa)
	{
		$sess_array = array(
			'kalender_kode_villa' => $kode_villa
		);
		$this->session->set_userdata($sess_array);
		// echo $this->session->userdata('kalender_kode_villa');
	}
}