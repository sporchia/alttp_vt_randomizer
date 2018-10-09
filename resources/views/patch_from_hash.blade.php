@extends('layouts.default', ['title' => sprintf('%s - %s - %s -', $hash, $spoiler->meta->logic, $seed->rules)])

@section('content')
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

<div id="root">
	<vt-hash-loader version="{!! ALttP\Randomizer::LOGIC !!}" id="seed-generate" current_rom_hash="{{ $md5 }}" hash="{{ $hash }}"></vt-hash-loader>
</div>

<script>
var current_rom_hash = '{{ $md5 }}';
var vt_base_patch = {!! $patch !!};

new Vue({
	el: '#root',
	i18n: i18n,
	store: cStore,
	created: function created() {
		this.$store.dispatch('getSprites');
	},
});
</script>
@overwrite
