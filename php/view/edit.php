<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Urejanje profila</title>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . "style.css"; ?>">
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
            content: "👤";
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
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 15px auto;
            text-align: center;
            font-weight: bold;
            max-width: 600px;
        }
        
        .success-message {
            background: rgba(0, 255, 0, 0.2);
            border: 2px solid #ccffcc;
            color: #ccffcc;
        }
        
        .error-message {
            background: rgba(255, 0, 0, 0.2);
            border: 2px solid #ffcccc;
            color: #ffcccc;
        }
        
        .edit-form {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--gold);
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            color: #333;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 10px var(--red);
        }
        
        .address-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px dashed var(--gold);
        }
        
        .address-section h3 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 1.8rem;
            margin-bottom: 20px;
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
            margin: 30px auto;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-link a {
            color: var(--gold);
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid var(--gold);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            background: var(--gold);
            color: var(--blue);
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
        
        .user-ornament {
            position: fixed;
            bottom: 20px;
            left: 20px;
            font-size: 3rem;
            z-index: -1;
            animation: float 4s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 20; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 6 + 3}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                document.body.appendChild(snowflake);
            }
            
            for (let i = 0; i < 12; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                document.body.appendChild(light);
            }
            
            const ornament = document.createElement('div');
            ornament.classList.add('user-ornament');
            ornament.innerHTML = '🎅';
            document.body.appendChild(ornament);
        });
    </script>
</head>
<body>
    <h1>👤 UREJANJE PROFILA 👤</h1>
    
    <div class="nav-links">
        ✨ <a href="<?php echo BASE_URL . "karte"; ?>">🎫 Vse karte</a> ✨ |
        ✨ <a href="<?php echo BASE_URL . "store"; ?>">🏪 Prodajalna</a> ✨ |
        ✨ <a href="<?php echo BASE_URL . "profile"; ?>">👤 Nazaj na profil</a> ✨
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="message success-message">
            ✅ <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="message error-message">
            ⚠️ <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
    
    <form class="edit-form" method="POST" action="<?php echo BASE_URL . "profile/edit"; ?>">
        <div class="form-group">
            <label>👤 Ime:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars(isset($user['name']) ? $user['name'] : ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>🧑 Priimek:</label>
            <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars(isset($user['surname']) ? $user['surname'] : ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>📧 Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars(isset($user['email']) ? $user['email'] : ''); ?>" required>
        </div>
        
        <?php if (User::isBuyer()): ?>
            <div class="address-section">
                <h3>🏠 Naslov</h3>
                <div class="form-group">
                    <label>🏠 Ulica:</label>
                    <input type="text" id="address_street" name="address_street" value="<?php echo htmlspecialchars(isset($user['address_street']) ? $user['address_street'] : ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>🔢 Hišna številka:</label>
                    <input type="text" id="address_number" name="address_number" value="<?php echo htmlspecialchars(isset($user['address_number']) ? $user['address_number'] : ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>📮 Pošta:</label>
                    <input type="text" id="address_post" name="address_post" value="<?php echo htmlspecialchars(isset($user['address_post']) ? $user['address_post'] : ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>📮 Poštna številka:</label>
                    <input type="text" id="address_zip" name="address_zip" value="<?php echo htmlspecialchars(isset($user['address_zip']) ? $user['address_zip'] : ''); ?>">
                </div>
            </div>
        <?php endif; ?>
        
        <button class="submit-btn" type="submit">
            🎄 Shrani spremembe
        </button>
    </form>
    
    <div class="back-link">
        <a href="<?php echo BASE_URL . "profile"; ?>">🎅 Nazaj na profil</a>
    </div>
    
    <div class="footer-decoration">
        🎅🎄✨👤🔔🎁
    </div>
</body>
</html>