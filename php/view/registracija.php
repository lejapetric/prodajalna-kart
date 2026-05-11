<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
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
            display: flex;
            flex-direction: column;
            align-items: center;
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
        
        .container {
            max-width: 700px;
            width: 90%;
            margin-top: 30px;
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
            content: "🎁";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: 5%; }
        h1::after { right: 5%; }
        
        .nav-links {
            background: rgba(30, 58, 95, 0.7);
            padding: 15px;
            border-radius: 15px;
            margin: 20px auto;
            border: 2px solid var(--gold);
            text-align: center;
            width: 100%;
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
        
        .register-form {
            background: rgba(30, 58, 95, 0.8);
            border: 3px solid var(--gold);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
        }
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            text-align: center;
            font-weight: bold;
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
        
        h3 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2rem;
            margin: 25px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--red);
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
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            color: #333;
            box-sizing: border-box;
        }
        
        input:focus,
        select:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 10px var(--red);
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .address-section {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .password-requirements {
            font-size: 0.9rem;
            color: #ccc;
            margin-top: 5px;
            padding: 10px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 8px;
            border-left: 3px solid var(--gold);
        }
        
        .password-match {
            font-size: 0.9rem;
            color: #00ff00;
            margin-top: 5px;
            display: none;
        }
        
        .password-mismatch {
            font-size: 0.9rem;
            color: #ff4444;
            margin-top: 5px;
            display: none;
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            padding: 15px 30px;
            border: none;
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
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gold);
            font-size: 1.1rem;
            padding: 15px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 10px;
            border: 1px dashed var(--gold);
        }
        
        .login-link a {
            color: var(--gold);
            text-decoration: underline;
            font-weight: bold;
        }
        
        .login-link a:hover {
            color: var(--white);
        }
        
        .footer-decoration {
            text-align: center;
            margin: 50px 0 30px;
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
        
        .christmas-tree {
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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Snežinke
            for (let i = 0; i < 30; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 8 + 4}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                document.body.appendChild(snowflake);
            }
            
            // Lučke
            for (let i = 0; i < 18; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                document.body.appendChild(light);
            }
            
            // Božično drevo
            const tree = document.createElement('div');
            tree.classList.add('christmas-tree');
            tree.innerHTML = '🎄';
            document.body.appendChild(tree);
            
            // Funkcije za obrazec
            toggleAddressFields();
            
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            
            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
            
            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm_password').value;
                
                if (password !== confirmPassword) {
                    event.preventDefault();
                    alert('🎅 Gesli se ne ujemata! Prosimo, preverite vnos.');
                    document.getElementById('confirm_password').focus();
                    return false;
                }
                
                const requirements = {
                    length: password.length >= 8,
                    upper: /[A-Z]/.test(password),
                    lower: /[a-z]/.test(password),
                    number: /\d/.test(password),
                    special: /[@$!%*?&]/.test(password)
                };
                
                if (!requirements.length || !requirements.upper || !requirements.lower || !requirements.number || !requirements.special) {
                    event.preventDefault();
                    alert('🎅 Geslo ne izpolnjuje vseh zahtev. Prosimo, preberite zahteve za geslo.');
                    document.getElementById('password').focus();
                    return false;
                }
            });
        });
        
        function toggleAddressFields() {
            const userType = document.getElementById('userType').value;
            const addressSection = document.getElementById('addressSection');
            
            if (userType === 'BUYER') {
                addressSection.style.display = 'block';
                addressSection.style.maxHeight = '500px';
                addressSection.style.opacity = '1';
                
                // Nastavi zahtevana polja
                document.getElementById('address_street').required = true;
                document.getElementById('address_number').required = true;
                document.getElementById('address_post').required = true;
                document.getElementById('address_zip').required = true;
            } else {
                addressSection.style.display = 'none';
                addressSection.style.maxHeight = '0';
                addressSection.style.opacity = '0';
                
                // Odstrani zahtevana polja
                document.getElementById('address_street').required = false;
                document.getElementById('address_number').required = false;
                document.getElementById('address_post').required = false;
                document.getElementById('address_zip').required = false;
            }
        }
        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const matchElement = document.getElementById('passwordMatch');
            const mismatchElement = document.getElementById('passwordMismatch');
            
            if (confirmPassword === '') {
                matchElement.style.display = 'none';
                mismatchElement.style.display = 'none';
                return;
            }
            
            if (password === confirmPassword) {
                matchElement.style.display = 'block';
                mismatchElement.style.display = 'none';
            } else {
                matchElement.style.display = 'none';
                mismatchElement.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>🎅 REGISTRACIJA 🎅</h1>
        
        <div class="nav-links">
            ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Vse karte</a> ✨ |
            ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨ |
            ✨ <a href="<?= BASE_URL . "prijava" ?>">🔑 Prijava</a> ✨
        </div>

        <div class="register-form">
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
            
            <form method="POST" action="<?php echo BASE_URL . "registracija"; ?>" id="registrationForm">
                <h3>🎄 Osnovni podatki</h3>
                
                <div class="form-group">
                    <label>👤 Tip uporabnika:</label>
                    <select name="type" id="userType" required onchange="toggleAddressFields()">
                        <option value="BUYER" <?php echo (isset($type) && $type == 'BUYER') ? 'selected' : ''; ?>>🎅 Kupec</option>
                        <option value="SELLER" <?php echo (isset($type) && $type == 'SELLER') ? 'selected' : ''; ?>>🏪 Prodajalec</option>
                    </select>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>👤 Ime:</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars(isset($name) ? $name : ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>🧑 Priimek:</label>
                        <input type="text" name="surname" value="<?php echo htmlspecialchars(isset($surname) ? $surname : ''); ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>📧 Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars(isset($email) ? $email : ''); ?>" required>
                </div>
                
                <h3>🔐 Varnostni podatki</h3>
                
                <div class="form-group">
                    <label>🔑 Geslo:</label>
                    <input type="password" name="password" id="password" required 
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                           title="Geslo mora vsebovati vsaj 8 znakov, eno veliko črko, eno malo črko, eno številko in en poseben znak." />
                    <div class="password-requirements">
                        <strong>🎅 Zahteve za geslo:</strong><br>
                        • Vsaj 8 znakov<br>
                        • Vsaj ena velika črka (A-Z)<br>
                        • Vsaj ena mala črka (a-z)<br>
                        • Vsaj ena številka (0-9)<br>
                        • Vsaj en poseben znak (@$!%*?&)
                    </div>
                </div>
                
                <div class="form-group">
                    <label>🔄 Potrdi geslo:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required />
                    <div class="password-match" id="passwordMatch">✅ Gesli se ujemata</div>
                    <div class="password-mismatch" id="passwordMismatch">❌ Gesli se ne ujemata</div>
                </div>
                
                <div id="addressSection" class="address-section">
                    <h3>🏠 Naslov (samo za kupce)</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>🏠 Ulica:</label>
                            <input type="text" name="address_street" id="address_street" value="<?php echo htmlspecialchars(isset($address_street) ? $address_street : ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>🔢 Hišna številka:</label>
                            <input type="text" name="address_number" id="address_number" value="<?php echo htmlspecialchars(isset($address_number) ? $address_number : ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>📮 Pošta:</label>
                            <input type="text" name="address_post" id="address_post" value="<?php echo htmlspecialchars(isset($address_post) ? $address_post : ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>📮 Poštna številka:</label>
                            <input type="text" name="address_zip" id="address_zip" value="<?php echo htmlspecialchars(isset($address_zip) ? $address_zip : ''); ?>">
                        </div>
                    </div>
                </div>
                
                <button class="submit-btn" type="submit">
                    🎄 Registriraj se
                </button>
            </form>
            
            <div class="login-link">
                <p>Že imate račun? <a href="<?php echo BASE_URL . "prijava"; ?>">Prijavite se!</a></p>
            </div>
        </div>
    </div>
    
    <div class="footer-decoration">
        🎅🎄✨🦌🔔❄️🎁
    </div>
</body>
</html>