/** Set the mobile action's initial state before paint. Without JavaScript,
 * the ordinary WhatsApp link remains visible and usable. */
(function (window, document) {
  "use strict";
  var fab = document.querySelector(".wa-fab");
  var firstSection = document.querySelector("main > section");
  var header = document.querySelector("[data-header]");
  if (!fab || !firstSection) return;
  var mobile = window.matchMedia("(max-width: 768px)");
  var scheduled = false;
  function update() {
    scheduled = false;
    var headerHeight = header ? header.getBoundingClientRect().height : 0;
    var visible = !mobile.matches || firstSection.getBoundingClientRect().bottom <= headerHeight;
    fab.setAttribute("data-wa-visible", visible ? "true" : "false");
    if (visible) {
      fab.removeAttribute("aria-hidden");
      fab.removeAttribute("tabindex");
    } else {
      fab.setAttribute("aria-hidden", "true");
      fab.setAttribute("tabindex", "-1");
      if (document.activeElement === fab) {
        var fallback = firstSection.querySelector('a[href], button') || document.querySelector("[data-nav-toggle]");
        if (fallback) fallback.focus({ preventScroll: true });
      }
    }
  }
  function schedule() {
    if (!scheduled) {
      scheduled = true;
      window.requestAnimationFrame(update);
    }
  }
  update();
  window.addEventListener("scroll", schedule, { passive: true });
  window.addEventListener("resize", schedule);
  window.addEventListener("pageshow", schedule);
  window.addEventListener("load", schedule);
  mobile.addEventListener("change", schedule);
  if (window.ResizeObserver) {
    var observer = new ResizeObserver(schedule);
    observer.observe(firstSection);
    if (header) observer.observe(header);
  }
})(window, document);
