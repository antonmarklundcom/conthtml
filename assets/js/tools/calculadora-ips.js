/**
 * IPS contribution calculator: aporte obrero and patronal on a monthly gross
 * salary. The rates and the salario mínimo are read from the tool's data
 * attributes, which herramientas/calculadora-ips/index.php fills from
 * content/laboral.php — there is no second copy of them here.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("ips-form");
  var tool = document.querySelector('[data-tool="calculadora-ips"]');
  if (!form || !tool) {
    return;
  }

  var OBRERO = parseFloat(tool.getAttribute("data-ips-obrero"));
  var PATRONAL = parseFloat(tool.getAttribute("data-ips-patronal"));
  var MINIMO = parseFloat(tool.getAttribute("data-salario-minimo"));

  var salarioInput = document.getElementById("ips-salario");
  var minimoBtn = document.getElementById("ips-usar-minimo");
  var resultBox = document.getElementById("ips-result");
  var note = document.getElementById("ips-note");
  var useResultBtn = document.getElementById("ips-use-result");
  var lastResult = null;

  function setLine(id, amount) {
    document.getElementById(id).textContent = window.PY.fmtGs(amount);
  }

  /* Guaraníes have no subunit: each contribution is rounded on its own, the
     way it appears on a recibo, and the totals add the rounded figures. */
  function calcular(salario) {
    var obrero = Math.round(salario * OBRERO);
    var patronal = Math.round(salario * PATRONAL);
    return {
      salario: salario,
      obrero: obrero,
      neto: salario - obrero,
      patronal: patronal,
      total: obrero + patronal,
      costo: salario + patronal
    };
  }

  if (minimoBtn) {
    minimoBtn.addEventListener("click", function () {
      salarioInput.value = String(MINIMO);
      salarioInput.focus();
    });
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var salario = Math.round(parseFloat(salarioInput.value) || 0);
    if (salario <= 0) {
      salarioInput.focus();
      return;
    }

    var r = calcular(salario);
    setLine("ips-obrero", r.obrero);
    setLine("ips-neto", r.neto);
    setLine("ips-patronal", r.patronal);
    setLine("ips-total", r.total);
    setLine("ips-costo", r.costo);

    if (salario < MINIMO) {
      note.textContent =
        "Este salario está por debajo del mínimo legal de " + window.PY.fmtGs(MINIMO) +
        " para una jornada completa. El aporte se calcula igual sobre el salario declarado.";
      note.hidden = false;
    } else {
      note.textContent = "";
      note.hidden = true;
    }

    resultBox.hidden = false;
    window.ToolsShared.showResult(resultBox);

    lastResult = r;
    window.ToolsShared.trackToolUsed("calculadora-ips", { minimo: salario === MINIMO });
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
          "Calculé el aporte IPS de un salario de " + window.PY.fmtGs(lastResult.salario) +
          " con la calculadora del sitio y quiero ayuda con la planilla.",
        result:
          "IPS sobre " + window.PY.fmtGs(lastResult.salario) + ": obrero " +
          window.PY.fmtGs(lastResult.obrero) + ", patronal " + window.PY.fmtGs(lastResult.patronal)
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
