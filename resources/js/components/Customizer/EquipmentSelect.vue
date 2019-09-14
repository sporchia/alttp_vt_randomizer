<template>
  <div class="card border-success">
    <div class="card-header bg-success">
      <h3 class="card-title text-white">Equipment</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="cell">
          <div class="row">
            <div class="cell">
              <div
                @click="incrementItem('ProgressiveArmor')"
                :class="[items.ProgressiveArmor ? 'active-' + items.ProgressiveArmor : '', {active: items.ProgressiveArmor}]"
                class="item ProgressiveArmor active"
              ></div>
              <div
                @click="incrementItem('ProgressiveSword')"
                :class="[items.ProgressiveSword ? 'active-' + items.ProgressiveSword : '', {active: items.ProgressiveSword}]"
                class="item ProgressiveSword"
              ></div>
              <div
                @click="incrementItem('ProgressiveShield')"
                :class="[items.ProgressiveShield ? 'active-' + items.ProgressiveShield : '', {active: items.ProgressiveShield}]"
                class="item ProgressiveShield"
              ></div>
              <div
                @click="toggleItem('MoonPearl')"
                :class="{active: items.MoonPearl}"
                class="item MoonPearl"
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div
                @click="incrementItem('Bottle1')"
                :class="[items.Bottle1 ? 'active-' + items.Bottle1 : '', {active: items.Bottle1}]"
                class="item Bottle"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="incrementItem('Bottle2')"
                :class="[items.Bottle2 ? 'active-' + items.Bottle2 : '', {active: items.Bottle2}]"
                class="item Bottle"
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div
                @click="incrementItem('Bottle3')"
                :class="[items.Bottle3 ? 'active-' + items.Bottle3 : '', {active: items.Bottle3}]"
                class="item Bottle"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="incrementItem('Bottle4')"
                :class="[items.Bottle4 ? 'active-' + items.Bottle4 : '', {active: items.Bottle4}]"
                class="item Bottle"
              ></div>
            </div>
          </div>
        </div>
        <div class="cell">
          <div class="row">
            <div class="cell">
              <div
                @click="incrementItem('ProgressiveBow')"
                :class="[items.ProgressiveBow ? 'active-' + items.ProgressiveBow : '', {active: items.ProgressiveBow}]"
                class="item ProgressiveBow"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="incrementItem('Boomerang')"
                :class="[items.Boomerang ? 'active-' + items.Boomerang : '', {active: items.Boomerang}]"
                class="item Boomerang"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Hookshot')"
                :class="{active: items.Hookshot}"
                class="item Hookshot"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Mushroom')"
                :class="{active: items.Mushroom}"
                class="item Mushroom"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Powder')"
                :class="{active: items.Powder}"
                class="item Powder"
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div
                @click="toggleItem('FireRod')"
                :class="{active: items.FireRod}"
                class="item FireRod"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('IceRod')"
                :class="{active: items.IceRod}"
                class="item IceRod"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Bombos')"
                :class="{active: items.Bombos}"
                class="item Bombos"
              ></div>
            </div>
            <div class="cell">
              <div @click="toggleItem('Ether')" :class="{active: items.Ether}" class="item Ether"></div>
            </div>
            <div class="cell">
              <div @click="toggleItem('Quake')" :class="{active: items.Quake}" class="item Quake"></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div @click="toggleItem('Lamp')" :class="{active: items.Lamp}" class="item Lamp"></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Hammer')"
                :class="{active: items.Hammer}"
                class="item Hammer"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Shovel')"
                :class="{active: items.Shovel}"
                class="item Shovel"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('BugCatchingNet')"
                :class="{active: items.BugCatchingNet}"
                class="item BugCatchingNet"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('BookOfMudora')"
                :class="{active: items.BookOfMudora}"
                class="item BookOfMudora"
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div class="item empty"></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('CaneOfSomaria')"
                :class="{active: items.CaneOfSomaria}"
                class="item CaneOfSomaria"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('CaneOfByrna')"
                :class="{active: items.CaneOfByrna}"
                class="item CaneOfByrna"
              ></div>
            </div>
            <div class="cell">
              <div @click="toggleItem('Cape')" :class="{active: items.Cape}" class="item Cape"></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('MagicMirror')"
                :class="{active: items.MagicMirror}"
                class="item MagicMirror"
              ></div>
            </div>
          </div>
          <div class="row">
            <div class="cell">
              <div
                @click="toggleItem('PegasusBoots')"
                :class="{active: items.PegasusBoots}"
                class="item PegasusBoots"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="incrementItem('ProgressiveGlove')"
                :class="[items.ProgressiveGlove ? 'active-' + items.ProgressiveGlove : '', {active: items.ProgressiveGlove}]"
                class="item ProgressiveGlove"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="toggleItem('Flippers')"
                :class="{active: items.Flippers}"
                class="item Flippers"
              ></div>
            </div>
            <div class="cell">
              <div
                @click="incrementItem('Ocarina')"
                :class="[items.Ocarina ? 'active-' + items.Ocarina : '', {active: items.Ocarina}]"
                class="item Ocarina"
              ></div>
            </div>
            <div class="cell">
              <div class="item empty"></div>
            </div>
          </div>
        </div>
        <div class="cell ml-4">
          <div class="row">
            <div class="cell w-100">
              <vue-slider
                ref="slider"
                @drag-end="saveEquipment"
                :min="1"
                :max="20"
                v-model="items.BossHeartContainer"
              ></vue-slider>
            </div>
          </div>
          <div class="row">
            <div id="custom-equipment-hearts" class="cell" style="width:321px;height:80px;">
              <div
                v-for="n in items.BossHeartContainer"
                :key="n"
                class="Heart"
                style="display:inline-block"
              ></div>
            </div>
          </div>
          <div class="row">
            <text-field
              v-model="items.Rupees"
              type="number"
              style="width:321px"
              placeholder="amount"
              maxlength="4"
              @input="saveEquipment"
            >
              Rupees
              <template slot="tooltip">Minimum: 0, Maximum: 9999</template>
            </text-field>
          </div>
          <div class="row mt-4">
            <div class="cell shm">
              <div
                @click="toggleItem('PendantOfCourage')"
                :class="{active: items.PendantOfCourage}"
                class="item PendantOfCourage"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('PendantOfPower')"
                :class="{active: items.PendantOfPower}"
                class="item PendantOfPower"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('PendantOfWisdom')"
                :class="{active: items.PendantOfWisdom}"
                class="item PendantOfWisdom"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal1')"
                :class="{active: items.Crystal1}"
                class="item Crystal1"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal2')"
                :class="{active: items.Crystal2}"
                class="item Crystal2"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal3')"
                :class="{active: items.Crystal3}"
                class="item Crystal3"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal4')"
                :class="{active: items.Crystal4}"
                class="item Crystal4"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal5')"
                :class="{active: items.Crystal5}"
                class="item Crystal5"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal6')"
                :class="{active: items.Crystal6}"
                class="item Crystal6"
              ></div>
            </div>
            <div class="cell shm">
              <div
                @click="toggleItem('Crystal7')"
                :class="{active: items.Crystal7}"
                class="item Crystal7"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TextField from "../TextField.vue";
import localforage from "localforage";
import vueSlider from "vue-slider-component";
import "vue-slider-component/theme/default.css";

export default {
  components: {
    TextField,
    vueSlider
  },
  props: ["value"],
  data() {
    return {
      items: {
        ProgressiveArmor: 0,
        ProgressiveSword: 0,
        ProgressiveShield: 0,
        MoonPearl: false,

        ProgressiveBow: 0,
        Boomerang: 0,
        Hookshot: false,
        Mushroom: false,
        Powder: false,

        FireRod: false,
        IceRod: false,
        Bombos: false,
        Ether: false,
        Quake: false,

        Lamp: false,
        Hammer: false,
        Shovel: false,
        BugCatchingNet: false,
        BookOfMudora: false,

        Bottle1: 0,
        Bottle2: 0,
        Bottle3: 0,
        Bottle4: 0,
        CaneOfSomaria: false,
        CaneOfByrna: false,
        Cape: false,
        MagicMirror: false,

        PegasusBoots: false,
        ProgressiveGlove: 0,
        Flippers: false,
        Ocarina: 0,

        PendantOfCourage: false,
        PendantOfWisdom: false,
        PendantOfPower: false,

        Crystal1: false,
        Crystal2: false,
        Crystal3: false,
        Crystal4: false,
        Crystal5: false,
        Crystal6: false,
        Crystal7: false,

        BossHeartContainer: 3,

        Rupees: 0,

        empty: false
      }
    };
  },
  mounted() {
    localforage
      .getItem("vt.custom.equipment")
      .then(value => {
        if (value === null) {
          return;
        }
        this.items = value;
      })
      .then(() => {
        this.$emit("input", this.selectedEq);
      });
  },
  methods: {
    counter(value, delta, max, min) {
      min = min || 0;
      value += delta;

      if (value > max) value = min;
      if (value < min) value = max;
      return value;
    },
    counters(delta, limits) {
      return function(item) {
        var max = limits[item].max,
          min = limits[item].min;

        return (this.items[item] = this.counter(
          this.items[item],
          delta,
          max,
          min
        ));
      };
    },
    increment(name) {
      var inc = this.counters(1, {
        ProgressiveArmor: { max: 2 },
        ProgressiveSword: { max: 4 },
        ProgressiveShield: { max: 3 },
        Bottle1: { max: 7 },
        Bottle2: { max: 7 },
        Bottle3: { max: 7 },
        Bottle4: { max: 7 },
        ProgressiveBow: { max: 3 },
        Boomerang: { max: 3 },
        ProgressiveGlove: { max: 2 },
        Ocarina: { max: 2 }
      }).bind(this);

      return inc(name);
    },
    incrementItem(name) {
      this.increment(name);
      this.saveEquipment();
    },
    toggleItem(name) {
      this.items[name] = !this.items[name];
      this.saveEquipment();
    },
    saveEquipment() {
      localforage.setItem("vt.custom.equipment", this.items);
      this.$emit("input", this.selectedEq);
    }
  },
  computed: {
    selectedEq() {
      var starting_equipment = [];
      var keys = Object.keys(this.items).filter(item => {
        return this.items[item];
      });
      for (var i = 0; i < keys.length; ++i) {
        if (typeof this.items[keys[i]] === "boolean") {
          starting_equipment.push(keys[i]);
        } else if (keys[i] == "ProgressiveBow") {
          starting_equipment.push(
            ["nothing", "SilverArrowUpgrade", "Bow", "BowAndSilverArrows"][
              this.items[keys[i]]
            ]
          );
        } else if (keys[i] == "Boomerang") {
          switch (this.items[keys[i]]) {
            case 3:
              starting_equipment.push("RedBoomerang"); // fall through
            case 1:
              starting_equipment.push("Boomerang");
              break;
            case 2:
              starting_equipment.push("RedBoomerang");
              break;
          }
        } else if (keys[i] == "Ocarina") {
          switch (this.items[keys[i]]) {
            case 2:
              starting_equipment.push("OcarinaActive");
              break;
            case 1:
              starting_equipment.push("OcarinaInactive");
              break;
          }
        } else if (keys[i] == "Rupees") {
          starting_equipment = starting_equipment.concat(this.rupees);
        } else if (keys[i].match(/^Bottle/)) {
          switch (this.items[keys[i]]) {
            case 1:
              starting_equipment.push("Bottle");
              break;
            case 2:
              starting_equipment.push("BottleWithRedPotion");
              break;
            case 3:
              starting_equipment.push("BottleWithGreenPotion");
              break;
            case 4:
              starting_equipment.push("BottleWithBluePotion");
              break;
            case 5:
              starting_equipment.push("BottleWithBee");
              break;
            case 6:
              starting_equipment.push("BottleWithGoldBee");
              break;
            case 7:
              starting_equipment.push("BottleWithFairy");
              break;
          }
        } else {
          for (var j = 0; j < this.items[keys[i]]; ++j) {
            starting_equipment.push(keys[i]);
          }
        }
      }
      return starting_equipment;
    },
    rupees() {
      let rupees = [];
      let value = Math.min(Math.floor(Number(this.items.Rupees)), 9999);
      if (value < 1) {
        return rupees;
      }

      rupees = rupees.concat(
        Array(Math.floor(value / 300)).fill("ThreeHundredRupees")
      );
      value %= 300;

      rupees = rupees.concat(
        Array(Math.floor(value / 100)).fill("OneHundredRupees")
      );
      value %= 100;

      rupees = rupees.concat(Array(Math.floor(value / 50)).fill("FiftyRupees"));
      value %= 50;

      rupees = rupees.concat(
        Array(Math.floor(value / 20)).fill("TwentyRupees")
      );
      value %= 20;

      rupees = rupees.concat(Array(Math.floor(value / 5)).fill("FiveRupees"));
      value %= 5;

      rupees = rupees.concat(Array(Math.floor(value)).fill("OneRupee"));

      return rupees;
    }
  }
};
</script>

<style scoped>
.shm {
  margin: 0.1rem;
}
.card-body {
  background-color: #c0c0c0;
}

.row {
  margin: auto;
}
.row:before,
.row:after {
  content: " ";
  display: table;
}
.row:after {
  clear: both;
}
.cell {
  position: relative;
  float: left;
}

.ProgressiveArmor {
  width: 128px;
  height: 128px;
}
.ProgressiveSword {
  position: absolute;
  top: 12px;
  right: -8px;
}
.ProgressiveShield {
  position: absolute;
  bottom: 0;
  left: 0;
}
.MoonPearl {
  width: 48px;
  height: 48px;
  position: absolute;
  bottom: 0;
  right: 0;
}

.item {
  opacity: 0.25;
}
.item.active,
.ProgressiveArmor {
  opacity: 1;
}

.icon {
  width: 16px;
  height: 16px;
  display: inline-block;
  background-size: 100% 100%;
  vertical-align: text-bottom;
}

.ProgressiveBow,
.ProgressiveArmor,
.ProgressiveSword,
.ProgressiveShield,
.MoonPearl,
.Boomerang,
.Hookshot,
.Mushroom,
.Powder,
.FireRod,
.IceRod,
.Bombos,
.Ether,
.Quake,
.Lamp,
.Hammer,
.Shovel,
.BugCatchingNet,
.BookOfMudora,
.Bottle,
.CaneOfSomaria,
.CaneOfByrna,
.Cape,
.MagicMirror,
.PegasusBoots,
.ProgressiveGlove,
.Flippers,
.Ocarina,
.Heart,
.PendantOfCourage,
.PendantOfWisdom,
.PendantOfPower,
.Crystal1,
.Crystal2,
.Crystal3,
.Crystal4,
.Crystal5,
.Crystal6,
.Crystal7,
.empty {
  background-image: url(data:image/png;base64,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);
  background-repeat: no-repeat;
  display: block;
}
.Bombos {
  width: 64px;
  height: 64px;
  background-position: 0 0;
}

.BookOfMudora {
  width: 64px;
  height: 64px;
  background-position: -64px 0;
}

.Boomerang {
  width: 64px;
  height: 64px;
  background-position: -128px 0;
}

.Boomerang.active-2 {
  width: 64px;
  height: 64px;
  background-position: -192px 0;
}

.Boomerang.active-3 {
  width: 64px;
  height: 64px;
  background-position: -256px 0;
}

.PegasusBoots {
  width: 64px;
  height: 64px;
  background-position: -320px 0;
}

.Bottle,
.Bottle.active-1 {
  /* empty */
  width: 64px;
  height: 64px;
  background-position: -384px 0;
}

.Bottle.active-6 {
  /* gold bee */
  width: 64px;
  height: 64px;
  background-position: -448px 0;
}

.Bottle.active-3 {
  /* blue potion */
  width: 64px;
  height: 64px;
  background-position: 0 -64px;
}

.Bottle.active-4 {
  /* green potion */
  width: 64px;
  height: 64px;
  background-position: -64px -64px;
}

.Bottle.active-2 {
  /* red potion */
  width: 64px;
  height: 64px;
  background-position: -128px -64px;
}

.Bottle.active-5 {
  /* bee */
  width: 64px;
  height: 64px;
  background-position: -64px -384px;
}

.Bottle.active-7 {
  /* fairy */
  width: 64px;
  height: 64px;
  background-position: 0 -384px;
}

.ProgressiveBow {
  width: 64px;
  height: 64px;
  background-position: -192px -64px;
}

.ProgressiveBow.active-1 {
  width: 64px;
  height: 64px;
  background-position: -256px -64px;
}

.ProgressiveBow.active-2 {
  width: 64px;
  height: 64px;
  background-position: -320px -64px;
}

.ProgressiveBow.active-3 {
  width: 64px;
  height: 64px;
  background-position: -384px -64px;
}

.CaneOfByrna {
  width: 64px;
  height: 64px;
  background-position: -448px -64px;
}

.Cape {
  width: 64px;
  height: 64px;
  background-position: 0 -128px;
}

.Ether {
  width: 64px;
  height: 64px;
  background-position: -64px -128px;
}

.FireRod {
  width: 64px;
  height: 64px;
  background-position: -128px -128px;
}

.Flippers {
  width: 64px;
  height: 64px;
  background-position: -192px -128px;
}

.Ocarina {
  width: 64px;
  height: 64px;
  background-position: -256px -128px;
}
.Ocarina.active-2 {
  width: 64px;
  height: 64px;
  background-position: -519px -128px;
}

.ProgressiveGlove {
  width: 64px;
  height: 64px;
  background-position: -320px -128px;
}

.ProgressiveGlove.active-2 {
  width: 64px;
  height: 64px;
  background-position: -384px -128px;
}

.Hammer {
  width: 64px;
  height: 64px;
  background-position: -448px -128px;
}

.Hookshot {
  width: 64px;
  height: 64px;
  background-position: 0 -192px;
}

.IceRod {
  width: 64px;
  height: 64px;
  background-position: -64px -192px;
}

.Lamp {
  width: 64px;
  height: 64px;
  background-position: -128px -192px;
}

.MagicMirror {
  width: 64px;
  height: 64px;
  background-position: -192px -192px;
}

.MoonPearl {
  width: 48px;
  height: 48px;
  background-position: -256px -192px;
}

.Mushroom {
  width: 64px;
  height: 64px;
  background-position: -304px -192px;
}

.BugCatchingNet {
  width: 64px;
  height: 64px;
  background-position: -368px -192px;
}

.Powder {
  width: 64px;
  height: 64px;
  background-position: -432px -192px;
}

.PendantOfCourage {
  width: 32px;
  height: 32px;
  background-position: -519px -196px;
}

.PendantOfWisdom {
  width: 32px;
  height: 32px;
  background-position: -551px -196px;
}

.PendantOfPower {
  width: 32px;
  height: 32px;
  background-position: -551px -228px;
}

.Crystal1,
.Crystal2,
.Crystal3,
.Crystal4,
.Crystal7 {
  width: 32px;
  height: 32px;
  background-position: -519px -228px;
}

.Crystal5,
.Crystal6 {
  width: 32px;
  height: 32px;
  background-position: -519px -260px;
}

.Quake {
  width: 64px;
  height: 64px;
  background-position: 0 -256px;
}

.ProgressiveShield {
  width: 64px;
  height: 64px;
  background-position: 64px 64px;
}

.ProgressiveShield.active-1 {
  width: 64px;
  height: 64px;
  background-position: -64px -256px;
}

.ProgressiveShield.active-2 {
  width: 64px;
  height: 64px;
  background-position: -128px -256px;
}

.ProgressiveShield.active-3 {
  width: 64px;
  height: 64px;
  background-position: -192px -256px;
}

.Shovel {
  width: 64px;
  height: 64px;
  background-position: -256px -256px;
}

.CaneOfSomaria {
  width: 64px;
  height: 64px;
  background-position: -320px -256px;
}

.ProgressiveSword {
  width: 64px;
  height: 64px;
  background-position: 64px 64px;
}

.ProgressiveSword.active-1 {
  width: 64px;
  height: 64px;
  background-position: -384px -256px;
}

.ProgressiveSword.active-2 {
  width: 64px;
  height: 64px;
  background-position: -448px -256px;
}

.ProgressiveSword.active-3 {
  width: 64px;
  height: 64px;
  background-position: 0 -320px;
}

.ProgressiveSword.active-4 {
  width: 64px;
  height: 64px;
  background-position: -64px -320px;
}

.ProgressiveArmor {
  width: 128px;
  height: 128px;
  background-position: -128px -320px;
}

.ProgressiveArmor.active-1 {
  width: 128px;
  height: 128px;
  background-position: -256px -320px;
}

.ProgressiveArmor.active-2 {
  width: 128px;
  height: 128px;
  background-position: -384px -320px;
}

.Heart {
  width: 32px;
  height: 32px;
  background-position: -518px 0px;
}

#health-slider {
  width: 300px;
  margin: 0 10px 10px 10px;
}

.empty {
  width: 64px;
  height: 64px;
  background-position: 64px 64px;
}
</style>
