@extends('layouts.base', ['title' => 'Customizer'])

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
