const { it, expect, document } = global;
document.head.innerHTML = '<meta name="csrf-token" content="token">';

require("../../resources/js/bootstrap");

it("loads Popper", () => {
  expect(window).toHaveProperty("Popper");
});

it("loads jQuery", () => {
  expect(window).toHaveProperty("$");
});

it("loads Axios", () => {
  expect(window).toHaveProperty("axios");
});
