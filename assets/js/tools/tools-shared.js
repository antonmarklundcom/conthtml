/**
 * Small helpers shared by every /herramientas/<slug>/ calculator (plan §6.3):
 * firing the tool_used analytics event and prefilling the page's lead form
 * with the calculated result, so each tool's own script only has to write its
 * calculation logic. Loaded before every tools/<slug>.js file.
 *
 * Depends on assets/js/py.js (fmtGs) and, optionally, assets/js/analytics.js
 * (window.siteAnalytics) — both are no-ops-safe when absent.
 */
(function (window, document) {
  "use strict";

  /** Fires tool_used through the site analytics helper, a no-op without a GA id. */
  function trackToolUsed(tool, params) {
    if (window.siteAnalytics) {
      window.siteAnalytics.track("tool_used", Object.assign({ tool: tool }, params || {}));
    }
  }

  /**
   * Checks the matching "¿Qué necesita?" chip and writes the result summary
   * into the message field of the page's lead form, so the CTA opens the form
   * with the calculation already attached instead of a blank page.
   */
  function prefillLeadForm(form, options) {
    if (!form) {
      return;
    }
    var need = (options && options.need) || "";
    var message = (options && options.message) || "";

    if (need) {
      var radio = form.querySelector('input[name="need"][value="' + need + '"]');
      if (radio) {
        radio.checked = true;
      }
    }
    if (message) {
      var textarea = form.querySelector('textarea[name="message"]');
      if (textarea) {
        textarea.value = message;
      }
    }
  }

  /** Scrolls the lead form into view and focuses its first visible field. */
  function focusLeadForm(form) {
    if (!form) {
      return;
    }
    form.scrollIntoView({ behavior: "smooth", block: "start" });
    var firstField = form.querySelector(
      'input[type="text"], input[type="tel"], input:not([type])'
    );
    if (firstField && typeof firstField.focus === "function") {
      firstField.focus({ preventScroll: true });
    }
  }

  window.ToolsShared = {
    trackToolUsed: trackToolUsed,
    prefillLeadForm: prefillLeadForm,
    focusLeadForm: focusLeadForm
  };
})(window, document);
