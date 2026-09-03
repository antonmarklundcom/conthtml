/**
 * Paraguay-specific client helpers, the JS counterparts of fmt_gs() and
 * validate_ruc() in lib/helpers.php. Kept in one place so the B3 calculators
 * format money and validate tax ids exactly the way the server does.
 */
(function (window) {
  "use strict";

  var gs = new Intl.NumberFormat("es-PY", {
    style: "currency",
    currency: "PYG",
    maximumFractionDigits: 0
  });

  /** Whole guaraníes, es-PY: ₲ 1.500.000. Never decimals. */
  function fmtGs(amount) {
    return gs.format(Math.round(Number(amount) || 0));
  }

  /**
   * The dígito verificador for a RUC base number (DNIT modulo-11: weights cycle
   * 2..11 from the rightmost digit).
   */
  function rucCheckDigit(base) {
    var total = 0;
    var k = 2;

    for (var i = base.length - 1; i >= 0; i--) {
      total += parseInt(base.charAt(i), 10) * k;
      k++;
      if (k > 11) {
        k = 2;
      }
    }

    var remainder = total % 11;
    return remainder > 1 ? 11 - remainder : 0;
  }

  /** Validate "80012345-6" or "800123456" against its check digit. */
  function validateRuc(ruc) {
    var clean = String(ruc || "").replace(/[^0-9]/g, "");
    if (clean.length < 2) {
      return false;
    }
    return rucCheckDigit(clean.slice(0, -1)) === parseInt(clean.slice(-1), 10);
  }

  window.PY = { fmtGs: fmtGs, validateRuc: validateRuc, rucCheckDigit: rucCheckDigit };
})(window);
