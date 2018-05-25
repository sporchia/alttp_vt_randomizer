@extends('layouts.default')

@php
$title = 'Seed of the Day - ';
@endphp

@section('content')
<h3>Randomizer Seed of the Day</h3>
<div class="card card-body bg-light">
	<p>Can’t wait until the weekend for the next randomizer challenge? Want to see how you stack up
		against your favorite streamer? Introducing the Randomizer Seed of the Day!</p>
	<p>The game type will be random every day! (Would you expect anything else?)  Branch out and
		experience something new! Do you have the patience to persevere through a one-hit knockout
		seed, the cunning to solve the complexities of key-sanity, or the speed to pull the
		triforce from the pedestal? Find out today!</p>
</div>

<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5161309967767506" data-ad-slot="9849787408" data-ad-format="auto"></ins>

<div id="root">
	<vt-hash-loader version="{!! ALttP\Randomizer::LOGIC !!}" id="seed-generate" current_rom_hash="{{ $md5 }}" hash="{{ $hash }}"></vt-hash-loader>
</div>


<script>
var current_rom_hash = '{{ $md5 }}';
var vt_base_patch = {!! $patch !!};

new Vue({
	el: '#root',
});
</script>
@overwrite

