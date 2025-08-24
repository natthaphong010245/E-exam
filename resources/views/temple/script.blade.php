<script>
    const temples = [
        {
            name: "ภาคเหนือ",
            image: "/images/northern.jpg"
        },
        {
            name: "ภาคกลาง",
            image: "/images/central.jpg"
        },
        {
            name: "ภาคตะวันออกเฉียงเหนือ",
            image: "/images/northeastern.png"
        },
        {
            name: "ภาคตะวันออก",
            image: "/images/eastern.jpg"
        },
        {
            name: "ภาคตะวันตก",
            image: "/images/western.png"
        },
        {
            name: "ภาคใต้",
            image: "/images/southern.png"
        }
    ];

    let currentPage = 0;
    let currentColumns = 4;
    let autoPlay = true;
    let autoPlayInterval;

    function createTempleItems() {
        const grid = document.getElementById('carouselGrid');
        const itemsPerPage = currentColumns;
        const totalPages = Math.ceil(temples.length / itemsPerPage);
        const startIndex = currentPage * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, temples.length);
        
        grid.innerHTML = '';
        grid.className = `carousel-grid grid-${currentColumns}`;
        
        for (let i = startIndex; i < endIndex; i++) {
            const temple = temples[i];
            const templeElement = document.createElement('div');
            templeElement.id = 'watthai';
            templeElement.className = 'wat';
            
            templeElement.innerHTML = `
                <img id="imagewatthai" class="imagewatthai2" 
                     src="${temple.image}" 
                     alt="${temple.name}"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=\\'http://www.w3.org/2000/svg\\' viewBox=\\'0 0 300 300\\'><rect width=\\'300\\' height=\\'300\\' fill=\\'%23ff8c00\\'/><rect x=\\'60\\' y=\\'100\\' width=\\'180\\' height=\\'120\\' fill=\\'%23ffd700\\' stroke=\\'%23b8860b\\' stroke-width=\\'2\\'/><polygon points=\\'150,100 60,100 105,70 195,70\\' fill=\\'%23dc143c\\'/><rect x=\\'130\\' y=\\'170\\' width=\\'40\\' height=\\'80\\' fill=\\'%238b4513\\'/><circle cx=\\'150\\' cy=\\'140\\' r=\\'15\\' fill=\\'%23fff\\' stroke=\\'%23000\\' stroke-width=\\'1\\'/><text x=\\'150\\' y=\\'270\\' text-anchor=\\'middle\\' font-size=\\'14\\' fill=\\'%23000\\'>${temple.name}</text></svg>'">
                <div class="temple-overlay">
                    <div class="temple-name">${temple.name}</div>
                </div>
            `;
            
            grid.appendChild(templeElement);
        }
        
        createPagination();
    }

    function createPagination() {
        const pagination = document.getElementById('pagination');
        const itemsPerPage = currentColumns;
        const totalPages = Math.ceil(temples.length / itemsPerPage);
        
        pagination.innerHTML = '';
        
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('div');
            dot.className = `dot ${i === currentPage ? 'active' : ''}`;
            dot.onclick = () => goToPage(i);
            pagination.appendChild(dot);
        }
    }

    function goToPage(pageIndex) {
        const itemsPerPage = currentColumns;
        const totalPages = Math.ceil(temples.length / itemsPerPage);
        
        if (pageIndex >= 0 && pageIndex < totalPages) {
            currentPage = pageIndex;
            createTempleItems();
        }
    }

    function changeColumns(columns) {
        currentColumns = columns;
        currentPage = 0;
        
        document.querySelectorAll('.btn-columns').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');
        
        createTempleItems();
    }

    function toggleAutoPlay() {
        autoPlay = !autoPlay;
        const toggle = document.getElementById('autoplayToggle');
        const toggleText = toggle.querySelector('.toggle-text');
        
        if (autoPlay) {
            toggle.classList.remove('off');
            toggleText.textContent = 'ON';
            startAutoPlay();
        } else {
            toggle.classList.add('off');
            toggleText.textContent = 'OFF';
            stopAutoPlay();
        }
    }

    function startAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
        }
        
        autoPlayInterval = setInterval(() => {
            if (autoPlay) {
                const itemsPerPage = currentColumns;
                const totalPages = Math.ceil(temples.length / itemsPerPage);
                const nextPage = (currentPage + 1) % totalPages;
                goToPage(nextPage);
            }
        }, 3000);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        createTempleItems();
        startAutoPlay();
        
        const carousel = document.querySelector('.carousel-container');
        carousel.addEventListener('mouseenter', () => {
            if (autoPlay) stopAutoPlay();
        });
        
        carousel.addEventListener('mouseleave', () => {
            if (autoPlay) startAutoPlay();
        });
    });

    document.addEventListener('keydown', function(e) {
        const itemsPerPage = currentColumns;
        const totalPages = Math.ceil(temples.length / itemsPerPage);
        
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                goToPage((currentPage - 1 + totalPages) % totalPages);
                break;
            case 'ArrowRight':
                e.preventDefault();
                goToPage((currentPage + 1) % totalPages);
                break;
            case ' ':
                e.preventDefault();
                toggleAutoPlay();
                break;
        }
    });
</script>