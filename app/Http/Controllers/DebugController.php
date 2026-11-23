<?php

namespace App\Http\Controllers;

class DebugController extends Controller
{
    public function index()
    {
        $data = [
            'framework' => 'Laravel',
            'language' => 'PHP',
            'database' => 'MySQL',
        ];

        // dd($data);   // 6.5 Clean Up: dd() removed after testing

        return $data;
    }
}
