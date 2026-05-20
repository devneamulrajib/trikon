@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
*{margin:0;padding:0;box-sizing:border-box}

:root{
    --primary:#071C3C;
    --secondary:#0D2C5A;
    --gold:#D6A84F;
    --light:#F7F8FA;
    --white:#ffffff;
    --text:#1E293B;
    --muted:#64748B;
    --border:#E5E7EB;
}

body{
    font-family:'Manrope',sans-serif;
    color:var(--text);
    background:#fff;
}

.buysell-page{
    overflow:hidden;
}

/* HERO */
.bs-hero{
    position:relative;
    padding:90px 7%;
    min-height:720px;
    display:flex;
    align-items:center;
    background:
    linear-gradient(90deg, rgba(4,18,41,.96) 0%, rgba(4,18,41,.88) 40%, rgba(4,18,41,.35) 100%),
    url('https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1800') center center/cover no-repeat;
}

.bs-hero-wrap{
    width:100%;
    display:grid;
    grid-template-columns:1.1fr 430px;
    gap:70px;
    align-items:center;
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.1);
    padding:10px 18px;
    border-radius:100px;
    color:#fff;
    font-size:13px;
    margin-bottom:28px;
}

.hero-badge i{
    color:var(--gold);
}

.bs-title{
    font-family:'Outfit',sans-serif;
    font-size:78px;
    line-height:1;
    font-weight:800;
    color:#fff;
    margin-bottom:26px;
    letter-spacing:-2px;
}

.bs-title span{
    color:var(--gold);
}

.bs-desc{
    max-width:650px;
    color:rgba(255,255,255,.82);
    line-height:1.9;
    font-size:17px;
    margin-bottom:38px;
}

.bs-actions{
    display:flex;
    flex-wrap:wrap;
    gap:16px;
}

.btn-gold{
    background:var(--gold);
    color:#111;
    padding:16px 34px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    font-size:14px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}

.btn-gold:hover{
    transform:translateY(-3px);
}

.btn-dark{
    border:1px solid rgba(255,255,255,.18);
    color:#fff;
    padding:16px 34px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    font-size:14px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,.06);
    backdrop-filter:blur(8px);
}

.btn-dark:hover{
    background:#fff;
    color:#111;
}

/* FORM */
.hero-form{
    background:rgba(8,25,53,.82);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,.1);
    border-radius:28px;
    padding:34px;
    box-shadow:0 25px 60px rgba(0,0,0,.25);
}

.hero-form h3{
    font-size:34px;
    color:#fff;
    margin-bottom:10px;
    font-family:'Outfit',sans-serif;
}

.hero-form p{
    color:rgba(255,255,255,.68);
    font-size:14px;
    margin-bottom:24px;
}

.form-group{
    margin-bottom:16px;
}

.form-group input,
.form-group select{
    width:100%;
    height:56px;
    border:none;
    border-radius:12px;
    padding:0 18px;
    font-size:15px;
    outline:none;
    background:#fff;
}

.submit-btn{
    width:100%;
    height:58px;
    border:none;
    border-radius:12px;
    background:var(--gold);
    font-weight:800;
    font-size:15px;
    cursor:pointer;
}

/* SECTION */
.section{
    padding:90px 7%;
}

.section-title{
    font-size:46px;
    line-height:1.1;
    margin-bottom:20px;
    font-family:'Outfit',sans-serif;
    color:var(--primary);
    font-weight:800;
}

.section-title span{
    color:var(--gold);
}

.section-desc{
    color:var(--muted);
    line-height:1.9;
    font-size:16px;
}

/* ABOUT */
.about-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:50px;
    align-items:start;
}

.about-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:24px;
    padding:38px;
}

.service-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.service-card{
    border:1px solid var(--border);
    border-radius:22px;
    overflow:hidden;
    background:#fff;
}

.service-head{
    padding:18px 24px;
    font-weight:800;
    color:#fff;
    font-size:18px;
}

.blue{
    background:var(--secondary);
}

.gold{
    background:var(--gold);
}

.service-body{
    padding:24px;
}

.service-body ul{
    list-style:none;
}

.service-body ul li{
    margin-bottom:14px;
    color:var(--text);
    font-size:15px;
    display:flex;
    gap:12px;
    line-height:1.6;
}

.service-body ul li i{
    color:var(--gold);
    margin-top:4px;
}

/* PROPERTY TYPES */
.types-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
}

.type-card{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    border:1px solid var(--border);
    transition:.35s;
}

.type-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.type-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.type-content{
    padding:24px;
}

.type-content h4{
    font-size:22px;
    margin-bottom:10px;
    color:var(--primary);
}

.type-content p{
    color:var(--muted);
    line-height:1.8;
    font-size:15px;
}

/* WHY */
.why-section{
    background:linear-gradient(135deg,#06162E,#0B2B58);
    color:#fff;
}

.why-title{
    text-align:center;
    font-size:46px;
    margin-bottom:60px;
    font-family:'Outfit',sans-serif;
    font-weight:800;
}

.why-title span{
    color:var(--gold);
}

.why-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:26px;
}

.why-item{
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    border-radius:24px;
    padding:34px 28px;
    text-align:center;
}

.why-item i{
    width:74px;
    height:74px;
    background:rgba(214,168,79,.15);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 20px;
    font-size:28px;
    color:var(--gold);
}

.why-item h5{
    font-size:20px;
    margin-bottom:10px;
}

.why-item p{
    color:rgba(255,255,255,.72);
    line-height:1.7;
    font-size:14px;
}

/* PROCESS */
.process-wrapper{
    display:flex;
    flex-direction:column;
    gap:40px;
}

.process-row{
    display:grid;
    grid-template-columns:240px 1fr;
    gap:30px;
    align-items:center;
}

.process-label{
    background:var(--primary);
    color:#fff;
    padding:28px;
    border-radius:22px;
    font-size:24px;
    font-weight:800;
    text-align:center;
}

.process-label.gold-bg{
    background:var(--gold);
    color:#111;
}

.process-steps{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:18px;
}

.step{
    background:#fff;
    border:1px solid var(--border);
    border-radius:22px;
    padding:26px 18px;
    text-align:center;
}

.step span{
    width:46px;
    height:46px;
    border-radius:50%;
    background:var(--light);
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 16px;
    font-weight:800;
    color:var(--primary);
}

.step h6{
    font-size:15px;
    line-height:1.5;
}

/* LOCATIONS FAQ */
.bottom-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
}

.location-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
}

.location-card{
    border-radius:20px;
    overflow:hidden;
    border:1px solid var(--border);
    background:#fff;
}

.location-card img{
    width:100%;
    height:130px;
    object-fit:cover;
}

.location-card h5{
    padding:16px;
    font-size:15px;
    color:var(--primary);
}

.faq-item{
    border:1px solid var(--border);
    border-radius:18px;
    padding:22px;
    margin-bottom:18px;
    background:#fff;
}

.faq-item h5{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:17px;
}

/* CTA */
.cta-banner{
    background:
    linear-gradient(rgba(4,18,41,.9),rgba(4,18,41,.9)),
    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1800') center/cover;
    padding:70px 7%;
}

.cta-wrap{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:30px;
}

.cta-wrap h2{
    color:#fff;
    font-size:48px;
    line-height:1.1;
    font-family:'Outfit',sans-serif;
}

.cta-wrap h2 span{
    color:var(--gold);
}

.cta-wrap p{
    color:rgba(255,255,255,.75);
    margin-top:16px;
    line-height:1.8;
}

.cta-buttons{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
}

.whatsapp-btn{
    background:#16A34A;
    color:#fff;
}

@media(max-width:1200px){
    .types-grid,
    .why-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .process-steps{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:991px){

    .bs-hero-wrap,
    .about-grid,
    .bottom-grid,
    .process-row{
        grid-template-columns:1fr;
    }

    .types-grid,
    .why-grid,
    .location-grid,
    .service-grid{
        grid-template-columns:1fr;
    }

    .process-steps{
        grid-template-columns:repeat(2,1fr);
    }

    .cta-wrap{
        flex-direction:column;
        align-items:flex-start;
    }

    .bs-title{
        font-size:52px;
    }
}

@media(max-width:600px){

    .bs-title{
        font-size:42px;
    }

    .section-title,
    .why-title,
    .cta-wrap h2{
        font-size:34px;
    }

    .process-steps{
        grid-template-columns:1fr;
    }
}
</style>

<div class="buysell-page">

    <!-- HERO -->
    <section class="bs-hero">
        <div class="bs-hero-wrap">

            <div>
                <div class="hero-badge">
                    <i class="fa-solid fa-building"></i>
                    Trikon Holdings Limited
                </div>

                <h1 class="bs-title">
                    Property <br>
                    <span>Buy & Sell</span> <br>
                    with Confidence
                </h1>

                <p class="bs-desc">
                    Trusted real estate solutions for buying and selling flats, land, plots, and commercial properties across Bangladesh. Find the right property or connect with genuine buyers through our experienced team.
                </p>

                <div class="bs-actions">
                    <a href="#" class="btn-gold">
                        Buy Property
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="#" class="btn-dark">
                        Sell Property
                    </a>

                    <a href="{{ route('contact') }}" class="btn-dark">
                        Contact Us
                    </a>
                </div>
            </div>

            <div class="hero-form">
                <h3>Get In Touch</h3>
                <p>Fill out the form and our expert will contact you soon.</p>

                <div class="form-group">
                    <input type="text" placeholder="Your Name">
                </div>

                <div class="form-group">
                    <input type="text" placeholder="Phone Number">
                </div>

                <div class="form-group">
                    <input type="email" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <select>
                        <option>I am looking to</option>
                        <option>Buy Property</option>
                        <option>Sell Property</option>
                    </select>
                </div>

                <button class="submit-btn">
                    Submit Inquiry
                </button>
            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section class="section">
        <div class="about-grid">

            <div class="about-box">
                <h2 class="section-title">
                    About This <span>Service</span>
                </h2>

                <p class="section-desc">
                    At Trikon Holdings Limited, we simplify property buying and selling through a secure, transparent, and result-oriented process.
                    <br><br>
                    Whether you are searching for your dream home, a high-potential investment, or planning to sell your property at the best market value — our expert team ensures end-to-end support at every step.
                    <br><br>
                    We are committed to trust, transparency, legal clarity, and client satisfaction, making every transaction smooth and worry-free.
                </p>

                <div style="margin-top:35px">
                    <a href="#" class="btn-gold">
                        Learn More About Us
                    </a>
                </div>
            </div>

            <div>
                <h2 class="section-title">
                    Our Buy & Sell <span>Services</span>
                </h2>

                <div class="service-grid">

                    <div class="service-card">
                        <div class="service-head blue">
                            For Property Buyers
                        </div>

                        <div class="service-body">
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Verified property listings</li>
                                <li><i class="fa-solid fa-circle-check"></i> Residential & commercial options</li>
                                <li><i class="fa-solid fa-circle-check"></i> Prime land & plot opportunities</li>
                                <li><i class="fa-solid fa-circle-check"></i> Best market price negotiation</li>
                                <li><i class="fa-solid fa-circle-check"></i> Legal documentation support</li>
                                <li><i class="fa-solid fa-circle-check"></i> Investment consultation</li>
                            </ul>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-head gold">
                            For Property Sellers
                        </div>

                        <div class="service-body">
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Accurate property valuation</li>
                                <li><i class="fa-solid fa-circle-check"></i> Strategic marketing & promotion</li>
                                <li><i class="fa-solid fa-circle-check"></i> Access to qualified buyers</li>
                                <li><i class="fa-solid fa-circle-check"></i> Fast response & lead management</li>
                                <li><i class="fa-solid fa-circle-check"></i> Professional price negotiation</li>
                                <li><i class="fa-solid fa-circle-check"></i> Secure closing assistance</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- PROPERTY TYPES -->
    <section class="section" style="background:var(--light)">
        <h2 class="section-title" style="text-align:center">
            Property Types We Handle
        </h2>

        <div class="types-grid">

            <div class="type-card">
                <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1200">

                <div class="type-content">
                    <h4>Residential Properties</h4>
                    <p>
                        Luxury apartments, family flats, ready-to-move homes, and under-construction units.
                    </p>
                </div>
            </div>

            <div class="type-card">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200">

                <div class="type-content">
                    <h4>Commercial Properties</h4>
                    <p>
                        Office spaces, shops, showrooms, and business units in prime locations.
                    </p>
                </div>
            </div>

            <div class="type-card">
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1200">

                <div class="type-content">
                    <h4>Land & Plots</h4>
                    <p>
                        Residential plots, commercial plots, and long-term investment land.
                    </p>
                </div>
            </div>

            <div class="type-card">
                <img src="https://images.unsplash.com/photo-1559526324-593bc073d938?q=80&w=1200">

                <div class="type-content">
                    <h4>Investment Opportunities</h4>
                    <p>
                        High-growth potential properties designed for strong future returns.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- WHY -->
    <section class="section why-section">

        <h2 class="why-title">
            Why Choose <span>Trikon Holdings Limited</span>
        </h2>

        <div class="why-grid">

            <div class="why-item">
                <i class="fa-solid fa-shield-heart"></i>
                <h5>Trusted Service</h5>
                <p>Transparent and reliable real estate solutions for every client.</p>
            </div>

            <div class="why-item">
                <i class="fa-solid fa-building"></i>
                <h5>Verified Portfolio</h5>
                <p>Carefully verified properties across residential and commercial sectors.</p>
            </div>

            <div class="why-item">
                <i class="fa-solid fa-users"></i>
                <h5>Experienced Team</h5>
                <p>Professional industry experts with strong market understanding.</p>
            </div>

            <div class="why-item">
                <i class="fa-solid fa-clock"></i>
                <h5>Fast Execution</h5>
                <p>Quick property processing, negotiations, and transaction support.</p>
            </div>

        </div>

    </section>

    <!-- PROCESS -->
    <section class="section">

        <h2 class="section-title" style="text-align:center">
            How Our <span>Process Works</span>
        </h2>

        <div class="process-wrapper">

            <div class="process-row">

                <div class="process-label">
                    Property Buying Process
                </div>

                <div class="process-steps">

                    <div class="step">
                        <span>01</span>
                        <h6>Requirement Analysis</h6>
                    </div>

                    <div class="step">
                        <span>02</span>
                        <h6>Property Shortlisting</h6>
                    </div>

                    <div class="step">
                        <span>03</span>
                        <h6>Site Visit & Inspection</h6>
                    </div>

                    <div class="step">
                        <span>04</span>
                        <h6>Price Negotiation</h6>
                    </div>

                    <div class="step">
                        <span>05</span>
                        <h6>Legal Verification</h6>
                    </div>

                    <div class="step">
                        <span>06</span>
                        <h6>Final Purchase & Handover</h6>
                    </div>

                </div>

            </div>

            <div class="process-row">

                <div class="process-label gold-bg">
                    Property Selling Process
                </div>

                <div class="process-steps">

                    <div class="step">
                        <span>01</span>
                        <h6>Property Evaluation</h6>
                    </div>

                    <div class="step">
                        <span>02</span>
                        <h6>Market Assessment</h6>
                    </div>

                    <div class="step">
                        <span>03</span>
                        <h6>Strategic Promotion</h6>
                    </div>

                    <div class="step">
                        <span>04</span>
                        <h6>Buyer Engagement</h6>
                    </div>

                    <div class="step">
                        <span>05</span>
                        <h6>Offer Finalization</h6>
                    </div>

                    <div class="step">
                        <span>06</span>
                        <h6>Successful Deal Closure</h6>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- LOCATIONS + FAQ -->
    <section class="section" style="background:var(--light)">

        <div class="bottom-grid">

            <div>

                <h2 class="section-title">
                    Featured <span>Locations</span>
                </h2>

                <div class="location-grid">

                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1000">
                        <h5>Bashundhara Residential Area</h5>
                    </div>

                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?q=80&w=1000">
                        <h5>Purbachal New Town</h5>
                    </div>

                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=1000">
                        <h5>Uttara</h5>
                    </div>

                </div>

            </div>

            <div>

                <h2 class="section-title">
                    Frequently Asked <span>Questions</span>
                </h2>

                <div class="faq-item">
                    <h5>
                        Are all listed properties verified?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        Can you help sell my property faster?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        Do you assist with legal documentation?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        Is property investment safe through your company?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="cta-banner">

        <div class="cta-wrap">

            <div>
                <h2>
                    Looking To Buy <span>Or Sell Property?</span>
                </h2>

                <p>
                    Partner with Trikon Holdings Limited for a safe, transparent, and professional real estate experience.
                </p>
            </div>

            <div class="cta-buttons">

                <a href="tel:{{ $settings->phone ?? '+8801XXXXXXXXX' }}" class="btn-gold">
                    <i class="fa-solid fa-phone"></i>
                    Call Now
                </a>

                <a href="#" class="btn-gold whatsapp-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                    WhatsApp Us
                </a>

                <a href="{{ route('contact') }}" class="btn-dark">
                    Submit Inquiry
                </a>

            </div>

        </div>

    </section>

</div>

@endsection