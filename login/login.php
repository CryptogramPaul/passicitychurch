<!-- <script src="../js/custom.js"></script> -->
<form id="loginForm">
    <div class="modal fade" id="login_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " id="">
            <div class="modal-content" id="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body ">
                           <div class="d-flex justify-content-between">
                                <h4 class="login-box-msg ">Sign in</h4>
                                <button type="button" class="btn-close float-end px-3" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                              <!--<div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" id="login_username"
                                    autocomplete="off" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" id="login_password"
                                    autocomplete="off" required>
                            </div> -->
                            <div class="row px-2 py-1">
                                <input type="text" class="form-control" placeholder="Username" id="login_username"
                                autocomplete="off" required>
                            </div>
                            <div class="row px-2 py-1">
                                <input type="password" class="form-control" placeholder="Password" id="login_password"
                                autocomplete="off" required>
                            </div>
                            <div class="row px-2 py-1">
                                <button class="btn btn-primary fw-bold" id="loginBtn" type="submit">
                                    <span id="btnText">Sign In</span>
                                    <div id="spinner" class="spinner-border spinner-border-sm text-light" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                                <!-- <br> -->
                                <a class="text-center" href="#" data-bs-toggle="modal" data-bs-target="#sign_up_modal"
                                    onclick="SignUpModal(null, 0)">Sign up here!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Confirm Booking</button>
                  </div>
              </div> -->
            </div>
        </div>
    </div>
</form>