<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kamil Świętoniowski</title>
    <script src="https://unpkg.com/roughjs@latest/bundled/rough.js"></script>
</head>
<body>
    <canvas id="canvas"></canvas>
    <div class="container" id="container">
        <header>
            <div class="home nav-item" data-hovered="false">Home</div>
            <div class="projects nav-item" data-hovered="false">Projects</div>
            <div class="about nav-item" data-hovered="false">About me</div>
            <div class="contact nav-item" data-hovered="false">Contact</div>
        </header>

        <section>
            <div class="left-column">
                <div class="greeting">

                    <h1>Hello, I am<br><span class="imie" id="nazwisko">Kamil Świętoniowski</span></h1>
                </div>
                <div class="aboutme">
                        Technical School Student & Aspiring Developer. Currently learning
                        the foundations of Web Development (HTML, CSS, JS, PHP) and
                        exploring Systems Programming with Rust.
                </div>
            </div>

            <div class="right-column">
                <div class="check-project"><h1>Check my projects</h1></div>
                <div id="project1" class="project-card" data-hovered="false">Project 1</div>
                <div id="project2" class="project-card" data-hovered="false">Project 2</div>
            </div>
            
        </section>

        <footer>
            <div></div>
            <div class="info">© 2026 Kamil Świętoniowski</div>
            <div class="links">
                <div class="github">Github</div>
                <div class="linkedin">LinkedIn</div>
            </div>
        </footer>
    </div>

    <script>

const ACCENT_COLOR = '#059669';

const globalStrokeOptions = {
    stroke: '#020202',       
    strokeWidth: 1.5,        
    roughness: 1.2,          
    bowing: 2.3,             
    disableMultiStroke: false 
};

function drawFrame(element_id, customOptions = null) {
    let element1 = document.getElementById(element_id);
    if (!element1) return;
    
    let rect = element1.getBoundingClientRect();
    let canva = document.getElementById("canvas");
    let canvas = rough.canvas(canva);

    const width = rect.width;
    const height = rect.height;
    const x = rect.left + window.scrollX;
    const y = rect.top + window.scrollY;
    
    const r = 30; 
    const strokeOptions = customOptions || globalStrokeOptions;

    canvas.line(x + r, y, x + width - r, y, strokeOptions);                 
    canvas.line(x + width, y + r, x + width, y + height - r, strokeOptions); 
    canvas.line(x + width - r, y + height, x + r, y + height, strokeOptions); 
    canvas.line(x, y + height - r, x, y + r, strokeOptions);                 

    canvas.arc(x + r, y + r, r * 2, r * 2, Math.PI, Math.PI * 1.5, false, strokeOptions);         
    canvas.arc(x + width - r, y + r, r * 2, r * 2, Math.PI * 1.5, Math.PI * 2, false, strokeOptions); 
    canvas.arc(x + width - r, y + height - r, r * 2, r * 2, 0, Math.PI * 0.5, false, strokeOptions); 
    canvas.arc(x + r, y + height - r, r * 2, r * 2, Math.PI * 0.5, Math.PI, false, strokeOptions); 
}

function drawSeparator(element_selector) {
    let element = document.querySelector(element_selector);
    if (!element) return;

    let rect = element.getBoundingClientRect();
    let canva = document.getElementById("canvas");
    let canvas = rough.canvas(canva);

    let container = document.getElementById("container");
    let containerRect = container.getBoundingClientRect();

    const startX = containerRect.left + window.scrollX;
    const endX = containerRect.right + window.scrollX;
    
    const y = rect.bottom + window.scrollY;

    canvas.line(startX, y, endX, y, globalStrokeOptions);
}

function setupProjectCard(id) {
    let el = document.getElementById(id);
    if (!el) return;

    if (el.getAttribute('data-hovered') === 'true') {
        drawFrame(id, {
            stroke: '#020202',
            strokeWidth: 4.5,            
            roughness: 1.6,   
            bowing: 2.5,
            disableMultiStroke: false
        });
    } else {
        drawFrame(id, globalStrokeOptions);
    }
}

function drawNavUnderlines() {
    let canva = document.getElementById("canvas");
    let canvas = rough.canvas(canva);

    document.querySelectorAll('.nav-item').forEach(el => {
        if (el.getAttribute('data-hovered') === 'true') {
            let rect = el.getBoundingClientRect();
            
            const startX = rect.left + window.scrollX;
            const endX = rect.right + window.scrollX;
            const y = rect.bottom + window.scrollY + 4;

            canvas.line(startX, y, endX, y, {
                stroke: ACCENT_COLOR, 
                strokeWidth: 2.5,
                roughness: 1.5,
                bowing: 1.5
            });
        }
    });
}

function drawNameUnderline() {
    let el = document.getElementById("nazwisko");
    if (!el) return;

    let rect = el.getBoundingClientRect();
    let canva = document.getElementById("canvas");
    let canvas = rough.canvas(canva);

    const startX = rect.left + window.scrollX;
    const endX = rect.right + window.scrollX;
    
    const y1 = rect.bottom + window.scrollY + 4;
    const y2 = rect.bottom + window.scrollY + 10;


    const underlineOptions = {
        stroke: ACCENT_COLOR, 
        strokeWidth: 3,      
        roughness: 1.8,      
        bowing: 1.5
    };

    canvas.line(startX - 5, y1, endX + 5, y1 + 1, underlineOptions);
    canvas.line(startX + 2, y2, endX - 10, y2 - 1, underlineOptions);
}

function drawAll() {
    let canva = document.getElementById("canvas");
    let ctx = canva.getContext("2d");
    
    const bodyHeight = Math.max(
        document.body.scrollHeight, 
        document.body.offsetHeight, 
        document.documentElement.clientHeight, 
        document.documentElement.scrollHeight, 
        document.documentElement.offsetHeight
    );
    const bodyWidth = document.documentElement.scrollWidth;

    canva.width = bodyWidth;
    canva.height = bodyHeight;

    ctx.clearRect(0, 0, canva.width, canva.height);

    drawFrame("container");
    drawSeparator("header"); 
    drawSeparator("section"); 

    setupProjectCard("project1");
    setupProjectCard("project2");

    drawNavUnderlines();
    
    drawNameUnderline();
}

window.onload = function() {
    drawAll();
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(drawAll, 100); 
    });


    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.setAttribute('data-hovered', 'true');
            drawAll(); 
        });

        card.addEventListener('mouseleave', () => {
            card.setAttribute('data-hovered', 'false');
            drawAll(); 
        });
    });

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.setAttribute('data-hovered', 'true');
            drawAll();
        });

        item.addEventListener('mouseleave', () => {
            item.setAttribute('data-hovered', 'false');
            drawAll();
        });
    });
};
    </script>
</body>
</html>
