<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
/**
 * @group Notifications
 */
class NotificationsController extends Controller
{
    /**
     * List
     *
     * Get user Notifications by business ID.
     * @bodyParam business_id integer required business ID. Example: 1
     * @authenticated
     * @response {
     *  "notifications": [
     *  ]
     *}
    **/
	public function list(Request $request)
	{
        $notifications = $request->user()
                            ->notifications()
                            ->where('data->business_id', $request->business_id)
                            ->get();

		return [
            'show_notifications' => (boolean) count($request->user()->unreadNotifications),
            'notifications' => $notifications
                                    ->map(function($notification) {
                    
                                        $details = $notification->data;

                                        if($notification->type == 'App\Notifications\OrderCreated') {
                                            $title = __('words.new_reservation');
                                            $content = __('words.new_reservation_content', [
                                                'name' => $details['name'],
                                                'date' => $details['start_date'],
                                                'time' => $details['start_time'],
                                            ]);
                                        }

                                        elseif ($notification->type == 'App\Notifications\OrderUpdated') {
                                            $title = __('words.reservation_edited');
                                            $content = __('words.reservation_edited_content', [
                                                'name' => $details['name'],
                                                'date' => $details['start_date'],
                                                'time' => $details['start_time'],
                                            ]);
                                        }

                                        elseif ($notification->type == 'App\Notifications\OrderApproved') {
                                            $title = __('words.reservation_confirmed');
                                            $content = __('words.reservation_confirmed_content', [
                                                'name' => $details['name'],
                                                'date' => $details['start_date'],
                                                'time' => $details['start_time'],
                                            ]);
                                        }

                                        elseif ($notification->type == 'App\Notifications\OrderCanceled') {
                                            $title = __('words.reservation_canceled');
                                            $content = __('words.reservation_canceled_content', [
                                                'name' => $details['name'],
                                            ]);
                                        }

                                        else {
                                            $title = __('words.new_notification');
                                            $content = $notification->type;
                                        }

                                        return [
                                            'id' => $notification->id,
                                            'read_at' => $notification->read_at,
                                            'title' => $title,
                                            'content' => $content,
                                            'order_id' => $notification->data['id'],
                                            'business_id' => $notification->data['business_id'] ?? null,
                                        ];
                                    })                    
        ];
    }

    /**
     * Read all notifications
     *
     * Mark all notifications as read
     * @authenticated
     * @response {
     *   "notifications": [],
     *}
    **/
    public function readAll(Request $request)
    {
        foreach ($request->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }


        return $this->list($request);
    }
}
