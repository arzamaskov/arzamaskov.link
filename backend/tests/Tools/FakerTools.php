<?php

namespace App\Tests\Tools;

use Faker\{Factory};

trait FakerTools
{
    public function getFaker(): \Faker\Generator
    {
        return Factory::create();
    }
}
