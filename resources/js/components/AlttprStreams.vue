<template>
  <div>
    <div v-if="streams.length" class="streams">
      <div v-for="stream in streams" :key="stream.name" class="stream">
        <a :href="stream.href" target="_blank" rel="noopener noreferrer">
          <picture>
            <source media="(max-width: 800px)" :srcset="stream.imgs[128]" />
            <source media="(max-width: 1000px)" :srcset="stream.imgs[256]" />
            <img :src="stream.imgs[512]" alt="Wormhole" />
          </picture>
          <div class="info">
            <span class="name">{{ stream.name }}</span>
            {{ stream.title | truncate(120) }}
          </div>
        </a>
      </div>
    </div>
    <div v-else>Sorry No live streams available right now... Check back later!</div>
  </div>
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
          this.streams = response.data.streams;
        })
        .catch(() => {
          this.streams = [];
        });
    }
  }
};
</script>

<style lang="scss" scoped>
$radius: 3px;
.streams {
  .stream {
    display: flex;
    width: 100%;
    border: 1px solid lightgray;
    padding: 1em;
    margin: 1em 0;
    -webkit-border-radius: $radius;
    -moz-border-radius: $radius;
    -ms-border-radius: $radius;
    border-radius: $radius;
  }

  a {
    display: flex;
    flex-direction: row;
    text-decoration: none;
    color: #636b6f;
  }
  picture {
    padding-right: 10px;
  }
  .info {
    font-size: 1em;
    flex: 1 1 auto;
    @media (max-width: 800px) {
      font-size: 0.8em;
    }
  }
  .name {
    display: block;
    font-weight: bold;
    font-size: 3em;
    @media (max-width: 1000px) {
      font-size: 2em;
    }
    @media (max-width: 800px) {
      font-size: 1.5em;
    }
  }
}
</style>
