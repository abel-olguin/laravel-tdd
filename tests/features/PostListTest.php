<?php

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostListTest extends FeaturesTestCase
{

    /**
     * @test
     */
    public function user_can_see_the_post_list_and_redirect_to_detail(){
        $post = $this->create_post(['title' => 'Algun titulo']);
        $this->visit(route('posts.index'))
            ->seeInElement('h1','Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    /**
     * @test
     */
    function posts_are_paginated(){
        $first = factory(Post::class)->create([
            'title'         => 'post mas antiguo',
            'created_at'    => Carbon::now()->subDays(2)
        ]);

        factory(Post::class)->times(15)->create([
            'created_at' => Carbon::now()->subDay()
        ]);

        $last = factory(Post::class)->create([
            'title'         => 'post reciente',
            'created_at'    => Carbon::now()
        ]);


        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)
            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);
    }
}
