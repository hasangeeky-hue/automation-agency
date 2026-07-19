/* Anthropos Automation OS — theme JS (v3): MiniFlow automation objects,
   Three.js agent networks, logo knots, scroll reveal, 10 guide cards. */
(function () {
  'use strict';
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* mobile nav toggle */
  var toggle = document.getElementById('navToggle');
  var hd = document.querySelector('.hd');
  if (toggle && hd) {
    toggle.addEventListener('click', function () {
      var open = hd.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    // close the menu after tapping a link
    hd.querySelectorAll('.nav a').forEach(function (a) {
      a.addEventListener('click', function () { hd.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); });
    });
  }

  /* scroll reveal */
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });

  /* ---- 10 guide cards ---- */
  var grid = document.getElementById('svcGuides');
  if (grid) {
    [['G01', 'Why enterprise buyers ghost after the demo'], ['G02', 'The AEO answer box that gets you cited'],
     ['G03', 'Local + AI visibility for B2B services'], ['G04', 'The 60-second reply, enterprise edition'],
     ['G05', 'Mapping a 6-month cycle into n8n stages'], ['G06', 'Which 5 workflows to automate first'],
     ['G07', 'Stakeholder routing without a big CRM'], ['G08', 'Proof pages that survive procurement'],
     ['G09', 'Reading your lead report, honestly'], ['G10', 'From pilot to always-on automation']
    ].forEach(function (g) {
      var el = document.createElement('div'); el.className = 'glass gcard';
      el.innerHTML = '<div class="gi">' + g[0] + '</div><h5>' + g[1] + '</h5><div class="ga">problem → solution → CTA</div>';
      grid.appendChild(el);
    });
  }

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
    var varName = raw.indexOf('var(') === 0 ? raw.slice(4, -1).trim() : null;
    var v = varName ? getComputedStyle(document.documentElement).getPropertyValue(varName).trim() : (raw || '#2FE3D2');
    v = v.replace('#', ''); if (v.length === 3) v = v.split('').map(function (x) { return x + x; }).join('');
    var n = parseInt(v, 16); return (n >> 16 & 255) + ',' + (n >> 8 & 255) + ',' + (n & 255);
  }
  function makeFlow(canvas) {
    var P = PRESETS[canvas.dataset.fx] || PRESETS.mesh;
    var rc = accentRgb(canvas), ctx = canvas.getContext('2d');
    var W = 0, H = 0, dpr = Math.min(window.devicePixelRatio || 1, 2);
    function size() { var r = canvas.getBoundingClientRect(); W = r.width; H = r.height; canvas.width = W * dpr; canvas.height = H * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0); }
    var pulses = P.edges.map(function (e, i) { return { e: e, t: (i / P.edges.length) }; });
    var visible = true;
    new IntersectionObserver(function (es) { visible = es[0].isIntersecting; }).observe(canvas);
    flows.push({
      visible: function () { return visible; },
      draw: function (time) {
        if (!W || Math.abs(canvas.getBoundingClientRect().width - W) > 1) size();
        if (!W || !H) return;
        ctx.clearRect(0, 0, W, H);
        var pts = P.nodes.map(function (n) { return [n[0] * W, n[1] * H]; });
        ctx.lineWidth = 1;
        P.edges.forEach(function (e) {
          var a = e[0], b = e[1];
          var g = ctx.createLinearGradient(pts[a][0], pts[a][1], pts[b][0], pts[b][1]);
          g.addColorStop(0, 'rgba(' + rc + ',.10)'); g.addColorStop(1, 'rgba(' + rc + ',.30)');
          ctx.strokeStyle = g; ctx.beginPath(); ctx.moveTo(pts[a][0], pts[a][1]);
          var mx = (pts[a][0] + pts[b][0]) / 2, my = (pts[a][1] + pts[b][1]) / 2 - 10;
          ctx.quadraticCurveTo(mx, my, pts[b][0], pts[b][1]); ctx.stroke();
        });
        if (P.ring) { var cx = pts[0][0], cy = pts[0][1], rr = Math.min(W, H) * 0.32; ctx.strokeStyle = 'rgba(' + rc + ',.18)'; ctx.beginPath(); ctx.ellipse(cx, cy, rr, rr * 0.5, time * 0.0006, 0, Math.PI * 2); ctx.stroke(); }
        if (!reduced) pulses.forEach(function (p) {
          p.t += 0.006; if (p.t > 1) p.t -= 1;
          var a = pts[p.e[0]], b = pts[p.e[1]], mx = (a[0] + b[0]) / 2, my = (a[1] + b[1]) / 2 - 10, t = p.t, it = 1 - t;
          var x = it * it * a[0] + 2 * it * t * mx + t * t * b[0], y = it * it * a[1] + 2 * it * t * my + t * t * b[1];
          var grd = ctx.createRadialGradient(x, y, 0, x, y, 7); grd.addColorStop(0, 'rgba(' + rc + ',.95)'); grd.addColorStop(1, 'rgba(' + rc + ',0)');
          ctx.fillStyle = grd; ctx.beginPath(); ctx.arc(x, y, 7, 0, Math.PI * 2); ctx.fill();
        });
        pts.forEach(function (p, i) {
          var big = P.big.indexOf(i) !== -1, r = big ? 7 : 3.4, pulse = big ? (1 + Math.sin(time * 0.003) * 0.18) : 1;
          var glow = ctx.createRadialGradient(p[0], p[1], 0, p[0], p[1], r * 4 * pulse);
          glow.addColorStop(0, 'rgba(' + rc + ',.5)'); glow.addColorStop(1, 'rgba(' + rc + ',0)');
          ctx.fillStyle = glow; ctx.beginPath(); ctx.arc(p[0], p[1], r * 4 * pulse, 0, Math.PI * 2); ctx.fill();
          ctx.fillStyle = big ? 'rgba(' + rc + ',1)' : 'rgba(' + rc + ',.85)'; ctx.beginPath(); ctx.arc(p[0], p[1], r * pulse, 0, Math.PI * 2); ctx.fill();
          if (big) { ctx.strokeStyle = 'rgba(' + rc + ',.5)'; ctx.beginPath(); ctx.arc(p[0], p[1], r * 2.1 * pulse, 0, Math.PI * 2); ctx.stroke(); }
        });
      }
    });
    size();
  }
  document.querySelectorAll('.fxcanvas').forEach(makeFlow);
  (function loop(t) { requestAnimationFrame(loop); flows.forEach(function (f) { if (f.visible()) f.draw(t); }); })(0);

  /* ================= Three.js agent network ================= */
  function agentNetwork(id, opts) {
    var canvas = document.getElementById(id); if (!canvas || !window.THREE) return; opts = opts || {};
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(55, 2, 0.1, 100); camera.position.set(0, 0, opts.z || 20);
    var NODES = opts.nodes || 90, pos = [];
    for (var i = 0; i < NODES; i++) { var r = 6 + Math.random() * 8, th = Math.random() * Math.PI * 2, ph = Math.acos(2 * Math.random() - 1); pos.push(new THREE.Vector3(r * Math.sin(ph) * Math.cos(th), r * Math.sin(ph) * Math.sin(th) * 0.7, r * Math.cos(ph))); }
    var npos = new Float32Array(NODES * 3), ncol = new Float32Array(NODES * 3);
    var cFlow = new THREE.Color('#2FE3D2'), cAI = new THREE.Color('#8B7CFF'), cCta = new THREE.Color('#FF5C8A');
    pos.forEach(function (p, i) { npos[i * 3] = p.x; npos[i * 3 + 1] = p.y; npos[i * 3 + 2] = p.z; var c = i % 7 === 0 ? cCta : (i % 2 ? cAI : cFlow); ncol[i * 3] = c.r; ncol[i * 3 + 1] = c.g; ncol[i * 3 + 2] = c.b; });
    var ng = new THREE.BufferGeometry(); ng.setAttribute('position', new THREE.BufferAttribute(npos, 3)); ng.setAttribute('color', new THREE.BufferAttribute(ncol, 3));
    scene.add(new THREE.Points(ng, new THREE.PointsMaterial({ size: 0.28, vertexColors: true, transparent: true, opacity: .95, blending: THREE.AdditiveBlending, depthWrite: false })));
    var everts = [], ecol = [];
    for (var a = 0; a < NODES; a++) for (var b = a + 1; b < NODES; b++) { if (pos[a].distanceTo(pos[b]) < 4.2 && Math.random() > 0.55) { everts.push(pos[a].x, pos[a].y, pos[a].z, pos[b].x, pos[b].y, pos[b].z); ecol.push(cAI.r, cAI.g, cAI.b, cFlow.r, cFlow.g, cFlow.b); } }
    var eg = new THREE.BufferGeometry(); eg.setAttribute('position', new THREE.BufferAttribute(new Float32Array(everts), 3)); eg.setAttribute('color', new THREE.BufferAttribute(new Float32Array(ecol), 3));
    scene.add(new THREE.LineSegments(eg, new THREE.LineBasicMaterial({ vertexColors: true, transparent: true, opacity: .14, blending: THREE.AdditiveBlending })));
    var core = new THREE.Mesh(new THREE.IcosahedronGeometry(2.1, 1), new THREE.MeshBasicMaterial({ color: '#8B7CFF', wireframe: true, transparent: true, opacity: .5 })); scene.add(core);
    var coreGlow = new THREE.Mesh(new THREE.SphereGeometry(1.2, 24, 24), new THREE.MeshBasicMaterial({ color: '#B9A9FF', transparent: true, opacity: .28 })); scene.add(coreGlow);
    var PN = opts.pulses || 60, ppos = new Float32Array(PN * 3), pdata = [];
    for (var k = 0; k < PN; k++) { var src = pos[(Math.random() * NODES) | 0]; pdata.push({ src: src, t: Math.random() }); ppos[k * 3] = src.x; ppos[k * 3 + 1] = src.y; ppos[k * 3 + 2] = src.z; }
    var pg = new THREE.BufferGeometry(); pg.setAttribute('position', new THREE.BufferAttribute(ppos, 3));
    scene.add(new THREE.Points(pg, new THREE.PointsMaterial({ color: '#2FE3D2', size: 0.42, transparent: true, opacity: .9, blending: THREE.AdditiveBlending, depthWrite: false })));
    var mx = 0, my = 0, visible = true;
    new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
    window.addEventListener('mousemove', function (e) { mx = (e.clientX / window.innerWidth - 0.5); my = (e.clientY / window.innerHeight - 0.5); });
    (function frame(t) {
      requestAnimationFrame(frame); if (!visible) return;
      var w = canvas.clientWidth, h = canvas.clientHeight; if (!w || !h) return;
      if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); }
      var time = t / 1000; scene.rotation.y = time * 0.05 + mx * 0.4; scene.rotation.x = my * 0.25;
      core.rotation.x = time * 0.3; core.rotation.y = time * 0.22; coreGlow.scale.setScalar(1 + Math.sin(time * 1.6) * 0.12);
      if (!reduced) { var arr = pg.attributes.position.array; for (var i = 0; i < PN; i++) { var d = pdata[i]; d.t += 0.008; if (d.t > 1) { d.t = 0; d.src = pos[(Math.random() * NODES) | 0]; } var kk = 1 - d.t; arr[i * 3] = d.src.x * kk; arr[i * 3 + 1] = d.src.y * kk; arr[i * 3 + 2] = d.src.z * kk; } pg.attributes.position.needsUpdate = true; }
      renderer.render(scene, camera);
    })(0);
  }
  agentNetwork('heroFx', { nodes: 100, pulses: 70, z: 20 });
  agentNetwork('svcHeroFx', { nodes: 55, pulses: 36, z: 18 });
  agentNetwork('ctaFx', { nodes: 60, pulses: 40, z: 19 });

  /* ---- logo knots ---- */
  document.querySelectorAll('canvas.knot').forEach(function (canvas) {
    if (!window.THREE) return;
    var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true }); renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    var scene = new THREE.Scene(); var camera = new THREE.PerspectiveCamera(45, 1, 0.1, 50); camera.position.z = 7;
    var m = new THREE.Mesh(new THREE.TorusKnotGeometry(1.7, 0.4, 120, 16, 2, 3), new THREE.MeshStandardMaterial({ color: '#8B7CFF', metalness: .6, roughness: .3, emissive: '#2FE3D2', emissiveIntensity: .15 }));
    scene.add(m); scene.add(new THREE.AmbientLight('#5B6684', .8));
    var key = new THREE.DirectionalLight('#CFC7FF', 1.4); key.position.set(3, 4, 5); scene.add(key);
    var visible = true; new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
    (function fr() { requestAnimationFrame(fr); if (!visible) return; var w = canvas.clientWidth, h = canvas.clientHeight; if (canvas.width !== w || canvas.height !== h) { renderer.setSize(w, h, false); camera.aspect = w / h; camera.updateProjectionMatrix(); } if (!reduced) m.rotation.y += 0.006; m.rotation.x = 0.4; renderer.render(scene, camera); })();
  });

  /* ---- reading progress (single) ---- */
  var bar = document.getElementById('aaProgress');
  if (bar) window.addEventListener('scroll', function () { var doc = document.documentElement; var max = doc.scrollHeight - window.innerHeight; bar.style.width = (max > 0 ? (window.scrollY / max) * 100 : 0) + '%'; }, { passive: true });
})();
