/**
 * Analytics helper (plan §5.1.4b).
 *
 * track(event, params) pushes to dataLayer only when a GA4 id is configured;
 * with no id it is a silent no-op, so every phase can call it freely and
 * nothing breaks or leaks before B4 wires the tags.
 *
 * The id arrives from PHP as <body data-ga4="G-XXXX"> (empty until config.php
 * sets GA4_ID). Wires whatsapp_click on every wa.me link and phone_click on
 * every tel: link. B3 adds tool_used; B4 adds lead_submit and the GA4 tag.
 */
(function (window, document) {
  "use strict";

  var gaId = (document.body && document.body.dataset.ga4) || "";
  var enabled = gaId !== "";

  function track(event, params) {
    if (!enabled || !event) {
      return;
    }
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(
      Object.assign({ event: event }, params || {})
    );
  }

  /** Where the click happened, so events are attributable per page. */
  function context(el) {
    return {
      page_path: window.location.pathname,
      link_text: (el.textContent || "").trim().slice(0, 80)
    };
  }

  document.addEventListener(
    "click",
    function (e) {
      var link = e.target.closest && e.target.closest("a[href]");
      if (!link) {
        return;
      }
      var href = link.getAttribute("href") || "";

      if (href.indexOf("wa.me") !== -1 || href.indexOf("api.whatsapp.com") !== -1) {
        track("whatsapp_click", context(link));
      } else if (href.indexOf("tel:") === 0) {
        track("phone_click", context(link));
      }
    },
    true
  );

  window.siteAnalytics = { track: track, enabled: enabled };
})(window, document);
