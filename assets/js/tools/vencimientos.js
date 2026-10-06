/**
 * Vencimientos de IVA, IRE e IPS según la terminación de RUC (plan §6.3.2).
 * The Calendario Perpetuo table itself comes from the #vencimientos-data JSON
 * block (content/vencimientos.php), not hardcoded here — it is data, not
 * calculation logic, so there is one source of truth.
 */
(function (document) {
  "use strict";

  var form = document.getElementById("vencimientos-form");
  if (!form) {
    return;
  }

  var dataEl = document.getElementById("vencimientos-data");
  var data = JSON.parse(dataEl.textContent);

  var select     = document.getElementById("vencimientos-terminacion");
  var resultBox  = document.getElementById("vencimientos-result");
  var ivaEsteMes = document.getElementById("vencimientos-iva-este-mes");
  var ivaProximo = document.getElementById("vencimientos-iva-proximo-mes");
  var ipsLine    = document.getElementById("vencimientos-ips");
  var ireLine    = document.getElementById("vencimientos-ire");
  var waLink     = document.getElementById("vencimientos-recordar");
  var waBaseText = waLink ? new URL(waLink.href).searchParams.get("text") || "" : "";
  var remindResult = document.getElementById("vencimientos-recordatorio-result");

  var MESES = [
    "enero", "febrero", "marzo", "abril", "mayo", "junio",
    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
  ];

  function formatFecha(date) {
    return date.getDate() + " de " + MESES[date.getMonth()] + " de " + date.getFullYear();
  }

  function fechaVencimiento(year, monthIndex, dia) {
    var lastDay = new Date(year, monthIndex + 1, 0).getDate();
    return new Date(year, monthIndex, Math.min(dia, lastDay));
  }

  function calcular(e) {
    if (e) {
      e.preventDefault();
    }
    var digito = select.value;
    if (digito === "") {
      select.focus();
      return;
    }

    var dia = data.calendarioPerpetuo[digito];
    var now = new Date();
    var esteMes = fechaVencimiento(now.getFullYear(), now.getMonth(), dia);
    var siguiente = new Date(now.getFullYear(), now.getMonth() + 1, 1);
    var proximoMes = fechaVencimiento(siguiente.getFullYear(), siguiente.getMonth(), dia);

    resultBox.hidden = false;
    ivaEsteMes.textContent = formatFecha(esteMes);
    ivaProximo.textContent = formatFecha(proximoMes);
    ipsLine.textContent = "Del día " + data.ipsMensual.diaDesde + " al " + data.ipsMensual.diaHasta +
      " del mes siguiente al liquidado (no depende de su RUC).";
    ireLine.textContent = data.ireAnual.nota;
    window.ToolsShared.showResult(resultBox);

    if (waLink.dataset.waConfigured === "1") {
      var mensaje = waBaseText + "\n\nMi RUC termina en " + digito +
        ". Próximo vencimiento de IVA: " + formatFecha(proximoMes) + ".";
      waLink.href = "https://wa.me/" + waLink.dataset.waNumber + "?text=" + encodeURIComponent(mensaje);
    }

    /* The reminder lead carries what the visitor actually asked to be
       reminded about (plan §5.3.6): their RUC terminación and the next date. */
    if (remindResult) {
      remindResult.value = "RUC termina en " + digito +
        "; próximo vencimiento de IVA: " + formatFecha(proximoMes);
    }

    window.ToolsShared.trackToolUsed("vencimientos", { ruc_terminacion: digito });
  }

  form.addEventListener("submit", calcular);
  select.addEventListener("change", calcular);
})(document);
