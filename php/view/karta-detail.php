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
            content: "🎫";
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
            max-width: 800px;
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
        
        .card-details {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .details-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        .detail-item {
            margin: 20px 0;
            padding: 15px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 10px;
            border-left: 5px solid var(--red);
            font-size: 1.2rem;
        }
        
        .detail-label {
            color: var(--gold);
            font-weight: bold;
            display: inline-block;
            min-width: 150px;
        }
        
        .edit-link {
            display: inline-block;
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .edit-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 20; i++) {
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
            
            for (let i = 0; i < 12; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                light.style.backgroundColor = color;
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                
                document.body.appendChild(light);
            }
        });
    </script>
    <title>Podrobnosti karte</title>
</head>
<body>
    <h1>🎫 Podrobnosti: <?= $karta["naziv"] ?> 🎫</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Vse karte</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨
        <?php 
        require_once("model/User.php");
        if (User::isLoggedIn() && User::isSeller() && 
            isset($_SESSION["user"]["email"]) && 
            isset($karta["seller_email"]) && 
            $_SESSION["user"]["email"] == $karta["seller_email"]): ?>
            ✨ | <a href="<?= BASE_URL . "karta/edit?id=" . $_GET["id"] ?>">✏️ Uredi</a> ✨
        <?php endif; ?>
    </div>
    
    <div class="card-details">
        <ul class="details-list">
            <li class="detail-item">
                <span class="detail-label">🏷️ Naziv:</span>
                <b><?= $karta["naziv"] ?></b>
            </li>
            <li class="detail-item">
                <span class="detail-label">💰 Cena:</span>
                <b><?= $karta["cena"] ?> EUR</b>
            </li>
            <?php if (isset($karta["seller_email"]) && !empty($karta["seller_email"])): ?>
                <li class="detail-item">
                    <span class="detail-label">🏪 Prodajalec:</span>
                    <b><?= $karta["seller_email"] ?></b>
                </li>
            <?php endif; ?>
        </ul>
        
        <?php if (User::isLoggedIn() && User::isSeller() && 
            isset($_SESSION["user"]["email"]) && 
            isset($karta["seller_email"]) && 
            $_SESSION["user"]["email"] == $karta["seller_email"]): ?>
            <div style="text-align: center; margin-top: 30px;">
                <a href="<?= BASE_URL . "karta/edit?id=" . $_GET["id"] ?>" class="edit-link">
                    ✏️ Uredi to karto
                </a>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="footer-decoration">
        🎄🎫✨💰🔔🎁
    </div>
</body>
</html>