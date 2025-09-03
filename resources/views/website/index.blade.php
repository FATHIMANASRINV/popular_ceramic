<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Stock Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --card-hover: #2a2a2a;
            --primary: #7c4dff;
            --primary-light: #9c75ff;
            --text-primary: #e0e0e0;
            --text-secondary: #a0a0a0;
            --success: #00c853;
            --warning: #ffab00;
            --danger: #ff5252;
            --info: #40c4ff;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: var(--dark-bg);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        h1 {
            font-size: 28px;
            font-weight: 600;
            background: linear-gradient(to right, var(--primary-light), var(--info));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .controls {
            display: flex;
            gap: 15px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .stat-card {
            display: flex;
            flex-direction: column;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            background-color: var(--card-hover);
        }
        .stat-title {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 10px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .stat-change {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .positive {
            color: var(--success);
        }
        .negative {
            color: var(--danger);
        }
        .search-filter {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .search-box {
            position: relative;
        }
        .search-box input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border-radius: 10px;
            border: none;
            background-color: var(--card-bg);
            color: var(--text-primary);
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }
        .filter-dropdown {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: var(--card-bg);
            color: var(--text-primary);
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .products-table th {
            background-color: rgba(124, 77, 255, 0.1);
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-light);
        }
        .products-table td {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .products-table tr:last-child td {
            border-bottom: none;
        }
        .products-table tr:hover {
            background-color: var(--card-hover);
        }
        .stock-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }
        .stock-amount {
            height: 100%;
            border-radius: 4px;
        }
        .high {
            background: var(--success);
        }
        
        .medium {
            background: var(--warning);
        }
        
        .low {
            background: var(--danger);
        }
        
        .stock-text {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-top: 3px;
            color: var(--text-secondary);
        }
        
        .category {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: rgba(124, 77, 255, 0.2);
            color: var(--primary-light);
            font-size: 12px;
        }
        
        .action-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            transition: color 0.3s ease;
        }
        
        .action-btn:hover {
            color: var(--primary-light);
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: var(--text-secondary);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @media (max-width: 992px) {
            .search-filter {
                grid-template-columns: 1fr;
            }
            
            .dashboard {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .controls {
                width: 100%;
                justify-content: center;
            }
            
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .products-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-box"></i>
                </div>
                <h1> Stock Dashboard</h1>
            </div>
            <div class="controls">
                <a href="{{ route('custom.login') }}"><button class="btn btn-primary"><i class="fas fa-sync-alt"></i> Login</button></a>
                <button class="btn btn-secondary"><i class="fas fa-download"></i> Export</button>
            </div>
        </header>

        <div class="dashboard">
            <div class="card stat-card">
                <span class="stat-title">TOTAL PRODUCTS</span>
                <span class="stat-value">{{ $totalProducts }}</span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 12% from last week</span>
            </div>

            <div class="card stat-card">
                <span class="stat-title">IN STOCK</span>
                <span class="stat-value">{{ $inStock }}</span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 8% from last week</span>
            </div>

            <div class="card stat-card">
                <span class="stat-title">LOW STOCK</span>
                <span class="stat-value">{{ $lowStock }}</span>
                <span class="stat-change negative"><i class="fas fa-arrow-down"></i> 3% from last week</span>
            </div>

            <div class="card stat-card">
                <span class="stat-title">OUT OF STOCK</span>
                <span class="stat-value">{{ $outOfStock }}</span>
                <span class="stat-change positive"><i class="fas fa-arrow-down"></i> 2% from last week</span>
            </div>
        </div>

        <div class="search-filter">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text"  placeholder="Search products...">
            </div>

            <select class="filter-dropdown" id="categoryFilter">
                <option>All Categories</option>
                @foreach ($categories as $categories)
                <option value="{{ ucfirst($categories->id) }}">{{ ucfirst($categories->name) }}</option>
                @endforeach
            </select>

            <select class="filter-dropdown" id="stockFilter">
                <option>All Stock Status</option>
                <option>In Stock</option>
                <option>Low Stock</option>
                <option>Out of Stock</option>
            </select>
        </div>

        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Stock Level</th>
                </tr>
            </thead>
            <tbody>
             <tbody id="productsTableBody">
                @foreach ($totalProductsDetails as $Products)
                <tr>
                    <td>{{ ucfirst($Products->name) }}</td>
                    <td><span class="category">{{ ucfirst($Products->category_name) }}</span></td>
                    <td><span class="category">{{ $Products->stock }}</span></td>
                    <td>
                        <div class="stock-bar">
                            <div class="stock-amount 
                            @if($Products->stock >= 70) high 
                            @elseif($Products->stock >= 30) medium 
                            @else low 
                            @endif" 
                            style="width: {{ $Products->stock }}%">
                        </div>
                    </div>
                    <div class="stock-text">
                        <span>
                            @if($Products->stock >= 70) In Stock 
                            @elseif($Products->stock >= 30) Low Stock 
                            @else Critical 
                            @endif
                        </span>
                        <span>{{ $Products->stock }}</span>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
              <!--   <tr>
                    <td>Wireless Bluetooth Headphones</td>
                    <td><span class="category">Electronics</span></td>
                    <td>ELEC-0012</td>
                    <td>$129.99</td>
                    <td>
                        <div class="stock-bar">
                            <div class="stock-amount high" style="width: 85%"></div>
                        </div>
                        <div class="stock-text">
                            <span>In Stock</span>
                            <span>85/100</span>
                        </div>
                    </td>
                    <td>
                        <button class="action-btn"><i class="fas fa-edit"></i></button>
                        <button class="action-btn"><i class="fas fa-chart-line"></i></button>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <footer>
            <p>© 2023  Stock Dashboard | Last updated: Today at 14:25</p>
        </footer>
    </div>
    <script>
        const products = @json($totalProductsDetails);

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-box input');
            const productRows = document.querySelectorAll('.products-table tbody tr');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                productRows.forEach(row => {
                    const productName = row.querySelector('td:first-child').textContent.toLowerCase();
                    const productCategory = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                    if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
        function getStockStatus(stock) {
            if (stock >= 70) return { status: "In Stock", class: "high" };
            if (stock >= 30) return { status: "Low Stock", class: "medium" };
            return { status: "Critical", class: "low" };
        }
        function renderProducts(productsArray) {
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';
            
            if (productsArray.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-light);">
                            <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 15px; display: block;"></i>
                            No products found matching your filters
                        </td>
                    </tr>
                `;
                return;
            }
            productsArray.forEach(product => {
                const stockStatus = getStockStatus(product.stock);
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td><span class="category">${product.category_name}</span></td>
                    <td><span class="category">${product.stock}</span></td>
                    <td>
                        <div class="stock-bar">
                            <div class="stock-amount ${stockStatus.class}" style="width: ${product.stock}%"></div>
                        </div>
                        <div class="stock-text">
                            <span>${stockStatus.status}</span>
                            <span>${product.stock}</span>
                        </div>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        }
        function filterProducts() {
            const categoryValue = document.getElementById('categoryFilter').value;
            const stockValue = document.getElementById('stockFilter').value;
            const searchValue = document.getElementById('searchInput').value;
            let filteredProducts = products;
            console.log(filterProducts); 
            if (categoryValue !== 'all') {
                filteredProducts = products.filter(product => 
                    product.category_id === categoryValue
                    );
            }
            if (stockValue !== 'all') {
                filteredProducts = products.filter(product => {
                    if (stockValue === 'high') return product.stock >= 70;
                    if (stockValue === 'medium') return product.stock >= 30 && product.stock < 70;
                    if (stockValue === 'low') return product.stock < 30;
                });
            }
            if (searchValue) {
                filteredProducts = products.filter(product => 
                    product.name.toLowerCase().includes(searchValue) ||
                    product.category_name.toLowerCase().includes(searchValue)
                    );
            }
            renderProducts(filteredProducts);
        }
        renderProducts(products);
        document.getElementById('categoryFilter').addEventListener('change', filterProducts);
        document.getElementById('stockFilter').addEventListener('change', filterProducts);
        document.getElementById('searchInput').addEventListener('input', filterProducts);
    </script>
</body>
</html>