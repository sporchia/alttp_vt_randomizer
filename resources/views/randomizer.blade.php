@extends('layouts.default', ['title' => 'Item Randomizer - '])

@section('content')
<div id="root">
	<vt-item-randomizer version="{!! ALttP\Randomizer::LOGIC !!}" enemizer-version="{!! ALttP\Enemizer::VERSION !!}" id="seed-generate"></vt-item-randomizer>
</div>

<script>
new Vue({
	el: '#root',
});
</script>
@overwrite
