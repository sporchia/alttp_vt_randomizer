@extends('layouts.default', ['title' => __('navigation.resources') . ' - '])

@section('content')
<h1>{{ __('resources.header') }}</h1>
<div class="card card-body bg-light">
    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('resources.cards.discord.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('resources.cards.discord.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('resources.cards.learn.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('resources.cards.learn.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('resources.cards.external.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('resources.cards.external.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('resources.cards.pitfalls.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('resources.cards.pitfalls.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('resources.cards.changes.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('resources.cards.changes.sections') as $section)
            <h4>{{ $section['header'] }}</h4>
                @foreach ($section['content'] as $block)
                    <p>{!! $block !!}</p>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@overwrite
