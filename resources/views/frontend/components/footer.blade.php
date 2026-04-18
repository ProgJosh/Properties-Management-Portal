<footer class="footer footer-two padding-y-120">
    <div class="container container-two">
        <div class="row gy-5">
            <div class="col-xl-4 col-lg-6">
                <div class="footer-item">
                    <div class="footer-item__logo">
                        <a href="{{ route('home') }}"> <img
                                src="{{ asset('frontend/assets/images/logo/system-logo.png') }}"
                                alt=""></a>
                    </div>
                    <p class="footer-item__desc">Discover Trusted Rentals in Guagua, Pampanga. Making Your Apartment Search Effortless</p>

                    <h6 class="footer-item__title mt-4 mt-lg-5">Lets Work Together</h6>
                    <div class="row gy-4">
                        <div class="col-6">
                            <div class="contact-info d-flex gap-2">
                                <span class="contact-info__icon text-gradient"><i
                                        class="fas fa-map-marker-alt"></i></span>
                                <div class="contact-info__content">
                                    <span class="contact-info__text text-white">Address</span>
                                    <span class="contact-info__address text-white">XJMC+JV9, Sta. Rita, Guagua, Pampanga</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="contact-info d-flex gap-2">
                                <span class="contact-info__icon text-gradient"><i
                                        class="fas fa-phone"></i></span>
                                <div class="contact-info__content">
                                    <span class="contact-info__text text-white">Phone Number</span>
                                    <span class="contact-info__address text-white">09054882023</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-1 d-xl-block d-none"></div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h6 class="footer-item__title">Services</h6>
                    <ul class="footer-menu">
                        <li class="footer-menu__item"><a href="{{ route('properties') }}"
                                class="footer-menu__link">Trusted Landlords and Properties </a></li>
                        <li class="footer-menu__item"><a href="{{ route('dashboard') }}"
                                class="footer-menu__link">Smart Dashboards with Secure & Reliable Access </a></li>
                        <li class="footer-menu__item"><a href="{{ route('properties') }}"
                                class="footer-menu__link">Experience good transaction with Tenant Easily</a></li>
                        <li class="footer-menu__item"><a href="{{ route('properties') }}"
                                class="footer-menu__link">Budget-friendlyy</a></li>
                        <li class="footer-menu__item"><a href="{{ route('properties') }}"
                                class="footer-menu__link">Good Class Apartments</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-1 d-xl-block d-none"></div>
            <div class="col-xl-3 col-sm-6">
                <div class="footer-item">
                    <h6 class="footer-item__title">Have a Question?</h6>
                    <p class="footer-item__desc">Feel free to contact us anytime! </p>

                    <form action="{{ route('footer.inquiry') }}" method="POST" class="mt-4 subscribe-box footer-subscribe-box">
                        @csrf
                        <div class="footer-inquiry-grid">
                            <input type="text"
                                class="form-control common-input common-input--md text-white footer-subscribe-input"
                                placeholder="Your Name"
                                name="name"
                                value="{{ old('name') }}"
                                required>
                            <input type="email"
                                class="form-control common-input common-input--md text-white footer-subscribe-input"
                                placeholder="Your Email Address"
                                name="email"
                                value="{{ old('email') }}"
                                required>
                            <textarea
                                class="form-control common-input common-input--md text-white footer-subscribe-input footer-subscribe-textarea"
                                placeholder="How can we help you?"
                                name="message"
                                rows="4"
                                required>{{ old('message') }}</textarea>
                            <button type="submit"
                                class="px-4 input-group-text bg--gradient border-0 text-white footer-subscribe-button">
                                <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                            </button>
                        </div>
                        @error('name')
                            <span class="text-warning d-block mt-2">{{ $message }}</span>
                        @enderror
                        @error('email')
                            <span class="text-warning d-block mt-2">{{ $message }}</span>
                        @enderror
                        @error('message')
                            <span class="text-warning d-block mt-2">{{ $message }}</span>
                        @enderror
                    </form>

                    <ul class="social-list">
                        <li class="social-list__item"><a href="https://www.facebook.com/profile.php?id=61564230972072"
                                class="social-list__link flx-center"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="social-list__item"><a href="https://www.twitter.com"
                                class="social-list__link flx-center"> <i class="fab fa-twitter"></i></a>
                        </li>
                        </li>
                        <li class="social-list__item"><a href="https://www.instagram.com/invites/contact/?igsh=1eicshihihbc8&utm_content=vdjglep"
                                class="social-list__link flx-center"> <i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer">
    <div class="container container-two">
        <div class="bottom-footer__inner flx-between gap-3">
            <p class="bottom-footer__text"> &copy; Property Management Portal - 2024 | All Rights Reserved.</p>
            <div class="footer-links">
                <a href="#" class="footer-link">Terms & Condition</a>
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="{{ route('contact') }}" class="footer-link">Contact Us</a>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .footer-subscribe-group {
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }

        .footer-inquiry-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .footer-subscribe-input {
            min-width: 0;
            width: 100%;
        }

        .footer-subscribe-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .footer-subscribe-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            width: 100%;
            min-height: 54px;
            border-radius: 12px !important;
        }

        @media (max-width: 575.98px) {
            .footer-subscribe-group {
                flex-direction: column;
                gap: 12px;
            }

            .footer-subscribe-input {
                border-radius: 12px !important;
            }

            .footer-subscribe-button {
                width: 100%;
                min-height: 52px;
                border-radius: 12px !important;
            }
        }
    </style>
@endpush
