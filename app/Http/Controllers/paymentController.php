<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Applications;

use App\Loan;
use App\Payments;
use App\obtainloans;
use App\farmersdetails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class paymentController extends Controller
{
	
  	
	 public function showpayments($nic)
    {
    //  $user=Applications::where('loan_id', $loan_id)->join('farmersdetails',
      // 'nic','applications.nic')
       //->select('nameini','date')->get();
	   
       $user = obtainloans::join('applications', 'id', '=', 'obtainloans.application_id')
       ->join('loans','loans.loan_id','=','obtainloans.loan_id')
      ->where('applications.nic', '=',$nic)
      ->select('*')
     ->get();

	
       if ($user) {
        $res['status'] = true;
        $res['message'] = $user;
        
        return response($res);
        }
		else{
           $res['status'] = false;
           $res['message'] = 'Cannot find applicants!';

         return response($res);
        }
		
  }

  public function showpaymentdetails($obtain_id)
    {
    //  $user=Applications::where('loan_id', $loan_id)->join('farmersdetails',
      // 'nic','applications.nic')
       //->select('nameini','date')->get();
	   
       $user = Payments::where('obtain_id', '=',$obtain_id)
      ->select('*')
      ->orderBy('Installment_date', 'desc')
     ->get();

	
       if ($user) {
        $res['status'] = true;
        $res['message'] = $user;
        
        return response($res);
        }
		else{
           $res['status'] = false;
           $res['message'] = 'Cannot find applicants!';

         return response($res);
        }

    } 

        public function showpaymentdetailslatest($obtain_id)
        {
        

      $us = Payments::where('obtain_id', '=',$obtain_id)
                      ->select('payments.rating_no')
                      ->orderBy('Installment_date', 'desc')
                      ->take(2);
                   
                      
        //->select('*');
    
    
       if ($us) {
        $res['status'] = true;
        $res['message'] = $us;
        
        return response($res);
        }
		else{
           $res['status'] = false;
           $res['message'] = 'Cannot find applicants!';

         return response($res);
        }
		
  }


  public function getobtain($nic){
      
    $user = Applications::join('obtainloans', 'obtainloans.application_id', '=', 'applications.id')
    ->join('farmersdetails', 'farmersdetails.nic', '=', 'applications.nic')
    ->join('loans', 'loans.loan_id', '=', 'applications.loan_id')
    ->where('farmersdetails.nic', '=',$nic)
    ->select('*')
    ->get();


    

       if ($user) {
        $res['status'] = true;
        $res['message'] = $user;

        return response($res);
        }
        else{
           $res['status'] = false;
           $res['message'] = 'Cannot find applicant!';

         return response($res);
        }



 }

 public function getobtainbyid($obtain_id){
      
  $user = Applications::join('obtainloans', 'obtainloans.application_id', '=', 'applications.id')
  ->join('farmersdetails', 'farmersdetails.nic', '=', 'applications.nic')
  ->join('loans', 'loans.loan_id', '=', 'applications.loan_id')
  ->where('obtainloans.obtain_id', '=',$obtain_id)
  ->select('*')
  ->get();


  

     if ($user) {
      $res['status'] = true;
      $res['message'] = $user;

      return response($res);
      }
      else{
         $res['status'] = false;
         $res['message'] = 'Cannot find applicant!';

       return response($res);
      }



}




  
 

	
	
	
	

}