<!-- <script src="../js/custom.js"></script> -->
<form id="verificationForm">
    <div class="modal fade" id="verification_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="">
            <div class="modal-content" id="modal-content">
                <div class="modal-body">
                    <div class="card p-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="login-box-msg ">Verify Your Email</h4>
                        </div>

                        <div class="row">
                            <div class="col p-3">
                                <input type="number" minlength="6" maxlength="6" class="form-control form-control-lg" id="verification_code" placeholder="Verification Code" required >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- <button type="submit" class="btn btn-primary btn-block">Verify</button> -->
                                <button class="btn btn-primary" id="verifyBtn" type="submit">
                                    <span id="btnText">Sign In</span>
                                    <div id="spinner" class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
