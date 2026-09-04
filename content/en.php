<?php
/**
 * The /en/ section (plan §6.8, C5): a hub plus five pages in English for
 * foreign founders opening a company in Paraguay. Rendered by
 * templates/en-page.php, the same route-file discipline as
 * templates/guide.php and templates/segment.php — every /en/<slug>/index.php
 * is three lines.
 *
 * Every stated figure is either already whitelisted in docs/facts-to-verify.md
 * (the VAT 10%/5% split, the Resimple/IRE Simple annual thresholds, the SUACE/
 * EAS mechanics) or explicitly hedged the same way /irp/ hedges IRP brackets —
 * no new rate or peso amount is introduced by this phase. See the C5 section
 * of docs/facts-to-verify.md.
 *
 * Record shape:
 *
 *   path             string   '/en/' or '/en/<slug>/'
 *   navLabel         string   short label; used by content/nav.php's
 *                             hub link list
 *   seoTitle         string   <title> without the site suffix, <= 41 chars
 *   metaDescription  string   120-155 chars, unique site-wide
 *   hero             array    eyebrow, h1, lead
 *   hreflangEs       string   the Spanish counterpart path (plan §6.8.1)
 *   kind             string   'hub' (the /en/ index) or 'page'
 *   sections         array    [['h2' => ..., 'body' => [paragraph, ...]], ...]
 *   highlights       array    optional short bullet list under the hero
 *   faq              array    [['q' => ..., 'a' => ...], ...]
 */

declare(strict_types=1);

return [

    'home' => [
        'path'            => '/en/',
        'navLabel'        => 'Home',
        'seoTitle'        => 'Open a Company in Paraguay | English',
        'metaDescription' => 'English-language accounting guidance for foreign founders opening and '
                           . 'running a company in Paraguay: entity choice, taxes, RUC and ongoing bookkeeping.',
        'hero' => [
            'eyebrow' => 'For foreign founders',
            'h1'      => 'Open and run a company in Paraguay, in English',
            'lead'    => 'We are a Paraguayan accounting firm that works in English with founders based '
                       . 'outside the country: company formation, tax registration, monthly bookkeeping '
                       . 'and ongoing compliance, explained in plain language and handled end to end.',
        ],
        'heroImage' => [
            'src' => '/assets/img/extranjero-expatriado-trabajo-remoto-paraguay-1280.avif',
            'alt' => 'Foreigner working remotely in a bright café in Asunción, Paraguay',
        ],
        'hreflangEs' => '/contador-para/empresas-extranjeras/',
        'kind'       => 'hub',
        'sections'   => [],
        'highlights' => [
            'No need to be a resident to own 100% of a Paraguayan company.',
            'We work by WhatsApp and email across time zones — no need to be in Asunción.',
            'One point of contact for formation, taxes, payroll and ongoing bookkeeping.',
        ],
        'faq' => [],
    ],

    'open-a-company-in-paraguay' => [
        'path'            => '/en/open-a-company-in-paraguay/',
        'navLabel'        => 'Open a company',
        'seoTitle'        => 'Open a Company in Paraguay: How-To Guide',
        'metaDescription' => 'How a foreign founder opens a company in Paraguay: entity types, the SUACE '
                           . 'process, RUC registration, and what documents you need before you start.',
        'hero' => [
            'eyebrow' => 'Company formation',
            'h1'      => 'Opening a company in Paraguay as a foreign founder',
            'lead'    => 'Paraguay lets a non-resident own a company outright. The process has a few more '
                       . 'steps than for a resident — mainly around your legal representative and your '
                       . 'documentation — but it does not require you to relocate.',
        ],
        'hreflangEs' => '/contador-para/empresas-extranjeras/',
        'kind'       => 'page',
        'sections'   => [
            [
                'h2'   => 'Entity types: EAS, SRL and SA',
                'body' => [
                    "The EAS (Empresa por Acciones Simplificada) is the entity most foreign founders use: it "
                        . 'allows a single shareholder of any nationality, is opened through SUACE (the '
                        . 'government\'s unified formation system) rather than a notarial deed, and has no '
                        . 'legal minimum capital.',
                    'An SRL (limited liability company) needs at least two partners and is the traditional '
                        . 'route when there is more than one founder. An SA (corporation) suits a larger or '
                        . 'more formal ownership structure, with a heavier setup. For a single founder or a '
                        . 'small founding team, the EAS is usually the fastest and simplest.',
                ],
            ],
            [
                'h2'   => 'What a foreign founder needs that a resident does not',
                'body' => [
                    'A company with a non-resident shareholder needs a legal representative domiciled in '
                        . 'Paraguay to handle filings with the DNIT (the tax authority) — this can be an '
                        . 'accountant, a lawyer or a local partner, and does not need to be an owner of the company.',
                    'Foreign shareholders typically need identification documents apostilled or legalised '
                        . 'through the Paraguayan consulate in their country, plus, for a corporate '
                        . 'shareholder, the parent company\'s incorporation documents translated and legalised '
                        . 'the same way. Incomplete consular documentation is the single most common reason a '
                        . 'foreign-owned formation takes longer than expected.',
                ],
            ],
            [
                'h2'   => 'RUC registration and what comes right after',
                'body' => [
                    'Once the company is formed, it registers a RUC (tax ID) with the DNIT — this is what lets '
                        . 'it invoice, open a bank account and hire. A completed application is typically '
                        . 'processed in a matter of business days, though we always confirm current processing '
                        . 'times with you rather than quote a fixed promise.',
                    'From the month of registration, the company has monthly and annual filing obligations — '
                        . 'VAT if it sells locally, an annual corporate income tax return, and payroll '
                        . 'registration once it hires anyone. Most foreign founders set up monthly bookkeeping '
                        . 'from day one rather than waiting for the first filing deadline to arrive.',
                ],
            ],
        ],
        'highlights' => [],
        'faq' => [
            [
                'q' => 'Can a foreigner own 100% of a company in Paraguay?',
                'a' => 'Yes. An EAS allows a single shareholder of any nationality with no local co-owner '
                     . 'required. It does need a legal representative domiciled in Paraguay for filings with '
                     . 'the DNIT — that role does not need to be a shareholder.',
            ],
            [
                'q' => 'Do I need to travel to Paraguay to open the company?',
                'a' => 'Often not, if your documentation is in order and a local legal representative is in '
                     . 'place; the exact requirement depends on how the founding documents are structured. '
                     . 'We confirm what your specific case needs before you start, rather than assume.',
            ],
            [
                'q' => 'How long does formation and RUC registration take?',
                'a' => 'It depends mainly on how quickly your consular documentation comes through, since that '
                     . 'is usually the longest step. Once your documents are complete, the formation and RUC '
                     . 'steps themselves are comparatively fast — we give you a specific timeline once we see '
                     . 'your case.',
            ],
        ],
    ],

    'eas-vs-srl-paraguay' => [
        'path'            => '/en/eas-vs-srl-paraguay/',
        'navLabel'        => 'EAS vs SRL',
        'seoTitle'        => 'EAS vs SRL in Paraguay: Which to Choose',
        'metaDescription' => 'EAS vs SRL in Paraguay compared for foreign founders: ownership, minimum '
                           . 'partners, setup process and which structure fits a single founder or a team.',
        'hero' => [
            'eyebrow' => 'Comparing entities',
            'h1'      => 'EAS vs SRL in Paraguay: which one fits your company',
            'lead'    => 'The two most common structures for a new Paraguayan company are the EAS and the '
                       . 'SRL. Neither is "better" in the abstract — the right one depends on how many '
                       . 'founders you have and how you plan to bring in investors later.',
        ],
        'hreflangEs' => '/herramientas/comparador-eas-srl-unipersonal/',
        'kind'       => 'page',
        'sections'   => [
            [
                'h2'   => 'EAS (Empresa por Acciones Simplificada)',
                'body' => [
                    'A single shareholder can own an EAS outright — the structure most foreign solo founders '
                        . 'use. It is formed through SUACE, the government\'s unified formation system, '
                        . 'without a notarial deed, and there is no legal minimum capital requirement.',
                    'It suits a founder who wants to move quickly, keep full ownership, and add shares or '
                        . 'partners later without restructuring the entity itself.',
                ],
            ],
            [
                'h2'   => 'SRL (Sociedad de Responsabilidad Limitada)',
                'body' => [
                    'An SRL needs at least two partners from the outset — it is not available to a solo '
                        . 'founder. Like the EAS it has no legal minimum capital, but its formation and '
                        . 'internal governance follow the more traditional company-law route rather than SUACE.',
                    'It fits a founding team of two or more who want a familiar, well-understood corporate '
                        . 'form from day one, particularly when a local partner is already involved.',
                ],
            ],
            [
                'h2'   => 'What actually decides it',
                'body' => [
                    'If you are a single founder: the EAS is almost always the simpler and faster choice. If '
                        . 'you already have a co-founder or a local partner: an SRL is a reasonable default, '
                        . 'though an EAS with more than one shareholder is also possible.',
                    'Either structure can be reorganised later as the company grows — the choice at formation '
                        . 'is about what gets you trading fastest with the least friction, not a permanent '
                        . 'commitment.',
                ],
            ],
        ],
        'highlights' => [],
        'faq' => [
            [
                'q' => 'Can I switch from an EAS to an SRL later?',
                'a' => 'Reorganising the legal structure is possible but is its own process — most founders '
                     . 'start with the structure that fits today\'s ownership and revisit it only when a real '
                     . 'trigger (a new investor, a new partner) makes it necessary.',
            ],
            [
                'q' => 'Is there a minimum capital for an EAS or an SRL?',
                'a' => 'Neither has a legal minimum capital requirement. In practice the amount you register '
                     . 'should reasonably reflect the business you intend to run.',
            ],
            [
                'q' => 'Which one is faster to set up?',
                'a' => 'The EAS is generally faster, since it is formed through SUACE without a notarial deed. '
                     . 'An SRL\'s formation timeline depends more on how quickly its partners can align on the '
                     . 'founding documents.',
            ],
        ],
    ],

    'taxes-in-paraguay-for-foreigners' => [
        'path'            => '/en/taxes-in-paraguay-for-foreigners/',
        'navLabel'        => 'Taxes',
        'seoTitle'        => 'Taxes in Paraguay for Foreign Founders',
        'metaDescription' => 'Taxes in Paraguay for foreign founders explained: corporate income tax (IRE), '
                           . 'VAT (IVA), personal income tax (IRP) and how tax residency is determined.',
        'hero' => [
            'eyebrow' => 'Tax basics',
            'h1'      => 'Taxes in Paraguay for foreign founders',
            'lead'    => 'Paraguay taxes on a territorial basis: income sourced within the country is taxed '
                       . 'here, largely independent of where the owner lives. Here is how that plays out '
                       . 'across the three taxes a new company usually meets first.',
        ],
        'hreflangEs' => '/irp/',
        'kind'       => 'page',
        'sections'   => [
            [
                'h2'   => 'IRE — corporate income tax',
                'body' => [
                    'A company\'s annual profit is taxed under one of three regimes depending on its annual '
                        . 'turnover: Resimple (a fixed monthly instalment, for turnover up to Gs. 80,000,000 '
                        . 'a year), IRE Simple (tax on real profit, up to Gs. 2,000,000,000 a year) or IRE '
                        . 'General (full accounting, above that threshold or where required by structure). '
                        . 'These thresholds are set by regulation and can change, so we confirm the current '
                        . 'figures with you before registering your company into a regime.',
                    'The annual return is filed on Formulario 120 through Marangatu, the DNIT\'s online '
                        . 'system, in the first months of the year following the close of the fiscal year. We '
                        . 'do not state the current tax rate here — ask us for the figure that applies to your '
                        . 'regime, since it is set by regulation.',
                ],
            ],
            [
                'h2'   => 'IVA — value-added tax',
                'body' => [
                    'Most goods and services carry a 10% general VAT rate; a reduced 5% rate applies to a '
                        . 'limited list of items — mainly basic foodstuffs and certain real-estate and '
                        . 'financial transactions. VAT is filed monthly, and the current list of items under '
                        . 'the reduced rate is confirmed with the DNIT since it can change by regulation.',
                    'A company that only sells outside Paraguay, or that has no local sales yet, still files a '
                        . 'monthly return — a zero-movement period must still be declared, not skipped.',
                ],
            ],
            [
                'h2'   => 'IRP — personal income tax and residency',
                'body' => [
                    'IRP applies to an individual\'s income, added up across sources — salary, professional '
                        . 'fees, rental income. The current threshold and deduction limits are set by '
                        . 'regulation and can change, so we confirm the current amount on request rather than '
                        . 'state a figure here that may already be out of date.',
                    'Paraguay determines individual tax residency mainly by how much time you spend physically '
                        . 'in the country and by where your main economic activity is based, rather than by '
                        . 'citizenship or company ownership alone. The exact criteria are set by regulation — '
                        . 'we review your specific situation with you rather than assume a residency status.',
                ],
            ],
        ],
        'highlights' => [],
        'faq' => [
            [
                'q' => 'Do I owe personal tax in Paraguay if I do not live there?',
                'a' => 'Owning a Paraguayan company does not by itself make you a Paraguay tax resident. '
                     . 'Individual residency depends on time spent in the country and where your economic '
                     . 'activity is centred — we review your specific situation rather than assume.',
            ],
            [
                'q' => 'What is the VAT rate in Paraguay?',
                'a' => 'A general rate of 10% applies to most goods and services; a reduced 5% rate applies to '
                     . 'a limited list of items, mainly basic foodstuffs and certain real-estate and financial '
                     . 'operations. We confirm the current list with the DNIT since it can change.',
            ],
            [
                'q' => 'Does my company have to file taxes even with no sales yet?',
                'a' => 'Yes — a zero-movement VAT period is still a required filing, not an optional one. '
                     . 'Missing it can trigger a fine even when no tax is actually owed.',
            ],
        ],
    ],

    'accounting-services-paraguay' => [
        'path'            => '/en/accounting-services-paraguay/',
        'navLabel'        => 'Services',
        'seoTitle'        => 'Accounting Services in Paraguay | English',
        'metaDescription' => 'English-language accounting services in Paraguay for foreign-owned companies: '
                           . 'monthly bookkeeping, tax filings, payroll and electronic invoicing, one team.',
        'hero' => [
            'eyebrow' => 'What we do',
            'h1'      => 'Accounting services in Paraguay for foreign-owned companies',
            'lead'    => 'Once your company is formed, it needs someone keeping the books, filing on time '
                       . 'and answering the DNIT when it asks a question. That is what we do, every month, '
                       . 'for companies whose owners are outside Paraguay.',
        ],
        'hreflangEs' => '/contabilidad/',
        'kind'       => 'page',
        'sections'   => [
            [
                'h2'   => 'Monthly bookkeeping',
                'body' => [
                    'Purchase and sales ledgers, bank reconciliations and financial statements, closed before '
                        . 'the fifth of the following month, with a report you can actually read — not a raw '
                        . 'export of ledger entries.',
                ],
            ],
            [
                'h2'   => 'Tax filings: VAT and corporate income tax',
                'body' => [
                    'Monthly VAT returns and the annual corporate income tax return (Formulario 120) on '
                        . 'Marangatu, tracked so a deadline never depends on you remembering it.',
                ],
            ],
            [
                'h2'   => 'Electronic invoicing (SIFEN)',
                'body' => [
                    "Enrollment on SIFEN and Ekuatia'i go-live, so your company issues valid electronic "
                        . 'invoices from day one — required for any company selling in Paraguay.',
                ],
            ],
            [
                'h2'   => 'Payroll, once you hire',
                'body' => [
                    'Salaries, the thirteenth-month bonus, vacation pay and the IPS (social security) filings '
                        . 'from your first local hire, with payslips ready to sign every month.',
                ],
            ],
        ],
        'highlights' => [],
        'faq' => [
            [
                'q' => 'Can you work with us entirely remotely?',
                'a' => 'Yes — most of our foreign-owned clients never visit Paraguay in person. We work by '
                     . 'WhatsApp and email, across time zones, and only need physical documents when a '
                     . 'specific filing legally requires them.',
            ],
            [
                'q' => 'Do you offer a fixed monthly fee?',
                'a' => 'Yes, agreed in writing before we start, based on your company\'s actual scope — you '
                     . 'know the cost before you commit, and it does not change without your agreement.',
            ],
            [
                'q' => 'What do you need from us to start?',
                'a' => 'Your RUC and incorporation documents, access to your Marangatu account (or we help '
                     . 'you set it up), and a short conversation about your business so we can confirm the '
                     . 'right tax regime for you.',
            ],
        ],
    ],

    'contact' => [
        'path'            => '/en/contact/',
        'navLabel'        => 'Contact',
        'seoTitle'        => 'Contact Us | English-Speaking Accountants',
        'metaDescription' => 'Contact our English-speaking accounting team in Paraguay: company formation, '
                           . 'taxes and bookkeeping for foreign founders. We reply within one business day.',
        'hero' => [
            'eyebrow' => 'Contact',
            'h1'      => "Let's talk about your company in Paraguay",
            'lead'    => 'Tell us where you are starting from — an idea, a company already formed, or a '
                       . 'business you are relocating — and we reply within the next business day with the '
                       . 'concrete next step.',
        ],
        'hreflangEs' => '/contacto/',
        'kind'       => 'page',
        'sections'   => [],
        'highlights' => [],
        'faq' => [],
    ],
];
