<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use App\Business;
use Validator;

/**
 * @group Stories
 */
class StoriesController extends Controller
{
    /**
     * List
     *
     * Get Stories
     * @authenticated
     * @response {
     *  "stories": [
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
     *          "views": 0,
     *          "created_at": "2021-01-26T09:49:43.000000Z",
     *          "updated_at": "2021-01-26T09:49:43.000000Z"
     *      }
     *  ]
     * }
    **/
	public function list(Request $request)
	{
        $business = Business::findOrFail($request->user()->business_id);

        $stories = $business->stories()
                        ->with('user')
                        ->orderBy('id', 'desc')
                        ->take(30)
                        ->get();

		return [
            'stories' => $stories->map->details()
        ];
    }



    /**
     * View
     *
     * Increment story views by ID
     * @authenticated
     * @urlParam id integer required Story ID. Example: 1
     * @response {
     *   "message": "Success",
     *   "story": {
     *          "id": 1,
     *          "user_id": 1,
     *          "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
     *          "views": 0,
     *          "created_at": "2021-01-26T09:49:43.000000Z",
     *          "updated_at": "2021-01-26T09:49:43.000000Z"
     *    }
     * }
    **/
    public function view($id, Request $request)
    {
        $story = Story::findOrFail($id);

        $story->increment('views');

        return [
            'message' => 'success',
            'story' => $story->details()
        ];
    }




    /**
     * Create
     *
     * Story create
     * @authenticated
     * @bodyParam image file The image.
     * @response {
     *       "message": "Story created successfully",
     *       "story": {
     *           "user_id": 1,
     *           "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
     *           "views": 0,
     *           "updated_at": "2021-01-26T13:22:13.000000Z",
     *           "created_at": "2021-01-26T13:22:13.000000Z",
     *           "id": 3
     *       }
     * }
    **/
    public function create(Request $request)
    {
        $role = $request->user()->role;
		
        if($role == 'Business client') {
			return [
				'message' => 'You have no permission'
			];
        }
        
        $data = $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:30000',
        ]);

        $path = $request->image->store('public');
        $path = str_replace('public/', '', $path);


        $story = $request->user()->stories()->create([
            'user_id' => $request->user()->id,
            'image'   => str_replace('public/','', $path),
            'views'   => 0
        ]);


        $story->load('user');

        return [
            'message' => 'Story created successfully',
            'story' => $story->details()
        ];
    }

    /**
     * Delete
     *
     * Story delete
     * @authenticated
     * @bodyParam story_id integer required Store ID. Example: 1
     * @response {
     *       "message": "Story deleted successfully",
     * }
    **/
    public function delete(Request $request)
    {
        $role = $request->user()->role;
        
        if($role == 'Business client') {
            return [
                'message' => 'You have no permission'
            ];
        }

        $story = $request->user()->stories()->findOrFail($request->story_id);
        $story->delete();
        
        return [
            'message' => 'Story deleted successfully'
        ];
    }
}
