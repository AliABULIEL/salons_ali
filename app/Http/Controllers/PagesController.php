<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

/**
 * @group Other
 * @unauthenticated
 */
class PagesController extends Controller
{

    /**
     * Terms of use
     *
     * Get Terms of use page.
    **/
    public function termsOfUse() {
    	$page = Page::where('name', 'terms-of-use')->firstOrFail();
    	return view('page', compact('page'));
    }


    /**
     * About
     *
     * Get about page.
    **/
    public function about() {
    	$page = Page::where('name', 'about')->firstOrFail();
        // dd($page->toArray());
    	return view('page', compact('page'));
    }
}
