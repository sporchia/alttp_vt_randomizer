<template>
  <div class="spoiler col-md-12">
    <div class="spoiler-toggle" @click="clickShow">
      <img v-if="!show" src="/i/svg/plus.svg" />
      <img v-if="show" src="/i/svg/minus.svg" />
      Spoiler!
    </div>
    <div v-if="show" class="spoiler-tabed">
      <div class="row">
        <div class="col">
          <vt-select
            v-if="locations.length"
            v-model="search_location"
            id="location-search"
            clearable="true"
            :options="locations"
            placeholder="Search for Location"
          ></vt-select>
        </div>
        <div class="col">
          <vt-select
            v-if="items.length"
            v-model="search"
            id="item-search"
            clearable="true"
            :options="items"
            placeholder="Search for Item"
          ></vt-select>
        </div>
      </div>
      <tabs>
        <tab
          v-for="(value, section) in regions"
          :key="section"
          :name="section"
          :count="Object.values(value).filter(item => item == search.value).length
						+ Object.keys(value).filter(location => location == search_location.value).length"
        >
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="w-50">Location</th>
                <th class="w-50">Item</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, location) in value"
                :key="location"
                class="spoil-item-location"
                :class="{ 'bg-info text-light': item == search.value
								|| location == search_location.value }"
              >
                <td>{{ location.indexOf(':') === -1 ? location : location.split(':')[0] }}</td>
                <td v-if="item.indexOf(':') !== -1" class="item">
                  {{ $te('item["' + item.split(':')[0] + '"]') ? $t('item["' + item.split(':')[0] + '"]') : item.split(':')[0] }}
                  <template
                    v-if="meta.world_id !== Number(item.split(':')[1])"
                  >(player {{ item.split(':')[1] }})</template>
                </td>
                <td
                  v-if="item.indexOf(':') === -1"
                  class="item"
                >{{ $te('item["' + item + '"]') ? $t('item["' + item + '"]') : item }}</td>
              </tr>
            </tbody>
          </table>
        </tab>
        <tab v-if="paths" key="paths" name="Paths">
          <div v-for="(rows, location) in paths" :key="location" class="row border-top">
            <div class="col-4">{{ location }}</div>
            <div class="col-8">
              <table class="table table-striped table-sm mb-0">
                <thead>
                  <tr>
                    <th class="w-50 border-top-0">Region</th>
                    <th class="w-50 border-top-0">Entrance/Exit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in rows" :key="row[0]">
                    <td class="w-50">{{ row[0] }}</td>
                    <td class="w-50">{{ row[1] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </tab>
        <tab
          v-if="shops"
          key="shops"
          name="Shops"
          :count="Object.values(shops).filter((item) => {
						return search !== '' && [item.item_0, item.item_1, item.item_2].indexOf(search.value) !== -1;
					}).length"
        >
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="col-auto">Location</th>
                <th class="col-auto">Type</th>
                <th class="col-auto">Item 1</th>
                <th class="col-auto">Item 2</th>
                <th class="col-auto">Item 3</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="row in shops"
                :key="row.location"
                class="spoil-item-location"
                :class="{ 'bg-info text-light': search !== '' && [row.item_0, row.item_1, row.item_2].indexOf(search.value) !== -1 }"
              >
                <td>{{ row.location }}</td>
                <td>{{ row.type }}</td>
                <td class="item">
                  <span v-if="row.item_0">
                    {{ row.item_0.item }}
                    <span
                      v-if="row.item_0 && row.item_0.price"
                    >({{ row.item_0.price }})</span>
                  </span>
                </td>
                <td class="item">
                  <span v-if="row.item_1">
                    {{ row.item_1.item }}
                    <span
                      v-if="row.item_1 && row.item_1.price"
                    >({{ row.item_1.price }})</span>
                  </span>
                </td>
                <td class="item">
                  <span v-if="row.item_2">
                    {{ row.item_2.item }}
                    <span
                      v-if="row.item_2 && row.item_2.price"
                    >({{ row.item_2.price }})</span>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </tab>
        <tab
          v-if="playthrough"
          key="playthrough"
          name="Playthrough"
          :count="Object.values(playthrough).filter((item) => { return item.item == search.value; }).length"
        >
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="col-auto">Sphere</th>
                <th v-if="!entrances" class="col-auto">Region</th>
                <th class="col-auto">Location</th>
                <th class="col-auto">Item</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="row in playthrough"
                :key="row.location"
                class="spoil-item-location"
                :class="{ 'bg-info text-light': row.item == search.value }"
              >
                <td>{{ row.sphere }}</td>
                <td v-if="!entrances">{{ row.region }}</td>
                <td>{{ row.location }}</td>
                <td v-if="row.item.indexOf(':') !== -1" class="item">
                  {{ $te('item["' + row.item.split(':')[0] + '"]') ? $t('item["' + row.item.split(':')[0] + '"]') : row.item.split(':')[0] }}
                  <template
                    v-if="meta.world_id !== Number(row.item.split(':')[1])"
                  >(player {{ row.item.split(':')[1] }})</template>
                </td>
                <td
                  v-if="row.item.indexOf(':') === -1"
                  class="item"
                >{{ $te('item["' + row.item + '"]') ? $t('item["' + row.item + '"]') : row.item }}</td>
              </tr>
            </tbody>
          </table>
        </tab>
        <tab v-if="entrances" key="entrances" name="Entrances">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="col-auto">Entrance</th>
                <th class="col-auto"></th>
                <th class="col-auto">Exit</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="row in entrances"
                :key="row.entrance + row.exit"
                class="spoil-item-location"
              >
                <td>{{ row.entrance }}</td>
                <td>{{ row.direction == 'both' ? '↔' : '→' }}</td>
                <td>{{ row.exit }}</td>
              </tr>
            </tbody>
          </table>
        </tab>
        <tab v-if="meta" key="meta" name="meta">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th class="w-50">Setting</th>
                <th class="w-50">Value</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(value, setting) in meta" :key="setting" class="spoil-item-location">
                <td>{{ setting }}</td>
                <td>{{ value }}</td>
              </tr>
            </tbody>
          </table>
        </tab>
      </tabs>
    </div>
  </div>
</template>

<script>
import Tabs from "./VTTabs.vue";
import Tab from "./VTTab.vue";

export default {
  components: {
    Tabs: Tabs,
    Tab: Tab
  },
  props: ["rom", "value"],
  data() {
    return {
      show: false,
      search: "",
      search_location: ""
    };
  },
  created() {
    if (this.value) {
      this.show = this.value;
    }
  },
  methods: {
    clickShow() {
      this.show = !this.show;
      this.$emit("input", this.show);
    }
  },
  computed: {
    regions: vm => {
      let regions = {};
      for (let name in vm.rom.spoiler) {
        if (
          ["meta", "playthrough", "Entrances", "paths", "Shops"].indexOf(
            name
          ) === -1
        ) {
          regions[name] = vm.rom.spoiler[name];
        }
      }
      return regions;
    },
    shops: vm => {
      const match = /([\w\s()+]+)(\s*—\s*(\d+))/;
      return typeof vm.rom.spoiler.Shops !== "undefined"
        ? vm.rom.spoiler.Shops.map(shop => {
            let returnObject = { ...shop };

            if (!match.test(shop.item_0)) {
              ["item_0", "item_1", "item_2"].forEach(slot => {
                if (!returnObject[slot]) {
                  return;
                }

                let key =
                  typeof returnObject[slot] !== "string"
                    ? returnObject[slot].item.indexOf(":") !== -1
                      ? returnObject[slot].item.split(":")[0]
                      : returnObject[slot].item
                    : returnObject[slot];

                returnObject[slot] = {
                  item: i18n.te(`item.${key}`) ? i18n.t(`item.${key}`) : key,
                  price: returnObject[slot].price
                    ? returnObject[slot].price
                    : null
                };
              });

              return returnObject;
            }

            ["item_0", "item_1", "item_2"].forEach(slot => {
              if (typeof shop[slot] !== "string") {
                return;
              }

              let { "1": name, "3": price } = shop[slot].match(match);
              returnObject[slot] = { item: name, price: Number(price) };
            });

            return returnObject;
          })
        : false;
    },
    entrances: vm => {
      return typeof vm.rom.spoiler.Entrances !== "undefined"
        ? vm.rom.spoiler.Entrances
        : false;
    },
    playthrough: vm => {
      let playthrough = [];
      let spoiler = vm.rom.spoiler.playthrough;
      if (!spoiler) {
        return false;
      }
      if (typeof vm.rom.spoiler.Entrances !== "undefined") {
        Object.keys(spoiler).forEach(sphere => {
          Object.keys(spoiler[sphere]).forEach(location => {
            playthrough.push({
              sphere: sphere,
              location:
                location.indexOf(":") === -1
                  ? location
                  : location.split(":")[0],
              item: vm.rom.spoiler.playthrough[sphere][location]
            });
          });
        });
      } else {
        Object.keys(spoiler).forEach(sphere => {
          Object.keys(spoiler[sphere]).forEach(region => {
            Object.keys(spoiler[sphere][region]).forEach(location => {
              playthrough.push({
                sphere: sphere,
                region: region,
                location:
                  location.indexOf(":") === -1
                    ? location
                    : location.split(":")[0],
                item: vm.rom.spoiler.playthrough[sphere][region][location]
              });
            });
          });
        });
      }
      return playthrough;
    },
    paths: vm => {
      return typeof vm.rom.spoiler.paths !== "undefined"
        ? vm.rom.spoiler.paths
        : false;
    },
    meta: vm => {
      return typeof vm.rom.spoiler.meta !== "undefined"
        ? vm.rom.spoiler.meta
        : false;
    },
    items: vm => {
      let items = {};
      for (let name in vm.rom.spoiler) {
        if (
          [
            "meta",
            "playthrough",
            "Entrances",
            "paths",
            "Shops",
            "Bosses"
          ].indexOf(name) === -1
        ) {
          Object.keys(vm.rom.spoiler[name]).forEach(location => {
            items[vm.rom.spoiler[name][location]] = true;
          });
        }
      }
      return Object.keys(items)
        .sort()
        .map(item => {
          let world_id = Number(item.split(":")[1]);
          var nice_name =
            item.indexOf(":") === -1
              ? vm.$i18n.te("item." + item)
                ? vm.$i18n.t("item." + item)
                : item
              : vm.$i18n.te("item." + item.split(":")[0])
              ? vm.$i18n.t("item." + item.split(":")[0])
              : item.split(":")[0];

          if (!isNaN(world_id) && vm.rom.spoiler.meta.world_id !== world_id) {
            nice_name += " (player " + world_id + ")";
          }
          return { name: nice_name, value: item };
        });
    },
    locations: vm => {
      let locations = {};
      for (let name in vm.rom.spoiler) {
        if (
          ["meta", "playthrough", "Entrances", "paths", "Shops"].indexOf(
            name
          ) === -1
        ) {
          Object.keys(vm.rom.spoiler[name]).forEach(location => {
            locations[location] = true;
          });
        }
      }
      return Object.keys(locations)
        .sort()
        .map(location => {
          return {
            name:
              location.indexOf(":") === -1 ? location : location.split(":")[0],
            value: location
          };
        });
    }
  }
};
</script>
