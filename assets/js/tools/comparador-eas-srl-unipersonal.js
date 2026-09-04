/**
 * 3-question mini quiz (plan §6.3.4). Socios decides SRL vs. the single-owner
 * forms; patrimonio then decides EAS vs. Unipersonal. Facturación does not
 * change the recommended form (the three tax the same way — content/tools.php
 * FAQ says so), but is read to tailor the message.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("comparador-form");
  if (!form) {
    return;
  }

  var resultBox   = document.getElementById("comparador-result");
  var resultTitle = document.getElementById("comparador-result-title");
  var resultText  = document.getElementById("comparador-result-text");
  var useResultBtn = document.getElementById("comparador-use-result");
  var lastResult  = null;

  var RECOMENDACIONES = {
    srl: {
      title: "Le conviene una SRL",
      text: "Con dos o más socios, la Sociedad de Responsabilidad Limitada reparte la responsabilidad " +
        "entre todos según su aporte y deja por escrito, en la escritura de constitución, cómo se toman " +
        "las decisiones."
    },
    eas: {
      title: "Le conviene una EAS",
      text: "Como socio único que quiere separar su patrimonio personal del de la empresa, la EAS le da " +
        "responsabilidad limitada al capital aportado, con un trámite más rápido por SUACE y sin " +
        "necesidad de escritura pública."
    },
    unipersonal: {
      title: "Le conviene una Unipersonal",
      text: "Como socio único sin necesidad de separar patrimonios por ahora, la Unipersonal es la forma " +
        "más rápida de empezar a facturar: solo inscribe su RUC como persona física."
    }
  };

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var socios = (form.querySelector('input[name="socios"]:checked') || {}).value || "uno";
    var patrimonio = (form.querySelector('input[name="patrimonio"]:checked') || {}).value || "separar";
    var facturacion = (form.querySelector('input[name="facturacion"]:checked') || {}).value || "baja";

    var key = socios === "varios" ? "srl" : (patrimonio === "separar" ? "eas" : "unipersonal");
    var recomendacion = RECOMENDACIONES[key];

    resultBox.hidden = false;
    resultTitle.textContent = recomendacion.title;
    resultText.textContent = recomendacion.text;
    resultBox.scrollIntoView({ behavior: "smooth", block: "nearest" });

    lastResult = { key: key, title: recomendacion.title };
    window.ToolsShared.trackToolUsed("comparador-eas-srl-unipersonal", {
      recomendacion: key, socios: socios, facturacion: facturacion, patrimonio: patrimonio
    });
  });

  if (useResultBtn) {
    useResultBtn.addEventListener("click", function () {
      if (!lastResult) {
        return;
      }
      var leadForm = document.querySelector("[data-lead-form]");
      window.ToolsShared.prefillLeadForm(leadForm, {
        need: "apertura",
        message: "Usé el comparador del sitio y la recomendación fue: " + lastResult.title + ". Quiero avanzar con la apertura.",
        result: "Recomendación del comparador: " + lastResult.title
      });
      window.ToolsShared.focusLeadForm(leadForm);
    });
  }
})(document);
