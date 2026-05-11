<!DOCTYPE html>
<html>
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
            font-size: 4rem;
            text-align: center;
            color: var(--gold);
            margin: 30px 0;
            padding: 20px;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            position: relative;
        }
        
        h1::before, h1::after {
            content: "🎁";
            font-size: 3rem;
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
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 15px auto;
            text-align: center;
            font-weight: bold;
            max-width: 800px;
        }
        
        .error-message {
            background: rgba(255, 0, 0, 0.2);
            border: 2px solid #ffcccc;
            color: #ffcccc;
        }
        
        .success-message {
            background: rgba(0, 255, 0, 0.2);
            border: 2px solid #ccffcc;
            color: #ccffcc;
        }
        
        .profile-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .profile-container h2 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2.5rem;
            margin-top: 0;
            border-bottom: 3px solid var(--red);
            padding-bottom: 10px;
        }
        
        .user-info {
            background: rgba(10, 92, 54, 0.3);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 5px solid var(--gold);
        }
        
        .info-row {
            margin: 12px 0;
            font-size: 1.1rem;
        }
        
        .info-label {
            color: var(--gold);
            font-weight: bold;
            display: inline-block;
            min-width: 200px;
        }
        
        .password-section {
            background: rgba(196, 30, 58, 0.2);
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
            border: 2px dashed var(--gold);
        }
        
        .password-section h3 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2rem;
            margin-top: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--gold);
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            color: #333;
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            margin: 20px auto;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        /* Božične animacije */
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        .christmas-light {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        .snowman {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 4rem;
            z-index: -1;
            animation: float 4s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
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
            for (let i = 0; i < 30; i++) {
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
            
            // Ustvari lučke
            for (let i = 0; i < 20; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                
                const colors = ['#ff0000', '#00ff00', '#ffff00', '#ffffff'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                light.style.backgroundColor = color;
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                
                document.body.appendChild(light);
            }
        });
    </script>
    <title>Profil</title>
</head>
<body>
    <!-- Božične dekoracije -->
    <div class="snowman">⛄</div>
    
    <h1>🎁 VAŠ PROFIL 🎁</h1>
    
    <div class="nav-links">
        ✨ <a href="<?php echo BASE_URL . "karte"; ?>">Vse karte</a> ✨ |
        ✨ <a href="<?php echo BASE_URL . "store"; ?>">Prodajalna</a> ✨
        <?php if (User::isSeller()): ?>
            ✨ | <a href="<?php echo BASE_URL . "orders"; ?>">Pregled naročil</a> ✨
        <?php endif; ?>
        ✨ | <a href="<?php echo BASE_URL . "profile/edit"; ?>">Uredi profil</a> ✨
    </div>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="message error-message">
            ⚠️ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="message success-message">
            ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <div class="profile-container">
        <h2>🎄 PODATKI UPORABNIKA: 🎄</h2>
        
        <div class="user-info">
            <div class="info-row">
                <span class="info-label">👤 Ime:</span>
                <?php echo htmlspecialchars(isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : ''); ?>
            </div>
            <div class="info-row">
                <span class="info-label">🧑 Priimek:</span>
                <?php echo htmlspecialchars(isset($_SESSION["user"]["surname"]) ? $_SESSION["user"]["surname"] : ''); ?>
            </div>
            <div class="info-row">
                <span class="info-label">📧 Email:</span>
                <?php echo htmlspecialchars(isset($_SESSION["user"]["email"]) ? $_SESSION["user"]["email"] : ''); ?>
            </div>
            
            <?php if (User::isBuyer()): ?>
                <div class="info-row">
                    <span class="info-label">🏠 Ulica:</span>
                    <?php echo htmlspecialchars(isset($_SESSION["user"]["address_street"]) ? $_SESSION["user"]["address_street"] : ''); ?>
                </div>
                <div class="info-row">
                    <span class="info-label">🔢 Hišna številka:</span>
                    <?php echo htmlspecialchars(isset($_SESSION["user"]["address_number"]) ? $_SESSION["user"]["address_number"] : ''); ?>
                </div>
                <div class="info-row">
                    <span class="info-label">📮 Pošta:</span>
                    <?php echo htmlspecialchars(isset($_SESSION["user"]["address_post"]) ? $_SESSION["user"]["address_post"] : ''); ?>
                </div>
                <div class="info-row">
                    <span class="info-label">📮 Poštna številka:</span>
                    <?php echo htmlspecialchars(isset($_SESSION["user"]["address_zip"]) ? $_SESSION["user"]["address_zip"] : ''); ?>
                </div>
                
                <div class="info-row">
                    <span class="info-label">📍 Celoten naslov:</span>
                    <?php 
                    $address_parts = array();
                    
                    $ulica_hisna = '';
                    if (isset($_SESSION["user"]["address_street"]) && !empty($_SESSION["user"]["address_street"])) {
                        $ulica_hisna = $_SESSION["user"]["address_street"];
                    }
                    if (isset($_SESSION["user"]["address_number"]) && !empty($_SESSION["user"]["address_number"])) {
                        if (!empty($ulica_hisna)) {
                            $ulica_hisna .= ' ' . $_SESSION["user"]["address_number"];
                        } else {
                            $ulica_hisna = $_SESSION["user"]["address_number"];
                        }
                    }
                    if (!empty($ulica_hisna)) {
                        $address_parts[] = $ulica_hisna;
                    }
                    
                    $posta_postna = '';
                    if (isset($_SESSION["user"]["address_post"]) && !empty($_SESSION["user"]["address_post"])) {
                        $posta_postna = $_SESSION["user"]["address_post"];
                    }
                    if (isset($_SESSION["user"]["address_zip"]) && !empty($_SESSION["user"]["address_zip"])) {
                        if (!empty($posta_postna)) {
                            $posta_postna = $_SESSION["user"]["address_zip"] . ' ' . $posta_postna;
                        } else {
                            $posta_postna = $_SESSION["user"]["address_zip"];
                        }
                    }
                    if (!empty($posta_postna)) {
                        $address_parts[] = $posta_postna;
                    }

                    echo htmlspecialchars(implode(', ', $address_parts));
                    ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="password-section">
            <h3>🔐 Sprememba gesla</h3>
            <form method="post" action="<?php echo BASE_URL . "profile/change-password"; ?>">
                <div class="form-group">
                    <label>🔑 Staro geslo:</label>
                    <input type="password" name="oldPassword" required>
                </div>
                <div class="form-group">
                    <label>🆕 Novo geslo:</label>
                    <input type="password" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label>🔄 Ponovi novo geslo:</label>
                    <input type="password" name="confirmPassword" required>
                </div>
                <button class="submit-btn" type="submit">
                    🎅 Spremeni geslo
                </button>
            </form>
        </div>
    </div>
    
    <div class="footer-decoration">
        🎅🎄✨🦌🔔❄️🎁⛄
    </div>
</body>
</html>