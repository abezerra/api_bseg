<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviador de email temporizado kkk é issaqui doidu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'message' => 'Mensagem agendada',
            'subject' => 'Assunto da mensagem',
            'email'   => 'guaracyaraujolima@gmail.com',
        ];

        Mail::raw($data['message'], function ($message) use ($data) {
            $message->subject($data['subject']);
            $message->from('alsene@brasal.com.br', 'Alsene da Brasal Corretora');
            $message->to($data['email']);
        });

        $this->info('Email enviado pelo SendMailCommand');
    }
}
