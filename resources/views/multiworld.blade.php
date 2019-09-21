@extends('layouts.default', ['title' => __('multiworld.title') . ' - '])

@section('content')
<div id="root">
    <Multiworld></Multiworld>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
