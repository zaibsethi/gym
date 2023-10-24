<?php

namespace App\Jobs;

use App\Models\Member;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $memberId;

    /**
     * Create a new job instance.
     *
     * @param int $memberId
     */
    public function __construct($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Retrieve the member using the provided ID
        $member = Member::find($this->memberId);

        if ($member) {
            $cDate = Carbon::parse(now())->addMonth(1)->format('Y-m-d');

            $message = Message::whereRaw('DATE(created_at) < ?', [$cDate])  // Compare with date part only
            ->orderBy('created_at', 'desc')
                ->first();

            if ($message) {
                // Send the message for this member
                $url = "http://whatsapp247.com/api/send.php";

                $parameters = array(
                    "api_key" => "923092018911-f5b7824d-586c-489d-95e8-881aad1edc57",
                    "mobile" => "92" . $member->member_phone,
                    "message" => "test",
                    "priority" => "10",
                    "type" => 1, // Set type to 1 for image
                    "url" => asset('/backend/images/message/media/' . $message->message_url), // URL to your image
                    "caption" => $message->message_caption // Optional image caption
                );

                $ch = curl_init();
                $timeout = 30;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $response = curl_exec($ch);
                curl_close($ch);

                echo $response;
            }
        }
    }
}
