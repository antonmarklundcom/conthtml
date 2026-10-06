/** One accessible picker for every WhatsApp action. Direct hrefs remain
 * usable without JavaScript; choosing an option opens WhatsApp. */
(function (window, document) {
  "use strict";
  var menu = document.querySelector("[data-wa-menu]");
  if (!menu) return;
  var panel = menu.querySelector(".wa-menu__panel");
  var options = Array.prototype.slice.call(menu.querySelectorAll(".wa-menu__option"));
  var triggers = Array.prototype.slice.call(document.querySelectorAll('a[href^="https://wa.me/"]'))
    .filter(function (link) { return !menu.contains(link); });
  var lastTrigger = null;
  var savedOverflow = "";
  var inertElements = [];
  var pageOption = options.find(function (option) { return option.classList.contains("wa-menu__option--current"); });
  var pageService = pageOption ? pageOption.dataset.service : "";
  var defaults = options.map(function (option) {
    return { href: option.href, service: option.dataset.service };
  });

  triggers.forEach(function (trigger) {
    trigger.setAttribute("role", "button");
    trigger.setAttribute("aria-haspopup", "dialog");
    trigger.setAttribute("aria-controls", menu.id);
    trigger.setAttribute("aria-expanded", "false");
    trigger.setAttribute("data-wa-trigger", "");
    trigger.setAttribute("data-wa-enhanced", "");
  });

  function isOpen() { return !menu.hidden; }

  function prepareOptions(trigger) {
    var service = trigger.dataset.service || pageService;
    var current = service ? options.find(function (option) {
      return option.dataset.waServices.split(",").indexOf(service) !== -1;
    }) : null;
    var triggerText = new URL(trigger.href).searchParams.get("text") || "";
    // Form recovery details and calculator results follow the page attribution.
    // Carry that suffix into every choice, never into the next menu opening.
    var context = triggerText.match(/\n(?:Página|Page):[^\n]*(\n[\s\S]*)?$/);
    var suffix = context && context[1] ? context[1] : "";
    options.forEach(function (option, index) {
      var url = new URL(defaults[index].href);
      if (suffix) url.searchParams.set("text", (url.searchParams.get("text") || "") + suffix);
      option.href = option === current ? trigger.href : url.href;
      option.dataset.service = option === current ? service : defaults[index].service;
      option.classList.toggle("wa-menu__option--current", option === current);
      option.querySelector(".wa-menu__badge").hidden = option !== current;
    });
    return current || options[0];
  }

  function open(trigger) {
    // The header releases its drawer's focus trap and scroll lock first.
    document.dispatchEvent(new CustomEvent("whatsapp:open"));
    var first = prepareOptions(trigger);
    lastTrigger = trigger;
    savedOverflow = document.body.style.overflow;
    document.body.style.overflow = "hidden";
    inertElements = Array.prototype.slice.call(document.body.children).filter(function (element) {
      return element !== menu && !element.contains(menu) && !element.inert && !/^(SCRIPT|STYLE|LINK)$/.test(element.tagName);
    });
    inertElements.forEach(function (element) { element.inert = true; });
    menu.hidden = false;
    trigger.setAttribute("aria-expanded", "true");
    first.focus({ preventScroll: true });
    if (window.siteAnalytics) {
      window.siteAnalytics.track("whatsapp_menu_open", { page_path: window.location.pathname });
    }
  }

  function close(returnFocus) {
    if (!isOpen()) return;
    menu.hidden = true;
    document.body.style.overflow = savedOverflow;
    inertElements.forEach(function (element) { element.inert = false; });
    inertElements = [];
    triggers.forEach(function (trigger) { trigger.setAttribute("aria-expanded", "false"); });
    if (returnFocus && lastTrigger) {
      var visible = lastTrigger.getClientRects().length && window.getComputedStyle(lastTrigger).visibility !== "hidden";
      var target = visible ? lastTrigger : document.querySelector("[data-nav-toggle]");
      if (target) target.focus({ preventScroll: true });
    }
    lastTrigger = null;
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener("click", function (event) {
      if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
      event.preventDefault();
      if (isOpen()) close(true);
      else open(trigger);
    });
    trigger.addEventListener("keydown", function (event) {
      if (event.key === " " || event.key === "Spacebar") {
        event.preventDefault();
        if (!isOpen()) open(trigger);
      }
    });
  });
  menu.querySelectorAll("[data-wa-close]").forEach(function (closer) {
    closer.addEventListener("click", function (event) {
      event.preventDefault();
      close(true);
    });
  });
  options.forEach(function (option) {
    option.addEventListener("click", function () { close(false); });
  });
  document.addEventListener("keydown", function (event) {
    if (!isOpen()) return;
    if (event.key === "Escape") {
      event.preventDefault();
      close(true);
      return;
    }
    if (event.key !== "Tab") return;
    var focusable = panel.querySelectorAll('a[href], button');
    var first = focusable[0], last = focusable[focusable.length - 1];
    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });
})(window, document);
