<head>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
</head>
<?php if ($this->session->flashdata('message')) {
    ?>
    <div class="box-body">
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
<?php }

if($this->session->flashdata('error-message')){
    ?>
    <div class="box-body">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('error-message') ;?>
        </div>
    </div>
<?php } ?>
<?php
//$widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="container">

<!--<form action="https://iss.iub.edu.pk/Franchise_call/crud" method="post">-->
    <?php echo form_open( base_url('Franchise_call'), array('class' => 'form-horizontal frm-submit-data')); ?>

        <div class="card text-black bg-white">
            <div class="card-header" style="background-color: #383838; color: white">
                Expression of Interest <small>- Our representative will contact you in a while.</small>
            </div>
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; background-color: #383838; color: white">Personal Information</h5>
<!--                <p class="card-text text-white">We will use this information to contact you and not in any other manner at all.</p>-->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="first_name">First Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="Enter Your first Name">
                            <small id="first_name" class="form-text text-muted">Write your first name in Camel Casing.</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Enter Your last Name">
                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label"> <?=translate('cnic')?></label>
                            <span class="input-group-addon"><i class="fas fa-user-graduate"></i></span>
                            <input id="cnic" name="cnic" data-inputmask="'mask': '99999-9999999-9'"
                                   placeholder="_____-_______-_" type="text" class="form-control"
                                   name="cnic" value="<?=set_value('cnic')?>" />
                            <small id="cnic" class="form-text text-muted"></small>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="gender">Gender <span class="required">*</span></label>
                            <select class="form-control" id="gender" required name="gender">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label"> <?=translate('cell_no')?> <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user-graduate"></i></span>
                                <input id="cell_no" name = "cell_no" data-inputmask="'mask': '09999999999'" placeholder="03000000000" type="text" class="form-control" name="cell_no" value="<?=set_value('cell_no')?>" />
                            </div>
                        </div>
                        <span class="error"><?=form_error('cell_no')?></span>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label"><?=translate('email')?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-envelope-open"></i></span>
                                <input type="email" class="form-control" name="email" id="email" value="<?=set_value('email')?>" placeholder="example@mail.com" />
                            </div>
                            <span class="error"><?=form_error('email')?></span>
                        </div>
                    </div>
                </div>
                <div class="row-lg-12">
                    <div class="form-group">
                        <label for="mailing_address">Mailing Address</label>
                        <textarea class="form-control" id="mailing_address" name="mailing_address" rows="1"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <select class="form-control" id="province" name="province" required>
                                <option value="Punjab">Punjab</option>
                                <option value="Sindh">Sindh</option>
                                <option value="KPK">KPK</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Gilgit Baltistan">Gilgit Baltistan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="district">District <span class="required">*</span></label>
                            <input type="text" class="form-control" name="district" id="district" required placeholder="Enter Your District Name">
<!--                            <select class="form-control" id="district">-->
<!--                                <option value="">Rahim Yar Khan</option>-->
<!--                            </select>-->
                        </div>
                    </div>
<!--                    <div class="col-lg-3">-->
<!--                        <div class="form-group">-->
<!--                            <label for="city">City <span class="required">*</span></label>-->
<!--                            <input type="text" class="form-control" name="city" id="city" required placeholder="Enter Your City Name">-->
<!--                                                        <select class="form-control" id="district">-->
<!--                                                            <option value="">Rahim Yar Khan</option>-->
<!--                                                        </select>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; background-color: #383838; color: white">Educational Information</h5>
<!--                <p class="card-text text-white">We will use this information to contact you and not in any other manner at all.</p>-->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="last_degree">Last Degree <span class="required">*</span></label>
                            <input type="text" class="form-control" id="degree_name" name="degree_name" required placeholder="Enter Your Last Degree">
<!--                            <small id="last_degree" class="form-text text-muted">Write your first name in Camel Casing.</small>-->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="institute">Institution <span class="required">*</span></label>
                            <input type="text" class="form-control" id="institute" name="institute" required placeholder="Enter Your Institute Name">
<!--                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>-->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="year">Year Obtained <span class="required">*</span></label>
                            <input type="month" class="form-control" id="year" name="year" required placeholder="Enter Your Year Obtained">
                            <!--                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>-->
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <h5 class="card-title" style="text-align: center; background-color: #383838; color: white">Employment Information</h5>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="emp_name">Employer Name</label>
                            <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="Enter Your Employer Name">
                            <!--                            <small id="last_degree" class="form-text text-muted">Write your first name in Camel Casing.</small>-->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="business_nature">Nature of Business</label>
                            <input type="text" class="form-control" id="business_nature" name="business_nature" placeholder="Enter Nature of Business">
                            <!--                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>-->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="date_employed">Date Employed</label>
                            <input type="date" class="form-control" id="date_employed" name="date_employed" placeholder="Enter Date Employed">
                            <!--                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>-->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="position">Postiton Held</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Enter your Position">
                            <!--                            <small id="last_name" class="form-text text-muted">Write your last name in Camel Casing.</small>-->
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <input type="submit" class="pull-right" value="Submit" style="text-align: center">
            </div>
        </div>

    <?php echo form_close(); ?>
<!--</form>-->

</div>
<script>
    $(document).ready(function(){
        $(":input").inputmask();
    });
</script>