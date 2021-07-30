import Prando from "prando";
import {fy_shuffle, int16_as_bytes} from "./utils";

export default class SFX {
  constructor(seed) {
    this.rand = new Prando(seed);
  }

  create_sfx(name, sfx_set, orig_id, addr, chain, accomp = false) {
  	return {
  	  name: name,
  	  sfx_set: sfx_set,
  	  orig_id: orig_id,
      addr: addr,
      chain: chain,
      accomp: accomp,

      target_set: undefined,
      target_id: undefined,
      target_chain: undefined
  	};
  }

  init_sfx_data() {
  	return [
		this.create_sfx('Slash1', 0x02, 0x01, 0x2614, []), this.create_sfx('Slash2', 0x02, 0x02, 0x2625, []),
		this.create_sfx('Slash3', 0x02, 0x03, 0x2634, []), this.create_sfx('Slash4', 0x02, 0x04, 0x2643, []),
		this.create_sfx('Wall clink', 0x02, 0x05, 0x25DD, []), this.create_sfx('Bombable door clink', 0x02, 0x06, 0x25D7, []),
		this.create_sfx('Fwoosh shooting', 0x02, 0x07, 0x25B7, []), this.create_sfx('Arrow hitting wall', 0x02, 0x08, 0x25E3, []),
		this.create_sfx('Boomerang whooshing', 0x02, 0x09, 0x25AD, []), this.create_sfx('Hookshot', 0x02, 0x0A, 0x25C7, []),
		this.create_sfx('Placing bomb', 0x02, 0x0B, 0x2478, []),
		this.create_sfx('Bomb exploding/Quake/Bombos/Exploding wall', 0x02, 0x0C, 0x269C, []),
		this.create_sfx('Powder', 0x02, 0x0D, 0x2414, [0x3f]), this.create_sfx('Fire rod shot', 0x02, 0x0E, 0x2404, []),
		this.create_sfx('Ice rod shot', 0x02, 0x0F, 0x24C3, []), this.create_sfx('Hammer use', 0x02, 0x10, 0x23FA, []),
		this.create_sfx('Hammering peg', 0x02, 0x11, 0x23F0, []), this.create_sfx('Digging', 0x02, 0x12, 0x23CD, []),
		this.create_sfx('Flute use', 0x02, 0x13, 0x23A0, [0x3e]), this.create_sfx('Cape on', 0x02, 0x14, 0x2380, []),
		this.create_sfx('Cape off/Wallmaster grab', 0x02, 0x15, 0x2390, []), this.create_sfx('Staircase', 0x02, 0x16, 0x232C, []),
		this.create_sfx('Staircase', 0x02, 0x17, 0x2344, []), this.create_sfx('Staircase', 0x02, 0x18, 0x2356, []),
		this.create_sfx('Staircase', 0x02, 0x19, 0x236E, []), this.create_sfx('Tall grass/Hammer hitting bush', 0x02, 0x1A, 0x2316, []),
		this.create_sfx('Mire shallow water', 0x02, 0x1B, 0x2307, []), this.create_sfx('Shallow water', 0x02, 0x1C, 0x2301, []),
		this.create_sfx('Lifting object', 0x02, 0x1D, 0x22BB, []), this.create_sfx('Cutting grass', 0x02, 0x1E, 0x2577, []),
		this.create_sfx('Item breaking', 0x02, 0x1F, 0x22E9, []), this.create_sfx('Item falling in pit', 0x02, 0x20, 0x22DA, []),
		this.create_sfx('Bomb hitting ground/General bang', 0x02, 0x21, 0x22CF, []),
		this.create_sfx('Pushing object/Armos bounce', 0x02, 0x22, 0x2107, []), this.create_sfx('Boots dust', 0x02, 0x23, 0x22B1, []),
		this.create_sfx('Splashing', 0x02, 0x24, 0x22A5, [0x3d]), this.create_sfx('Mire shallow water again?', 0x02, 0x25, 0x2296, []),
		this.create_sfx('Link taking damage', 0x02, 0x26, 0x2844, []), this.create_sfx('Fainting', 0x02, 0x27, 0x2252, []),
		this.create_sfx('Item splash', 0x02, 0x28, 0x2287, []), this.create_sfx('Rupee refill', 0x02, 0x29, 0x243F, [0x3b]),
		this.create_sfx('Fire rod shot hitting wall/Bombos spell', 0x02, 0x2A, 0x2033, []),
		this.create_sfx('Heart beep/Text box', 0x02, 0x2B, 0x1FF2, []), this.create_sfx('Sword up', 0x02, 0x2C, 0x1FD9, [0x3a]),
		this.create_sfx('Magic drain', 0x02, 0x2D, 0x20A6, []), this.create_sfx('GT opening', 0x02, 0x2E, 0x1FCA, [0x39]),
		this.create_sfx('GT opening/Water drain', 0x02, 0x2F, 0x1F47, [0x38]), this.create_sfx('Cucco', 0x02, 0x30, 0x1EF1, []),
		this.create_sfx('Fairy', 0x02, 0x31, 0x20CE, []), this.create_sfx('Bug net', 0x02, 0x32, 0x1D47, []),
		this.create_sfx('Teleport2', 0x02, 0x33, 0x1CDC, [], true), this.create_sfx('Teleport1', 0x02, 0x34, 0x1F6F, [0x33]),
		this.create_sfx('Quake/Vitreous/Zora king/Armos/Pyramid/Lanmo', 0x02, 0x35, 0x1C67, [0x36]),
		this.create_sfx('Mire entrance (extends above)', 0x02, 0x36, 0x1C64, [], true),
		this.create_sfx('Spin charged', 0x02, 0x37, 0x1A43, []), this.create_sfx('Water sound', 0x02, 0x38, 0x1F6F, [], true),
		this.create_sfx('GT opening thunder', 0x02, 0x39, 0x1F9C, [], true), this.create_sfx('Sword up', 0x02, 0x3A, 0x1FE7, [], true),
		this.create_sfx('Quiet rupees', 0x02, 0x3B, 0x2462, [], true), this.create_sfx('Error beep', 0x02, 0x3C, 0x1A37, []),
		this.create_sfx('Big splash', 0x02, 0x3D, 0x22AB, [], true), this.create_sfx('Flute again', 0x02, 0x3E, 0x23B5, [], true),
		this.create_sfx('Powder paired', 0x02, 0x3F, 0x2435, [], true),

		this.create_sfx('Sword beam', 0x03, 0x01, 0x1A18, []),
		this.create_sfx('TR opening', 0x03, 0x02, 0x254E, []), this.create_sfx('Pyramid hole', 0x03, 0x03, 0x224A, []),
		this.create_sfx('Angry soldier', 0x03, 0x04, 0x220E, []), this.create_sfx('Lynel shot/Javelin toss', 0x03, 0x05, 0x25B7, []),
		this.create_sfx('BNC swing/Phantom ganon/Helma tail/Arrghus swoosh', 0x03, 0x06, 0x21F5, []),
		this.create_sfx('Cannon fire', 0x03, 0x07, 0x223D, []), this.create_sfx('Damage to enemy; $0BEX.4=1', 0x03, 0x08, 0x21E6, []),
		this.create_sfx('Enemy death', 0x03, 0x09, 0x21C1, []), this.create_sfx('Collecting rupee', 0x03, 0x0A, 0x21A9, []),
		this.create_sfx('Collecting heart', 0x03, 0x0B, 0x2198, []),,
		this.create_sfx('Non-blank text character', 0x03, 0x0C, 0x218E, []),
		this.create_sfx('HUD heart (used explicitly by sanc heart?)', 0x03, 0x0D, 0x21B5, []),
		this.create_sfx('Opening chest', 0x03, 0x0E, 0x2182, []),,
		this.create_sfx('♪Do do do doooooo♫', 0x03, 0x0F, 0x24B9, [0x3C, 0x3D, 0x3E, 0x3F]),
		this.create_sfx('Opening/Closing map (paired)', 0x03, 0x10, 0x216D, [0x3b]),
		this.create_sfx('Opening item menu/Bomb shop guy breathing', 0x03, 0x11, 0x214F, []),
		this.create_sfx('Closing item menu/Bomb shop guy breathing', 0x03, 0x12, 0x215E, []),
		this.create_sfx('Throwing object (sprites use it as well)/Stalfos jump', 0x03, 0x13, 0x213B, []),
		this.create_sfx('Key door/Trinecks/Dash key landing/Stalfos Knight collapse', 0x03, 0x14, 0x246C, []),
		this.create_sfx('Door closing/OW door opening/Chest opening (w/ $29 in $012E)', 0x03, 0x15, 0x212F, []),
		this.create_sfx('Armos Knight thud', 0x03, 0x16, 0x2123, []), this.create_sfx('Rat squeak', 0x03, 0x17, 0x25A6, []),
		this.create_sfx('Dragging/Mantle moving', 0x03, 0x18, 0x20DD, []),
		this.create_sfx('Fireball/Laser shot; Somehow used by Trinexx???', 0x03, 0x19, 0x250A, []),
		this.create_sfx('Chest reveal jingle ', 0x03, 0x1A, 0x1E8A, [0x38]),,
		this.create_sfx('Puzzle jingle', 0x03, 0x1B, 0x20B6, [0x3a]), this.create_sfx('Damage to enemy', 0x03, 0x1C, 0x1A62, []),
		this.create_sfx('Potion refill/Magic drain', 0x03, 0x1D, 0x20A6, []),
		this.create_sfx('Flapping (Duck/Cucco swarm/Ganon bats/Keese/Raven/Vulture)', 0x03, 0x1E, 0x2091, []),
		this.create_sfx('Link falling', 0x03, 0x1F, 0x204B, []), this.create_sfx('Menu/Text cursor moved', 0x03, 0x20, 0x276C, []),
		this.create_sfx('Damage to boss', 0x03, 0x21, 0x27E2, []), this.create_sfx('Boss dying/Deleting file', 0x03, 0x22, 0x26CF, []),
		this.create_sfx('Spin attack/Medallion swoosh', 0x03, 0x23, 0x2001, [0x39]),
		this.create_sfx('OW map perspective change', 0x03, 0x24, 0x2043, []),,
		this.create_sfx('Pressure switch', 0x03, 0x25, 0x1E9D, []),,
		this.create_sfx('Lightning/Game over/Laser/Ganon bat/Trinexx lunge', 0x03, 0x26, 0x1E7B, []),
		this.create_sfx('Agahnim charge', 0x03, 0x27, 0x1E40, []), this.create_sfx('Agahnim/Ganon teleport', 0x03, 0x28, 0x26F7, []),
		this.create_sfx('Agahnim shot', 0x03, 0x29, 0x1E21, []),,
		this.create_sfx('Somaria/Byrna/Ether spell/Helma fire ball', 0x03, 0x2A, 0x1E12, []),
		this.create_sfx('Electrocution', 0x03, 0x2B, 0x1DF3, []), this.create_sfx('Bees', 0x03, 0x2C, 0x1DC0, []),
		this.create_sfx('Milestone, also via text', 0x03, 0x2D, 0x1DA9, [0x37]),,
		this.create_sfx('Collecting heart container', 0x03, 0x2E, 0x1D5D, [0x35, 0x34]),,
		this.create_sfx('Collecting absorbable key', 0x03, 0x2F, 0x1D80, [0x33]),,
		this.create_sfx('Byrna spark/Item plop/Magic bat zap/Blob emerge', 0x03, 0x30, 0x1B53, []),
		this.create_sfx('Sprite falling/Moldorm shuffle', 0x03, 0x31, 0x1ACA, []),
		this.create_sfx('Bumper boing/Somaria punt/Blob transmutation/Sprite boings', 0x03, 0x32, 0x1A78, []),
		this.create_sfx('Jingle (paired $2F→$33)', 0x03, 0x33, 0x1D93, [], true),
		this.create_sfx('Depressing jingle (paired $2E→$35→$34)', 0x03, 0x34, 0x1D66, [], true),
		this.create_sfx('Ugly jingle (paired $2E→$35→$34)', 0x03, 0x35, 0x1D73, [], true),
		this.create_sfx('Wizzrobe shot/Helma fireball split/Mothula beam/Blue balls', 0x03, 0x36, 0x1AA7, []),
		this.create_sfx('Dinky jingle (paired $2D→$37)', 0x03, 0x37, 0x1DB4, [], true),
		this.create_sfx('Apathetic jingle (paired $1A→$38)', 0x03, 0x38, 0x1E93, [], true),
		this.create_sfx('Quiet swish (paired $23→$39)', 0x03, 0x39, 0x2017, [], true),
		this.create_sfx('Defective jingle (paired $1B→$3A)', 0x03, 0x3A, 0x20C0, [], true),
		this.create_sfx('Petulant jingle (paired $10→$3B)', 0x03, 0x3B, 0x2176, [], true),
		this.create_sfx('Triumphant jingle (paired $0F→$3C→$3D→$3E→$3F)', 0x03, 0x3C, 0x248A, [], true),
		this.create_sfx('Less triumphant jingle ($0F→$3C→$3D→$3E→$3F)', 0x03, 0x3D, 0x2494, [], true),
		this.create_sfx('"You tried, I guess" jingle (paired $0F→$3C→$3D→$3E→$3F)', 0x03, 0x3E, 0x249E, [], true),
		this.create_sfx('"You didn\'t really try" jingle (paired $0F→$3C→$3D→$3E→$3F)', 0x03, 0x3F, 0x2480, [], true)
	];
  }

  shuffle_sfx_data() {
    let sfx_pool = this.init_sfx_data();
    let sfx_map = {2: {}, 3: {}};
    let accompaniment_map = {2: [], 3: []};
    let candidates = [];
    sfx_pool.forEach(sfx => {
    	sfx_map[sfx.sfx_set][sfx.orig_id] = sfx
    	if (!sfx.accomp) {
    		candidates.push({set: sfx.sfx_set, id: sfx.orig_id});
    	} else {
    	 	accompaniment_map[sfx.sfx_set].push(sfx.orig_id);
    	}
    });
    let chained_sfx = sfx_pool.filter(x => x.chain.length > 0)

	candidates = fy_shuffle(candidates, this.rand);

    //place chained sfx first
    chained_sfx = fy_shuffle(chained_sfx, this.rand);
    chained_sfx.sort((a, b) => b.chain.length - a.chain.length);
    chained_sfx.forEach(chained => {
    	let chosen_slot = candidates.find(x => accompaniment_map[x.set].length - chained.chain.length >= 0);
        if (!chosen_slot) {
            throw 'Something went wrong with sfx chains';
		}
		chained.target_set = chosen_slot.set;
		chained.target_id = chosen_slot.id;
		chained.target_chain = [];
        chained.chain.forEach(downstream => {
			let next_slot = accompaniment_map[chosen_slot.set].pop();
			let ds_acc = sfx_map[chained.sfx_set][downstream];
			ds_acc.target_set = chosen_slot.set;
			ds_acc.target_id = next_slot;
			chained.target_chain.push(next_slot);
        });

		let index = candidates.indexOf(chosen_slot);
		candidates.splice(index, 1);
		index = sfx_pool.indexOf(chained);
		sfx_pool.splice(index, 1);
     });

    let unchained_sfx = sfx_pool.filter(x => !x.accomp);
    // do the rest
    unchained_sfx.forEach(sfx => {
    	let chosen_slot = candidates.pop();
    	sfx.target_set = chosen_slot.set;
    	sfx.target_id = chosen_slot.id;
    });
    return sfx_map;
  }

  randomize_sfx(rom) {
  	const sfx_table = {
		2: 0x1a8c29,
		3: 0x1A8D25
    };

    const sfx_accompaniment_table = {
		2: 0x1A8CA7,
		3: 0x1A8DA3
	};

    let sfx_map = this.shuffle_sfx_data();
	let sfx_sets = [sfx_map[2], sfx_map[3]];
	sfx_sets.forEach(shuffled_sfx => {
		for(const id in shuffled_sfx) {
			let sfx = shuffled_sfx[id];
			let base_address = sfx_table[sfx.target_set];
			rom.write(base_address + (sfx.target_id * 2) - 2, int16_as_bytes(sfx.addr));
			let ac_base = sfx_accompaniment_table[sfx.target_set];
			let last = sfx.target_id;
			if (sfx.target_chain) {
				sfx.target_chain.forEach(chained => {
					rom.write(ac_base + last - 1, chained);
					last = chained;
				});
			}
			rom.write(ac_base + last - 1, 0);
		}
	});
  }
}














