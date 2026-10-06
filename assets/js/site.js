/**
 * Header behaviour: the services mega-menu and the mobile drawer.
 *
 * Progressive enhancement — without JS the nav still renders every link,
 * because the mega panel is a plain <ul> that this script hides on load.
 */
(function (document) {
  "use strict";

  var header = document.querySelector("[data-header]");
  if (!header) {
    return;
  }

  var drawer = header.querySelector("[data-nav]");
  var toggle = header.querySelector("[data-nav-toggle]");
  var megaButton = header.querySelector("[data-mega-toggle]");
  var mega = header.querySelector("[data-mega]");
  var desktop = window.matchMedia("(min-width: 901px)");
  var savedOverflow = null;

  /* Hidden only once JS is running, so a no-JS visitor keeps the full list. */
  if (mega && megaButton) {
    mega.hidden = true;
    megaButton.setAttribute("aria-expanded", "false");
  }
  if (drawer && toggle && !desktop.matches) {
    drawer.hidden = true;
  }
  header.setAttribute("data-enhanced", "");

  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-print]").forEach(function (button) { button.hidden = false; });
  });
  document.addEventListener("click", function (event) {
    if (event.target.closest("[data-print]")) window.print();
  });

  function setMega(open) {
    if (!mega || !megaButton) {
      return;
    }
    mega.hidden = !open;
    megaButton.setAttribute("aria-expanded", open ? "true" : "false");
  }

  function setDrawer(open, restoreFocus) {
    if (!drawer || !toggle) {
      return;
    }
    drawer.hidden = !open;
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    toggle.textContent = open ? toggle.dataset.labelClose : toggle.dataset.labelOpen;
    if (open) {
      if (savedOverflow === null) savedOverflow = document.body.style.overflow;
      document.body.style.overflow = "hidden";
      header.setAttribute("role", "dialog");
      header.setAttribute("aria-modal", "true");
      header.setAttribute("aria-label", toggle.dataset.labelOpen);
      setMega(true);
      var first = drawer.querySelector("button, a[href]");
      if (first) first.focus();
    } else {
      if (savedOverflow !== null) document.body.style.overflow = savedOverflow;
      savedOverflow = null;
      header.removeAttribute("role");
      header.removeAttribute("aria-modal");
      header.removeAttribute("aria-label");
      if (restoreFocus !== false) toggle.focus();
    }
  }

  /* Hand focus and the scroll lock to the service picker from the drawer. */
  document.addEventListener("whatsapp:open", function () {
    if (!desktop.matches && drawer && !drawer.hidden) setDrawer(false, false);
    setMega(false);
  });

  if (megaButton) {
    megaButton.addEventListener("click", function () {
      setMega(mega.hidden);
    });
  }

  if (toggle) {
    toggle.addEventListener("click", function () {
      setDrawer(drawer.hidden);
    });
  }

  document.addEventListener("click", function (e) {
    if (!desktop.matches && drawer && !drawer.hidden && e.target.closest("[data-nav] a[href]")) {
      setDrawer(false, false);
    }
    if (desktop.matches && mega && !mega.hidden && !header.contains(e.target)) {
      setMega(false);
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Tab" && !desktop.matches && drawer && !drawer.hidden) {
      var items = [toggle].concat(Array.from(drawer.querySelectorAll('a[href], button:not([disabled]), [tabindex="0"]')))
        .filter(function (el) { return el && el.getClientRects().length > 0; });
      var first = items[0], last = items[items.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      return;
    }
    if (e.key !== "Escape") {
      return;
    }
    if (drawer && !drawer.hidden && !desktop.matches) {
      setDrawer(false);
      toggle.focus();
    } else if (mega && !mega.hidden) {
      setMega(false);
      megaButton.focus();
    }
  });

  /* Crossing the breakpoint resets both, so a drawer left open on a phone does
     not become a stuck overlay on a rotated tablet. */
  desktop.addEventListener("change", function (e) {
    setDrawer(false, false);
    if (e.matches) {
      if (drawer) {
        drawer.hidden = false;
      }
      if (toggle) {
        toggle.setAttribute("aria-expanded", "false");
        toggle.textContent = toggle.dataset.labelOpen;
      }
      setMega(false);
    } else {
      setDrawer(false);
      setMega(true);
    }
  });
})(document);
