/**
 * "¿Qué necesita?" quiz (plan §6.3.5). Question 1 (¿qué es usted?) takes
 * priority when it is "quiero abrir una empresa"; otherwise question 2 (la
 * preocupación) picks the services, and question 3 (¿tiene contador?)
 * overrides the lead-form "need" chip to "cambio" when the visitor wants to
 * switch. The service paths below mirror content/services.php — if a path
 * changes there, update it here too.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("quenecesita-form");
  if (!form) {
    return;
  }

  var resultBox  = document.getElementById("quenecesita-result");
  var resultText = document.getElementById("quenecesita-text");
  var linksList  = document.getElementById("quenecesita-links");
  var useResultBtn = document.getElementById("quenecesita-use-result");
  var lastResult = null;

  var SERVICIOS = {
    contabilidad: { label: "Contabilidad mensual", path: "/contabilidad/" },
    iva:          { label: "IVA e impuestos", path: "/iva/" },
    ips:          { label: "Nómina e IPS", path: "/ips/" },
    ekuatia:      { label: "Facturación electrónica (Ekuatia'i)", path: "/ekuatia/" },
    auditoria:    { label: "Auditoría", path: "/auditoria/" },
    eas:          { label: "Apertura de empresa (EAS)", path: "/eas/" },
    ruc:          { label: "Inscripción de RUC", path: "/ruc/" }
  };

  var RECOMENDACIONES = {
    quiero_abrir: {
      text: "Está por abrir una empresa: le ayudamos con la constitución y la inscripción de RUC de punta a punta.",
      servicios: ["eas", "ruc"],
      need: "apertura"
    },
    impuestos_dnit: {
      text: "Su prioridad son los impuestos y la DNIT: le llevamos la contabilidad y las declaraciones al día.",
      servicios: ["contabilidad", "iva"],
      need: "contabilidad"
    },
    nomina: {
      text: "Necesita ayuda con nómina y empleados: liquidamos sueldos, aguinaldo y los aportes de IPS.",
      servicios: ["ips"],
      need: "nomina"
    },
    facturacion_electronica: {
      text: "Quiere resolver la facturación electrónica: lo habilitamos en SIFEN y ponemos en marcha Ekuatia'i.",
      servicios: ["ekuatia"],
      need: "sifen"
    },
    auditoria: {
      text: "Necesita una auditoría con respaldo profesional para bancos, socios u organismos de control.",
      servicios: ["auditoria"],
      need: "otro"
    }
  };

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var quien = (form.querySelector('input[name="quien"]:checked') || {}).value || "persona_fisica";
    var preocupacion = (form.querySelector('input[name="preocupacion"]:checked') || {}).value || "impuestos_dnit";
    var contador = (form.querySelector('input[name="contador"]:checked') || {}).value || "primera_vez";

    var key = quien === "quiero_abrir" ? "quiero_abrir" : preocupacion;
    var recomendacion = RECOMENDACIONES[key] || RECOMENDACIONES.impuestos_dnit;
    var need = contador === "cambiar" ? "cambio" : recomendacion.need;

    resultBox.hidden = false;
    resultText.textContent = recomendacion.text;
    linksList.innerHTML = "";
    recomendacion.servicios.forEach(function (slug) {
      var servicio = SERVICIOS[slug];
      if (!servicio) {
        return;
      }
      var li = document.createElement("li");
      var a = document.createElement("a");
      a.href = servicio.path;
      a.textContent = servicio.label;
      var span = document.createElement("span");
      span.appendChild(a);
      li.appendChild(span);
      linksList.appendChild(li);
    });
    resultBox.scrollIntoView({ behavior: "smooth", block: "nearest" });

    lastResult = { text: recomendacion.text, need: need, service: recomendacion.servicios[0] || "" };
    window.ToolsShared.trackToolUsed("que-necesita", { quien: quien, preocupacion: preocupacion, contador: contador });
  });

  if (useResultBtn) {
    useResultBtn.addEventListener("click", function () {
      if (!lastResult) {
        return;
      }
      var leadForm = document.querySelector("[data-lead-form]");
      window.ToolsShared.prefillLeadForm(leadForm, {
        need: lastResult.need,
        message: "Completé el cuestionario ¿Qué necesita? y la recomendación fue: " + lastResult.text,
        result: "Recomendación del cuestionario: " + lastResult.text,
        /* The quiz's branch decides the lead's service, and with it its tier —
           an "abrir empresa" answer is a tier-A apertura lead, not a tier-C
           quiz lead (docs/lead-value.md, Anton's priority services). */
        service: lastResult.service
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
