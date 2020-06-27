@extends('layouts.default', ['title' => __('navigation.options') . ' - '])

@section('content')
<h1>{{ __('options.header') }}</h1>
<div  id="options" class="card card-body bg-light">
    <h2>{!! __('options.subheader') !!}</h2>

    <div class="card border-info mt-4">
        <a class="anchor" id="placement"></a>
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('randomizer.placement.title') }}</h3>
        </div>
        <div class="card-body">

            <a class="anchor" id="glitches_required"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.glitches_required.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.glitches_required.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="item_placement"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.item_placement.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.item_placement.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="accessibility"></a>
            <h3 id="dungeon_items" class="card-title p-2 border-bottom">{{ __('options.cards.dungeon_items.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.dungeon_items.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="accessibility"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.accessibility.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.accessibility.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

        </div>
    </div>

    <ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

    <div class="card border-info mt-4">
        <a class="anchor" id="goal"></a>
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('randomizer.goal.title') }}</h3>
        </div>
        <div class="card-body">

            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.goal.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.goal.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="tower_open"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.tower_open.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.tower_open.content') as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            </div>

            <a class="anchor" id="ganon_open"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.ganon_open.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.ganon_open.content') as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            </div>

        </div>
    </div>

    <div class="card border-info mt-4">
        <a class="anchor" id="gameplay"></a>
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('randomizer.gameplay.title') }}</h3>
        </div>
        <div class="card-body">

            <a class="anchor" id="world_state"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.world_state.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.world_state.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        @if (is_array($block))
                            <div class="ml-3">
                                <h6>{{ $block['header'] }}</h6>
                                @foreach ($block['content'] as $subblock)
                                    <p>{!! $subblock !!}</p>
                                @endforeach
                            </div>
                        @else
                            <p>{!! $block !!}</p>
                        @endif
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="entrance_shuffle"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.entrance_shuffle.header') }}</h3>
            <div class="mb-3"></div>
                @foreach (__('options.cards.entrance_shuffle.subheader') as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            <div class="card-body">
                @foreach (__('options.cards.entrance_shuffle.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        @if (is_array($block))
                            <div class="ml-3">
                                <h6>{{ $block['header'] }}</h6>
                                @foreach ($block['content'] as $subblock)
                                    <p>{!! $subblock !!}</p>
                                @endforeach
                            </div>
                        @else
                            <p>{!! $block !!}</p>
                        @endif
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="bosses"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.bosses.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.bosses.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="enemy_shuffle"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.enemy_shuffle.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.enemy_shuffle.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="hints"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.hints.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.hints.content') as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            </div>

        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('options.cards.difficulty.header') }}</h3>
        </div>
        <div class="card-body">

            <a class="anchor" id="weapons"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.weapons.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.weapons.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="item_pool"></a>
            <h3 class="card-title p-2">{{ __('options.cards.difficulty.item_pool') }}</h3>
            <table class="table table-sm">
            <thead><tr>
                <th class="w-50"></th>
                <th>{{ __('randomizer.difficulty.options.normal') }}</th>
                <th>{{ __('randomizer.difficulty.options.hard') }}</th>
                <th>{{ __('randomizer.difficulty.options.expert') }}</th>
            </tr></thead>
            <tbody><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.maximum_health') }}</td>
                <td>20</td>
                <td>14</td>
                <td>8</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.heart_containers') }}</td>
                <td>11</td>
                <td>7</td>
                <td>3</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.heart_pieces') }}</td>
                <td>24</td>
                <td>16</td>
                <td>8</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.maximum_mail') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.mail_3') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.mail_1') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.mail_1') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.maximum_sword') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.sword_4') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.sword_3') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.sword_2') }}</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.maximum_shield') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.shield_3') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.shield_2') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.shield_1') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.number_silvers') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.silver') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.number_silvers_swordless') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.silver') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.silver') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.silver') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.capacity_upgrade') }}</td>
                <td>7</td>
                <td>0</td>
                <td>0</td>
            </tr></tbody>
            </table>

            <a class="anchor" id="item_functionality"></a>
            <h3 class="card-title p-2">{{ __('options.cards.difficulty.item_functionality') }}</h3>
            <table class="table table-sm">
            <thead><tr>
                <th class="w-50"></th>
                <th>{{ __('randomizer.difficulty.options.normal') }}</th>
                <th>{{ __('randomizer.difficulty.options.hard') }}</th>
                <th>{{ __('randomizer.difficulty.options.expert') }}</th>
            </tr></thead>
            <tbody><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.potion_magic') }}<span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.potion_magic') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span></td>
                <td>100%</td>
                <td>50%</td>
                <td>25%</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.potion_health') }}
                    <span v-tooltip="'{{ __('options.cards.difficulty.comparison.tooltip.potion_health') }}'"><img class="icon" src="/i/svg/question-mark.svg" alt="tooltip"></span>
                </td>
                <td>20</td>
                <td>7</td>
                <td>4</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.bug_net_fairy') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.powder_bubble') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.fairy') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.heart') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.heart') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.cape_consumption') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.normal') }}</td>
                <td>2x</td>
                <td>2x</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.byrna_invincible') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.stun_boomerang') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
            </tr><tr class="table-secondary">
                <td>{{ __('options.cards.difficulty.comparison.stun_hookshot') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
            </tr><tr class="table-primary">
                <td>{{ __('options.cards.difficulty.comparison.tooltip.silvers') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.no') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
                <td>{{ __('options.cards.difficulty.comparison.yes') }}</td>
            </tr></tbody>
            </table>

            <a class="anchor" id="enemy_damage"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.enemy_damage.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.enemy_damage.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

            <a class="anchor" id="enemy_health"></a>
            <h3 class="card-title p-2 border-bottom">{{ __('options.cards.enemy_health.header') }}</h3>
            <div class="card-body">
                @foreach (__('options.cards.enemy_health.sections') as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
                @endforeach
            </div>

        </div>
    </div>

    <div class="card border-info mt-4">
        <a class="anchor" id="post_generation"></a>
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('options.cards.post_generation.header') }}</h3>
        </div>
        <div class="card-body">
        @foreach (__('options.cards.post_generation.cards') as $key => $card)
            <a class="anchor" id="{{ $key }}"></a>
            <h3 class="card-title p-2 border-bottom">{{ $card['header'] }}</h3>
            <div class="card-body">
                @foreach ($card['content'] as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            </div>
        @endforeach
        </div>
    </div>

    <div class="card border-info mt-4" id="item-pool">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('options.cards.item_pool') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>10x Big Key</li>
                        <li>1x Bombos</li>
                        <li>1x Book Of Mudora</li>
                        <li>1x Boomerang</li>
                        <li>4x Bottle (filled with assorted things)</li>
                        <li>1x Bug Catching Net</li>
                        <li>1x Cane Of Byrna</li>
                        <li>1x Cane Of Somaria</li>
                        <li>11x Compass</li>
                        <li>12x Dungeon Map</li>
                        <li>1x Ether</li>
                        <li>1x Fire Rod</li>
                        <li>1x Flippers</li>
                        <li>1x Flute</li>
                        <li>1x ½ Magic</li>
                        <li>1x Hammer</li>
                        <li>11x Heart Container</li>
                        <li>1x Hookshot</li>
                        <li>1x Ice Rod</li>
                        <li>28x Small Key</li>
                        <li>1x Lamp</li>
                        <li>1x Magic Cape</li>
                        <li>1x Magic Mirror</li>
                        <li>1x Magic Powder</li>
                   </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li>1x Magical Boomerang</li>
                        <li>1x Moon Pearl</li>
                        <li>1x Mushroom</li>
                        <li>1x Pegasus Boots</li>
                        <li>24x Piece Of Heart</li>
                        <li>2x Progressive Armor</li>
                        <li>2x Progressive Bow</li>
                        <li>2x Progressive Glove</li>
                        <li>3x Progressive Shield</li>
                        <li>4x Progressive Sword</li>
                        <li>1x Quake</li>
                        <li>1x Shovel</li>
                    </ul>
                    <ul style="list-style-type:    none">
                        <li>&nbsp;</li>
                    </ul>
                    <ul>
                        <li>12x Ten Arrows</li>
                        <li>1x Single Arrow</li>
                        <li>1x Ten Bombs</li>
                        <li>16x Three Bombs</li>
                        <li>5x Three Hundred Rupees</li>
                        <li>1x One Hundred Rupees</li>
                        <li>7x Fifty Rupees</li>
                        <li>28x Twenty Rupees</li>
                        <li>4x Five Rupees</li>
                        <li>2x One Rupee</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@overwrite
