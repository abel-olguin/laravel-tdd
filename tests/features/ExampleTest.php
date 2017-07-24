<?php

class ExampleTest extends FeaturesTestCase
{

    /**
     * A basic functional test example.
     *
     * @test
     * @return void
     */
    public function basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'wea wea'
        ]);
        $this->actingAs($user,'api')
            ->visit('api/user')
             ->see('wea wea');
    }
}
