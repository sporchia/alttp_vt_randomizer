<template>
	<div>
		<div class="tabs">
			<ul class="nav" :class="'nav-' + navType">
				<li class="nav-item" v-for="tab in tabs">
					<a class="nav-link" :class="{ 'active': tab.isActive }" :href="tab.href" @click="selectTab(tab)">
						{{ tab.name }}
						<span v-if="tab.count" class="badge badge-pill badge-secondary">{{ tab.count }}</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="tabs-details">
			<slot></slot>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		navType: {default: 'pills'},
	},
	data() {
		return {
			tabs: [],
			activeTab: null,
		};
	},

	created() {
		this.tabs = this.$children;
	},
	mounted() {
		if (window.location.hash) {
			this.selectTabHref(window.location.hash);
		}
	},
	methods: {
		selectTab(selectedTab) {
			this.tabs.forEach(tab => {
				tab.isActive = (tab.href == selectedTab.href);
				if (tab.isActive) {
					this.activeTab = tab.href;
				}
			});
		},
		selectTabHref(href) {
			this.tabs.forEach(tab => {
				tab.isActive = (tab.href == href);
				if (tab.isActive) {
					this.activeTab = tab.href;
				}
			});
		}
	}
}
</script>
