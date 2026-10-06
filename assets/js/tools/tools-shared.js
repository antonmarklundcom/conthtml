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
  var generated = new WeakMap();

  /** Fires tool_used through the site analytics helper, a no-op without a GA id. */
  function trackToolUsed(tool, params) {
    if (window.siteAnalytics) {
      window.siteAnalytics.track("tool_used", Object.assign({ tool: tool }, params || {}));
    }
  }

  /** Writes a hidden field's value when the field exists. */
  function setHidden(form, name, value) {
    var input = form.querySelector('input[type="hidden"][name="' + name + '"]');
    if (input) {
      input.value = value;
    }
  }

  /**
   * Checks the matching "¿Qué necesita?" chip and writes the result summary
   * into the message field of the page's lead form, so the CTA opens the form
   * with the calculation already attached instead of a blank page.
   *
   * C1 (plan §5.3.2): also attaches what the visitor computed as `tool_result`,
   * and lets a tool point the lead at the service its own answer implies — the
   * quiz's "abrir empresa" branch is a tier-A apertura lead, not a tier-C quiz
   * lead. enviar.php re-resolves the tier from whichever slug arrives, so
   * nothing here decides a lead's value.
   */
  function prefillLeadForm(form, options) {
    if (!form) {
      return;
    }
    var need = (options && options.need) || "";
    var message = (options && options.message) || "";
    var result = (options && options.result) || "";
    var service = options && options.service;
    var prior = generated.get(form);
    var serviceField = form.querySelector('[name="service"]');
    var checked = form.querySelector('[name="need"]:checked');
    var originalService = prior ? prior.originalService : (serviceField && serviceField.value);
    var originalNeed = prior ? prior.originalNeed : (checked && checked.value);

    if (need) {
      var radio = form.querySelector('input[name="need"][value="' + need + '"]');
      if (radio) {
        radio.checked = true;
      }
    }
    if (message) {
      var textarea = form.querySelector('textarea[name="message"]');
      if (textarea) {
        var original = prior ? (textarea.value === prior.complete ? prior.original : textarea.value.replace(prior.chunk, "").trim()) : textarea.value;
        textarea.value = original ? original + "\n\n" + message : message;
        generated.set(form, { original: original, complete: textarea.value, chunk: message,
          originalService: originalService, originalNeed: originalNeed, service: service, need: need });
      }
    }
    if (result) {
      setHidden(form, "tool_result", String(result).slice(0, 500));
    }
    if (service) {
      setHidden(form, "service", service);
    }
  }

  /** Scrolls the lead form into view and focuses its first visible field. */
  function focusLeadForm(form) {
    if (!form) {
      return;
    }
    form.scrollIntoView({ behavior: motion(), block: "start" });
    var firstField = form.querySelector(
      'input[type="text"], input[type="tel"], input:not([type])'
    );
    if (firstField && typeof firstField.focus === "function") {
      firstField.focus({ preventScroll: true });
    }
  }

  function motion() {
    return window.matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth";
  }

  function showResult(result) {
    if (!result) return;
    result.hidden = false;
    result.tabIndex = -1;
    result.scrollIntoView({ behavior: motion(), block: "nearest" });
    result.focus({ preventScroll: true });
  }

  document.querySelectorAll(".tool-result").forEach(function (result) {
    var print = document.createElement("button");
    print.type = "button";
    print.className = "btn btn--secondary print-action";
    print.setAttribute("data-print", "");
    print.textContent = "Imprimir resultado";
    result.appendChild(print);
  });

  document.querySelectorAll(".tool-form").forEach(function (toolForm) {
    function invalidate() {
      document.querySelectorAll(".tool-result").forEach(function (result) { result.hidden = true; });
      document.querySelectorAll('[name="tool_result"]').forEach(function (input) { input.value = ""; });
      document.querySelectorAll("[data-lead-form]").forEach(function (leadForm) {
        var prior = generated.get(leadForm);
        var textarea = leadForm.querySelector('textarea[name="message"]');
        if (prior && textarea) {
          textarea.value = textarea.value === prior.complete ? prior.original : textarea.value.replace(prior.chunk, "").trim();
          var service = leadForm.querySelector('[name="service"]');
          if (service && prior.service && service.value === prior.service) service.value = prior.originalService || "";
          var selected = leadForm.querySelector('[name="need"]:checked');
          if (selected && selected.value === prior.need) {
            selected.checked = false;
            leadForm.querySelectorAll('[name="need"]').forEach(function (radio) { radio.checked = radio.value === prior.originalNeed; });
          }
          generated.delete(leadForm);
        }
      });
    }
    // Clear the previous answer before calculators that recompute on change.
    toolForm.addEventListener("input", invalidate, true);
    toolForm.addEventListener("change", invalidate, true);
  });

  window.ToolsShared = {
    setHidden: setHidden,
    trackToolUsed: trackToolUsed,
    prefillLeadForm: prefillLeadForm,
    focusLeadForm: focusLeadForm,
    showResult: showResult
  };
})(window, document);
