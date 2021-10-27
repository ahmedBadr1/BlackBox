<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use App\Models\User;
use App\Notifications\BusinessInvitationNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class BusinessController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:seller');
    }

    public function index()
    {
        return view('seller.business');
    }
    public function store(Request $request)
    {
        dd($request->all());
    }
    public function invite(Request $request)
    {
        $this->validate($request,[
           'email' => 'required|email'
        ]);

       // dd($request['email']);

       $user =  auth()->user();
        if (User::where('email', $request['email'])->exists()) {
            // exists
           $user = User::where('email', $request['email'])->first();
           $user->notify(new BusinessInvitationNotification($user->name));
        }else{
            $data = [
                'title' => 'Invitaion Link',
                'body' => 'you have been invited by '.$user->name. 'to join his business' ,
                'button' => 'Join Us',
                'url' => url('/'),
                'to' => $request['email'],
                'from' => $user->email ,
                'name' => $user->name
            ];
//            Mail::send(['text'=>'mail'], $data, function($message) use ($data) {
//                $message->to($data['to'], 'Tutorials Point');
//                  $message->subject('you have been invited by '.$data['name']. 'to join his business');
//                $message->from($data['from'],'Black BOx');
//            });

//           return (new MailMessage())->replyTo($data['to'], 'Tutorials Point')
//               ->subject('you have been invited by '.$data['name']. 'to join his business')
//                ->from($data['from'],'Black BOx');

            Mail::to($data['to'])->send(new InvitationMail($data));
        }

        toastr()->success('email sent successfully');

        return back();

    }
}
