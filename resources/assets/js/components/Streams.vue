<template>
	<li v-if="streams.length" class="nav-item dropdown">
		<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><div class="led-green"></div> &nbsp;Live Streams <span class="caret"></span></a>
		<div class="dropdown-menu">
			<a v-for="stream in streams" class="dropdown-item" :href="stream.href"><img :src="stream.img" /> {{ stream.name }}</a>
		</div>
	</li>
</template>

<script>
export default {
	data() {
		return {
			streams: [],
			interval: null,
			twitchBites: {
				60822872: {
					href: 'https://www.twitch.tv/veetorp',
					name: 'Veetorp',
				},
				21361989: {
					href: 'https://www.twitch.tv/christosowen',
					name: 'ChristosOwen',
				},
				31157663: {
					href: 'https://www.twitch.tv/mmxbass',
					name: 'Karkat',
				},
				51443649: {
					href: 'https://www.twitch.tv/zarby89',
					name: 'Zarby',
				},
				28393030: {
					href: 'https://www.twitch.tv/myramong',
					name: 'Myramong',
				},
			},
		};
	},
	beforeDestroy() {
		clearInterval(this.interval);
	},
	created() {
		this.updateStreams();
		this.interval = setInterval(this.updateStreams, 300000);
	},
	methods: {
		updateStreams() {
			axios.get(`https://api.twitch.tv/helix/streams?user_login=veetorp&user_login=christosowen&user_login=mmxbass&user_login=zarby89&user_login=myramong`, {headers:{'Client-ID': 'ba12ilssnn7m9fz3fa0cwnbwr9rjrf'}}).then((response) => {
				let streams = [];
				response.data.data.forEach((stream) => {
					if (!this.twitchBites[stream.user_id]) {
						return;
					}
					streams.push({
						href: this.twitchBites[stream.user_id].href,
						img: stream.thumbnail_url.replace('{width}', 64).replace('{height}', 36),
						name: this.twitchBites[stream.user_id].name,
					});
				});
				this.streams = streams;
			}).catch((error) => {
				this.streams = [];
			});
		},
	},
};
</script>

