<?php

class CreatePostsTest extends FeaturesTestCase
{
    /**
     * user create post
     *
     * @test
     * @return void
     */
    public function a_user_create_a_post(){
        //Having (teniendo esta info)
        $user = $this->default_user();
        $post = [
            'title'     => 'titulo del post',
            'content'   => 'Cuerpo del post',
        ];
        $this->actingAs($user);

        //when (cuando hacemos cierta accion)
        $this->visit(route('posts.create'))
            ->type($post['title'],'title')
            ->type($post['content'],'content')
            ->press('Enviar');

        //then (entonces esperamos algo)
        $this->seeInDatabase('posts',[
            'title'     => $post['title'],
            'content'   => $post['content'],
            'pending'   => true
        ]);

        $this->see($post['title']);
    }

    public function require_auth_to_create_post(){
        //Having 


        //when
        $this->visit(route('posts.create'));

        //then
        $this->seePageIs(route('login'));
    }
}