<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }} — IMS</title>
    <!-- Include html2pdf.js and qrious from CDN for PDF downloads and QR code generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
        }

        nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.2rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        nav > div {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            gap: 3rem;
            align-items: center;
            justify-content: space-between;
        }

        nav a.logo {
            color: white;
            font-weight: 800;
            text-decoration: none;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        nav ul {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            flex: 1;
        }

        nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
        }

        nav a:hover {
            color: white;
            border-bottom-color: white;
        }

        .nav-user-menu {
            position: relative;
        }

        .nav-user-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            padding: 0.35rem 0.75rem 0.35rem 0.35rem;
            cursor: pointer;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-user-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .nav-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            overflow: hidden;
            z-index: 1001;
        }

        .nav-user-menu.open .nav-dropdown {
            display: block;
            animation: dropdownFade 0.2s ease;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-dropdown a,
        .nav-dropdown-logout {
            display: block;
            width: 100%;
            padding: 0.75rem 1.25rem;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            background: none;
            cursor: pointer;
            text-align: left;
            transition: background 0.2s ease;
        }

        .nav-dropdown a:hover,
        .nav-dropdown-logout:hover {
            background: #f3f4f6;
            color: #667eea;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 999;
        }

        .page-wrapper {
            margin-top: 100px;
            max-width: 550px;
            width: 100%;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            width: 100%;
            justify-content: space-between;
        }

        .btn {
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: #ffffff;
            color: #4b5563;
            border: 1.5px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            color: #1f2937;
            border-color: #d1d5db;
        }

        /* ─── Receipt Card ─── */
        .receipt-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            position: relative;
            background-image: radial-gradient(circle at 100% 150px, transparent 12px, white 12px),
                              radial-gradient(circle at 0% 150px, transparent 12px, white 12px);
        }

        /* Tear-off effect at the bottom */
        .receipt-card::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 16px;
            background: radial-gradient(circle, transparent, transparent 50%, white 50%, white 100%);
            background-size: 16px 16px;
            background-repeat: repeat-x;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px dashed #e5e7eb;
            padding-bottom: 1.5rem;
        }

        .receipt-logo {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }

        .receipt-tagline {
            font-size: 0.85rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .receipt-meta {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #9ca3af;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 0.2rem;
        }

        .meta-val {
            font-weight: 600;
            color: #1f2937;
        }

        .receipt-table-wrapper {
            margin-bottom: 2rem;
        }

        .receipt-table-header {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
            margin-bottom: 0.75rem;
            display: grid;
            grid-template-columns: 2.5fr 1fr 1fr 1fr;
            text-align: right;
        }

        .receipt-table-header .col-left {
            text-align: left;
        }

        .receipt-row {
            display: grid;
            grid-template-columns: 2.5fr 1fr 1fr 1fr;
            font-size: 0.95rem;
            color: #374151;
            margin-bottom: 0.75rem;
            text-align: right;
        }

        .receipt-row .col-left {
            text-align: left;
            font-weight: 600;
            color: #111827;
        }

        .receipt-totals {
            border-top: 2px dashed #e5e7eb;
            padding-top: 1.5rem;
            margin-bottom: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            color: #4b5563;
        }

        .totals-row.grand-total {
            font-size: 1.4rem;
            font-weight: 800;
            color: #111827;
            border-top: 1px solid #e5e7eb;
            padding-top: 0.75rem;
            margin-top: 0.25rem;
        }

        .receipt-footer {
            text-align: center;
            font-size: 0.85rem;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
            padding-top: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .barcode {
            margin-top: 0.5rem;
            opacity: 0.8;
        }

        .success-banner {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 0.75rem;
            border-radius: 8px;
            color: #065f46;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        /* ─── Print Media Queries ─── */
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
                min-height: auto !important;
            }

            body::before {
                display: none !important;
            }

            nav,
            .action-buttons,
            .success-banner {
                display: none !important;
            }

            .page-wrapper {
                margin-top: 0 !important;
                padding: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            .receipt-card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                background-image: none !important;
            }

            .receipt-card::after {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    @includeIf('common.base')

    <div class="page-wrapper">
        @if (session('success'))
            <div class="success-banner">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Sales History
            </a>
            <button onclick="downloadPDF()" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Download PDF
            </button>
            <button onclick="window.print()" class="btn btn-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Print Bill
            </button>
        </div>

        <div class="receipt-card" id="receipt-card">
            <div class="receipt-header">
                <div class="receipt-logo">IMS STORE</div>
                <div class="receipt-tagline">Inventory Management System</div>
            </div>

            <div class="receipt-meta">
                <div class="meta-item">
                    <span class="meta-label">Receipt No</span>
                    <span class="meta-val">#{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="meta-item" style="text-align: right;">
                    <span class="meta-label">Date</span>
                    <span class="meta-val">{{ $sale->created_at->format('M d, Y h:i A') }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Cashier</span>
                    <span class="meta-val">{{ Auth::user() ? Auth::user()->name : 'System User' }}</span>
                </div>
                <div class="meta-item" style="text-align: right;">
                    <span class="meta-label">Customer</span>
                    <span class="meta-val">Walk-in Customer</span>
                </div>
            </div>

            <div class="receipt-table-wrapper">
                <div class="receipt-table-header">
                    <span class="col-left">Item</span>
                    <span>Qty</span>
                    <span>Price</span>
                    <span>Total</span>
                </div>
                <div class="receipt-row">
                    <span class="col-left">{{ $sale->product ? $sale->product->name : 'Deleted Product' }}</span>
                    <span>{{ $sale->quantity }}</span>
                    <span>Rs. {{ number_format($sale->price_at_sale, 2) }}</span>
                    <span>Rs. {{ number_format($sale->total_price, 2) }}</span>
                </div>
            </div>

            <div class="receipt-totals">
                <div class="totals-row">
                    <span>Subtotal</span>
                    <span>Rs. {{ number_format($sale->total_price, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span>Tax (0%)</span>
                    <span>Rs. 0.00</span>
                </div>
                <div class="totals-row grand-total">
                    <span>Total Amount</span>
                    <span>Rs. {{ number_format($sale->total_price, 2) }}</span>
                </div>
            </div>

            <div class="receipt-footer">
                <div>Thank you for your purchase!</div>
                <div style="font-size: 0.75rem; color: #cbd5e1; margin-top: -0.5rem;">This is a computer generated document.</div>
                
                <!-- QR Code for scanning receipt on phone -->
                <div style="margin-top: 1rem; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                    <canvas id="qr-code"></canvas>
                    <span style="font-size: 0.75rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Scan to View on Phone</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadPDF() {
            const element = document.getElementById('receipt-card');
            
            // Temporary styles to optimize for PDF page size and margins
            const opt = {
                margin:       [15, 15, 15, 15],
                filename:     'receipt-sale-{{ $sale->id }}.pdf',
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 3, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Process PDF generation
            html2pdf().set(opt).from(element).save();
        }

        // Toggle user dropdown & render QR code
        document.addEventListener('DOMContentLoaded', () => {
            // Render QR Code
            new QRious({
                element: document.getElementById('qr-code'),
                value: '{{ route('sales.receipt', $sale->id) }}',
                size: 110,
                foreground: '#1e293b',
                background: '#ffffff'
            });

            const userBtn = document.querySelector('.nav-user-button');
            const userMenu = document.querySelector('.nav-user-menu');
            
            if (userBtn && userMenu) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userMenu.classList.toggle('open');
                });
                
                document.addEventListener('click', () => {
                    userMenu.classList.remove('open');
                });
            }
        });
    </script>
</body>

</html>
