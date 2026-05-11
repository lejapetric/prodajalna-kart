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
            --silver: #c0c0c0;
            --white: #fffaf0;
            --blue: #1e3a5f;
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #0a5c36 0%, #0d7242 25%, #c41e3a 50%, #8b0000 75%, #1e3a5f 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--white);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 1px, transparent 2px),
                radial-gradient(circle at 90% 40%, rgba(255, 255, 255, 0.1) 1px, transparent 2px),
                radial-gradient(circle at 50% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 2px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: -1;
        }
        
        /* Snežinke */
        .snowflake {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            z-index: 1000;
        }
        
        /* Animacije */
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes glow {
            0%, 100% { text-shadow: 0 0 10px var(--gold), 0 0 20px var(--gold); }
            50% { text-shadow: 0 0 20px var(--gold), 0 0 40px var(--gold), 0 0 60px var(--gold); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Glavni naslov */
        h1 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 4rem;
            text-align: center;
            color: var(--gold);
            margin: 30px 0;
            padding: 20px;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            animation: glow 3s infinite alternate;
            position: relative;
            letter-spacing: 3px;
        }
        
        h1::before, h1::after {
            content: "🎄";
            font-size: 3rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            animation: float 4s infinite ease-in-out;
        }
        
        h1::before {
            left: 10%;
        }
        
        h1::after {
            right: 10%;
        }
        
        /* Podnaslovi */
        h2, h3 {
            font-family: 'Mountains of Christmas', cursive;
            color: var(--gold);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            font-size: 2.2rem;
            margin: 25px 0;
            padding-left: 15px;
            border-left: 5px solid var(--red);
            position: relative;
        }
        
        h2::after {
            content: " 🎁";
        }
        
        /* Paragrafi */
        p {
            font-size: 1.2rem;
            line-height: 1.7;
            margin: 15px 0;
        }
        
        /* Gumbi */
        button {
            padding: 15px 30px;
            margin: 10px;
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        
        button:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s;
            z-index: -1;
        }
        
        button:hover::before {
            left: 100%;
        }
        
        /* Posebni božični gumbi */
        .christmas-btn {
            background: linear-gradient(145deg, var(--green), #0d7242);
            border: 2px solid var(--gold);
        }
        
        .christmas-btn:hover {
            background: linear-gradient(145deg, #0d7242, var(--green));
        }
        
        /* Navigacijski gumbi */
        .nav-buttons {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: rgba(10, 92, 54, 0.7);
            border-radius: 20px;
            border: 3px dashed var(--gold);
            position: relative;
        }
        
        .nav-buttons::before {
            content: "✨";
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2rem;
            animation: twinkle 2s infinite;
        }
        
        .nav-buttons a button {
            background: linear-gradient(145deg, var(--blue), #2a5298);
            margin: 8px;
            padding: 12px 25px;
            font-size: 1.1rem;
        }
        
        /* Avtentikacijski gumbi */
        .auth-buttons {
            display: flex;
            justify-content: center;
            margin: 20px 0 40px;
            gap: 15px;
        }
        
        .auth-buttons a button {
            background: linear-gradient(145deg, #8b0000, var(--red));
            position: relative;
            padding-left: 50px;
        }
        
        .auth-buttons a button::after {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.3rem;
        }
        
        .auth-buttons a[href*="prijava"] button::after {
            content: "🔑";
        }
        
        .auth-buttons a[href*="registracija"] button::after {
            content: "📝";
        }
        
        .auth-buttons a[href*="logout"] button::after {
            content: "🚪";
        }
        
        /* Glavna vsebina - grid za karte in košarico */
        .main-container {
            display: grid;
            grid-template-columns: 1fr 350px; /* Karte na levi, košarica na desni */
            gap: 30px;
            max-width: 1600px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        /* Karte */
        #karte-container {
            background: rgba(30, 58, 95, 0.7);
            padding: 30px;
            border-radius: 25px;
            border: 3px solid var(--gold);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            position: relative;
        }
        
        #karte-container::before {
            content: "✨ IZBERITE SVOJO VSTOPNICO ✨";
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--red);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .karte-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .karta {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            border: 2px solid var(--gold);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .karta:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border-color: var(--silver);
        }
        
        .karta::before {
            content: "🎫";
            font-size: 3rem;
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.3;
        }
        
        .karta p:first-of-type {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--gold);
            margin-bottom: 15px;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .karta p:nth-of-type(2) {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            background: rgba(196, 30, 58, 0.8);
            padding: 10px;
            border-radius: 10px;
            margin: 15px 0;
        }
        
        /* Košarica - fiksna na desni strani */
        #cart-sidebar {
            position: sticky;
            top: 30px;
            height: fit-content;
            background: linear-gradient(145deg, rgba(10, 92, 54, 0.9), rgba(30, 58, 95, 0.9));
            padding: 25px;
            border-radius: 25px;
            border: 3px solid var(--gold);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        #cart-sidebar::before {
            content: "🛒";
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--blue);
            color: white;
            font-size: 2rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        #cart-sidebar h3 {
            text-align: center;
            font-size: 2.2rem;
            color: var(--gold);
            margin-top: 0;
            margin-bottom: 25px;
        }
        
        #cart-sidebar h3::after {
            content: " 🎅";
        }
        
        .cart-items {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
        }
        
        .cart-items::-webkit-scrollbar {
            width: 8px;
        }
        
        .cart-items::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .cart-items::-webkit-scrollbar-thumb {
            background: var(--gold);
            border-radius: 10px;
        }
        
        .cart-item-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            margin: 15px 0;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 5px solid var(--red);
        }
        
        .update-cart {
            width: 70px;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid var(--gold);
            background: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            text-align: center;
            color: #333;
        }
        
        .cart-total {
            font-size: 1.8rem;
            text-align: center;
            margin: 25px 0;
            padding: 20px;
            background: rgba(196, 30, 58, 0.2);
            border-radius: 15px;
            border: 2px dashed var(--gold);
        }
        
        .cart-total b {
            color: var(--gold);
            font-size: 2rem;
        }
        
        .cart-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .cart-actions button {
            margin: 0;
            width: 100%;
        }
        
        /* Košarica je prazna */
        .empty-cart-sidebar {
            text-align: center;
            padding: 40px 20px;
            color: var(--gold);
        }
        
        .empty-cart-sidebar p {
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-family: 'Mountains of Christmas', cursive;
        }
        
        /* Opozorila */
        .warning {
            color: #ffcccc;
            background: rgba(196, 30, 58, 0.3);
            padding: 15px;
            border-radius: 15px;
            border-left: 5px solid #ffcccc;
            margin: 15px 0;
            font-weight: bold;
            font-size: 1rem;
        }
        
        /* Varnostno obarvanje besedila */
        .safe-text {
            color: var(--gold);
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        /* Božični okraski */
        .ornament {
            position: fixed;
            width: 40px;
            height: 40px;
            background: var(--red);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .ornament::after {
            content: "";
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            background: var(--gold);
            border-radius: 50%;
        }
        
        /* Božična lučka */
        .light {
            position: fixed;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        /* Sani */
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
        
        /* Božično drevo */
        .christmas-tree {
            position: fixed;
            bottom: 0;
            left: 50px;
            font-size: 5rem;
            z-index: -1;
            filter: drop-shadow(0 0 10px rgba(0, 255, 0, 0.5));
            animation: float 6s infinite ease-in-out;
        }
        
        /* Santa hat na logout gumbu */
        .santa-hat::before {
            content: "🎅";
            position: absolute;
            top: -15px;
            right: -5px;
            font-size: 1.5rem;
            transform: rotate(15deg);
        }
        
        /* Ogrevalno ozadje za mraz */
        .frost-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 95%, rgba(255, 255, 255, 0.1) 100%);
            pointer-events: none;
            z-index: -1;
        }
        
        /* Medeni možic */
        .gingerbread-man {
            position: fixed;
            bottom: 20px;
            right: 100px;
            font-size: 4rem;
            animation: float 5s infinite ease-in-out;
            z-index: -1;
        }
        
        /* Zvonček */
        .bell {
            position: fixed;
            top: 100px;
            right: 50px;
            font-size: 3rem;
            animation: rotate 5s infinite linear;
            z-index: -1;
        }
        
        /* Božično sporočilo na dnu */
        .christmas-footer {
            text-align: center;
            margin: 50px 0 30px;
            padding: 30px;
            background: rgba(196, 30, 58, 0.2);
            border-radius: 20px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .christmas-footer p {
            font-size: 1.8rem;
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            margin: 10px 0;
        }
        
        /* Responsive design */
        @media (max-width: 1200px) {
            .main-container {
                grid-template-columns: 1fr;
                max-width: 1000px;
            }
            
            #cart-sidebar {
                position: static;
                margin-top: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .karte-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            h1 {
                font-size: 3rem;
            }
            
            .nav-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <!-- Božični dekoracije -->
    <div class="sleigh">🛷</div>
    <div class="christmas-tree">🎄</div>
    <div class="gingerbread-man">🍪</div>
    <div class="bell">🔔</div>
    <div class="frost-effect"></div>
    
    <!-- Generiranje snežink -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ustvari snežinke
            for (let i = 0; i < 50; i++) {
                createSnowflake();
            }
            
            // Ustvari lučke
            for (let i = 0; i < 30; i++) {
                createLight();
            }
            
            // Ustvari okraske
            for (let i = 0; i < 20; i++) {
                createOrnament();
            }
        });
        
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            
            // Naključna velikost
            const size = Math.random() * 10 + 5;
            snowflake.style.width = `${size}px`;
            snowflake.style.height = `${size}px`;
            
            // Naključna začetna pozicija
            snowflake.style.left = `${Math.random() * 100}vw`;
            snowflake.style.top = `${Math.random() * 100}vh`;
            
            // Naključna hitrost
            const duration = Math.random() * 10 + 10;
            snowflake.style.animation = `fall ${duration}s linear infinite`;
            
            document.body.appendChild(snowflake);
            
            // Dodaj stil za padanje
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes fall {
                    to {
                        transform: translateY(100vh);
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        function createLight() {
            const light = document.createElement('div');
            light.classList.add('light');
            
            // Naključna barva
            const colors = ['#ff0000', '#00ff00', '#ffff00', '#00ffff', '#ff00ff', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            light.style.backgroundColor = color;
            
            // Naključna pozicija
            light.style.left = `${Math.random() * 100}vw`;
            light.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(light);
        }
        
        function createOrnament() {
            const ornament = document.createElement('div');
            ornament.classList.add('ornament');
            
            // Naključna barva
            const colors = ['#c41e3a', '#0a5c36', '#ffd700', '#1e3a5f', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            ornament.style.backgroundColor = color;
            
            // Naključna pozicija
            ornament.style.left = `${Math.random() * 100}vw`;
            ornament.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(ornament);
        }
    </script>
    
    <div style="text-align: center; position: relative;">
        <!-- Animirani naslov -->
        <h1>🎅 BOŽIČNA PRODAJALNA VSTOPNIC 🎅</h1>
        
        <!-- Podnaslov z zvezdicami -->
        <p style="text-align: center; font-size: 1.5rem; color: var(--gold); margin-top: -20px;">
            ✨ Kjer se uresničijo vaši praznični dogodki! ✨
        </p>
        
        <!-- Avtentikacijski gumbi z božičnimi ikonami -->
        <div class="auth-buttons">
            <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"])): ?>
                <a href="<?= BASE_URL . "logout" ?>" class="santa-hat">
                    <button class="christmas-btn">
                        <?php 
                        // Varno prikaži ime
                        if (isset($_SESSION["user"]["name"]) && isset($_SESSION["user"]["surname"])) {
                            echo "Odjavi se, " . htmlspecialchars($_SESSION["user"]["name"] . " " . $_SESSION["user"]["surname"]);
                        } elseif (isset($_SESSION["user"]["name"])) {
                            echo "Odjavi se, " . htmlspecialchars($_SESSION["user"]["name"]);
                        } else {
                            echo "Odjavi se";
                        }
                        ?>
                    </button>
                </a>
            <?php else: ?>
                <a href="<?= BASE_URL . "prijava" ?>"><button>🎅 Prijava</button></a>
                <a href="<?= BASE_URL . "registracija" ?>"><button>📜 Registracija</button></a>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Navigacija z božičnimi ikonami -->
    <div class="nav-buttons">
        <a href="<?= BASE_URL . "karte" ?>"><button>🎫 Vse karte</button></a>
        
        <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] != 'ADMIN'): ?>
            <a href="<?php echo BASE_URL . "orders"; ?>"><button>📋 Pregled naročil</button></a>
        <?php endif; ?>
        
        <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"])): 
            if (isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == 'SELLER'): ?>
                <a href="<?= BASE_URL . "buyers" ?>"><button>👥 Vsi kupci</button></a>
            <?php endif; ?>    
            <?php if (isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == 'ADMIN'): ?>
                <a href="<?= BASE_URL . "sellers" ?>"><button>🏪 Vsi prodajalci</button></a>
            <?php endif; ?>
            <a href="<?= BASE_URL . "profile/" ?>" ><button>👤 Moj profil</button></a>
        <?php endif; ?>
    </div>
    
    <!-- Glavni naslov s snežakom -->
    <h2 style="max-width: 1600px; margin: 30px auto 0 auto; padding: 0 20px;">⛄ Preglejte našo čarobno praznično ponudbo: ⛄</h2>
    
    <!-- Glavni del s kartami in košarico -->
    <div class="main-container">
        <!-- Karte na levi -->
        <div id="karte-container">
            <div class="karte-grid">
                <?php foreach ($karte as $karta): 
                    if ($karta["aktiviran"] == 1): ?>
                        <div class="karta">
                            <p><?= $karta["naziv"] ?></p>
                            <p><?= number_format($karta["cena"], 2) ?> EUR</p>
                            
                            <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == 'BUYER'): ?>
                                <form action="<?= BASE_URL . "store/add-to-cart" ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $karta["id"] ?>" />
                                    <button style="background: linear-gradient(145deg, #0a5c36, #0d7242); margin: 10px 0 0 0;">
                                        🛒 Dodaj v košarico
                                    </button>
                                </form>
                            <?php elseif (!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                                <div class="warning">
                                    🚫 Za nakup se morate prijaviti kot kupec!
                                </div>
                            <?php else: ?>
                                <div class="warning">
                                    🚫 Nakup je omogočen samo kupcem!
                                </div>
                            <?php endif; ?>
                        </div>
                <?php endif;
                endforeach; ?>
            </div>
        </div>
        
        <!-- Košarica na desni -->
        <div id="cart-sidebar">
            <h3>🦌 Vaša košarica</h3>
            
            <?php if (!empty($cart)): ?>
                <div class="cart-items">
                    <?php foreach ($cart as $karta): ?>
                        <form action="<?= BASE_URL . "store/update-cart" ?>" method="post" class="cart-item-form">
                            <input type="hidden" name="id" value="<?= $karta["id"] ?>" />
                            <input type="number" name="quantity" value="<?= $karta["quantity"] ?>" class="update-cart" min="1" />
                            &times; <span class="safe-text"><?= $karta["naziv"] ?></span> 
                            <button style="padding: 8px 15px; font-size: 0.9rem; margin: 0;">🔄</button> 
                        </form>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-total">
                    <p>Skupaj: <b><?= number_format($total, 2) ?> EUR</b></p>
                </div>
                
                <div class="cart-actions">
                    <form action="<?= BASE_URL . "store/purge-cart" ?>" method="post">
                        <button style="background: linear-gradient(145deg, #8b0000, #660000);">
                            🗑️ Pobriši košarico
                        </button>
                    </form>
                    
                    <?php if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && isset($_SESSION["user"]["type"]) && $_SESSION["user"]["type"] == 'BUYER'): ?>
                        <form action="<?= BASE_URL . "store/order" ?>" method="post">
                            <button style="background: linear-gradient(145deg, #0a5c36, #0d7242);">
                                🎄 Zaključi nakup
                            </button>
                        </form>
                    <?php elseif (!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <div class="warning">
                            🔒 Za zaključek nakupa se morate prijaviti!
                        </div>
                    <?php else: ?>
                        <div class="warning">
                            🔒 Za zaključek nakupa morate biti kupec!
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="empty-cart-sidebar">
                    <p>🎁 Vaša košarica je prazna</p>
                    <p style="font-size: 1rem; color: #ccc;">Dodajte karte iz ponudbe na levi strani</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Božično sporočilo na dnu -->
    <div class="christmas-footer">
        <p>🎅 Vesel božič in srečno novo leto! 🎄</p>
        <p style="font-size: 1.2rem;">
            Hvala, da ste obiskali našo božično prodajalno vstopnic! Želimo vam čudovite praznike polne radosti, ljubezni in nepozabnih dogodkov! ✨
        </p>
        <div style="font-size: 3rem; margin-top: 20px;">
            🎄🎅🦌🎁🌟🔔❄️☃️
        </div>
    </div>
</body>
</html>
