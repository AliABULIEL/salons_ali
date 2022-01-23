<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Carbon\Carbon;
use Plivo\RestClient;

class SendSms extends Command
{
    /**
     * sms:send
     *
     * @var string
     */
    protected $signature = 'sms:send {minutes}';

    /**
     * Send Sms for user.
     *
     * @var string
     */
    protected $description = 'Send Sms for user';

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
     * @return int
     */
    public function handle()
    {
        $minutes = $this->argument('minutes');
        $now = Carbon::now()->format('Y-m-d H:i');
        $orders = Order::with('user')->where('starting_at', '>', $now)->get();

        $orders->each(function($order) use($now, $minutes) {
            $starting_at = $order['starting_at'];
            $starting_at_now = $starting_at->clone()->subMinutes($minutes);
            if( $starting_at_now->format('Y-m-d H:i') == $now )
                $this->sendSms($order, $starting_at->diffForHumans(['options' => Carbon::CEIL]));
        });
    }

    private function sendSms($order, $time)
    {
        $client = new RestClient(env('PLIVO_AUTH_ID'), env('PLIVO_AUTH_TOKEN'));
        
        $message = __('words.the_order') .  ' ' . 
                    $order->name() . ' ' .
                    __('words.at') . ' ' .
                    $time;

        // $client->messages->create(
        //     env('SMS_FROM'),
        //     ['972' . (int) $order->user->phone],
        //     $message,
        // );

        $order->user->notify(new \App\Notifications\OrderComing($message, $time));
    }
}
