@extends('layouts.default', ['title' => sprintf('%s - ', $hash)])

@section('content')
<ins class="adsbygoogle" style="display:inline-block;width:100%;height:90px" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408"></ins>

<div id="root">
    <Hashloader version="{!! ALttP\Randomizer::LOGIC !!}" id="seed-generate" current_rom_hash="{{ $md5 }}" :base-patch="{{ $patch }}" hash="{{ $hash }}"></Hashloader>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
