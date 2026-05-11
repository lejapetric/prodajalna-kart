<!DOCTYPE html>
<html lang="sl">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . "style.css"; ?>">
    <meta charset="UTF-8" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@400;700&family=Poppins:wght@300;400;600&display=swap');
        
        :root {
            --red: #c41e3a;
            --green: #0a5c36;
            --gold: #ffd700;
            --white: #fffaf0;
            --blue: #1e3a5f;
            --cream: #fffaf0;
            --dark-brown: #5a3d1c;
            --light-brown: #8b5a2b;
            --peach: #ffcc80;
        }
        
        body {
            background: linear-gradient(135deg, #0a5c36 0%, #0d7242 25%, #c41e3a 50%, #8b0000 75%, #1e3a5f 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--white);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .snowflake {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            z-index: 1000;
        }
        
        .container {
            max-width: 900px;
            width: 95%;
            margin: 20px auto;
            position: relative;
            z-index: 1;
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
            content: "🛒";
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
            max-width: 700px;
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
        
        #cart {
            background: rgba(30, 58, 95, 0.85);
            border: 3px solid var(--gold);
            padding: 30px;
            margin: 30px 0;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            width: 100%;
            transition: all 0.3s ease;
        }
        
        #cart:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            border-color: var(--red);
        }
        
        .cart-header h3 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2.2rem;
            color: var(--gold);
            text-align: center;
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
        }
        
        .cart-item {
            background: rgba(10, 92, 54, 0.4);
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid var(--gold);
            transition: all 0.3s ease;
        }
        
        .cart-item:hover {
            transform: translateX(5px);
            background: rgba(10, 92, 54, 0.6);
        }
        
        .cart-item p {
            margin: 8px 0;
            color: var(--white);
        }
        
        .cart-item strong {
            color: var(--gold);
            font-size: 1.2rem;
            display: block;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        
        .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--gold);
            margin: 30px 0;
            padding: 25px;
            background: rgba(30, 58, 95, 0.6);
            border-radius: 12px;
            text-align: center;
            border: 2px dashed var(--gold);
            font-family: 'Mountains of Christmas', cursive;
        }
        
        .total p {
            margin: 0;
        }
        
        .total b {
            font-size: 1.8rem;
            color: var(--white);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .button-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 35px;
        }
        
        button {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 200px;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        
        .delete-btn {
            background: linear-gradient(145deg, #dc3545, #c82333);
            color: white;
        }
        
        .delete-btn:hover {
            background: linear-gradient(145deg, #bb2d3b, #a71e2c);
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--gold), #ffcc00);
            color: var(--dark-brown);
            border: 2px solid #ff9900;
        }
        
        .submit-btn:hover {
            background: linear-gradient(145deg, #ffcc00, #ff9900);
            color: #000;
            border-color: var(--gold);
        }
        
        .back-btn {
            background: linear-gradient(145deg, var(--blue), #2a5298);
            color: white;
            text-decoration: none;
        }
        
        .back-btn:hover {
            background: linear-gradient(145deg, #1e3a5f, #152642);
        }
        
        .empty-cart {
            text-align: center;
            padding: 60px;
            color: var(--gold);
            font-size: 1.8rem;
            background: rgba(30, 58, 95, 0.8);
            border-radius: 15px;
            border: 3px dashed var(--gold);
            margin: 60px auto;
            max-width: 600px;
            font-family: 'Mountains of Christmas', cursive;
        }
        
        .empty-cart p {
            margin: 0;
        }
        
        .shopping-btn {
            background: linear-gradient(145deg, var(--green), #0d7242);
            color: white;
            margin-top: 30px;
            padding: 12px 25px;
            font-size: 1rem;
            min-width: auto;
        }
        
        .shopping-btn:hover {
            background: linear-gradient(145deg, #0d7242, #0a5c36);
        }
        
        .footer-decoration {
            text-align: center;
            margin-top: 50px;
            font-size: 2.5rem;
            color: var(--gold);
            padding: 20px;
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
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        h2 {
            text-align: center;
            color: var(--white);
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        
        @media (max-width: 768px) {
            .container {
                width: 98%;
                padding: 10px;
            }
            
            h1 {
                font-size: 2.5rem;
            }
            
            h1::before, h1::after {
                font-size: 1.8rem;
            }
            
            h1::before { left: 5%; }
            h1::after { right: 5%; }
            
            #cart {
                padding: 20px;
            }
            
            .button-group {
                flex-direction: column;
                align-items: center;
            }
            
            button {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ustvari snežinke
            for (let i = 0; i < 30; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 6 + 3}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                snowflake.style.animationDelay = `${Math.random() * 5}s`;
                document.body.appendChild(snowflake);
            }
            
            // Ustvari božične lučke
            for (let i = 0; i < 20; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00', '#ff9900', '#ff66cc'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                light.style.animationDelay = `${Math.random() * 2}s`;
                document.body.appendChild(light);
            }
            
            // Animacija za kosarico
            const cart = document.getElementById('cart');
            if (cart) {
                cart.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                cart.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
        });
    </script>
    <title>🎄 Zaključek nakupa 🎄</title>
</head>
<body>
    <div class="container">
        <h1>🎁 Zaključek nakupa 🎁</h1>
        
        <div class="nav-links">
            <p>✨
                <a href="<?php echo BASE_URL . "karte"; ?>">🎫 Vse karte</a> |
                <a href="<?php echo BASE_URL . "store"; ?>">🏪 Prodajalna</a>
            ✨</p>
        </div>

        <h2>🔍 Pregled vašega nakupa:</h2>

        <?php if (!empty($cart)): ?>
            
            <div id="cart">
                <div class="cart-header">
                    <h3>🛒 Vaša košarica</h3>
                </div>
                
                <?php foreach ($cart as $karta): ?>
                    <div class="cart-item">
                        <strong>📦 <?php echo htmlspecialchars($karta["naziv"]); ?></strong>
                        <p>📊 Količina: <?php echo htmlspecialchars($karta["quantity"]); ?></p>
                        <p>💰 Cena na kos: <?php echo number_format($karta["cena"], 2); ?> EUR</p>
                        <p>💵 Skupaj za izdelek: <?php echo number_format($karta["cena"] * $karta["quantity"], 2); ?> EUR</p>
                    </div>
                <?php endforeach; ?>

                <div class="total">
                    <p>🎯 Skupni znesek: <b><?php echo number_format($total, 2); ?> EUR</b></p>
                </div>

                <div class="button-group">
                    <form action="<?php echo BASE_URL . "store/purge-cart"; ?>" method="post">
                        <button type="submit" class="delete-btn">
                            🗑️ Pobriši košarico
                        </button>
                    </form>
                    
                    <form action="<?php echo BASE_URL . "store/order/submit"; ?>" method="post">
                        <button type="submit" class="submit-btn">
                            ✅ Oddaj naročilo
                        </button>
                    </form>
                    
                    <a href="<?php echo BASE_URL . "store"; ?>">
                        <button type="button" class="back-btn">
                            ↩️ Nazaj v trgovino
                        </button>
                    </a>
                </div>
            </div>
            
        <?php else: ?>
            <div class="empty-cart">
                <p>🎄 Vaša košarica je prazna. 🎄</p>
                <div style="margin-top: 30px;">
                    <a href="<?php echo BASE_URL . "store"; ?>">
                        <button type="button" class="shopping-btn">
                            🛍️ Nazaj v trgovino
                        </button>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="footer-decoration">
        🎅🤶🎄🦌🔔✨
    </div>
</body>
</html>