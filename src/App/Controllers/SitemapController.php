<?php

namespace App\Controllers;

use App\Views\SitemapView;

class SitemapController
{
    public function execute(): void
    {
        $page = max(1, (int) ($_GET['page_num'] ?? 1));
        $totalPages = 2;

        (new SitemapView())->show($page, $totalPages);
    }
}