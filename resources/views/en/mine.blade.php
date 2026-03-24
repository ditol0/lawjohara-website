@extends('layout.main-shell-en', [
    'title' => 'Al Jawhara Law Firm and Legal Consultancy',
    'description' => 'Al Jawhara Law Firm and Legal Consultancy provides integrated legal services in Saudi Arabia, including commercial disputes, personal status matters, arbitration, and legal advisory services.',
    'page' => 'home',
    'bodyClass' => 'home-page',
])

@section('content')
    <header class="hero-section" id="home">
        <div class="container hero-section__grid">
            <section class="hero-copy reveal" aria-labelledby="heroTitle">
                <span class="eyebrow">Precise legal solutions built on trust and results</span>
                <h1 id="heroTitle">
                    <span>Al Jawhara Law Firm and Legal Consultancy</span><br>
                    <span>and Real Estate Title Documentation</span>
                </h1>
                <p>
                    We represent individuals and businesses before judicial and regulatory authorities, and provide
                    legal advice and clear contract drafting that protects rights, reduces risk, and supports confident decisions.
                </p>
                <ul class="hero-highlights" aria-label="Key advantages of working with us">
                    <li><i class="fas fa-check-circle"></i><span>Clear initial legal assessment</span></li>
                    <li><i class="fas fa-comments"></i><span>Direct communication in clear and structured language</span></li>
                    <li><i class="fas fa-folder-open"></i><span>Accurate follow-up on documents and procedures</span></li>
                </ul>
                <div class="hero-actions">
                    <a href="#contact" class="button button--primary">Book an Initial Consultation</a>
                    <a href="#services" class="button button--ghost">Explore Services</a>
                </div>
                <div class="hero-trust" aria-label="Quick links and trust indicators">
                    <a href="tel:+966533734013" class="hero-trust__item">
                        <i class="fas fa-phone-volume"></i>
                        <span>Direct Call</span>
                    </a>
                    <a href="https://wa.me/966533734013" class="hero-trust__item" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i>
                        <span>Quick WhatsApp</span>
                    </a>
                    <div class="hero-trust__item hero-trust__item--static">
                        <i class="fas fa-shield-alt"></i>
                        <span>High Privacy and Professionalism</span>
                    </div>
                </div>
                <ul class="hero-stats" aria-label="Firm statistics">
                    <li><strong class="counter" data-target="120">0</strong><span>Cases and Consultations</span></li>
                    <li><strong class="counter" data-target="10">0</strong><span>Legal Practice Areas</span></li>
                    <li><strong class="counter" data-target="4">0</strong><span>Major Coverage Cities</span></li>
                </ul>
            </section>

            <aside class="hero-panel reveal" aria-label="Quick overview of the firm">
                <img src="{{ asset('images/hero-bg.jpeg') }}" alt="Professional office setting">
                <div class="hero-panel__card">
                    <span class="hero-panel__badge"><i class="fas fa-star"></i> A clearer legal experience from first contact</span>
                    <h2>Professional Representation with a Clear Path</h2>
                    <p>
                        We focus on understanding your case first, then building a practical strategy that includes legal analysis,
                        process management, and continuous follow-up until the best possible outcome is reached.
                    </p>
                    <ul class="hero-panel__list">
                        <li>Fast response to consultation requests</li>
                        <li>Precise and clear legal drafting</li>
                        <li>Organized and ongoing follow-up for every file</li>
                    </ul>
                    <div class="hero-panel__footer">
                        <div>
                            <strong>A Smoother Start</strong>
                            <span>We define your first step clearly</span>
                        </div>
                        <a href="#contact" class="hero-panel__link">Start Now</a>
                    </div>
                </div>
            </aside>
        </div>
        <a href="#about" class="hero-scroll" aria-label="Go to About section">
            <span>Discover More</span>
            <i class="fas fa-arrow-down"></i>
        </a>
    </header>

    <section class="partners-band" id="partners" aria-labelledby="partnersTitle">
        <div class="container">
            <div class="section-heading partners-heading reveal">
                <span class="eyebrow">Our Partners</span>
                <h2 id="partnersTitle">Success Partners</h2>
                <p>We are proud to collaborate with leading government entities and distinguished institutions.</p>
            </div>

            <div class="partners-marquee reveal" aria-label="Success partner logos">
                <div class="partners-marquee__inner">
                    <figure class="partner-logo">
                        <img src="{{ asset('images/mwathiq-logo.svg') }}" alt="Mowathiq logo">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/logoozartal3dl.png') }}" alt="Ministry of Justice logo">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/logo-4-1024x387.png') }}" alt="Partner logo">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/saip-logo-ar.svg') }}" alt="Saudi Authority for Intellectual Property logo">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section" id="about" aria-labelledby="aboutTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">About Us</span>
                <h2 id="aboutTitle">Legal Expertise Delivered in Clear Language and a Structured Professional Process</h2>
                <p>
                    We provide integrated legal services that begin with accurately understanding facts, then analyzing the legal
                    position, and finally building practical solutions for litigation, drafting, negotiation, and advisory work.
                </p>
            </div>

            <div class="about-layout">
                <article class="about-card reveal">
                    <h3>Our Vision</h3>
                    <p>To ensure every client feels confident that their legal matter is managed with clarity, professionalism, and practical precision.</p>
                </article>
                <article class="about-card reveal">
                    <h3>Our Approach</h3>
                    <p>We rely on gathering details, analyzing risks, prioritizing actions, and maintaining continuous client communication during execution.</p>
                </article>
                <article class="about-card reveal">
                    <h3>Added Value</h3>
                    <p>We do more than provide legal responses. We help you understand available options and their impact on time, cost, and procedure.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--alt" id="services" aria-labelledby="servicesTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">Services</span>
                <h2 id="servicesTitle">Legal Services for Individuals and Businesses</h2>
                <p>These services are designed to combine legal specialization with fast understanding and the ability to turn complexity into clarity.</p>
            </div>

            <div class="service-grid">
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-balance-scale"></i></div>
                    <h3>Litigation Representation</h3>
                    <p>Preparing legal memoranda, pleading, and following up hearings and procedures before competent authorities.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-briefcase"></i></div>
                    <h3>Commercial Cases</h3>
                    <p>Handling commercial disputes, contractual conflicts, and protecting the interests of companies and entrepreneurs.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-users"></i></div>
                    <h3>Personal Status</h3>
                    <p>Managing family-related matters with professional sensitivity while maintaining privacy and procedural accuracy.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-file-signature"></i></div>
                    <h3>Contract Drafting</h3>
                    <p>Drafting and reviewing contracts and agreements to reduce disputes and improve clarity of obligations.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-handshake-angle"></i></div>
                    <h3>Arbitration and Settlement</h3>
                    <p>Building effective negotiation and settlement paths when amicable solutions are better than escalation.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-clipboard-check"></i></div>
                    <h3>Compliance and Governance</h3>
                    <p>Reviewing policies and internal procedures to support regulatory compliance and reduce legal risk.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section" id="features" aria-labelledby="featuresTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">Why Us</span>
                <h2 id="featuresTitle">Advantages That Make the Legal Experience Clearer and More Effective</h2>
                <p>We focus on quality, clear communication, and commitment to timelines and procedures at every stage.</p>
            </div>

            <div class="feature-grid">
                <article class="feature-card reveal"><i class="fas fa-lightbulb"></i><h3>Clear Analysis</h3><p>We explain legal positions in understandable language without unnecessary complexity.</p></article>
                <article class="feature-card reveal"><i class="fas fa-user-shield"></i><h3>High Confidentiality</h3><p>We handle client data and cases with the highest standards of professionalism and privacy.</p></article>
                <article class="feature-card reveal"><i class="fas fa-stopwatch"></i><h3>Fast Response</h3><p>We reduce waiting time and prioritize effectively so legal work starts quickly and efficiently.</p></article>
                <article class="feature-card reveal"><i class="fas fa-chart-line"></i><h3>Consistent Follow-Up</h3><p>Clear updates on your case status and the expected next stage.</p></article>
                <article class="feature-card reveal"><i class="fas fa-gears"></i><h3>Practical Solutions</h3><p>We do not present legal text only; we connect it to outcomes and actionable steps.</p></article>
                <article class="feature-card reveal"><i class="fas fa-landmark"></i><h3>Procedural Expertise</h3><p>Strong command of procedures, documents, and legal pathways needed to speed up execution.</p></article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--process " id="process" aria-labelledby="processTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">How We Work</span>
                <h2 id="processTitle">How We Start with You from First Contact to Execution</h2>
                <p>A concise and clear plan that helps you understand what happens at each step.</p>
            </div>

            <div class="timeline">
                <article class="timeline-step reveal"><span class="timeline-step__number">1</span><h3>Request Intake</h3><p>We review key details and identify the required service or case type.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">2</span><h3>Initial Analysis</h3><p>We examine facts and documents and clarify your legal position and options.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">3</span><h3>Path Definition</h3><p>We provide a clear recommendation including proposed actions, documents, and next steps.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">4</span><h3>Execution and Follow-Up</h3><p>We begin work and continuously update you on progress and developments.</p></article>
            </div>
        </div>
    </section>

    <section class="content-section" id="testimonials" aria-labelledby="testimonialsTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">General Impression</span>
                <h2 id="testimonialsTitle">What Clients Value Most in Our Way of Working</h2>
                <p>These points reflect the key qualities clients seek when choosing a trusted legal partner.</p>
            </div>

            <div class="testimonial-grid">
                <article class="testimonial-card reveal"><p>Clear legal explanation and simplified options helped decision-making with speed and confidence.</p><strong>Clear Communication</strong></article>
                <article class="testimonial-card reveal"><p>Consistent follow-up and regular responses created a strong sense of professionalism and reassurance.</p><strong>Professional Follow-Up</strong></article>
                <article class="testimonial-card reveal"><p>Balancing legal correctness with practical outcomes made the service more realistic and effective.</p><strong>Actionable Solutions</strong></article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--alt" id="faq" aria-labelledby="faqTitle">
        <div class="container narrow">
            <div class="section-heading reveal">
                <span class="eyebrow">FAQ</span>
                <h2 id="faqTitle">Brief Answers to the Questions We Receive Most Often</h2>
                <p>This section is designed to help visitors understand our process and services before contacting us.</p>
            </div>

            <div class="faq-list">
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>Can I request a consultation before filing a lawsuit?</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>Yes. In most cases, an initial consultation is the best first step to understand your situation and choose the right legal path.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>Do you provide services for both businesses and individuals?</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>Yes. We serve both individuals and organizations across litigation, advisory work, contracts, compliance, and governance.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>What information is required to begin reviewing a case?</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>A brief case summary, case type, and preferred contact method are enough to start. We request supporting documents if needed.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>Is the initial response fast?</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>We review requests promptly and prioritize them based on request type, available information, and suitable communication channel.</p></div>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section contact-section-home" id="contact" aria-labelledby="contactTitle">
        <div class="container contact-home">
            <div class="contact-home__intro reveal">
                <span class="eyebrow">Contact Us</span>
                <h2 id="contactTitle">Start with an Initial Legal Consultation Request</h2>
                <p>Fill in the short form and we will review your request, then contact you through the most suitable channel. This form is for quick starts, and you can move to the full contact page for more details.</p>
                <ul class="contact-home__list">
                    <li><i class="fas fa-phone"></i><span>Phone: +966 533461460</span></li>
                    <li><i class="fas fa-envelope"></i><span>Email: info@aljawharalaw.com</span></li>
                    <li><i class="fas fa-location-dot"></i><span>Riyadh - Saudi Arabia</span></li>
                    <li><i class="fas fa-location-dot"></i><span>Jeddah - Saudi Arabia</span></li>
                    <li><i class="fas fa-location-dot"></i><span>Dammam - Saudi Arabia</span></li>
                    <li><i class="fas fa-location-dot"></i><span>Madinah - Saudi Arabia</span></li>
                </ul>
            </div>

            <form class="consultation-form reveal" id="quickConsultationForm" action="{{ route('contact.store') }}" method="POST" novalidate>
                @csrf
                <div class="consultation-form__grid">
                    <div class="form-field">
                        <label for="quick_name">Name</label>
                        <input id="quick_name" name="name" type="text" required>
                        <small class="field-error" data-for="quick_name"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_email">Email Address</label>
                        <input id="quick_email" name="email" type="email" inputmode="email" required>
                        <small class="field-error" data-for="quick_email"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_phone">Mobile Number</label>
                        <input id="quick_phone" name="phone" type="text" inputmode="tel" required>
                        <small class="field-error" data-for="quick_phone"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_case_type">Case Type</label>
                        <select id="quick_case_type" name="case_type" required>
                            <option value="">Select type</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Personal Status">Personal Status</option>
                            <option value="Criminal">Criminal</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Other">Other</option>
                        </select>
                        <small class="field-error" data-for="quick_case_type"></small>
                    </div>
                    <div class="form-field form-field--full">
                        <label for="quick_details">Brief Details</label>
                        <textarea id="quick_details" name="details" rows="5" required></textarea>
                        <small class="field-error" data-for="quick_details"></small>
                    </div>
                </div>

                <input type="hidden" name="lang" value="en">

                <div class="consultation-form__actions">
                    <button class="button button--primary" type="submit" id="quickSubmitButton">Submit Request</button>
                    <a href="{{ route('contact') }}" class="button button--secondary">Full Contact Page</a>
                </div>
                <p class="form-note">Your data will only be used for communication regarding your legal request.</p>
            </form>
        </div>
    </section>
@endsection
