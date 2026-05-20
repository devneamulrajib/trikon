@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

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

.jv-page{
    overflow:hidden;
}

/* HERO */
.jv-hero{
    position:relative;
    padding:90px 7%;
    min-height:760px;
    display:flex;
    align-items:center;
    background:
    linear-gradient(90deg, rgba(4,18,41,.96) 0%, rgba(4,18,41,.88) 45%, rgba(4,18,41,.35) 100%),
    url('https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1800') center center/cover no-repeat;
}

.jv-hero-wrap{
    width:100%;
    display:grid;
    grid-template-columns:1.1fr 1fr;
    gap:60px;
    align-items:center;
}

.hero-tag{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    border-radius:100px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.1);
    color:#fff;
    margin-bottom:28px;
    font-size:13px;
    letter-spacing:.5px;
}

.hero-tag i{
    color:var(--gold);
}

.jv-title{
    font-family:'Outfit',sans-serif;
    font-size:74px;
    line-height:1.05;
    font-weight:800;
    color:#fff;
    margin-bottom:24px;
    letter-spacing:-2px;
}

.jv-title span{
    color:var(--gold);
}

.jv-desc{
    max-width:650px;
    color:rgba(255,255,255,.8);
    line-height:1.9;
    font-size:17px;
    margin-bottom:35px;
}

.hero-list{
    list-style:none;
    margin-bottom:40px;
}

.hero-list li{
    display:flex;
    align-items:center;
    gap:14px;
    color:#fff;
    margin-bottom:18px;
    font-size:15px;
}

.hero-list li i{
    color:var(--gold);
}

.hero-actions{
    display:flex;
    flex-wrap:wrap;
    gap:18px;
}

.btn-gold{
    background:var(--gold);
    color:#111;
    padding:16px 32px;
    border-radius:12px;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}

.btn-gold:hover{
    transform:translateY(-3px);
}

.btn-dark{
    border:1px solid rgba(255,255,255,.15);
    background:rgba(255,255,255,.06);
    backdrop-filter:blur(8px);
    color:#fff;
    padding:16px 32px;
    border-radius:12px;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}

.btn-dark:hover{
    background:#fff;
    color:#111;
}

.hero-image{
    position:relative;
}

.hero-image img{
    width:100%;
    border-radius:30px;
    box-shadow:0 25px 60px rgba(0,0,0,.35);
}

/* SECTION */
.section{
    padding:90px 7%;
}

.section-title{
    font-size:48px;
    line-height:1.1;
    color:var(--primary);
    font-family:'Outfit',sans-serif;
    font-weight:800;
    margin-bottom:18px;
}

.section-title span{
    color:var(--gold);
}

.section-desc{
    color:var(--muted);
    line-height:1.9;
    font-size:16px;
}

/* WHY */
.why-grid{
    margin-top:60px;
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:24px;
}

.why-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:24px;
    padding:34px 24px;
    text-align:center;
    transition:.35s;
}

.why-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.why-card i{
    width:78px;
    height:78px;
    background:rgba(214,168,79,.12);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 20px;
    color:var(--gold);
    font-size:30px;
}

.why-card h4{
    font-size:20px;
    color:var(--primary);
    margin-bottom:14px;
}

.why-card p{
    color:var(--muted);
    line-height:1.8;
    font-size:14px;
}

/* PROCESS */
.process-section{
    background:
    linear-gradient(rgba(4,18,41,.94),rgba(4,18,41,.94)),
    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1800') center/cover;
}

.process-title{
    text-align:center;
    color:#fff;
    font-size:50px;
    margin-bottom:70px;
    font-family:'Outfit',sans-serif;
    font-weight:800;
}

.process-title span{
    color:var(--gold);
}

.process-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:20px;
}

.process-card{
    text-align:center;
    color:#fff;
    position:relative;
}

.process-number{
    width:74px;
    height:74px;
    border-radius:50%;
    border:3px solid var(--gold);
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 24px;
    font-size:28px;
    font-weight:800;
    color:var(--gold);
}

.process-card h5{
    font-size:18px;
    line-height:1.5;
    margin-bottom:12px;
}

.process-card p{
    color:rgba(255,255,255,.72);
    line-height:1.8;
    font-size:14px;
}

/* BENEFITS */
.benefits-wrapper{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}

.benefit-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:28px;
    overflow:hidden;
}

.benefit-top{
    height:260px;
    overflow:hidden;
}

.benefit-top img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.benefit-content{
    padding:34px;
}

.benefit-content h3{
    font-size:34px;
    color:var(--primary);
    margin-bottom:24px;
    font-family:'Outfit',sans-serif;
}

.benefit-list{
    list-style:none;
}

.benefit-list li{
    display:flex;
    gap:14px;
    margin-bottom:18px;
    line-height:1.7;
    font-size:15px;
}

.benefit-list li i{
    color:var(--gold);
    margin-top:4px;
}

/* DOCUMENT FAQ */
.bottom-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}

.document-box{
    background:linear-gradient(135deg,#071C3C,#0D2C5A);
    border-radius:28px;
    padding:40px;
    color:#fff;
}

.document-box h3{
    font-size:36px;
    margin-bottom:28px;
    font-family:'Outfit',sans-serif;
}

.document-list{
    list-style:none;
}

.document-list li{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:20px;
    padding-bottom:16px;
    border-bottom:1px solid rgba(255,255,255,.08);
    font-size:15px;
}

.document-list li i{
    color:var(--gold);
}

.faq-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:28px;
    padding:40px;
}

.faq-box h3{
    font-size:36px;
    margin-bottom:30px;
    color:var(--primary);
    font-family:'Outfit',sans-serif;
}

.faq-item{
    border:1px solid var(--border);
    border-radius:16px;
    padding:22px;
    margin-bottom:18px;
}

.faq-item h5{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:16px;
}

/* CTA */
.cta-banner{
    background:
    linear-gradient(rgba(4,18,41,.92),rgba(4,18,41,.92)),
    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1800') center/cover;
    padding:70px 7%;
}

.cta-wrap{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:40px;
}

.cta-wrap h2{
    color:#fff;
    font-size:52px;
    line-height:1.1;
    font-family:'Outfit',sans-serif;
}

.cta-wrap h2 span{
    color:var(--gold);
}

.cta-wrap p{
    color:rgba(255,255,255,.75);
    line-height:1.9;
    margin-top:18px;
}

.cta-info{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
}

.info-card{
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:24px;
    color:#fff;
}

.info-card i{
    color:var(--gold);
    font-size:24px;
    margin-bottom:16px;
}

.info-card h5{
    margin-bottom:8px;
    font-size:16px;
}

.info-card p{
    margin:0;
    font-size:14px;
    color:rgba(255,255,255,.7);
    line-height:1.8;
}

/* RESPONSIVE */
@media(max-width:1300px){

    .why-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .process-grid{
        grid-template-columns:repeat(4,1fr);
    }
}

@media(max-width:991px){

    .jv-hero-wrap,
    .benefits-wrapper,
    .bottom-grid,
    .cta-wrap{
        grid-template-columns:1fr;
        flex-direction:column;
    }

    .why-grid,
    .process-grid,
    .cta-info{
        grid-template-columns:1fr 1fr;
    }

    .jv-title{
        font-size:54px;
    }

    .section-title,
    .process-title,
    .cta-wrap h2{
        font-size:38px;
    }
}

@media(max-width:600px){

    .why-grid,
    .process-grid,
    .cta-info{
        grid-template-columns:1fr;
    }

    .jv-title{
        font-size:42px;
    }

    .section-title,
    .process-title,
    .cta-wrap h2{
        font-size:32px;
    }

    .hero-actions{
        flex-direction:column;
    }
}
</style>

<div class="jv-page">

    <!-- HERO -->
    <section class="jv-hero">

        <div class="jv-hero-wrap">

            <div>

                <div class="hero-tag">
                    <i class="fa-solid fa-building"></i>
                    Joint Venture Development
                </div>

                <h1 class="jv-title">
                    Turn Your Land Into <span>Profitable Asset</span>
                </h1>

                <p class="jv-desc">
                    With modern design, secure agreements, and an experienced team, we transform your land into a high-value real estate project with maximum profitability and transparent partnership.
                </p>

                <ul class="hero-list">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        No investment required from landowners
                    </li>

                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Transparent & secure agreements
                    </li>

                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Timely project delivery
                    </li>

                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Maximum land utilization ensured
                    </li>
                </ul>

                <div class="hero-actions">

                    <a href="#" class="btn-gold">
                        <i class="fa-solid fa-phone"></i>
                        Free Consultation
                    </a>

                    <a href="#" class="btn-dark">
                        <i class="fa-solid fa-comments"></i>
                        Discuss Your Land
                    </a>

                    <a href="#" class="btn-dark">
                        <i class="fa-solid fa-file-signature"></i>
                        Get JV Proposal
                    </a>

                </div>

            </div>

            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1400" alt="">
            </div>

        </div>

    </section>

    <!-- WHY CHOOSE -->
    <section class="section">

        <div style="text-align:center">
            <h2 class="section-title">
                Why Choose Us For <span>Joint Venture</span>
            </h2>

            <p class="section-desc">
                We ensure transparent agreements, professional execution, and maximum profitability for landowners.
            </p>
        </div>

        <div class="why-grid">

            <div class="why-card">
                <i class="fa-solid fa-users"></i>
                <h4>Experienced Team</h4>
                <p>Managed by experienced architects, engineers, and development experts.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h4>Transparent Agreement</h4>
                <p>Secure and legally protected agreements for complete peace of mind.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-chart-line"></i>
                <h4>Maximum Land Value</h4>
                <p>We maximize your land potential through smart planning and development.</p>
            </div>

            <div class="why-card">
                <i class="fa-regular fa-clock"></i>
                <h4>Timely Delivery</h4>
                <p>Projects are delivered within schedule while maintaining premium quality.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-headset"></i>
                <h4>End-to-End Support</h4>
                <p>From planning to handover, we handle the entire development process.</p>
            </div>

        </div>

    </section>

    <!-- PROCESS -->
    <section class="section process-section">

        <h2 class="process-title">
            How Our <span>Joint Venture Process</span> Works
        </h2>

        <div class="process-grid">

            <div class="process-card">
                <div class="process-number">1</div>
                <h5>Land Evaluation</h5>
                <p>We assess location, land size, and development potential.</p>
            </div>

            <div class="process-card">
                <div class="process-number">2</div>
                <h5>Initial Discussion</h5>
                <p>Meeting with landowners to discuss project feasibility.</p>
            </div>

            <div class="process-card">
                <div class="process-number">3</div>
                <h5>Feasibility Study</h5>
                <p>Analyzing project cost, profitability, and development plan.</p>
            </div>

            <div class="process-card">
                <div class="process-number">4</div>
                <h5>Agreement Signing</h5>
                <p>Secure and transparent joint venture agreement finalized.</p>
            </div>

            <div class="process-card">
                <div class="process-number">5</div>
                <h5>Design & Approval</h5>
                <p>Architectural design and authority approvals completed.</p>
            </div>

            <div class="process-card">
                <div class="process-number">6</div>
                <h5>Construction</h5>
                <p>Professional project execution with quality assurance.</p>
            </div>

            <div class="process-card">
                <div class="process-number">7</div>
                <h5>Profit Sharing</h5>
                <p>Units or profits distributed according to agreement terms.</p>
            </div>

        </div>

    </section>

    <!-- BENEFITS -->
    <section class="section" style="background:var(--light)">

        <div class="benefits-wrapper">

            <div class="benefit-card">

                <div class="benefit-top">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200">
                </div>

                <div class="benefit-content">

                    <h3>Benefits For Land Owners</h3>

                    <ul class="benefit-list">

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Development without investment
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Modern and premium construction quality
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Increased land value and profitability
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Profitable flats or commercial units
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Hassle-free project management
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Safe and legally transparent agreement
                        </li>

                    </ul>

                </div>

            </div>

            <div class="benefit-card">

                <div class="benefit-top">
                    <img src="https://images.unsplash.com/photo-1556740749-887f6717d7e4?q=80&w=1200">
                </div>

                <div class="benefit-content">

                    <h3>Suitable Land Criteria</h3>

                    <ul class="benefit-list">

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Prime location land
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Main road-facing property
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Residential or commercial zoning
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Minimum 3 katha or more
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Clear legal ownership
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Suitable for modern development planning
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>

    <!-- DOCUMENTS + FAQ -->
    <section class="section">

        <div class="bottom-grid">

            <div class="document-box">

                <h3>Required Documents</h3>

                <ul class="document-list">

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Title Deed
                    </li>

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Khatian (Record of Rights)
                    </li>

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Mutation Certificate
                    </li>

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Tax Clearance Certificate
                    </li>

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Owner's NID Copy
                    </li>

                    <li>
                        <i class="fa-solid fa-file-lines"></i>
                        Land Map / Survey Documents
                    </li>

                </ul>

            </div>

            <div class="faq-box">

                <h3>Frequently Asked Questions</h3>

                <div class="faq-item">
                    <h5>
                        Who bears the construction cost in a Joint Venture?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        How is profit shared?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        How long does a project take?
                        <i class="fa-solid fa-plus"></i>
                    </h5>
                </div>

                <div class="faq-item">
                    <h5>
                        Is the agreement legally secure?
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
                    Let's Build <span>Together</span>
                </h2>

                <p>
                    Maximize the value of your land with a secure and profitable joint venture partnership through Trikon Holdings Limited.
                </p>

                <div style="margin-top:32px">
                    <a href="#" class="btn-gold">
                        Get Free Consultation
                    </a>
                </div>

            </div>

            <div class="cta-info">

                <div class="info-card">
                    <i class="fa-solid fa-phone"></i>
                    <h5>Phone Number</h5>
                    <p>+8801633530231</p>
                </div>

                <div class="info-card">
                    <i class="fa-solid fa-envelope"></i>
                    <h5>Email Address</h5>
                    <p>info@trikonltd.com</p>
                </div>

                <div class="info-card">
                    <i class="fa-brands fa-whatsapp"></i>
                    <h5>WhatsApp</h5>
                    <p>+8801633530231</p>
                </div>

            </div>

        </div>

    </section>

</div>

@endsection