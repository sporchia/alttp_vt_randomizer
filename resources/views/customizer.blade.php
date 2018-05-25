@extends('layouts.base', ['title' => 'Customizer'])

@php
$title = 'Customizer - ';
@endphp

@section('window')
<div id="root">
	<vt-customizer></vt-customizer>
</div>

<script>
new Vue({
	el: '#root',
});
</script>
@overwrite
