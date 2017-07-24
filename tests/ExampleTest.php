<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;//migra la db cada vez
use Illuminate\Foundation\Testing\DatabaseTransactions;//no genera migracion pero deja la db intacta (vacia)

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'wea wea'
        ]);
        $this->actingAs($user,'api')
            ->visit('api/user')
             ->see('wea wea');
    }
}
