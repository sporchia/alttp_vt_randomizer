@extends('layouts.default', ['title' => __('navigation.races') . ' - '])

@section('content')
<h1>{{ __('races.header') }}</h1>
<div class="card card-body bg-light">
    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('races.cards.races.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('races.cards.races.sections') as $section)
            <h4>{{ $section['header'] }}</h4>
                @foreach ($section['content'] as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('races.cards.tournament.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('races.cards.tournament.sections') as $section)
            <h4>{{ $section['header'] }}</h4>
                @foreach ($section['content'] as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            @endforeach
        </div>
    </div>

    @foreach (__('races.cards.foreign_language.languages') as $language)
    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ $language['header'] }}</h3>
        </div>
        <div class="card-body">
            <p>{!! $language['description'] !!}</p>
            @foreach ($language['sections'] as $section)
                <h4>{{ $section['header'] }}</h4>
                    @foreach ($section['content'] as $block)
                        <p>{!! $block !!}</p>
                    @endforeach
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@overwrite
