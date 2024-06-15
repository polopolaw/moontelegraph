<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\TelegraphBot;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<TelegraphBot>
 */
class TelegraphBotResource extends ModelResource
{
    protected string $model = TelegraphBot::class;

    protected string $title = 'TelegramBots';

    /**
     * @return list<Field>
     */
    public function indexFields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make(__('Name'), 'name'),
            ]),
        ];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function formFields(): array
    {
        return [
            Text::make(__('Name'), 'name'),
            Text::make(__('Token'), 'token'),
        ];
    }

    /**
     * @return list<Field>
     */
    public function detailFields(): array
    {
        return [
            Block::make([
                Text::make(__('Name'), 'name'),
                HasMany::make('Users', 'users', resource: new UserResource()),
            ]),
        ];
    }

    /**
     * @param  TelegraphBot  $item
     * @return array<string, string[]|string>
     *
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'token' => [
                'required',
                'string',
                'regex:/^[0-9]{8,10}:[a-zA-Z0-9_-]{35}$/',
                function ($attribute, $value, $fail) use ($item) {
                    $hash = hash('sha256', $value);
                    if (TelegraphBot::where('hash_token', $hash)->whereNot('id', $item->id)->exists()) {
                        $fail(__('The token has already been taken.'));
                    }
                },
            ],
        ];
    }

    protected function afterCreated(Model $item): Model
    {
        $item->registerWebhook()->send();

        return $item;
    }
}
