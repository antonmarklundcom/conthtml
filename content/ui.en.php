<?php
/**
 * English UI strings (plan §6.8.1, C5). Same top-level keys as content/ui.php,
 * so ui() never has to fall back to its $default when UI_LANG is 'en' — see
 * lib/helpers.php's ui() for the switch. Only the /en/ section (plan §6.8) and
 * the English-only partials it introduces (partials/header-en.php,
 * partials/footer-en.php, partials/lead-form-en.php) ever read this file: the
 * Spanish site never sets UI_LANG, so it never touches this array.
 *
 * Sections that only ever render on the Spanish site (home, panel, about,
 * industries, testimonials, services_hub, segment, tools, guide, needs,
 * placeholder, error404) are translated too, for parity and so a future page
 * that reuses one of those shared partials in English does not silently fall
 * back to Spanish — but nothing in this phase exercises them.
 */

declare(strict_types=1);

return [

    'clusters' => [
        'digital'   => 'Digital compliance',
        'gestion'   => 'Business management',
        'auditoria' => 'Audit',
    ],

    'cluster_leads' => [
        'digital'   => 'Everything the DNIT requires online: electronic invoicing on SIFEN, '
                     . 'your Marangatu account and RUC registration.',
        'gestion'   => 'The monthly and annual operation of your company: bookkeeping, VAT, '
                     . 'income tax, payroll and social security, incorporation and tax advisory.',
        'auditoria' => 'Reports with professional backing for banks, partners and regulators, '
                     . 'and investigations when something needs to be proven.',
    ],

    'nav' => [
        'home'        => 'Home',
        'services'    => 'Services',
        'pricing'     => 'Pricing',
        'tools'       => 'Tools',
        'guides'      => 'Guides',
        'about'       => 'About us',
        'blog'        => 'Blog',
        'contact'     => 'Contact',
        'privacy'     => 'Privacy',
        'terms'       => 'Terms',
        'menu'        => 'Menu',
        'close'       => 'Close',
        'open_menu'   => 'Open menu',
        'close_menu'  => 'Close menu',
        'skip'        => 'Skip to main content',
        'firm'        => 'Firm',
        'all_services' => 'See all services',
    ],

    'cta' => [
        'quote'        => 'Request a quote',
        'whatsapp'     => 'WhatsApp',
        'whatsapp_long' => 'Message us on WhatsApp',
        'consult'      => 'Request a free consultation',
        'contact'      => 'Contact us',
        'see_included' => 'See what is included',
        'talk'         => 'Talk to an accountant',
    ],

    'whatsapp' => [
        'menu_title'   => 'What would you like to write to us about?',
        'menu_note'    => 'We open WhatsApp with the message already written. You can change it before sending.',
        'other'        => 'Something else',
        'this_page'    => 'What you are looking at',
        'open_menu'    => 'Open WhatsApp options',
        'close_menu'   => 'Close',
    ],

    'home' => [
        'eyebrow' => 'We are taking on new companies this month',
        'h1_lead'   => 'Accounting firm in Asunción: taxes, bookkeeping and payroll ',
        'h1_accent' => 'without missing a deadline.',
        'lead'    => 'Licensed accountants who keep your books, file VAT and income tax, run '
                   . 'payroll and get you set up on SIFEN. One point of contact.',

        'services_eyebrow' => 'Services',
        'services_title'   => 'Six services. One accountable team.',
        'services_lead'    => 'Hire what you need today and add services as your company grows. '
                            . 'All under the same monthly fee.',

        'cards' => [
            [
                'title' => 'Monthly bookkeeping',
                'text'  => 'Purchase and sales ledgers, reconciliations and financial statements. '
                         . 'Closed before day 5, with a report in plain language.',
                'path'  => '/contabilidad/',
                'links' => [],
            ],
            [
                'title' => 'Taxes: VAT and corporate income tax',
                'text'  => 'Monthly VAT filing and the annual corporate income tax return (F.120) '
                         . 'on Marangatu, deadline tracking and responses to the DNIT.',
                'path'  => '/iva/',
                'links' => [],
            ],
            [
                'title' => 'Payroll',
                'text'  => 'Salaries, thirteenth-month bonus, vacation pay, IPS and MTESS filings, '
                         . 'hires and terminations. Payslips ready to sign every month.',
                'path'  => '/ips/',
                'links' => [],
            ],
            [
                'title' => 'Company formation and tax ID',
                'text'  => 'E.A.S., S.R.L. or S.A. incorporation, RUC registration, municipal '
                         . 'license and employer registration, with every step followed up.',
                'path'  => '/eas/',
                'links' => [],
            ],
            [
                'title' => 'Electronic invoicing',
                'text'  => "Enrollment on SIFEN and Ekuatia'i go-live. Issue valid electronic "
                         . 'invoices from day one.',
                'path'  => '/ekuatia/',
                'links' => [],
            ],
            [
                'title' => 'Audit',
                'text'  => 'Tax, internal and forensic audit, with reports that hold up to a '
                         . 'bank, a partner or a regulator.',
                'path'  => '/auditoria/',
                'links' => [],
            ],
        ],

        'unsure_title' => 'Not sure what you need?',
        'unsure_text'  => 'Tell us about your situation and we will tell you what applies, at no cost.',
    ],

    'panel' => [
        'title' => 'Your monthly close, at a glance',
        'badge' => 'Up to date',
        'tiles' => [
            ['label' => 'Monthly VAT',            'value' => 'Filed'],
            ['label' => 'Payroll and IPS',        'value' => 'Processed'],
            ['label' => 'Purchase/sales ledger',  'value' => 'Reconciled'],
        ],
        'foot'  => 'Next deadline: corporate income tax · F.120',
        'note'  => 'Example of the monthly report',
    ],

    'about' => [
        'eyebrow' => 'About us',
        'title'   => 'Real accountants, with digital processes a traditional firm does not have.',
        'text'    => 'We are licensed public accountants. We handle bookkeeping, taxes and '
                   . 'payroll for trading, service, construction and import companies, with a '
                   . 'digital process where every voucher is entered once: fewer data-entry '
                   . 'errors, closings in days, and your information available when you ask for it.',
        'credentials' => [
            'Licensed public accountants',
            'One accountant assigned to your company, not a front desk',
            'Every voucher entered once, no double data entry',
            'Fixed monthly fee, with the scope agreed in writing',
        ],
        'badge_note'     => 'in professional practice',
        'badge_fallback' => 'Licensed public accountants',
        'link'           => 'Meet the team',
    ],

    'process' => [
        'eyebrow' => 'How we work',
        'title'   => 'From the first conversation to the first closing, with agreed dates.',
        'steps'   => [
            [
                'title' => 'Initial conversation',
                'text'  => 'Half an hour to understand your business, your volume and your '
                         . 'current standing with the DNIT and the IPS.',
            ],
            [
                'title' => 'Written proposal',
                'text'  => 'Detailed scope and a fixed monthly fee, with what is included and '
                         . 'what is not. No fine print.',
            ],
            [
                'title' => 'Handover',
                'text'  => 'We receive your records, regularise anything pending and load your '
                         . 'history before the first closing.',
            ],
            [
                'title' => 'Monthly closing',
                'text'  => 'One assigned accountant, closing before day 5 and a monthly report '
                         . 'in plain language.',
            ],
        ],
    ],

    'industries' => [
        'eyebrow' => 'Industries',
        'title'   => 'Industries we serve',
        'lead'    => 'Every industry has its own tax traps. These are the ones we work with every month.',
        'items'   => [
            ['label' => 'Trading companies',            'path' => '/contador-para/comercios/'],
            ['label' => 'Importers',                     'path' => '/contador-para/importadores/'],
            ['label' => 'Construction',                  'path' => '/contador-para/construccion/'],
            ['label' => 'Restaurants and hospitality',   'path' => '/contador-para/gastronomia/'],
            ['label' => 'Independent professionals',     'path' => '/contador-para/profesionales-independientes/'],
            ['label' => 'Sole proprietors',               'path' => '/contador-para/unipersonales/'],
            ['label' => 'Startups',                       'path' => '/contador-para/emprendedores/'],
            ['label' => 'Foreign-owned companies',        'path' => '/contador-para/empresas-extranjeras/'],
        ],
    ],

    'testimonials' => [
        'eyebrow' => 'Cases',
        'title'   => 'What the companies we work with say',
    ],

    'services_hub' => [
        'eyebrow' => 'Services',
        'title'   => 'Accounting services in Paraguay, from formation to the annual closing.',
        'lead'    => 'Hire what you need today and add services as your company grows.',
        'unsure_title' => 'Not sure what you need?',
        'unsure_text'  => 'Answer 4 questions and we will tell you which services apply, with a direct link to each.',
        'unsure_cta'   => 'Take the test',
    ],

    'cta_band' => [
        'eyebrow' => 'Request a consultation',
        'title'   => "Let's start with a 30-minute conversation.",
        'lead'    => 'No cost, no obligation. We reply with a concrete proposal.',
    ],

    'form' => [
        'legend'        => 'Request a consultation',
        'name'          => 'Name',
        'company'       => 'Company / industry',
        'phone'         => 'WhatsApp or phone',
        'phone_hint'    => 'e.g. +1 555 123 4567',
        'email'         => 'Email',
        'need'          => 'What do you need?',
        'message'       => 'Tell us briefly',
        'message_hint'  => 'Country of origin, planned activity, current status with the DNIT…',
        'submit'        => 'Request a free consultation',
        'sending'       => 'Sending…',
        'privacy_note'  => 'We use your data only to reply to you. See the privacy policy.',
        'success_title' => 'We received your enquiry.',
        'success_text'  => 'We reply within the next business day. If you prefer, write to us now.',
        'error_title'   => "We couldn't send the form.",
        'error_text'    => 'Please try again in a moment, or contact us directly.',
        'error_phone'   => 'We need a valid phone or WhatsApp number to reply to you.',
        'required'      => 'required',
        'thanks_next'     => 'What happens next',
        'thanks_whatsapp' => "If you'd rather not wait, message us now on WhatsApp.",
        'remind_title'  => 'Have us remind you before each deadline',
        'remind_text'   => 'We note your RUC ending digit and message you on WhatsApp a few days ahead.',
        'remind_phone'  => 'Your WhatsApp number',
        'remind_submit' => 'Remind me',
        'remind_ok'     => "Noted. We'll message you before the next deadline.",
    ],

    'needs' => [
        'contabilidad' => 'Bookkeeping and taxes',
        'apertura'     => 'Open a company',
        'nomina'       => 'Payroll',
        'sifen'        => 'SIFEN',
        'cambio'       => 'Switch accountants',
        'otro'         => 'Other',
    ],

    'contact' => [
        'eyebrow' => 'Contact',
        'title'   => "Let's talk about your company.",
        'lead'    => 'Message us on WhatsApp or leave your details and we reply within the next business day.',
        'address' => 'Address',
        'hours'   => 'Hours',
        'phone'   => 'Phone',
        'email'   => 'Email',
        'expect'  => 'What happens next',
        'steps'   => [
            'We reply within the next business day.',
            'We schedule a 30-minute call, at no cost and no obligation.',
            'You receive a written proposal with the scope and the monthly fee.',
        ],
    ],

    'service' => [
        'includes'  => 'What is included',
        'excludes'  => 'What is not included',
        'we_need'   => 'What we need from you',
        'benefits'  => 'Benefits',
        'faq'       => 'Frequently asked questions',
        'related'   => 'Related services',
        'guides'    => 'Related guide',
        'form_eyebrow' => 'Quote',
        'form_lead'    => 'Leave your details and we reply with a concrete proposal, at no cost and no obligation.',
        'breadcrumb' => 'Breadcrumb',
    ],

    'segment' => [
        'traps_title'  => 'The mistakes that cost you the most in your industry',
        'bundle_title' => 'What we put together for your industry',
        'form_eyebrow' => 'Quote for your industry',
        'form_lead'    => 'Tell us about your industry and volume; we reply with a concrete proposal, '
                        . 'at no cost and no obligation.',
    ],

    'tools' => [
        'reviewed_prefix' => 'Legal data reviewed on',
        'orientativo'     => 'Results are indicative and do not replace an official settlement.',
        'calculate'       => 'Calculate',
        'result_title'    => 'Result',
        'use_result'      => 'Use this result in the form',
        'need_js'         => 'This calculator needs JavaScript enabled in your browser.',
        'restart'         => 'Start over',
    ],

    'guide' => [
        'reviewed_prefix'       => 'Reviewed on',
        'orientativo'           => 'This is a general guide: confirm your specific case with us.',
        'delegate_eyebrow'      => 'Delegate it',
        'delegate_title'        => 'Would you rather we handled it?',
        'delegate_lead'         => 'We reply within the next business day with the exact steps for your case.',
        'delegate_form_heading' => 'Ask us to take it over',
        'related'               => 'Other guides',
    ],

    'placeholder' => [
        'notice' => 'This page is being prepared.',
        'action' => 'In the meantime, write to us and we will reply on WhatsApp.',
    ],

    'error404' => [
        'title' => 'We could not find this page',
        'lead'  => 'The link may have changed. Here are the most requested sections.',
    ],

    'footer' => [
        'blurb'   => 'Accounting firm in Asunción, Paraguay. English-speaking support for foreign '
                   . 'founders opening and running a company here.',
        'rights'  => 'All rights reserved.',
        'contact' => 'Contact',
    ],
];
