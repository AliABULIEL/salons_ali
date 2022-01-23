<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Yna\NovaSwatches\Swatches;
use EmilianoTisato\GoogleAutocomplete\GoogleAutocomplete;
use EmilianoTisato\GoogleAutocomplete\AddressMetadata;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use Laravel\Nova\Panel;

class Business extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Business::class;

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
        'name',
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

            Fields\Text::make(__('Name'), 'name')
                ->translatable(),

            Fields\Image::make(__('Logo'), 'logo'),

            Fields\Image::make(__('Cover'), 'cover')->hideFromIndex(),

            Swatches::make(__('Primary color'), 'primary_color'),

            Fields\Textarea::make(__('Intro'), 'intro')
                ->translatable()
                ->alwaysShow(),

            Fields\Textarea::make(__('About'), 'about')
                ->translatable()
                ->alwaysShow()
                ->hideFromIndex(),


            Fields\Textarea::make(__('Working days'), 'working_days')
                ->translatable()
                ->alwaysShow()
                ->hideFromIndex(),


            SimpleRepeatable::make(__('Social links'), 'social_links', [
                    Fields\Select::make(__('Type'), 'type')->options([
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'whatsapp' => 'Whatsapp',
                        'website' => 'Website'
                    ]),
                    Fields\Text::make(__('Link'), 'link')
                ])
                ->canAddRows(true)
                ->canDeleteRows(true),

            new Panel('Notifications', $this->notificationsFields()),

            new Panel('Order rules', $this->orderFields()),

            new Panel('Address Information', $this->addressFields()),



            Fields\HasMany::make(__('Users'), 'users'),

            Fields\HasManyThrough::make(__('Opening hours'), 'opening_hours', OpeningHour::class),

            // Fields\HasManyThrough::make(__('Services'), 'services', Service::class),

            Fields\HasManyThrough::make(__('Stories'), 'stories', Story::class)
        ];
    }


    protected function addressFields()
    {
        return [
            Fields\Text::make(__('Address'), 'address')
                ->translatable()
                ->hideFromIndex(),

            Fields\Textarea::make(__('Address Text'), 'address_text')
                ->translatable()
                ->alwaysShow()
                ->hideFromIndex(),

            Fields\Image::make(__('Address Image'), 'address_image')->hideFromIndex(),

            GoogleAutocomplete::make(__('Google address'), 'google_address')
                ->withValues(['latitude', 'longitude'])
                ->hideFromIndex(),

            AddressMetadata::make(__('Latitude'), 'latitude')
                ->fromValue('latitude')
                ->hideFromIndex(),

            AddressMetadata::make(__('Longitude'), 'longitude')
                ->fromValue('longitude')
                ->hideFromIndex()
        ];
    }


    protected function orderFields()
    {
        return [
            Fields\Number::make(__('Order min days'), 'order_min_days')
                ->hideFromIndex()
                ->rules('required'),

            Fields\Number::make(__('Cancel min days'), 'cancel_min_days')
                ->hideFromIndex()
                ->rules('required'),

            Fields\Number::make(__('Edit min days'), 'edit_min_days')
                ->hideFromIndex()
                ->rules('required')
        ];
    }

    protected function notificationsFields()
    {
        return [
            Fields\Boolean::make(__('SMS notifications'), 'sms_notifications')
                ->hideFromIndex(),

            Fields\Boolean::make(__('Push notifications'), 'push_notifications')
                ->hideFromIndex(),

            Fields\Text::make(__('FCM token'), 'fcm_token')
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
