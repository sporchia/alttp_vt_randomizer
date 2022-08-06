<template>
  <div class="row">
    <div class="col">
      <label class="btn btn-outline-primary btn-file">
        {{ $t("rom.settings.sprite_file_select") }}
        <input
          type="file"
          accept=".zspr"
          @change="loadBlob"
        />
      </label>
    </div>
    <div class="col" v-if="fileSelected">{{ fileNameText }}</div>
  </div>
</template>

<script>
export default {
  props: {
    rom: { default: null },
  },
  data() {
    return {
      fileSelected: false,
      fileNameText: ""
    };
  },
  methods: {
    loadBlob(change) {
      let blob = change.target.files[0];
      const fileName = change.target.files[0].name;
      const fileReader = new FileReader();

      fileReader.onload = event => {
        this.arrayBuffer = event.target.result;
      };

      fileReader.onloadend = () => {
        this.fileSelected = true;

        if (typeof this.arrayBuffer === "undefined") {
          this.fileNameText = "Could not read .zspr file: " + fileName;
          throw new Error("Could not read this.arrayBuffer");
        }

        new Promise((resolve, reject) => {
          var zspr = new Uint8Array(this.arrayBuffer);

          const headBytes =
            String.fromCharCode(zspr[0]) +
            String.fromCharCode(zspr[1]) +
            String.fromCharCode(zspr[2]) +
            String.fromCharCode(zspr[3]);
          const gfx_offset =
            (zspr[12] << 24) | (zspr[11] << 16) | (zspr[10] << 8) | zspr[9];
          const palette_offset =
            (zspr[18] << 24) | (zspr[17] << 16) | (zspr[16] << 8) | zspr[15];

          if (("ZSPR" != headBytes) ||
              ((gfx_offset + 28672) > palette_offset) ||
              ((gfx_offset + 28672) > this.arrayBuffer.byteLength) ||
              ((palette_offset + 124) > this.arrayBuffer.byteLength)) {
            reject("Bad .zspr file: " + fileName);
          }

          localforage
            .setItem("vt.sprites.custom_sprite", zspr)
            .then(function(spr) {
              resolve(spr);
            })
            .catch(function() {
              reject("Could not save sprite to local storage: " + fileName);
            });

          this.fileNameText = "Loaded: " + fileName;

        }).then(this.rom.parseSprGfx.bind(this.rom),
                (reason) => { this.fileNameText = reason });
      };

      fileReader.readAsArrayBuffer(blob);
    }
  }
};
</script>
