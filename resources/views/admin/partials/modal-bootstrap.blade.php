<div id="error" modal="show" class="modal fade">
    <div class="modal-dialog modal-confirm-delete">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h4 class="modal-title w-100 mt-2 text-center">Sorry!</h4>
            </div>
            <div class="modal-body">
                <p class='text-center' id="msgerror"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div id="success" class="modal fade" aria-modal="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fas fa-check"></i>
                </div>
                <h5 class="modal-title w-100 mt-2 text-center">Success</h5>
            </div>
            <div class="modal-body">
                <p class="text-center" id="msgsuccess"></p>
            </div>
            <div class="modal-footer">
                <button id="confEror" class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<div id="confirmdelete" class="modal fade">
    <div class="modal-dialog modal-confirm-yesno">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p id="msgconfirmdel"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="btnconfirm" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
