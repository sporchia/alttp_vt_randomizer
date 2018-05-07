@extends('layouts.default')

@section('content')
<div id="root">
	<vt-item-randomizer version="{!! ALttP\Randomizer::LOGIC !!}" id="seed-generate"></vt-item-randomizer>
</div>

<script>
new Vue({
	el: '#root',
});
</script>
@overwrite
