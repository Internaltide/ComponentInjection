<div class="row">
    <div id="modal-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" data-bg="{{ $modalBackground }}">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">{{ $modalLabel }}</h4>
            </div>

            <!-- Modal Content -->
            <div id="modal-body" class="modal-body">
                <div class="container-fluid">
                    <!-- Load By Ajax -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalSave">Save</button>
                <button type="button" class="btn btn-primary" id="modalOk">Ok</button>
                <button type="button" class="btn btn-primary" id="modalCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>
@if( $api === true )
    <script>
        function modalClose(){
            $('#modal-dialog').modal("hide");
        }
        function modalSubmit(targets){
            $('#modal-targets').val(targets);
            $('#modal-form').find('[type="submit"]').trigger('click');
        }
        function modalEmpty(){
            var el = ['input','textarea','select'];
            el.forEach(function(element) {
                $('#form-main').find(element).each(function(){
                    $(this).val('');
                });
            });
        }
        function modalBackground(background){
            var url = /^http\S+$/;
            background = background.trim();
            if( background.length > 0 ){
                if( url.test(background) ){
                    $('.modal-dialog').css('background', "url('"+background+"')");
                } else {
                    $('.modal-dialog').css('background', background);
                }
            } else {
                $('.modal-dialog').css('background', 'white');
            }
        }
        var defSave = function(){
            alert('請建立方法modalSave或指定回調來處理Modal Save的動作');
        }
        var defClose = function(){
            // default do nothing after modal closed
        }
        var defOk = function(){
            modalClose();
        }
        function modalPopup(title,type,size,getUrl){
            if( arguments[4] ){
                // if assign callback from client, override default method
                if( arguments[4][0] ) modalConfirm = arguments[4][0];
                if( arguments[4][1] ) afterClose = arguments[4][1];
            }

            $('.modal-title').html(title);
            modalBackground( $('.modal-dialog').data('bg') );

            var btnObj;
            switch(type){
                case 'form':
                    $('#modalOk').hide();
                    btnObj = {
                        "Cancel": modalClose,
                        "Save": typeof(modalConfirm)==='function' ? modalConfirm:defSave
                    }
                    break;
                case 'info':
                    $('#modalSave').hide();
                    btnObj = {
                        "Cancel": modalClose,
                        "Ok": typeof(modalConfirm)==='function' ? modalConfirm:defOk
                    }
                    break;
            }

            loadContent(size,getUrl,btnObj);
        }
        function loadContent(size,getUrl,btnObj){
            $('.modal-dialog').addClass(size);

            $('#modalCancel').on('click', btnObj.Cancel);
            if( btnObj.Save ){
                $('#modalSave').on('click', btnObj.Save);
            } else {
                $('#modalOk').on('click', btnObj.Ok);
            }

            if( getUrl.length == 0 ){
                $('#modal-body').html('Content Loading...');
                $('#modal-dialog').modal('show');
            } else {
                var url = /^http\S+$/;
                if( url.test(getUrl) ){
                    $('#modal-body').load(getUrl,function(){
                        $('#modal-dialog').modal('show');
                    });
                } else {
                    $('#modal-body').html(getUrl);
                    $('#modal-dialog').modal('show');
                }
            }
        }
    </script>
@endif
