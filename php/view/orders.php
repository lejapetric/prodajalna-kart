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
            content: "📦";
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
        
        .orders-container {
            max-width: 1000px;
            margin: 30px auto;
        }
        
        .order-item {
            background: rgba(30, 58, 95, 0.8);
            border-radius: 15px;
            border: 3px solid var(--gold);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .order-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border-color: var(--red);
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255, 215, 0, 0.3);
        }
        
        .order-info h3 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 1.8rem;
            margin: 0;
        }
        
        .order-info .order-date {
            color: #ccc;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .order-status {
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-refunded { background: #e2e3e5; color: #383d41; }
        
        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            background: rgba(10, 92, 54, 0.3);
            padding: 15px;
            border-radius: 10px;
            border-left: 3px solid var(--gold);
        }
        
        .detail-item strong {
            color: var(--gold);
            display: block;
            margin-bottom: 5px;
        }
        
        .order-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .action-btn {
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .view-btn {
            background: linear-gradient(145deg, var(--blue), #2a5298);
            color: white;
            text-decoration: none;
        }
        
        .confirm-btn {
            background: linear-gradient(145deg, #28a745, #1e7e34);
            color: white;
        }
        
        .cancel-btn {
            background: linear-gradient(145deg, #dc3545, #c82333);
            color: white;
        }
        
        .refund-btn {
            background: linear-gradient(145deg, #6c757d, #545b62);
            color: white;
        }
        
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .no-orders {
            text-align: center;
            padding: 60px;
            color: var(--gold);
            font-size: 1.5rem;
            background: rgba(30, 58, 95, 0.8);
            border-radius: 15px;
            border: 2px dashed var(--gold);
            margin: 50px auto;
            max-width: 600px;
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
            for (let i = 0; i < 25; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 6 + 3}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                document.body.appendChild(snowflake);
            }
            
            for (let i = 0; i < 15; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                document.body.appendChild(light);
            }
        });
    </script>
    <title>Naročila</title>
</head>
<body>
    <h1>📦 VSA NAROČILA 📦</h1>
    
    <div class="nav-links">
        ✨ <a href="<?php echo BASE_URL . "store"; ?>">🏪 Nazaj v prodajalno</a> ✨
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
    
    <div class="orders-container">
        <?php if (empty($orders)): ?>
            <div class="no-orders">
                <p>🎄 Ni naročil. 🎄</p>
                <p style="margin-top: 20px; font-size: 1rem;">
                    <a href="<?php echo BASE_URL . "store"; ?>" style="color: var(--gold); text-decoration: underline;">
                        🛍️ Obiščite našo prodajalno
                    </a>
                </p>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="order-header">
                        <div class="order-info">
                            <h3>📦 Naročilo #<?php echo htmlspecialchars($order['id']); ?></h3>
                            <div class="order-date">
                                📅 <?php echo date('d.m.Y H:i', strtotime($order['order_date'])); ?>
                            </div>
                        </div>
                        <div class="order-status status-<?php echo htmlspecialchars($order['status']); ?>">
                            <?php 
                            $status_text = '';
                            switch($order['status']) {
                                case 'pending': $status_text = '⏳ Čaka na potrditev'; break;
                                case 'confirmed': $status_text = '✅ Potrjeno'; break;
                                case 'cancelled': $status_text = '❌ Preklicano'; break;
                                case 'refunded': $status_text = '💰 Stornirano'; break;
                                default: $status_text = $order['status'];
                            }
                            echo $status_text;
                            ?>
                        </div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <strong>💰 Znesek:</strong>
                            <?php echo number_format($order['total_amount'], 2); ?> EUR
                        </div>
                        
                        <?php if (User::isSeller() || User::isAdmin()): ?>
                            <div class="detail-item">
                                <strong>👤 Kupec:</strong>
                                <?php echo htmlspecialchars($order['name'] . ' ' . $order['surname']); ?><br>
                                <small><?php echo htmlspecialchars($order['email']); ?></small>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($order['shipping_address'])): ?>
                            <div class="detail-item">
                                <strong>📍 Naslov dostave:</strong>
                                <?php echo htmlspecialchars($order['shipping_address']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="order-actions">
                        <a href="<?php echo BASE_URL . "order/details/" . $order['id']; ?>" class="action-btn view-btn">
                            👁️ Prikaži podrobnosti
                        </a>
                        
                        <?php if ((User::isSeller() || User::isAdmin()) && $order['status'] == 'pending'): ?>
                            <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="action-btn confirm-btn">
                                    ✅ Potrdi naročilo
                                </button>
                            </form>
                            <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="action-btn cancel-btn" onclick="return confirm('Ali ste prepričani, da želite preklicati to naročilo?')">
                                    ❌ Prekliči
                                </button>
                            </form>
                        <?php endif; ?>
                        
                        <?php if ((User::isSeller() || User::isAdmin()) && $order['status'] == 'confirmed'): ?>
                            <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <input type="hidden" name="status" value="refunded">
                                <button type="submit" class="action-btn refund-btn" onclick="return confirm('Ali ste prepričani, da želite stornirati to naročilo? S tem boste povrnili sredstva kupcu.')">
                                    💰 Storniraj
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="footer-decoration">
        🎅🎄✨📦🦌🔔
    </div>
</body>
</html>