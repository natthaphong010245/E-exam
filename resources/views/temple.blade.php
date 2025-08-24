<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temple by Region</title>
    @include('temple.style')
</head>
<body>
    <div id="temple" class="templeall">
        <div class="container">
            <h1 class="main-title">TEMPLE BY REGION</h1>
            <p class="subtitle">ค้นหาข้อมูลจังหวัดภูมิภาค</p>
            
            <div class="controls">
                <div class="control-left">
                    <span class="control-label">คอลัมน์</span>
                    <div class="columns-container">
                        <button class="btn-columns" onclick="changeColumns(2)">2</button>
                        <button class="btn-columns" onclick="changeColumns(3)">3</button>
                        <button class="btn-columns active" onclick="changeColumns(4)">4</button>
                    </div>
                </div>
                <div class="control-right">
                    <span class="control-label">เล่นอัตโนมัติ</span>
                    <div class="autoplay-container">
                        <div class="toggle-switch" id="autoplayToggle" onclick="toggleAutoPlay()">
                            <span class="toggle-text">ON</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Container -->
            <div class="carousel-container">
                <div class="carousel-grid grid-4" id="carouselGrid">
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
            </div>
        </div>
    </div>

    @include('temple.script')
</body>
</html>