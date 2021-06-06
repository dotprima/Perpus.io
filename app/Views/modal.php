<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="book_id" />
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" id="name" name='name' class="form-control"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telephone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="adduser(<?php echo $user['id']?>)"
                    class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>