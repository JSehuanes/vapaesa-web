document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.querySelector(".nav");
  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", String(open));
    });
  }

  const cycleBox = document.querySelector("[data-cycle]");
  if (cycleBox) {
    const slides = [...cycleBox.querySelectorAll(".home-hero-mask img")];
    const words = ["Avisos", "Vallas", "Plotter", "Neonflex"];
    const labels = document.querySelectorAll("[data-cycle-word]");
    let i = 0;
    setInterval(() => {
      i = (i + 1) % slides.length;
      slides.forEach((img, k) => img.classList.toggle("is-on", k === i));
      labels.forEach((el) => {
        el.textContent = words[i] || words[0];
      });
    }, 3800);
  }

  const reveals = document.querySelectorAll("[data-reveal]");
  if (reveals.length) {
    const rio = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add("is-in");
          rio.unobserve(entry.target);
        });
      },
      { threshold: 0.08, rootMargin: "0px 0px -8% 0px" }
    );
    reveals.forEach((el) => rio.observe(el));
  }

  const counters = document.querySelectorAll("[data-count]");
  if (counters.length) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const el = entry.target;
          io.unobserve(el);
          const to = Number(el.dataset.count) || 0;
          const start = performance.now();
          const tick = (now) => {
            const t = Math.min(1, Math.max(0, (now - start) / 1200));
            const eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(to * eased).toLocaleString("es-CO");
            if (t < 1) requestAnimationFrame(tick);
          };
          requestAnimationFrame(tick);
        });
      },
      { threshold: 0.35 }
    );
    counters.forEach((el) => io.observe(el));
  }

  document.querySelectorAll("[data-carousel]").forEach((box) => {
    const slides = [...box.querySelectorAll("[data-slide]")];
    const dots = [...box.querySelectorAll("[data-dot]")];
    if (!slides.length) return;
    let i = 0;
    const show = (n) => {
      i = (n + slides.length) % slides.length;
      slides.forEach((slide, k) => {
        slide.hidden = k !== i;
      });
      dots.forEach((dot, k) => dot.classList.toggle("is-on", k === i));
    };
    dots.forEach((dot, k) => dot.addEventListener("click", () => show(k)));
    setInterval(() => show(i + 1), 5000);
  });

  const filters = document.querySelectorAll(".filter");
  const shots = document.querySelectorAll(".shot");
  filters.forEach((btn) => {
    btn.addEventListener("click", () => {
      filters.forEach((b) => b.classList.remove("is-on"));
      btn.classList.add("is-on");
      const key = btn.dataset.filter;
      shots.forEach((shot) => {
        shot.hidden = key !== "todo" && shot.dataset.cat !== key;
      });
    });
  });

  const lightbox = document.querySelector("#catalog-lightbox");
  const lightImg = lightbox ? lightbox.querySelector("img") : null;
  let lightFotos = [];
  let lightIndex = 0;

  const showLight = (index) => {
    if (!lightImg || !lightFotos.length) return;
    lightIndex = (index + lightFotos.length) % lightFotos.length;
    lightImg.src = lightFotos[lightIndex];
  };

  document.querySelectorAll("[data-gallery]").forEach((gal) => {
    const main = gal.querySelector(".catalog-media img");
    gal.querySelectorAll(".catalog-thumb").forEach((btn) => {
      btn.addEventListener("click", () => {
        gal.querySelectorAll(".catalog-thumb").forEach((b) => b.classList.remove("is-on"));
        btn.classList.add("is-on");
        if (main) {
          main.src = btn.dataset.src;
          main.dataset.full = btn.dataset.full;
        }
      });
    });
    const open = gal.querySelector("[data-open]");
    if (open && lightbox) {
      open.addEventListener("click", () => {
        lightFotos = [...gal.querySelectorAll(".catalog-thumb")].map((b) => b.dataset.full);
        if (!lightFotos.length && main) {
          lightFotos = [main.dataset.full || main.src];
        }
        const on = gal.querySelector(".catalog-thumb.is-on");
        const start = on ? [...gal.querySelectorAll(".catalog-thumb")].indexOf(on) : 0;
        showLight(start);
        lightbox.showModal();
      });
    }
  });

  if (lightbox) {
    lightbox.querySelector("[data-close]")?.addEventListener("click", () => lightbox.close());
    lightbox.querySelector("[data-prev]")?.addEventListener("click", () => showLight(lightIndex - 1));
    lightbox.querySelector("[data-next]")?.addEventListener("click", () => showLight(lightIndex + 1));
    lightbox.addEventListener("click", (ev) => {
      if (ev.target === lightbox) lightbox.close();
    });
  }

  const KEY = "vapaesa-cotizacion";
  const dialog = document.querySelector("#quote-dialog");
  const waNumber = dialog?.dataset.wa || "";
  let pending = null;

  const loadCart = () => {
    try {
      const raw = JSON.parse(localStorage.getItem(KEY) || "[]");
      return Array.isArray(raw) ? raw : [];
    } catch {
      return [];
    }
  };

  const saveCart = (items) => {
    localStorage.setItem(KEY, JSON.stringify(items));
    paintBadges();
  };

  const itemKey = (item) => [item.handle, item.sku, item.titulo].join("::");

  const addItem = (item) => {
    const items = loadCart();
    const i = items.findIndex((x) => itemKey(x) === itemKey(item));
    if (i >= 0) {
      const max = Number(items[i].max);
      const next = items[i].qty + item.qty;
      items[i].qty = Number.isFinite(max) && max > 0 ? Math.min(next, max) : next;
    } else {
      items.push(item);
    }
    saveCart(items);
  };

  const paintBadges = () => {
    const n = loadCart().length;
    document.querySelectorAll(".quote-badge").forEach((el) => {
      el.hidden = n === 0;
      el.textContent = String(n);
    });
  };

  const fmt = (n) => Number(n).toLocaleString("es-CO");

  const waHref = (items) => {
    const lines = items.map((it) => {
      const tag = it.etiqueta ? `(${it.etiqueta}) ` : "";
      const ref = [it.sku, it.titulo].filter(Boolean).join(" · ");
      return `${tag}• ${it.nombre}${ref ? " — " + ref : ""} × ${fmt(it.qty)} und`;
    });
    const msg = "Hola, quiero realizar una cotización. *vapaesa* :\n\n" + lines.join("\n") + "\n\nGracias.";
    return "https://wa.me/" + waNumber + "?text=" + encodeURIComponent(msg);
  };

  const sendWhatsApp = () => {
    const items = loadCart();
    if (!items.length || !waNumber) return;
    window.open(waHref(items), "_blank", "noopener,noreferrer");
  };

  const showView = (name) => {
    if (!dialog) return;
    dialog.querySelectorAll(".quote-view").forEach((view) => {
      view.hidden = view.dataset.view !== name;
    });
  };

  const selectedVariant = (form) => {
    const radio = form.querySelector('input[name="var"]:checked');
    if (radio) {
      return {
        sku: radio.dataset.sku || "",
        titulo: radio.dataset.titulo || "",
        max: radio.dataset.max || "",
      };
    }
    return {
      sku: form.querySelector('[name="sku"]')?.value || "",
      titulo: form.querySelector('[name="titulo"]')?.value || "",
      max: form.querySelector('[name="max"]')?.value || "",
    };
  };

  const openAdd = (item) => {
    if (!dialog) return;
    pending = item;
    const maxN = Number(item.max);
    const hasMax = Number.isFinite(maxN) && item.max !== "";
    dialog.querySelector("[data-quote-name]").textContent = item.nombre;
    dialog.querySelector("[data-quote-var]").textContent = [item.sku, item.titulo].filter(Boolean).join(" · ");
    dialog.querySelector("[data-quote-max]").textContent = hasMax ? fmt(maxN) + " und" : "consultar";
    const input = dialog.querySelector("#quote-qty");
    input.min = "1";
    input.removeAttribute("max");
    input.value = "1";
    const err = dialog.querySelector("[data-quote-err]");
    err.hidden = true;
    err.textContent = "";
    hideAlert();
    showView("add");
    dialog.showModal();
    input.focus();
    input.select();
  };

  let alertResolve = null;

  const hideAlert = () => {
    const box = dialog?.querySelector("[data-quote-alert]");
    if (box) box.hidden = true;
    dialog?.classList.remove("has-alert");
  };

  const confirmAvailable = (qty, maxN, input, label) => {
    if (!Number.isInteger(qty) || qty < 1 || qty <= maxN) {
      return Promise.resolve(qty);
    }
    input.value = String(maxN);
    const ref = label ? " de " + label : "";
    const box = dialog.querySelector("[data-quote-alert]");
    dialog.querySelector("[data-quote-alert-text]").textContent =
      "Solo hay " + fmt(maxN) + " unidades disponibles" + ref +
      ". Confirma si deseas cotizar las " + fmt(maxN) + " disponibles.";
    box.hidden = false;
    dialog.classList.add("has-alert");
    return new Promise((resolve) => {
      alertResolve = resolve;
    }).then((ok) => {
      hideAlert();
      return ok ? maxN : null;
    });
  };

  const readQty = async () => {
    const input = dialog.querySelector("#quote-qty");
    const err = dialog.querySelector("[data-quote-err]");
    const qty = Number.parseInt(String(input.value), 10);
    const maxN = Number(pending?.max);
    const hasMax = pending && pending.max !== "" && Number.isFinite(maxN);
    if (!Number.isInteger(qty) || qty < 1) {
      err.textContent = "Escribe una cantidad de 1 o más.";
      err.hidden = false;
      return null;
    }
    if (hasMax && qty > maxN) {
      const ref = [pending.sku, pending.titulo].filter(Boolean).join(" · ");
      const confirmed = await confirmAvailable(qty, maxN, input, ref);
      if (confirmed === null) {
        err.textContent = "Confirma una cantidad igual o menor a las " + fmt(maxN) + " und disponibles.";
        err.hidden = false;
        return null;
      }
      err.hidden = true;
      return confirmed;
    }
    err.hidden = true;
    return qty;
  };

  const confirmPending = async () => {
    const qty = await readQty();
    if (qty === null || !pending) return null;
    addItem({ ...pending, qty });
    pending = null;
    return true;
  };

  const paintCart = () => {
    const items = loadCart();
    const list = dialog.querySelector("[data-quote-list]");
    const send = dialog.querySelector("[data-quote-send-cart]");
    list.innerHTML = "";
    send.disabled = items.length === 0;
    items.forEach((it, index) => {
      const li = document.createElement("li");
      const ref = [it.sku, it.titulo].filter(Boolean).join(" · ");
      const maxN = Number(it.max);
      const hasMax = it.max !== "" && Number.isFinite(maxN);
      li.innerHTML =
        "<div><strong></strong><span></span></div>" +
        '<label>Cant. <input type="number" min="1" step="1" inputmode="numeric" /></label>' +
        '<button type="button" class="quote-remove">Quitar</button>';
      li.querySelector("strong").textContent = it.nombre;
      li.querySelector("span").textContent = ref + (hasMax ? " · máx. " + fmt(maxN) : "");
      const qty = li.querySelector("input");
      qty.value = String(it.qty);
      qty.addEventListener("change", async () => {
        let n = Number.parseInt(qty.value, 10);
        if (!Number.isInteger(n) || n < 1) n = 1;
        if (hasMax && n > maxN) {
          const confirmed = await confirmAvailable(n, maxN, qty, ref);
          if (confirmed === null) return;
          n = confirmed;
        }
        qty.value = String(n);
        const next = loadCart();
        next[index].qty = n;
        saveCart(next);
      });
      li.querySelector(".quote-remove").addEventListener("click", () => {
        saveCart(loadCart().filter((_, i) => i !== index));
        paintCart();
      });
      list.appendChild(li);
    });
  };

  const openCart = () => {
    if (!dialog) return;
    paintCart();
    showView("cart");
    dialog.showModal();
  };

  const openEmpty = () => {
    if (!dialog) return;
    showView("empty");
    dialog.showModal();
  };

  document.querySelectorAll("[data-quote-add]").forEach((form) => {
    form.addEventListener("submit", (ev) => {
      ev.preventDefault();
      const v = selectedVariant(form);
      const maxN = Number(v.max);
      const hasMax = v.max !== "" && Number.isFinite(maxN);
      if (hasMax && maxN <= 0) return;
      if (!v.sku && !form.nombre?.value) return;
      if (form.querySelectorAll('input[name="var"]').length && !form.querySelector('input[name="var"]:checked')) {
        return;
      }
      openAdd({
        handle: form.handle.value,
        nombre: form.nombre.value,
        etiqueta: form.etiqueta?.value || "",
        sku: v.sku,
        titulo: v.titulo,
        max: v.max,
      });
    });
  });

  document.querySelectorAll("[data-quote-open]").forEach((el) => {
    el.addEventListener("click", (ev) => {
      ev.preventDefault();
      if (loadCart().length) {
        openCart();
      } else {
        openEmpty();
      }
    });
  });

  dialog?.querySelector("[data-quote-more]")?.addEventListener("click", async () => {
    if (!(await confirmPending())) return;
    dialog.close();
    window.location.assign((window.VAPAESA_BASE || "") + "/productos");
  });

  dialog?.querySelector("[data-quote-send]")?.addEventListener("click", async () => {
    if (!(await confirmPending())) return;
    dialog.close();
    sendWhatsApp();
  });

  dialog?.querySelector("[data-quote-alert-ok]")?.addEventListener("click", () => {
    alertResolve?.(true);
    alertResolve = null;
  });

  dialog?.querySelector("[data-quote-alert-no]")?.addEventListener("click", () => {
    alertResolve?.(false);
    alertResolve = null;
  });

  dialog?.querySelector("[data-quote-send-cart]")?.addEventListener("click", () => {
    sendWhatsApp();
  });

  dialog?.querySelector("[data-quote-close]")?.addEventListener("click", () => dialog.close());
  dialog?.addEventListener("click", (ev) => {
    if (ev.target === dialog) dialog.close();
  });
  dialog?.addEventListener("close", () => {
    hideAlert();
    alertResolve?.(false);
    alertResolve = null;
  });

  paintBadges();
});
