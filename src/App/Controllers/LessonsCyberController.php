<?php

namespace App\Controllers;
class LessonsCyberController
{
    public function execute(): void
    {
        (new \App\Views\LessonsCyberView())->show();
    }
}