import { shallowMount } from "@vue/test-utils";
import VTRomLoader from "../../../resources/js/components/VTRomLoader";
import axios from "axios";
import MockAdapter from "axios-mock-adapter";
const { it, expect } = global;

it("is a Vue instance", () => {
  var mock = new MockAdapter(axios);
  mock.onGet(`/base_rom/settings`).reply(200, {
    msg: "hello"
  });

  const wrapper = shallowMount(VTRomLoader, {
    mocks: {
      $t: key => key
    }
  });

  expect(wrapper.isVueInstance()).toBeTruthy();
});

it("sets settings_loaded to true when a current ROM hash is passed in", () => {
  const wrapper = shallowMount(VTRomLoader, {
    propsData: {
      currentRomHash: "testing"
    },
    mocks: {
      $t: key => key
    }
  });

  expect(wrapper.vm.settings_loaded).toBeTruthy();
});

it("sets loading to false when no blob is called", () => {
  const wrapper = shallowMount(VTRomLoader, {
    mocks: {
      $t: key => key
    }
  });

  wrapper.vm.noBlob();

  expect(wrapper.vm.loading).toBeFalsy();
});
