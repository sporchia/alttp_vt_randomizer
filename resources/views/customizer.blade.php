@extends('layouts.default', ['title' => 'Customizer - '])

@section('content')
<div id="root">
	<vt-customizer></vt-customizer>
</div>

<script>
new Vue({
	el: '#root',
	i18n,
	store: cStore,
	created() {
		this.$store.dispatch('getSprites');
		this.$store.dispatch('getSettings');
		this.$store.dispatch('getItemSettings');
	},
});
</script>
@overwrite
