<?php

namespace App\Jobs;

use App\Models\Post;
use App\Mail\NewPostsEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $posts = Post::whereNull('email_sent')->get();

        if (count($posts) > 0) {

            //* Send to all emails
            DB::table('users')
                ->orderBy('id')
                ->chunk(100, function (Collection $users) use ($posts) {
                    foreach ($users as $user) {
                        Mail::to($user->email)->send(new NewPostsEmail($posts));
                    }
                });

            Post::whereIn('id', $posts->pluck('id'))
                ->update([
                    'email_sent' => now(),
                ]);
        }
    }
}
