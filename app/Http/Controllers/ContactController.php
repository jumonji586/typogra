<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');   
    }
    public function complete(Request $request,Contact $contact)
    {
        $request->validate([
            'contact_name' => ['required','string','max:255'],
            'email' => ['required','string', 'email', 'max:255','confirmed'],
            'contact_body' => ['required','string','max:2000'],
            'privacy' => ['accepted'],
        ]);

        $contact->fill([
            'name' => $request->contact_name,
            'email' => $request->email,
            'body' => $request->contact_body,
        ])->save();

        // メール送信処理
        // 自分宛メール
        $title1 = 'お問い合わせがありました【TYPOGRA】';
        Mail::to(config('mail.admin'))->send(new ContactMail('emails.contact_reply_admin', $title1, $request));
 
        // ユーザー宛メール
        $title2 = 'お問い合わせを受付しました【TYPOGRA】';
        Mail::to($request->email)->send(new ContactMail('emails.contact_reply_user', $title2, $request));

        return view('contact.complete');
    }
}
