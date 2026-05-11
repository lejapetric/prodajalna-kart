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
            content: "🏪";
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
        
        .sellers-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .sellers-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        .seller-item {
            margin: 15px 0;
            padding: 15px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 10px;
            border-left: 5px solid var(--gold);
            transition: all 0.3s ease;
        }
        
        .seller-item:hover {
            background: rgba(10, 92, 54, 0.5);
            transform: translateX(10px);
        }
        
        .seller-link {
            color: var(--white);
            text-decoration: none;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .seller-status {
            font-size: 1.5rem;
            margin-right: 10px;
        }
        
        .active-seller {
            color: #00ff00;
        }
        
        .inactive-seller {
            color: #ff4444;
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
        
        .sleigh {
            position: fixed;
            bottom: 50px;
            right: -200px;
            font-size: 3rem;
            animation: sleigh-ride 30s linear infinite;
            z-index: -1;
        }
        
        @keyframes sleigh-ride {
            0% { right: -200px; transform: translateY(0); }
            25% { transform: translateY(-20px); }
            50% { transform: translateY(0); }
            75% { transform: translateY(-20px); }
            100% { right: calc(100% + 200px); transform: translateY(0); }
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
            
            const sleigh = document.createElement('div');
            sleigh.classList.add('sleigh');
            sleigh.innerHTML = '🛷';
            document.body.appendChild(sleigh);
        });
    </script>
    <title>Prodajalci</title>
</head>
<body>
    <h1>🏪 VSI PRODAJALCI 🏪</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "seller/add" ?>">➕ Dodaj novega</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Nazaj v prodajalno</a> ✨
    </div>
    
    <div class="sellers-container">
        <ul class="sellers-list">
            <?php foreach ($users as $user): ?>
                <li class="seller-item">
                    <a href="<?= BASE_URL . "sellers?email=" . $user["email"] ?>" class="seller-link">
                        <span class="seller-status <?= $user["aktiviran"] == 1 ? 'active-seller' : 'inactive-seller' ?>">
                            <?= $user["aktiviran"] == 1 ? '✅' : '❌' ?>
                        </span>
                        <span>
                            <?= $user["surname"]?> <?= $user["name"] ?>
                            <?php if ($user["aktiviran"] == 1): ?>
                                <span style="color: #00ff00; font-size: 0.9rem; margin-left: 10px;">
                                    (Aktiven)
                                </span>
                            <?php else: ?>
                                <span style="color: #ff4444; font-size: 0.9rem; margin-left: 10px;">
                                    (Neaktiven)
                                </span>
                            <?php endif; ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="footer-decoration">
        🎄🏪✨🦌🔔🎁
    </div>
</body>
</html>