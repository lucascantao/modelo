<div class="modal-delete d-none" name={{$name}}> 

    <div class="bg-white card p-4">
        
        <p class="fs-5">{{$message}}</p>
        <div>
            <a class="col-3 btn btn-outline-danger me-4 mt-3" href="{{route($route, ['id' => $id])}}">Sim</a>
            <a class="cancel col-3 btn btn-outline-semas mt-3">Não</a>
        </div>

    </div>

</div>

<script>
    $('label[for = ' + '{{$name}}' + ']').on('click', function () {
        $('div[name = '+ '{{$name}}' +' ]').removeClass('d-none');
    }) 

    $('.modal-delete .cancel').on('click', function() {
            $('.modal-delete').addClass('d-none')
        })
</script>