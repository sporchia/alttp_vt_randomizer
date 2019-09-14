import * as Sentry from "@sentry/browser";

const { it, expect, document } = global;
document.head.innerHTML = '<meta name="csrf-token" content="token">';
document.body.innerHTML = '<div id="app"></div>';

console.error = jest.fn(() => {});

jest.mock("@sentry/browser", () => {
  return {
    init: jest.fn(() => false),
    Integrations: {
      Vue: jest.fn(() => false)
    }
  };
});
process.env.MIX_SENTRY_DSN_PUBLIC = "testing";

require("../../resources/js/app");

it("loads Vue", () => {
  expect(window).toHaveProperty("Vue");
});

it("mounts Sentry", () => {
  expect(Sentry.init).toHaveBeenCalled();
});
