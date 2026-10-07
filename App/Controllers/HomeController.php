<?php

namespace App\Controllers;

class HomeController
{
    public function execute(): void
    {
        (new \App\Views\HomeView())->show();
    }
}