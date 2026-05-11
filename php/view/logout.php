<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta charset="UTF-8" />
    <title>Odjava</title>
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
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
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
            color: var(--gold);
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            margin: 30px 0;
            padding: 20px;
            position: relative;
            letter-spacing: 2px;
        }
        
        h1::before, h1::after {
            content: "🎄";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: -50px; }
        h1::after { right: -50px; }
        
        .logout-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 40px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            margin: 20px;
        }
        
        .logout-message {
            font-size: 1.3rem;
            margin-bottom: 30px;
            color: var(--white);
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        
        .action-btn {
            padding: 15px 30px;
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        .store-btn {
            background: linear-gradient(145deg, var(--green), #0d7242);
        }
        
        .store-btn:hover {
            background: linear-gradient(145deg, #0d7242, var(--green));
        }
        
        /* Božične animacije */
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        .christmas-ornament {
            position: fixed;
            width: 30px;
            height: 30px;
            background: var(--red);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .christmas-light {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
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
            for (let i = 0; i < 20; i++) {
                createSnowflake();
            }
            
            // Ustvari lučke
            for (let i = 0; i < 15; i++) {
                createLight();
            }
        });
        
        function createSnowflake() {
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
        
        function createLight() {
            const light = document.createElement('div');
            light.classList.add('christmas-light');
            
            const colors = ['#ff0000', '#00ff00', '#ffff00', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            light.style.backgroundColor = color;
            light.style.left = `${Math.random() * 100}vw`;
            light.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(light);
        }
    </script>
</head>
<body>
    <h1>🎅 Uspešno ste se odjavili! 🎅</h1>
    
    <div class="logout-container">
        <div class="logout-message">
            <p>✨ Hvala za obisk! Želimo vam vesel in čaroben božič! ✨</p>
            <p>🦌🔔🎁❄️</p>
        </div>
        
        <div class="button-container">
            <form style="display: inline;">
                <button type="submit" formaction="<?= BASE_URL . "store" ?>" class="action-btn store-btn">
                    🎄 Nazaj v božično trgovino
                </button>
            </form>
            
            <form style="display: inline;">
                <button type="submit" formaction="<?= BASE_URL . "prijava" ?>" class="action-btn">
                    🔑 Ponovna prijava
                </button>
            </form>
        </div>
    </div>
    
    <div class="footer-decoration">
        🎄🎅✨🦌🔔❄️
    </div>
</body>
</html>