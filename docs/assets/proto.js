/* ============================================================
   Anthropos Automation OS — effects & interactions
   12 distinct Canvas-2D animated objects (each maps to a meaning),
   Three.js hero agent-network, logo knots, UI interactions.
   ============================================================ */
(function () {
  'use strict';
  document.documentElement.classList.add('js'); // reveal only hides when JS is alive
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var TAU = Math.PI * 2;

  /* ---------- header dropdowns + mobile toggle ---------- */
  document.querySelectorAll('[data-menu]').forEach(function (item) {
    var t = item.querySelector('a,span'); if (!t) return;
    t.addEventListener('click', function (e) {
      if (item.querySelector('.sub')) { e.preventDefault(); e.stopPropagation(); }
      var was = item.classList.contains('open');
      document.querySelectorAll('[data-menu]').forEach(function (i) { i.classList.remove('open'); });
      if (!was) item.classList.add('open');
    });
  });
  document.addEventListener('click', function () { document.querySelectorAll('[data-menu]').forEach(function (i) { i.classList.remove('open'); }); });
  var toggle = document.getElementById('navToggle'), hd = document.querySelector('.hd');
  if (toggle && hd) {
    toggle.addEventListener('click', function () { var o = hd.classList.toggle('open'); toggle.setAttribute('aria-expanded', o ? 'true' : 'false'); });
    hd.querySelectorAll('.nav a').forEach(function (a) { a.addEventListener('click', function () { hd.classList.remove('open'); }); });
  }

  /* ---------- scroll reveal ---------- */
  var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }); }, { rootMargin: '0px 0px 20% 0px', threshold: 0.01 });
  document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
  // safety net: nothing ever stays invisible, even if the observer misfires
  setTimeout(function () { document.querySelectorAll('.reveal:not(.in)').forEach(function (el) { el.classList.add('in'); }); }, 1400);

  /* ---------- 3D tilt ---------- */
  if (!reduced) document.querySelectorAll('.tilt').forEach(function (card) {
    card.addEventListener('mousemove', function (e) { var r = card.getBoundingClientRect(); var x = (e.clientX - r.left) / r.width - 0.5, y = (e.clientY - r.top) / r.height - 0.5; card.style.transform = 'perspective(700px) rotateX(' + (-y * 5) + 'deg) rotateY(' + (x * 5) + 'deg) translateY(-4px)'; });
    card.addEventListener('mouseleave', function () { card.style.transform = ''; });
  });

  /* ---------- reading progress ---------- */
  var bar = document.getElementById('progress');
  if (bar) window.addEventListener('scroll', function () { var d = document.documentElement, m = d.scrollHeight - window.innerHeight; bar.style.width = (m > 0 ? window.scrollY / m * 100 : 0) + '%'; }, { passive: true });

  /* ---------- TOC scroll-spy ---------- */
  var tocLinks = document.querySelectorAll('.toc a[data-t]');
  if (tocLinks.length) {
    var secs = [].map.call(tocLinks, function (a) { return document.getElementById(a.dataset.t); }).filter(Boolean);
    window.addEventListener('scroll', function () { var cur = secs[0]; secs.forEach(function (s) { if (s && s.getBoundingClientRect().top < 160) cur = s; }); tocLinks.forEach(function (a) { a.classList.toggle('on', cur && a.dataset.t === cur.id); }); }, { passive: true });
    tocLinks.forEach(function (a) { a.addEventListener('click', function (e) { e.preventDefault(); var s = document.getElementById(a.dataset.t); if (s) window.scrollTo({ top: s.offsetTop - 96, behavior: 'smooth' }); }); });
  }

  /* ---------- blog filters ---------- */
  var filters = document.querySelectorAll('.filters .fbtn');
  if (filters.length) filters.forEach(function (b) {
    b.addEventListener('click', function () {
      // allow separate active state per filter group (data-group)
      var grp = b.closest('.filters');
      grp.querySelectorAll('.fbtn').forEach(function (x) { x.classList.remove('on'); });
      b.classList.add('on');
      // collect the active filter from every group; a post must match all active (non-"all") groups
      var active = [];
      document.querySelectorAll('.filters .fbtn.on').forEach(function (x) { if (x.dataset.f && x.dataset.f !== 'all') active.push(x.dataset.f); });
      document.querySelectorAll('[data-cats],[data-post]').forEach(function (p) {
        var cats = (p.dataset.cats || p.dataset.post || '').split(' ');
        var show = active.every(function (f) { return cats.indexOf(f) !== -1; });
        p.classList.toggle('hidden', !show);
      });
    });
  });

  /* =====================================================================
     EFFECTS LIBRARY — 12 distinct animated objects. data-fx="name".
     ===================================================================== */
  function rgb(canvas) {
    var raw = (canvas.style.getPropertyValue('--hue') || '').trim();
    var v = raw.indexOf('var(') === 0 ? getComputedStyle(document.documentElement).getPropertyValue(raw.slice(4, -1).trim()).trim() : (raw || '#2FE3D2');
    v = v.replace('#', ''); if (v.length === 3) v = v.split('').map(function (x) { return x + x; }).join('');
    var n = parseInt(v, 16); return (n >> 16 & 255) + ',' + (n >> 8 & 255) + ',' + (n & 255);
  }
  function glow(ctx, x, y, r, c, a) { var g = ctx.createRadialGradient(x, y, 0, x, y, r); g.addColorStop(0, 'rgba(' + c + ',' + a + ')'); g.addColorStop(1, 'rgba(' + c + ',0)'); ctx.fillStyle = g; ctx.beginPath(); ctx.arc(x, y, r, 0, TAU); ctx.fill(); }
  function dot(ctx, x, y, r, c, a) { ctx.fillStyle = 'rgba(' + c + ',' + (a == null ? 1 : a) + ')'; ctx.beginPath(); ctx.arc(x, y, r, 0, TAU); ctx.fill(); }
  function line(ctx, a, b, c, w, al) { ctx.strokeStyle = 'rgba(' + c + ',' + al + ')'; ctx.lineWidth = w || 1; ctx.beginPath(); ctx.moveTo(a[0], a[1]); ctx.lineTo(b[0], b[1]); ctx.stroke(); }
  function rr(ctx, x, y, w, h, r) { ctx.beginPath(); ctx.moveTo(x + r, y); ctx.arcTo(x + w, y, x + w, y + h, r); ctx.arcTo(x + w, y + h, x, y + h, r); ctx.arcTo(x, y + h, x, y, r); ctx.arcTo(x, y, x + w, y, r); ctx.closePath(); }

  var EFFECTS = {
    /* neural network — layered nodes firing (AI / AEO) */
    neural: function (ctx, W, H, t, c) {
      var cols = [[.18, 3], [.5, 4], [.82, 3]], P = cols.map(function (col) { var a = []; for (var i = 0; i < col[1]; i++) a.push([col[0] * W, H * (i + 1) / (col[1] + 1)]); return a; });
      for (var l = 0; l < P.length - 1; l++) for (var a = 0; a < P[l].length; a++) for (var b = 0; b < P[l + 1].length; b++) {
        line(ctx, P[l][a], P[l + 1][b], c, 1, .09);
        var ph = ((t * 0.0006) + (a * 0.31 + b * 0.67 + l * 0.5)) % 1; var A = P[l][a], B = P[l + 1][b];
        glow(ctx, A[0] + (B[0] - A[0]) * ph, A[1] + (B[1] - A[1]) * ph, 5, c, .8);
      }
      P.forEach(function (col) { col.forEach(function (p) { glow(ctx, p[0], p[1], 10, c, .35); dot(ctx, p[0], p[1], 3, c, .9); }); });
    },
    /* data flow — packets travelling a pipeline (lead automation) */
    dataflow: function (ctx, W, H, t, c) {
      var y = H * .5, xs = [.1, .35, .6, .85].map(function (v) { return v * W; });
      line(ctx, [xs[0], y], [xs[3], y], c, 1, .18);
      xs.forEach(function (x) { glow(ctx, x, y, 9, c, .3); dot(ctx, x, y, 3, c, .9); });
      for (var i = 0; i < 4; i++) { var ph = ((t * 0.0005) + i * 0.25) % 1; glow(ctx, xs[0] + (xs[3] - xs[0]) * ph, y, 6, c, .9); }
      glow(ctx, xs[3], y, 15, c, .5);
    },
    /* intelligence core — orbiting rings (whole-business / A-to-Z) */
    core: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, R = Math.min(W, H) * .34;
      ctx.strokeStyle = 'rgba(' + c + ',.15)'; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.ellipse(cx, cy, R, R * .5, t * 0.0004, 0, TAU); ctx.stroke();
      ctx.beginPath(); ctx.ellipse(cx, cy, R * .62, R * .9, -t * 0.0005, 0, TAU); ctx.stroke();
      glow(ctx, cx, cy, 20, c, .5); dot(ctx, cx, cy, 5, c, 1);
      for (var i = 0; i < 5; i++) { var an = t * 0.0011 + i * (TAU / 5); glow(ctx, cx + Math.cos(an) * R, cy + Math.sin(an) * R * .5, 6, c, .85); }
    },
    /* digital ecosystem — hub + satellites pulsing (integration) */
    ecosystem: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, n = 6, R = Math.min(W, H) * .36;
      for (var i = 0; i < n; i++) { var an = i / n * TAU, x = cx + Math.cos(an) * R, y = cy + Math.sin(an) * R * .72; line(ctx, [cx, cy], [x, y], c, 1, .12); var ph = ((t * 0.0006) + i * 0.16) % 1; glow(ctx, cx + (x - cx) * ph, cy + (y - cy) * ph, 5, c, .8); glow(ctx, x, y, 8, c, .35); dot(ctx, x, y, 3, c, .9); }
      glow(ctx, cx, cy, 16, c, .5); dot(ctx, cx, cy, 5, c, 1);
    },
    /* agent workflow — trigger → agent → branches (automation logic) */
    workflow: function (ctx, W, H, t, c) {
      var trig = [.12 * W, .5 * H], ag = [.44 * W, .5 * H], br = [[.85 * W, .24 * H], [.85 * W, .5 * H], [.85 * W, .76 * H]];
      line(ctx, trig, ag, c, 1, .18); br.forEach(function (b) { line(ctx, ag, b, c, 1, .16); });
      var ph = (t * 0.0005) % 1;
      if (ph < .5) glow(ctx, trig[0] + (ag[0] - trig[0]) * (ph / .5), trig[1], 6, c, .9);
      else { var p = (ph - .5) / .5, b = br[Math.floor(t * 0.0005) % 3]; glow(ctx, ag[0] + (b[0] - ag[0]) * p, ag[1] + (b[1] - ag[1]) * p, 6, c, .9); }
      glow(ctx, trig[0], trig[1], 9, c, .4); dot(ctx, trig[0], trig[1], 3, c, .9);
      glow(ctx, ag[0], ag[1], 14, c, .5); dot(ctx, ag[0], ag[1], 5, c, 1);
      br.forEach(function (b) { glow(ctx, b[0], b[1], 8, c, .35); dot(ctx, b[0], b[1], 3, c, .9); });
    },
    /* funnel — visitors converging to a conversion (web design) */
    funnel: function (ctx, W, H, t, c) {
      var cx = W / 2;
      ctx.strokeStyle = 'rgba(' + c + ',.2)'; ctx.lineWidth = 1;
      ctx.beginPath(); ctx.moveTo(W * .2, H * .18); ctx.lineTo(W * .44, H * .66); ctx.lineTo(W * .44, H * .82); ctx.moveTo(W * .8, H * .18); ctx.lineTo(W * .56, H * .66); ctx.lineTo(W * .56, H * .82); ctx.stroke();
      for (var i = 0; i < 8; i++) { var ph = ((t * 0.0006) + i / 8) % 1; var sx = W * .22 + (W * .56) * ((i * 37 % 100) / 100); var x = sx + (cx - sx) * ph, y = H * .12 + H * .68 * ph; glow(ctx, x, y, 4, c, .8 * (1 - ph * .3)); }
      glow(ctx, cx, H * .84, 13, c, .6); dot(ctx, cx, H * .84, 4, c, 1);
    },
    /* broadcast — expanding rings + audience (marketing) */
    broadcast: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, M = Math.min(W, H) * .5;
      for (var i = 0; i < 3; i++) { var ph = ((t * 0.0005) + i / 3) % 1; ctx.strokeStyle = 'rgba(' + c + ',' + (0.45 * (1 - ph)) + ')'; ctx.lineWidth = 1.4; ctx.beginPath(); ctx.arc(cx, cy, ph * M, 0, TAU); ctx.stroke(); }
      for (var j = 0; j < 8; j++) { var an = j / 8 * TAU, R = M * .82; dot(ctx, cx + Math.cos(an) * R, cy + Math.sin(an) * R * .7, 2.5, c, .7); }
      glow(ctx, cx, cy, 16, c, .6); dot(ctx, cx, cy, 5, c, 1);
    },
    /* social — chat bubbles rising (social media) */
    social: function (ctx, W, H, t, c) {
      glow(ctx, W / 2, H / 2, 18, c, .18);
      for (var i = 0; i < 6; i++) { var ph = ((t * 0.00035) + i / 6) % 1; var x = W * (.16 + ((i * 0.17) % .68)); var y = H - ph * H * 1.05; var s = 7 + (i % 3) * 3; ctx.fillStyle = 'rgba(' + c + ',' + (0.72 * (1 - ph)) + ')'; rr(ctx, x, y, s * 2.2, s * 1.5, 4); ctx.fill(); ctx.beginPath(); ctx.moveTo(x + 5, y + s * 1.5); ctx.lineTo(x + 10, y + s * 1.5); ctx.lineTo(x + 5, y + s * 1.5 + 5); ctx.closePath(); ctx.fill(); }
    },
    /* calendar — booking slots filling (service-based) */
    calendar: function (ctx, W, H, t, c) {
      var cols = 5, rows = 3, pad = W * .1, gw = (W - pad * 2) / cols, gh = (H - pad * 2) / rows, total = cols * rows;
      for (var r = 0; r < rows; r++) for (var cc = 0; cc < cols; cc++) { var x = pad + cc * gw, y = pad + r * gh, idx = r * cols + cc; ctx.strokeStyle = 'rgba(' + c + ',.14)'; ctx.strokeRect(x + 2, y + 2, gw - 6, gh - 6); var lit = (Math.sin(t * 0.001 + idx * 0.6) + 1) / 2; if (lit > .72) { ctx.fillStyle = 'rgba(' + c + ',' + (0.15 + 0.4 * lit) + ')'; ctx.fillRect(x + 2, y + 2, gw - 6, gh - 6); dot(ctx, x + gw / 2, y + gh / 2, 2, c, .9); } }
    },
    /* growth — rising bars + trendline (results) */
    growth: function (ctx, W, H, t, c) {
      var n = 6, base = H * .84, bw = W / (n * 2), pts = [];
      for (var i = 0; i < n; i++) { var x = W * .12 + i * (W * .76 / (n - 1)); var h = (H * .55) * (0.25 + 0.75 * (0.5 + 0.5 * Math.sin(t * 0.001 + i * 0.7))) * ((i + 2) / (n + 1)); var y = base - h; ctx.fillStyle = 'rgba(' + c + ',.3)'; ctx.fillRect(x - bw / 2, y, bw, h); pts.push([x, y]); }
      ctx.strokeStyle = 'rgba(' + c + ',.85)'; ctx.lineWidth = 1.5; ctx.beginPath(); pts.forEach(function (p, i) { i ? ctx.lineTo(p[0], p[1]) : ctx.moveTo(p[0], p[1]); }); ctx.stroke();
      pts.forEach(function (p) { dot(ctx, p[0], p[1], 2.5, c, 1); });
    },
    /* radar — sweep + blips (tracking / monitoring) */
    radar: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, R = Math.min(W, H) * .44;
      [.4, .7, 1].forEach(function (f) { ctx.strokeStyle = 'rgba(' + c + ',.12)'; ctx.lineWidth = 1; ctx.beginPath(); ctx.arc(cx, cy, R * f, 0, TAU); ctx.stroke(); });
      var an = t * 0.0012; line(ctx, [cx, cy], [cx + Math.cos(an) * R, cy + Math.sin(an) * R], c, 1.4, .6);
      for (var i = 0; i < 4; i++) { var ba = i * 1.7, br = R * (0.4 + 0.5 * ((i % 3) / 3)); var da = ((an - ba) % TAU + TAU) % TAU; glow(ctx, cx + Math.cos(ba) * br, cy + Math.sin(ba) * br, 5, c, .35 + (da < .7 ? .55 : 0)); }
      dot(ctx, cx, cy, 3, c, 1);
    },
    /* particles — drifting field (ambient / premium) */
    particles: function (ctx, W, H, t, c) {
      for (var i = 0; i < 26; i++) { var sx = (i * 97 % 100) / 100, sy = (i * 57 % 100) / 100; var x = (sx * W + t * 0.008 * ((i % 3) + 1)) % W; var y = sy * H + Math.sin(t * 0.001 + i) * 7; dot(ctx, x, y, 1.6 + (i % 3) * 0.5, c, .5); }
    },
    /* holographic scan grid (interface / vision) */
    holo: function (ctx, W, H, t, c) {
      ctx.strokeStyle = 'rgba(' + c + ',.12)'; ctx.lineWidth = 1;
      for (var i = 0; i <= 6; i++) { var y = (H * i / 6 + (t * 0.02) % (H / 6)); ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(W, y); ctx.stroke(); }
      for (var j = 0; j <= 8; j++) { var x = W * j / 8; ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, H); ctx.stroke(); }
      var sy = (t * 0.05) % H, g = ctx.createLinearGradient(0, sy - 12, 0, sy + 12); g.addColorStop(0, 'rgba(' + c + ',0)'); g.addColorStop(.5, 'rgba(' + c + ',.45)'); g.addColorStop(1, 'rgba(' + c + ',0)'); ctx.fillStyle = g; ctx.fillRect(0, sy - 12, W, 24);
    },
    /* liquid metal — morphing blob (transformation) */
    liquid: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, R = Math.min(W, H) * .3; ctx.beginPath();
      for (var a = 0; a <= TAU + 0.2; a += 0.2) { var rr = R * (1 + 0.18 * Math.sin(a * 3 + t * 0.002) + 0.12 * Math.cos(a * 5 - t * 0.0015)); var x = cx + Math.cos(a) * rr, y = cy + Math.sin(a) * rr; a ? ctx.lineTo(x, y) : ctx.moveTo(x, y); }
      ctx.closePath(); var g = ctx.createRadialGradient(cx, cy, 0, cx, cy, R * 1.3); g.addColorStop(0, 'rgba(' + c + ',.5)'); g.addColorStop(1, 'rgba(' + c + ',.05)'); ctx.fillStyle = g; ctx.fill(); ctx.strokeStyle = 'rgba(' + c + ',.6)'; ctx.lineWidth = 1; ctx.stroke();
    },
    /* crystal — rotating faceted gem (premium / quality) */
    crystal: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, R = Math.min(W, H) * .32, n = 6, rot = t * 0.0006, pts = [];
      for (var i = 0; i < n; i++) { var a = rot + i / n * TAU; pts.push([cx + Math.cos(a) * R, cy + Math.sin(a) * R * .82]); }
      ctx.strokeStyle = 'rgba(' + c + ',.4)'; ctx.lineWidth = 1; ctx.beginPath(); pts.forEach(function (p, i) { i ? ctx.lineTo(p[0], p[1]) : ctx.moveTo(p[0], p[1]); }); ctx.closePath(); ctx.stroke();
      pts.forEach(function (p) { line(ctx, [cx, cy], p, c, 1, .16); }); glow(ctx, cx, cy, 14, c, .5); dot(ctx, cx, cy, 4, c, 1);
    },
    /* orbit — nested orbiting rings (systems in motion) */
    orbit: function (ctx, W, H, t, c) {
      var cx = W / 2, cy = H / 2, R = Math.min(W, H) * .4;
      for (var r = 0; r < 3; r++) { var rr = R * (0.4 + r * 0.3); ctx.strokeStyle = 'rgba(' + c + ',.12)'; ctx.lineWidth = 1; ctx.beginPath(); ctx.arc(cx, cy, rr, 0, TAU); ctx.stroke(); var a = t * 0.001 * (r % 2 ? 1 : -1) + r; glow(ctx, cx + Math.cos(a) * rr, cy + Math.sin(a) * rr, 6, c, .8); }
      glow(ctx, cx, cy, 12, c, .5); dot(ctx, cx, cy, 4, c, 1);
    },
    /* matrix — falling data columns (content / feeds) */
    matrix: function (ctx, W, H, t, c) {
      var cols = 9; for (var i = 0; i < cols; i++) { var x = W * (i + 0.5) / cols, sp = (i % 3 + 1), y = ((t * 0.03 * sp) + i * 40) % (H + 40) - 20; var g = ctx.createLinearGradient(x, y - 40, x, y + 18); g.addColorStop(0, 'rgba(' + c + ',0)'); g.addColorStop(1, 'rgba(' + c + ',.7)'); ctx.strokeStyle = g; ctx.lineWidth = 2; ctx.beginPath(); ctx.moveTo(x, y - 40); ctx.lineTo(x, y + 14); ctx.stroke(); dot(ctx, x, y + 14, 2, c, .9); }
    },
    /* pulse — concentric pulses from a node cluster (reach / signal) */
    pulse: function (ctx, W, H, t, c) {
      var pts = [[.3, .35], [.7, .3], [.5, .6], [.25, .7], [.78, .68]], M = Math.min(W, H) * .25;
      pts.forEach(function (p, i) { var x = p[0] * W, y = p[1] * H, ph = ((t * 0.0008) + i * 0.2) % 1; ctx.strokeStyle = 'rgba(' + c + ',' + (0.5 * (1 - ph)) + ')'; ctx.lineWidth = 1; ctx.beginPath(); ctx.arc(x, y, ph * M, 0, TAU); ctx.stroke(); glow(ctx, x, y, 8, c, .4); dot(ctx, x, y, 3, c, .9); });
    }
  };
  /* legacy aliases so old data-fx values still render */
  EFFECTS.pipeline = EFFECTS.dataflow; EFFECTS.mesh = EFFECTS.neural; EFFECTS.hub = EFFECTS.ecosystem; EFFECTS.branch = EFFECTS.workflow; EFFECTS.agent = EFFECTS.workflow;

  var fxList = [];
  document.querySelectorAll('[data-fx]').forEach(function (canvas) {
    var fn = EFFECTS[canvas.dataset.fx] || EFFECTS.neural, c = rgb(canvas), ctx = canvas.getContext('2d');
    var W = 0, H = 0, dpr = Math.min(window.devicePixelRatio || 1, 2), vis = true;
    function size() { var r = canvas.getBoundingClientRect(); W = r.width; H = r.height; canvas.width = W * dpr; canvas.height = H * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0); }
    new IntersectionObserver(function (e) { vis = e[0].isIntersecting; }).observe(canvas);
    size();
    fxList.push({ v: function () { return vis; }, d: function (t) { if (!W || Math.abs(canvas.getBoundingClientRect().width - W) > 1) size(); if (!W || !H) return; ctx.clearRect(0, 0, W, H); fn(ctx, W, H, t, c); } });
  });
  (function loop(t) { requestAnimationFrame(loop); fxList.forEach(function (f) { if (f.v()) f.d(t); }); })(0);

  /* ---------- FAQ builder (10 Q, segmentable) ---------- */
  var FAQ = {
    general: [
      ['How fast can you build my system?', 'Most systems go live in 4 weeks — audit &amp; blueprint, website, automation wiring, then connect-test-launch.'],
      ['Do I own everything, or am I locked in?', 'You own it. Systems are built on your tools, handed over, and documented — no dependency on us.'],
      ['What does it cost?', 'It depends on scope. Each service page shows five offers (€ Starter → €€€ A-to-Z); book a call for a fixed quote.'],
      ['Do I need any technical skills?', 'No. We set everything up and hand it over with a simple walkthrough. You approve; the system runs.'],
      ['Which tools do you use?', 'Your website + n8n + your existing CRM/email/calendar. We connect what you have — no rip-and-replace.'],
      ['Will automation feel robotic to my customers?', 'No. It reads as attentive and on-brand — the goal is that it feels like you finally had time, not like a bot.'],
      ['Is my data safe and GDPR-compliant?', 'Yes — EU-hosted, consent-based tools. For medical/therapy we never touch clinical or patient-data systems.'],
      ['What if I only need one thing, like a website?', 'Start with a single offer and add the rest whenever you\'re ready. Mix &amp; match by pain and budget.'],
      ['Do you write the content for me?', 'We launch with your existing info, credentials and proof. Ongoing content help is optional.'],
      ['What happens after launch?', 'A documented handover, reporting on what works, and support options so the system keeps running.']
    ],
    gettingStarted: [
      ['How do we start?', 'Book a free 30-minute consultation. We map one leak live and show you the agent that closes it — no obligation.'],
      ['How long until it\'s live?', 'Four weeks from kickoff for a full system; single offers are faster.'],
      ['What do you need from me?', 'Access to your site/tools, your credentials and proof, and quick approvals along the way.'],
      ['Can you work with my current website?', 'Often yes — we optimise what converts and rebuild only what\'s holding you back.']
    ],
    servicesScope: [
      ['What are the five offers?', 'Website Redesign, Lead &amp; Follow-up Automation, Marketing Automation, Social Media Automation, and full A-to-Z Transformation.'],
      ['Can I combine services?', 'Yes — every service page is a micro-combo. Take one, or the whole system.'],
      ['Do you serve my industry?', 'We serve seven segments: regulated, medical, e-commerce, service-based, freelancers, creators and B2B.'],
      ['Who do you NOT work with?', 'Enterprise, large regulated practices, and anything needing heavy custom or compliance work.']
    ],
    automationTools: [
      ['What is n8n and why do you use it?', 'n8n is a workflow tool that connects your apps. It lets an AI agent move data between inbox, CRM, calendar and more — without brittle custom code.'],
      ['What can an AI agent actually do?', 'Reply in seconds, qualify and route leads, follow up, draft content, and keep your tools in sync — within limits you set.'],
      ['What will you never automate?', 'Anything that should stay human: clinical care, legal advice in writing, and sensitive decisions. Boundaries build trust.'],
      ['Does it integrate with my CRM?', 'Yes — we connect common CRMs, inboxes, calendars and stores rather than replacing them.']
    ],
    trustPricing: [
      ['Is there a contract or lock-in?', 'No lock-in. You own the system; support is optional and month-to-month.'],
      ['How is pricing structured?', 'By scope: € Starter, €€ Core/Growth, €€€ A-to-Z. You get a fixed quote after the consultation.'],
      ['What ROI should I expect?', 'Ranges vary by profession — typically more leads, better conversion, and 10–20 hours/week saved. We show your numbers in the lead report.']
    ]
  };
  document.querySelectorAll('[data-faq]').forEach(function (box) {
    var items = FAQ[box.dataset.faq] || FAQ.general;
    items.forEach(function (f, i) { var d = document.createElement('details'); if (i === 0) d.open = true; d.innerHTML = '<summary>' + f[0] + '</summary><p>' + f[1] + '</p>'; box.appendChild(d); });
  });

  /* ---------- guide cards builder ---------- */
  document.querySelectorAll('[data-guides]').forEach(function (grid) {
    var seg = grid.dataset.guides || 'this business';
    ['Why ' + seg + ' lose leads they earned', 'The AEO answer box that gets you cited', 'Local + AI visibility, step by step', 'The 60-second reply that doubles bookings', 'Mapping your funnel into n8n stages', 'The 5 workflows to automate first', 'Marketing automation without the bloat', 'Social posts on autopilot, on-brand', 'Reading your lead report, honestly', 'From pilot to always-on automation'].forEach(function (tt, i) {
      var a = document.createElement('a'); a.className = 'glass gcard'; a.href = 'guide-page.html'; a.innerHTML = '<div class="gi">G' + (i < 9 ? '0' : '') + (i + 1) + '</div><h5>' + tt + '</h5><div class="ga">problem → solution → CTA</div>'; grid.appendChild(a);
    });
  });

  /* =================== Three.js hero agent network =================== */
  function agentNetwork(canvas, o) {
    if (!canvas || !window.THREE) return; o = o || {};
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true }); renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene(), camera = new THREE.PerspectiveCamera(55, 2, 0.1, 100); camera.position.set(0, 0, o.z || 20);
    var N = o.nodes || 90, pos = [];
    for (var i = 0; i < N; i++) { var r = 6 + Math.random() * 8, th = Math.random() * TAU, ph = Math.acos(2 * Math.random() - 1); pos.push(new THREE.Vector3(r * Math.sin(ph) * Math.cos(th), r * Math.sin(ph) * Math.sin(th) * 0.7, r * Math.cos(ph))); }
    var np = new Float32Array(N * 3), nc = new Float32Array(N * 3), cF = new THREE.Color('#2FE3D2'), cA = new THREE.Color('#8B7CFF'), cC = new THREE.Color('#FF5C8A');
    pos.forEach(function (p, i) { np[i * 3] = p.x; np[i * 3 + 1] = p.y; np[i * 3 + 2] = p.z; var c = i % 7 === 0 ? cC : (i % 2 ? cA : cF); nc[i * 3] = c.r; nc[i * 3 + 1] = c.g; nc[i * 3 + 2] = c.b; });
    var ng = new THREE.BufferGeometry(); ng.setAttribute('position', new THREE.BufferAttribute(np, 3)); ng.setAttribute('color', new THREE.BufferAttribute(nc, 3));
    scene.add(new THREE.Points(ng, new THREE.PointsMaterial({ size: 0.28, vertexColors: true, transparent: true, opacity: .95, blending: THREE.AdditiveBlending, depthWrite: false })));
    var ev = [], ec = [];
    for (var a = 0; a < N; a++) for (var b = a + 1; b < N; b++) if (pos[a].distanceTo(pos[b]) < 4.2 && Math.random() > 0.55) { ev.push(pos[a].x, pos[a].y, pos[a].z, pos[b].x, pos[b].y, pos[b].z); ec.push(cA.r, cA.g, cA.b, cF.r, cF.g, cF.b); }
    var eg = new THREE.BufferGeometry(); eg.setAttribute('position', new THREE.BufferAttribute(new Float32Array(ev), 3)); eg.setAttribute('color', new THREE.BufferAttribute(new Float32Array(ec), 3));
    scene.add(new THREE.LineSegments(eg, new THREE.LineBasicMaterial({ vertexColors: true, transparent: true, opacity: .14, blending: THREE.AdditiveBlending })));
    var core = new THREE.Mesh(new THREE.IcosahedronGeometry(2.1, 1), new THREE.MeshBasicMaterial({ color: '#8B7CFF', wireframe: true, transparent: true, opacity: .5 })); scene.add(core);
    var cg = new THREE.Mesh(new THREE.SphereGeometry(1.2, 24, 24), new THREE.MeshBasicMaterial({ color: '#B9A9FF', transparent: true, opacity: .28 })); scene.add(cg);
    var PN = o.pulses || 60, pp = new Float32Array(PN * 3), pd = [];
    for (var k = 0; k < PN; k++) { var s = pos[(Math.random() * N) | 0]; pd.push({ s: s, t: Math.random() }); pp[k * 3] = s.x; pp[k * 3 + 1] = s.y; pp[k * 3 + 2] = s.z; }
    var pg = new THREE.BufferGeometry(); pg.setAttribute('position', new THREE.BufferAttribute(pp, 3));
    scene.add(new THREE.Points(pg, new THREE.PointsMaterial({ color: '#2FE3D2', size: 0.42, transparent: true, opacity: .9, blending: THREE.AdditiveBlending, depthWrite: false })));
    var mx = 0, my = 0, vis = true; new IntersectionObserver(function (e) { vis = e[0].isIntersecting; }).observe(canvas);
    window.addEventListener('mousemove', function (e) { mx = e.clientX / window.innerWidth - 0.5; my = e.clientY / window.innerHeight - 0.5; });
    (function frame(tt) { requestAnimationFrame(frame); if (!vis) return; var w = canvas.clientWidth, h = canvas.clientHeight; if (!w || !h) return; if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); } var tm = tt / 1000; scene.rotation.y = tm * 0.05 + mx * 0.4; scene.rotation.x = my * 0.25; core.rotation.x = tm * 0.3; core.rotation.y = tm * 0.22; cg.scale.setScalar(1 + Math.sin(tm * 1.6) * 0.12); if (!reduced) { var arr = pg.attributes.position.array; for (var i = 0; i < PN; i++) { var d = pd[i]; d.t += 0.008; if (d.t > 1) { d.t = 0; d.s = pos[(Math.random() * N) | 0]; } var kk = 1 - d.t; arr[i * 3] = d.s.x * kk; arr[i * 3 + 1] = d.s.y * kk; arr[i * 3 + 2] = d.s.z * kk; } pg.attributes.position.needsUpdate = true; } renderer.render(scene, camera); })(0);
  }
  document.querySelectorAll('[data-net]').forEach(function (c) { agentNetwork(c, { nodes: +c.dataset.nodes || 80, pulses: +c.dataset.pulses || 55, z: +c.dataset.z || 19 }); });

  /* ---------- logo knots ---------- */
  document.querySelectorAll('canvas.knot').forEach(function (canvas) {
    if (!window.THREE) return;
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true }); renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene(), camera = new THREE.PerspectiveCamera(45, 1, 0.1, 50); camera.position.z = 7;
    var m = new THREE.Mesh(new THREE.TorusKnotGeometry(1.7, 0.4, 120, 16, 2, 3), new THREE.MeshStandardMaterial({ color: '#8B7CFF', metalness: .6, roughness: .3, emissive: '#2FE3D2', emissiveIntensity: .15 }));
    scene.add(m); scene.add(new THREE.AmbientLight('#5B6684', .8)); var key = new THREE.DirectionalLight('#CFC7FF', 1.4); key.position.set(3, 4, 5); scene.add(key);
    var vis = true; new IntersectionObserver(function (e) { vis = e[0].isIntersecting; }).observe(canvas);
    (function fr() { requestAnimationFrame(fr); if (!vis) return; var w = canvas.clientWidth, h = canvas.clientHeight; if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); } if (!reduced) m.rotation.y += 0.006; m.rotation.x = 0.4; renderer.render(scene, camera); })();
  });
})();
