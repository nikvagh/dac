<?php
	class Refer extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('CustomerModel','Customer');
			$this->load->library('mail');
			checkLogin('member');
		}

		function index()
		{
			$content['title'] = "Refer Friend";
			$views["content"] = ["path"=>MEMBER.'refer_friend',"data"=>$content];
            $layout['page'] = 'refer_friend';
            $this->layouts->view($views,'member_dashboard',$layout);
		}

		function validation()
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
		}

		function email_invoice($id = 0){
            $this->load->library('Pdf_Generate');
            $dataPdf['form_data'] = $this->job->getDataById_invoice($id);
            $dataPdf['services'] = $this->job->job_request_service($id);
            $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);

            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);
            $html = $this->load->view(ADMINPATH.'job/invoice_pdf',$dataPdf,TRUE);

            $pdf = array(
                "html" => $html,
                "title" => 'invoice',
                "author" => 'invoice',
                "creator" => 'invoice',
                "filename" => 'invoice_'.$invoice_number. '.pdf',
                "badge" => FALSE,
                "attach" => TRUE,
                "attachpath" => INVOICE_PATH
            );

            $pdf = $this->pdf_generate->create_pdf($pdf);
            $pdf_file = INVOICE_PATH.$pdf;
            // ===================

            $this->load->library('mail');
            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);
            $subject = "Invoice - ".$invoice_number;
            $message = "Thanks For joining toghather with Drip Auto Care.";

            if($this->mail->send_email($dataPdf['form_data']['email'],$subject,$message,$pdf_file)){
                $this->session->set_flashdata('success','Email Send Successfully.');
                redirect(ADMINPATH.'job');
            }else{
                $this->session->set_flashdata('error','Something Wrong. Email Not Sent.');
                redirect(ADMINPATH.'job');
            }
        }

		function sendMail()
		{
			// $dataHtml = [];
			$dataHtml['name'] = $this->member->loginData->firstname.' '.$this->member->loginData->lastname;
			$dataHtml['logo'] = base_url(SYSTEM_IMG).$this->system->company_logo;
			$dataHtml['link'] = $this->input->post('link');
			$html = $this->load->view('mail/refer',$dataHtml,TRUE);

			// echo $html;exit;
			$subject = "Drip Auto Care - Invitation";
			if ($this->mail->send_email($this->input->post('email'),$subject,$html)){
				// echo "<pre>"; print_r($_POST); exit;
				$this->session->set_flashdata('success', 'Email sent successfully.');
				echo json_encode(['status'=>200]);
			}
		}

	}
?>