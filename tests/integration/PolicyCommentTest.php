<?php

use App\Policies\CommentPolicy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PolicyCommentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function only_post_user_can_answered_his_post()
    {
        $comment = factory(\App\Comment::class)->create();

        $policy = new CommentPolicy();

        $policy->accept($comment->post->user,$comment);

        $this->assertTrue($policy->accept($comment->post->user,$comment));
    }
}
