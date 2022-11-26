<?php


namespace App\Orchid\Screens;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

abstract class AbstractMultiLanguageScreen extends Screen
{
    /**
     * @return array
     */
    public function layout(): array
    {
        return array_merge(
            $this->generateTabs($this->multiLanguageFields()),
            $this->singleLanguageFields(),
        );
    }

    /**
     * @return array
     */
    protected function multiLanguageFields(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function singleLanguageFields(): array
    {
        return [];
    }

    /**
     * @param array $fields
     * @return array
     */
    private function generateTabs(array $fields): array
    {
        if (!count($fields)) {
            return [];
        }

        if (collect(config('app.languages'))->count() <= 1) {
            return [
                Layout::rows($fields)
            ];
        }

        return [
            Layout::tabs(collect(config('app.languages'))->mapWithKeys(function ($language, $key) use ($fields) {
                return [
                    $language => Layout::rows(
                        collect($fields)->map(function ($field) use ($key) {
                            if ($field instanceof Field) {
                                $langField = clone $field;
                                $langField->set('name', $field->get('name') . '.' . $key);

                                $langField->set(
                                    'required',
                                    $key == config('app.locale') && $field->get('required')
                                );

                                return $langField;
                            };

                            if ($field instanceof Group) {
                                $group = [];
                                foreach ($field->getGroup() as $input) {
                                    $langField = clone $field;
                                    $langField->set('name', $field->get('name') . '.' . $key);

                                    $langField->set(
                                        'required',
                                        $key == config('app.locale') && $field->get('required')
                                    );

                                    $group[] = $langField;
                                }

                                return Group::make($group);
                            }
                        })->toArray()
                    )
                ];
            })->toArray())
        ];
    }

}
