<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends BaseController
{
    public function index(){

        $total_user = DB::table('users')->count();
       $total_Category = DB::table('categories')->count();
       $total_payment = DB::table('invoices')->where('payment_status','Success')->count();
       $totalSolutions = DB::table('products')->count();
       
       $userList = DB::table('users')
       ->select(
           'id',
           'fname as firstName',
           'lname as lastName',
           'username',
           'email',
           'phone',
           'gender',
           'occupation',
           'dob'
       )
       ->limit(5) // Limit to 5 results
       ->get();

       $response = [
        'totalUser' => $total_user,
        'totalCategories' => $total_Category,
        'totalPayments' => $total_payment,
        'totalSolutions'=>$totalSolutions,
        'users' => $userList,
       ];

       return $this->sendResponse($response,'Dashboard data fetched successfully.');
        
    }
    public function UserList(){
        $userList = DB::table('users')
        ->select('id','fname as firstName','lname as lastName',
        'username','email','phone','gender','occupation','dob')
        
        ->get();
        return $this->sendResponse($userList,'User list fetched successfully.');
    }
    
}
