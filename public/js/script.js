const addListener = (item) => {
    item.addEventListener('click', function(e) {
        console.log(this)
    })
};

[...document.getElementsByClassName('nav-item')].forEach(addListener);