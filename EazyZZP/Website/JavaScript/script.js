document.addEventListener("DOMContentLoaded", () => {
    const elements = document.getElementsByClassName('typing');
    for (let i = 0; i < elements.length; i++) {
        const toRotate = elements[i].getAttribute('data-type');
        const period = elements[i].getAttribute('data-period');
        if (toRotate) {
            new TypingEffect(elements[i], JSON.parse(toRotate), period);
        }
    }

    // Add CSS for cursor blinking
    const css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typing > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
});

class TypingEffect {
    constructor(element, toRotate, period) {
        this.toRotate = toRotate;
        this.element = element;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    }

    tick() {
        const i = this.loopNum % this.toRotate.length;
        const fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.element.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        let delta = 200 - Math.random() * 100;

        if (this.isDeleting) {
            delta /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(() => this.tick(), delta);
    }
}

function showModal(modal) {
    modal.style.display = "block";
}

function hideModal(modal) {
    modal.style.display = "none";
}

function contentScroll() {
    const elements = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    const visibleThreshold = 150;

    for (const element of elements) {
        const elementTop = element.getBoundingClientRect().top;
        const isVisible = elementTop < windowHeight - visibleThreshold;

        element.classList.toggle("active", isVisible);
    }
}

class TxtType {
    constructor(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.isDeleting = false;
        this.tick();
    }

    tick() {
        const i = this.loopNum % this.toRotate.length;
        const fullTxt = this.toRotate[i];
        const DELTA_BASE = 200;
        const DELTA_RANDOM_FACTOR = 100;

        this.txt = this.isDeleting
            ? fullTxt.substring(0, this.txt.length - 1)
            : fullTxt.substring(0, this.txt.length + 1);

        this.el.innerHTML = `<span class="wrap">${this.txt}</span>`;

        let delta = DELTA_BASE - Math.random() * DELTA_RANDOM_FACTOR;
        if (this.isDeleting) {
            delta /= 2;
        }
        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(() => this.tick(), delta);
    }
}

window.addEventListener("scroll", contentScroll);

window.onload = function () {
    const elements = document.getElementsByClassName('typing');
    for (const element of elements) {
        const toRotate = element.getAttribute('data-type');
        const period = element.getAttribute('data-period');
        if (toRotate) {
            new TxtType(element, JSON.parse(toRotate), period);
        }
    }

    const css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typing > .wrap { border-right: 0.10em solid #000000}";
    document.body.appendChild(css);
}

const modals = {
    html: document.getElementById("modal_html"),
    php: document.getElementById("modal_php"),
    c: document.getElementById("modal_c"),
    javascript: document.getElementById("modal_javascript"),
    css: document.getElementById("modal_css")
};

const modalButtons = {
    html: document.getElementById("modal_open_html"),
    php: document.getElementById("modal_open_php"),
    c: document.getElementById("modal_open_c"),
    javascript: document.getElementById("modal_open_javascript"),
    css: document.getElementById("modal_open_css")
};

for (const [key, button] of Object.entries(modalButtons)) {
    button.onclick = () => showModal(modals[key]);
}

window.onclick = function (event) {
    for (const modal of Object.values(modals)) {
        if (event.target === modal) {
            hideModal(modal);
        }
    }
}