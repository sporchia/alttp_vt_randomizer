<template>
	<div>
		<div class="tabs" :class="{'nav-tabs-sticky': sticky}">
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
import EventBus from '../core/event-bus';

export default {
	props: {
		navType: {default: 'pills'},
		sticky: {default: false},
		defaultTab: {default: null},
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
		EventBus.$on('selectTabHref', this.selectTabHref);
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
			if (!this.activeTab) {
				window.location.hash = this.defaultTab || this.tabs[0].href;
				this.selectTabHref(window.location.hash);
			}
		}
	}
}
</script>

<style scoped>
.nav-tabs-sticky {
	background-color: #EEEEEE;
}
</style>
