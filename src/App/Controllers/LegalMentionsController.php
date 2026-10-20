<?php

namespace App\Controllers;

class LegalMentionsController
{
    public function execute(): void
    {
        (new \App\Views\LegalMentionsView())->show();
    }
}