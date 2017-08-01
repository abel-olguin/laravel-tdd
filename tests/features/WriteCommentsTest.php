<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentsTest extends FeaturesTestCase
{
    /**
     *
     * @test
     */
    public function can_user_write_comment_in_post()
    {
        //having
        $post = $this->create_post();
        $user = $this->default_user();
        //when
        $this->actingAs($user);
        $this->visit($post->url);

        $this->type('Nuevo comentario','comment');
        $this->press('Enviar comentario');

        $this->seeInDatabase('comments',[
            'comment' => 'Nuevo comentario',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->seePageIs($post->url);

    }
}
