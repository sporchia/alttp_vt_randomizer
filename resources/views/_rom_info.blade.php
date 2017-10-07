@section('rom-info')
<div class="col-md-6">
	<div>Logic: <span class="logic"></span></div>
	<div>ROM build: <span class="build"></span></div>
	<div>Difficulty: <span class="difficulty"></span></div>
	<div>Variation: <span class="variation"></span></div>
	<div>Mode: <span class="mode"></span></div>
	<div>Goal: <span class="goal"></span></div>
	<div>Seed: <span class="seed"></span></div>
</div>

<script>
function parseInfoFromPatch(patch) {
	$('.info').show();
	$('.info .seed').html(patch.seed + " [<a href='/h/" + patch.hash + "'>permalink</a>]");
	if ($('input[name=tournament]').val() == 'true') {
		$('.info .seed').html("<a href='/h/" + patch.seed + "'>" + patch.seed + "</a>");
	}
	$('.info .logic').html(patch.logic);
	$('.info .build').html(patch.spoiler.meta.build);
	$('.info .goal').html(patch.spoiler.meta.goal);
	$('.info .mode').html(patch.spoiler.meta.mode);
	$('.info .variation').html(patch.spoiler.meta.variation);
	$('.info .difficulty').html(patch.difficulty);
}
</script>
@overwrite
