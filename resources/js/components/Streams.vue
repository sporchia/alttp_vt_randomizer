<template>
  <li v-if="streams.length" class="nav-item dropdown">
    <a
      href="#"
      class="nav-link dropdown-toggle"
      data-toggle="dropdown"
      role="button"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <div class="led-green"></div>&nbsp;Live Streams
      <span class="caret"></span>
    </a>
    <div class="dropdown-menu">
      <a v-for="stream in streams" :key="stream.name" class="dropdown-item" :href="stream.href">
        <img :src="stream.imgs[64]" />
        <div class="info">
          <span class="name">{{ stream.name }}</span>
          {{ stream.title | truncate(30) }}
        </div>
      </a>
    </div>
  </li>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      streams: [],
      interval: null
    };
  },
  beforeDestroy() {
    clearInterval(this.interval);
  },
  created() {
    this.updateStreams();
    this.interval = setInterval(this.updateStreams, 60000);
  },
  methods: {
    updateStreams() {
      axios
        .get(`/api/streams`)
        .then(response => {
          this.streams = response.data.dev_streams;
        })
        .catch(() => {
          this.streams = [];
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.dropdown-item {
  display: flex;
  img {
    padding-right: 10px;
  }
  .name {
    display: block;
    font-weight: bold;
  }
  .info {
    flex: 1 1 auto;
  }
}
</style>
