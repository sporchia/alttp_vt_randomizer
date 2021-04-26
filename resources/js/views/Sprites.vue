<template>
  <div>
    <div class="clearfix">
      <span>Showing {{ count }} of {{ sprites.length }} sprites</span>
      <input class="search" placeholder="search" type="text" v-model="search" />
    </div>
    <div class="sprite-container">
      <div
        v-for="sprite in sprites"
        :key="sprite.file"
        class="sprite"
        v-show="searchEx.test(sprite.name) || searchEx.test(sprite.author)"
      >
        <div :class="'sprite-preview icon-custom-' + sprite.name.replace(/[ \.\(\)\']/g, '')"></div>
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
      search: ""
    };
  },
  created() {
    this.$store.dispatch("getSprites");
  },
  computed: {
    searchEx() {
      return new RegExp(this.search, "i");
    },
    count() {
      return this.sprites.filter(sprite => {
        return (
          this.searchEx.test(sprite.name) || this.searchEx.test(sprite.author)
        );
      }).length;
    },
    sprites() {
      return this.$store.state.sprites.filter(sprite => sprite.file && sprite.author !== 'Nintendo');
    }
  }
};
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
