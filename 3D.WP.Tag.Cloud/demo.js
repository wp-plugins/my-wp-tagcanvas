// This function demonstrates centreFunc option of TagCanvas.
// For information how to create yours visit: http://diveintohtml5.info/canvas.html
// Anyway you have to be familiar with HTML5 tag <canvas>.

function CF_demo(c, w, h, cx, cy){
var d = ((new Date).getTime() % 10000) * Math.PI / 2500;
c.setTransform(1, 0, 0, 1, 0, 0);
c.translate(cx, cy);
c.rotate(d);
c.globalAlpha = 1;
c.fillStyle = '#222';
c.fillRect(-36, -36, 72, 72);
c.fillStyle = '#369d88';
c.fillRect(-35, -35, 70, 70);
c.fillStyle = '#222';
c.fillRect(-32, -32, 64, 64);
c.fillStyle = '#ccc';
c.fillRect(-29, -29, 58, 58);
c.fillStyle = '#222';
c.fillRect(-26, -26, 52, 52);
c.beginPath();
c.moveTo(0, 0);
c.arc(0, 0, 23, Math.PI, 6 * Math.PI / 2, 0);
c.fillStyle = '#ccc';
c.fill();
c.beginPath();
c.moveTo(0, 0);
c.arc(0, 0, 20, Math.PI, 4 * Math.PI / 2, 0);
c.fillStyle = '#369d88';
c.fill();
c.fillStyle = '#222';
c.font = 'bold 12px Courier New';
c.fillText('({8-{>', -22, -8); 
}	
