@extends('layouts.default')

@section('content')
<div class="alert alert-danger" role="alert" style="display:none">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <span class="message">Cannot Read ROM file.</span>
</div>
<div id="rom-select" class="panel panel-info" style="display:none">
	<div class="panel-heading">
		<h4 class="panel-title">Getting Started</h4>
	</div>
	<div class="panel-body">
		<p>
			<label class="btn btn-default btn-file">
				Select ROM File <input type="file" accept=".sfc" name="f2u" style="display: none;">
			</label>
		</p>
		<p>Please use a Zelda no Densetsu: Kamigami no Triforce v1.0 ROM</p>
	</div>
</div>
<div id="seed-generate" class="panel panel-success" style="display:none">
	<div class="panel-heading panel-heading-btn">
		<h3 class="panel-title pull-left">Generate</h3>
		<button class="btn btn-default pull-right" data-toggle="collapse" href="#rom-settings">ROM <span class="glyphicon glyphicon-cog"></span></button>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="row" style="padding-bottom:5px;">
			<div class="col-md-4">
				<div class="input-group" role="group">
					<span class="input-group-addon">Seed</span>
					<input type="text" id="seed" class="seed form-control" maxlength="9" placeholder="leave blank for random">
					<span class="input-group-btn">
						<button id="seed-clear" class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove"></span></button>
					</span>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-4">
						<div class="input-group" role="group">
							<span class="input-group-addon">Rules</span>
							<select id="rules" class="form-control selectpicker">
								<option value="v8">v8</option>
								<option value="v8_hard">v8 (hard mode)</option>
								<option value="v7">v7</option>
								<option value="v7_hard">v7 (hard mode)</option>
								<option value="custom">Custom</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group" role="group">
							<span class="input-group-addon">Mode</span>
							<select id="game-mode" class="form-control selectpicker">
								<option value="NoMajorGlitches">Casual (NMG)</option>
								<option value="SpeedRunner">Speed Runner</option>
								<option value="Glitched">Glitched</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="btn-group btn-flex" role="group">
							<button name="generate" class="btn btn-default" disabled>Please Select File.</button>
							<button name="generate-save" class="btn btn-default" disabled><span class="glyphicon glyphicon-save"></span></button>
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul id="generate-multi" class="dropdown-menu dropdown-menu-right">
								@for ($i = 1; $i <= 10; $i++)
								<li><a data-value="{{ $i }}">Generate {{ $i }} seeds</a></li>
								@endfor
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="panel panel-info panel-collapse collapse" id="rom-settings">
				<div class="panel-heading">
					<h4 class="panel-title">ROM Settings</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="row">
							<input id="generate-sram-trace" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
							<label for"generate-sram-trace">SRAM Trace</label>
						</div>
						<div class="secrets" style="display:none">
							<div class="row">
								<input id="generate-debug" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
								<label for"generate-debug">Debug Mode</label>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="input-group" role="group">
								<span class="input-group-addon">Heart Beep</span>
								<select id="heart-speed" class="form-control selectpicker">
									<option value="off">Off</option>
									<option value="normal">Normal Speed</option>
									<option value="half" selected>Half Speed</option>
									<option value="quarter">Quarter Speed</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<div id="seed-details" class="info panel panel-info" style="display:none">
	<div class="panel-heading"><h3 class="panel-title">Seed Details</h3></div>
	<div class="panel-body">
		<div class="col-md-6">
			<div>Logic: <span class="logic"></span></div>
			<div>ROM build: <span class="build"></span></div>
			<div>Rules: <span class="rules"></span></div>
			<div>Mode: <span class="mode"></span></div>
			<div>Seed: <span class="seed"></span></div>
			<div>Complexity: <span class="complexity"></span></div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<button name="save-spoiler" class="btn btn-default" disabled>Save Spoiler</button>
				<button name="save" class="btn btn-default" disabled>Save Rom</button>
			</div>
			<div class="row">
				<input id="generate-complexity-show" type="checkbox" value="true" data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
				<label for"generate-complexity-show">Show Complexity</label>
			</div>
		</div>
		<div class="spoiler col-md-12">
			<div class="spoiler-toggle"><span class="glyphicon glyphicon-plus"></span> Spoiler!</div>
			<div class="spoiler-tabed">
				<ul class="nav nav-pills">
				</ul>
				<div class="tab-content">
				</div>
			</div>
			<div id="spoiler" class="spoiler-text" style="display:none"></div>
		</div>
	</div>
</div>
<form id="config" style="display:none">
	<input type="hidden" name="game_mode" value="NoMajorGlitches" />
	<input type="hidden" name="rules" value="v8" />
	<input type="hidden" name="heart_speed" value="half" />
	<input type="hidden" name="sram_trace" value="false" />
	<input type="hidden" name="debug" value="false" />
	<div class="custom-rules">
		<ul class="nav nav-tabs" data-tabs="tabs">
			<li role="presentation" class="active"><a data-toggle="tab" href="#custom-settings">Custom Settings</a></li>
			<li role="presentation"><a data-toggle="tab" href="#custom-items-advancement">Advancement Items</a></li>
			<li role="presentation"><a data-toggle="tab" href="#custom-items-extra">Other Items</a></li>
			<li role="presentation"><span class="col-md-12 total-items bg-success">Total Items: <span id="custom-count">146</span> / <span id="custom-count-total">146</span></span></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="custom-settings">
				<div class="col-md-6">
					<input id="cust-prize-crossworld" type="checkbox" name="data[alttp.custom.prize.crossWorld]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for"cust-prize-crossworld">Swap Pendants and Crystals Cross World</label>
				</div>
				<div class="col-md-6">
					<input id="cust-prize-shufflePendants" type="checkbox" name="data[alttp.custom.prize.shufflePendants]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for"cust-prize-shufflePendants">Shuffle Pendants</label>
				</div>
				<div class="col-md-6">
					<input id="cust-prize-shuffleCrystals" type="checkbox" name="data[alttp.custom.prize.shuffleCrystals]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for"cust-prize-shuffleCrystals">Shuffle Crystals</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-bossHeartsInPool" type="checkbox" name="data[alttp.custom.region.bossHeartsInPool]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-bossHeartsInPool">Boss Hearts In Pool</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-bossNormalLocation" type="checkbox" name="data[alttp.custom.region.bossNormalLocation]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-bossNormalLocation">Boss Hearts can contain Dungeon Items</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-bossHaveKey" type="checkbox" name="data[alttp.custom.region.bossHaveKey]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-bossHaveKey">Boss Hearts can contain Keys</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-swordShuffle" type="checkbox" name="data[alttp.custom.region.swordShuffle]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-swordShuffle">Shuffle the Swords (within themselves)</label>
				</div>
				<div class="col-md-6">
					<input id="cust-spoil-boots" type="checkbox" name="data[alttp.custom.spoil.BootsLocation]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-spoil-boots">Chance (5%) for boots region to be spoiled by Uncle</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-CompassesMaps" type="checkbox" name="data[alttp.custom.region.CompassesMaps]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-CompassesMaps">Dungeons Contain Compasses and Maps</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-superBunnyDM" type="checkbox" name="data[alttp.custom.region.superBunnyDM]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-superBunnyDM">Allow Moon Pearl on Dark World DM (Super Bunny)</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-bonkItems" type="checkbox" name="data[alttp.custom.region.bonkItems]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-bonkItems">Bonk Keys in Pool</label>
				</div>
				<div class="col-md-6">
					<input id="cust-region-shufflePrizePack" type="checkbox" name="data[alttp.custom.sprite.shufflePrizePack]" value="true" checked data-toggle="toggle" data-on="Yes" data-off="No" data-size="small">
					<label for="cust-region-shufflePrizePack">Shuffle Prize Packs</label>
				</div>
			</div>

			<div class="tab-pane" id="custom-items-advancement">
				<div class="col-md-4">
					<input id="item-count-Bow" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bow]" readonly class="custom-items">
					<label for="item-count-Bow">Bow</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BookOfMudora" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.BookOfMudora]" readonly class="custom-items">
					<label for="item-count-BookOfMudora">Book Of Mudora</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Hammer" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Hammer]" readonly class="custom-items">
					<label for="item-count-Hammer">Hammer</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Hookshot" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Hookshot]" readonly class="custom-items">
					<label for="item-count-Hookshot">Hookshot</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-MagicMirror" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.MagicMirror]" readonly class="custom-items">
					<label for="item-count-MagicMirror">Magic Mirror</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Ocarina" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Ocarina]" readonly class="custom-items">
					<label for="item-count-Ocarina">Ocarina</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-PegasusBoots" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.PegasusBoots]" readonly class="custom-items">
					<label for="item-count-PegasusBoots">Pegasus Boots</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-PowerGlove" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.PowerGlove]" readonly class="custom-items">
					<label for="item-count-PowerGlove">Power Glove</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Cape" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Cape]" readonly class="custom-items">
					<label for="item-count-Cape">Cape</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Mushroom" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Mushroom]" readonly class="custom-items">
					<label for="item-count-Mushroom">Mushroom</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Shovel" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Shovel]" readonly class="custom-items">
					<label for="item-count-Shovel">Shovel</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Lamp" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Lamp]" readonly class="custom-items">
					<label for="item-count-Lamp">Lamp</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Powder" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Powder]" readonly class="custom-items">
					<label for="item-count-Powder">Powder</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-MoonPearl" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.MoonPearl]" readonly class="custom-items">
					<label for="item-count-MoonPearl">Moon Pearl</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-CaneOfSomaria" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.CaneOfSomaria]" readonly class="custom-items">
					<label for="item-count-CaneOfSomaria">Cane Of Somaria</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-FireRod" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.FireRod]" readonly class="custom-items">
					<label for="item-count-FireRod">Fire Rod</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Flippers" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Flippers]" readonly class="custom-items">
					<label for="item-count-Flippers">Flippers</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-IceRod" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.IceRod]" readonly class="custom-items">
					<label for="item-count-IceRod">Ice Rod</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-TitansMitt" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.TitansMitt]" readonly class="custom-items">
					<label for="item-count-TitansMitt">Titans Mitt</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Ether" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Ether]" readonly class="custom-items">
					<label for="item-count-Ether">Ether</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Bombos" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bombos]" readonly class="custom-items">
					<label for="item-count-Bombos">Bombos</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Quake" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Quake]" readonly class="custom-items">
					<label for="item-count-Quake">Quake</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Bottle" type="number" value="1" min="1" max="200" step="1" name="data[alttp.custom.item.count.Bottle]" readonly class="custom-items">
					<label for="item-count-Bottle">Bottle</label>
				</div>
			</div>
			<div class="tab-pane" id="custom-items-extra">
				<div class="col-md-4">
					<input id="item-count-Arrow" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.Arrow]" class="custom-items">
					<label for="item-count-Arrow">Single Arrow</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-TenArrows" type="number" value="4" min="0" max="200" step="1" name="data[alttp.custom.item.count.TenArrows]" class="custom-items">
					<label for="item-count-TenArrows">Arrows (10)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ArrowUpgrade10" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade10]" class="custom-items">
					<label for="item-count-ArrowUpgrade10">Arrow Upgrade (+10)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ArrowUpgrade5" type="number" value="6" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade5]" class="custom-items">
					<label for="item-count-ArrowUpgrade5">Arrow Upgrade (+5)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ArrowUpgrade70" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.ArrowUpgrade70]" class="custom-items">
					<label for="item-count-ArrowUpgrade70">Arrow Upgrade (+70)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BlueMail" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BlueMail]" class="custom-items">
					<label for="item-count-BlueMail">Blue Mail</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Bomb" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.Bomb]" class="custom-items">
					<label for="item-count-Bomb">Single Bomb</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ThreeBombs" type="number" value="10" min="0" max="200" step="1" name="data[alttp.custom.item.count.ThreeBombs]" class="custom-items">
					<label for="item-count-ThreeBombs">Bombs (3)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BombUpgrade10" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade10]" class="custom-items">
					<label for="item-count-BombUpgrade10">Bomb Upgrade (+10)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BombUpgrade5" type="number" value="6" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade5]" class="custom-items">
					<label for="item-count-BombUpgrade5">Bomb Upgrade (+5)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BombUpgrade50" type="number" value="0" min="0" max="200" step="1" name="data[alttp.custom.item.count.BombUpgrade50]" class="custom-items">
					<label for="item-count-BombUpgrade50">Bomb Upgrade (+50)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-Boomerang" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.Boomerang]" class="custom-items">
					<label for="item-count-Boomerang">Blue Boomerang</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-RedBoomerang" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedBoomerang]" class="custom-items">
					<label for="item-count-RedBoomerang">Red Boomerang</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BlueShield" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BlueShield]" class="custom-items">
					<label for="item-count-BlueShield">Blue Shield</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-RedShield" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedShield]" class="custom-items">
					<label for="item-count-RedShield">Red Shield</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-MirrorShield" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.MirrorShield]" class="custom-items">
					<label for="item-count-MirrorShield">Mirror Shield</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BossHeartContainer" type="number" value="10" min="0" max="200" step="1" name="data[alttp.custom.item.count.BossHeartContainer]" class="custom-items">
					<label for="item-count-BossHeartContainer">Boss Heart Container</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-BugCatchingNet" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.BugCatchingNet]" class="custom-items">
					<label for="item-count-BugCatchingNet">Bug Catching Net</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ExtraBottles" type="number" value="3" min="0" max="200" step="1" name="data[alttp.custom.item.count.ExtraBottles]" class="custom-items">
					<label for="item-count-ExtraBottles">Extra Bottles</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-HeartContainer" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.HeartContainer]" class="custom-items">
					<label for="item-count-HeartContainer">Sancturary Heart Container</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-PieceOfHeart" type="number" value="24" min="0" max="200" step="1" name="data[alttp.custom.item.count.PieceOfHeart]" class="custom-items">
					<label for="item-count-PieceOfHeart">Piece Of Heart Container</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-RedMail" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.RedMail]" class="custom-items">
					<label for="item-count-RedMail">Red Mail</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-StaffOfByrna" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.StaffOfByrna]" class="custom-items">
					<label for="item-count-StaffOfByrna">Cane Of Byrna</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-OneRupee" type="number" value="2" min="0" max="200" step="1" name="data[alttp.custom.item.count.OneRupee]" class="custom-items">
					<label for="item-count-OneRupee">Rupee (1)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-FiveRupees" type="number" value="4" min="0" max="200" step="1" name="data[alttp.custom.item.count.FiveRupees]" class="custom-items">
					<label for="item-count-FiveRupees">Rupees (5)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-TwentyRupees" type="number" value="28" min="0" max="200" step="1" name="data[alttp.custom.item.count.TwentyRupees]" class="custom-items">
					<label for="item-count-TwentyRupees">Rupees (20)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-FiftyRupees" type="number" value="7" min="0" max="200" step="1" name="data[alttp.custom.item.count.FiftyRupees]" class="custom-items">
					<label for="item-count-FiftyRupees">Rupees (50)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-OneHundredRupees" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.OneHundredRupees]" class="custom-items">
					<label for="item-count-OneHundredRupees">Rupees (100)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-ThreeHundredRupees" type="number" value="4" min="0" max="200" step="1" name="data[alttp.custom.item.count.ThreeHundredRupees]" class="custom-items">
					<label for="item-count-ThreeHundredRupees">Rupees (300)</label>
				</div>
				<div class="col-md-4">
					<input id="item-count-MagicUpgrade" type="number" value="1" min="0" max="200" step="1" name="data[alttp.custom.item.count.MagicUpgrade]" class="custom-items">
					<label for="item-count-MagicUpgrade">Magic Upgrade (1/2 or 1/4)</label>
				</div>

			</div>
		</div>
	</div>
</form>

<script>
var rom;
var current_rom_hash = '93f0d6800928d17f0bbdf86aba51fa17';
var ROM = ROM || (function(blob, loaded_callback) {
	var u_array;
	var arrayBuffer;

	var fileReader = new FileReader();

	fileReader.onload = function() {
		arrayBuffer = this.result;
	}
	fileReader.onloadend = function() {
		// fill out rom to 2mb
		if (arrayBuffer.byteLength < 2097152) {
			arrayBuffer = resizeUint8(arrayBuffer, 2097152);
		}

		u_array = new Uint8Array(arrayBuffer);

		if (loaded_callback) loaded_callback(this);
	}.bind(this);

	fileReader.readAsArrayBuffer(blob);

	this.checkMD5 = function() {
		return SparkMD5.ArrayBuffer.hash(arrayBuffer);
	};

	this.getArrayBuffer = function() {
		return arrayBuffer;
	};

	this.write = function(seek, bytes) {
		if (!bytes.length) {
			u_array[seek] = bytes;
			return;
		}
		for (var i = 0; i < bytes.length; i++) {
			u_array[seek + i] = bytes[i];
		}
	};

	this.save = function(filename) {
		saveAs(new Blob([u_array]), filename);
	};

	this.parsePatch = function(patch, progressCallback) {
		return new Promise(function(resolve, reject) {
			patch.forEach(function(value, index, array) {
				if (progressCallback) progressCallback(index / patch.length, this);
				for (address in value) {
					this.write(Number(address), value[address]);
				}
			}.bind(this));
			resolve(this);
		}.bind(this));
	};
});

function resizeUint8(baseArrayBuffer, newByteSize) {
	var resizedArrayBuffer = new ArrayBuffer(newByteSize),
		len = baseArrayBuffer.byteLength,
		resizeLen = (len > newByteSize)? newByteSize : len;

	(new Uint8Array(resizedArrayBuffer, 0, resizeLen)).set(new Uint8Array(baseArrayBuffer, 0, resizeLen));

	return resizedArrayBuffer;
}

function applySeed(rom, seed, second_attempt) {
	if (rom.checkMD5() != current_rom_hash) {
		if (second_attempt) {
			$('#seed-generate, #seed-details, #config').hide();
			$('.alert .message').html('Could not reset ROM.');
			$('.alert').show();
			$('#rom-select').show();
			return new Promise(function(resolve, reject) {
				reject(rom);
			});
		}
		return patchRomFromJSON(rom, 'js/romreset.json')
			.then(function(rom) {
				return applySeed(rom, seed, true);
			});
	}
	return new Promise(function(resolve, reject) {
		$.post('/seed' + (seed ? '/' + seed : ''), getFormData($('form#config')), function(patch) {
			rom.parsePatch(patch.patch).then(function(rom) {
				resolve({rom: rom, patch: patch});
			});
		}, 'json')
		.fail(reject);
	});
}

function getFormData($form){
	var unindexed_array = $form.serializeArray();
	var indexed_array = {};

	$.map(unindexed_array, function(n, i){
		indexed_array[n['name']] = n['value'];
	});

	return indexed_array;
}

function patchRomFromJSON(rom, uri) {
	return new Promise(function(resolve, reject) {
		$.getJSON(uri, function(patch) {
			rom.parsePatch(patch).then(function(rom) {
				resolve(rom);
			});
		});
	});
}

function romOk(rom) {
	$('button[name=generate]').html('Generate').prop('disabled', false);
	$('button[name=generate-save]').prop('disabled', false);
	$('#seed-generate').show();
	$('#config').show();
	localforage.setItem('rom', rom.getArrayBuffer());
}

function seedFailed(data) {
	$('button[name=generate]').html('Generate').prop('disabled', false);
	$('button[name=generate-save]').prop('disabled', false);
	$('.alert .message').html('Failed Creating Seed :(');
	$('.alert').show().delay(2000).fadeOut("slow");
}

function seedApplied(data) {
	return new Promise(function(resolve, reject) {
		$('button[name=generate]').html('Generate').prop('disabled', false);
		$('button[name=generate-save]').prop('disabled', false);
		$('.info').show();
		$('.info .seed').html(data.patch.seed);
		$('.info .logic').html(data.patch.logic);
		$('.info .build').html(data.patch.spoiler.meta.build);
		$('.info .mode').html(data.patch.spoiler.meta.mode);
		$('.info .rules').html(data.patch.rules);
		$('.info .complexity').html(data.patch.spoiler.playthrough.vt_complexity + ' (' + data.patch.spoiler.playthrough.complexity + ')');
		$('.spoiler').show();
		$('#spoiler').html('<pre>' + JSON.stringify(data.patch.spoiler, null, 4) + '</pre>');
		pasrseSpoilerToTabs(data.patch.spoiler);
		rom.logic = data.patch.logic;
		rom.build = data.patch.spoiler.meta.build;
		rom.mode = data.patch.spoiler.meta.mode;
		rom.rules = data.patch.rules;
		rom.seed = data.patch.seed;
		rom.spoiler = data.patch.spoiler;
		rom.complexity = data.patch.spoiler.playthrough.complexity;
		rom.vt_complexity = data.patch.spoiler.playthrough.vt_complexity;
		$('button[name=save], button[name=save-spoiler]').show().prop('disabled', false);
		resolve(rom);
	});
}

function pasrseSpoilerToTabs(spoiler) {
	var spoilertabs = $('.spoiler-tabed');
	var nav = spoilertabs.find('.nav-pills');
	var active_nav = nav.find('.active a').html();
	nav.html('');
	var content = spoilertabs.find('.tab-content').html('');

	for (section in spoiler) {
		nav.append($('<li ' + ((section == active_nav) ? 'class="active"' : '') + '><a data-toggle="tab" href="#spoiler-' + section.replace(/ /g, '_') + '">' + section + '</a></li>'));
		content.append($('<div id="spoiler-' + section.replace(/ /g, '_') + '" class="tab-pane' + ((section == active_nav) ? ' active' : '') + '"><pre>' + JSON.stringify(spoiler[section], null, 4) + '</pre></div>'));
	}
}

function loadBlob(blob, show_error) {
	rom = new ROM(blob, function(rom) {
		switch (rom.checkMD5()) {
			case current_rom_hash:
				romOk(rom);
				break;
			case '118597172b984bfffaff1a1b7d06804d':
				patchRomFromJSON(rom, 'js/base2current.json')
					.then(romOk);
				break;
			default:
				// attempt to reset
				patchRomFromJSON(rom, 'js/base2current.json')
				.then(function(rom) {
					patchRomFromJSON(rom, 'js/romreset.json')
					.then(function(rom) {
						if (rom.checkMD5() == current_rom_hash) {
							romOk(rom);
						} else {
							if (show_error) {
								$('.alert .message').html('ROM not recognized. Please try another.');
								$('.alert').show();
							}
							$('#rom-select').show();
						}
					});
				});
				return;
		}
	});
}

$(function() {
	$('.alert, .info, #config, .custom-rules').hide();
	$('button[name=save], button[name=save-spoiler]').hide();
	$('.spoiler').hide();
	$('.spoiler-tabed').hide();
	$('.spoiler-toggle').on('click', function() {
		$(this).next().animate({height: 'toggle'});
		if ($(this).find('span').hasClass('glyphicon-plus')) {
			$(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
		} else {
			$(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		}
	});
	$('#rules').on('change', function() {
		$('.info').hide();
		$('input[name=rules]').val($(this).val());
		localforage.setItem('rom.rules', $(this).val());
		if ($(this).val() == 'custom') {
			$('.custom-rules').show();
			if ($('.spoiler-tabed').is(':visible')) {
				$('.spoiler-toggle').trigger('click');
			}
		} else {
			$('.custom-rules').hide();
		}
	});
	localforage.getItem('rom.rules').then(function(value) {
		if (!value) return;
		$('#rules').val(value);
		$('#rules').trigger('change');
	});

	// Complexity switch
	$('#generate-complexity-show').on('change', function() {
		if ($(this).prop('checked')) {
			$('.complexity').show();
			localforage.setItem('generate.complexity.show', true);
		} else {
			$('.complexity').hide();
			localforage.setItem('generate.complexity.show', false);
		}
	});
	localforage.getItem('generate.complexity.show').then(function(value) {
		$('#generate-complexity-show').prop('checked', value);
		$('#generate-complexity-show').trigger('change');
	});

	$('button[name=save]').on('click', function() {
		return rom.save('ALttP - VT_' + rom.logic + '_' + rom.rules + '-' + rom.mode + '_' + rom.seed + '.sfc');
	});
	$('button[name=save-spoiler]').on('click', function() {
		return saveAs(new Blob([$('.spoiler-text pre').html()]), 'ALttP - VT_' + rom.logic + '_' + rom.rules + '-' + rom.mode + '_' + rom.seed + '.txt');
	});

	$('button[name=generate-save]').on('click', function() {
		applySeed(rom, $('#seed').val())
			.then(seedApplied, seedFailed)
			.then(function(rom) {
				return rom.save('ALttP - VT_' + rom.logic + '_' + rom.rules + '-' + rom.mode + '_' + rom.seed + '.sfc');
			});
	});

	$('button[name=generate]').on('click', function() {
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('button[name=generate-save], button[name=save], button[name=save-spoiler]').prop('disabled', true);
		applySeed(rom, $('#seed').val()).then(seedApplied, seedFailed);
	});

	$('input[name=f2u]').on('change', function() {
		$('#rom-select').hide();
		$('.alert').hide();
		loadBlob(this.files[0], true);
	});

	$('.custom-items').on('change click blur', function(e) {
		e.stopPropagation();
		$('#custom-count').html($('.custom-items').map(function(){return Number(this.value)}).toArray().reduce(function(a,b){return a+b}));
		if ($('#custom-count').html() != $('#custom-count-total').html()) {
			$('.total-items').removeClass('bg-success').addClass('bg-danger');
		} else {
			$('.total-items').removeClass('bg-danger').addClass('bg-success');
		}
	});
	$('.custom-items').first().trigger('change');

	$('#heart-speed').on('change', function() {
		localforage.setItem('rom.heart-speed', $(this).val());
		$('input[name=heart_speed]').val($(this).val());
	});
	localforage.getItem('rom.heart-speed').then(function(value) {
		if (!value) return;
		$('#heart-speed').val(value);
		$('#heart-speed').trigger('change');
	});

	$('#generate-sram-trace').on('change', function() {
		localforage.setItem('rom.sram-trace', $(this).prop('checked'));
		$('input[name=sram_trace]').val($(this).prop('checked'));
	});
	localforage.getItem('rom.sram-trace').then(function(value) {
		if (!value) return;
		$('#generate-sram-trace').prop('checked', value);
		$('#generate-sram-trace').trigger('change');
	});

	$('#game-mode').on('change', function() {
		$('.info').hide();
		localforage.setItem('rom.game-mode', $(this).val());
		$('input[name=game_mode]').val($(this).val());
	});
	localforage.getItem('rom.game-mode').then(function(value) {
		if (!value) return;
		$('#game-mode').val(value);
		$('#game-mode').trigger('change');
	});

	$('#generate-debug').on('change', function() {
		$('input[name=debug]').val($(this).prop('checked'));
	});

	$('#cust-region-CompassesMaps').on('change', function() {
		if ($(this).prop('checked')) {
			$('#custom-count-total').html(Number($('#custom-count-total').html()) - 23);
		} else {
			$('#custom-count-total').html(Number($('#custom-count-total').html()) + 23);
		}
		$('.custom-items').first().trigger('change');
	});

	$('#cust-prize-shuffleCrystals, #cust-prize-shufflePendants').on('change', function() {
		if (!$(this).prop('checked')) {
			$('#cust-prize-crossworld').prop('checked', false).bootstrapToggle('off');
		}
	});
	$('#cust-prize-crossworld').on('change', function() {
		if ($(this).prop('checked')) {
			$('#cust-prize-shuffleCrystals, #cust-prize-shufflePendants').prop('checked', true).bootstrapToggle('on');
		}
	});

	$('#cust-region-bossNormalLocation').on('change', function() {
		if ($(this).prop('checked')) {
			if (!$('#cust-region-bossHeartsInPool').prop('checked')) {
				$('#cust-region-bossHeartsInPool').prop('checked', true).bootstrapToggle('on');
			}
		} else {
			$('#cust-region-bossHaveKey').prop('checked', false).bootstrapToggle('off');
		}

	});
	$('#cust-region-bossHaveKey').on('change', function() {
		if ($(this).prop('checked')) {
			if (!$('#cust-region-bossHeartsInPool').prop('checked')) {
				$('#cust-region-bossHeartsInPool').prop('checked', true).bootstrapToggle('on');
			}
			if (!$('#cust-region-bossNormalLocation').prop('checked')) {
				$('#cust-region-bossNormalLocation').prop('checked', true).bootstrapToggle('on');
			}
		}

	});
	$('#cust-region-bossHeartsInPool').on('change', function() {
		if ($(this).prop('checked')) {
			$('#custom-count-total').html(Number($('#custom-count-total').html()) + 10);
			$('#item-count-BossHeartContainer').val(Number($('#item-count-BossHeartContainer').val()) + 10);
		} else {
			$('#cust-region-bossNormalLocation').prop('checked', false).bootstrapToggle('off');
			$('#cust-region-bossHaveKey').prop('checked', false).bootstrapToggle('off');
			$('#custom-count-total').html(Number($('#custom-count-total').html()) - 10);
			$('#item-count-BossHeartContainer').val(Number($('#item-count-BossHeartContainer').val()) - 10);
		}
		$('.custom-items').first().trigger('change');
	});

	$('#seed-clear').on('click', function() {
		$('#seed').val('');
	});

	$('#generate-multi a').on('click', function() {
		var itters = $(this).data('value');
		var zip = new jszip();
		$('button[name=generate]').html('Generating...').prop('disabled', true);
		$('button[name=generate-save], button[name=save], button[name=save-spoiler]').prop('disabled', true);

		genToZip(zip, itters).then(function(zip) {
			zip.generateAsync({type: "blob", compression: "DEFLATE"})
			.then(function(content) {
				saveAs(content, "VT-alttp-roms.zip");
				$('button[name=generate]').html('Generate').prop('disabled', false);
				$('button[name=generate-save]').prop('disabled', false);
			});
		});

	});

	function genToZip(zip, left) {
		return new Promise(function(resolve, reject) {
			applySeed(rom, $('#seed').val()).then(function(data) {
				var buffer = data.rom.getArrayBuffer().slice(0);
				zip.file('ALttP - VT_' + data.patch.logic + '_' + data.patch.rules + '-' + data.patch.mode + '_' + data.patch.seed + '.sfc', buffer);
				zip.file('spoilers/ALttP - VT_' + data.patch.logic + '_' + data.patch.rules + '-' + data.patch.mode + '_' + data.patch.seed + '.txt', new Blob([JSON.stringify(data.patch.spoiler, null, 4)]));
				if (left - 1 > 0) {
					genToZip(zip, left - 1).then(function() {
						resolve(zip);
					});
				} else {
					resolve(zip);
				}
			});
		});
	}

	// Load ROM from local storage if it's there
	if (localforage.supports(localforage.INDEXEDDB) || localforage.supports(localforage.WEBSQL) || localforage.supports(localforage.LOCALSTORAGE)) {
		$('#rom-select').hide();
		$('.alert').hide();
		localforage.getItem('rom').then(function(blob) {
			loadBlob(new Blob([blob]));
		});
	}

	new secrets(function() {
		$('.secrets').show();
	});
});
</script>
@overwrite
