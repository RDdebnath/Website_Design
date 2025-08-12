<?php
// Enhanced form handling with spam protection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_forum'])) {
    // Honey pot field for spam detection
    if (!empty($_POST['website'])) {
        die('Spam detected');
    }

    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    $errors = [];
    
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($subject)) $errors[] = "Subject is required";
    if (empty($message)) $errors[] = "Message is required";
    
    if (empty($errors)) {
        $to = "debnathrakesh169@gmail.com";
        $email_subject = "New Consultation Request: $subject";
        $body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .header { color: #2c3e50; font-size: 24px; margin-bottom: 20px; }
                .detail { margin-bottom: 10px; }
                .label { font-weight: bold; color: #3498db; }
                .message { background: #f9f9f9; padding: 15px; border-left: 4px solid #3498db; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='header'>New Consultation Request</div>
            <div class='detail'><span class='label'>Name:</span> $name</div>
            <div class='detail'><span class='label'>Email:</span> $email</div>
            <div class='detail'><span class='label'>Phone:</span> $phone</div>
            <div class='detail'><span class='label'>Subject:</span> $subject</div>
            <div class='detail'><span class='label'>Message:</span></div>
            <div class='message'>$message</div>
        </body>
        </html>
        ";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        if (mail($to, $email_subject, $body, $headers)) {
            $success_message = "Thank you! Your consultation request has been sent successfully.";
            // Clear form fields
            $_POST = array();
        } else {
            $error_message = "Sorry, there was an error sending your message. Please try again later.";
        }
    } else {
        $error_message = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MORINFOCONSULTANCY - Premium business consulting services to help your company grow">
    <meta name="keywords" content="consultancy, business consulting, strategy, growth, management">
    <meta name="author" content="MORINFOCONSULTANCY">
    <title>MORINFOCONSULTANCY | Business Growth Specialists</title>
    
    <!-- SEO Meta Tags -->
    <meta property="og:title" content="MORINFOCONSULTANCY | Business Growth Specialists">
    <meta property="og:description" content="Premium business consulting services to help your company grow">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://example.com/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --gray: #6c757d;
        }
        
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.7;
            color: var(--dark);
            background-color: var(--light);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            line-height: 1.3;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        section {
            padding: 100px 0;
            position: relative;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .animate {
            opacity: 0;
        }
        
        .animated {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
        
        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
            padding: 20px 0;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        header.scrolled {
            padding: 15px 0;
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }
        
        .logo span {
            color: var(--dark);
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 32px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            font-weight: 600;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s ease;
        }
        
        nav ul li a:hover {
            color: var(--primary);
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--dark);
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            min-height: 700px;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1) 0%, rgba(255, 255, 255, 1) 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: -1;
        }
        
        .hero-content {
            max-width: 600px;
        }
        
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 30px;
        }
        
        .hero-btns {
            display: flex;
            gap: 15px;
        }
        
        .hero-image {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 50%;
            max-width: 700px;
            animation: float 6s ease-in-out infinite;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        /* Forum Section */
        .forum-section {
            background-color: white;
            border-radius: 20px;
            padding: 60px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .forum-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.03) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: 0;
        }
        
        .forum-section .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .forum-section .section-title h2 {
            font-size: 36px;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .forum-section .section-title p {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
        }
        
        .forum-form {
            position: relative;
            z-index: 1;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.8);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .form-submit {
            text-align: center;
            margin-top: 30px;
        }
        
        .honey-pot {
            position: absolute;
            left: -9999px;
        }
        
        /* Messages */
        .message {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .message i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .success-message {
            background-color: rgba(76, 201, 240, 0.1);
            color: #0e7a8d;
            border-left: 4px solid var(--success);
        }
        
        .error-message {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }
        
        /* Features Section */
        .features-section {
            background-color: #f8fafc;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 32px;
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            font-size: 22px;
        }
        
        .feature-card p {
            color: var(--gray);
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 80px 0 30px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .footer-column h3 {
            font-size: 20px;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary);
        }
        
        .footer-column p {
            margin-bottom: 20px;
            opacity: 0.8;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            opacity: 0.8;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            opacity: 1;
            color: var(--primary);
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
            font-size: 14px;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 40px;
            }
            
            .hero-image {
                opacity: 0.3;
                right: -100px;
            }
            
            .forum-section {
                padding: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            nav {
                position: fixed;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: white;
                padding: 20px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                transform: translateY(-150%);
                transition: all 0.3s ease;
                z-index: 999;
            }
            
            nav.active {
                transform: translateY(0);
            }
            
            nav ul {
                flex-direction: column;
            }
            
            nav ul li {
                margin: 0 0 15px 0;
            }
            
            .hero {
                text-align: center;
                min-height: auto;
                padding: 150px 0 100px;
                height: auto;
            }
            
            .hero-content {
                max-width: 100%;
            }
            
            .hero-btns {
                justify-content: center;
            }
            
            .hero-image {
                display: none;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            section {
                padding: 70px 0;
            }
        }
        
        @media (max-width: 576px) {
            .hero h1 {
                font-size: 32px;
            }
            
            .forum-section {
                padding: 30px 20px;
            }
            
            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container header-container">
            <a href="#" class="logo">
                <i class="fas fa-chart-line"></i>
                <span>MORINFO</span>CONSULTANCY
            </a>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <nav id="mainNav">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#forum">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content animate">
                <h1 class="animated">Transform Your Business With Expert Consultation</h1>
                <p class="animated delay-1">We provide premium business consulting services to help companies of all sizes achieve sustainable growth and maximize their potential.</p>
                <div class="hero-btns">
                    <a href="#forum" class="btn btn-primary animated delay-2">Get Consultation</a>
                    <a href="#services" class="btn btn-outline animated delay-2">Our Services</a>
                </div>
            </div>
            
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Business Consultation" class="hero-image">
        </div>
    </section>

    <!-- Services Section -->
    <section class="features-section" id="services">
        <div class="container">
            <div class="section-title animate">
                <h2 class="animated">Our Premium Services</h2>
                <p class="animated delay-1">We offer comprehensive business solutions tailored to your specific needs and goals.</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card animate">
                    <div class="feature-icon animated delay-1">
                        <i class="fas fa-chess"></i>
                    </div>
                    <h3 class="animated delay-2">Business Strategy</h3>
                    <p class="animated delay-2">Develop winning strategies to outperform competitors and dominate your market.</p>
                </div>
                
                <div class="feature-card animate">
                    <div class="feature-icon animated delay-2">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="animated delay-3">Market Analysis</h3>
                    <p class="animated delay-3">In-depth market research to identify opportunities and optimize your positioning.</p>
                </div>
                
                <div class="feature-card animate">
                    <div class="feature-icon animated delay-3">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="animated delay-1">Process Optimization</h3>
                    <p class="animated delay-1">Streamline operations and eliminate inefficiencies to boost productivity.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Forum/Contact Section -->
    <section id="forum">
        <div class="container">
            <div class="forum-section animate">
                <div class="section-title">
                    <h2 class="animated">Request a Consultation</h2>
                    <p class="animated delay-1">Fill out the form below and our expert will contact you within 24 hours.</p>
                </div>
                
                <?php if (isset($success_message)): ?>
                    <div class="message success-message animated">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($error_message)): ?>
                    <div class="message error-message animated">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form class="forum-form" method="POST" action="#forum">
                    <!-- Honey pot field -->
                    <input type="text" name="website" class="honey-pot">
                    
                    <div class="form-grid">
                        <div class="form-group animate">
                            <label for="name" class="animated delay-1">Your Name *</label>
                            <input type="text" id="name" name="name" class="form-control" required 
                                   value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                        </div>
                        
                        <div class="form-group animate">
                            <label for="email" class="animated delay-2">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" required 
                                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        </div>
                        
                        <div class="form-group animate">
                            <label for="phone" class="animated delay-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                        </div>
                        
                        <div class="form-group animate">
                            <label for="subject" class="animated delay-2">Subject *</label>
                            <input type="text" id="subject" name="subject" class="form-control" required 
                                   value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : ''; ?>">
                        </div>
                        
                        <div class="form-group full-width animate">
                            <label for="message" class="animated delay-3">Your Message *</label>
                            <textarea id="message" name="message" class="form-control" required><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-submit animate">
                        <button type="submit" name="submit_forum" class="btn btn-primary animated delay-3">
                            <i class="fas fa-paper-plane"></i> Send Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="section-title animate">
                <h2 class="animated">About MORINFOCONSULTANCY</h2>
                <p class="animated delay-1">Our story and what makes us different</p>
            </div>
            
            <div class="about-content" style="max-width: 800px; margin: 0 auto;">
                <div class="animate">
                    <p class="animated delay-2">MORINFOCONSULTANCY was founded with a single mission: to help businesses achieve their full potential through strategic guidance and actionable insights. With over a decade of experience across multiple industries, our team of experts brings unparalleled knowledge and fresh perspectives to every engagement.</p>
                </div>
                
                <div class="animate" style="margin-top: 30px;">
                    <p class="animated delay-3">What sets us apart is our commitment to delivering measurable results. We don't just provide advice - we partner with our clients to implement solutions that drive real growth and create lasting value.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>MORINFOCONSULTANCY</h3>
                    <p>Premium business consulting services to help your company grow and thrive in today's competitive landscape.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#forum">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Business Strategy</a></li>
                        <li><a href="#">Market Analysis</a></li>
                        <li><a href="#">Process Optimization</a></li>
                        <li><a href="#">Financial Consulting</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <p><i class="fas fa-envelope"></i> debnathrakesh169@gmail.com</p>
                    <p><i class="fas fa-phone"></i> +1 (123) 456-7890</p>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Business Ave, Suite 100<br>New York, NY 10001</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> MORINFOCONSULTANCY. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
            
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mainNav = document.getElementById('mainNav');
            
            mobileMenuBtn.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                this.innerHTML = mainNav.classList.contains('active') ? 
                    '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });
            
            // Close mobile menu when clicking a link
            document.querySelectorAll('#mainNav a').forEach(link => {
                link.addEventListener('click', function() {
                    mainNav.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                });
            });
            
            // Header scroll effect
            const header = document.getElementById('header');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>