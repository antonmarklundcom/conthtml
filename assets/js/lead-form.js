/**
 * Upgrades the lead form from a full page POST to an inline success message.
 *
 * Without this file the form still works: enviar.php answers a normal POST with
 * a redirect to /contacto/?enviado=1&s=<slug>, which renders the same
 * per-service thank-you server-side. An uncertain delivery keeps the entered
 * details and the same submission key
 * so a retry can be deduplicated. The ordinary POST still works without JS.
 *
 * C1 (plan §5.3.4, §5.3.5): the thank-you and the conversion event both come
 * from the handler's own JSON response, not from anything computed here. The
 * server already resolved the service, its tier and the Ads conversion value
 * from content/lead-values.php; duplicating that logic in the browser is how
 * the two drift apart — and how a lead ends up reported at a value the CRM
 * never recorded.
 */
(function (document) {
  "use strict";

  /**
   * Rewrites the pre-rendered thank-you with what the server actually recorded.
   * The block already carries this page's copy, so a response with no `thanks`
   * (an older handler, a proxy that ate the body) simply leaves it as it is.
   */
  function renderThanks(node, thanks) {
    if (!node || !thanks) {
      return;
    }

    var list = node.querySelector(".thanks__steps");
    if (list && Array.isArray(thanks.steps) && thanks.steps.length) {
      list.innerHTML = "";
      thanks.steps.forEach(function (step) {
        var li = document.createElement("li");
        li.textContent = step;
        list.appendChild(li);
      });
    }

    var wa = node.querySelector(".btn--whatsapp");
    if (wa && thanks.whatsapp) {
      wa.href = thanks.whatsapp;
    }

    var next = node.querySelector(".btn--secondary");
    if (next && thanks.link && thanks.link.path) {
      next.href = thanks.link.path;
      next.textContent = thanks.link.label || next.textContent;
      next.hidden = false;
    } else if (next && !thanks.link) {
      next.hidden = true;
    }
  }

  document.querySelectorAll("[data-lead-form]").forEach(function (form) {
    var button = form.querySelector("[data-submit]");
    var ok = form.querySelector("[data-form-ok]");
    var error = form.querySelector("[data-form-error]");
    var label = button ? button.textContent : "";
    var sending = false;
    var errorMessage = error && error.querySelector("[data-form-error-message]");
    var defaultError = errorMessage ? errorMessage.textContent : "";

    /* Native validation must be able to focus an optional field even if the
       visitor closed its details panel after entering an invalid email. */
    form.addEventListener("invalid", function (event) {
      var details = event.target.closest("details");
      if (details) details.open = true;
    }, true);

    function showError(code) {
      if (!error) return;
      if (errorMessage) {
        errorMessage.textContent = ["phone", "email", "rate", "origin"].indexOf(code) !== -1
          ? form.dataset["error" + code.charAt(0).toUpperCase() + code.slice(1)] || defaultError
          : defaultError;
      }
      error.hidden = false;
      error.focus();
      error.scrollIntoView({ block: "center" });
    }

    function renewSubmissionKey() {
      var key = form.querySelector("[name=idempotency_key]");
      if (!key || !window.crypto || !window.crypto.getRandomValues) return;
      var bytes = window.crypto.getRandomValues(new Uint8Array(16));
      key.value = Array.from(bytes, function (byte) { return byte.toString(16).padStart(2, "0"); }).join("");
    }

    form.addEventListener("submit", function (e) {
      if (sending) {
        e.preventDefault();
        return;
      }
      if (!form.reportValidity()) {
        return;
      }

      e.preventDefault();
      sending = true;
      form.setAttribute("aria-busy", "true");
      if (ok) ok.hidden = true;
      if (error) error.hidden = true;
      if (button) {
        button.disabled = true;
        button.textContent = button.dataset.sending || label;
      }

      fetch(form.action, {
        method: "POST",
        headers: { Accept: "application/json" },
        body: new FormData(form)
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          if (!data || !data.ok) {
            var failed = new Error("delivery");
            failed.code = data && data.error ? data.error : "";
            throw failed;
          }
          form.querySelectorAll("input:not([type=hidden]), textarea").forEach(function (field) {
            if (field.type === "radio") {
              field.checked = false;
            } else {
              field.value = "";
            }
          });
          renewSubmissionKey();
          if (ok) {
            renderThanks(ok, data.thanks);
            ok.hidden = false;
            ok.focus && ok.focus();
            ok.scrollIntoView({ block: "center" });
          }
          if (window.siteAnalytics) {
            /* value + currency are what Google Ads bids on (plan §5.3.5), so
               they are reported exactly as the handler resolved them. */
            window.siteAnalytics.track("lead_submit", {
              form_id: (form.querySelector("[name=form_id]") || {}).value || "",
              service: data.service || "",
              value_tier: data.value_tier || "",
              value: data.value || 0,
              currency: data.currency || "PYG",
              degraded: !!data.degraded
            });
          }
        })
        .catch(function (failure) {
          showError(failure.code || "");
        })
        .finally(function () {
          sending = false;
          form.setAttribute("aria-busy", "false");
          if (button) {
            button.disabled = false;
            button.textContent = label;
          }
        });
    });
  });
})(document);
