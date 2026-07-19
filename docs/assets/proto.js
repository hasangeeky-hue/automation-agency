/* ============================================================
   Anthropos Automation OS — shared prototype effects & interactions
   ============================================================ */
(function () {
  'use strict';
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- header dropdowns (click, mobile-friendly) + mobile toggle ---- */
  document.querySelectorAll('[data-menu]').forEach(function (item) {
    var t = item.querySelector('a,span');
    if (!t) return;
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

  /* ---- scroll reveal ---- */
  var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }); }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });

  /* ---- 3D tilt (perspective hover / mouse-follow) ---- */
  if (!reduced) document.querySelectorAll('.tilt').forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      var r = card.getBoundingClientRect();
      var x = (e.clientX - r.left) / r.width - 0.5, y = (e.clientY - r.top) / r.height - 0.5;
      card.style.transform = 'perspective(700px) rotateX(' + (-y * 5) + 'deg) rotateY(' + (x * 5) + 'deg) translateY(-4px)';
    });
    card.addEventListener('mouseleave', function () { card.style.transform = ''; });
  });

  /* ---- reading progress ---- */
  var bar = document.getElementById('progress');
  if (bar) window.addEventListener('scroll', function () { var d = document.documentElement, m = d.scrollHeight - window.innerHeight; bar.style.width = (m > 0 ? window.scrollY / m * 100 : 0) + '%'; }, { passive: true });

  /* ---- TOC scroll-spy ---- */
  var tocLinks = document.querySelectorAll('.toc a[data-t]');
  if (tocLinks.length) {
    var secs = [].map.call(tocLinks, function (a) { return document.getElementById(a.dataset.t); }).filter(Boolean);
    window.addEventListener('scroll', function () {
      var cur = secs[0];
      secs.forEach(function (s) { if (s && s.getBoundingClientRect().top < 160) cur = s; });
      tocLinks.forEach(function (a) { a.classList.toggle('on', cur && a.dataset.t === cur.id); });
    }, { passive: true });
    tocLinks.forEach(function (a) { a.addEventListener('click', function (e) { e.preventDefault(); var s = document.getElementById(a.dataset.t); if (s) window.scrollTo({ top: s.offsetTop - 96, behavior: 'smooth' }); }); });
  }

  /* ---- blog filters ---- */
  var filters = document.querySelectorAll('.filters .fbtn');
  if (filters.length) filters.forEach(function (b) {
    b.addEventListener('click', function () {
      filters.forEach(function (x) { x.classList.remove('on'); }); b.classList.add('on');
      var f = b.dataset.f;
      document.querySelectorAll('[data-post]').forEach(function (p) { p.classList.toggle('hidden', f !== 'all' && p.dataset.post !== f); });
    });
  });

  /* ---- build guide cards where requested ---- */
  document.querySelectorAll('[data-guides]').forEach(function (grid) {
    var seg = grid.dataset.guides || 'this segment';
    var titles = [
      'Why ' + seg + ' lose leads they already earned', 'The AEO answer box that gets you cited',
      'Local + AI visibility, step by step', 'The 60-second reply that doubles bookings',
      'Mapping your funnel into n8n stages', 'The 5 workflows to automate first',
      'Marketing automation without the bloat', 'Social posts on autopilot, on-brand',
      'Reading your lead report, honestly', 'From pilot to always-on automation'
    ];
    titles.forEach(function (t, i) {
      var a = document.createElement('a'); a.className = 'glass gcard'; a.href = 'guide-page.html';
      a.innerHTML = '<div class="gi">G' + (i < 9 ? '0' : '') + (i + 1) + '</div><h5>' + t + '</h5><div class="ga">problem → solution → CTA</div>';
      grid.appendChild(a);
    });
  });

  /* ================= MiniFlow (Canvas-2D automation motif) ================= */
  var PRESETS = {
    pipeline: { nodes: [[.1, .5], [.32, .34], [.54, .62], [.76, .4], [.92, .55]], edges: [[0, 1], [1, 2], [2, 3], [3, 4]], big: [] },
    agent: { nodes: [[.12, .5], [.44, .5], [.82, .24], [.82, .5], [.82, .76]], edges: [[0, 1], [1, 2], [1, 3], [1, 4]], big: [1] },
    hub: { nodes: [[.5, .5], [.5, .16], [.83, .32], [.86, .7], [.5, .86], [.16, .7], [.15, .31]], edges: [[0, 1], [0, 2], [0, 3], [0, 4], [0, 5], [0, 6]], big: [0] },
    mesh: { nodes: [[.2, .28], [.5, .18], [.8, .32], [.28, .66], [.6, .62], [.84, .7], [.46, .44]], edges: [[0, 1], [1, 2], [0, 6], [6, 1], [6, 2], [6, 4], [3, 6], [3, 4], [4, 5], [0, 3]], big: [6] },
    core: { nodes: [[.5, .5], [.5, .2], [.78, .38], [.72, .72], [.32, .74], [.24, .36]], edges: [[0, 1], [0, 2], [0, 3], [0, 4], [0, 5]], big: [0], ring: true },
    branch: { nodes: [[.12, .5], [.4, .5], [.66, .28], [.66, .72], [.9, .28], [.9, .72]], edges: [[0, 1], [1, 2], [1, 3], [2, 4], [3, 5]], big: [1] }
  };
  var flows = [];
  function accentRgb(canvas) {
    var raw = (canvas.style.getPropertyValue('--hue') || '').trim();
    var v = raw.indexOf('var(') === 0 ? getComputedStyle(document.documentElement).getPropertyValue(raw.slice(4, -1).trim()).trim() : (raw || '#2FE3D2');
    v = v.replace('#', ''); if (v.length === 3) v = v.split('').map(function (x) { return x + x; }).join('');
    var n = parseInt(v, 16); return (n >> 16 & 255) + ',' + (n >> 8 & 255) + ',' + (n & 255);
  }
  function makeFlow(canvas) {
    var P = PRESETS[canvas.dataset.fx] || PRESETS.mesh, rc = accentRgb(canvas), ctx = canvas.getContext('2d');
    var W = 0, H = 0, dpr = Math.min(window.devicePixelRatio || 1, 2);
    function size() { var r = canvas.getBoundingClientRect(); W = r.width; H = r.height; canvas.width = W * dpr; canvas.height = H * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0); }
    var pulses = P.edges.map(function (e, i) { return { e: e, t: i / P.edges.length }; }), visible = true;
    new IntersectionObserver(function (es) { visible = es[0].isIntersecting; }).observe(canvas);
    flows.push({ visible: function () { return visible; }, draw: function (time) {
      if (!W || Math.abs(canvas.getBoundingClientRect().width - W) > 1) size(); if (!W || !H) return;
      ctx.clearRect(0, 0, W, H);
      var pts = P.nodes.map(function (n) { return [n[0] * W, n[1] * H]; });
      ctx.lineWidth = 1;
      P.edges.forEach(function (e) { var a = e[0], b = e[1], g = ctx.createLinearGradient(pts[a][0], pts[a][1], pts[b][0], pts[b][1]); g.addColorStop(0, 'rgba(' + rc + ',.10)'); g.addColorStop(1, 'rgba(' + rc + ',.30)'); ctx.strokeStyle = g; ctx.beginPath(); ctx.moveTo(pts[a][0], pts[a][1]); var mx = (pts[a][0] + pts[b][0]) / 2, my = (pts[a][1] + pts[b][1]) / 2 - 10; ctx.quadraticCurveTo(mx, my, pts[b][0], pts[b][1]); ctx.stroke(); });
      if (P.ring) { var cx = pts[0][0], cy = pts[0][1], rr = Math.min(W, H) * 0.32; ctx.strokeStyle = 'rgba(' + rc + ',.18)'; ctx.beginPath(); ctx.ellipse(cx, cy, rr, rr * 0.5, time * 0.0006, 0, Math.PI * 2); ctx.stroke(); }
      if (!reduced) pulses.forEach(function (p) { p.t += 0.006; if (p.t > 1) p.t -= 1; var a = pts[p.e[0]], b = pts[p.e[1]], mx = (a[0] + b[0]) / 2, my = (a[1] + b[1]) / 2 - 10, t = p.t, it = 1 - t, x = it * it * a[0] + 2 * it * t * mx + t * t * b[0], y = it * it * a[1] + 2 * it * t * my + t * t * b[1], grd = ctx.createRadialGradient(x, y, 0, x, y, 7); grd.addColorStop(0, 'rgba(' + rc + ',.95)'); grd.addColorStop(1, 'rgba(' + rc + ',0)'); ctx.fillStyle = grd; ctx.beginPath(); ctx.arc(x, y, 7, 0, Math.PI * 2); ctx.fill(); });
      pts.forEach(function (p, i) { var big = P.big.indexOf(i) !== -1, r = big ? 7 : 3.4, pulse = big ? (1 + Math.sin(time * 0.003) * 0.18) : 1, glow = ctx.createRadialGradient(p[0], p[1], 0, p[0], p[1], r * 4 * pulse); glow.addColorStop(0, 'rgba(' + rc + ',.5)'); glow.addColorStop(1, 'rgba(' + rc + ',0)'); ctx.fillStyle = glow; ctx.beginPath(); ctx.arc(p[0], p[1], r * 4 * pulse, 0, Math.PI * 2); ctx.fill(); ctx.fillStyle = big ? 'rgba(' + rc + ',1)' : 'rgba(' + rc + ',.85)'; ctx.beginPath(); ctx.arc(p[0], p[1], r * pulse, 0, Math.PI * 2); ctx.fill(); if (big) { ctx.strokeStyle = 'rgba(' + rc + ',.5)'; ctx.beginPath(); ctx.arc(p[0], p[1], r * 2.1 * pulse, 0, Math.PI * 2); ctx.stroke(); } });
    } });
    size();
  }
  document.querySelectorAll('.fxcanvas,[data-fx]').forEach(function (c) { if (c.dataset.fx) makeFlow(c); });
  (function loop(t) { requestAnimationFrame(loop); flows.forEach(function (f) { if (f.visible()) f.draw(t); }); })(0);

  /* ================= Three.js agent network (hero / cta) ================= */
  function agentNetwork(canvas, opts) {
    if (!canvas || !window.THREE) return; opts = opts || {};
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene(), camera = new THREE.PerspectiveCamera(55, 2, 0.1, 100); camera.position.set(0, 0, opts.z || 20);
    var NODES = opts.nodes || 90, pos = [];
    for (var i = 0; i < NODES; i++) { var r = 6 + Math.random() * 8, th = Math.random() * Math.PI * 2, ph = Math.acos(2 * Math.random() - 1); pos.push(new THREE.Vector3(r * Math.sin(ph) * Math.cos(th), r * Math.sin(ph) * Math.sin(th) * 0.7, r * Math.cos(ph))); }
    var npos = new Float32Array(NODES * 3), ncol = new Float32Array(NODES * 3), cFlow = new THREE.Color('#2FE3D2'), cAI = new THREE.Color('#8B7CFF'), cCta = new THREE.Color('#FF5C8A');
    pos.forEach(function (p, i) { npos[i * 3] = p.x; npos[i * 3 + 1] = p.y; npos[i * 3 + 2] = p.z; var c = i % 7 === 0 ? cCta : (i % 2 ? cAI : cFlow); ncol[i * 3] = c.r; ncol[i * 3 + 1] = c.g; ncol[i * 3 + 2] = c.b; });
    var ng = new THREE.BufferGeometry(); ng.setAttribute('position', new THREE.BufferAttribute(npos, 3)); ng.setAttribute('color', new THREE.BufferAttribute(ncol, 3));
    scene.add(new THREE.Points(ng, new THREE.PointsMaterial({ size: 0.28, vertexColors: true, transparent: true, opacity: .95, blending: THREE.AdditiveBlending, depthWrite: false })));
    var ev = [], ec = [];
    for (var a = 0; a < NODES; a++) for (var b = a + 1; b < NODES; b++) if (pos[a].distanceTo(pos[b]) < 4.2 && Math.random() > 0.55) { ev.push(pos[a].x, pos[a].y, pos[a].z, pos[b].x, pos[b].y, pos[b].z); ec.push(cAI.r, cAI.g, cAI.b, cFlow.r, cFlow.g, cFlow.b); }
    var eg = new THREE.BufferGeometry(); eg.setAttribute('position', new THREE.BufferAttribute(new Float32Array(ev), 3)); eg.setAttribute('color', new THREE.BufferAttribute(new Float32Array(ec), 3));
    scene.add(new THREE.LineSegments(eg, new THREE.LineBasicMaterial({ vertexColors: true, transparent: true, opacity: .14, blending: THREE.AdditiveBlending })));
    var core = new THREE.Mesh(new THREE.IcosahedronGeometry(2.1, 1), new THREE.MeshBasicMaterial({ color: '#8B7CFF', wireframe: true, transparent: true, opacity: .5 })); scene.add(core);
    var glow = new THREE.Mesh(new THREE.SphereGeometry(1.2, 24, 24), new THREE.MeshBasicMaterial({ color: '#B9A9FF', transparent: true, opacity: .28 })); scene.add(glow);
    var PN = opts.pulses || 60, pp = new Float32Array(PN * 3), pd = [];
    for (var k = 0; k < PN; k++) { var s = pos[(Math.random() * NODES) | 0]; pd.push({ s: s, t: Math.random() }); pp[k * 3] = s.x; pp[k * 3 + 1] = s.y; pp[k * 3 + 2] = s.z; }
    var pg = new THREE.BufferGeometry(); pg.setAttribute('position', new THREE.BufferAttribute(pp, 3));
    scene.add(new THREE.Points(pg, new THREE.PointsMaterial({ color: '#2FE3D2', size: 0.42, transparent: true, opacity: .9, blending: THREE.AdditiveBlending, depthWrite: false })));
    var mx = 0, my = 0, visible = true;
    new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
    window.addEventListener('mousemove', function (e) { mx = e.clientX / window.innerWidth - 0.5; my = e.clientY / window.innerHeight - 0.5; });
    (function frame(t) { requestAnimationFrame(frame); if (!visible) return; var w = canvas.clientWidth, h = canvas.clientHeight; if (!w || !h) return; if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); } var time = t / 1000; scene.rotation.y = time * 0.05 + mx * 0.4; scene.rotation.x = my * 0.25; core.rotation.x = time * 0.3; core.rotation.y = time * 0.22; glow.scale.setScalar(1 + Math.sin(time * 1.6) * 0.12); if (!reduced) { var arr = pg.attributes.position.array; for (var i = 0; i < PN; i++) { var d = pd[i]; d.t += 0.008; if (d.t > 1) { d.t = 0; d.s = pos[(Math.random() * NODES) | 0]; } var kk = 1 - d.t; arr[i * 3] = d.s.x * kk; arr[i * 3 + 1] = d.s.y * kk; arr[i * 3 + 2] = d.s.z * kk; } pg.attributes.position.needsUpdate = true; } renderer.render(scene, camera); })(0);
  }
  document.querySelectorAll('[data-net]').forEach(function (c) { agentNetwork(c, { nodes: +c.dataset.nodes || 80, pulses: +c.dataset.pulses || 55, z: +c.dataset.z || 19 }); });

  /* ---- logo knots ---- */
  document.querySelectorAll('canvas.knot').forEach(function (canvas) {
    if (!window.THREE) return;
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true }); renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene(), camera = new THREE.PerspectiveCamera(45, 1, 0.1, 50); camera.position.z = 7;
    var m = new THREE.Mesh(new THREE.TorusKnotGeometry(1.7, 0.4, 120, 16, 2, 3), new THREE.MeshStandardMaterial({ color: '#8B7CFF', metalness: .6, roughness: .3, emissive: '#2FE3D2', emissiveIntensity: .15 }));
    scene.add(m); scene.add(new THREE.AmbientLight('#5B6684', .8)); var key = new THREE.DirectionalLight('#CFC7FF', 1.4); key.position.set(3, 4, 5); scene.add(key);
    var visible = true; new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
    (function fr() { requestAnimationFrame(fr); if (!visible) return; var w = canvas.clientWidth, h = canvas.clientHeight; if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); } if (!reduced) m.rotation.y += 0.006; m.rotation.x = 0.4; renderer.render(scene, camera); })();
  });
})();
