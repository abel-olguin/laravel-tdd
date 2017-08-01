<?php


abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     *
     * App/User
     *
     * @var
     */
    private $default_user;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    public function default_user(array $data = []){
        if($this->default_user){
            return $this->default_user;
        }
        $this->default_user = factory(\App\User::class)->create($data);
        return $this->default_user;
    }


    public function create_post(array $data = []){
        return factory(\App\Post::class)->create($data);
    }
}
