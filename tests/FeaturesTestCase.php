<?php

/**
 * Created by PhpStorm.
 * User: vendetta
 * Date: 24/07/17
 * Time: 04:32 AM
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;//migra la db cada vez
use Illuminate\Foundation\Testing\DatabaseTransactions;//no genera migracion pero deja la db intacta (vacia)

class FeaturesTestCase extends TestCase
{
    use DatabaseTransactions;
}