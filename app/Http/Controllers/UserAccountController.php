<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserAccountController extends Controller
{
    public function index(){

        return view('deposit');
    }

    public function store(Request $request){

        $AuthUser = $request->user();

        $rules = array(
            'amount' => 'required',      
        );
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back();
        }
      
        $userbalance = UserBalance::where('user_id', $AuthUser->id)->first();

        if ($userbalance && $userbalance->balance !== null) {
            $existbalance = $userbalance->balance;

        } else {

            $existbalance = 0;
        }

        $deposit = new UserAccount();
        $deposit->user_id =  $AuthUser->id;
        $deposit->amount = $request->amount;
        $deposit->type = 'Credit';
        $deposit->save();
        
        $newbalance =  $existbalance + $request->amount;
        UserBalance::where('user_id', $AuthUser->id)->update([
            'balance' =>   $newbalance,
        ]);

        return redirect()->back();
    }

    public function withdraw(){

        return view('withdraw');
    }

    public function withdrawstore(Request $request){

        $AuthUser = $request->user();

        $rules = array(
            'amount' => 'required',      
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $userbalance = UserBalance::where('user_id', $AuthUser->id)->first();

        if ($userbalance && $userbalance->balance !== null) {
            $existbalance = $userbalance->balance;

        } else {

            $existbalance = 0;
        }
      
        $deposit = new UserAccount();
        $deposit->user_id =  $AuthUser->id;
        $deposit->amount = $request->amount;
        $deposit->type = 'Debit';
        $deposit->save();

        $newbalance =  $existbalance - $request->amount;
        UserBalance::where('user_id', $AuthUser->id)->update([
            'balance' =>   $newbalance,
        ]);


        return redirect()->back();
    }

    public function transfer(){

        return view('transaction');
    }

    // public function transferstore(Request $request){

    //     $AuthUser = $request->user();

    //     $rules = array(
    //         'email' => 'required', 
    //         'amount' => 'required',      
    //     );
    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return redirect()->back();
    //     }

    //     $revId =User::where('email', $request->email)->first();

    //     $tolatBalance = UserAccount::where('user_id',$AuthUser->id)->first();


    //     if ( $tolatBalance->balance >= $request->amount) {
          
    //         return "low balance";

    //     }else{

    //         $deposit = new UserAccount();
    //         $deposit->user_id =  $AuthUser->id;
    //         $deposit->amount = $request->amount;
    //         $deposit->type = 'Debit';
    //         $deposit->details = 'transfer to '.$request->email;
    //         $deposit->save();
    //         if($deposit->save()){

    //             $deposit = new UserAccount();
    //             $deposit->user_id = $revId->id;
    //             $deposit->amount = $request->amount;
    //             $deposit->type = 'Credit';
    //             $deposit->details = 'transfer from '. $AuthUser->email;
    //             $deposit->save();

    //         }
    //         return redirect()->back();

    //     }


      
    
    // }

    public function statement(Request $request){
        // $AuthUser = $request->user();
        // $statements = UserAccount::with('userbalance')->where('user_id', $AuthUser->id)->get();

         // Parse existing JSON file
         $path = storage_path('app\public\transactions.json');
         $transactions = json_decode(file_get_contents($path), true);


        return view('statement',['transactions' =>  $transactions]);
    }

    public function transferstore(Request $request){

        $AuthUser = $request->user();

        $rules = array(
            'email' => 'required', 
            'amount' => 'required',      
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back();
        }

        if($request->file){
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            Storage::disk('public')->putFileAs('', $file, $filename, 'public');


        }

        // Parse existing JSON file
        $path = storage_path('app\public\transactions.json');
        $transactions = json_decode(file_get_contents($path), true);


            // Append new transaction data
            $newTransaction = [

                'email' => $request->input('email'),
                'amount' => $request->input('amount'),
                'date' => now()->toDateTimeString(),
                'file' => $filename,
            ];
            $transactions[] = $newTransaction;

            file_put_contents($path, json_encode($transactions));

            return redirect()->back();
    }

    

    

}
