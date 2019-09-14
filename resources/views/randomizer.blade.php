@extends('layouts.default', ['title' => __('randomizer.title') . ' - '])

@section('content')
<div id="root">
    <Randomizer></Rndomizer>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
