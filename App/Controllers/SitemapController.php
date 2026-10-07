<?php

namespace App\Controllers;

use App\Views\SitemapView;

class SitemapController
{
    public function execute(): void
    {
        (new SitemapView())->show();
    }
}
