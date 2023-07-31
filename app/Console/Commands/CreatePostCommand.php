<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class CreatePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:create-posts {user_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create 100 post with 3 comments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating posts');

        $user_id = $this->argument('user_id') ?? 1;

        Post::factory()
            ->hasComments(3)
            ->count(100)
            ->create(['user_id' => $user_id]);

        $this->info('Posts created successfully');
    }
}
