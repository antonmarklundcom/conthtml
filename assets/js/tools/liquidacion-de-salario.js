/**
 * Finiquito / liquidación de salario (plan §6.3.1c). Mirrors the rule tables
 * in content/laboral.php exactly — both files must be updated together if the
 * law changes:
 *
 *   - Vacaciones (Art. 218 CT): 12 / 18 / 30 días según antigüedad.
 *     Tiers are "hasta N años" / "más de N años", compared on exact dates.
 *   - Preaviso (Art. 87 CT): 30 / 45 / 60 / 90 días según antigüedad.
 *   - Indemnización (Art. 91 CT): 15 días de salario por año de servicio o
 *     fracción de seis meses; solo en despido sin causa justificada. From 10
 *     years (estabilidad, Art. 94 CT) it can be doubled — shown as a note only.
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
  var ESTABILIDAD_ANIOS = 10;
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

  /**
   * The law's tiers read "hasta N años" / "más de N años": a worker with 1 year
   * and 1 day is already "más de un año". So the tier is picked from the exact
   * dates (egreso after ingreso + N years), not from completed years — using
   * completed years put 1 year 3 months in the 30-day preaviso tier.
   */
  function tierDias(tiers, ingreso, egreso) {
    for (var i = 0; i < tiers.length; i++) {
      if (tiers[i].hasta === null || egreso <= addYears(ingreso, tiers[i].hasta)) {
        return tiers[i].dias;
      }
    }
    return tiers[tiers.length - 1].dias;
  }

  function addYears(date, years) {
    return new Date(date.getFullYear() + years, date.getMonth(), date.getDate());
  }

  /**
   * Parses an <input type="date"> value as a LOCAL date. new Date("2026-03-01")
   * is UTC midnight, which in Paraguay (UTC-3) is still 28 February — every
   * date would land one day early.
   */
  function parseLocalDate(value) {
    var m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(value || "");
    return m ? new Date(+m[1], +m[2] - 1, +m[3]) : new Date(NaN);
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
    // Working through the month's last day is a full 30-day month, also in
    // February (28/29 days) — otherwise a full February paid 28 days.
    var endDay = end.getTime() === monthEnd.getTime() ? DIAS_POR_MES : Math.min(end.getDate(), DIAS_POR_MES);
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

    var ingreso = parseLocalDate(document.getElementById("finiquito-ingreso").value);
    var egreso  = parseLocalDate(document.getElementById("finiquito-egreso").value);
    var salario = parseFloat(document.getElementById("finiquito-salario").value) || 0;
    var motivo  = document.getElementById("finiquito-motivo").value;

    if (!(ingreso instanceof Date) || isNaN(ingreso) || !(egreso instanceof Date) || isNaN(egreso) || egreso <= ingreso || salario <= 0) {
      return;
    }

    var salarioDiario = salario / DIAS_POR_MES;
    // The egreso date is the last day worked, so service runs up to the
    // following day: 1 Jan → 31 Dec is a full 12 months, not 11.
    var finServicio = new Date(egreso.getFullYear(), egreso.getMonth(), egreso.getDate() + 1);
    var totalMonths = monthsBetween(ingreso, finServicio);
    var aniosCumplidos = Math.floor(totalMonths / 12);
    var mesesResto = totalMonths % 12;

    var diasUltimoMes = daysInMonthWorked(egreso.getFullYear(), egreso.getMonth(), ingreso, egreso);
    var salarioProporcional = diasUltimoMes * salarioDiario;

    var diasVacTier = tierDias(VACACIONES, ingreso, finServicio);
    var vacacionesProporcional = (diasVacTier / 12) * mesesResto * salarioDiario;

    var inicioAnio = new Date(egreso.getFullYear(), 0, 1);
    var inicioAguinaldo = ingreso > inicioAnio ? ingreso : inicioAnio;
    var diasAguinaldo = 0;
    for (var m = inicioAguinaldo.getMonth(); m <= egreso.getMonth(); m++) {
      diasAguinaldo += daysInMonthWorked(egreso.getFullYear(), m, ingreso, egreso);
    }
    var aguinaldoProporcional = (salario / 12) * (diasAguinaldo / DIAS_POR_MES);

    var esDespidoInjustificado = motivo === "despido_injustificado";
    var diasPreaviso = esDespidoInjustificado ? tierDias(PREAVISO, ingreso, finServicio) : 0;
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
    var nota = esDespidoInjustificado
      ? "Incluye preaviso e indemnización porque el motivo indicado es despido sin causa justificada. Antigüedad considerada: " + totalMonths + " meses."
      : "No corresponde preaviso ni indemnización porque el motivo no es un despido sin causa justificada. Antigüedad considerada: " + totalMonths + " meses.";
    nota += " No incluye vacaciones de años anteriores ya generadas y no gozadas: si las tiene pendientes, se suman aparte.";
    if (esDespidoInjustificado && aniosCumplidos >= ESTABILIDAD_ANIOS) {
      nota += " Con 10 años o más de antigüedad rige la estabilidad laboral (Art. 94 CT): un despido sin causa " +
        "puede dar derecho a reintegro o a indemnización doble, que este cálculo no incluye. Consulte su caso.";
    }
    noteLine.textContent = nota;
    window.ToolsShared.showResult(resultBox);

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
          " con la calculadora del sitio y quisiera confirmarlo.",
        result: "Finiquito " + window.PY.fmtGs(lastResult.total) + " (" + lastResult.motivo + ")"
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
