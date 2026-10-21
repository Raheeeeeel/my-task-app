<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PageController extends Controller
{
    public function hello()
    {
        return view('hello', ['name' => 'Raheel']);
    }
    public function about()
    {
        return view('about');
    }
}
