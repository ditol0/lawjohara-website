@extends('layout.main-shell-en', [
    'title' => 'Al Jawhara Law Firm and Legal Consultancy | Contact',
    'description' => 'Contact Al Jawhara Law Firm and Legal Consultancy for specialized legal consultation in Saudi Arabia.',
    'page' => 'contact',
    'bodyClass' => 'contact-page',
])

@push('head')
    <link rel="stylesheet" href="{{ asset('css/contact-page.css') }}?v={{ config('assets.version') }}">
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content reveal">
                <span class="contact-hero-badge">Direct and Professional Communication</span>
                <h1 class="contact-hero-title">Contact Us</h1>
                <p class="contact-hero-subtitle">We receive consultation and case requests and respond as quickly as possible through the most suitable channels.</p>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container contact-container">
            <div class="section-header reveal">
                <span class="section-badge">Contact</span>
                <h2 class="section-title">We Are Here to Help</h2>
                <p class="section-subtitle">Send your request details and we will contact you to review the case and define the best legal next step.</p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-details">
                            <h3>Phone</h3>
                            <p><a href="tel:+966533461460">533461460 966+ </a></p>
                        </div>
                    </div>

                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><a href="mailto:info@aljawharalaw.com">info@aljawharalaw.com</a></p>
                        </div>
                    </div>

                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="contact-details">
                            <h3>Locations</h3>
                            <p>Riyadh - Saudi Arabia</p>
                            <p>Jeddah - Saudi Arabia</p>
                            <p>Dammam - Saudi Arabia</p>
                            <p>Madinah - Saudi Arabia</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container reveal">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error">
                            <strong>Please review the following fields:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form" id="contactForm">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-input" value="{{ old('name') }}" required>
                                <div class="error-message" id="nameError"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone">Mobile Number</label>
                                <input id="phone" name="phone" type="text" class="form-input" value="{{ old('phone') }}" required>
                                <div class="error-message" id="phoneError"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}">
                                <div class="error-message" id="emailError"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="case_type">Case Type</label>
                                <select id="case_type" name="case_type" class="form-select" required>
                                    <option value="">Select case type</option>
                                    <option value="Commercial" @selected(old('case_type') == 'Commercial')>Commercial</option>
                                    <option value="Personal Status" @selected(old('case_type') == 'Personal Status')>Personal Status</option>
                                    <option value="Criminal" @selected(old('case_type') == 'Criminal')>Criminal</option>
                                    <option value="Real Estate" @selected(old('case_type') == 'Real Estate')>Real Estate</option>
                                    <option value="Other" @selected(old('case_type') == 'Other')>Other</option>
                                </select>
                                <div class="error-message" id="case_typeError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="details">Case Details</label>
                            <textarea id="details" name="details" class="form-textarea" required>{{ old('details') }}</textarea>
                            <div class="error-message" id="detailsError"></div>
                        </div>

                        <input type="hidden" name="lang" value="en">

                        <button type="submit" class="btn btn-primary" id="submitButton">
                            <i class="fas fa-paper-plane"></i>
                            Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
