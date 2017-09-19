@section('rom-spoiler')
<div class="spoiler col-md-12">
	<div class="spoiler-toggle"><span class="glyphicon glyphicon-plus"></span> Spoiler!</div>
	<div class="spoiler-tabed">
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<select id="spoiler-search" class="form-control selectpicker" data-live-search="true" data-dropup-auto="false" title="Search for Item">
			</select>
		</div>
		<ul class="nav nav-pills" role="tablist">
		</ul>
		<div class="tab-content">
		</div>
	</div>
	<div id="spoiler" class="spoiler-text" style="display:none"></div>
</div>

<script>
$('#spoiler-search').on('changed.bs.select', function() {
	var string = $(this).val();
	tabsContent.forEach(function(val, nav) {
		var numItems = val.reduce(function(n, item) {
			return n + (item == string);
		}, 0);
		$('#n-' + nav + ' .badge').html(numItems || null);
		$('.spoil-item-location.info').removeClass('info');
		$('.spoil-item-location td.item').filter(function() {
			return $(this).text() === string;
		}).parent().addClass('info');
	});
});

var tabsContent = new Map();
function pasrseSpoilerToTabs(spoiler) {
	var spoilertabs = $('.spoiler-tabed');
	var nav = spoilertabs.find('.nav-pills');
	var active_nav = nav.find('.active a').data('section');
	nav.html('');
	var content = spoilertabs.find('.tab-content').html('');
	var items = {};
	for (section in spoiler) {
		nav.append($('<li id="n-spoiler-' + section.replace(/ /g, '_') + '" '
			+ ((section == active_nav) ? 'class="active"' : '') + '><a data-toggle="tab" data-section="' + section
			+ '" href="#spoiler-' + section.replace(/ /g, '_') + '">' + section
			+ '<span class="badge badge-pill"></span></a></li>'));
		if (['entrances'].indexOf(section) !== -1) {
			var table = $('<table class="table table-striped"><thead><tr><th>Entrance</th><th>Direction</th><th>Exit</th></tr></thead><tbody></tbody></table>');
			var tbody = table.find('tbody');
			for (loc in spoiler[section]) {
				tbody.append($('<tr class="spoil-item-location"><td class="col-md-5">' + spoiler[section][loc].entrance
					+ '</td><td class="col-md-2">' + (spoiler[section][loc].direction == 'both' ? '↔' : '→') + '</td><td class="col-md-5">'
					+ spoiler[section][loc].exit + '</td></tr>'));
			};
			content.append($('<div id="spoiler-' + section.replace(/ /g, '_') + '" class="tab-pane'
				+ ((section == active_nav) ? ' active' : '') + '">'
				+ '</div>').append(table));
		} else if (['playthrough'].indexOf(section) === -1) {
			var table = $('<table class="table table-striped"><thead><tr><th>Location</th><th>Item</th></tr></thead><tbody></tbody></table>');
			var tbody = table.find('tbody');
			for (loc in spoiler[section]) {
				tbody.append($('<tr class="spoil-item-location"><td class="col-md-6">'
					+ loc + '</td><td class="item">' + spoiler[section][loc] + '</td></tr>'));
			};
			content.append($('<div id="spoiler-' + section.replace(/ /g, '_') + '" class="tab-pane'
				+ ((section == active_nav) ? ' active' : '') + '">'
				+ '</div>').append(table));
		} else {
			content.append($('<div id="spoiler-' + section.replace(/ /g, '_') + '" class="tab-pane'
				+ ((section == active_nav) ? ' active' : '') + '"><pre>' + JSON.stringify(spoiler[section], null, 4)
				+ '</pre></div>'));
		}
		if (['meta', 'playthrough', 'Fountains', 'Medallions'].indexOf(section) === -1) {
			tabsContent.set('spoiler-' + section.replace(/ /g, '_'), Object.keys(spoiler[section]).map(function (key) {
				return spoiler[section][key];
			}));
		}
		for (loc in spoiler[section]) {
			if (['meta', 'playthrough', 'Fountains', 'Medallions'].indexOf(section) > -1) continue;
			items[spoiler[section][loc]] = true;
		}
		var sopts = '';
		Object.keys(items).sort().forEach(function(item) {
			sopts += '<option value="' + item + '">' + item + '</option>';
		});
		$('#spoiler-search').html(sopts).selectpicker('refresh');
	}
}
</script>
@overwrite
