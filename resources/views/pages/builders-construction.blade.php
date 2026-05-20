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
    background:#fff;
    color:var(--text);
}

.construction-page{
    overflow:hidden;
}

/* HERO */
.construction-hero{
    position:relative;
    padding:90px 7%;
    background:
    linear-gradient(90deg, rgba(4,18,41,.90) 0%, rgba(4,18,41,.65) 45%, rgba(4,18,41,.20) 100%),
    url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=1800') center center/cover no-repeat;
}

.hero-wrap{
    display:grid;
    grid-template-columns:1.1fr 430px;
    gap:60px;
    align-items:center;
}

.hero-tag{
    display:inline-block;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.1);
    padding:10px 18px;
    border-radius:100px;
    color:#fff;
    font-size:13px;
    margin-bottom:28px;
}

.hero-title{
    font-family:'Outfit',sans-serif;
    font-size:74px;
    line-height:1.02;
    color:#fff;
    font-weight:800;
    margin-bottom:26px;
    letter-spacing:-2px;
}

.hero-title span{
    color:var(--gold);
}

.hero-desc{
    color:rgba(255,255,255,.82);
    max-width:650px;
    line-height:1.9;
    font-size:17px;
    margin-bottom:36px;
}

.hero-features{
    display:flex;
    flex-wrap:wrap;
    gap:24px;
    margin-bottom:40px;
}

.hero-feature{
    display:flex;
    align-items:center;
    gap:12px;
    color:#fff;
    font-size:14px;
    font-weight:600;
}

.hero-feature i{
    width:48px;
    height:48px;
    border-radius:50%;
    background:rgba(214,168,79,.14);
    color:var(--gold);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.hero-buttons{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
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
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.12);
    color:#fff;
    padding:16px 32px;
    border-radius:12px;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:10px;
}

.btn-dark:hover{
    background:#fff;
    color:#111;
}

/* FORM */
.hero-form{
    background:rgba(7,28,60,.92);
    backdrop-filter:blur(16px);
    border-radius:28px;
    padding:36px;
    border:1px solid rgba(255,255,255,.08);
    box-shadow:0 25px 60px rgba(0,0,0,.3);
}

.hero-form h3{
    font-size:34px;
    color:#fff;
    margin-bottom:28px;
    font-family:'Outfit',sans-serif;
}

.form-group{
    margin-bottom:18px;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    border:none;
    outline:none;
    border-radius:12px;
    background:#fff;
    padding:16px 18px;
    font-size:14px;
    font-family:'Manrope',sans-serif;
}

.form-group textarea{
    height:120px;
    resize:none;
}

.submit-btn{
    width:100%;
    height:56px;
    border:none;
    border-radius:12px;
    background:var(--gold);
    color:#111;
    font-size:15px;
    font-weight:800;
    cursor:pointer;
}

/* SECTION */
.section{
    padding:90px 7%;
}

.section-title{
    font-size:48px;
    color:var(--primary);
    text-align:center;
    margin-bottom:60px;
    font-family:'Outfit',sans-serif;
    font-weight:800;
}

.section-title span{
    color:var(--gold);
}

/* BENEFITS */
.benefit-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:22px;
}

.benefit-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:22px;
    padding:30px 22px;
    text-align:center;
    transition:.35s;
}

.benefit-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.benefit-card i{
    font-size:36px;
    color:var(--gold);
    margin-bottom:22px;
}

.benefit-card h4{
    font-size:20px;
    color:var(--primary);
    margin-bottom:14px;
}

.benefit-card p{
    color:var(--muted);
    line-height:1.8;
    font-size:14px;
}

/* SERVICES */
.services-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
}

.service-card{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    border:1px solid var(--border);
    transition:.35s;
}

.service-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.service-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.service-content{
    padding:24px;
    text-align:center;
}

.service-content h4{
    font-size:22px;
    margin-bottom:10px;
    color:var(--primary);
}

.service-content p{
    color:var(--muted);
    line-height:1.8;
    font-size:14px;
}

/* PROCESS */
.process-wrapper{
    background:var(--light);
    border-radius:28px;
    padding:50px;
}

.process-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:20px;
}

.process-card{
    text-align:center;
    position:relative;
}

.process-number{
    width:70px;
    height:70px;
    border-radius:50%;
    background:var(--primary);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 22px;
    font-size:24px;
    font-weight:800;
    border:4px solid var(--gold);
}

.process-card h5{
    font-size:17px;
    color:var(--primary);
    margin-bottom:10px;
}

.process-card p{
    font-size:14px;
    color:var(--muted);
    line-height:1.8;
}

/* PROJECTS */
.projects-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:22px;
}

.project-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    border:1px solid var(--border);
}

.project-card img{
    width:100%;
    height:210px;
    object-fit:cover;
}

.project-content{
    padding:22px;
}

.project-content h4{
    font-size:20px;
    color:var(--primary);
    margin-bottom:8px;
}

.project-content p{
    color:var(--muted);
    margin-bottom:16px;
    font-size:14px;
}

.project-bottom{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.status{
    padding:7px 12px;
    border-radius:100px;
    font-size:12px;
    font-weight:700;
}

.completed{
    background:#DCFCE7;
    color:#15803D;
}

.ongoing{
    background:#FEF3C7;
    color:#B45309;
}

/* STATS */
.stats-banner{
    margin-top:80px;
    border-radius:30px;
    overflow:hidden;
    background:
    linear-gradient(90deg,#071C3C 0%,#071C3C 60%,#D6A84F 60%,#D6A84F 100%);
}

.stats-wrap{
    display:grid;
    grid-template-columns:2fr 1fr;
}

.stats-left{
    padding:50px;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:30px;
}

.stat-item{
    text-align:center;
    color:#fff;
}

.stat-item i{
    font-size:38px;
    color:var(--gold);
    margin-bottom:18px;
}

.stat-item h3{
    font-size:42px;
    margin-bottom:10px;
}

.stat-item p{
    color:rgba(255,255,255,.72);
}

.stats-right{
    padding:50px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.stats-right h3{
    font-size:38px;
    color:#111;
    margin-bottom:16px;
    font-family:'Outfit',sans-serif;
}

.stats-right p{
    line-height:1.9;
    margin-bottom:28px;
}

/* FOOTER CTA */
.footer-cta{
    background:#071C3C;
    padding:60px 7%;
}

.footer-wrap{
    display:grid;
    grid-template-columns:1.5fr 1fr 1fr 1fr;
    gap:40px;
}

.footer-logo{
    color:#fff;
}

.footer-logo h2{
    font-size:36px;
    margin-bottom:18px;
    font-family:'Outfit',sans-serif;
}

.footer-logo span{
    color:var(--gold);
}

.footer-logo p{
    color:rgba(255,255,255,.7);
    line-height:1.9;
}

.footer-links h4{
    color:#fff;
    margin-bottom:22px;
    font-size:20px;
}

.footer-links ul{
    list-style:none;
}

.footer-links ul li{
    margin-bottom:14px;
}

.footer-links ul li a{
    color:rgba(255,255,255,.72);
    text-decoration:none;
}

.footer-contact li{
    display:flex;
    gap:12px;
    color:rgba(255,255,255,.72);
}

.footer-contact i{
    color:var(--gold);
}

.socials{
    display:flex;
    gap:14px;
    margin-top:20px;
}

.socials a{
    width:42px;
    height:42px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

.footer-bottom{
    margin-top:50px;
    padding-top:24px;
    border-top:1px solid rgba(255,255,255,.08);
    color:rgba(255,255,255,.65);
    text-align:center;
    font-size:14px;
}

/* RESPONSIVE */
@media(max-width:1400px){

    .benefit-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .services-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .projects-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .process-grid{
        grid-template-columns:repeat(4,1fr);
    }
}

@media(max-width:991px){

    .hero-wrap,
    .stats-wrap,
    .footer-wrap{
        grid-template-columns:1fr;
    }

    .stats-left{
        grid-template-columns:repeat(2,1fr);
    }

    .benefit-grid,
    .services-grid,
    .projects-grid,
    .process-grid{
        grid-template-columns:1fr 1fr;
    }

    .hero-title{
        font-size:54px;
    }

    .section-title{
        font-size:38px;
    }
}

@media(max-width:600px){

    .benefit-grid,
    .services-grid,
    .projects-grid,
    .process-grid,
    .stats-left{
        grid-template-columns:1fr;
    }

    .hero-title{
        font-size:42px;
    }

    .section-title{
        font-size:32px;
    }

    .hero-buttons{
        flex-direction:column;
    }

    .process-wrapper,
    .stats-left,
    .stats-right{
        padding:30px;
    }
}
</style>

<div class="construction-page">

    <!-- HERO -->
    <section class="construction-hero">

        <div class="hero-wrap">

            <div>

                <div class="hero-tag">
                    Residential & Commercial Construction Experts
                </div>

                <h1 class="hero-title">
                    We Build Your Vision On <span>Your Land</span>
                </h1>

                <p class="hero-desc">
                    We provide end-to-end construction solutions with quality, transparency, and on-time delivery. From design to handover, we handle everything professionally.
                </p>

                <div class="hero-features">

                    <div class="hero-feature">
                        <i class="fa-solid fa-building"></i>
                        Quality Construction
                    </div>

                    <div class="hero-feature">
                        <i class="fa-regular fa-clock"></i>
                        On-Time Delivery
                    </div>

                    <div class="hero-feature">
                        <i class="fa-solid fa-file-contract"></i>
                        Transparent Process
                    </div>

                    <div class="hero-feature">
                        <i class="fa-solid fa-users"></i>
                        Experienced Team
                    </div>

                </div>

                <div class="hero-buttons">

                    <a href="#" class="btn-gold">
                        Get Free Estimate
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="#" class="btn-dark">
                        View Our Projects
                    </a>

                </div>

            </div>

            <div class="hero-form">

                <h3>Get Free Consultation</h3>

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
                        <option>Project Type</option>
                        <option>Residential Construction</option>
                        <option>Commercial Construction</option>
                        <option>Interior Design</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea placeholder="Your Message"></textarea>
                </div>

                <button class="submit-btn">
                    Submit Now
                </button>

            </div>

        </div>

    </section>

    <!-- BENEFITS -->
    <section class="section">

        <h2 class="section-title">
            Benefits For <span>Land Owners</span>
        </h2>

        <div class="benefit-grid">

            <div class="benefit-card">
                <i class="fa-solid fa-city"></i>
                <h4>Maximum Land Utilization</h4>
                <p>Smart planning ensures the best use of your land for maximum value.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-chart-line"></i>
                <h4>High Property Value</h4>
                <p>Quality construction increases property value and future returns.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h4>Zero Hassle Construction</h4>
                <p>We handle everything from design to handover for a stress-free experience.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-file-lines"></i>
                <h4>Transparent Process</h4>
                <p>Clear estimation, stage-wise payments, and no hidden charges.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-regular fa-clock"></i>
                <h4>On-Time Delivery</h4>
                <p>Strict project timelines ensure timely and quality completion.</p>
            </div>

            <div class="benefit-card">
                <i class="fa-solid fa-users"></i>
                <h4>Expert Team Support</h4>
                <p>Experienced engineers and architects dedicated to your project.</p>
            </div>

        </div>

    </section>

    <!-- SERVICES -->
    <section class="section" style="background:var(--light)">

        <h2 class="section-title">
            Our Construction <span>Services</span>
        </h2>

        <div class="services-grid">

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1200">
                <div class="service-content">
                    <h4>Residential Construction</h4>
                    <p>Apartments, duplexes, villas & residential buildings.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200">
                <div class="service-content">
                    <h4>Commercial Construction</h4>
                    <p>Office buildings, shopping complexes & business centers.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=1200">
                <div class="service-content">
                    <h4>Architectural Design</h4>
                    <p>Creative and functional architectural solutions.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1200">
                <div class="service-content">
                    <h4>Interior Design</h4>
                    <p>Modern interior solutions for homes and commercial spaces.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=1200">
                <div class="service-content">
                    <h4>Structural Design</h4>
                    <p>Safe, earthquake-resistant structural engineering solutions.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1581093458791-9d09f0c8c1a8?q=80&w=1200">
                <div class="service-content">
                    <h4>Electrical & Plumbing</h4>
                    <p>Complete MEP solutions with quality workmanship.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200">
                <div class="service-content">
                    <h4>Project Management</h4>
                    <p>Complete project supervision and execution management.</p>
                </div>
            </div>

            <div class="service-card">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200">
                <div class="service-content">
                    <h4>Turnkey Construction</h4>
                    <p>From concept to handover — we manage everything.</p>
                </div>
            </div>

        </div>

    </section>

    <!-- PROCESS -->
    <section class="section">

        <h2 class="section-title">
            Our Construction <span>Process</span>
        </h2>

        <div class="process-wrapper">

            <div class="process-grid">

                <div class="process-card">
                    <div class="process-number">01</div>
                    <h5>Consultation</h5>
                    <p>Understanding project requirements and expectations.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">02</div>
                    <h5>Design & Planning</h5>
                    <p>Creating smart and functional architectural planning.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">03</div>
                    <h5>Budget Estimation</h5>
                    <p>Transparent BOQ and project cost estimation.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">04</div>
                    <h5>Approvals</h5>
                    <p>Handling documentation and authority approvals.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">05</div>
                    <h5>Construction</h5>
                    <p>Quality construction with expert supervision.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">06</div>
                    <h5>Finishing</h5>
                    <p>Interior finishing and quality inspection process.</p>
                </div>

                <div class="process-card">
                    <div class="process-number">07</div>
                    <h5>Handover</h5>
                    <p>Project delivery with complete support and service.</p>
                </div>

            </div>

        </div>

    </section>

    <!-- PROJECTS -->
    <section class="section" style="background:var(--light)">

        <h2 class="section-title">
            Our Recent <span>Projects</span>
        </h2>

        <div class="projects-grid">

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=1200">
                <div class="project-content">
                    <h4>Modern Apartment Building</h4>
                    <p>Uttara, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status completed">Completed</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200">
                <div class="project-content">
                    <h4>Commercial Complex</h4>
                    <p>Mirpur, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status completed">Completed</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1200">
                <div class="project-content">
                    <h4>Luxury Residential Building</h4>
                    <p>Bashundhara, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status ongoing">Ongoing</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?q=80&w=1200">
                <div class="project-content">
                    <h4>Office Building Project</h4>
                    <p>Gulshan, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status completed">Completed</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1200">
                <div class="project-content">
                    <h4>Shopping Complex</h4>
                    <p>Dhanmondi, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status ongoing">Ongoing</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- STATS -->
        <div class="stats-banner">

            <div class="stats-wrap">

                <div class="stats-left">

                    <div class="stat-item">
                        <i class="fa-solid fa-building"></i>
                        <h3>150+</h3>
                        <p>Completed Projects</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-regular fa-clock"></i>
                        <h3>10+</h3>
                        <p>Years Experience</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-solid fa-users"></i>
                        <h3>500+</h3>
                        <p>Happy Clients</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-solid fa-star"></i>
                        <h3>100%</h3>
                        <p>Client Satisfaction</p>
                    </div>

                </div>

                <div class="stats-right">

                    <h3>Ready To Build Your Dream Project?</h3>

                    <p>
                        Let’s discuss your project and create something amazing together with our experienced construction team.
                    </p>

                    <div>
                        <a href="#" class="btn-dark" style="background:#071C3C">
                            Get Free Consultation
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER CTA -->
    <section class="footer-cta">

        <div class="footer-wrap">

            <div class="footer-logo">

                <h2>
                    TRIKON <span>CONSTRUCTION</span>
                </h2>

                <p>
                    We are committed to providing quality construction services with transparency, professionalism, and on-time delivery.
                </p>

            </div>

            <div class="footer-links">

                <h4>Quick Links</h4>

                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

            </div>

            <div class="footer-links">

                <h4>Our Services</h4>

                <ul>
                    <li><a href="#">Residential Construction</a></li>
                    <li><a href="#">Commercial Construction</a></li>
                    <li><a href="#">Interior Design</a></li>
                    <li><a href="#">Turnkey Construction</a></li>
                </ul>

            </div>

            <div class="footer-links">

                <h4>Contact Us</h4>

                <ul class="footer-contact">

                    <li>
                        <i class="fa-solid fa-phone"></i>
                        +880 1234-567890
                    </li>

                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        info@trikondev.com
                    </li>

                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        House-12, Road-05, Uttara, Dhaka
                    </li>

                </ul>

                <div class="socials">

                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="footer-bottom">
            © 2024 Trikon Construction. All Rights Reserved.
        </div>

    </section>

</div>

@endsection