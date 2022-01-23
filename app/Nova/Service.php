<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

class Service extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Service::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('clients_count', 0);
    }

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

            Fields\BelongsTo::make(__('Business'), 'business', Business::class)
                ->nullable(),

            Fields\Image::make(__('Image'), 'image')->sortable(),

            Fields\Text::make(__('Name'), 'name')
                ->translatable(),

            Fields\Text::make(__('Description'), 'description')
                ->translatable()
                ->hideFromIndex(),

            Fields\Boolean::make(__('Active'), 'active'),

            Fields\Currency::make(__('Price'), 'price')->currency('ILS')->sortable(),

            Fields\Number::make(__('Minutes'), 'minutes')->sortable()->default(0),

            Fields\Boolean::make(__('Should approved'), 'should_approved'),

            Fields\BelongsToMany::make(__('Users'), 'users', User::class)
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
