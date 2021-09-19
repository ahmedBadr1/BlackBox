<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class MailController extends Controller
{
    //
    public function index( Request $request)
    {

        $email ='';
        if ($request->query('e') !== null){
            $email = $request->query('e');
        }
        // dd($email);
        $allMails =  User::role('seller')->pluck('email');
    //    dd($allMails);

        return view('admin.mail',compact('allMails','email'));
    }
    public function send(Request $request)
    {

        $this->validate($request,[
            'to' => 'required|email',
            'heading'=> 'required',
            'title'=> 'required',
            'body'=>'required'
        ]);

        $details = [
            'heading' => $request->heading,
            'title'=> $request->title,
            'body' =>$request->body
        ];
        // dd($request->all());
        Mail::to($request->to)->send(new WelcomeMail($details));
        return redirect()->route('email')->with('success','Email Sent Successfully');
    }
    public function welcomeMail()
    {
        $app = $_ENV['APP_NAME'];
        $details = [
            'heading'=> 'this is my welcome email, hope it will work :)',
            'title'=> "welcome to ${app} for medical help",
            'body' => 'this is your welcome message'
        ];
        Mail::to('feedbackwe4u@gmail.com')->send(new WelcomeMail($details));
        return redirect()->route('email')->with('success','Email Sent Successfully');
    }
}
