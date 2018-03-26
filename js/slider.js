var numImages = 3;
var images = [];
for (var i = 0; i < numImages; ++i) {
    var image = new Image();
    image.src = 'image/' + (i + 1) + '.jpg';
    images.push(image);
}

var step = 0;
function slideit() {
    if (! document.images) {
        return;
    }
    document.images.slide.src = images[step].src;
    step = (step + 1) % numImages;
}
setInterval(slideit, 2500);