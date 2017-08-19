<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IntegrationPostTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     * @test
     * @return void
     */
    public function title_generates_slug_persisted()
    {
        //having
        $post = factory(\App\Post::class)->make([
            'title' => 'nuevo post'
        ]);

        $user = $this->default_user();

        $user->posts()->save($post);

        $this->assertSame('nuevo-post',$post->fresh()->slug);

    }
}
