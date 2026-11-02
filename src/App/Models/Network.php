<?php

namespace App\Models;

class Network
{
    private const DEVICES = [
        'pc1' => ['type' => 'computer', 'ip' => '192.168.1.10', 'links' => ['switch1']],
        'pc2' => ['type' => 'computer', 'ip' => '192.168.1.20', 'links' => ['switch1']],
        'switch1' => ['type' => 'computer', 'ip' => '192.168.1.10', 'links' => ['pc1', 'pc2']]
    ];
}