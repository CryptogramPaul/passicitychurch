<!-- <script src="../js/custom.js"></script> -->
<form id="loginForm">
<div class="modal fade" id="login_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " id="">
            <div class="modal-content" id="modal-content" >
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body login-card-body">
                      <div class="d-flex justify-content-between">
                        <p class="login-box-msg ">Sign in here!</p>
                        <button type="button" class="btn-close float-end px-3" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Username" id="login_username" autocomplete="off" required>
                            <!-- <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                              </div>
                            </div> -->
                          </div>
                          <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" id="login_password" autocomplete="off" required>
                            <!-- <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fa fa-lock"></span>
                              </div>
                            </div> -->
                          </div>
                          <div class="row">
                            <div class="col-12 justify-concert-center">
                              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                              <br>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#sign_up_modal">Sign up here!</a>
                            </div>
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

