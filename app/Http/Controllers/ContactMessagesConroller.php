<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @group Contact
 */
class ContactMessagesConroller extends Controller
{

    /**
     * Send message
     *
     * Send message
     * @authenticated
     * @bodyParam content string required content.  Example: my message
     * @response {
     *	"status": "success",
     * }
    **/
    public function store(Request $request)
    {
		$request->validate([
            'content' => 'required|string|max:255',
		]);

		$request->user()->contactMessages()->create([
			'content' => $request->content,
		]);

		return [
			'status' => 'success'
		];
    }
}
