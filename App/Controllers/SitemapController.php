<?php

namespace App\Controllers;

use App\Views\SitemapViews;

class SitemapController
{
    public function execute(): void
    {
        (new SitemapView())->show();
    }
}
