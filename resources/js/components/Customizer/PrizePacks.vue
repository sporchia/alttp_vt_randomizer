<template>
  <div class="card border-success">
    <div class="card-header bg-success card-heading-btn card-heading-sticky">
      <h3 class="card-title text-white float-left">Prize Packs</h3>
      <div class="clearfix"></div>
    </div>
    <div class="card-body">
      <div class="sticky-head">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="col w-10">Pack</th>
              <th class="col w-80">Prizes</th>
            </tr>
          </thead>
        </table>
      </div>
      <table class="table table-sm">
        <tbody class="searchable">
          <tr
            v-for="(pack, id) in packs"
            v-if="['pull', 'crab', 'stun', 'fish'].indexOf(id) === -1"
          >
            <td class="col w-10">{{ id }}</td>
            <td class="col w-20">
              <Select :sid="[id, 0]" :value="pack[0]" @input="selectedItem" :options="options" />
              <Select :sid="[id, 4]" :value="pack[4]" @input="selectedItem" :options="options" />
            </td>
            <td class="col w-20">
              <Select :sid="[id, 1]" :value="pack[1]" @input="selectedItem" :options="options" />
              <Select :sid="[id, 5]" :value="pack[5]" @input="selectedItem" :options="options" />
            </td>
            <td class="col w-20">
              <Select :sid="[id, 2]" :value="pack[2]" @input="selectedItem" :options="options" />
              <Select :sid="[id, 6]" :value="pack[6]" @input="selectedItem" :options="options" />
            </td>
            <td class="col w-20">
              <Select :sid="[id, 3]" :value="pack[3]" @input="selectedItem" :options="options" />
              <Select :sid="[id, 7]" :value="pack[7]" @input="selectedItem" :options="options" />
            </td>
          </tr>
          <tr v-if="packs.pull">
            <td class="col w-10">Pull</td>
            <td class="col w-20">
              <Select
                :sid="['pull', 0]"
                :value="packs.pull[0]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20">
              <Select
                :sid="['pull', 1]"
                :value="packs.pull[1]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20">
              <Select
                :sid="['pull', 2]"
                :value="packs.pull[2]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20"></td>
          </tr>
          <tr v-if="packs.crab">
            <td class="col w-10">Crab</td>
            <td class="col w-20">
              <Select
                :sid="['crab', 0]"
                :value="packs.crab[0]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20">
              <Select
                :sid="['crab', 1]"
                :value="packs.crab[1]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20"></td>
            <td class="col w-20"></td>
          </tr>
          <tr v-if="packs.stun">
            <td class="col w-10">Stun</td>
            <td class="col w-20">
              <Select
                :sid="['stun', 0]"
                :value="packs.stun[0]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20"></td>
            <td class="col w-20"></td>
            <td class="col w-20"></td>
          </tr>
          <tr v-if="packs.fish">
            <td class="col w-10">Fish</td>
            <td class="col w-20">
              <Select
                :sid="['fish', 0]"
                :value="packs.fish[0]"
                @input="selectedItem"
                :options="options"
              />
            </td>
            <td class="col w-20"></td>
            <td class="col w-20"></td>
            <td class="col w-20"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Select from "../Select.vue";

export default {
  components: {
    Select
  },
  methods: {
    selectedItem(selectedOption, sid) {
      this.$store.dispatch("prizePacks/setDrop", {
        pack: sid[0],
        slot: sid[1],
        drop: selectedOption
      });
      this.$forceUpdate();
    }
  },
  computed: {
    options() {
      return this.$store.state.settings.droppables;
    },
    packs() {
      return this.$store.state.prizePacks.packs;
    }
  }
};
</script>

<style scoped>
.sticky-head {
  position: sticky;
  top: 143px;
  z-index: 990;
  background-color: white;
}
:deep(.multiselect__input)::placeholder {
  color: #dcdcdc;
}
</style>
