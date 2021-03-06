<?php
//Controller of Farmer & officers side

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\reports;
use App\agriloans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class agriloansController extends Controller
{

  public function createagriloan(Request $request){ //add the agricultural loan

        try{
          $rep_id = $request->input('rep_id');
          $bank_name = $request->input('bank_name');
          $b_amount = $request->input('b_amount');

          $save = agriloans::create([
              'rep_id'=> $rep_id,
              'bank_name'=> $bank_name,
              'b_amount'=> $b_amount,
              
          ]);
          
          
              $res['status'] = true;
              $res['message'] = $save;
              return response($res, 200);
        
        }
        
        catch (\Illuminate\Database\QueryException $ex) {
                  $res['status'] = false;
                  $res['message'] = $ex->getMessage();
                  return response($res, 500);
        }

  }
    

      public function dltloans($rep_id){ // delte the agricultural loan

          $user = agriloans::where('agriloans.rep_id', '=',$rep_id)
                  ->delete();
                            
          if ($user) {
                $res['status'] = true;
                $res['message'] = $user;
                return response($res);
          }
          else{
                $res['status'] = false;
                $res['message'] = 'success';
                return response($res);
          }
            
            
      }
        




    
  	
	 
	

	


}