<?php
namespace App\Controllers;

class RenderViews
{
	public static function home()
	{
		view('home');
	}

	public static function about()
	{
		view('about');
	}
}