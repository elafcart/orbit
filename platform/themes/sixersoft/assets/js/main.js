/*!
 * Sixersoft — Botble CMS starter theme main script
 * Built with GSAP (bundled as a self-executing IIFE by the Vite build pipeline)
 */

import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches

// Animations can be disabled from Theme Options (data-sx-animations="off")
const animationsEnabled = document.body.dataset.sxAnimations !== 'off' && !prefersReducedMotion

const toNumber = (value, fallback) => {
    const parsed = Number.parseFloat(value)

    return Number.isFinite(parsed) ? parsed : fallback
}

/* ---------------------------------------------------------------------------
 * Scroll reveal — any element with [data-animate] fades/slides into view.
 * Supported: fade-up (default), fade-down, fade-left, fade-right, zoom-in.
 * Options:   data-delay / data-duration (seconds).
 * A container with data-animate="stagger" animates its children in sequence
 * (data-stagger sets the gap, default 0.12s).
 * ------------------------------------------------------------------------- */
const ANIMATION_VARIANTS = {
    'fade-up': { y: 40, opacity: 0 },
    'fade-down': { y: -40, opacity: 0 },
    'fade-left': { x: 60, opacity: 0 },
    'fade-right': { x: -60, opacity: 0 },
    'zoom-in': { scale: 0.92, opacity: 0 },
}

function initScrollReveal() {
    if (!animationsEnabled) {
        return // Elements keep their default visible state
    }

    document.querySelectorAll('[data-animate]').forEach((element) => {
        const type = element.dataset.animate || 'fade-up'

        if (type === 'stagger') {
            const children = Array.from(element.children)
            if (!children.length) return

            gsap.set(children, { opacity: 0, y: 32 })
            gsap.to(children, {
                opacity: 1,
                y: 0,
                duration: toNumber(element.dataset.duration, 0.7),
                delay: toNumber(element.dataset.delay, 0),
                stagger: toNumber(element.dataset.stagger, 0.12),
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: element,
                    start: 'top 88%',
                    once: true,
                },
            })

            return
        }

        const variant = ANIMATION_VARIANTS[type] || ANIMATION_VARIANTS['fade-up']

        gsap.set(element, variant)
        gsap.to(element, {
            x: 0,
            y: 0,
            scale: 1,
            opacity: 1,
            duration: toNumber(element.dataset.duration, 0.8),
            delay: toNumber(element.dataset.delay, 0),
            ease: 'power2.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 88%',
                once: true,
            },
        })
    })
}

/* ---------------------------------------------------------------------------
 * Counters — [data-counter] numbers count up when scrolled into view.
 * data-counter-suffix appends a static suffix (e.g. "+" or "%").
 * ------------------------------------------------------------------------- */
function initCounters() {
    document.querySelectorAll('[data-counter]').forEach((element) => {
        const target = toNumber(element.dataset.counter, 0)
        const suffix = element.dataset.counterSuffix || ''

        if (!animationsEnabled) {
            element.textContent = `${target}${suffix}`

            return
        }

        const state = { value: 0 }
        gsap.to(state, {
            value: target,
            duration: toNumber(element.dataset.duration, 1.6),
            ease: 'power1.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 90%',
                once: true,
            },
            onUpdate() {
                element.textContent = `${Math.round(state.value)}${suffix}`
            },
        })
    })
}

/* ---------------------------------------------------------------------------
 * Sticky header state
 * ------------------------------------------------------------------------- */
function initHeader() {
    const header = document.querySelector('.site-header')
    if (!header) return

    const update = () => header.classList.toggle('is-scrolled', window.scrollY > 10)

    update()
    window.addEventListener('scroll', update, { passive: true })
}

/* ---------------------------------------------------------------------------
 * Mobile navigation panel
 * ------------------------------------------------------------------------- */
function initMobileMenu() {
    const toggle = document.getElementById('mobile-menu-toggle')
    const panel = document.getElementById('mobile-menu')
    if (!toggle || !panel) return

    toggle.addEventListener('click', () => {
        const isOpen = !panel.classList.contains('hidden')

        panel.classList.toggle('hidden', isOpen)
        toggle.setAttribute('aria-expanded', String(!isOpen))
        document.body.classList.toggle('overflow-hidden', !isOpen)
    })

    // Close the panel when a link inside it is clicked
    panel.addEventListener('click', (event) => {
        if (event.target.closest('a')) {
            panel.classList.add('hidden')
            toggle.setAttribute('aria-expanded', 'false')
            document.body.classList.remove('overflow-hidden')
        }
    })
}

/* ---------------------------------------------------------------------------
 * Dark mode toggle — `.dark` class on <html>, persisted in localStorage.
 * The pre-paint script in layouts/base.blade.php reads the same key.
 * ------------------------------------------------------------------------- */
const THEME_STORAGE_KEY = 'sixersoft-theme'

function initDarkModeToggle() {
    document.querySelectorAll('[data-dark-mode-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark')
            localStorage.setItem(THEME_STORAGE_KEY, isDark ? 'dark' : 'light')
        })
    })
}

/* ---------------------------------------------------------------------------
 * Category filter chips — [data-sx-filter] button group shows/hides
 * [data-sx-filter-item] cards (used by the services shortcode).
 * Pure DOM class toggling: zero layout libraries, instant on mobile.
 * ------------------------------------------------------------------------- */
const FILTER_ACTIVE =
    'sx-filter-btn rounded-full bg-brand-600 px-4 py-2 text-xs font-semibold text-white transition'
const FILTER_INACTIVE =
    'sx-filter-btn rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300'

function initFilters() {
    document.querySelectorAll('[data-sx-filter]').forEach((bar) => {
        const buttons = Array.from(bar.querySelectorAll('[data-filter]'))
        const grid = bar.parentElement?.querySelector('[data-sx-filter-item]')?.parentElement

        if (!grid) return

        const items = Array.from(grid.querySelectorAll('[data-sx-filter-item]'))

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const key = button.dataset.filter

                buttons.forEach((b) => {
                    b.className = b === button ? FILTER_ACTIVE : FILTER_INACTIVE
                })

                items.forEach((item) => {
                    item.classList.toggle('hidden', key !== 'all' && item.dataset.sxFilterItem !== key)
                })
            })
        })
    })
}

/* ---------------------------------------------------------------------------
 * Lightweight tabs — [data-sx-tab] buttons switch .sx-tab-panel sections
 * (used on the ecommerce product page instead of Bootstrap tabs).
 * ------------------------------------------------------------------------- */
function initTabs() {
    document.querySelectorAll('[data-sx-tab]').forEach((button) => {
        button.addEventListener('click', () => {
            const target = document.querySelector(button.dataset.sxTab)
            if (!target) return

            const group = button.closest('[role="tablist"]') || button.parentElement

            group.querySelectorAll('[data-sx-tab]').forEach((tab) => {
                tab.setAttribute('aria-selected', 'false')
                tab.classList.remove('border-brand-600', 'text-brand-600', 'dark:text-brand-400')
                tab.classList.add('border-transparent', 'text-slate-500', 'dark:text-slate-400')
            })

            button.setAttribute('aria-selected', 'true')
            button.classList.add('border-brand-600', 'text-brand-600', 'dark:text-brand-400')
            button.classList.remove('border-transparent', 'text-slate-500', 'dark:text-slate-400')

            document.querySelectorAll('.sx-tab-panel').forEach((panel) => panel.classList.add('hidden'))
            target.classList.remove('hidden')
        })
    })
}

/* ---------------------------------------------------------------------------
 * Scroll-to-top button
 * ------------------------------------------------------------------------- */
function initScrollTop() {
    const button = document.getElementById('scroll-top-button')
    if (!button) return

    const update = () => {
        button.classList.toggle('opacity-0', window.scrollY < 600)
        button.classList.toggle('pointer-events-none', window.scrollY < 600)
    }

    update()
    window.addEventListener('scroll', update, { passive: true })

    button.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: prefersReducedMotion ? 'auto' : 'smooth',
        })
    })
}

/* ---------------------------------------------------------------------------
 * Boot
 * ------------------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal()
    initCounters()
    initHeader()
    initMobileMenu()
    initDarkModeToggle()
    initFilters()
    initTabs()
    initScrollTop()

    // Recalculate trigger positions once fonts/images settle
    window.addEventListener('load', () => ScrollTrigger.refresh())
})
