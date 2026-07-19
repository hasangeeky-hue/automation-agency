/* Anthropos theme JS: logo knots, lead-river hero, reading progress. */
(function () {
	'use strict';
	var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* --- golden knot logo marks (header + footer) --- */
	function knot(canvas) {
		if (!canvas || !window.THREE) { return; }
		var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
		renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
		var scene = new THREE.Scene();
		var camera = new THREE.PerspectiveCamera(45, 1, 0.1, 50);
		camera.position.z = 7;
		var mesh = new THREE.Mesh(
			new THREE.TorusKnotGeometry(1.7, 0.42, 120, 18, 2, 3),
			new THREE.MeshStandardMaterial({ color: '#E8A34C', metalness: 0.55, roughness: 0.32 })
		);
		scene.add(mesh);
		scene.add(new THREE.AmbientLight('#7C86A3', 0.7));
		var key = new THREE.DirectionalLight('#FFE9C4', 1.4);
		key.position.set(3, 4, 5);
		scene.add(key);
		var visible = true;
		new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
		(function frame() {
			requestAnimationFrame(frame);
			if (!visible) { return; }
			var w = canvas.clientWidth, h = canvas.clientHeight;
			if (canvas.width !== w || canvas.height !== h) {
				renderer.setSize(w, h, false);
				camera.aspect = w / h;
				camera.updateProjectionMatrix();
			}
			if (!reduced) { mesh.rotation.y += 0.004; }
			mesh.rotation.x = 0.4;
			renderer.render(scene, camera);
		})();
	}
	document.querySelectorAll('canvas.aa-knot').forEach(knot);

	/* --- lead river hero (front page) --- */
	(function () {
		var canvas = document.getElementById('aaRiver');
		if (!canvas || !window.THREE) { return; }
		var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
		renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
		var scene = new THREE.Scene();
		var camera = new THREE.PerspectiveCamera(50, 2, 0.1, 100);
		camera.position.set(0, 0, 13);
		var N = 1100;
		var chaos = new Float32Array(N * 3), flow = new Float32Array(N * 3);
		var pos = new Float32Array(N * 3), col = new Float32Array(N * 3);
		var cA = new THREE.Color('#5F6FB8'), cB = new THREE.Color('#E8A34C'), tmp = new THREE.Color();
		for (var i = 0; i < N; i++) {
			chaos[i * 3] = (Math.random() - 0.5) * 26;
			chaos[i * 3 + 1] = (Math.random() - 0.5) * 11;
			chaos[i * 3 + 2] = (Math.random() - 0.5) * 7;
			var t = i / N, sp = (1 - t) * 2.3 + 0.05;
			flow[i * 3] = -11 + t * 20;
			flow[i * 3 + 1] = Math.sin(t * Math.PI * 2) * 2 * (1 - t) + (Math.random() - 0.5) * sp - 1.2;
			flow[i * 3 + 2] = (Math.random() - 0.5) * sp;
			pos[i * 3] = chaos[i * 3];
			pos[i * 3 + 1] = chaos[i * 3 + 1];
			pos[i * 3 + 2] = chaos[i * 3 + 2];
		}
		var geo = new THREE.BufferGeometry();
		geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
		geo.setAttribute('color', new THREE.BufferAttribute(col, 3));
		scene.add(new THREE.Points(geo, new THREE.PointsMaterial({
			size: 0.085, vertexColors: true, transparent: true, opacity: 0.85,
			blending: THREE.AdditiveBlending, depthWrite: false
		})));
		var mix = reduced ? 1 : 0, tPrev = 0, visible = true;
		new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }).observe(canvas);
		(function frame(t) {
			requestAnimationFrame(frame);
			if (!visible) { return; }
			var w = canvas.clientWidth, h = canvas.clientHeight;
			if (canvas.width !== w || canvas.height !== h) {
				renderer.setSize(w, h, false);
				camera.aspect = w / h;
				camera.updateProjectionMatrix();
			}
			var dt = Math.min((t - tPrev) / 1000, 0.05);
			tPrev = t;
			if (t > 1800) { mix += (1 - mix) * (reduced ? 1 : 1.2 * dt); }
			var p = geo.attributes.position.array, c = geo.attributes.color.array, time = t / 1000;
			for (var i = 0; i < N; i++) {
				var wob = Math.sin(time * 0.7 + i * 1.7) * 0.13;
				var drift = Math.sin(time * 0.5 + i) * 0.32;
				p[i * 3] = chaos[i * 3] * (1 - mix) + flow[i * 3] * mix;
				p[i * 3 + 1] = (chaos[i * 3 + 1] + drift) * (1 - mix) + (flow[i * 3 + 1] + wob) * mix;
				p[i * 3 + 2] = chaos[i * 3 + 2] * (1 - mix) + flow[i * 3 + 2] * mix;
				tmp.copy(cA).lerp(cB, mix * (0.35 + 0.65 * (i / N)));
				c[i * 3] = tmp.r; c[i * 3 + 1] = tmp.g; c[i * 3 + 2] = tmp.b;
			}
			geo.attributes.position.needsUpdate = true;
			geo.attributes.color.needsUpdate = true;
			renderer.render(scene, camera);
		})(0);
	})();

	/* --- reading progress on single posts --- */
	(function () {
		var bar = document.getElementById('aaProgress');
		if (!bar) { return; }
		window.addEventListener('scroll', function () {
			var doc = document.documentElement;
			var max = doc.scrollHeight - window.innerHeight;
			bar.style.width = (max > 0 ? (window.scrollY / max) * 100 : 0) + '%';
		}, { passive: true });
	})();
})();
