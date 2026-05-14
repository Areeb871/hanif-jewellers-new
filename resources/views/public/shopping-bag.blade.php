<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Bag</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 30px;
        }

        .continue-shopping {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .continue-shopping:hover {
            color: #333;
        }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 32px;
            font-weight: 300;
            color: #333;
        }

        .page-actions {
            display: flex;
            gap: 15px;
        }

        .page-actions a {
            color: #666;
            font-size: 18px;
            text-decoration: none;
        }

        .page-actions a:hover {
            color: #333;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
        }

        .cart-items {
            background: white;
            padding: 0;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 20px;
            padding: 30px 0;
            border-bottom: 1px solid #eee;
            position: relative;
        }

        .item-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            background: #f5f5f5;
        }

        .item-details {
            flex: 1;
        }

        .item-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }

        .item-subtitle {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 20px;
        }

        .item-options {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
        }

        .option-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .option-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }

        .option-select {
            border: none;
            background: none;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            padding: 5px 0;
        }

        .item-actions {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .item-action {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .item-action:hover {
            color: #333;
        }

        .item-price {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .remove-item {
            position: absolute;
            top: 10px;
            right: 0;
            background: none;
            border: none;
            font-size: 18px;
            color: #ccc;
            cursor: pointer;
        }

        .remove-item:hover {
            color: #666;
        }

        .recommendations {
            margin-top: 50px;
        }

        .recommendations h2 {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 30px;
            color: #333;
        }

        .recommendations-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .recommendation-item {
            min-width: 200px;
            background: white;
            text-align: center;
        }

        .recommendation-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            background: #f5f5f5;
        }

        .slider-nav {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: 1px solid #ddd;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .order-summary {
            background: white;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 25px;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 16px;
            font-weight: 500;
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 20px;
        }

        .delivery-info {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        .need-sooner {
            color: #666;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .estimate-dropdown {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 14px;
        }

        .checkout-btn {
            width: 100%;
            background: #333;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            background: #555;
        }

        .paypal-btn {
            width: 100%;
            background: #0070ba;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .shipping-info {
            text-align: center;
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .main-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .page-title h1 {
                font-size: 24px;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                gap: 15px;
            }

            .item-image {
                width: 80px;
                height: 80px;
            }

            .item-options {
                flex-direction: column;
                gap: 15px;
            }

            .item-price {
                grid-column: 1 / -1;
                text-align: right;
                margin-top: 10px;
            }

            .recommendations-slider {
                gap: 15px;
            }

            .recommendation-item {
                min-width: 150px;
            }

            .recommendation-image {
                width: 150px;
                height: 150px;
            }

            .order-summary {
                position: static;
                margin-top: 30px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .item-image {
                justify-self: center;
            }

            .item-actions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="#" class="continue-shopping">
                <i class="fas fa-chevron-left"></i> Continue Shopping
            </a>
            
            <div class="page-title">
                <h1>Shopping Bag</h1>
                <div class="page-actions">
                    <a href="#"><i class="fas fa-print"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="cart-items">
                <div class="cart-item">
                    <button class="remove-item">&times;</button>
                    <img src="https://via.placeholder.com/120x120/f5f5f5/cccccc?text=Ring" alt="Tiffany T T1 Ring" class="item-image">
                    
                    <div class="item-details">
                        <div class="item-title">Tiffany T</div>
                        <div class="item-subtitle">T1 Ring</div>
                        
                        <div class="item-options">
                            <div class="option-group">
                                <label class="option-label">Ring Size</label>
                                <select class="option-select">
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                            
                            <div class="option-group">
                                <label class="option-label">Qty</label>
                                <select class="option-select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="item-actions">
                            <a href="#" class="item-action">
                                <i class="fas fa-plus"></i> Add Engraving
                            </a>
                            <a href="#" class="item-action">Save for Later</a>
                        </div>
                    </div>
                    
                    <div class="item-price">$2,550.00</div>
                </div>
            </div>

            <div class="recommendations">
                <h2>You May Also Like</h2>
                <div class="recommendations-slider">
                    <div class="recommendation-item">
                        <img src="https://via.placeholder.com/200x200/e0f7fa/00acc1?text=Product+1" alt="Recommendation 1" class="recommendation-image">
                    </div>
                    <div class="recommendation-item">
                        <img src="https://via.placeholder.com/200x200/fce4ec/e91e63?text=Product+2" alt="Recommendation 2" class="recommendation-image">
                    </div>
                    <div class="recommendation-item">
                        <img src="https://via.placeholder.com/200x200/e8f5e8/4caf50?text=Product+3" alt="Recommendation 3" class="recommendation-image">
                    </div>
                    <div class="recommendation-item">
                        <img src="https://via.placeholder.com/200x200/fff3e0/ff9800?text=Product+4" alt="Recommendation 4" class="recommendation-image">
                    </div>
                </div>
                <button class="slider-nav">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="order-summary">
                <h3 class="summary-title">Order Summary</h3>
                
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$2,550.00</span>
                </div>
                
                <div class="summary-row">
                    <div>
                        <div>Express Delivery with Signature $0</div>
                        <div class="delivery-info">Delivery by Tuesday, 07/29</div>
                        <div class="need-sooner">Need it sooner? <i class="fas fa-chevron-down"></i></div>
                    </div>
                    <span>$0.00</span>
                </div>
                
                <div class="summary-row">
                    <span>Estimated Tax</span>
                    <button class="estimate-dropdown">
                        Estimate <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                
                <div class="summary-row total">
                    <span>Estimated Total</span>
                    <span>$2,550.00</span>
                </div>
                
                <button class="checkout-btn">Checkout</button>
                
                <button class="paypal-btn">
                    <strong>PayPal</strong>
                </button>
                
                <div class="shipping-info">
                    Enjoy complimentary shipping<br>
                    and returns on your order.
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add basic interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Remove item functionality
            const removeButtons = document.querySelectorAll('.remove-item');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to remove this item?')) {
                        this.closest('.cart-item').remove();
                        updateTotal();
                    }
                });
            });

            // Update total when quantity changes
            const quantitySelects = document.querySelectorAll('.option-select');
            quantitySelects.forEach(select => {
                select.addEventListener('change', updateTotal);
            });

            function updateTotal() {
                // This would typically calculate based on actual cart items
                // For demo purposes, keeping static
                console.log('Total updated');
            }

            // Slider navigation
            const sliderNav = document.querySelector('.slider-nav');
            const slider = document.querySelector('.recommendations-slider');
            
            if (sliderNav && slider) {
                sliderNav.addEventListener('click', function() {
                    slider.scrollBy({
                        left: 220,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</body>
</html>