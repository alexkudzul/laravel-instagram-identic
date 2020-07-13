
const url = 'http://laravel-instagram-identic.test';

window.addEventListener('load', function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-unlike').css('cursor', 'pointer');

    // Boton like
    // Metodo click() => al ser un eventos y acumala una serie de funciones ejecutadas conocidas como bind
    // Metodo off() => Elimina un controlador de eventos adjunto previamente de los elementos(.btn-like)(evita duplicar la ejecucion de funciones)
    function like(){
        $('.btn-like').off().click(function(){
            console.log('like');
            $(this).addClass('btn-unlike').removeClass('btn-like');
            $(this).attr('src', '/img/heart-red.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    // like un objeto que devuelve response, al dar click
                    if (response.like) {
                        console.log('like sucess');
                    } else {
                        console.log('like not sucess');
                    }
                }
            });

            unlike();
        });
    }

    like()

    function unlike(){
        $('.btn-unlike').off().click(function(){
            console.log('unlike');
            $(this).addClass('btn-like').removeClass('btn-unlike');
            $(this).attr('src', '/img/heart-black.png');

            $.ajax({
                url: url+'/unlike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    // like un objeto que devuelve response, al dar click
                    if (response.like) {
                        console.log('unlike sucess');
                    } else {
                        console.log('unlike not sucess');
                    }
                }
            });

            like();
        });
    }

    unlike();
});
