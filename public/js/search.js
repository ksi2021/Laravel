var products;
$.get("/api/games", function (data) {
    //  $( ".result" ).html( data );
    products = data.data;

});
document.querySelector('.search').oninput = function (e) {
    //  console.log(e.target.value);
    if (e.target.value) {
        addEventListener('keyup', function (event) {
            if (event.key == 'Escape') {
                e.target.value = '';
                console.log('ready');
                let c = document.querySelector('.list');
                var child = c.lastElementChild;
                while (child) {
                    c.removeChild(child);
                    child = c.lastElementChild;
                }
            }
        });

        let c = document.querySelector('.list');
        let result = products.filter(item => item.title.toLowerCase().search(e.target.value.toLowerCase()) != -1);
        var child = c.lastElementChild;
        while (child) {
            c.removeChild(child);
            child = c.lastElementChild;
        }
        result.forEach(function (elem) {
            let li = document.createElement('li');
            let a = document.createElement('a');
            let img = document.createElement('img');
            img.src = '/storage/' + elem.image;
            img.style.width = '100%';
            a.href = '/game/' + elem.id;
            a.innerHTML = elem.title;
            a.style.fontSize = '40px';
            a.style.textDecoration = 'none';
            a.style.textTransform = 'uppercase';
            li.className = 'list-group-item';
            li.append(img);
            li.append(a);
            li.style.display = 'flex';
            li.style.width = '50%';
            li.style.flexDirection = 'column';
            c.append(li);
        });
        // console.log(result);
    }
    if (!e.target.value) {
        let c = document.querySelector('.list');
        var child = c.lastElementChild;
        while (child) {
            c.removeChild(child);
            child = c.lastElementChild;
        }
    }


};
