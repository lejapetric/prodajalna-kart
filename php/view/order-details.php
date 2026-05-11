<!DOCTYPE html>
<html lang="sl">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . "style.css"; ?>">
    <meta charset="UTF-8" />
    <title>Podrobnosti naročila</title>
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
            content: "📦";
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
        
        .order-details-container {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 900px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .order-header {
            border-bottom: 2px dashed var(--gold);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .order-header h2 {
            color: var(--gold);
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .order-status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: bold;
            margin-left: 15px;
            font-size: 0.9rem;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-refunded { background: #e2e3e5; color: #383d41; }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .items-table th {
            background: var(--green);
            color: white;
            padding: 15px;
            text-align: left;
        }
        
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            color: #333;
        }
        
        .items-table tr:hover {
            background: rgba(255, 248, 225, 0.8);
        }
        
        .total-row {
            font-weight: bold;
            background: var(--gold) !important;
            color: #333 !important;
        }
        
        .refund-notice {
            background: rgba(226, 227, 229, 0.9);
            border: 2px dashed #dc3545;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            color: #721c24;
        }
        
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        
        .status-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            margin: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .btn-confirm {
            background: linear-gradient(145deg, #28a745, #218838);
            color: white;
        }
        
        .btn-cancel {
            background: linear-gradient(145deg, #dc3545, #c82333);
            color: white;
        }
        
        .btn-refund {
            background: linear-gradient(145deg, #6c757d, #545b62);
            color: white;
        }
        
        .status-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
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
        
        .info-box {
            background: rgba(10, 92, 54, 0.3);
            padding: 20px;
            border-radius: 10px;
            margin: 15px 0;
            border: 2px solid var(--gold);
        }
    </style>
</head>
<body>
    <h1>📦 Podrobnosti naročila</h1>
    
    <div class="nav-links">
        ✨ <a href="<?php echo BASE_URL . "orders"; ?>">Nazaj na naročila</a> ✨ |
        ✨ <a href="<?php echo BASE_URL . "store"; ?>">Božična Prodajalna</a> ✨
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
    
    <div class="order-details-container">
        <div class="order-header">
            <h2>🎁 Naročilo #<?php echo htmlspecialchars($order['id']); ?></h2>
            <div class="info-box">
                <p><strong>📅 Datum:</strong> <?php echo date('d.m.Y H:i', strtotime($order['order_date'])); ?></p>
                
                <p><strong>🔔 Status:</strong> 
                    <span class="order-status status-<?php echo htmlspecialchars($order['status']); ?>">
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
                    </span>
                </p>
                
                <?php if (User::isSeller() || User::isAdmin()): ?>
                    <p><strong>🎅 Kupec:</strong> <?php echo htmlspecialchars($order['name'] . ' ' . $order['surname']); ?> 
                    (<?php echo htmlspecialchars($order['email']); ?>)</p>
                <?php endif; ?>
                
                <?php if (!empty($order['shipping_address'])): ?>
                    <p><strong>🏠 Naslov dostave:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
                <?php endif; ?>
            </div>
            
            <?php if ($order['status'] == 'refunded'): ?>
                <div class="refund-notice">
                    <strong>⚠️ Naročilo je stornirano</strong>
                    <p>To naročilo je bilo stornirano. Plačilo je bilo povrnjeno kupcu.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <h3 style="color: var(--gold); text-align: center;">🛒 Izdelki v naročilu:</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>🎁 Izdelek</th>
                    <th>📦 Količina</th>
                    <th>💰 Cena na kos</th>
                    <th>💵 Skupaj</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                foreach ($items as $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $subtotal += $item_total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['naziv']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?> EUR</td>
                    <td><?php echo number_format($item_total, 2); ?> EUR</td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;"><strong>🎯 SKUPAJ:</strong></td>
                    <td><strong><?php echo number_format($order['total_amount'], 2); ?> EUR</strong></td>
                </tr>
            </tbody>
        </table>
        
        <?php if ((User::isSeller() || User::isAdmin()) && $order['status'] == 'pending'): ?>
            <div class="button-container">
                <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="status-btn btn-confirm">
                        ✅ Potrdi naročilo
                    </button>
                </form>
                <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="status-btn btn-cancel">
                        ❌ Prekliči naročilo
                    </button>
                </form>
            </div>
        <?php endif; ?>
        
        <?php if ((User::isSeller() || User::isAdmin()) && $order['status'] == 'confirmed'): ?>
            <div class="button-container">
                <form method="post" action="<?php echo BASE_URL . "order/update-status"; ?>" style="display: inline;">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                    <input type="hidden" name="status" value="refunded">
                    <button type="submit" class="status-btn btn-refund" onclick="return confirm('Ali ste prepričani, da želite stornirati to naročilo? S tem boste povrnili sredstva kupcu.')">
                        💰 Storniraj naročilo
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>