<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use \Kreait\Firebase\Exception\Auth\InvalidPassword;
use Auth;

class DashbordController extends Controller
{
    //--------------------------to desplay the dashbord after login--------------------------
    public function index()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
            ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/donorData');
 
        $database = $firebase->createDatabase();
 
        $details = $database->getReference('/');
        // $details=$details->getvalue();

         $details=$details->getvalue() ;
         

         return view('devoters_list', ['details1'=>$details]);
    }



    //---------------------Update Devotee Details--------------------------------
function update($id){
  
    $key = $id;
    $firebase = (new Factory)
    ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
    ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/donorData');

$database = $firebase->createDatabase();

$editData = $database->getReference('/')->getchild($key)->getvalue();

if($editData){
    return view('update' , compact('editData','key'));
}
else{
    return redirect('devoters_list')->with('status','user not found');
}

}


//------------------------saving the updated details-----------------------------
function updateDetails(Request $request,$id){
    $firebase = (new Factory)
    ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
    ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/donorData');

$database = $firebase->createDatabase();

$updateData = [
    'name' => $request->name,
    'address' => $request->address,
    'mobile' => $request->mobile,
    'email' => $request->email,
    'amount'=>$request->amount,
];

$res_updated = $database->getReference('/'.$key)->update($updateData);

if($res_updated){
    return redirect('devoter_list')->with('status' , 'details updated successfully');
}else{
    return redirect('devoter_list')->with('status' , 'details not updated');
}

}


//--------------------Delete Devotee Details---------------------------------
function delete($id){
    $firebase = (new Factory)
    ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
    ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/donorData');

$database = $firebase->createDatabase();
$key = $id;
$deleteData = $database->getReference('/'.$key)->remove();

if($deleteData){
    return redirect('devoter_list')->with('status' , 'details Deleted successfully');
}else{
    return redirect('devoter_list')->with('status' , 'details not Delete');
}
}



//-----------------------to display the Donation List On click donation button----------------
    function donationlist(){

            $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
            ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/donorData');
        
        $database = $firebase->createDatabase();
        
        $details = $database->getReference('/');
        // $details=$details->getvalue();
        
         $details=$details->getvalue() ;
         
        
        return view('donation_list' , ['details2'=>$details ]);
        
        }


     
     
        //----------------to display the Expenses list on click Expense button-------------
        function expenseList(){
            $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
            ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/expensesList');
        
        $database = $firebase->createDatabase();
        
        $details = $database->getReference('/');
        // $details=$details->getvalue();
        
         $details=$details->getvalue() ;
         
         return view('expenses_list' ,['details1'=>$details]);

        }


      
      
        //-----------------to add and show message after successfully add expense-------------
        function expenseAdd(Request $request){
            $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/donationdata-firebase-adminsdk-a0irl-e3ce4e4306.json')
            ->withDatabaseUri('https://donationdata-default-rtdb.firebaseio.com/expensesList');
        
            $database = $firebase->createDatabase();
        
            $ref_Tablename = 'expensesList';
            $postData = [
                'description' => $request->description,
                'amount'=>$request->amount
            ];
            $postRef = $database->getReference($ref_Tablename)->push($postData);

            if($postRef){
                return redirect('expenses')->with('status','added successfully');

            }else{
                return redirect('expenses')->with('status','Not added'); 
            }
         
        }
 
}