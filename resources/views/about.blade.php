@extends('layouts.default')

@section('content')
<img :src="$store.state.theme === 'dark' ? '/i/logo-large-dm.png' : '/i/logo-large.png'" style="margin:-11% 0 -10% 0;width:100%" />
<div class="btn-wrapper">
<div class="btn-cta"><a
    class="btn btn-primary btn-lg"
    href="/{{ app()->getLocale() }}/start"
    role="button">{{ __('navigation.start_playing') }}</a></div>
<div class="btn-cta"><a
    class="btn btn-outline-secondary btn-lg"
    href="/{{ app()->getLocale() }}/watch"
    role="button"
    style="margin-left:20px;">{{ __('navigation.start_watching') }}</a></div>
</div>
<div class="card card-body bg-light" style="font-size:22px;margin-top:40px;">
    @foreach (__('about.content') as $block)
        <p>{!! $block !!}</p>
    @endforeach
</div>
@overwrite
