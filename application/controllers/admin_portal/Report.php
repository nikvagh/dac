<?php
    class Report extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'report_model','report');
            $this->load->library('upload');
            checkLogin('admin');
        }

        function index(){
            $data['serviceprovider_manage'] = TRUE;
            $data['title']="Reports";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->sprovider->st_update()) {
                    $this->session->set_flashdata('success', 'Service Provider status has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->sprovider->delete()) {
                    $this->session->set_flashdata('success', 'Service Provider deleted successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            // $data['manage_data'] = $this->sprovider->get_sps();
            $this->load->view(ADMINPATH.'report/list',$data);
        }

        function add(){ 
            $data['sp_form'] = TRUE;
            $data['action']='add';
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();
            
            
            if(isset($_POST['submit'])){
                if ($this->sprovider->insert()) {
                    $this->session->set_flashdata('success', 'Service Provider information has been insert successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('sp');
            }else{
                $this->load->view(ADMINPATH.'sp/add',$data); 
            }
        }

        function edit($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();

            $data['vehicle_selected'] = $this->sprovider->get_selected_vehicles($id);
            $data['industry_reference_seleted'] = $this->sprovider->get_selected_industry_reference($id);
            $data['employee_seleted'] = $this->sprovider->get_selected_employee($id);
            $data['certificate_seleted'] = $this->sprovider->get_selected_certificate($id);
            
            if(isset($_POST['submit'])){
                if ($result = $this->sprovider->update()) {
                    $this->session->set_flashdata('success','Service Provider information has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->sprovider->getDataById($id);
                $this->load->view(ADMINPATH.'sp/edit',$data); 
            }
        }

        function view($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();

            $data['vehicle_selected'] = $this->sprovider->get_selected_vehicles($id);
            $data['industry_reference_seleted'] = $this->sprovider->get_selected_industry_reference($id);
            $data['employee_seleted'] = $this->sprovider->get_selected_employee($id);
            $data['certificate_seleted'] = $this->sprovider->get_selected_certificate($id);
            
            if(isset($_POST['submit'])){
                if ($result = $this->sprovider->update()) {
                    $this->session->set_flashdata('success','Service Provider information has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->sprovider->getDataById($id);
                $this->load->view(ADMINPATH.'sp/view',$data); 
            }
        }

        function membership(){
            include('./PHPExcel/PHPExcel.php');

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Create a first sheet, representing sales data
            $objPHPExcel->setActiveSheetIndex(0);
            // Rename sheet
            $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

            $this->db->select('m2m.membership_to_member_id,p.package_name,m.firstname,m.lastname');
            $this->db->join('package p','p.package_id = m2m.package_id','left');
            $this->db->join('member m','m.member_id = m2m.member_id','left');

            // if(isset($_SESSION['report']['filter_date_start']) && $_SESSION['report']['filter_date_start'] != ""){
            //     $startDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_start']));
            //     $this->db->where('DATE(b.created_at) >= "'.$startDate.'"');
            // }
            // if(isset($_SESSION['report']['filter_date_end']) && $_SESSION['report']['filter_date_end'] != ""){
            //     $endDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_end']));
            //     $this->db->where('DATE(b.created_at) <= "'.$endDate.'"');
            // }

            $this->db->from('membership_to_member m2m');
            $query = $this->db->get();
            $result = $query->result_array();

            $rowSheet1 = 1;$colSheet1 = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Id');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Package');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Member Name');
            $colSheet1++;

            foreach($result as $val){
                $rowSheet1++;$colSheet1 = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['membership_to_member_id']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['package_name']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['firstname'].' '.$val['lastname']);
            }
            
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detailed_Budget_And_Summary.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }

        function service(){
            include('./PHPExcel/PHPExcel.php');

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Create a first sheet, representing sales data
            $objPHPExcel->setActiveSheetIndex(0);
            // Rename sheet
            $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

            $this->db->select('jr.location,jr.created_at,sp.company_name,m.firstname,m.lastname');
            $this->db->join('sp','sp.sp_id = jr.sp_id','left');
            $this->db->join('member m','m.member_id = jr.member_id','left');

            // if(isset($_SESSION['report']['filter_date_start']) && $_SESSION['report']['filter_date_start'] != ""){
            //     $startDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_start']));
            //     $this->db->where('DATE(jr.created_at) >= "'.$startDate.'"');
            // }
            // if(isset($_SESSION['report']['filter_date_end']) && $_SESSION['report']['filter_date_end'] != ""){
            //     $endDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_end']));
            //     $this->db->where('DATE(jr.created_at) <= "'.$endDate.'"');
            // }

            $this->db->where('jr.sp_id !=',0);
            $this->db->from('job_request jr');
            $query = $this->db->get();
            $result = $query->result_array();
            
            $rowSheet1 = 1;$colSheet1 = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Location');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Service Provider');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Member Name');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Date');

            foreach($result as $val){
                $rowSheet1++;$colSheet1 = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['location']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['company_name']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['firstname'].' '.$val['lastname']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['created_at']);
            }
            
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detailed_Budget_And_Summary.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }

        function service_payment(){
            include('./PHPExcel/PHPExcel.php');

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Create a first sheet, representing sales data
            $objPHPExcel->setActiveSheetIndex(0);
            // Rename sheet
            $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');

            $this->db->select('spay.service_payment_id,spay.payeble_amount,spay.created_at,m.firstname,m.lastname');
            // $this->db->join('sp','sp.sp_id = jr.sp_id','left');
            $this->db->join('member m','m.member_id = spay.member_id','left');

            // if(isset($_SESSION['report']['filter_date_start']) && $_SESSION['report']['filter_date_start'] != ""){
            //     $startDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_start']));
            //     $this->db->where('DATE(spay.created_at) >= "'.$startDate.'"');
            // }
            // if(isset($_SESSION['report']['filter_date_end']) && $_SESSION['report']['filter_date_end'] != ""){
            //     $endDate = date('Y-m-d',strtotime($_SESSION['report']['filter_date_end']));
            //     $this->db->where('DATE(spay.created_at) <= "'.$endDate.'"');
            // }

            $this->db->from('service_payment spay');
            $query = $this->db->get();
            $result = $query->result_array();
            
            $rowSheet1 = 1;$colSheet1 = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Id');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Payment');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Member');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Created At');

            foreach($result as $val){
                $rowSheet1++;$colSheet1 = 0;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['service_payment_id']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['payeble_amount']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['firstname'].' '.$val['lastname']);
                $colSheet1++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,$val['created_at']);
            }
            
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detailed_Budget_And_Summary.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }

        function filter(){
            // echo "<pre>";
            // print_r($_POST);

            if($_POST['submit'] == 'Apply'){
                $_SESSION['report']['filter_date_start'] = $_POST['filter_date_start'];
                $_SESSION['report']['filter_date_end'] = $_POST['filter_date_end'];
            }else if($_POST['submit'] == 'Reset'){
                unset($_SESSION['report']);
            }

            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            // exit;

            redirect(ADMINPATH.'report');
        }

        function exportXLS(){
            
            // creating xls
            // $this->load->library('PHPExcel');

            include('./PHPExcel/PHPExcel.php');
    
            // require_once 'PHPExcel.php';
            // require_once 'PHPExcel/IOFactory.php';
            // exit;
    
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
    
            // Create a first sheet, representing sales data
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Rename sheet
            $objPHPExcel->getActiveSheet()->setTitle('Detailed Budget');
    
            //budget detail
            $rowSheet1 = 1;$colSheet1 = 0;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'Client code');
            $colSheet1++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,'sdfdfdfdfd');
    
            // $totalHours = 0;$totalCost = 0;
            // foreach($budgetData as $bData){
            //     $totalHours += $bData->totalHours;
            //     $totalCost += $bData->totalCost;
    
            //     $rowSheet1++;$colSheet1 = 0;
            //     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,"kkkkkkk");
            //     $colSheet1++;
            //     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,"lllllll");
            //     $colSheet1++;
            //     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,"jjjjjjj");
            //     $colSheet1++;
            // }
    
            $rowSheet1+=2;$colSheet1 = 4;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,"uuuuuuuu");
            $colSheet1+=2;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colSheet1,$rowSheet1,"DDDDDDDD");
            
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Detailed_Budget_And_Summary.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }


    }
?>