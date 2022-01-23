<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

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
        'id', 'first_name', 'last_name', 'email', 'phone'
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
            ID::make()->sortable(),


            Avatar::make(__('Image'), 'image'),

            Text::make(__('First name'), 'first_name')
                ->sortable()
                ->translatable(),

            Text::make(__('Last name'), 'last_name')
                ->sortable()
                ->translatable(),

            Boolean::make(__('Active'), 'is_active')
                ->onlyOnIndex()
                ->showOnDetail(),


            Text::make('Email')
                ->sortable()
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make('Phone'),
                // ->creationRules('unique:users,phone')
                // ->updateRules('unique:users,phone,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            BelongsTo::make(__('Business'), 'business', Business::class)
                ->nullable()->showCreateRelationButton(),

            BelongsToMany::make(__('Services'), 'services', Service::class),

            Select::make(__('Role'), 'role')
                ->options([
                    'Admin' => 'Admin',
                    'Business admin' => 'Business admin',
                    'Business employee' => 'Business employee',
                    'Business client' => 'Business client',
                ]),

            Boolean::make(__('Suspended'), 'suspended')
                ->sortable()
                ->onlyOnForms(),

            // Text::make(__('FCM token'), 'fcm_token'),

            HasMany::make(__('Stories'), 'stories', Story::class),

            HasMany::make(__('Working hours'), 'opening_hours', OpeningHour::class),

            HasMany::make(__('Orders'), 'orders', Order::class)
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
