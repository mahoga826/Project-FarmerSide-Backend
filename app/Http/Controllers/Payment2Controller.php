<?php

namespace App\Http\Controllers;

//Illuminate\Notifications\NotificationServiceProvider::class;

use App\obtainloans;
use App\applications;
use App\Payments;
//use App\banks;
//use App\loans;
use Illuminate\Http\Request;

class Payment2Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getFarmerLoans2(Request $request, $nic, $bank_id){
        /* $details = obtainloans::join('applications', 'applications.id', '=', 'obtainloans.application_id')->join('loans', 'loans.loan_id', '=', 'obtainloans.loan_id')
        ->where('applications.nic', '=', $nic)
        ->where('loans.bank_id', '=', $bank_id)
        ->select('*')
        ->get(); */

        $details = obtainloans::join('applications', 'applications.id', '=', 'obtainloans.application_id')->join('loans', 'loans.loan_id', '=', 'obtainloans.loan_id')->join('banks','banks.bank_id', '=', 'loans.bank_id')
        //->where('applications.nic', '=', $nic) 
        ->where('banks.bank_id', '=', $bank_id)  
        ->get();

        /* $loans = obtainloans::join('loans', 'obtainloans.loan_id', '=', 'loans.loan_id')
        ->where('obtainloans.nic', '=', $nic)
        ->where('loans.bank_id', '=', $bank_id)
        ->get(); */

        if($details){
            $res['status']=true;
            $res['message']=$details;
            return response($res);
        }else{
            $res['status']=false;
            $res['message']='Cannot find applicants!';
            return response($res);
        }
    }

    /* public function getFarmerLoans($nic){
        $details = obtainloans::join('applications', 'applications.id', '=', 'obtainloans.application_id')->join('loans', 'loans.loan_id', '=', 'obtainloans.loan_id')
        ->where('applications.nic', '=', $nic)
        ->get();

        if($details){
            $res['status']=true;
            $res['message']=$details;
            return response($res);
        }else{
            $res['status']=false;
            $res['message']='Cannot find applicants!';
            return response($res);
        }
    } */

    public function getFarmerLoans(Request $request, $nic, $bank_id){
        $rules = [
            'nic' => 'required',
         ];
   
          $customMessages = [
             'required' => ':attribute all need'
         ];

          //$nic = $request->input('nic');
          //$bank_id = $request->input('bank_id');
  
          try {
            /* $details = obtainloans::join('applications', 'applications.id', '=', 'obtainloans.application_id')//->join('loans', 'loans.loan_id', '=', 'obtainloans.loan_id')//->join('banks','banks.bank_id', '=', 'loans.bank_id')
            ->where('applications.nic', '=', $nic)
           
            ->get(); */
            $details = obtainloans::join('applications', 'applications.id', '=', 'obtainloans.application_id')->join('loans', 'loans.loan_id', '=', 'obtainloans.loan_id')->join('banks','banks.bank_id', '=', 'loans.bank_id')
            ->where('applications.nic', '=', $nic) 
            ->where('banks.bank_id', '=', $bank_id)
            ->select('applications.nic', 'obtainloans.amount', 'obtainloans.interest_rate', 'obtainloans.installment', 'obtainloans.total_amount', 'obtainloans.Issued_date', 'obtainloans.no_of_installment', 'obtainloans.obtain_id')  
            ->get();
            
              if ($details) {
                  
                          try {
                              
                                $res['status'] = true;
                                //$res['message'] = 'Valued customer';
                                $res['data'] =  $details;
                                
                                return response($res, 200);
   
   
                          } catch (\Illuminate\Database\QueryException $ex) {
                              $res['status'] = false;
                              $res['message'] = $ex->getMessage();
                              return response($res, 500);
                          }
                    
              } else {
                  $res['success'] = false;
                  $res['message'] = 'Incorrect entry';
                  return response($res, 401);
              }
          } catch (\Illuminate\Database\QueryException $ex) {
              $res['success'] = false;
              $res['message'] = $ex->getMessage();
              return response($res, 500);
          }
    }

    public function getPayments($obtain_id){
        $payments = Payments::join('obtainloans', 'obtainloans.obtain_id', '=', 'payments.obtain_id')
        ->where('payments.obtain_id', '=', $obtain_id)
        ->select('obtainloans.application_id', 'obtainloans.interest_rate', 'obtainloans.no_of_installment', 'obtainloans.obtain_id', 'payments.paid_amount', 'payments.payment_id', 'payments.rating_no', 'payments.to_be_paid_amount', 'payments.to_be_paid_date', 'payments.Installment', 'payments.Installment_date')
        ->orderBy('payments.Installment_date','desc')
        ->take(5)
        ->get();
        

        if($payments){
            $res['status']=true;
            $res['message']=$payments;
            return response($res);
        }else{
            $res['status']=false;
            $res['message']='No payments yet';
            return response($res);
        }
    }

    

    public function addPayment(Request $request){

        $payment = Payments::create($request->all());

        return response()->json($payment, 201);
    }

    public function getPaymentsfi($obtain_id){
        $payments = Payments::join('obtainloans', 'obtainloans.obtain_id', '=', 'payments.obtain_id')
        ->where('payments.obtain_id', '=', $obtain_id)
        ->select('*')
        ->orderBy('payments.Installment_date','desc')
        ->first();
        

        if($payments){
            $res['status']=true;
            $res['message']=$payments;
            return response($res);
        }else{
            $res['status']=false;
            $res['message']='No payments yet';
            return response($res);
        }
    }

    public function updaterating($payment_id,Request $request)
    {
      try{
        $page = $request->all();
        $plan = Payments::where('payment_id','=',$payment_id)->first();
        $plan->update($page);
        
        
            $res['status'] = true;
            $res['message'] = 'success!';
            return response($res, 200);
      
      }
      
      catch (\Illuminate\Database\QueryException $ex) {
                $res['status'] = false;
                $res['message'] = $ex->getMessage();
                return response($res, 500);
            }

    }



    

}
