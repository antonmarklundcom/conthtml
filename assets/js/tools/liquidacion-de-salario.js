/**
 * Finiquito / liquidación de salario (plan §6.3.1c). Mirrors the rule tables
 * in content/laboral.php exactly — both files must be updated together if the
 * law changes:
 *
 *   - Vacaciones (Art. 218 CT): 12 / 18 / 30 días según antigüedad.
 *   - Preaviso (Art. 87 CT): 30 / 45 / 60 / 90 días según antigüedad.
 *   - Indemnización (Art. 91 CT): 15 días de salario por año de servicio o
 *     fracción superior a seis meses; solo en despido sin causa justificada.
 *   - Aporte obrero IPS: 9 %, sobre los conceptos remunerativos (salario y
 *     vacaciones proporcionales); no sobre el aguinaldo, el preaviso ni la
 *     indemnización.
 *
 * A month is treated as 30 days throughout, the usual Paraguayan payroll
 * convention — the page states this next to the result.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("finiquito-form");
  if (!form) {
    return;
  }

  var DIAS_POR_MES = 30;
  var IPS_OBRERO = 0.09;
  var INDEMNIZACION_DIAS_POR_ANIO = 15;
  var VACACIONES = [
    { hasta: 5, dias: 12 },
    { hasta: 10, dias: 18 },
    { hasta: null, dias: 30 }
  ];
  var PREAVISO = [
    { hasta: 1, dias: 30 },
    { hasta: 5, dias: 45 },
    { hasta: 10, dias: 60 },
    { hasta: null, dias: 90 }
  ];

  function tierDias(tiers, anios) {
    for (var i = 0; i < tiers.length; i++) {
      if (tiers[i].hasta === null || anios <= tiers[i].hasta) {
        return tiers[i].dias;
      }
    }
    return tiers[tiers.length - 1].dias;
  }

  /** Full completed months of service between two dates, calendar-accurate. */
  function monthsBetween(d1, d2) {
    var months = (d2.getFullYear() - d1.getFullYear()) * 12 + (d2.getMonth() - d1.getMonth());
    if (d2.getDate() < d1.getDate()) {
      months--;
    }
    return Math.max(0, months);
  }

  /** Days actually worked within one calendar month, on a 30-day-month basis. */
  function daysInMonthWorked(year, monthIndex, ingreso, egreso) {
    var monthStart = new Date(year, monthIndex, 1);
    var monthEnd = new Date(year, monthIndex + 1, 0);
    var start = ingreso > monthStart ? ingreso : monthStart;
    var end = egreso < monthEnd ? egreso : monthEnd;
    if (start > end) {
      return 0;
    }
    var startDay = Math.min(start.getDate(), DIAS_POR_MES);
    var endDay = Math.min(end.getDate(), DIAS_POR_MES);
    return Math.max(0, endDay - startDay + 1);
  }

  var resultBox   = document.getElementById("finiquito-result");
  var linesList   = document.getElementById("finiquito-lines");
  var totalLine   = document.getElementById("finiquito-total");
  var noteLine    = document.getElementById("finiquito-note");
  var useResultBtn = document.getElementById("finiquito-use-result");
  var lastResult  = null;

  function addLine(label, amount) {
    var dt = document.createElement("dt");
    dt.textContent = label;
    var dd = document.createElement("dd");
    dd.textContent = window.PY.fmtGs(amount);
    linesList.appendChild(dt);
    linesList.appendChild(dd);
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var ingreso = new Date(document.getElementById("finiquito-ingreso").value);
    var egreso  = new Date(document.getElementById("finiquito-egreso").value);
    var salario = parseFloat(document.getElementById("finiquito-salario").value) || 0;
    var motivo  = document.getElementById("finiquito-motivo").value;

    if (!(ingreso instanceof Date) || isNaN(ingreso) || !(egreso instanceof Date) || isNaN(egreso) || egreso <= ingreso || salario <= 0) {
      return;
    }

    var salarioDiario = salario / DIAS_POR_MES;
    var totalMonths = monthsBetween(ingreso, egreso);
    var aniosCumplidos = Math.floor(totalMonths / 12);
    var mesesResto = totalMonths % 12;

    var diasUltimoMes = daysInMonthWorked(egreso.getFullYear(), egreso.getMonth(), ingreso, egreso);
    var salarioProporcional = diasUltimoMes * salarioDiario;

    var diasVacTier = tierDias(VACACIONES, aniosCumplidos);
    var vacacionesProporcional = (diasVacTier / 12) * mesesResto * salarioDiario;

    var inicioAnio = new Date(egreso.getFullYear(), 0, 1);
    var inicioAguinaldo = ingreso > inicioAnio ? ingreso : inicioAnio;
    var diasAguinaldo = 0;
    for (var m = inicioAguinaldo.getMonth(); m <= egreso.getMonth(); m++) {
      diasAguinaldo += daysInMonthWorked(egreso.getFullYear(), m, ingreso, egreso);
    }
    var aguinaldoProporcional = (salario / 12) * (diasAguinaldo / DIAS_POR_MES);

    var esDespidoInjustificado = motivo === "despido_injustificado";
    var diasPreaviso = esDespidoInjustificado ? tierDias(PREAVISO, aniosCumplidos) : 0;
    var preavisoMonto = diasPreaviso * salarioDiario;

    var aniosIndemnizacion = aniosCumplidos + (mesesResto >= 6 ? 1 : 0);
    var indemnizacionMonto = esDespidoInjustificado ? INDEMNIZACION_DIAS_POR_ANIO * aniosIndemnizacion * salarioDiario : 0;

    var ipsDeduccion = IPS_OBRERO * (salarioProporcional + vacacionesProporcional);

    var total = salarioProporcional + vacacionesProporcional + aguinaldoProporcional +
      preavisoMonto + indemnizacionMonto - ipsDeduccion;

    resultBox.hidden = false;
    linesList.innerHTML = "";
    addLine("Salario proporcional", salarioProporcional);
    addLine("Vacaciones proporcionales", vacacionesProporcional);
    addLine("Aguinaldo proporcional", aguinaldoProporcional);
    if (esDespidoInjustificado) {
      addLine("Preaviso (" + diasPreaviso + " días, si no se otorgó)", preavisoMonto);
      addLine("Indemnización (" + aniosIndemnizacion + " año(s) × 15 días)", indemnizacionMonto);
    }
    addLine("Aporte IPS 9 % (deducción)", -ipsDeduccion);

    totalLine.textContent = window.PY.fmtGs(total);
    noteLine.textContent = esDespidoInjustificado
      ? "Incluye preaviso e indemnización porque el motivo indicado es despido sin causa justificada. Antigüedad considerada: " + totalMonths + " meses."
      : "No corresponde preaviso ni indemnización porque el motivo no es un despido sin causa justificada. Antigüedad considerada: " + totalMonths + " meses.";
    resultBox.scrollIntoView({ behavior: "smooth", block: "nearest" });

    lastResult = { total: total, motivo: motivo };
    window.ToolsShared.trackToolUsed("liquidacion-de-salario", { motivo: motivo, meses: totalMonths });
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
          "Calculé un finiquito estimado de " + window.PY.fmtGs(lastResult.total) +
          " con la calculadora del sitio y quisiera confirmarlo."
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
