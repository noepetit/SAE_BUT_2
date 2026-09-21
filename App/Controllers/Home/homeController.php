<?php

namespace App\Controllers\Home;

class HomeController
{
    public function execute(): void
    {
        (new \App\Views\home())->show();
    }
}