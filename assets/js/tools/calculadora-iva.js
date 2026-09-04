/**
 * IVA calculator (plan §6.3.3): incluido = monto × tasa ÷ (100 + tasa);
 * excluido = monto × tasa ÷ 100, sumado al monto para el total.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("iva-form");
  if (!form) {
    return;
  }

  var montoInput = document.getElementById("iva-monto");
  var tasaSelect = document.getElementById("iva-tasa");
  var resultBox  = document.getElementById("iva-result");
  var baseLine   = document.getElementById("iva-base");
  var ivaLine    = document.getElementById("iva-monto-iva");
  var totalLine  = document.getElementById("iva-total");
  var useResultBtn = document.getElementById("iva-use-result");
  var lastResult = null;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var monto = parseFloat(montoInput.value) || 0;
    var tasa = parseFloat(tasaSelect.value) || 0;
    var sentido = (form.querySelector('input[name="sentido"]:checked') || {}).value || "incluido";

    if (monto <= 0) {
      montoInput.focus();
      return;
    }

    var base, iva, total;
    if (tasa === 0) {
      base = monto;
      iva = 0;
      total = monto;
    } else if (sentido === "incluido") {
      iva = (monto * tasa) / (100 + tasa);
      base = monto - iva;
      total = monto;
    } else {
      base = monto;
      iva = (monto * tasa) / 100;
      total = base + iva;
    }

    resultBox.hidden = false;
    baseLine.textContent = window.PY.fmtGs(base);
    ivaLine.textContent = window.PY.fmtGs(iva);
    totalLine.textContent = window.PY.fmtGs(total);
    resultBox.scrollIntoView({ behavior: "smooth", block: "nearest" });

    lastResult = { base: base, iva: iva, total: total, tasa: tasa };
    window.ToolsShared.trackToolUsed("calculadora-iva", { tasa: tasa, sentido: sentido });
  });

  if (useResultBtn) {
    useResultBtn.addEventListener("click", function () {
      if (!lastResult) {
        return;
      }
      var leadForm = document.querySelector("[data-lead-form]");
      window.ToolsShared.prefillLeadForm(leadForm, {
        need: "contabilidad",
        message:
          "Calculé un IVA de " + window.PY.fmtGs(lastResult.iva) + " sobre un total de " +
          window.PY.fmtGs(lastResult.total) + " con la calculadora del sitio."
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
