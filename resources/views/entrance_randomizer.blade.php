@extends('layouts.default', ['title' => __('navigation.entrance') . ' - '])

@section('content')
<div id="root">
	<vt-entrance-randomizer version="{!! ALttP\EntranceRandomizer::VERSION !!}" enemizer-version="{!! ALttP\Enemizer::VERSION !!}" id="seed-generate"></vt-entrance-randomizer>
</div>

<script>
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
