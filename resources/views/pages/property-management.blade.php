@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

:root{
    --navy:#071B3B;
    --navy2:#0B2857;
    --gold:#D4A64A;
    --gold2:#E5BF74;
    --white:#ffffff;
    --soft:#F8F8F8;
    --text:#6B7280;
    --dark:#111827;
    --line:#EAEAEA;
    --shadow:0 20px 60px rgba(0,0,0,.08);
}

body{
    overflow-x:hidden;
    background:var(--soft);
}

.pm-page{
    font-family:'Manrope',sans-serif;
    color:var(--dark);
}

/* HERO */

.pm-hero{
    min-height:88vh;
    position:relative;
    overflow:hidden;
    display:flex;
    align-items:center;
}

.pm-hero img{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
}

.pm-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(90deg, rgba(5,18,43,.92) 0%, rgba(5,18,43,.84) 40%, rgba(5,18,43,.25) 100%);
}

.pm-hero-content{
    position:relative;
    z-index:2;
    width:100%;
    max-width:1400px;
    margin:auto;
    padding:160px 7% 100px;
}

.pm-tag{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:12px 20px;
    border-radius:100px;
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,.08);
    color:#fff;
    font-size:.75rem;
    font-weight:700;
    letter-spacing:.16em;
    text-transform:uppercase;
    margin-bottom:28px;
}

.pm-tag::before{
    content:'';
    width:8px;
    height:8px;
    border-radius:50%;
    background:var(--gold);
}

.pm-hero h1{
    font-size:clamp(3.5rem,8vw,7rem);
    line-height:.92;
    font-weight:800;
    color:#fff;
    max-width:700px;
    letter-spacing:-.05em;
}

.pm-hero h1 span{
    display:block;
    color:var(--gold2);
}

.pm-hero p{
    margin-top:30px;
    max-width:540px;
    color:rgba(255,255,255,.78);
    line-height:2;
    font-size:1rem;
}

.pm-hero-btns{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    margin-top:40px;
}

.pm-btn{
    padding:18px 34px;
    border-radius:14px;
    text-decoration:none;
    font-size:.9rem;
    font-weight:700;
    transition:.35s ease;
    display:inline-flex;
    align-items:center;
    gap:12px;
}

.pm-btn-primary{
    background:var(--gold);
    color:#fff;
    box-shadow:0 15px 35px rgba(212,166,74,.28);
}

.pm-btn-primary:hover{
    transform:translateY(-3px);
    background:#c3922f;
}

.pm-btn-outline{
    border:1px solid rgba(255,255,255,.2);
    color:#fff;
    backdrop-filter:blur(10px);
    background:rgba(255,255,255,.05);
}

.pm-btn-outline:hover{
    transform:translateY(-3px);
    border-color:var(--gold2);
}

/* SECTION */

.pm-section{
    padding:100px 7%;
}

.pm-container{
    max-width:1400px;
    margin:auto;
}

/* ABOUT */

.pm-about{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:60px;
    align-items:center;
}

@media(max-width:991px){
    .pm-about{
        grid-template-columns:1fr;
    }
}

.pm-small{
    color:var(--gold);
    font-size:.82rem;
    font-weight:700;
    letter-spacing:.16em;
    text-transform:uppercase;
    margin-bottom:18px;
}

.pm-title{
    font-size:clamp(2.5rem,5vw,4rem);
    line-height:1;
    font-weight:800;
    letter-spacing:-.04em;
    margin-bottom:24px;
}

.pm-title span{
    color:var(--gold);
}

.pm-text{
    color:var(--text);
    line-height:2;
    font-size:1rem;
}

.pm-quote{
    margin-top:30px;
    padding:24px 28px;
    border-radius:20px;
    background:#fff;
    border:1px solid var(--line);
    display:flex;
    gap:18px;
    align-items:flex-start;
    box-shadow:var(--shadow);
}

.pm-quote i{
    color:var(--gold);
    font-size:1.2rem;
    margin-top:4px;
}

.pm-quote p{
    color:#555;
    line-height:1.9;
    font-size:.95rem;
}

.pm-about-image{
    position:relative;
}

.pm-about-image img{
    width:100%;
    border-radius:30px;
    height:430px;
    object-fit:cover;
    box-shadow:var(--shadow);
}

/* SERVICES */

.pm-service-head{
    text-align:center;
    margin-bottom:60px;
}

.pm-service-head h2{
    font-size:clamp(2.5rem,5vw,4rem);
    font-weight:800;
    line-height:1;
    margin-top:14px;
}

.pm-service-head h2 span{
    color:var(--gold);
}

.pm-cards{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:28px;
}

@media(max-width:991px){
    .pm-cards{
        grid-template-columns:1fr;
    }
}

.pm-card{
    background:#fff;
    border-radius:30px;
    padding:42px 36px;
    border:1px solid #eee;
    transition:.35s ease;
    position:relative;
    overflow:hidden;
}

.pm-card:hover{
    transform:translateY(-8px);
    box-shadow:var(--shadow);
}

.pm-icon{
    width:76px;
    height:76px;
    border-radius:24px;
    background:rgba(212,166,74,.12);
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--gold);
    font-size:1.5rem;
    margin-bottom:28px;
}

.pm-card h3{
    font-size:1.6rem;
    line-height:1.2;
    margin-bottom:20px;
}

.pm-card ul{
    list-style:none;
}

.pm-card ul li{
    display:flex;
    gap:12px;
    margin-bottom:14px;
    color:#666;
    font-size:.93rem;
    line-height:1.7;
}

.pm-card ul li i{
    color:var(--gold);
    font-size:.72rem;
    margin-top:5px;
}

.pm-link{
    margin-top:28px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    color:var(--dark);
    text-decoration:none;
    font-weight:700;
    transition:.3s ease;
}

.pm-link:hover{
    gap:16px;
    color:var(--gold);
}

/* BENEFITS */

.pm-benefits{
    background:
    linear-gradient(rgba(7,27,59,.92), rgba(7,27,59,.92)),
    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1800');
    background-size:cover;
    background-position:center;
    border-radius:36px;
    padding:80px;
    margin-top:30px;
}

@media(max-width:991px){
    .pm-benefits{
        padding:45px 28px;
    }
}

.pm-benefit-grid{
    display:grid;
    grid-template-columns:350px 1fr;
    gap:60px;
}

@media(max-width:991px){
    .pm-benefit-grid{
        grid-template-columns:1fr;
    }
}

.pm-benefit-title h2{
    color:#fff;
    font-size:clamp(2.5rem,5vw,4rem);
    line-height:1;
    margin-top:14px;
}

.pm-benefit-title h2 span{
    color:var(--gold2);
}

.pm-benefit-items{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px;
}

@media(max-width:991px){
    .pm-benefit-items{
        grid-template-columns:1fr;
    }
}

.pm-benefit-item{
    display:flex;
    gap:16px;
}

.pm-benefit-item i{
    width:52px;
    height:52px;
    border-radius:18px;
    background:rgba(255,255,255,.08);
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--gold2);
    flex-shrink:0;
}

.pm-benefit-item h4{
    color:#fff;
    margin-bottom:8px;
    font-size:1rem;
}

.pm-benefit-item p{
    color:rgba(255,255,255,.65);
    line-height:1.8;
    font-size:.9rem;
}

/* CLIENTS */

.pm-client-wrap{
    display:grid;
    grid-template-columns:1fr .9fr;
    gap:60px;
    align-items:center;
}

@media(max-width:991px){
    .pm-client-wrap{
        grid-template-columns:1fr;
    }
}

.pm-client-icons{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:20px;
    margin-top:40px;
}

@media(max-width:991px){
    .pm-client-icons{
        grid-template-columns:repeat(2,1fr);
    }
}

.pm-client{
    text-align:center;
}

.pm-client-icon{
    width:78px;
    height:78px;
    margin:auto auto 16px;
    border-radius:24px;
    background:#fff;
    border:1px solid #eee;
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--navy);
    font-size:1.5rem;
    box-shadow:var(--shadow);
}

.pm-client p{
    font-size:.9rem;
    color:#555;
    line-height:1.7;
}

.pm-client-image img{
    width:100%;
    border-radius:30px;
    height:400px;
    object-fit:cover;
    box-shadow:var(--shadow);
}

/* OPPORTUNITY */

.pm-opportunity{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:60px;
    align-items:center;
    margin-top:80px;
}

@media(max-width:991px){
    .pm-opportunity{
        grid-template-columns:1fr;
    }
}

.pm-opportunity img{
    width:100%;
    border-radius:30px;
    height:420px;
    object-fit:cover;
    box-shadow:var(--shadow);
}

.pm-opportunity ul{
    list-style:none;
    margin-top:28px;
}

.pm-opportunity ul li{
    display:flex;
    gap:14px;
    margin-bottom:16px;
    color:#555;
    line-height:1.8;
}

.pm-opportunity ul li i{
    color:var(--gold);
    margin-top:5px;
}

/* REVENUE */

.pm-revenue{
    background:#fff;
    border-radius:36px;
    padding:70px;
    margin-top:40px;
    box-shadow:var(--shadow);
}

@media(max-width:991px){
    .pm-revenue{
        padding:40px 28px;
    }
}

.pm-revenue-head{
    text-align:center;
    margin-bottom:50px;
}

.pm-revenue-head h2{
    font-size:clamp(2.5rem,5vw,4rem);
    line-height:1;
    font-weight:800;
}

.pm-revenue-head h2 span{
    color:var(--gold);
}

.pm-revenue-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
}

@media(max-width:991px){
    .pm-revenue-grid{
        grid-template-columns:1fr;
    }
}

.pm-revenue-card{
    padding:34px 28px;
    border-radius:24px;
    border:1px solid #eee;
    transition:.35s ease;
}

.pm-revenue-card:hover{
    transform:translateY(-6px);
    box-shadow:var(--shadow);
}

.pm-revenue-card.active{
    background:var(--navy);
    border:none;
}

.pm-revenue-card.active h3,
.pm-revenue-card.active p,
.pm-revenue-card.active i{
    color:#fff;
}

.pm-revenue-card i{
    font-size:2rem;
    color:var(--gold);
    margin-bottom:20px;
}

.pm-revenue-card h3{
    font-size:1.2rem;
    margin-bottom:10px;
}

.pm-revenue-card p{
    color:#666;
    line-height:1.8;
    font-size:.92rem;
}

/* CTA */

.pm-cta{
    background:linear-gradient(90deg, var(--navy), var(--navy2));
    border-radius:36px;
    padding:70px;
    margin-top:80px;
    color:#fff;
}

@media(max-width:991px){
    .pm-cta{
        padding:45px 28px;
    }
}

.pm-cta-wrap{
    display:grid;
    grid-template-columns:1fr auto;
    gap:40px;
    align-items:center;
}

@media(max-width:991px){
    .pm-cta-wrap{
        grid-template-columns:1fr;
    }
}

.pm-cta h2{
    font-size:clamp(2.5rem,5vw,4rem);
    line-height:1;
    margin-bottom:20px;
}

.pm-cta h2 span{
    color:var(--gold2);
}

.pm-cta p{
    color:rgba(255,255,255,.7);
    line-height:2;
    max-width:700px;
}

.pm-contact{
    display:flex;
    gap:30px;
    flex-wrap:wrap;
    margin-top:30px;
}

.pm-contact-item{
    display:flex;
    gap:14px;
    align-items:center;
}

.pm-contact-item i{
    width:52px;
    height:52px;
    border-radius:18px;
    background:rgba(255,255,255,.08);
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--gold2);
}

.pm-contact-item span{
    display:block;
    font-size:.82rem;
    color:rgba(255,255,255,.5);
    margin-bottom:4px;
}

.pm-contact-item p{
    margin:0;
    color:#fff;
    font-size:.95rem;
}

.reveal{
    opacity:0;
    transform:translateY(50px);
    transition:1s cubic-bezier(.19,1,.22,1);
}

.reveal.active{
    opacity:1;
    transform:none;
}

</style>

<div class="pm-page">

    <!-- HERO -->

    <section class="pm-hero">

        <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=2000" alt="Property Management">

        <div class="pm-overlay"></div>

        <div class="pm-hero-content reveal">

            <div class="pm-tag">
                Trikon Property Management
            </div>

            <h1>
                Professional
                <span>Management.</span>
                <span>Maximum Peace</span>
                of Mind.
            </h1>

            <p>
                We take care of your property like it’s our own. You enjoy the returns without the stress.
            </p>

            <div class="pm-hero-btns">

                <a href="#services" class="pm-btn pm-btn-primary">
                    Our Services
                    <i class="fas fa-arrow-right"></i>
                </a>

                <a href="tel:{{ $settings->phone ?? '+8801633530231' }}" class="pm-btn pm-btn-outline">
                    <i class="fas fa-phone"></i>
                    {{ $settings->phone ?? '+8801633530231' }}
                </a>

            </div>

        </div>

    </section>

    <section class="pm-section">

        <div class="pm-container">

            <!-- ABOUT -->

            <div class="pm-about reveal">

                <div>

                    <div class="pm-small">
                        About The Service
                    </div>

                    <h2 class="pm-title">
                        What is Property <span>Management?</span>
                    </h2>

                    <p class="pm-text">
                        Property Management is a professional service where a real estate company manages residential, commercial, or investment properties on behalf of the owner. It ensures that the property remains profitable, well-maintained, legally compliant, and efficiently operated.
                    </p>

                    <div class="pm-quote">

                        <i class="fas fa-house-circle-check"></i>

                        <p>
                            This service is ideal for property owners who want hassle-free ownership while maximizing returns on their assets.
                        </p>

                    </div>

                </div>

                <div class="pm-about-image">
                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1600" alt="Luxury Interior">
                </div>

            </div>

            <!-- SERVICES -->

            <div class="pm-section" id="services">

                <div class="pm-service-head reveal">

                    <div class="pm-small">
                        What We Offer
                    </div>

                    <h2>
                        Core Property Management
                        <span>Services</span>
                    </h2>

                </div>

                <div class="pm-cards">

                    <!-- CARD -->

                    <div class="pm-card reveal">

                        <div class="pm-icon">
                            <i class="fas fa-house"></i>
                        </div>

                        <h3>
                            Residential Property Management
                        </h3>

                        <ul>
                            <li><i class="fas fa-check"></i> Tenant sourcing and screening</li>
                            <li><i class="fas fa-check"></i> Lease agreement preparation</li>
                            <li><i class="fas fa-check"></i> Monthly rent collection</li>
                            <li><i class="fas fa-check"></i> Maintenance coordination</li>
                            <li><i class="fas fa-check"></i> Utility bill supervision</li>
                            <li><i class="fas fa-check"></i> Move-in / move-out inspections</li>
                            <li><i class="fas fa-check"></i> Owner reporting</li>
                        </ul>

                        <a href="#" class="pm-link">
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                    <!-- CARD -->

                    <div class="pm-card reveal">

                        <div class="pm-icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <h3>
                            Commercial Property Management
                        </h3>

                        <ul>
                            <li><i class="fas fa-check"></i> Office / showroom tenant management</li>
                            <li><i class="fas fa-check"></i> Lease renewals and negotiations</li>
                            <li><i class="fas fa-check"></i> Service charge collection</li>
                            <li><i class="fas fa-check"></i> Common area maintenance</li>
                            <li><i class="fas fa-check"></i> Occupancy management</li>
                            <li><i class="fas fa-check"></i> Vendor coordination</li>
                        </ul>

                        <a href="#" class="pm-link">
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                    <!-- CARD -->

                    <div class="pm-card reveal">

                        <div class="pm-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <h3>
                            Investment Property Management
                        </h3>

                        <ul>
                            <li><i class="fas fa-check"></i> ROI-focused rental strategy</li>
                            <li><i class="fas fa-check"></i> Vacancy reduction planning</li>
                            <li><i class="fas fa-check"></i> Asset performance monitoring</li>
                            <li><i class="fas fa-check"></i> Property appreciation consultation</li>
                            <li><i class="fas fa-check"></i> Exit / resale planning</li>
                        </ul>

                        <a href="#" class="pm-link">
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

            <!-- BENEFITS -->

            <div class="pm-benefits reveal">

                <div class="pm-benefit-grid">

                    <div class="pm-benefit-title">

                        <div class="pm-small">
                            Why Property Owners Need This Service
                        </div>

                        <h2>
                            <span>Benefits</span>
                        </h2>

                    </div>

                    <div class="pm-benefit-items">

                        <div class="pm-benefit-item">
                            <i class="fas fa-coins"></i>
                            <div>
                                <h4>Passive income</h4>
                                <p>Without daily involvement</p>
                            </div>
                        </div>

                        <div class="pm-benefit-item">
                            <i class="fas fa-user-shield"></i>
                            <div>
                                <h4>Reliable tenant management</h4>
                                <p>Professional tenant support</p>
                            </div>
                        </div>

                        <div class="pm-benefit-item">
                            <i class="fas fa-wallet"></i>
                            <div>
                                <h4>Timely rent collection</h4>
                                <p>Consistent monthly cash flow</p>
                            </div>
                        </div>

                        <div class="pm-benefit-item">
                            <i class="fas fa-tools"></i>
                            <div>
                                <h4>Reduced maintenance stress</h4>
                                <p>We manage repairs & issues</p>
                            </div>
                        </div>

                        <div class="pm-benefit-item">
                            <i class="fas fa-building-shield"></i>
                            <div>
                                <h4>Better asset preservation</h4>
                                <p>Protecting long-term value</p>
                            </div>
                        </div>

                        <div class="pm-benefit-item">
                            <i class="fas fa-file-contract"></i>
                            <div>
                                <h4>Professional documentation</h4>
                                <p>Proper legal and lease handling</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- CLIENTS -->

            <div class="pm-section">

                <div class="pm-client-wrap reveal">

                    <div>

                        <div class="pm-small">
                            Ideal Clients
                        </div>

                        <h2 class="pm-title">
                            Ideal Clients for
                            <span>This Service</span>
                        </h2>

                        <div class="pm-client-icons">

                            <div class="pm-client">
                                <div class="pm-client-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <p>NRB / Overseas property owners</p>
                            </div>

                            <div class="pm-client">
                                <div class="pm-client-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <p>Busy professionals</p>
                            </div>

                            <div class="pm-client">
                                <div class="pm-client-icon">
                                    <i class="fas fa-city"></i>
                                </div>
                                <p>Multi-property investors</p>
                            </div>

                            <div class="pm-client">
                                <div class="pm-client-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <p>Commercial property owners</p>
                            </div>

                            <div class="pm-client">
                                <div class="pm-client-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <p>Landlords seeking professional management</p>
                            </div>

                        </div>

                    </div>

                    <div class="pm-client-image">
                        <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1600" alt="Office">
                    </div>

                </div>

                <!-- OPPORTUNITY -->

                <div class="pm-opportunity reveal">

                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1600" alt="Buildings">

                    <div>

                        <div class="pm-small">
                            Strategic Opportunity
                        </div>

                        <h2 class="pm-title">
                            Opportunity for
                            <span>Trikon Holdings Limited</span>
                        </h2>

                        <p class="pm-text">
                            Launching a dedicated Property Management Division can position Trikon Holdings as a full-service real estate company, not only selling properties but also managing them long-term.
                        </p>

                        <ul>
                            <li><i class="fas fa-check"></i> Recurring monthly revenue</li>
                            <li><i class="fas fa-check"></i> Stronger client retention</li>
                            <li><i class="fas fa-check"></i> Higher brand trust</li>
                            <li><i class="fas fa-check"></i> Cross-selling opportunities</li>
                        </ul>

                    </div>

                </div>

            </div>

            <!-- REVENUE -->

            <div class="pm-revenue reveal">

                <div class="pm-revenue-head">

                    <div class="pm-small">
                        Revenue Structure
                    </div>

                    <h2>
                        Recommended
                        <span>Revenue Model</span>
                    </h2>

                </div>

                <div class="pm-revenue-grid">

                    <div class="pm-revenue-card">

                        <i class="fas fa-house"></i>

                        <h3>Residential Flat</h3>

                        <p>
                            Monthly fixed fee or % of rent
                        </p>

                    </div>

                    <div class="pm-revenue-card">

                        <i class="fas fa-building"></i>

                        <h3>Commercial Unit</h3>

                        <p>
                            Custom management contract
                        </p>

                    </div>

                    <div class="pm-revenue-card">

                        <i class="fas fa-city"></i>

                        <h3>Building Management</h3>

                        <p>
                            Annual service package
                        </p>

                    </div>

                    <div class="pm-revenue-card active">

                        <i class="fas fa-crown"></i>

                        <h3>Investor Portfolio</h3>

                        <p>
                            Premium advisory plan
                        </p>

                    </div>

                </div>

            </div>

            <!-- CTA -->

            <div class="pm-cta reveal">

                <div class="pm-cta-wrap">

                    <div>

                        <div class="pm-small">
                            Let Us Manage Your Property
                        </div>

                        <h2>
                            You Enjoy The
                            <span>Benefits.</span>
                        </h2>

                        <p>
                            Contact us today and experience stress-free property ownership with professional management solutions tailored for you.
                        </p>

                        <div class="pm-contact">

                            <div class="pm-contact-item">

                                <i class="fas fa-phone"></i>

                                <div>
                                    <span>Call Us</span>
                                    <p>{{ $settings->phone ?? '+8801633530231' }}</p>
                                </div>

                            </div>

                            <div class="pm-contact-item">

                                <i class="fas fa-envelope"></i>

                                <div>
                                    <span>Email Us</span>
                                    <p>info@trikonholdings.com</p>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div>

                        <a href="{{ route('contact') }}" class="pm-btn pm-btn-primary">
                            Get a Free Consultation
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<script>

const reveals = document.querySelectorAll('.reveal');

window.addEventListener('scroll', () => {

    reveals.forEach((el) => {

        const top = el.getBoundingClientRect().top;

        if(top < window.innerHeight - 80){
            el.classList.add('active');
        }

    });

});

</script>

@endsection