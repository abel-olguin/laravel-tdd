<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcceptAnswerTest extends FeaturesTestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function user_can_accept_a_comment_as_post_answer()
    {
        $comment = factory(\App\Comment::class)->create(['comment' => 'Contenido del post']);
        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url);

        $this->press('Aceptar respuesta');

        $this->seeInDatabase('posts',[
            'id' => $comment->post_id,
            'answer_id' => $comment->id,
            'pending'   => false
        ]);
        $this->seePageIs($comment->post->url)->seeInElement('.answer',$comment->comment);

    }


    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function no_post_author_cannot_see_button_accept_answer()
    {
        $comment = factory(\App\Comment::class)->create();

        $this->actingAs(factory(\App\User::class)->create());

        $this->visit($comment->post->url);

        $this->dontSee('Aceptar respuesta');

    }


    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function no_post_author_cannot_accept_a_comment_as_post_answer()
    {
        $comment = factory(\App\Comment::class)->create();

        $this->actingAs(factory(\App\User::class)->create());

        $this->visit($comment->post->url);

        $this->post(route('comment.accept',$comment));
        $this->seeInDatabase('posts',[
            'id' => $comment->post_id,
            'pending'   => true
        ]);


    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function accept_button_is_hidden_when_post_is_already_answered()
    {
        $comment = factory(\App\Comment::class)->create();
        $comment->markAsAnswer();

        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url);

        $this->dontSee('Aceptar respuesta');



    }
}
