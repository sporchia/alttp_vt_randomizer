@extends('layouts.default', ['title' => __('navigation.daily') . ' - '])

@section('content')
<h3>{{ __('daily.header') }}</h3>
<div class="card card-body bg-light">
    @foreach (__('daily.content') as $block)
        <p>{!! $block !!}</p>
    @endforeach
</div>

<ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

<div id="root">
    <Hashloader :no-link="false" current_rom_hash="{{ $md5 }}" override-base-bps="{{ $bpsLocation }}" hash="{{ $hash }}"></Hashloader>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
