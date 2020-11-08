const input_add = (money, a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, aa, ab, ac, ad, ae, af, ag, ah, ai, aj, ak, al, am, an, ao, ap, aq, ar, as, at) => {
  const total = parseInt(a) + parseInt(b) + parseInt(c) + parseInt(d) + parseInt(e) + parseInt(f) + parseInt(g) + parseInt(h) + parseInt(i) + parseInt(j) + parseInt(k) + parseInt(l) + parseInt(m) + parseInt(n) + parseInt(o) + parseInt(p) + parseInt(q) + parseInt(r) + parseInt(s) + parseInt(t) + parseInt(u) + parseInt(v) + parseInt(w) + parseInt(x) + parseInt(y) + parseInt(z) + parseInt(aa) + parseInt(ab) + parseInt(ac) + parseInt(ad) + parseInt(ae) + parseInt(af) + parseInt(ag) + parseInt(ah) + parseInt(ai) + parseInt(aj) + parseInt(ak) + parseInt(al) + parseInt(am) + parseInt(an) + parseInt(ao) + parseInt(ap) + parseInt(aq) + parseInt(ar) + parseInt(as) + parseInt(at);

  if (total < money) {
    // console.log('ok');
    document.getElementById("run").disabled = false;
  } else {
    // console.log('ng');
    document.getElementById("run").disabled = true;
  }

  $.ajax({
    type: 'POST',
    url: 'https://webapp.massyu.net/game/php/sub-db.php',
    data: total,
    success: function(data) {
        alert(data);
    }
});

  return (total);
}