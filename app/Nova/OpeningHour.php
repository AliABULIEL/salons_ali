<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laraning\NovaTimeField\TimeField;
use Carbon\Carbon;

class OpeningHour extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\OpeningHour::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'day_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'day_name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Fields\ID::make(__('ID'), 'id')->sortable(),

            TimeField::make(__('Opening time'), 'opening_at'),

            TimeField::make(__('Closing time'), 'closing_at'),
            
            Fields\Select::make(__('Day'), 'day_name')
                ->options($this->generateDays()),

            Fields\BelongsTo::make(__('User'), 'user', User::class)
                ->nullable(),

            // Fields\BelongsTo::make(__('Service'), 'service', Service::class)
            //     ->nullable(),
        ];
    }

    public function generateDays()
    {
        return [
            'Sunday' => __('Sunday'),
            'Monday' => __('Monday'),
            'Tuesday' => __('Tuesday'),
            'Wednesday' => __('Wednesday'),
            'Thursday' => __('Thursday'),
            'Friday' => __('Friday'),
            'Saturday' => __('Saturday'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
