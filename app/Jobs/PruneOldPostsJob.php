<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $posts;     //$post

    public function __construct($posts)   //Post $post
    { 
        $this->posts = $posts;      //$this->post = $post
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       Post::where('created_at', '<', now()->subMinute(1))->chunck(2, function($posts){      //get....
            $posts->each(function($item){
                $item->delete();
            });
       } );              
    }
}
