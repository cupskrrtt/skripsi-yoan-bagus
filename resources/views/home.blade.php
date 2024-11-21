<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mitra Produksi</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar">
        <a href="/" class="navbar-logo">Mitra<span>Produksi</span></a>

        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="navbar-extra">
            @guest
                <a href="/login">Sign In</a>
            @else
            <div class="auth-links">
                <a href="/dashboard">Dashboard</a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        @endif
        <a href="#" id="menu"><i class="bx bx-menu"></i></a>
        </div>
    </nav>
    {{-- navbar end --}}

    {{-- hero section --}}
    <section class="hero" id="home">
        <main class="content">
            <h1>Manajemen Produksi Konveksi</h1>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, impedit!</p> -->
            @guest
                <a href="/login" class="cta">Join Now!</a>
            @endguest
        </main>
    </section>
    {{-- hero section end --}}

    {{-- about section --}}
    <section class="about" id="about">
        <h2>About Us</h2>

        <div class="row">
            <div class="about-img">
                <img src="garment.jpg" alt="About Us">
            </div>
            <div class="content">
                <h3>Why choose us?</h3>
                <p>At Mitra Produksi, we are dedicated to revolutionizing production management. Our mission is to provide seamless, efficient, and innovative solutions tailored to meet the dynamic needs of modern production environments.</p>
                <p>We invite you to explore the future of production management with Mitra Produksi. Let us help you streamline your processes, enhance your productivity, and achieve your business goals. Together, we can build a more efficient and sustainable production environment.</p>
            </div>
        </div>
    </section>
    {{-- about section end --}}

    {{-- feature section --}}
    <section class="features" id="features">
        <h2>Features</h2>
        <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem neque culpa enim. Repudiandae, fugit in.</p> -->
        
        <div class="row">
            <div class="features-card">
                <img src="inventory.jpg" alt="" class="features-card-img">
                <h3 class="features-card-title">Inventory</h3>
                <!-- <p class="features-card-text">Lorem ipsum, dolor sit amet consectetur </p> -->

            </div>
            <div class="features-card">
                <img src="fitur.jpg" alt="" class="features-card-img">
                <h3 class="features-card-title">Planning</h3>
                <!-- <p class="features-card-text">Lorem ipsum, dolor sit amet consectetur </p> -->

            </div>
            <div class="features-card">
                <img src="production.jpg" alt="" class="features-card-img">
                <h3 class="features-card-title">Production</h3>
                <!-- <p class="features-card-text">Lorem ipsum, dolor sit amet consectetur </p> -->

            </div>
            <div class="features-card">
                <img src="cash.jpg" alt="" class="features-card-img">
                <h3 class="features-card-title">Cash Book</h3>
                <!-- <p class="features-card-text">Lorem ipsum, dolor sit amet consectetur </p> -->

            </div>
        </div>
    </section>
    {{-- feature section end --}}

    {{-- contact section --}}
    <section class="contact" id="contact">
        <h2>Contact Us</h2>
        <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, at!</p> -->
    
        <div class="row">
            <h1 class="logo">MitraKonveksi</h1>

            <ul class="info">
                <li>
                <i class='bx bx-phone'> Phone : 08123456789</i>
                </li>
                <li>
                <i class='bx bx-envelope'> Email : mitrakonveksi@gmail.com</i>
                </li>
                <li>
                    <i class='bx bxl-facebook'> Facebook : mitrakonveksi</i>
                </li>
            </ul>
        </div>
    </section>
    {{-- contact section end --}}

    {{-- footer --}}
    <footer>
        <div class="socials">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bx-envelope'></i></a>
        </div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">juanmeta</a>. | &copy; 2024.</p>
        </div>
    </footer>
    {{-- footer end --}}

    <script src="/js/home.js"></script>
</body>
</html>