@extends('layouts.default', ['title' => __('navigation.sprite_preview') . ' - '])

@section('content')
<div id="root">
    <Sprites></Sprites>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
