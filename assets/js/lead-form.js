/**
 * Upgrades the lead form from a full page POST to an inline success message.
 *
 * Without this file the form still works: enviar.php answers a normal POST with
 * a redirect to /contacto/?enviado=1. Everything here is an enhancement, so any
 * failure falls back to submitting the form the ordinary way.
 */
(function (document) {
  "use strict";

  document.querySelectorAll("[data-lead-form]").forEach(function (form) {
    var button = form.querySelector("[data-submit]");
    var ok = form.querySelector("[data-form-ok]");
    var error = form.querySelector("[data-form-error]");
    var label = button ? button.textContent : "";
    var sending = false;

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
            throw new Error(data && data.error ? data.error : "failed");
          }
          form.querySelectorAll("input:not([type=hidden]), textarea").forEach(function (field) {
            if (field.type === "radio") {
              field.checked = false;
            } else {
              field.value = "";
            }
          });
          if (ok) {
            ok.hidden = false;
            ok.focus && ok.focus();
          }
          if (window.siteAnalytics) {
            window.siteAnalytics.track("lead_submit", {
              form_id: (form.querySelector("[name=form_id]") || {}).value || "",
              degraded: !!data.degraded
            });
          }
        })
        .catch(function () {
          if (error) error.hidden = false;
        })
        .finally(function () {
          sending = false;
          if (button) {
            button.disabled = false;
            button.textContent = label;
          }
        });
    });
  });
})(document);
