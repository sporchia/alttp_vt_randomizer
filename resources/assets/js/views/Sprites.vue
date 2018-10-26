<template>
	<div>
		<div class="clearfix">
			<input class="search" placeholder="search" type="text" v-model="search" />
		</div>
		<div class="sprite-container">
			<div v-for="sprite in sprites" class="sprite" v-if="sprite.file" v-show="searchEx.test(sprite.name) || searchEx.test(sprite.author)">
				<div :class="'sprite-preview icon-custom-' + sprite.name.replace(/[ \.\(\)]/g, '')"></div>
				<div class="sprite-name">{{ sprite.name }}</div>
				<div class="sprite-author">by: {{ sprite.author }}</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			search: '',
		};
	},
	computed: {
		searchEx ()  {
			return new RegExp(this.search, 'i');
		},
		sprites() {
			return this.$store.state.sprites;
		},
	},
}
</script>

<style scoped>
.search {
	float: right;
	width: 400px;
	margin-bottom: 20px;
}
.sprite-container {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	grid-gap: 10px;
	grid-auto-rows: minmax(100px, auto);
}
.sprite {
	position: relative;
	height: 96px;
}
.sprite-preview {
	position: absolute;
	top: 0;
	left: 0;
	width: 64px;
	height: 96px;
	background-size: auto 96px;
	image-rendering: pixelated;
}
.sprite-name {
	position: absolute;
	top: 20px;
	left: 95px;
	font-weight: bold;
}
.sprite-author {
	position: absolute;
	top: 50px;
	left: 95px;
}
</style>
