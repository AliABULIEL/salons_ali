<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laraning\NovaTimeField\TimeField;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        // 'id',
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
            
            Fields\BelongsTo::make(__('Client'), 'client', User::class)
                ->nullable(),
            
            Fields\BelongsTo::make(__('User'), 'user', User::class)
                ->nullable(),

            Fields\BelongsTo::make(__('Business'), 'business', Business::class)
                ->nullable(),

            Fields\DateTime::make(__('Starting at'), 'starting_at')->format('DD-MM-YYYY HH:MM'),

            Fields\DateTime::make(__('Ending at'), 'ending_at')->format('DD-MM-YYYY HH:MM'),

            Fields\Currency::make(__('Total'), 'total')->currency('ILS')->sortable(),

            Fields\Number::make(__('Minutes'), 'minutes')->sortable(),

            Fields\Boolean::make(__('Should approved'), 'should_approved')->sortable(),

            Fields\Boolean::make(__('approved'), 'approved')->sortable(),

            Fields\Boolean::make(__('canceled'), 'canceled')->sortable(),
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
