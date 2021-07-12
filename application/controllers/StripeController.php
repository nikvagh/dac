<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StripeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
        $this->load->model('CustomerMembershipModel','CustomerMembership');
        $this->load->model('AppointmentModel','Appointment');
    }

    public function index()
    {
        $this->load->view('my_stripe');
    }

    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        $result = \Stripe\Charge::create([
            "amount" => 200 * 100,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        // echo "<pre>";
        // print_r($result);
        // exit;

        $this->session->set_flashdata('success', 'Payment made successfully.');

        // redirect('/my-stripe', 'refresh');
        redirect('/', 'refresh');
    }


    public function membershipStripePayment()
    {
        $saveData = $this->session->userdata('membershipCreateData');
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $amount = $saveData['total_payable'] * 100;
        $amount = round($amount);
        // number_format((float)$amount, 2, '.', '');

        $result = \Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Membership Purchased"
        ]);

        // echo "<pre>";
        // print_r($result);
        // exit;
        if ($this->CustomerMembership->purchaseFromCustomer($result)) {
            $this->session->set_flashdata('success','Membership purchased successfully');
            redirect('memberAccount');
        }

        // // redirect('/my-stripe', 'refresh');
        // redirect('/', 'refresh');
    }

    public function membershipUpgradeStripePayment()
    {
        $saveData = $this->session->userdata('membershipUpgradeData');
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $amount = $saveData['total_payable'] * 100;
        $amount = round($amount);
        // number_format((float)$amount, 2, '.', '');

        $result = \Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Membership Upgrade"
        ]);

        // echo "<pre>";
        // print_r($result);
        // exit;
        if ($this->CustomerMembership->upgradeFromCustomer($result)) {
            $this->session->set_flashdata('success','Membership upgrade successfully');
            redirect('memberAccount');
        }

        // // redirect('/my-stripe', 'refresh');
        // redirect('/', 'refresh');
    }

    public function bookingStripePayment()
    {
        $saveData = $this->session->userdata('bookingCreateData');
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        $amount = $saveData['total_payable'] * 100;
        $amount = round($amount);
        // number_format((float)$amount, 2, '.', '');

        $result = \Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Service Booking"
        ]);

        // echo "<pre>";
        // print_r($result);
        // exit;
        if ($this->Appointment->bookNowSaveAfterPayment($result)) {
            $this->session->set_flashdata('success','Service booked successfully');
            redirect('memberAccount');
        }

        // // redirect('/my-stripe', 'refresh');
        // redirect('/', 'refresh');
    }

}
