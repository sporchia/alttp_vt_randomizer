import Prando from "prando";
import PotData from "./potdata";

export default class PotShuffle {
  constructor(seed) {
    this.rand = new Prando(seed);
  }

  shuffle() {
    // JS only makes shallow copies, this assures we are starting from clean data.
    this.pots = JSON.parse(JSON.stringify(PotData));
    this.rand.reset();

    // collect all items
    const potSpecialItems = this.pots
      .filter(
        pot =>
          pot[3] !== null &&
          typeof pot[3] === "string" &&
          ["K", "S", "H"].indexOf(pot[3].charAt(0)) !== -1
      )
      .map(pot => pot[3]);

    const potItems = this.pots
      .filter(
        pot =>
          pot[3] !== null &&
          !(
            typeof pot[3] === "string" &&
            ["K", "S", "H"].indexOf(pot[3].charAt(0)) !== -1
          )
      )
      .map(pot => pot[3]);

    // clear out all pots
    this.pots.forEach(pot => (pot[3] = null));

    // shuffle the pot order
    const newPots = this.fy_shuffle(this.pots);

    // place special items
    potSpecialItems.forEach(item => {
      for (let i = 0; i < newPots.length; i++) {
        if (newPots[i][4].length === 0) {
          continue;
        }

        if (newPots[i][4].indexOf(item) !== -1 && newPots[i][3] === null) {
          newPots[i][3] = item;
          return;
        }
      }
      throw new Error(`no pot available for ${item}`);
    });

    // place simple items
    potItems.forEach(item => {
      for (let i = 0; i < newPots.length; i++) {
        if (newPots[i][3] === null) {
          newPots[i][3] = item;
          return;
        }
      }
      throw new Error(`no pot available for ${item}`);
    });

    const returnPots = {};
    newPots.forEach(pot => {
      if (typeof returnPots[pot[0]] === "undefined") {
        returnPots[pot[0]] = [];
      }
      returnPots[pot[0]].push(pot);
    });

    return returnPots;
  }

  fy_shuffle(array) {
    let new_array = Array.from(array);

    for (let i = array.length - 1; i >= 0; --i) {
      let r = this.rand.nextInt(0, i);
      [new_array[i], new_array[r]] = [new_array[r], new_array[i]];
    }

    return new_array;
  }
}
