<head>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

</head>
<?php if ($this->session->flashdata('message')) {
    $btn = "";
    $btn = "btn btn-primary form-check-label w-25 p-2";
    ?>
    <div class="box-body">
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
<?php }

if ($this->session->flashdata('error-message')) {
    ?>
    <div class="box-body">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('error-message'); ?>
        </div>
    </div>
<?php } ?>
<?php
//$widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="container">
    <!--<form action="https://iss.iub.edu.pk/Franchise_call/crud" method="post">-->
    <?php echo form_open(base_url('Franchise_call/franchise_call_request'), array('class' => 'form-horizontal frm-submit-data')); ?>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Franchise and School Conversion Offer</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        Let's Own Your Purposeful Business
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title ">Are you interested in new school or conversion your existing school?</h5>
                    <input type="hidden" name="q1" value="1">
                        <label class="btn btn-primary form-check-label w-25 p-2">
                            <input class="form-check-input" type="radio" name="new_conversion" checked autocomplete="off" value="1"> New School
                        </label>
                        <br>
                        <br>
                        <label class="btn btn-primary form-check-label w-25 p-2">
                            <input class="form-check-input" type="radio" name="new_conversion" autocomplete="off" value="2"> Conversion existing School
                        </label>
                        <br>

<!--                    </div>-->
                    <!--Radio buttons-->
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">If you are already running a school kindly select your student strength?</h5>
                    <input type="hidden" name="q2" value="2">
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="students" checked autocomplete="off" value="3"> Between 50 to 100
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="students" autocomplete="off" value="4"> Between 100 to 200
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="students" autocomplete="off" value="5"> Above 200
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="students" autocomplete="off" value="6"> New School
                    </label>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">If you are already running a school kindly select your fee range?</h5>
                    <input type="hidden" name="q3" value="3">
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="fee" checked autocomplete="off" value="7"> Between 1000 to 2000
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="fee" autocomplete="off" value="8"> Between 2000 to 3000
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="fee" autocomplete="off" value="9"> Above Between 3000
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="fee" autocomplete="off" value="10"> New School
                    </label>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Please mention your proposed investment?</h5>
                    <input type="hidden" name="q4" value="4">
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="investment" checked autocomplete="off" value="11"> 25 Lac
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="investment" autocomplete="off" value="12"> 35 Lac
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="investment" autocomplete="off" value="13"> 45 Lac
                    </label>
                    <br>
                    <br>
                    <label class="btn btn-primary form-check-label w-25 p-2">
                        <input class="form-check-input" type="radio" name="investment" autocomplete="off" value="14"> Above 60 Lac
                    </label>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row form-group">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Phone Number / Whatsapp Number?</h5>
                    <input type="hidden" name="q5" value="5">
                    <div class="col-lg-4 mx-auto">

                        <input id="cell_no" name="cell_no" data-inputmask="'mask': '09999999999'" required
                               placeholder="03000000000" type="text" class="form-control error" value="">

                        <span class="error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <div class="card text-center">
                <div class="card-body">
                    <!--            <input type="submit" class="btn btn-small" id="submit" name="submit" required-->
                    <!--                   placeholder="Submit">-->
                    <input type="submit" class="btn btn-primary w-100 p-2" value="Submit">
                </div>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
    <br>

    <?php echo form_close(); ?>
    <!--</form>-->

</div>
<script>
    $(document).ready(function () {
        $(":input").inputmask();
    });
</script>