const images = document.getElementsByTagName('img');

/**
 * handle the event
 */
const BtnAddHandler = (images) => {
    let clicksOnImages = Array(images.length).fill(false);
    for (let i = 0; i < images.length; i++) {
        images[i].addEventListener('click', function (e) {
            if (!clicksOnImages[i]) {
                images[i].style.width = '100%';
                clicksOnImages[i] = true;
                e.preventDefault();
            } else if (clicksOnImages[i]) {
                images[i].style.width = '5%';
                clicksOnImages[i] = false;
                e.preventDefault();
            }
        });
    }
}

/**
 * script initialization
 */
const init = () => {
    BtnAddHandler(images);
}

init();
