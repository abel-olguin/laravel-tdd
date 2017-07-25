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

    /**
     * redirect if user isn't logged in
     *
     * @test
     */
    public function require_auth_to_create_post(){
        //Having


        //when
        $this->visit(route('posts.create'));

        //then
        $this->seePageIs(route('login'));
    }

    /**
     * Valid post input fields
     *
     * @test
     */
    public function create_post_validation(){
        //having

        $user = $this->default_user();

        //when

        $this->actingAs($user)
            ->visit(route('posts.create'))
            ->press('Enviar');

        //then
        $this->seePageIs(route('posts.create'));
        $this->seeInElement('#field_title .help-block','El campo título es obligatorio');
        $this->seeInElement('#field_content .help-block','El campo contenido es obligatorio');
    }
}