@extends('layouts.base')

@section('window')
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/"><img src="/i/logo.png" title="ALttP VT Randomizer" alt="ALttP Randomizer logo" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item{!! (request()->path() == 'start') ? ' active' : '' !!}"><a class="nav-link" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/start">{{ __('navigation.start_playing') }}</a></li>
                <li class="nav-item{!! (request()->path() == 'watch') ? ' active' : '' !!}"><a class="nav-link" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/watch">{{ __('navigation.start_watching') }}</a></li>
                <li class="nav-item dropdown{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer', 'daily', 'customizer'])) ? ' active' : '' !!}">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('navigation.generate') }}<span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item{!! (in_array(request()->path(), ['randomizer', 'entrance/randomizer'])) ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/randomizer">{{ __('navigation.randomizer') }}</a>
                        <a class="dropdown-item{!! (in_array(request()->path(), ['daily'])) ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/daily">{{ __('navigation.daily') }}</a>
                        <a class="dropdown-item{!! (in_array(request()->path(), ['customizer'])) ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/customizer">{{ __('navigation.customizer') }}</a>
                        <!--
                        <a class="dropdown-item{!! (in_array(request()->path(), ['multiworld'])) ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/multiworld">{{ __('navigation.multiworld') }}</a>
                        -->
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- <Streams></Streams> -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! __('navigation.language') !!} <span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ preg_replace('/^\/?'.app()->getLocale().'/', '/en', request()->path()) }}"><span class="flag-icon flag-icon-us"></span> English</a>
                        <a class="dropdown-item" href="{{ preg_replace('/^\/?'.app()->getLocale().'/', '/fr', request()->path()) }}"><span class="flag-icon flag-icon-fr"></span> Français</a>
                        <a class="dropdown-item" href="{{ preg_replace('/^\/?'.app()->getLocale().'/', '/de', request()->path()) }}"><span class="flag-icon flag-icon-de"></span> Deutsch</a>
                        <a class="dropdown-item" href="{{ preg_replace('/^\/?'.app()->getLocale().'/', '/es', request()->path()) }}"><span class="flag-icon flag-icon-es"></span> Español</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('navigation.help') }} <span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item{!! (request()->path() == 'resources') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/resources">{{ __('navigation.resources') }}</a>
                        <a class="dropdown-item{!! (request()->path() == 'options') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/options">{{ __('navigation.options') }}</a>
                        <a class="dropdown-item{!! (request()->path() == 'races') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/races">{{ __('navigation.races') }}</a>
                        <a class="dropdown-item{!! (request()->path() == 'updates') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/updates">{{ __('navigation.updates') }}</a>
                        <a class="dropdown-item{!! (request()->path() == 'sprite_preview') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/sprite_preview">{{ __('navigation.sprite_preview') }}</a>
                        <a class="dropdown-item{!! (request()->path() == 'contribute') ? ' active' : '' !!}" href="{{ app()->isLocale('en') ? '' : '/' . app()->getLocale() }}/contribute">{{ __('navigation.contribute') }}</a>
                        <a class="dropdown-item" href="https://discord.gg/alttprandomizer" target="_blank" rel="noopener noreferrer">{{ __('navigation.discord') }}</a>
                        <a class="dropdown-item" href="https://github.com/sporchia/alttp_vt_randomizer/issues/new" target="_blank" rel="noopener noreferrer">{{ __('navigation.report_issue') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="clearfix" style="padding-top:70px"></div>
    <div class="container">
    @if (config('alttp.banner'))
    <div class="info-banner alert alert-warning">@markdown(config('alttp.banner'))</div>
    @endif
    @yield('content')
    </div>
@overwrite
