<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Agrireports;
use App\reports;
use App\applications;
use App\farmersdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class agrireports2Controller extends Controller
{



    public function getreports($app_id,$type){
        $user = Agrireports::where('app_id',$app_id)->where('type',$type)->select('agr_images')->get();
        return $user;
    }

    
    public function viewagrirepo($app_id){

        $user = applications :: join('reports','reports.app_id','=','applications.id')
                ->join('farmersdetails','farmersdetails.nic','=','applications.nic')
                ->where('reports.app_id', '=',$app_id)
                ->where('reports.AO_status','=',"true")
                ->where('reports.AI_status','=',"true")
                ->where('reports.DO_status','=',"true")
                ->select('*')
                ->get();
  
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
	
	




