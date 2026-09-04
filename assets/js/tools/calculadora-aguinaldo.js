/**
 * Aguinaldo = doceava parte de las remuneraciones percibidas en el año
 * (plan §6.3.1b). Both modes reduce to the same formula: sum the
 * remuneraciones considered, divide by 12 — the "detalle" mode is naturally
 * proportional because unworked months are simply left blank.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("aguinaldo-form");
  if (!form) {
    return;
  }

  var modoSelect   = document.getElementById("aguinaldo-modo");
  var mismoRow     = document.getElementById("aguinaldo-mismo");
  var detalleRow   = document.getElementById("aguinaldo-detalle");
  var salarioInput = document.getElementById("aguinaldo-salario");
  var mesesInput   = document.getElementById("aguinaldo-meses");
  var resultBox    = document.getElementById("aguinaldo-result");
  var resultValue  = document.getElementById("aguinaldo-result-value");
  var resultDetail = document.getElementById("aguinaldo-result-detail");
  var useResultBtn = document.getElementById("aguinaldo-use-result");

  var lastResult = null;

  function toggleMode() {
    var detalle = modoSelect.value === "detalle";
    mismoRow.hidden = detalle;
    detalleRow.hidden = !detalle;
  }
  modoSelect.addEventListener("change", toggleMode);
  toggleMode();

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var total = 0;
    var mesesConsiderados = 0;

    if (modoSelect.value === "detalle") {
      form.querySelectorAll(".aguinaldo-mes-input").forEach(function (input) {
        var value = parseFloat(input.value) || 0;
        if (value > 0) {
          total += value;
          mesesConsiderados++;
        }
      });
    } else {
      var salario = parseFloat(salarioInput.value) || 0;
      var meses = Math.min(12, Math.max(1, parseInt(mesesInput.value, 10) || 0));
      total = salario * meses;
      mesesConsiderados = meses;
    }

    if (total <= 0) {
      salarioInput && salarioInput.focus();
      return;
    }

    var aguinaldo = total / 12;
    lastResult = { aguinaldo: aguinaldo, total: total, meses: mesesConsiderados };

    resultBox.hidden = false;
    resultValue.textContent = window.PY.fmtGs(aguinaldo);
    resultDetail.textContent =
      "Sobre " + window.PY.fmtGs(total) + " de remuneraciones consideradas (" +
      mesesConsiderados + (mesesConsiderados === 1 ? " mes trabajado" : " meses trabajados") +
      "), dividido entre 12.";
    resultBox.scrollIntoView({ behavior: "smooth", block: "nearest" });

    window.ToolsShared.trackToolUsed("calculadora-aguinaldo", { meses: mesesConsiderados });
  });

  if (useResultBtn) {
    useResultBtn.addEventListener("click", function () {
      if (!lastResult) {
        return;
      }
      var leadForm = document.querySelector("[data-lead-form]");
      window.ToolsShared.prefillLeadForm(leadForm, {
        need: "nomina",
        message:
          "Calculé un aguinaldo estimado de " + window.PY.fmtGs(lastResult.aguinaldo) +
          " con la calculadora del sitio y quisiera confirmarlo."
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
