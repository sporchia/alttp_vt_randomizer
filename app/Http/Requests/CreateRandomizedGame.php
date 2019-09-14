<?php

namespace ALttP\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRandomizedGame extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @todo have these return better error strings
     *
     * @return array
     */
    public function rules()
    {
        $valid_settings = array_map(function ($group) {
            return array_keys($group);
        }, config('alttp.randomizer.item'));

        return [
            'glitches' => [
                Rule::in($valid_settings['glitches_required']),
            ],
            'item_placement' => [
                Rule::in($valid_settings['item_placement']),
            ],
            'dungeon_items' => [
                Rule::in($valid_settings['dungeon_items']),
            ],
            'accessibility' => [
                Rule::in($valid_settings['accessibility']),
            ],
            'goal' => [
                Rule::in($valid_settings['goals']),
            ],
            'crystals.tower' => [
                Rule::in($valid_settings['tower_open']),
            ],
            'crystals.ganon' => [
                Rule::in($valid_settings['ganon_open']),
            ],
            'mode' => [
                Rule::in($valid_settings['world_state']),
            ],
            'entrances' => [
                Rule::in($valid_settings['entrance_shuffle']),
            ],
            'enemizer.boss_shuffle' => [
                Rule::in($valid_settings['boss_shuffle']),
            ],
            'enemizer.enemy_shuffle' => [
                Rule::in($valid_settings['enemy_shuffle']),
            ],
            'hints' => [
                Rule::in($valid_settings['hints']),
            ],
            'weapons' => [
                Rule::in($valid_settings['weapons']),
            ],
            'item.pool' => [
                Rule::in($valid_settings['item_pool']),
            ],
            'item.functionality' => [
                Rule::in($valid_settings['item_functionality']),
            ],
            'enemizer.enemy_damage' => [
                Rule::in($valid_settings['enemy_damage']),
            ],
            'enemizer.enemy_health' => [
                Rule::in($valid_settings['enemy_health']),
            ],
        ];
    }
}
