<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkCommentAsAnswerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @test
     * @return void
     */
    public function post_can_be_answered()
    {
        $post = $this->create_post();

        $comment = factory(\App\Comment::class)->create([
            'post_id' => $post->id
        ]);

        $comment->markAsAnswer();

        $this->assertTrue($comment->fresh()->answer);
        $this->assertFalse($post->fresh()->pending);
    }

}
