<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta charset="UTF-8" />
    <title>Seznam kart</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@400;700&family=Poppins:wght@300;400;600&display=swap');
        
        :root {
            --red: #c41e3a;
            --green: #0a5c36;
            --gold: #ffd700;
            --white: #fffaf0;
            --blue: #1e3a5f;
        }
        
        body {
            background: linear-gradient(135deg, #0a5c36 0%, #0d7242 25%, #c41e3a 50%, #8b0000 75%, #1e3a5f 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--white);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        .snowflake {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            z-index: 1000;
        }
        
        .header-container {
            position: relative;
            margin: 20px 0;
            text-align: center;
        }
        
        h1 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 3.5rem;
            color: var(--gold);
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            margin: 0;
            padding: 20px;
            display: inline-block;
            position: relative;
        }
        
        h1::before, h1::after {
            content: "🎄";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: -40px; }
        h1::after { right: -40px; }
        
        .auth-buttons {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
        }
        
        .auth-buttons a {
            margin-left: 15px;
        }
        
        .auth-btn {
            padding: 12px 25px;
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .auth-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        .nav-links {
            background: rgba(30, 58, 95, 0.7);
            padding: 15px;
            border-radius: 15px;
            margin: 20px auto;
            max-width: 600px;
            border: 2px solid var(--gold);
            text-align: center;
        }
        
        .nav-links a {
            color: var(--gold);
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 10px;
        }
        
        .nav-links a:hover {
            color: var(--white);
            background: rgba(196, 30, 58, 0.7);
            text-shadow: 0 0 10px var(--gold);
        }
        
        .card-list {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            list-style-type: none;
        }
        
        .card-list li {
            margin: 15px 0;
            padding: 15px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 10px;
            border-left: 5px solid var(--gold);
            transition: all 0.3s ease;
        }
        
        .card-list li:hover {
            background: rgba(196, 30, 58, 0.3);
            transform: translateX(10px);
        }
        
        .card-list a {
            color: var(--gold);
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            display: block;
            padding: 5px;
        }
        
        .card-list a:hover {
            color: var(--white);
            text-shadow: 0 0 10px var(--gold);
        }
        
        .card-list li::before {
            content: "🎁";
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        /* Božične animacije */
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        .christmas-ornament {
            position: fixed;
            width: 30px;
            height: 30px;
            background: var(--red);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .christmas-light {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        .footer-decoration {
            text-align: center;
            margin-top: 50px;
            font-size: 2rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ustvari snežinke
            for (let i = 0; i < 20; i++) {
                createSnowflake();
            }
            
            // Ustvari lučke
            for (let i = 0; i < 10; i++) {
                createLight();
            }
            
            // Ustvari okraske
            for (let i = 0; i < 8; i++) {
                createOrnament();
            }
        });
        
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            
            const size = Math.random() * 8 + 4;
            snowflake.style.width = `${size}px`;
            snowflake.style.height = `${size}px`;
            snowflake.style.left = `${Math.random() * 100}vw`;
            snowflake.style.top = `${Math.random() * 100}vh`;
            
            const duration = Math.random() * 10 + 10;
            snowflake.style.animation = `fall ${duration}s linear infinite`;
            
            document.body.appendChild(snowflake);
        }
        
        function createLight() {
            const light = document.createElement('div');
            light.classList.add('christmas-light');
            
            const colors = ['#ff0000', '#00ff00', '#ffff00', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            light.style.backgroundColor = color;
            light.style.left = `${Math.random() * 100}vw`;
            light.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(light);
        }
        
        function createOrnament() {
            const ornament = document.createElement('div');
            ornament.classList.add('christmas-ornament');
            
            const colors = ['#c41e3a', '#0a5c36', '#ffd700', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            ornament.style.backgroundColor = color;
            ornament.style.left = `${Math.random() * 100}vw`;
            ornament.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(ornament);
        }
    </script>
</head>
<body>
    <div class="header-container">
        <h1>🎅 Vse Božične Karte 🎅</h1>
        
        <?php if (!isset($_SESSION['user'])): ?>
            <!-- Prijava in Registracija gumbi na desni strani - samo če ni prijavljen -->
            <div class="auth-buttons">
                <a href="<?= BASE_URL . "prijava" ?>">
                    <button class="auth-btn">🎄 Prijava</button>
                </a>
                <a href="<?= BASE_URL . "registracija" ?>">
                    <button class="auth-btn">✨ Registracija</button>
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="nav-links">
        [
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'SELLER'): ?>
            ✨ <a href="<?= BASE_URL . "karta/add" ?>">Dodaj novo karto</a> ✨ |
        <?php endif; ?>
        ✨ <a href="<?= BASE_URL . "store" ?>">Božična Prodajalna</a> ✨
        ]
    </div>
    
    <ul class="card-list">
        <?php foreach ($karte as $karta): 
            if ($karta["aktiviran"] == 1): ?>
            <li>
                <a href="<?= BASE_URL . "karte?id=" . $karta["id"] ?>">
                    🎄 <?= $karta["naziv"] ?> 🎄
                </a>
            </li>
        <?php endif;
            endforeach; ?>
    </ul>
    
    <div class="footer-decoration">
        🎄🎅✨🦌🔔❄️
    </div>
</body>
</html>