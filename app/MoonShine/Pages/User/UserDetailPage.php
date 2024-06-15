<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\User;

use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Pages\Crud\DetailPage;
use Throwable;

class UserDetailPage extends DetailPage
{
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make(__('Title'), 'name'),
            Text::make(__('Phone'), 'phone'),
            Checkbox::make(__('Phone confirmed'), 'phone_verified'),
            Checkbox::make(__('Is active'), 'is_active'),
            Text::make(__('Telegram id'), 'telegram_id'),
            HasMany::make(__('Messages'), 'messages'),
        ];
    }

    /**
     * @return list<MoonShineComponent>
     *
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<MoonShineComponent>
     *
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<MoonShineComponent>
     *
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
