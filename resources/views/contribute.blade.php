@extends('layouts.default', ['title' => __('navigation.contribute') . ' - '])

@section('content')
<h1>{{ __('contribute.header') }}</h1>
<div class="card card-body bg-light">
    <h3>{!! __('contribute.subheader') !!}</h3>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('contribute.cards.sprite.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('contribute.cards.sprite.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('contribute.cards.other.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('contribute.cards.other.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>

    <div class="card border-info mt-4">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">{{ __('contribute.cards.discord.header') }}</h3>
        </div>
        <div class="card-body">
            @foreach (__('contribute.cards.discord.content') as $block)
                <p>{!! $block !!}</p>
            @endforeach
        </div>
    </div>
</div>
@overwrite
