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
<script>
    var modaldialog = $('#modal-dialog');
    function modalClose(){
        modaldialog.modal("hide");
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
    var defSave = function(){
        alert('請建立方法modalSave或指定回調來處理Modal Save的動作');
    }
    var defClose = function(){
        // default do nothing after modal closed
    }
    var defOk = function(){
        modalClose();
    }
    function modalPopup(type,size,getUrl){
        if( arguments[3] ){
            // if assign callback from client, override default method
            if( arguments[3][0] ) modalConfirm = arguments[3][0];
            if( arguments[3][1] ) afterClose = arguments[3][1];
        }

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
            modaldialog.modal('show');
        } else {
            $('#modal-body').load(getUrl,function(){
                modaldialog.modal('show');
            });
        }
    }
</script>
