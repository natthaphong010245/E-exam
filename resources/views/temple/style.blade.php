<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    #temple.templeall {
        min-height: 100vh;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><pattern id="temple-bg" patternUnits="userSpaceOnUse" width="100" height="100"><rect width="100" height="100" fill="%23fafafa"/><circle cx="50" cy="50" r="1" fill="%23e0e0e0" opacity="0.3"/></pattern></defs><rect width="1200" height="800" fill="url(%23temple-bg)"/></svg>');
        background-size: cover;
        padding: 30px 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

    .main-title {
        font-size: 3rem;
        color: #8b4513;
        margin-bottom: 8px;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(139,69,19,0.3);
        letter-spacing: 3px;
    }

    .subtitle {
        font-size: 1rem;
        color: #666;
        margin-bottom: 30px;
    }

    .controls {
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 25px;
    }

    .control-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .control-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
    }

    .control-label {
        font-size: 1rem;
        color: #666;
        font-weight: normal;
    }

    .columns-container {
        display: flex;
        gap: 8px;
        background: white;
        border: 2px solid #8b4513;
        border-radius: 30px;
        padding: 2px;
        box-shadow: 0 2px 8px rgba(139,69,19,0.1);
    }

    .btn-columns {
        width: 40px;
        height: 40px;
        border: none;
        background: white;
        color: #8b4513;
        border-radius: 50%;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-columns.active {
        background: #8b4513;
        color: white;
    }

    .btn-columns:hover:not(.active) {
        background: #f5f5f5;
        transform: scale(1.05);
    }

    .autoplay-container {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
    }

    .toggle-switch {
        position: relative;
        width: 80px;
        height: 40px;
        background: #8b4513;
        border: 2px solid #8b4513;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 8px;
        box-shadow: 0 2px 8px rgba(139,69,19,0.2);
    }

    .toggle-switch.off {
        background: white;
        border: 2px solid #8b4513;
    }

    .toggle-text {
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
        z-index: 2;
        position: absolute;
    }

    .toggle-switch .toggle-text {
        left: 12px;
    }

    .toggle-switch.off .toggle-text {
        color: #8b4513;
        right: 8px;
        left: auto;
    }

    .toggle-switch::before {
        content: '';
        position: absolute;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: white;
        top: 2px;
        right: 4px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .toggle-switch.off::before {
        background: #8b4513;
        left: 4px;
        right: auto;
    }

    .carousel-container {
        position: relative;
        margin-bottom: 20px;
    }

    .carousel-grid {
        display: grid;
        gap: 15px;
        justify-content: center;
    }

    .grid-2 { 
        grid-template-columns: repeat(2, 1fr);
        max-width: 600px;
        margin: 0 auto;
    }
    .grid-3 { 
        grid-template-columns: repeat(3, 1fr);
        max-width: 900px;
        margin: 0 auto;
    }
    .grid-4 { 
        grid-template-columns: repeat(4, 1fr);
        max-width: 1000px;
        margin: 0 auto;
    }

    #watthai.wat {
        position: relative;
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        background: white;
        cursor: pointer;
        width: 100%;
    }

    #watthai.wat:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    #imagewatthai.imagewatthai2 {
        width: 100%;
        height: 300px;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.3s ease;
    }

    #watthai.wat:hover #imagewatthai.imagewatthai2 {
        transform: scale(1.02);
    }

    .temple-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .temple-name {
        font-size: 1.6rem;
        font-weight: medium;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        margin: 0;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 15px;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ccc;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: #8b4513;
    }

    .dot:hover {
        transform: scale(1.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.2rem;
        }

        .controls {
            flex-direction: column;
            gap: 15px;
        }

        .carousel-grid {
            gap: 10px;
        }

        .grid-3, .grid-4 {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 480px) {
        .grid-2, .grid-3, .grid-4 {
            grid-template-columns: 1fr !important;
        }
        
        .main-title {
            font-size: 1.8rem;
        }

        .control-left, .control-right {
            justify-content: center;
        }
    }
</style>