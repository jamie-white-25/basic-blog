<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Mail\NewPostsEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendNewPostEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:send-new-post-email {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email for new post with email_sent at null';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending email');

        $posts = Post::whereNull('email_sent')->get();

        if (count($posts) > 0) {

            //* Pass in a email address or send to all emails
            if ($this->argument('email')) {
                Mail::to($this->argument('email'))->send(new NewPostsEmail($posts));
            } else {
                DB::table('users')
                    ->orderBy('id')
                    ->chunk(100, function (Collection $users) use ($posts) {
                        foreach ($users as $user) {
                            Mail::to($user->email)->send(new NewPostsEmail($posts));
                        }
                    });
            }


            Post::whereIn('id', $posts->pluck('id'))
                ->update([
                    'email_sent' => now(),
                ]);
        }

        $this->info('Email sent successfully');
    }
}
