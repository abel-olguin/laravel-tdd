<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeaturesTestCase
{
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */
    public function user_can_see_the_post_detail()
    {
        //having
        $user       = $this->default_user([
            'name' => 'Pedro'
        ]);
        $post_data  = [
            'title'     => 'titulo del post',
            'content'   => 'Cuerpo del post',
            'user_id'   => $user->id
        ];

        $post = factory(\App\Post::class)->make($post_data);
        $user->posts()->save($post);
        $this->actingAs($user);
        //when

        $this->visit(route('posts.show',$post));
        $this->seeInElement('h1',$post_data['title']);
        $this->see($post_data['content']);
        $this->see($user->name);

    }

    /**
     * @test
     */
    public function require_auth_to_see_a_post(){
        //Having
        //having
        $user       = $this->default_user();
        $post_data  = [
            'title'     => 'titulo del post',
            'content'   => 'Cuerpo del post',
            'user_id'   => $user->id
        ];

        $post = factory(\App\Post::class)->make($post_data);
        $user->posts()->save($post);

        //when
        $this->visit(route('posts.show',$post));

        //then
        $this->seePageIs(route('login'));
    }
}
