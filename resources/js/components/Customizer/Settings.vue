<template>
  <div class="card border-success">
    <div class="card-header bg-success">
      <h3 class="card-title text-white">Settings</h3>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <Toggle :value="context['prize.crossWorld']" @input="toggle($event, 'prize.crossWorld')">
            Swap Pendants and Crystals Cross World
            <template
              slot="tooltip"
            >If No, pendants are restricted to the light world and crystals to the dark world. If Yes, both can be in either world. Either way both are able to be randomized.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle
            :value="context['prize.shufflePendants']"
            @input="toggle($event, 'prize.shufflePendants')"
          >
            Shuffle Pendants
            <template
              slot="tooltip"
            >If No, pendants are as they are in the vanilla game. If Yes, pendants are shuffled.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle
            :value="context['prize.shuffleCrystals']"
            @input="toggle($event, 'prize.shuffleCrystals')"
          >
            Shuffle Crystals
            <template
              slot="tooltip"
            >If No, crystals are as they are in the vanilla game. If Yes, crystals are shuffled.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle
            :value="context['region.bossNormalLocation']"
            @input="toggle($event, 'region.bossNormalLocation')"
          >
            Bosses can drop Dungeon Items
            <template
              slot="tooltip"
            >If No, bosses will not drop Maps/Compasses/Keys. If Yes, bosses may drop any item.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle
            :value="context['spoil.BootsLocation']"
            @input="toggle($event, 'spoil.BootsLocation')"
          >
            Uncle spoils boots location.
            <template
              slot="tooltip"
            >Only applies to Standard Mode. If No, Uncle will always say something random. If Yes, Uncle will give a hint as to the location of the boots.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle :value="context['rom.mapOnPickup']" @input="toggle($event, 'rom.mapOnPickup')">
            Only display Crystals/Pendants on Map Pickup
            <template
              slot="tooltip"
            >If No, the overworld map will show uncollected crystals and pendants over their respective dungeons. If Yes, the overworld map will only display uncollected crystals and pendants if Link has collected their respective maps.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle
            :value="context['item.require.Lamp']"
            @input="toggle($event, 'item.require.Lamp')"
          >
            Allow dark room navigation
            <template
              slot="tooltip"
            >If yes, logic will not check to make sure lamps are available before dark rooms.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle :value="context['rom.freeItemText']" @input="toggle($event, 'rom.freeItemText')">
            Show text box on dungeon item pickup
            <template
              slot="tooltip"
            >If No, keys, maps, and compasses picked up outside of dungeons will not indicate which dungeon they belong to on pickup. If Yes, a text box will be displayed on pickup that states their dungeon.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle :value="context['rom.freeItemMenu']" @input="toggle($event, 'rom.freeItemMenu')">
            Show dungeon item table in menu
            <template
              slot="tooltip"
            >If No, the menu will behave as it does in the vanilla game. If Yes, key collection information will be displayed at the bottom of the item menu.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle
            :value="context['region.wildCompasses']"
            @input="toggle($event, 'region.wildCompasses')"
          >
            Compasses shuffled outside dungeon
            <template
              slot="tooltip"
            >If No, compasses that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed compasses.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle :value="context['region.wildMaps']" @input="toggle($event, 'region.wildMaps')">
            Maps shuffled outside dungeon
            <template
              slot="tooltip"
            >If No, maps that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed maps.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle :value="context['region.wildKeys']" @input="toggle($event, 'region.wildKeys')">
            Small Keys shuffled outside dungeon
            <template
              slot="tooltip"
            >If No, small keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed small keys.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle
            :value="context['region.wildBigKeys']"
            @input="toggle($event, 'region.wildBigKeys')"
          >
            Big Keys shuffled outside dungeon
            <template
              slot="tooltip"
            >If No, big keys that are randomly placed will be restricted to their respective dungeons. If Yes, they will be able to be randomly placed in any item location. This does not affect manually placed big keys.</template>
          </Toggle>
        </div>
        <div class="col">
          <Toggle :value="context['rom.rupeeBow']" @input="toggle($event, 'rom.rupeeBow')">
            Rupee Bow
            <template
              slot="tooltip"
            >Zelda 1 style Bow that consumes rupees, will also remove arrows as drops and replace them with blue rupees.</template>
          </Toggle>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <Toggle :value="context['rom.genericKeys']" @input="toggle($event, 'rom.genericKeys')">
            Generic Small Keys
            <template
              slot="tooltip"
            >All Small keys will be converted to Generic keys.</template>
          </Toggle>
        </div>
        <div class="col"></div>
      </div>
      <div class="clearfix"></div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.Goal.Required']"
            type="number"
            placeholder="pieces"
            max="216"
            @input="toggle($event, 'item.Goal.Required')"
          >
            Goal Items
            <template
              slot="tooltip"
            >Only applies to Triforce Hunt. The number of triforce pieces required to complete the game.</template>
          </text-field>
        </div>
        <div class="col">
          <Select :value="timerMode" @input="selectItem($event, 'rom.timerMode')" :options="timers">
            Timer
            <template
              slot="tooltip"
            >Sets the behavior of the in game timer. Stopwatch will count up, while countdown will count down. When the countdown timer hits 0, what happens depends on the option selected. OHKO will send Link into one hit knockout mode, and taking any damage will cause death. Continue will cause the timer to continue counting down past zero. Stop will cause the timer to stop at zero. Outside of OHKO, the value of the timer has no effect on gameplay.</template>
          </Select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['rom.timerStart']"
            type="number"
            placeholder="seconds"
            maxlength="9"
            @input="toggle($event, 'rom.timerStart')"
          >
            Timer Start
            <template slot="tooltip">The starting value of the timer in seconds.</template>
          </text-field>
        </div>
        <div class="col">
          <text-field
            :value="context['item.value.GreenClock']"
            type="number"
            placeholder="seconds"
            maxlength="9"
            @input="toggle($event, 'item.value.GreenClock')"
          >
            Green Clock
            <template
              slot="tooltip"
            >The amount of time in seconds a Green Clock will add to the timer. This value can be negative.</template>
          </text-field>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.value.BlueClock']"
            type="number"
            placeholder="seconds"
            maxlength="9"
            @input="toggle($event, 'item.value.BlueClock')"
          >
            Blue Clock
            <template
              slot="tooltip"
            >The amount of time in seconds a Blue Clock will add to the timer. The value can be negative.</template>
          </text-field>
        </div>
        <div class="col">
          <text-field
            :value="context['item.value.RedClock']"
            type="number"
            placeholder="seconds"
            maxlength="9"
            @input="toggle($event, 'item.value.RedClock')"
          >
            Red Clock
            <template
              slot="tooltip"
            >The amount of time in seconds a Red Clock will add to the timer. The value can be negative.</template>
          </text-field>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.value.Rupoor']"
            type="number"
            placeholder="rupees to take away"
            maxlength="9"
            @input="toggle($event, 'item.value.Rupoor')"
          >
            Rupoor Value
            <template
              slot="tooltip"
            >The amount of rupees a Rupoor will subtract from Link's total when collected.</template>
          </text-field>
        </div>
        <div class="col">
          <Select
            :value="dungeonCount"
            @input="selectItem($event, 'rom.dungeonCount')"
            :options="dungeonCounts"
          >
            Dungeon Counts
            <template
              slot="tooltip"
            >Show's the count of the collected dungeon items. This will be overridden if Timer is enabled.</template>
          </Select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.overflow.count.PieceOfHeart']"
            type="number"
            placeholder="pieces"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.PieceOfHeart')"
          >
            Maximum Heart Pieces
            <template
              slot="tooltip"
            >The maximum number of pieces of heart Link can aquire.</template>
          </text-field>
        </div>
        <div class="col">
          <text-field
            :value="context['item.overflow.count.BossHeartContainer']"
            type="number"
            placeholder="containers"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.BossHeartContainer')"
          >
            Maximum Boss Heart Container
            <template
              slot="tooltip"
            >The maximum number Boss Heart Containers Link can aquire.</template>
          </text-field>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.overflow.count.Sword']"
            type="number"
            placeholder="swords"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.Sword')"
          >
            Maximum Swords
            <template
              slot="tooltip"
            >The maximum number swords Link can aquire.</template>
          </text-field>
        </div>
        <div class="col">
          <text-field
            :value="context['item.overflow.count.Armor']"
            type="number"
            placeholder="armors"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.Armor')"
          >
            Maximum Armor Upgrades
            <template
              slot="tooltip"
            >The maximum number armor upgrades Link can aquire.</template>
          </text-field>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <text-field
            :value="context['item.overflow.count.Shield']"
            type="number"
            placeholder="shields"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.Shield')"
          >
            Maximum Shield Upgrades
            <template
              slot="tooltip"
            >The maximum number shield upgrades Link can aquire.</template>
          </text-field>
        </div>
        <div class="col">
          <text-field
            :value="context['item.overflow.count.Bow']"
            type="number"
            placeholder="bows"
            maxlength="9"
            @input="toggle($event, 'item.overflow.count.Bow')"
          >
            Maximum Bow Upgrades
            <template
              slot="tooltip"
            >The maximum number bow upgrades Link can aquire.</template>
          </text-field>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Toggle from "../Toggle.vue";
import TextField from "../TextField.vue";
import Select from "../Select.vue";

export default {
  components: {
    Toggle: Toggle,
    TextField: TextField,
    Select: Select
  },
  data() {
    return {
      timerLookup: {},
      dungeonCountLookup: {},
      timers: [
        { value: "off", name: "customizer.settings.timers.off" },
        { value: "stopwatch", name: "customizer.settings.timers.stopwatch" },
        {
          value: "countdown-ohko",
          name: "customizer.settings.timers.countdown-ohko"
        },
        {
          value: "countdown-continue",
          name: "customizer.settings.timers.countdown-continue"
        },
        {
          value: "countdown-stop",
          name: "customizer.settings.timers.countdown-stop"
        }
      ],
      dungeonCounts: [
        {
          value: "off",
          name: "customizer.settings.dungeon_count.off"
        },
        {
          value: "pickup",
          name: "customizer.settings.dungeon_count.pickup"
        },
        {
          value: "on",
          name: "customizer.settings.dungeon_count.on"
        }
      ]
    };
  },
  created() {
    this.timers.forEach(timer => {
      this.timerLookup[timer.value] = timer;
    });
    this.dungeonCounts.forEach(thing => {
      this.dungeonCountLookup[thing.value] = thing;
    });
  },
  methods: {
    toggle(value, key) {
      this.$store.dispatch("context/setSetting", {
        key: key,
        value: value
      });
    },
    selectItem(selectOption, key) {
      this.$store.dispatch("context/setSetting", {
        key: key,
        value: selectOption.value
      });
    }
  },
  computed: {
    context() {
      return this.$store.state.context.settings;
    },
    timerMode() {
      return this.timerLookup[
        this.$store.state.context.settings["rom.timerMode"]
      ];
    },
    dungeonCount() {
      return this.dungeonCountLookup[
        this.$store.state.context.settings["rom.dungeonCount"]
      ];
    }
  }
};
</script>
