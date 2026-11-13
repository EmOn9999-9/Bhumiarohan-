
const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

/* ---------------- Header & mobile menu ---------------- */
function initHeader() {
    const header = $('#site-header');
    if (!header) return;
    const toggle = $('#menu-toggle');
    const menu = $('#mobile-menu');
    let open = false;

    const update = () => header.classList.toggle('is-solid', open || window.scrollY > 24);
    window.addEventListener('scroll', update, { passive: true });
    update();

    toggle?.addEventListener('click', () => {
        open = !open;
        menu.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
        $('.icon-open', toggle).classList.toggle('hidden', open);
        $('.icon-close', toggle).classList.toggle('hidden', !open);
        update();
    });

    window.matchMedia('(min-width: 1280px)').addEventListener('change', (e) => {
        if (e.matches && open) toggle.click();
    });
}

/* ---------------- Scroll reveal ---------------- */
function initReveal() {
    // Every page/section title (h1, h2) not already animated on load slides up into view.
    $$('main h1, main h2')
        .filter((el) => !el.closest('.hero-rise'))
        .forEach((el) => el.classList.add('title-rise'));

    const items = $$('.reveal, .title-rise');
    if (!('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }
    const pending = new Set(items);
    const show = (el) => {
        el.classList.add('is-visible');
        pending.delete(el);
        io.unobserve(el);
    };
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => entry.isIntersecting && show(entry.target));
    }, { rootMargin: '0px 0px -40px 0px', threshold: 0.05 });
    items.forEach((el) => io.observe(el));

    // Fallback for fast scrolls / anchor jumps: reveal anything already scrolled past.
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (ticking || !pending.size) return;
        ticking = true;
        requestAnimationFrame(() => {
            pending.forEach((el) => el.getBoundingClientRect().top < window.innerHeight && show(el));
            ticking = false;
        });
    }, { passive: true });
}

/* ---------------- Project filter ---------------- */
function initProjectFilter() {
    const bar = $('[data-filter-bar]');
    if (!bar) return;
    const cards = $$('[data-filter-grid] [data-category]');
    const empty = $('[data-filter-empty]');

    bar.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-filter]');
        if (!btn) return;
        const value = btn.dataset.filter;
        $$('[data-filter]', bar).forEach((b) => b.setAttribute('aria-pressed', String(b === btn)));
        let shown = 0;
        cards.forEach((card) => {
            const match = value === 'all' || card.dataset.category === value;
            card.classList.toggle('hidden', !match);
            if (match) { card.classList.add('is-visible'); shown++; }
        });
        empty?.classList.toggle('hidden', shown > 0);
    });
}

/* ---------------- Lightbox ---------------- */
function initLightbox() {
    const links = $$('[data-lightbox]');
    const box = $('#lightbox');
    if (!links.length || !box) return;
    const img = $('img', box);
    const counter = $('[data-lightbox-counter]', box);
    let index = 0;

    const show = (i) => {
        index = (i + links.length) % links.length;
        img.src = links[index].href;
        img.alt = links[index].dataset.alt || '';
        counter.textContent = `${index + 1} / ${links.length}`;
    };
    const open = (i) => { show(i); box.classList.remove('hidden'); box.classList.add('flex'); document.body.style.overflow = 'hidden'; $('[data-lightbox-close]', box).focus(); };
    const close = () => { box.classList.add('hidden'); box.classList.remove('flex'); document.body.style.overflow = ''; links[index].focus(); };

    links.forEach((a, i) => a.addEventListener('click', (e) => { e.preventDefault(); open(i); }));
    $('[data-lightbox-close]', box).addEventListener('click', close);
    $('[data-lightbox-prev]', box).addEventListener('click', () => show(index - 1));
    $('[data-lightbox-next]', box).addEventListener('click', () => show(index + 1));
    box.addEventListener('click', (e) => { if (e.target === box) close(); });
    document.addEventListener('keydown', (e) => {
        if (box.classList.contains('hidden')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') show(index - 1);
        if (e.key === 'ArrowRight') show(index + 1);
    });
}

/* ---------------- Nepali land unit converter ----------------
   Hilly system:  1 Ropani = 16 Aana, 1 Aana = 4 Paisa, 1 Paisa = 4 Daam
                  1 Ropani = 5476 sq.ft
   Terai system:  1 Bigha = 20 Kattha, 1 Kattha = 20 Dhur
                  1 Bigha = 72900 sq.ft
--------------------------------------------------------------- */
const SQFT = {
    ropani: 5476, aana: 342.25, paisa: 85.5625, daam: 21.390625,
    bigha: 72900, kattha: 3645, dhur: 182.25,
    sqft: 1, sqm: 10.7639104, acre: 43560,
};
const GROUPS = {
    hilly: ['ropani', 'aana', 'paisa', 'daam'],
    terai: ['bigha', 'kattha', 'dhur'],
    sqft: ['sqft'],
    sqm: ['sqm'],
    acre: ['acre'],
};

function initConverter() {
    const form = $('#converter');
    if (!form) return;
    const input = (unit) => $(`[name="${unit}"]`, form);
    const num = (v) => { const n = parseFloat(v); return Number.isFinite(n) && n > 0 ? n : 0; };
    const fmt = (n, d = 2) => (Math.round(n * 10 ** d) / 10 ** d).toString();

    // Split a total (sq.ft) into whole units of a traditional system, last unit keeps decimals.
    const split = (total, units) => {
        let rest = total;
        return units.map((u, i) => {
            if (i === units.length - 1) return fmt(rest / SQFT[u]);
            const whole = Math.floor((rest + 1e-9) / SQFT[u]);
            rest -= whole * SQFT[u];
            return String(whole);
        });
    };

    const summary = $('#converter-summary');

    const recalc = (source) => {
        const group = Object.keys(GROUPS).find((g) => GROUPS[g].includes(source));
        const total = GROUPS[group].reduce((sum, u) => sum + num(input(u).value) * SQFT[u], 0);

        for (const [g, units] of Object.entries(GROUPS)) {
            if (g === group) continue;
            if (!total) { units.forEach((u) => (input(u).value = '')); continue; }
            if (units.length > 1) split(total, units).forEach((v, i) => (input(units[i]).value = v));
            else input(units[0]).value = fmt(total / SQFT[units[0]], g === 'acre' ? 4 : 2);
        }

        if (summary) {
            summary.textContent = total
                ? `${fmt(total)} sq.ft  ≈  ${fmt(total / SQFT.sqm)} m²  ≈  ${fmt(total / SQFT.ropani, 4)} Ropani  ≈  ${fmt(total / SQFT.kattha, 4)} Kattha`
                : 'Enter a value in any field to convert.';
        }
    };

    form.addEventListener('input', (e) => { if (e.target.name in SQFT) recalc(e.target.name); });
    form.addEventListener('reset', () => setTimeout(() => recalc('sqft'), 0));
    form.addEventListener('submit', (e) => e.preventDefault());
}

/* ---------------- Contact form: prevent double submit ---------------- */
function initForms() {
    $$('form[data-once]').forEach((f) => f.addEventListener('submit', () => {
        const btn = $('button[type="submit"]', f);
        if (btn) { btn.disabled = true; btn.dataset.label = btn.innerHTML; btn.textContent = 'Sending…'; }
    }));
}

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initReveal();
    initProjectFilter();
    initLightbox();
    initConverter();
    initForms();
});
