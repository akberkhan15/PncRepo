<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Mail;

trait CommonTrait
{
    public function sendEmail($view, $data) {
        $data['subject'] = "add Company";
        Mail::send($view, $data, function ($message) use ($data) {
            if (Mail::failures()) {
                return 'Email failed';
            }
            else{
                $message->to($data['email'])->subject($data['subject']);
            }
        });
    }  
}