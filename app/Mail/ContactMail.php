<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $template;
    private $title;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $title, $data)
    {
        $this->template = $template;
        $this->title    = $title;
        $this->data     = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title) // メールタイトル
                    ->text($this->template) // どのテンプレートを呼び出すか
                    // ↑ここを->view($this->template)にするとhtmlメールになる 
                    ->with(['data' => $this->data]);// withオプションでセットしたデータをテンプレートへ受け渡す
    }
}
