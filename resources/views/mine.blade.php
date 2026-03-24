@extends('layout.main-shell', [
    'title' => 'مكتب الجوهرة للمحاماة والاستشارات القانونية',
    'description' => 'مكتب الجوهرة للمحاماة والاستشارات القانونية يقدم خدمات قانونية متكاملة في السعودية تشمل القضايا التجارية والأحوال الشخصية والتحكيم والاستشارات القانونية.',
    'page' => 'home',
    'bodyClass' => 'home-page',
])

@section('content')
    <header class="hero-section" id="home">
        <div class="container hero-section__grid">
            <section class="hero-copy reveal" aria-labelledby="heroTitle">
                <span class="eyebrow">حلول قانونية دقيقة تبنى على الثقة والنتيجة</span>
                <h1 id="heroTitle">
                    <span>مكتب الجوهرة للمحاماة والاستشارات القانونية والعمالية</span><br>
                    <span>والتوثيق والتسجيل العيني للعقار</span>
                </h1>
                <p>
                    نمثل الأفراد والمنشآت أمام الجهات القضائية والتنظيمية، ونقدم استشارات قانونية وصياغات تعاقدية
                    واضحة تساعد على حماية الحقوق وتقليل المخاطر واتخاذ القرار بثقة.
                </p>
                <ul class="hero-highlights" aria-label="أبرز مزايا التواصل معنا">
                    <li><i class="fas fa-check-circle"></i><span>تقييم أولي واضح للموقف القانوني</span></li>
                    <li><i class="fas fa-comments"></i><span>تواصل مباشر بلغة مفهومة ومنظمة</span></li>
                    <li><i class="fas fa-folder-open"></i><span>متابعة دقيقة للوثائق والإجراءات</span></li>
                </ul>
                <div class="hero-actions">
                    <a href="#contact" class="button button--primary">احجز استشارة أولية</a>
                    <a href="#services" class="button button--ghost">استعرض الخدمات</a>
                </div>
                <div class="hero-trust" aria-label="روابط سريعة ومؤشرات ثقة">
                    <a href="tel:+966533734013" class="hero-trust__item">
                        <i class="fas fa-phone-volume"></i>
                        <span>اتصال مباشر</span>
                    </a>
                    <a href="https://wa.me/966533734013" class="hero-trust__item" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp"></i>
                        <span>واتساب سريع</span>
                    </a>
                    <div class="hero-trust__item hero-trust__item--static">
                        <i class="fas fa-shield-alt"></i>
                        <span>خصوصية ومهنية عالية</span>
                    </div>
                </div>
                <ul class="hero-stats" aria-label="إحصاءات المكتب">
                    <li><strong class="counter" data-target="120">0</strong><span>قضية واستشارة</span></li>
                    <li><strong class="counter" data-target="10">0</strong><span>مجالات قانونية</span></li>
                    <li><strong class="counter" data-target="4">0</strong><span>مدن تغطية رئيسية</span></li>
                </ul>
            </section>

            <aside class="hero-panel reveal" aria-label="نبذة سريعة عن المكتب">
                <img src="{{ asset('images/hero-bg.jpeg') }}" alt="واجهة مكتبية تعكس الاحترافية القانونية">
                <div class="hero-panel__card">
                    <span class="hero-panel__badge"><i class="fas fa-star"></i> تجربة قانونية أوضح من أول تواصل</span>
                    <h2>تمثيل احترافي ومسار واضح</h2>
                    <p>
                        نركز على فهم القضية أولاً، ثم نبني استراتيجية عملية تشمل التحليل القانوني، إدارة الإجراءات،
                        والمتابعة المستمرة مع العميل حتى الوصول إلى أفضل نتيجة ممكنة.
                    </p>
                    <ul class="hero-panel__list">
                        <li>استجابة سريعة لطلبات الاستشارة</li>
                        <li>صياغة قانونية دقيقة وواضحة</li>
                        <li>متابعة منظمة ومستمرة لكل ملف</li>
                    </ul>
                    <div class="hero-panel__footer">
                        <div>
                            <strong>بداية أسهل</strong>
                            <span>نرتب لك أول خطوة بوضوح</span>
                        </div>
                        <a href="#contact" class="hero-panel__link">ابدأ الآن</a>
                    </div>
                </div>
            </aside>
        </div>
        <a href="#about" class="hero-scroll" aria-label="الانتقال إلى قسم من نحن">
            <span>اكتشف المزيد</span>
            <i class="fas fa-arrow-down"></i>
        </a>
    </header>

    <section class="partners-band" id="partners" aria-labelledby="partnersTitle">
        <div class="container">
            <div class="section-heading partners-heading reveal">
                <span class="eyebrow">شركاؤنا</span>
                <h2 id="partnersTitle">شركاء النجاح</h2>
                <p>نتشرف بالتعاون مع الجهات الحكومية والمؤسسات البارزة التي تدعم مسيرتنا القانونية.</p>
            </div>

            <div class="partners-marquee reveal" aria-label="شعارات شركاء النجاح">
                <div class="partners-marquee__inner">
                    <figure class="partner-logo">
                        <img src="{{ asset('images/mwathiq-logo.svg') }}" alt="شعار موثق">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/logoozartal3dl.png') }}" alt="شعار وزارة العدل">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/logo-4-1024x387.png') }}" alt="شعار الشريك الثالث">
                    </figure>
                    <figure class="partner-logo">
                        <img src="{{ asset('images/saip-logo-ar.svg') }}" alt="شعار الهيئة السعودية للملكية الفكرية">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section" id="about" aria-labelledby="aboutTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">من نحن</span>
                <h2 id="aboutTitle">خبرة قانونية تقدم بلغة مفهومة ومسار مهني منظم</h2>
                <p>
                    نعمل على تقديم خدمة قانونية متكاملة تبدأ بفهم الوقائع بدقة، ثم تحليل الموقف النظامي، ثم بناء
                    حلول عملية قابلة للتنفيذ سواء في التمثيل القضائي أو الصياغة أو التفاوض أو الاستشارات.
                </p>
            </div>

            <div class="about-layout">
                <article class="about-card reveal">
                    <h3>رؤيتنا</h3>
                    <p>أن يكون العميل مطمئناً إلى أن ملفه القانوني يدار بوضوح واحترافية مع توازن بين الدقة والنتيجة العملية.</p>
                </article>
                <article class="about-card reveal">
                    <h3>منهج العمل</h3>
                    <p>نعتمد على جمع التفاصيل، تحليل المخاطر، ترتيب الأولويات، ثم التواصل المستمر مع العميل أثناء التنفيذ والمتابعة.</p>
                </article>
                <article class="about-card reveal">
                    <h3>قيمة مضافة</h3>
                    <p>لا نكتفي بالرد القانوني فقط، بل نساعد في فهم الخيارات المتاحة وتأثير كل خيار على الوقت والمال والإجراء.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--alt" id="services" aria-labelledby="servicesTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">الخدمات</span>
                <h2 id="servicesTitle">خدمات قانونية تغطي احتياج الأفراد والمنشآت</h2>
                <p>صممنا هذه الخدمات لتجمع بين التخصص القانوني والسرعة في الفهم والقدرة على تحويل التعقيد إلى مسار واضح.</p>
            </div>

            <div class="service-grid">
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-balance-scale"></i></div>
                    <h3>التمثيل القضائي</h3>
                    <p>إعداد المذكرات، الترافع، ومتابعة الجلسات والإجراءات أمام الجهات المختصة.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-briefcase"></i></div>
                    <h3>القضايا التجارية</h3>
                    <p>معالجة النزاعات التجارية والخلافات التعاقدية وحماية مصالح الشركات ورواد الأعمال.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-users"></i></div>
                    <h3>الأحوال الشخصية</h3>
                    <p>متابعة القضايا الأسرية بحساسية مهنية مع مراعاة الخصوصية والدقة الإجرائية.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-file-signature"></i></div>
                    <h3>صياغة العقود</h3>
                    <p>صياغة ومراجعة العقود والاتفاقيات بما يحد من النزاعات ويرفع وضوح الالتزامات.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-handshake-angle"></i></div>
                    <h3>التحكيم والتسوية</h3>
                    <p>بناء مسارات فعالة للتفاوض والتسوية حين يكون الحل الودي أفضل من التصعيد.</p>
                </article>
                <article class="service-card reveal">
                    <div class="service-card__icon"><i class="fas fa-clipboard-check"></i></div>
                    <h3>الامتثال والحوكمة</h3>
                    <p>مراجعة السياسات والإجراءات الداخلية لدعم الالتزام النظامي وتقليل المخاطر.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section" id="features" aria-labelledby="featuresTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">لماذا نحن</span>
                <h2 id="featuresTitle">مزايا تجعل التجربة القانونية أوضح وأكثر فاعلية</h2>
                <p>نركز على جودة العمل، وضوح التواصل، والالتزام بالوقت والإجراءات في كل مرحلة.</p>
            </div>

            <div class="feature-grid">
                <article class="feature-card reveal"><i class="fas fa-lightbulb"></i><h3>تحليل واضح</h3><p>نشرح الوضع القانوني بلغة مفهومة بعيداً عن التعقيد غير الضروري.</p></article>
                <article class="feature-card reveal"><i class="fas fa-user-shield"></i><h3>سرية عالية</h3><p>نتعامل مع بيانات العملاء وقضاياهم بأعلى درجات المهنية والخصوصية.</p></article>
                <article class="feature-card reveal"><i class="fas fa-stopwatch"></i><h3>استجابة سريعة</h3><p>نقلل وقت الانتظار ونرتب الأولويات حتى يبدأ العمل القانوني بسرعة وكفاءة.</p></article>
                <article class="feature-card reveal"><i class="fas fa-chart-line"></i><h3>متابعة منتظمة</h3><p>تحديثات واضحة عن حالة الطلب أو القضية والمرحلة التالية المتوقعة.</p></article>
                <article class="feature-card reveal"><i class="fas fa-gears"></i><h3>حلول عملية</h3><p>لا نطرح النصوص فقط، بل نربطها بالنتيجة والخطوات المناسبة للحالة.</p></article>
                <article class="feature-card reveal"><i class="fas fa-landmark"></i><h3>إلمام إجرائي</h3><p>فهم للإجراءات والوثائق والمسارات النظامية اللازمة لتسريع التنفيذ.</p></article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--process " id="process" aria-labelledby="processTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">آلية العمل</span>
                <h2 id="processTitle">كيف نبدأ معك من أول تواصل حتى التنفيذ</h2>
                <p>خطة مختصرة وواضحة تساعدك على فهم ما يحدث في كل خطوة.</p>
            </div>

            <div class="timeline">
                <article class="timeline-step reveal"><span class="timeline-step__number">1</span><h3>استلام الطلب</h3><p>نراجع المعلومات الأساسية ونحدد نوع الخدمة أو القضية المطلوبة.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">2</span><h3>التحليل الأولي</h3><p>نفحص الوقائع والوثائق ونوضح الصورة القانونية والخيارات المتاحة.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">3</span><h3>تحديد المسار</h3><p>نبني توصية واضحة تشمل الإجراء المقترح والوثائق والخطوات القادمة.</p></article>
                <article class="timeline-step reveal"><span class="timeline-step__number">4</span><h3>التنفيذ والمتابعة</h3><p>نبدأ العمل ونتابع المستجدات مع إبقائك على اطلاع بالحالة بشكل مستمر.</p></article>
            </div>
        </div>
    </section>

    <section class="content-section" id="testimonials" aria-labelledby="testimonialsTitle">
        <div class="container">
            <div class="section-heading reveal">
                <span class="eyebrow">انطباع عام</span>
                <h2 id="testimonialsTitle">ما الذي يقدره العملاء في طريقة عملنا</h2>
                <p>هذه النقاط تمثل أبرز الجوانب التي يبحث عنها العميل عند اختياره شريكاً قانونياً موثوقاً.</p>
            </div>

            <div class="testimonial-grid">
                <article class="testimonial-card reveal"><p>وضوح الشرح القانوني وتبسيط الخيارات ساعد في اتخاذ القرار بسرعة وثقة.</p><strong>وضوح التواصل</strong></article>
                <article class="testimonial-card reveal"><p>الالتزام في المتابعة والرد المنتظم أعطى انطباعاً مهنياً ورفع مستوى الاطمئنان.</p><strong>احترافية المتابعة</strong></article>
                <article class="testimonial-card reveal"><p>الموازنة بين الحل النظامي والنتيجة العملية جعلت الخدمة أكثر واقعية وفاعلية.</p><strong>حلول قابلة للتنفيذ</strong></article>
            </div>
        </div>
    </section>

    <section class="content-section content-section--alt" id="faq" aria-labelledby="faqTitle">
        <div class="container narrow">
            <div class="section-heading reveal">
                <span class="eyebrow">الأسئلة الشائعة</span>
                <h2 id="faqTitle">إجابات مختصرة على أكثر ما يردنا من استفسارات</h2>
                <p>وسعنا هذا القسم ليساعد الزائر على فهم آلية العمل والخدمة قبل التواصل.</p>
            </div>

            <div class="faq-list">
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>هل يمكن طلب استشارة قبل رفع الدعوى؟</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>نعم، وغالباً تكون الاستشارة الأولية أفضل خطوة لفهم الموقف واختيار المسار القانوني المناسب قبل البدء بأي إجراء.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>هل تقدمون خدمات للشركات والأفراد معاً؟</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>نعم، نخدم الأفراد والمنشآت في عدد من المجالات مثل القضايا، الاستشارات، العقود، والامتثال والحوكمة.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>ما المعلومات المطلوبة لبدء مراجعة الحالة؟</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>يكفي في البداية وصف مختصر للحالة مع نوع القضية ووسيلة التواصل، ثم نطلب الوثائق التفصيلية إذا لزم الأمر.</p></div>
                </article>
                <article class="faq-item reveal">
                    <button class="faq-question" type="button" aria-expanded="false"><span>هل الرد الأولي سريع؟</span><i class="fas fa-plus"></i></button>
                    <div class="faq-answer"><p>نحرص على مراجعة الطلبات بسرعة، ثم ترتيب الأولوية حسب نوع الطلب والبيانات المتاحة ووسيلة التواصل المناسبة.</p></div>
                </article>
            </div>
        </div>
    </section>

    <section class="content-section contact-section-home" id="contact" aria-labelledby="contactTitle">
        <div class="container contact-home">
            <div class="contact-home__intro reveal">
                <span class="eyebrow">تواصل معنا</span>
                <h2 id="contactTitle">ابدأ بطلب استشارة قانونية أولية</h2>
                <p>املأ النموذج المختصر وسنراجع طلبك ثم نتواصل معك بالوسيلة المناسبة. هذا النموذج مخصص للبدء السريع ويمكنك الانتقال إلى صفحة التواصل الكاملة إذا كنت تريد تفاصيل إضافية.</p>
                <ul class="contact-home__list">
                    <li><i class="fas fa-phone"></i><span > الهاتف :  533461460 966+</span></li>
                    <li><i class="fas fa-envelope"></i><span>البريد: info@aljawharalaw.com</span></li>
                    <li><i class="fas fa-location-dot"></i><span>الرياض - المملكة العربية السعودية</span></li>
                    <li><i class="fas fa-location-dot"></i><span>جده - المملكة العربية السعودية</span></li>
                    <li><i class="fas fa-location-dot"></i><span>الدمام - المملكة العربية السعودية</span></li>
                    <li><i class="fas fa-location-dot"></i><span>المدينة المنورة - المملكة العربية السعودية</span></li>
                </ul>
            </div>

            <form class="consultation-form" id="quickConsultationForm" action="{{ route('contact.store') }}" method="POST" >
                @csrf
                <div class="consultation-form__grid">
                    <div class="form-field">
                        <label for="quick_name">الاسم</label>
                        <input id="quick_name" name="name" type="text" required>
                        <small class="field-error" data-for="quick_name"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_email">البريد الإلكتروني</label>
                        <input id="quick_email" name="email" type="email" inputmode="email" required>
                        <small class="field-error" data-for="quick_email"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_phone">رقم الجوال</label>
                        <input id="quick_phone" name="phone" type="text" inputmode="tel" required>
                        <small class="field-error" data-for="quick_phone"></small>
                    </div>
                    <div class="form-field">
                        <label for="quick_case_type">نوع القضية</label>
                        <select id="quick_case_type" name="case_type" required>
                            <option value="">اختر النوع</option>
                            <option value="تجارية">تجارية</option>
                            <option value="أحوال شخصية">أحوال شخصية</option>
                            <option value="جنائية">جنائية</option>
                            <option value="عقارية">عقارية</option>
                            <option value="اخرى">أخرى</option>
                        </select>
                        <small class="field-error" data-for="quick_case_type"></small>
                    </div>
                    <div class="form-field form-field--full">
                        <label for="quick_details">تفاصيل مختصرة</label>
                        <textarea id="quick_details" name="details" rows="5" required></textarea>
                        <small class="field-error" data-for="quick_details"></small>
                    </div>
                </div>

                <input type="hidden" name="lang" value="ar">

                <div class="consultation-form__actions">
                    <button class="button button--primary" type="submit" id="quickSubmitButton">إرسال الطلب</button>
                    <a href="{{ route('contact') }}" class="button button--secondary">صفحة التواصل الكاملة</a>
                </div>
                <p class="form-note">لن يتم استخدام بياناتك إلا لغرض التواصل بخصوص الطلب القانوني.</p>
            </form>
        </div>
    </section>
@endsection
