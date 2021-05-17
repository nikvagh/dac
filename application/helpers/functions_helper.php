<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('checklogin'))
{
	/**
	 * Element
	 *
	 * Lets you determine whether an array index is set and whether it has a value.
	 * If the element is empty it returns NULL (or whatever you specify as the default value.)
	 *
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function checkLogin($userType="")
	{
		// echo "<pre>";
		// print_r($_SESSION);
		// echo "<pre>";
		// exit;

		$err = "N";
		if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != ""){
			if($_SESSION['user_type'] != $userType){
				$err = "Y";	
			}
		}else{
			$err = "Y";	
		}

		if($err == 'Y'){
			if($userType == 'member'){
				header('Location:'.base_url().MEMBER.'login');
			}elseif($userType == 'admin'){
				// header('Location:'.base_url().ADMINPATH.'login');
				header('Location:'.base_url().ADMIN.'login');
			}elseif($userType == 'sp'){
				header('Location:'.base_url().SPPATH.'login');
			}else{
				header('Location:'.base_url().MEMBERPATH.'login');
			}
		}
	}
}

if (!function_exists('curr_date')){
	function curr_date(){
		return date('Y-m-d');
	}
}

if (!function_exists('curr_dateTime')){
	function curr_dateTime(){
		return date('Y-m-d H:i:s');
	}
}

if ( ! function_exists('destroy_login_session')){
	function destroy_login_session(){
		echo "<pre>";
		print_r($_SESSION);
		echo "<pre>";
		exit;

	}
}

if ( ! function_exists('get_last_30_yr')){
	function get_last_30_yr(){
		$year = array();
		for($i = 29; $i > -1; $i--){
			$year[] = date("Y", strtotime("-$i years"));
		}
		rsort($year);

		// echo "<pre>";
		// print_r($year);
		// exit;
		return $year;
	}
}

if ( ! function_exists('request_location')){
	function request_location(){
		return $request_location = array(
			'Parking Lot',
			'Driveway',
			'Street',
			'Home Garage',
			'Parking Garage'
		);
	}
}

if ( ! function_exists('notification_preference_list')){
	function notification_preference_list(){
		return array(
			'Text',
			'Call',
			'Email'
		);
	}
}

if ( ! function_exists('random_str')){
	function random_str($n) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 

		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 

		return $randomString; 
	} 
}

if (!function_exists('check_for_credit')){
	function check_for_credit(){
		$valid = "N";
		if($_SESSION['loginData']->refer_valid_paid == 'Y'){
			$valid = "Y";
		}
		
		if($valid == "Y"){
			return true;
		}else{
			return false;
		}
	}
}

if (!function_exists('update_member_login_array')){
	function update_member_login_array() { 
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->where('member_id',$_SESSION['loginData']->member_id);	
		$query = $ci->db->get('member');
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$_SESSION['loginData'] = (object) $result;
		}
	}
}

if (!function_exists('package_validity_converter')){
	function package_validity_converter($validity_str) {
		$txt = "";
		$year_s = $month_s = $day_s = '';
		$total_days = $year = $month = $day = 0;
		if($validity_str != ""){

			$validity_ary = explode(':',$validity_str);
			$year = $validity_ary[0];

			if(array_key_exists('1',$validity_ary)){
				$month = $validity_ary[1];
			}

			if(array_key_exists('2',$validity_ary)){
				$day = $validity_ary[2];
			}

			if($day > 360){
				// echo "ggg";
				$day_eq = $day/360;
				$year_to_add = floor($day_eq);
				$year += $year_to_add;
				$day = fmod($day, 360);
			}

			if($day > 30){
				// echo "nnn";
				$day_eq = $day/30;
				$month_to_add = floor($day_eq);
				$month += $month_to_add;
				$day = fmod($day, 30);
			}

			if($month > 12){
				$month_eq = $month/12;
				$year_to_add = floor($month_eq);
				$year += $year_to_add;
				$month = fmod($month, 12);
			}

			// echo "kkkk".$year."k";
			// exit;

			if($year > 1){ $year_s = 's'; }
			$txt .= $year.' Year'.$year_s;

			// if(array_key_exists('1',$validity_ary)){
			if($month > 0){
				if($month > 1){ $month_s = 's'; }
				$txt .= ' '.$month.' Month'.$month_s;
			}

			// if(array_key_exists('2',$validity_ary)){
			if($day > 0){
				if($day > 1){ $day_s = 's'; }
				$txt .= ' '.$day.' Day'.$day_s;
			}

			$total_days = ($year*360)+($month*30)+$day;

		}

		$result['year'] = $year;
		$result['month'] = $month;
		$result['day'] = $day;
		$result['total_days'] = $total_days;
		$result['txt'] = $txt;
		return $result;
	}
}

if (!function_exists('get_membership_validity_status')){
	function get_membership_validity_status($startDate,$endDate) {
		$validity_status = '';
		if($startDate <= curr_date() && $endDate >= curr_date()){
			$validity_status = "Ongoing";
		}elseif($startDate > curr_date() ){
			$validity_status = "Pending";
		}elseif($endDate < curr_date() ){
			$validity_status = "Expired";
		}
		return $validity_status;
	}
}
