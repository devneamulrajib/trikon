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

.investment-page{
    overflow:hidden;
}

/* HERO */
.investment-hero{
    position:relative;
    padding:90px 7%;
    min-height:760px;
    display:flex;
    align-items:center;
    background:
    linear-gradient(90deg, rgba(4,18,41,.95) 0%, rgba(4,18,41,.82) 42%, rgba(4,18,41,.30) 100%),
    url('https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1800') center center/cover no-repeat;
}

.hero-wrap{
    width:100%;
    display:grid;
    grid-template-columns:1.1fr 430px;
    gap:60px;
    align-items:center;
}

.hero-tag{
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

.hero-tag i{
    color:var(--gold);
}

.hero-title{
    font-family:'Outfit',sans-serif;
    font-size:76px;
    line-height:1;
    font-weight:800;
    color:#fff;
    margin-bottom:24px;
    letter-spacing:-2px;
}

.hero-title span{
    color:var(--gold);
}

.hero-desc{
    max-width:650px;
    color:rgba(255,255,255,.82);
    line-height:1.9;
    font-size:17px;
    margin-bottom:36px;
}

.hero-features{
    display:flex;
    flex-wrap:wrap;
    gap:28px;
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
    color:var(--gold);
    font-size:20px;
}

.hero-actions{
    display:flex;
    flex-wrap:wrap;
    gap:18px;
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
    border:1px solid rgba(255,255,255,.16);
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
    background:rgba(7,28,60,.92);
    backdrop-filter:blur(16px);
    border-radius:28px;
    padding:36px;
    border:1px solid rgba(255,255,255,.08);
    box-shadow:0 25px 60px rgba(0,0,0,.28);
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
    border-radius:12px;
    padding:16px 18px;
    font-size:14px;
    outline:none;
    font-family:'Manrope',sans-serif;
}

.form-group textarea{
    resize:none;
    height:120px;
}

.submit-btn{
    width:100%;
    height:56px;
    border:none;
    border-radius:12px;
    background:var(--gold);
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
    text-align:center;
    margin-bottom:60px;
    font-family:'Outfit',sans-serif;
    color:var(--primary);
    font-weight:800;
}

.section-title span{
    color:var(--gold);
}

/* INVESTMENT PLANS */
.plan-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}

.plan-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:28px;
    overflow:hidden;
    display:grid;
    grid-template-columns:1fr 240px;
}

.plan-content{
    padding:40px;
}

.plan-top{
    display:flex;
    align-items:center;
    gap:18px;
    margin-bottom:26px;
}

.plan-top i{
    width:70px;
    height:70px;
    border-radius:20px;
    background:var(--primary);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.plan-card.gold-plan .plan-top i{
    background:var(--gold);
    color:#111;
}

.plan-top h3{
    font-size:32px;
    color:var(--primary);
    margin-bottom:8px;
}

.plan-top span{
    color:var(--gold);
    font-size:18px;
    font-weight:700;
}

.plan-list{
    list-style:none;
    margin-bottom:30px;
}

.plan-list li{
    display:flex;
    gap:12px;
    margin-bottom:16px;
    font-size:15px;
    line-height:1.7;
}

.plan-list li i{
    color:var(--gold);
    margin-top:4px;
}

.plan-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* WHY */
.why-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:22px;
}

.why-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:24px;
    padding:30px 22px;
    text-align:center;
    transition:.35s;
}

.why-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.why-card i{
    font-size:34px;
    color:var(--gold);
    margin-bottom:20px;
}

.why-card h4{
    font-size:18px;
    margin-bottom:12px;
    color:var(--primary);
}

.why-card p{
    color:var(--muted);
    font-size:14px;
    line-height:1.8;
}

/* PROCESS */
.process-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:20px;
}

.process-card{
    text-align:center;
    position:relative;
}

.process-number{
    width:74px;
    height:74px;
    border-radius:50%;
    background:var(--primary);
    border:4px solid var(--gold);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 24px;
    font-size:24px;
    font-weight:800;
}

.process-card h5{
    font-size:18px;
    margin-bottom:12px;
    color:var(--primary);
}

.process-card p{
    font-size:14px;
    color:var(--muted);
    line-height:1.8;
}

/* STATS */
.stats-banner{
    margin-top:80px;
    border-radius:30px;
    overflow:hidden;
    background:
    linear-gradient(90deg,#071C3C 0%,#071C3C 65%,#D6A84F 65%,#D6A84F 100%);
}

.stats-wrap{
    display:grid;
    grid-template-columns:2fr 1fr;
}

.stats-left{
    padding:50px;
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:24px;
}

.stat-item{
    text-align:center;
    color:#fff;
}

.stat-item i{
    font-size:34px;
    color:var(--gold);
    margin-bottom:18px;
}

.stat-item h3{
    font-size:38px;
    margin-bottom:10px;
}

.stat-item p{
    color:rgba(255,255,255,.72);
    font-size:14px;
}

.stats-right{
    padding:50px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.stats-right h3{
    font-size:40px;
    color:#111;
    margin-bottom:18px;
    font-family:'Outfit',sans-serif;
}

.stats-right p{
    line-height:1.9;
    margin-bottom:28px;
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
    transition:.35s;
}

.project-card:hover{
    transform:translateY(-8px);
    box-shadow:0 25px 50px rgba(0,0,0,.08);
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

.upcoming{
    background:#DBEAFE;
    color:#1D4ED8;
}

/* CTA */
.bottom-cta{
    background:#071C3C;
    padding:60px 7%;
}

.cta-wrap{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:30px;
}

.cta-left h3{
    font-size:42px;
    color:#fff;
    margin-bottom:12px;
    font-family:'Outfit',sans-serif;
}

.cta-left p{
    color:rgba(255,255,255,.72);
    line-height:1.8;
}

.cta-actions{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
}

/* FOOTER */
.footer{
    background:#041226;
    padding:70px 7% 30px;
}

.footer-grid{
    display:grid;
    grid-template-columns:1.4fr 1fr 1fr 1fr;
    gap:40px;
}

.footer-logo h2{
    color:#fff;
    font-size:36px;
    margin-bottom:18px;
    font-family:'Outfit',sans-serif;
}

.footer-logo span{
    color:var(--gold);
}

.footer-logo p{
    color:rgba(255,255,255,.72);
    line-height:1.9;
}

.footer-title{
    color:#fff;
    margin-bottom:22px;
    font-size:20px;
}

.footer-links{
    list-style:none;
}

.footer-links li{
    margin-bottom:14px;
}

.footer-links li a{
    color:rgba(255,255,255,.72);
    text-decoration:none;
}

.footer-contact li{
    display:flex;
    gap:12px;
}

.footer-contact i{
    color:var(--gold);
    margin-top:5px;
}

.newsletter input{
    width:100%;
    height:54px;
    border:none;
    border-radius:12px;
    padding:0 18px;
    margin-bottom:14px;
}

.newsletter button{
    width:100%;
    height:54px;
    border:none;
    border-radius:12px;
    background:var(--gold);
    font-weight:700;
    cursor:pointer;
}

.socials{
    display:flex;
    gap:14px;
    margin-top:24px;
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
    text-align:center;
    color:rgba(255,255,255,.65);
    font-size:14px;
}

/* RESPONSIVE */
@media(max-width:1400px){

    .why-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .projects-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .process-grid{
        grid-template-columns:repeat(3,1fr);
    }

    .stats-left{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:991px){

    .hero-wrap,
    .plan-grid,
    .stats-wrap,
    .footer-grid{
        grid-template-columns:1fr;
    }

    .projects-grid,
    .why-grid,
    .process-grid,
    .stats-left{
        grid-template-columns:1fr 1fr;
    }

    .cta-wrap{
        flex-direction:column;
        align-items:flex-start;
    }

    .hero-title{
        font-size:54px;
    }

    .section-title{
        font-size:38px;
    }
}

@media(max-width:600px){

    .projects-grid,
    .why-grid,
    .process-grid,
    .stats-left{
        grid-template-columns:1fr;
    }

    .plan-card{
        grid-template-columns:1fr;
    }

    .hero-title{
        font-size:42px;
    }

    .section-title{
        font-size:32px;
    }

    .hero-actions,
    .cta-actions{
        flex-direction:column;
    }
}
</style>

<div class="investment-page">

    <!-- HERO -->
    <section class="investment-hero">

        <div class="hero-wrap">

            <div>

                <div class="hero-tag">
                    <i class="fa-solid fa-chart-line"></i>
                    Invest In Growth. Build The Future.
                </div>

                <h1 class="hero-title">
                    Investment <span>Opportunity</span>
                </h1>

                <p class="hero-desc">
                    Be a part of our growth journey. Invest in our company and earn attractive returns through our residential and commercial construction projects.
                </p>

                <div class="hero-features">

                    <div class="hero-feature">
                        <i class="fa-solid fa-shield-halved"></i>
                        Secure Investment
                    </div>

                    <div class="hero-feature">
                        <i class="fa-solid fa-chart-column"></i>
                        High Return Potential
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

                <div class="hero-actions">

                    <a href="#" class="btn-gold">
                        Invest Now
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="#" class="btn-dark">
                        Download Proposal
                        <i class="fa-solid fa-download"></i>
                    </a>

                </div>

            </div>

            <div class="hero-form">

                <h3>Request Investment Information</h3>

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
                        <option>Investment Interest</option>
                        <option>Short-Term Investment</option>
                        <option>Long-Term Investment</option>
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

    <!-- INVESTMENT PLANS -->
    <section class="section">

        <h2 class="section-title">
            Our <span>Investment Plans</span>
        </h2>

        <div class="plan-grid">

            <div class="plan-card">

                <div class="plan-content">

                    <div class="plan-top">
                        <i class="fa-regular fa-clock"></i>

                        <div>
                            <h3>Short-Term Investment</h3>
                            <span>2 Months - 12 Months</span>
                        </div>
                    </div>

                    <ul class="plan-list">

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Duration: 2 Months to 12 Months
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Attractive Return Potential
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Lower Capital Lock-in
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Ideal for Quick Growth
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Secure & Transparent
                        </li>

                    </ul>

                    <a href="#" class="btn-dark" style="background:var(--primary)">
                        View Details
                    </a>

                </div>

                <div class="plan-image">
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=1200">
                </div>

            </div>

            <div class="plan-card gold-plan">

                <div class="plan-content">

                    <div class="plan-top">
                        <i class="fa-regular fa-calendar"></i>

                        <div>
                            <h3>Long-Term Investment</h3>
                            <span>1 Year & Above</span>
                        </div>
                    </div>

                    <ul class="plan-list">

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Higher Return Potential
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Asset Value Appreciation
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Passive Income Opportunity
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Company Growth Participation
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Secure & Transparent
                        </li>

                    </ul>

                    <a href="#" class="btn-gold">
                        View Details
                    </a>

                </div>

                <div class="plan-image">
                    <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1200">
                </div>

            </div>

        </div>

    </section>

    <!-- WHY -->
    <section class="section" style="background:var(--light)">

        <h2 class="section-title">
            Why <span>Invest</span> With Us?
        </h2>

        <div class="why-grid">

            <div class="why-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h4>Strong & Reliable</h4>
                <p>Trusted construction and development company with proven experience.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-chart-line"></i>
                <h4>High Returns</h4>
                <p>Competitive returns through profitable real estate projects.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-handshake"></i>
                <h4>Transparent Process</h4>
                <p>Clear communication and fully transparent investment process.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-users"></i>
                <h4>Experienced Team</h4>
                <p>Skilled professionals with years of industry experience.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-building"></i>
                <h4>Quality Projects</h4>
                <p>Premium residential and commercial developments.</p>
            </div>

            <div class="why-card">
                <i class="fa-solid fa-lock"></i>
                <h4>Secure Investment</h4>
                <p>Legally compliant and risk-managed investment opportunities.</p>
            </div>

        </div>

    </section>

    <!-- PROCESS -->
    <section class="section">

        <h2 class="section-title">
            Our <span>Investment Process</span>
        </h2>

        <div class="process-grid">

            <div class="process-card">
                <div class="process-number">01</div>
                <h5>Consultation</h5>
                <p>Understanding your goals and investment preference.</p>
            </div>

            <div class="process-card">
                <div class="process-number">02</div>
                <h5>Plan Selection</h5>
                <p>Choose the investment plan that suits you best.</p>
            </div>

            <div class="process-card">
                <div class="process-number">03</div>
                <h5>Agreement</h5>
                <p>Review and sign the investment agreement securely.</p>
            </div>

            <div class="process-card">
                <div class="process-number">04</div>
                <h5>Investment</h5>
                <p>Invest your funds safely with our company.</p>
            </div>

            <div class="process-card">
                <div class="process-number">05</div>
                <h5>Development</h5>
                <p>We develop projects with transparency and quality.</p>
            </div>

            <div class="process-card">
                <div class="process-number">06</div>
                <h5>Returns & Growth</h5>
                <p>Earn attractive returns and grow your investment.</p>
            </div>

        </div>

        <!-- STATS -->
        <div class="stats-banner">

            <div class="stats-wrap">

                <div class="stats-left">

                    <div class="stat-item">
                        <i class="fa-solid fa-building"></i>
                        <h3>25+</h3>
                        <p>Completed Projects</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-solid fa-diagram-project"></i>
                        <h3>15+</h3>
                        <p>Ongoing Projects</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-solid fa-users"></i>
                        <h3>500+</h3>
                        <p>Happy Investors</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-regular fa-clock"></i>
                        <h3>10+</h3>
                        <p>Years Experience</p>
                    </div>

                    <div class="stat-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <h3>100%</h3>
                        <p>Transparency</p>
                    </div>

                </div>

                <div class="stats-right">

                    <h3>Ready To Invest In A Better Tomorrow?</h3>

                    <p>
                        Join hands with us and become part of a successful and profitable real estate investment journey.
                    </p>

                    <a href="#" class="btn-dark" style="background:#071C3C">
                        Start Investing
                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- PROJECTS -->
    <section class="section" style="background:var(--light)">

        <h2 class="section-title">
            Our Featured <span>Projects</span>
        </h2>

        <div class="projects-grid">

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?q=80&w=1200">

                <div class="project-content">
                    <h4>Green View Residence</h4>
                    <p>Uttara, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status completed">Completed</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200">

                <div class="project-content">
                    <h4>Business Avenue</h4>
                    <p>Banani, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status ongoing">Ongoing</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?q=80&w=1200">

                <div class="project-content">
                    <h4>Skyline Tower</h4>
                    <p>Gulshan, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status ongoing">Ongoing</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1511818966892-d7d671e672a2?q=80&w=1200">

                <div class="project-content">
                    <h4>Prime Shopping Complex</h4>
                    <p>Mirpur, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status upcoming">Upcoming</span>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1200">

                <div class="project-content">
                    <h4>Luxury Heights</h4>
                    <p>Bashundhara, Dhaka</p>

                    <div class="project-bottom">
                        <span class="status upcoming">Upcoming</span>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="bottom-cta">

        <div class="cta-wrap">

            <div class="cta-left">

                <h3>Have Questions?</h3>

                <p>
                    Our investment experts are here to help you with the right investment guidance and project consultation.
                </p>

            </div>

            <div class="cta-actions">

                <a href="#" class="btn-gold">
                    Schedule A Meeting
                </a>

                <a href="#" class="btn-dark">
                    Call Us Now
                    +8801633530231
                </a>

            </div>

        </div>

    </section>

    

</div>

@endsection