<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta charset="UTF-8" />
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
        }
        
        .snowflake {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            z-index: 1000;
        }
        
        h1 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 3.5rem;
            text-align: center;
            color: var(--gold);
            margin: 30px 0;
            padding: 20px;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            position: relative;
        }
        
        h1::before, h1::after {
            content: "✏️";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: 10%; }
        h1::after { right: 10%; }
        
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
        }
        
        .nav-links a:hover {
            color: var(--white);
            background: rgba(196, 30, 58, 0.7);
            text-shadow: 0 0 10px var(--gold);
        }
        
        .cards-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .cards-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        .card-item {
            margin: 15px 0;
            padding: 20px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 15px;
            border-left: 5px solid var(--gold);
            transition: all 0.3s ease;
        }
        
        .card-item:hover {
            background: rgba(10, 92, 54, 0.5);
            transform: translateX(10px);
            border-left-color: var(--red);
        }
        
        .card-link {
            color: var(--white);
            text-decoration: none;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .card-link::before {
            content: "🎫";
            font-size: 1.5rem;
        }
        
        .footer-decoration {
            text-align: center;
            margin-top: 50px;
            font-size: 2rem;
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        .christmas-light {
            position: fixed;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        .ornament {
            position: fixed;
            width: 25px;
            height: 25px;
            background: var(--red);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 25; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                
                const size = Math.random() * 6 + 3;
                snowflake.style.width = `${size}px`;
                snowflake.style.height = `${size}px`;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                
                const duration = Math.random() * 10 + 10;
                snowflake.style.animation = `fall ${duration}s linear infinite`;
                
                document.body.appendChild(snowflake);
            }
            
            for (let i = 0; i < 15; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                light.style.backgroundColor = color;
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                
                document.body.appendChild(light);
            }
            
            for (let i = 0; i < 8; i++) {
                const ornament = document.createElement('div');
                ornament.classList.add('ornament');
                
                const colors = ['#c41e3a', '#0a5c36', '#ffd700'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                ornament.style.backgroundColor = color;
                ornament.style.left = `${Math.random() * 100}vw`;
                ornament.style.top = `${Math.random() * 100}vh`;
                
                document.body.appendChild(ornament);
            }
        });
    </script>
    <title>Uredi karte</title>
</head>
<body>
    <h1>✏️ UREDI KARTE ✏️</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Nazaj na karte</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Nazaj v prodajalno</a> ✨
    </div>
    
    <div class="cards-container">
        <ul class="cards-list">
            <?php foreach ($karte as $karta): ?>
                <li class="card-item">
                    <a href="<?= BASE_URL . "karte?id=" . $karta["id"] ?>" class="card-link">
                        <?= $karta["naziv"] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="footer-decoration">
        🎄🎫✨✏️🔔🎁
    </div>
</body>
</html>