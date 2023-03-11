import Prando from "prando";
import { fy_shuffle, int16_as_bytes, snes_to_pc } from "./utils";

export default class SFX {
  constructor(seed) {
    this.rand = new Prando(seed);
  }

  /**
   * Create a sfx object
   * @param name - human readable name - arbitrarily assigned
   * @param sfx_set - which sfx set this original belongs to 2 or 3 (1 exists but we are not shuffling it)
   * @param orig_id - the original id of the sfx
   * @param addr - the address where to write the randomized values
   * @param chain the sfx that will play after this one (point to all accompaniments
   * @param accomp whether this sfxis purely to accompany another
   * @return an sfx object
   */
  static create_sfx(name, sfx_set, orig_id, addr, chain, accomp = false) {
    return {
      name: name,
      sfx_set: sfx_set,
      orig_id: orig_id,
      addr: addr,
      chain: chain,
      accomp: accomp,

      target_set: undefined,  //what set this sfx has been randomized to
      target_id: undefined, //what id this sfx has been randomized to
      target_chain: undefined, //where the chained sfx have been randomized to
    };
  }

  static init_sfx_data() {
    return [
      SFX.create_sfx("Slash1", 0x02, 0x01, 0x2614, []),
      SFX.create_sfx("Slash2", 0x02, 0x02, 0x2625, []),
      SFX.create_sfx("Slash3", 0x02, 0x03, 0x2634, []),
      SFX.create_sfx("Slash4", 0x02, 0x04, 0x2643, []),
      SFX.create_sfx("Wall clink", 0x02, 0x05, 0x25dd, []),
      SFX.create_sfx("Bombable door clink", 0x02, 0x06, 0x25d7, []),
      SFX.create_sfx("Fwoosh shooting", 0x02, 0x07, 0x25b7, []),
      SFX.create_sfx("Arrow hitting wall", 0x02, 0x08, 0x25e3, []),
      SFX.create_sfx("Boomerang whooshing", 0x02, 0x09, 0x25ad, []),
      SFX.create_sfx("Hookshot", 0x02, 0x0a, 0x25c7, []),
      SFX.create_sfx("Placing bomb", 0x02, 0x0b, 0x2478, []),
      SFX.create_sfx("Bomb exploding/Quake/Bombos/Exploding wall",0x02,0x0c,0x269c,[]),
      SFX.create_sfx("Powder", 0x02, 0x0d, 0x2414, [0x3f]),
      SFX.create_sfx("Fire rod shot", 0x02, 0x0e, 0x2404, []),
      SFX.create_sfx("Ice rod shot", 0x02, 0x0f, 0x24c3, []),
      SFX.create_sfx("Hammer use", 0x02, 0x10, 0x23fa, []),
      SFX.create_sfx("Hammering peg", 0x02, 0x11, 0x23f0, []),
      SFX.create_sfx("Digging", 0x02, 0x12, 0x23cd, []),
      SFX.create_sfx("Flute use", 0x02, 0x13, 0x23a0, [0x3e]),
      SFX.create_sfx("Cape on", 0x02, 0x14, 0x2380, []),
      SFX.create_sfx("Cape off/Wallmaster grab", 0x02, 0x15, 0x2390, []),
      SFX.create_sfx("Staircase", 0x02, 0x16, 0x232c, []),
      SFX.create_sfx("Staircase", 0x02, 0x17, 0x2344, []),
      SFX.create_sfx("Staircase", 0x02, 0x18, 0x2356, []),
      SFX.create_sfx("Staircase", 0x02, 0x19, 0x236e, []),
      SFX.create_sfx("Tall grass/Hammer hitting bush", 0x02, 0x1a, 0x2316, []),
      SFX.create_sfx("Mire shallow water", 0x02, 0x1b, 0x2307, []),
      SFX.create_sfx("Shallow water", 0x02, 0x1c, 0x2301, []),
      SFX.create_sfx("Lifting object", 0x02, 0x1d, 0x22bb, []),
      SFX.create_sfx("Cutting grass", 0x02, 0x1e, 0x2577, []),
      SFX.create_sfx("Item breaking", 0x02, 0x1f, 0x22e9, []),
      SFX.create_sfx("Item falling in pit", 0x02, 0x20, 0x22da, []),
      SFX.create_sfx("Bomb hitting ground/General bang", 0x02, 0x21, 0x22cf, []),
      SFX.create_sfx("Pushing object/Armos bounce", 0x02, 0x22, 0x2107, []),
      SFX.create_sfx("Boots dust", 0x02, 0x23, 0x22b1, []),
      SFX.create_sfx("Splashing", 0x02, 0x24, 0x22a5, [0x3d]),
      SFX.create_sfx("Mire shallow water again?", 0x02, 0x25, 0x2296, []),
      SFX.create_sfx("Link taking damage", 0x02, 0x26, 0x2844, []),
      SFX.create_sfx("Fainting", 0x02, 0x27, 0x2252, []),
      SFX.create_sfx("Item splash", 0x02, 0x28, 0x2287, []),
      SFX.create_sfx("Rupee refill", 0x02, 0x29, 0x243f, [0x3b]),
      SFX.create_sfx( "Fire rod shot hitting wall/Bombos spell", 0x02, 0x2a, 0x2033, []),
      SFX.create_sfx("Heart beep/Text box", 0x02, 0x2b, 0x1ff2, []),
      SFX.create_sfx("Sword up", 0x02, 0x2c, 0x1fd9, [0x3a]),
      SFX.create_sfx("Magic drain", 0x02, 0x2d, 0x20a6, []),
      SFX.create_sfx("GT opening", 0x02, 0x2e, 0x1fca, [0x39]),
      SFX.create_sfx("GT opening/Water drain", 0x02, 0x2f, 0x1f47, [0x38]),
      SFX.create_sfx("Cucco", 0x02, 0x30, 0x1ef1, []),
      SFX.create_sfx("Fairy", 0x02, 0x31, 0x20ce, []),
      SFX.create_sfx("Bug net", 0x02, 0x32, 0x1d47, []),
      SFX.create_sfx("Teleport2", 0x02, 0x33, 0x1cdc, [], true),
      SFX.create_sfx("Teleport1", 0x02, 0x34, 0x1f6f, [0x33]),
      SFX.create_sfx("Quake/Vitreous/Zora king/Armos/Pyramid/Lanmo", 0x02, 0x35, 0x1c67, [0x36]),
      SFX.create_sfx( "Mire entrance (extends above)", 0x02, 0x36, 0x1c64, [], true),
      SFX.create_sfx("Spin charged", 0x02, 0x37, 0x1a43, []),
      SFX.create_sfx("Water sound", 0x02, 0x38, 0x1f6f, [], true),
      SFX.create_sfx("GT opening thunder", 0x02, 0x39, 0x1f9c, [], true),
      SFX.create_sfx("Sword up", 0x02, 0x3a, 0x1fe7, [], true),
      SFX.create_sfx("Quiet rupees", 0x02, 0x3b, 0x2462, [], true),
      SFX.create_sfx("Error beep", 0x02, 0x3c, 0x1a37, []),
      SFX.create_sfx("Big splash", 0x02, 0x3d, 0x22ab, [], true),
      SFX.create_sfx("Flute again", 0x02, 0x3e, 0x23b5, [], true),
      SFX.create_sfx("Powder paired", 0x02, 0x3f, 0x2435, [], true),

      SFX.create_sfx("Sword beam", 0x03, 0x01, 0x1a18, []),
      SFX.create_sfx("TR opening", 0x03, 0x02, 0x254e, []),
      SFX.create_sfx("Pyramid hole", 0x03, 0x03, 0x224a, []),
      SFX.create_sfx("Angry soldier", 0x03, 0x04, 0x220e, []),
      SFX.create_sfx("Lynel shot/Javelin toss", 0x03, 0x05, 0x25b7, []),
      SFX.create_sfx( "BNC swing/Phantom ganon/Helma tail/Arrghus swoosh", 0x03, 0x06, 0x21f5, []),
      SFX.create_sfx("Cannon fire", 0x03, 0x07, 0x223d, []),
      SFX.create_sfx("Damage to enemy; $0BEX.4=1", 0x03, 0x08, 0x21e6, []),
      SFX.create_sfx("Enemy death", 0x03, 0x09, 0x21c1, []),
      SFX.create_sfx("Collecting rupee", 0x03, 0x0a, 0x21a9, []),
      SFX.create_sfx("Collecting heart", 0x03, 0x0b, 0x2198, []),
      SFX.create_sfx("Non-blank text character", 0x03, 0x0c, 0x218e, []),
      SFX.create_sfx( "HUD heart (used explicitly by sanc heart?)", 0x03, 0x0d, 0x21b5, []),
      SFX.create_sfx("Opening chest", 0x03, 0x0e, 0x2182, []),
      SFX.create_sfx("♪Do do do doooooo♫", 0x03, 0x0f, 0x24b9, [ 0x3c, 0x3d, 0x3e, 0x3f,]),
      SFX.create_sfx("Opening/Closing map (paired)", 0x03, 0x10, 0x216d, [ 0x3b,]),
      SFX.create_sfx( "Opening item menu/Bomb shop guy breathing", 0x03, 0x11, 0x214f, []),
      SFX.create_sfx( "Closing item menu/Bomb shop guy breathing", 0x03, 0x12, 0x215e, []),
      SFX.create_sfx( "Throwing object (sprites use it as well)/Stalfos jump", 0x03, 0x13, 0x213b, []),
      SFX.create_sfx( "Key door/Trinecks/Dash key landing/Stalfos Knight collapse", 0x03, 0x14, 0x246c, []),
      SFX.create_sfx( "Door closing/OW door opening/Chest opening (w/ $29 in $012E)", 0x03, 0x15, 0x212f, []),
      SFX.create_sfx("Armos Knight thud", 0x03, 0x16, 0x2123, []),
      SFX.create_sfx("Rat squeak", 0x03, 0x17, 0x25a6, []),
      SFX.create_sfx("Dragging/Mantle moving", 0x03, 0x18, 0x20dd, []),
      SFX.create_sfx( "Fireball/Laser shot; Somehow used by Trinexx???", 0x03, 0x19, 0x250a, []),
      SFX.create_sfx("Chest reveal jingle ", 0x03, 0x1a, 0x1e8a, [0x38]),
      SFX.create_sfx("Puzzle jingle", 0x03, 0x1b, 0x20b6, [0x3a]),
      SFX.create_sfx("Damage to enemy", 0x03, 0x1c, 0x1a62, []),
      SFX.create_sfx("Potion refill/Magic drain", 0x03, 0x1d, 0x20a6, []),
      SFX.create_sfx( "Flapping (Duck/Cucco swarm/Ganon bats/Keese/Raven/Vulture)", 0x03, 0x1e, 0x2091, []),
      SFX.create_sfx("Link falling", 0x03, 0x1f, 0x204b, []),
      SFX.create_sfx("Menu/Text cursor moved", 0x03, 0x20, 0x276c, []),
      SFX.create_sfx("Damage to boss", 0x03, 0x21, 0x27e2, []),
      SFX.create_sfx("Boss dying/Deleting file", 0x03, 0x22, 0x26cf, []),
      SFX.create_sfx("Spin attack/Medallion swoosh", 0x03, 0x23, 0x2001, [ 0x39,]),
      SFX.create_sfx("OW map perspective change", 0x03, 0x24, 0x2043, []),
      SFX.create_sfx("Pressure switch", 0x03, 0x25, 0x1e9d, []),
      SFX.create_sfx( "Lightning/Game over/Laser/Ganon bat/Trinexx lunge", 0x03, 0x26, 0x1e7b, []),
      SFX.create_sfx("Agahnim charge", 0x03, 0x27, 0x1e40, []),
      SFX.create_sfx("Agahnim/Ganon teleport", 0x03, 0x28, 0x26f7, []),
      SFX.create_sfx("Agahnim shot", 0x03, 0x29, 0x1e21, []),
      SFX.create_sfx( "Somaria/Byrna/Ether spell/Helma fire ball", 0x03, 0x2a, 0x1e12, []),
      SFX.create_sfx("Electrocution", 0x03, 0x2b, 0x1df3, []),
      SFX.create_sfx("Bees", 0x03, 0x2c, 0x1dc0, []),
      SFX.create_sfx("Milestone, also via text", 0x03, 0x2d, 0x1da9, [0x37]),
      SFX.create_sfx("Collecting heart container", 0x03, 0x2e, 0x1d5d, [ 0x35, 0x34,]),
      SFX.create_sfx("Collecting absorbable key", 0x03, 0x2f, 0x1d80, [0x33]),
      SFX.create_sfx( "Byrna spark/Item plop/Magic bat zap/Blob emerge", 0x03, 0x30, 0x1b53, []),
      SFX.create_sfx("Sprite falling/Moldorm shuffle", 0x03, 0x31, 0x1aca, []),
      SFX.create_sfx( "Bumper boing/Somaria punt/Blob transmutation/Sprite boings", 0x03, 0x32, 0x1a78, []),
      SFX.create_sfx("Jingle (paired $2F→$33)", 0x03, 0x33, 0x1d93, [], true),
      SFX.create_sfx( "Depressing jingle (paired $2E→$35→$34)", 0x03, 0x34, 0x1d66, [], true),
      SFX.create_sfx( "Ugly jingle (paired $2E→$35→$34)", 0x03, 0x35, 0x1d73, [], true),
      SFX.create_sfx( "Wizzrobe shot/Helma fireball split/Mothula beam/Blue balls", 0x03, 0x36, 0x1aa7, []),
      SFX.create_sfx( "Dinky jingle (paired $2D→$37)", 0x03, 0x37, 0x1db4, [], true),
      SFX.create_sfx( "Apathetic jingle (paired $1A→$38)", 0x03, 0x38, 0x1e93, [], true),
      SFX.create_sfx( "Quiet swish (paired $23→$39)", 0x03, 0x39, 0x2017, [], true),
      SFX.create_sfx( "Defective jingle (paired $1B→$3A)", 0x03, 0x3a, 0x20c0, [], true),
      SFX.create_sfx( "Petulant jingle (paired $10→$3B)", 0x03, 0x3b, 0x2176, [], true),
      SFX.create_sfx( "Triumphant jingle (paired $0F→$3C→$3D→$3E→$3F)", 0x03, 0x3c, 0x248a, [], true),
      SFX.create_sfx( "Less triumphant jingle ($0F→$3C→$3D→$3E→$3F)", 0x03, 0x3d, 0x2494, [], true),
      SFX.create_sfx( '"You tried, I guess" jingle (paired $0F→$3C→$3D→$3E→$3F)', 0x03, 0x3e, 0x249e, [], true),
      SFX.create_sfx( '"You didn\'t really try" jingle (paired $0F→$3C→$3D→$3E→$3F)', 0x03, 0x3f, 0x2480, [], true),
    ];
  }

  //There are 3 sound effects tables, but only 2 of them should be randomized.
  // The first table is mostly sounds that don't lend well to being played randomly due to specially programmed looping in set 1.
  shuffle_sfx_data() {
    let sfx_pool = SFX.init_sfx_data();  //data structure for randomizing
    let sfx_map = { 2: {}, 3: {} };  // data structure for writing to the rom
    let accompaniment_map = { 2: [], 3: [] }; //sounds in sfx banks that are for accompaniment sfx
    let candidates = [];
    // organize sfx into complete sfx chains (or an unchained sfx) and those sfx that are merely accompaniment sfx
    sfx_pool.forEach((sfx) => {
      sfx_map[sfx.sfx_set][sfx.orig_id] = sfx;
      if (!sfx.accomp) {
        candidates.push({ set: sfx.sfx_set, id: sfx.orig_id });
      } else {
        accompaniment_map[sfx.sfx_set].push(sfx.orig_id);
      }
    });
    //pull out all the chained sfx first (those sfx that have a accompaniment chain)
    let chained_sfx = sfx_pool.filter((x) => x.chain.length > 0);

    candidates = fy_shuffle(candidates, this.rand);

    // randomized chained sfx
    chained_sfx = fy_shuffle(chained_sfx, this.rand);
    // start with the longest chains first to ensure we have room for all
    chained_sfx.sort((a, b) => b.chain.length - a.chain.length);
    chained_sfx.forEach((chained) => {
      // find an sfx bank with enough accomp. slots for this chain
      let chosen_slot = candidates.find(
        (x) => accompaniment_map[x.set].length - chained.chain.length >= 0
      );
      if (!chosen_slot) {
        throw "Something went wrong with sfx chains";
      }
      chained.target_set = chosen_slot.set;
      chained.target_id = chosen_slot.id;
      chained.target_chain = [];
      //assign sufficient accomp. slot for the entire chain
      chained.chain.forEach((downstream) => {
        let next_slot = accompaniment_map[chosen_slot.set].pop();
        let ds_acc = sfx_map[chained.sfx_set][downstream];
        ds_acc.target_set = chosen_slot.set;
        ds_acc.target_id = next_slot;
        chained.target_chain.push(next_slot);
      });

      //remove assigned sfx from the candidate pool
      let index = candidates.indexOf(chosen_slot);
      candidates.splice(index, 1);
      index = sfx_pool.indexOf(chained);
      sfx_pool.splice(index, 1);
    });

    // randomize all the unchained sfx
    let unchained_sfx = sfx_pool.filter((x) => !x.accomp);
    // do the rest
    unchained_sfx.forEach((sfx) => {
      let chosen_slot = candidates.pop();
      sfx.target_set = chosen_slot.set;
      sfx.target_id = chosen_slot.id;
    });
    return sfx_map;
  }

  randomize_sfx(rom) {
    const sfx_table = {
      2: 0x1A8BD0,
      3: 0x1A8CCC,
    };

    const sfx_accompaniment_table = {
      2: 0x1A8C4E,
      3: 0x1A8D4A,
    };

    // shuffle the data structure first
    let sfx_map = this.shuffle_sfx_data();
    let sfx_sets = [sfx_map[2], sfx_map[3]];
    // write randomized data to the rom
    sfx_sets.forEach((shuffled_sfx) => {
      for (const id in shuffled_sfx) {
        let sfx = shuffled_sfx[id];
        let base_address = snes_to_pc(sfx_table[sfx.target_set]);
        rom.write(
          base_address + sfx.target_id * 2 - 2,
          int16_as_bytes(sfx.addr)
        );
        let ac_base = snes_to_pc(sfx_accompaniment_table[sfx.target_set]);
        let last = sfx.target_id;
        // modify accompaniment table if necessary
        if (sfx.target_chain) {
          sfx.target_chain.forEach((chained) => {
            rom.write(ac_base + last - 1, chained);
            last = chained;
          });
        }
        // 0 indicates the end of the chain (unchained ones always have zero here)
        rom.write(ac_base + last - 1, 0);
      }
    });
  }
}
