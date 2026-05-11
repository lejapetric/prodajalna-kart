<!DOCTYPE html>
<html lang="sl">
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
            max-width: 800px;
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
        
        .add-form {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        h3 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2.2rem;
            margin-top: 0;
            border-bottom: 2px solid var(--red);
            padding-bottom: 10px;
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
        input[type="email"],
        input[type="password"] {
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
        
        .status-section {
            background: rgba(10, 92, 54, 0.3);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px dashed var(--gold);
        }
        
        .status-section p {
            margin: 10px 0;
        }
        
        .status-section label {
            display: inline-block;
            margin-right: 30px;
            cursor: pointer;
        }
        
        .status-section input[type="radio"] {
            margin-right: 10px;
            transform: scale(1.2);
        }
        
        .password-hint {
            font-size: 0.9rem;
            color: #ccc;
            margin-top: 5px;
            font-style: italic;
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
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: block;
            margin: 30px auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
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
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                alert('Gesli se ne ujemata! Prosimo, preverite vnos.');
                return false;
            }
            
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[@\$!%*?&]/.test(password)
            };
            
            if (!requirements.length || !requirements.upper || !requirements.lower || !requirements.number || !requirements.special) {
                alert('Geslo ne izpolnjuje vseh zahtev. Geslo mora vsebovati vsaj 8 znakov, eno veliko črko, eno malo črko, eno številko in en poseben znak (@$!%*?&).');
                return false;
            }
            
            return true;
        }
        
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
            
            document.querySelector('form').addEventListener('submit', function(event) {
                if (!checkPasswordMatch()) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <title>Dodaj kupca</title>
</head>
<body>
    <h1>👤 DODAJ KUPCIA 👤</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "buyers" ?>">👥 Vsi kupci</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="message success-message">
            ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="message error-message">
            ⚠️ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <form class="add-form" method="post" action="<?php echo BASE_URL . "buyer/add"; ?>">   
        <h3>🎄 Vnesite podatke novega kupca: </h3>
        
        <div class="form-group">
            <label>👤 Ime:</label>
            <input type="text" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" autofocus required/>
        </div>
        
        <div class="form-group">
            <label>🧑 Priimek:</label>
            <input type="text" name="surname" value="<?= isset($surname) ? htmlspecialchars($surname) : '' ?>" required/>
        </div>
        
        <div class="form-group">
            <label>📧 E-poštni naslov:</label>
            <input type="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required />
        </div>
        
        <div class="form-group">
            <label>🏠 Ulica:</label>
            <input type="text" name="address_street" value="<?= isset($address_street) ? htmlspecialchars($address_street) : '' ?>" required/>
        </div>
        
        <div class="form-group">
            <label>🔢 Hišna številka:</label>
            <input type="text" name="address_number" value="<?= isset($address_number) ? htmlspecialchars($address_number) : '' ?>" required/>
        </div>
        
        <div class="form-group">
            <label>📮 Pošta:</label>
            <input type="text" name="address_post" value="<?= isset($address_post) ? htmlspecialchars($address_post) : '' ?>" required/>
        </div>
        
        <div class="form-group">
            <label>📮 Poštna številka:</label>
            <input type="text" name="address_zip" value="<?= isset($address_zip) ? htmlspecialchars($address_zip) : '' ?>" required/>
        </div>
        
        <div class="status-section">
            <p><strong>🎁 Status kupca:</strong></p>
            <p>
                <label>
                    <input type="radio" name="aktiviran" value="1" <?= (isset($aktiviran) && $aktiviran == 1) ? 'checked' : 'checked' ?>>
                    🟢 Aktiviran (kupec lahko kupuje)
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="aktiviran" value="0" <?= (isset($aktiviran) && $aktiviran == 0) ? 'checked' : '' ?>>
                    🔴 Deaktiviran (kupec ne more kupovati)
                </label>
            </p>
            <small style="color: #ccc;">Deaktiviran kupec se bo prikazal z rdečo barvo in ❌ simbolom na seznamu kupcev.</small>
        </div>
        
        <div class="form-group">
            <label>🔑 Geslo:</label>
            <input type="password" name="password" id="password" required 
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@\$!%*?&])[A-Za-z\d@\$!%*?&]{8,}$"
                   title="Geslo mora vsebovati vsaj 8 znakov, eno veliko črko, eno malo črko, eno številko in en poseben znak." />
            <div class="password-hint">
                Zahteva: vsaj 8 znakov, velika črka, mala črka, številka, poseben znak (@$!%*?&)
            </div>
        </div>
        
        <div class="form-group">
            <label>🔄 Potrdi geslo:</label>
            <input type="password" name="confirm_password" id="confirm_password" required />
        </div>
        
        <button class="submit-btn" type="submit">
            🎅 Dodaj kupca
        </button>
    </form>
    
    <div class="footer-decoration">
        🎄👤✨🦌🔔🎁
    </div>
</body>
</html>