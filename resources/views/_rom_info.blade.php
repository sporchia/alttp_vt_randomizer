@section('rom-info')
<div class="col-md-6">
	<div>Logic: <span class="logic"></span></div>
	<div>ROM build: <span class="build"></span></div>
	<div>Difficulty: <span class="difficulty"></span></div>
	<div>Variation: <span class="variation"></span></div>
	<div style="display:none">Shuffle: <span class="shuffle"></span></div>
	<div>Mode: <span class="mode"></span></div>
	<div>Goal: <span class="goal"></span></div>
	<div>Seed: <span class="seed"></span></div>
	<div style="display:none">Special: <span class="special"></span></div>
</div>

<script>
function parseInfoFromPatch(patch) {
	$('.info').show();
	$('.info .seed').html(patch.seed + (patch.hash !== undefined ? " [<a href='/h/" + patch.hash + "'>permalink</a>]" : ''));
	if ($('input[name=tournament]').val() == 'true') {
		$('.info .seed').html("<a href='/h/" + patch.seed + "'>" + patch.seed + "</a>");
	}
	if (patch.seed == 'vanilla') {
		$('.info .seed').html('Vanilla');
	}
	if (!patch.seed && patch.hash) {
		$('.info .seed').html(patch.hash);
	}
	$('.info .logic').html(patch.spoiler.meta.logic);
	$('.info .build').html(patch.spoiler.meta.build);
	$('.info .goal').html(patch.spoiler.meta.goal);
	$('.info .mode').html(patch.spoiler.meta.mode);
	$('.info .variation').html(patch.spoiler.meta.variation);
	$('.info .difficulty').html(patch.difficulty);
	$('.info .shuffle').html(patch.spoiler.meta.shuffle);
	$('.info .special').html(patch.spoiler.meta.special);
	if (patch.spoiler.meta.shuffle) {
		$('.info .shuffle').parent().show();
	} else {
		$('.info .shuffle').parent().hide();
	}
	if (patch.spoiler.meta.special) {
		$('.info .special').parent().show();
	} else {
		$('.info .special').parent().hide();
	}
}
</script>
@overwrite
