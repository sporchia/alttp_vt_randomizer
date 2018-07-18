@extends('layouts.default', ['title' => 'Customizer - '])

@section('content')
<div id="root">
	<vt-customizer></vt-customizer>
</div>

<script>
new Vue({
	el: '#root',
	store: cStore,
	created() {
		this.$store.dispatch('getSettings');
	},
});
</script>
@overwrite
