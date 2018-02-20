@section('equipment')
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Starting Equipment</h3>
	</div>
	<div class="panel-body" id="equipment-selector">
		<div class="row">
			<div id="tracker" class="cell">
				<div class="row">
					<div class="cell">
						<div class="row">
							<div class="cell">
								<div class="equipment item ProgressiveArmor active" data-item="ProgressiveArmor"></div>
								<div class="equipment item ProgressiveSword" data-item="ProgressiveSword"></div>
								<div class="equipment item ProgressiveShield" data-item="ProgressiveShield"></div>
								<div class="equipment item MoonPearl" data-item="MoonPearl"></div>
							</div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item Bottle1 Bottle" data-item="Bottle1"></div></div>
							<div class="cell"><div class="equipment item Bottle2 Bottle" data-item="Bottle2"></div></div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item Bottle3 Bottle" data-item="Bottle3"></div></div>
							<div class="cell"><div class="equipment item Bottle4 Bottle" data-item="Bottle4"></div></div>
						</div>
					</div>
					<div class="cell">
						<div class="row">
							<div class="cell"><div class="equipment item ProgressiveBow" data-item="ProgressiveBow"></div></div>
							<div class="cell"><div class="equipment item Boomerang" data-item="Boomerang"></div></div>
							<div class="cell"><div class="equipment item Hookshot" data-item="Hookshot"></div></div>
							<div class="cell"><div class="equipment item Mushroom" data-item="Mushroom"></div></div>
							<div class="cell"><div class="equipment item Powder" data-item="Powder"></div></div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item FireRod" data-item="FireRod"></div></div>
							<div class="cell"><div class="equipment item IceRod" data-item="IceRod"></div></div>
							<div class="cell"><div class="equipment item Bombos" data-item="Bombos"></div></div>
							<div class="cell"><div class="equipment item Ether" data-item="Ether"></div></div>
							<div class="cell"><div class="equipment item Quake" data-item="Quake"></div></div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item Lamp" data-item="Lamp"></div></div>
							<div class="cell"><div class="equipment item Hammer" data-item="Hammer"></div></div>
							<div class="cell"><div class="equipment item Shovel" data-item="Shovel"></div></div>
							<div class="cell"><div class="equipment item BugCatchingNet" data-item="BugCatchingNet"></div></div>
							<div class="cell"><div class="equipment item BookOfMudora" data-item="BookOfMudora"></div></div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item empty"></div></div>
							<div class="cell"><div class="equipment item CaneOfSomaria" data-item="CaneOfSomaria"></div></div>
							<div class="cell"><div class="equipment item CaneOfByrna" data-item="CaneOfByrna"></div></div>
							<div class="cell"><div class="equipment item Cape" data-item="Cape"></div></div>
							<div class="cell"><div class="equipment item MagicMirror" data-item="MagicMirror"></div></div>
						</div>
						<div class="row">
							<div class="cell"><div class="equipment item PegasusBoots" data-item="PegasusBoots"></div></div>
							<div class="cell"><div class="equipment item ProgressiveGlove" data-item="ProgressiveGlove"></div></div>
							<div class="cell"><div class="equipment item Flippers" data-item="Flippers"></div></div>
							<div class="cell"><div class="equipment item OcarinaInactive" data-item="OcarinaInactive"></div></div>
							<div class="cell"><div class="equipment item empty"></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	var items = {
		ProgressiveArmor: 0,
		ProgressiveSword: 0,
		ProgressiveShield: 0,
		MoonPearl: false,

		ProgressiveBow: 0,
		Boomerang: 0,
		Hookshot: false,
		Mushroom: false,
		Powder: false,

		FireRod: false,
		IceRod: false,
		Bombos: false,
		Ether: false,
		Quake: false,

		Lamp: false,
		Hammer: false,
		Shovel: false,
		BugCatchingNet: false,
		BookOfMudora: false,

		Bottle1: 0,
		Bottle2: 0,
		Bottle3: 0,
		Bottle4: 0,
		CaneOfSomaria: false,
		CaneOfByrna: false,
		Cape: false,
		MagicMirror: false,

		PegasusBoots: false,
		ProgressiveGlove: 0,
		Flippers: false,
		OcarinaInactive: false,

		empty: false,
	};

	function counter(value, delta, max, min) {
		min = min || 0;
		value += delta;

		if (value > max) value = min;
		if (value < min) value = max;
		return value;
	};

	function counters(delta, limits) {
		return function(item) {
			var max = limits[item].max,
				min = limits[item].min;

			return items[item] = counter(items[item], delta, max, min);
		};
	};

	function increment(name) {
		var inc = counters(1, {
			ProgressiveArmor: { max: 2 },
			ProgressiveSword: { max: 4 },
			ProgressiveShield: { max: 3 },
			Bottle1: { max: 7 },
			Bottle2: { max: 7 },
			Bottle3: { max: 7 },
			Bottle4: { max: 7 },
			ProgressiveBow: { max: 3 },
			Boomerang: { max: 3 },
			ProgressiveGlove: { max: 2 }
		});

		return inc(name);
	}

	function toggle_item(target) {
		var name = item_name(target.classList);
		if ((typeof items[name]) === 'boolean') {
			items[name] = !items[name];
			target.classList[items[name] ? 'add' : 'remove']('active');
		} else {
			var value = increment(name);
			target.className = target.className.replace(/ ?active-\w+/, '');
			if (value) {
				target.classList.add('active');
				target.classList.add('active-' + value);
			} else {
				target.classList.remove('active');
			}
		}
	}

	function item_name(class_list) {
		var terms = ['item', 'active', 'equipment'];
		return Array.from(class_list).filter(function(x) { return !(terms.includes(x) || x.match(/^active-/)); })[0];
	}

	localforage.getItem('vt.custom.equipment').then(function(value) {
		if (value !== null) {
			for (id in value) {
				var inc = value[id];

				if (typeof inc === 'boolean') {
					inc = inc ? 1 : 0;
				}
				for (var i = 0; i < inc; ++i) {
					toggle_item($('#equipment-selector .' + id)[0]);
				}
			}
		}

		$('.equipment').on('click', function() {
			toggle_item(this);

			localforage.setItem('vt.custom.equipment', items);
		});
	});

});
</script>
@overwrite
