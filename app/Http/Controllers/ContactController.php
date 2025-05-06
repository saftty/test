<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ContactController extends Controller
{
    public function index(): string
    {
        return view('contacts');
    }

}
