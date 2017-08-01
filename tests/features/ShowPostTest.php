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

        $post = factory(\App\Post::class)->create($post_data);
        //$user->posts()->save($post);
        $this->actingAs($user);
        //when

        $this->visit($post->url);

        //then
        $this->seeInElement('h1',$post_data['title']);
        $this->see($post_data['content']);
        $this->see($user->name);

    }

    /**
     * @test
     */
    public function not_require_auth_to_see_a_post(){
        //Having

        $post_data  = [
            'title'     => 'titulo del post',
            'content'   => 'Cuerpo del post'
        ];

        $post = $this->create_post($post_data);

        //when
        $this->visit($post->url);

        //then
        $this->see($post->title);
    }

    /**
     * @test
     */
    public function redirect_old_url_to_new_url(){
        $user       = $this->default_user();
        $post_data  = [
            'title'     => 'titulo viejo',
        ];

        $post = factory(\App\Post::class)->make($post_data);
        $user->posts()->save($post);

        $old_url = $post->url;

        $this->actingAs($user);

        //when
        $post->update(['title' => 'nuevo titulo']);
        $this->visit($old_url);
        //then
        $this->seePageIs($post->url);
    }
}
