<template>
  <div class="card border-success" :class="{'border-danger': unevenCount}">
    <div
      class="card-header bg-success card-heading-btn card-heading-sticky"
      :class="{'bg-danger': unevenCount}"
    >
      <h3 class="card-title text-white float-left">
        Item Pool {{ itemCount + placedItemCount }} / {{ max }}
        <span
          v-if="itemCount + placedItemCount < max"
        >({{ max - itemCount - placedItemCount}} empty locations)</span>
      </h3>
      <div class="btn-toolbar float-right">
        <input id="items-filter" placeholder="search" type="text" v-model="search" />
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="card-body">
      <div class="sticky-head">
        <table class="table table-sm">
          <thead>
            <tr>
              <th class="col w-25">
                Randomly Place ({{ itemCount }})
                <img
                  class="icon"
                  @click="manualOnly = !manualOnly"
                  :src="manualOnly ? '/i/svg/x.svg' : '/i/svg/eye.svg'"
                  alt="filter"
                />
              </th>
              <th class="col w-25">
                Manually Placed ({{ placedItemCount }})
                <img
                  class="icon"
                  @click="placedOnly = !placedOnly"
                  :src="placedOnly ? '/i/svg/x.svg' : '/i/svg/eye.svg'"
                  alt="filter"
                />
              </th>
              <th class="col w-50">Item Name</th>
            </tr>
          </thead>
        </table>
      </div>
      <table class="table table-sm">
        <tbody class="searchable">
          <tr
            v-for="item in orderedItems"
            :key="item.name"
            v-show="searchEx.test($t(item.name))
						&& (!placedOnly || item.placed) && (!manualOnly || item.count)"
          >
            <td class="col w-25">
              <input
                type="number"
                :value="item.count"
                @input="itemCountChanged($event, item)"
                min="0"
                :max="max"
                step="1"
                class="input-sm custom-items"
              />
            </td>
            <td class="col w-25">
              <input
                :value="item.placed"
                type="number"
                min="0"
                :max="max"
                step="1"
                readonly
                tabindex="-1"
                class="custom-placed input-sm"
              />
            </td>
            <td class="col w-50">
              <label>{{ $t(item.name) }}</label>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      max: 216,
      manualOnly: false,
      placedOnly: false
    };
  },
  methods: {
    itemCountChanged(e, item) {
      this.$store.dispatch("itemLocations/setItemCount", {
        item: item,
        count: e.target.value
      });

      this.$emit("input", e.target.value);
    }
  },
  computed: {
    searchEx() {
      return new RegExp(this.search, "i");
    },
    orderedItems() {
      return this.$store.state.itemLocations.pool.items
        .slice()
        .filter(item => Object.prototype.hasOwnProperty.call(item, "count"))
        .sort((a, b) => {
          var nameA = a.name.toUpperCase();
          var nameB = b.name.toUpperCase();
          if (nameA < nameB) return -1;
          if (nameA > nameB) return 1;
          return 0;
        });
    },
    unevenCount() {
      return this.placedItemCount + this.itemCount != this.max;
    },
    placedItemCount() {
      if (!this.orderedItems.length) {
        return 0;
      }
      return this.orderedItems
        .filter(item => {
          return item.orderedItems !== "auto_fill";
        })
        .map(item => {
          return Number(item.placed || 0);
        })
        .reduce((carry, placed) => {
          return carry + placed;
        });
    },
    itemCount() {
      if (!this.orderedItems.length) {
        return 0;
      }
      return this.orderedItems
        .map(item => {
          return Number(item.count || 0);
        })
        .reduce((carry, count) => {
          return carry + count;
        });
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
.icon {
  width: 12px;
  height: 12px;
}
</style>
