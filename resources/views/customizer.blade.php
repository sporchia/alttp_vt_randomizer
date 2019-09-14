@extends('layouts.default', ['title' => 'Customizer - '])

@section('content')
<div id="root">
    <Customizer></Customizer>
</div>

<script>
new Vue({
    el: '#root',
    i18n: i18n,
    store: cStore,
});
</script>
@overwrite
