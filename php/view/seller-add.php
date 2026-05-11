<!DOCTYPE html>
<html lang="sl">
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta charset="UTF-8" />
    <title>Dodaj prodajalca</title>
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
        
        h1 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 3rem;
            text-align: center;
            color: var(--gold);
            margin: 20px 0;
            padding: 20px;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            position: relative;
        }
        
        h1::before, h1::after {
            content: "🎅";
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
        
        .form-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 40px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: var(--gold);
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 10px var(--red);
            background: white;
        }
        
        .password-requirements {
            background: rgba(10, 92, 54, 0.3);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border: 2px dashed var(--gold);
            font-size: 0.9rem;
        }
        
        .password-requirements ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        .password-requirements li {
            margin: 5px 0;
        }
        
        .message {
            padding: 15px;
            margin: 15px 0;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
        }
        
        .success-message {
            background: rgba(212, 237, 218, 0.9);
            color: #155724;
            border: 2px solid #c3e6cb;
        }
        
        .error-message {
            background: rgba(248, 215, 218, 0.9);
            color: #721c24;
            border: 2px solid #f5c6cb;
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--green), #0d7242);
            color: white;
            border: none;
            padding: 18px 35px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: block;
            margin: 40px auto 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 300px;
        }
        
        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #0d7242, var(--green));
        }
        
        .form-title {
            text-align: center;
            color: var(--gold);
            font-size: 1.5rem;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px dashed var(--gold);
        }
        
        .password-strength {
            margin-top: 10px;
            font-size: 0.9rem;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }
        
        .strength-weak { color: #dc3545; background: rgba(220, 53, 69, 0.1); }
        .strength-medium { color: #ffc107; background: rgba(255, 193, 7, 0.1); }
        .strength-strong { color: #28a745; background: rgba(40, 167, 69, 0.1); }
    </style>
    <script>
        function checkPasswordStrength(password) {
            let strength = 0;
            const strengthBar = document.getElementById('password-strength');
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[@$!%*?&]/.test(password)) strength++;
            
            if (strength === 0) {
                strengthBar.textContent = '';
                strengthBar.className = 'password-strength';
            } else if (strength <= 2) {
                strengthBar.textContent = 'Šibko geslo';
                strengthBar.className = 'password-strength strength-weak';
            } else if (strength <= 4) {
                strengthBar.textContent = 'Srednje geslo';
                strengthBar.className = 'password-strength strength-medium';
            } else {
                strengthBar.textContent = 'Močno geslo';
                strengthBar.className = 'password-strength strength-strong';
            }
        }
        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const confirmMsg = document.getElementById('confirm-message');
            
            if (confirmPassword === '') {
                confirmMsg.textContent = '';
                return true;
            }
            
            if (password === confirmPassword) {
                confirmMsg.textContent = '✅ Gesli se ujemata';
                confirmMsg.style.color = '#28a745';
                return true;
            } else {
                confirmMsg.textContent = '❌ Gesli se ne ujemata';
                confirmMsg.style.color = '#dc3545';
                return false;
            }
        }
        
        function validateForm(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            // Preveri ujemanje gesel
            if (password !== confirmPassword) {
                alert('Gesli se ne ujemata! Prosimo, preverite vnos.');
                event.preventDefault();
                return false;
            }
            
            // Preveri moč gesla
            const requirements = {
                length: password.length >= 8,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[@$!%*?&]/.test(password)
            };
            
            if (!requirements.length || !requirements.upper || !requirements.lower || 
                !requirements.number || !requirements.special) {
                alert('Geslo ne izpolnjuje vseh zahtev. Prosimo, preverite zahteve za geslo.');
                event.preventDefault();
                return false;
            }
            
            return true;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm_password');
            const form = document.querySelector('form');
            
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    checkPasswordStrength(this.value);
                    checkPasswordMatch();
                });
            }
            
            if (confirmInput) {
                confirmInput.addEventListener('input', checkPasswordMatch);
            }
            
            if (form) {
                form.addEventListener('submit', validateForm);
            }
        });
    </script>
</head>
<body>
    <h1>🎅 Dodaj novega prodajalca 🎅</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "sellers" ?>">Vsi prodajalci</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">Božična Prodajalna</a> ✨
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            ❌ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <div class="form-container">
        <div class="form-title">
            <h3>✨ Vnesite podatke novega prodajalca ✨</h3>
        </div>
        
        <form method="post" action="<?php echo BASE_URL . "seller/add"; ?>">
            <div class="form-group">
                <label>👤 Ime:</label>
                <input type="text" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" 
                       autofocus required placeholder="Vnesite ime prodajalca"/>
            </div>
            
            <div class="form-group">
                <label>👥 Priimek:</label>
                <input type="text" name="surname" value="<?= isset($surname) ? htmlspecialchars($surname) : '' ?>" 
                       required placeholder="Vnesite priimek prodajalca"/>
            </div>
            
            <div class="form-group">
                <label>📧 E-poštni naslov:</label>
                <input type="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" 
                       required placeholder="vnesite@email.si"/>
            </div>
            
            <!-- Skrit input za vedno aktiviran status = 1 -->
            <input type="hidden" name="status" value="1">
            
            <div class="password-requirements">
                <strong>🔐 Zahteve za geslo:</strong>
                <ul>
                    <li>Vsaj 8 znakov</li>
                    <li>Vsaj 1 velika črka</li>
                    <li>Vsaj 1 mala črka</li>
                    <li>Vsaj 1 številka</li>
                    <li>Vsaj 1 poseben znak (@$!%*?&)</li>
                </ul>
            </div>
            
            <div class="form-group">
                <label>🔑 Geslo:</label>
                <input type="password" name="password" id="password" required 
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                       title="Geslo mora vsebovati vsaj 8 znakov, eno veliko črko, eno malo črko, eno številko in en poseben znak."
                       placeholder="Vnesite geslo"/>
                <div id="password-strength" class="password-strength"></div>
            </div>
            
            <div class="form-group">
                <label>✅ Potrdi geslo:</label>
                <input type="password" name="confirm_password" id="confirm_password" required 
                       placeholder="Ponovno vnesite geslo"/>
                <div id="confirm-message" style="margin-top: 5px; font-size: 0.9rem;"></div>
            </div>
            
            <button type="submit" class="submit-btn">
                🎄 Dodaj prodajalca
            </button>
        </form>
    </div>
</body>
</html>