<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    /**
     * @test
     */
    public function title_generates_slug()
    {
        $post = new \App\Post([
            'title' => 'nuevo post'
        ]);

        $this->assertSame('nuevo-post',$post->slug);
    }

    public function change_slug_when_title_change(){
        $post = new \App\Post([
            'title' => 'nuevo post'
        ]);

        $post->title = "nuevo post 1";
        $this->assertSame('nuevo-post-1',$post->slug);
    }
}
