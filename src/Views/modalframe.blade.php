<div class="row">
    <div id="modal-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" data-bg="{{ $modalBackground }}">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header {{ $headerColor }}">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ $modalLabel }}</h4>
                </div>

                <!-- Modal Content -->
                <div class="{{ $contentColor }}">
                    <div id="modal-body" class="container-fluid">
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
</div>
@if( $api === true )
    <script>
        var ramy8xyn6K5mMZ5='';
        function modalClose(){
            $('#modal-dialog').modal("hide");
        }
        function modalSubmit(){
            if( arguments[0] ) $('#modal-targets').val(arguments[0]);
            $('#modal-form').find('[type="submit"]').trigger('click');
        }
        function modalBind(selector, event, callback){
            $(selector).off().on(event, callback);
        }
        function modalEmpty(){
            var strForShow = ( typeof(arguments[0]) === 'undefined' ) ? 'Content Loading...':arguments[0];
            $('#modal-body').html(strForShow);
        }
        function modalClear(){
            var el = ['input','textarea','select'];
            el.forEach(function(element) {
                $('#form-main').find(element).each(function(){
                    $(this).val('');
                });
            });
        }
        function modalBtnToggle(btntype, action){
            var btn;
            switch(btntype){
                case 'save':
                    btn = $('#modalSave');
                    break;
                case 'ok':
                    btn = $('#modalOk');
                    break;
                case 'cancel':
                    btn = $('#modalCancel');
                    break;
            }

            (action==='hide') ? btn.hide():btn.show();
        }
        function modalBackground(background){
            var url = /^http\S+$/;
            background = background.trim();
            if( background.length > 0 ){
                if( url.test(background) ){
                    $('.modal-content').css('background', "url('"+background+"')");
                } else {
                    $('.modal-content').css('background', background);
                }
            } else {
                $('.modal-content').css('background', 'white');
            }
            $('.modal-content').css('background-size', 'cover');
        }
        var defSave = function(){
            //alert('請建立方法modalSave或指定回調來處理Modal Save的動作');
            modalSubmit();
        }
        var defClose = function(){
            // default do nothing after modal closed
        }
        var defOk = function(){
            modalClose();
        }
        var defComplete = function(){
            // default do nothing after modal closed
        }
        function modalPopup(title,type,size,getUrl){
            var differentModal = (ramy8xyn6K5mMZ5.length > 0 && ramy8xyn6K5mMZ5 !== title) ;
            if( arguments[4] ){
                // if assign callback from client, override default method
                if( arguments[4][0] ) var modalComplete = arguments[4][0];
                if( arguments[4][1] ) var modalConfirm = arguments[4][1];
                if( arguments[4][2] ) var afterClose = arguments[4][2];
            }

            if(differentModal) modalEmpty();
            ramy8xyn6K5mMZ5 = title;

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
            btnObj.virtualComplete = (typeof(modalComplete)==='function') ? modalComplete:defComplete;
            btnObj.virtualAfterClose = (typeof(afterClose)==='function') ? afterClose:defClose;

            $('.modal-title').html(title);
            modalBackground( $('.modal-dialog').data('bg') );
            loadContent(size,getUrl,btnObj);
        }
        function loadContent(size,getUrl,btnObj){
            $('.modal-dialog').removeClass().addClass('modal-dialog '+size);

            modalBind('#modalCancel', 'click', btnObj.Cancel);
            if( btnObj.Save ){
                modalBind('#modalSave', 'click', btnObj.Save);
            } else {
                modalBind('#modalOk', 'click', btnObj.Save);
            }

            if( getUrl.length == 0 ){
                $('#modal-body').html('Content Loading...');
                $('#modal-dialog').modal('show');
            } else {
                var url = /^http\S+$/;
                if( url.test(getUrl) ){
                    $('#modal-body').load(getUrl,function(){
                        $('#modal-dialog').modal('show');
                        btnObj.virtualComplete();
                    });
                } else {
                    $('#modal-body').html(getUrl);
                    $('#modal-dialog').modal('show');
                }
            }

            $('#modal-dialog').on('hidden.bs.modal', btnObj.virtualAfterClose);
        }
    </script>
@endif
