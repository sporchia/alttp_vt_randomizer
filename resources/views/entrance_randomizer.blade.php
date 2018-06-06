@extends('layouts.default')

@php
$title = 'Entrance Randomizer - ';
@endphp

@section('content')
<div id="root">
	<vt-entrance-randomizer version="{!! ALttP\EntranceRandomizer::VERSION !!}" enemizer-version="{!! ALttP\Enemizer::VERSION !!}" id="seed-generate"></vt-entrance-randomizer>
</div>

<script>
new Vue({
	el: '#root',
});
</script>
@overwrite
