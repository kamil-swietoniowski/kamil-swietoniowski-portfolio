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
    <canvas id="canvas" width="8000" height="8000"></canvas>
    <div class="container" id="container">
        <header>
            <div class="home">Home</div>
            <div class="projects">Projects</div>
            <div class="about">About me</div>
            <div class="contact">Contact</div>
        </header>

        <section>
            <div class="left-column">
                <div class="greeting">
                    <h1>Hello, I am<br>Kamil Świętoniowski</h1>
                </div>
                <div class="aboutme">
                        Technical School Student & Aspiring Developer. Currently learning
                        the foundations of Web Development (HTML, CSS, JS, PHP) and
                        exploring Systems Programming with Rust.
                </div>
            </div>

            <div class="right-column">
                <div class="check-project">Check my projects</div>
                <div id="project1">Project 1</div>
                <div id="project2">Project 2</div>
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
function drawFrame(element_id) {
    let element1 = document.getElementById(element_id);
    if (!element1) return;
    
    let rect = element1.getBoundingClientRect();
    let canva = document.getElementById("canvas");

    const width = rect.width;
    const height = rect.height;
    const x = rect.left + window.scrollX;
    const y = rect.top + window.scrollY;
    
    let canvas = rough.canvas(canva);
    const r = 30; 

    const strokeOptions = {
        stroke: '#020202',       
        strokeWidth: 1.5,        
        roughness: 1.2,          
        bowing: 2.3,             
        disableMultiStroke: false 
    };

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

    const strokeOptions = {
        stroke: '#020202',
        strokeWidth: 1.5,
        roughness: 1.2, 
        bowing: 1.8,
        disableMultiStroke: false
    };

    canvas.line(startX, y, endX, y, strokeOptions);
}

function drawAll() {
    let canva = document.getElementById("canvas");
    let ctx = canva.getContext("2d");
    

    ctx.clearRect(0, 0, canva.width, canva.height);


    drawFrame("container");
    drawFrame("project1");
    drawFrame("project2");

    drawSeparator("header"); 
    drawSeparator("section"); 
}


window.onload = function() {
    drawAll();
    window.addEventListener('resize', drawAll);
};

    </script>

</body>
</html>