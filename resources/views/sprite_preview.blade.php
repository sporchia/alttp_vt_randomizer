@extends('layouts.default', ['title' => __('navigation.sprite_preview') . ' - '])

@section('content')
<div id="root">
	<sprites/>
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
