<?php  $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<header class="panel-heading">
				<h4 class="panel-title"><?=translate('select_ground')?></h4>
			</header>
			<?php echo form_open($this->uri->uri_string(), array('class' => 'validate'));?>
			<div class="panel-body">
				<div class="row mb-sm">
				<?php if (is_superadmin_loggedin() ): ?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getClassByBranch(this.value)'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
							?>
						</div>
					</div>
				<?php endif; ?>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
							<?php
								$arrayClass = $this->app_lib->getClass($branch_id);
								echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,1)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
					<div class="col-md-<?php echo $widget; ?> mb-sm">
						<div class="form-group">
							<label class="control-label"><?=translate('shift')?> <span class="required">*</span></label>
							<?php
								$arraySection = $this->app_lib->getSections(set_value('class_id'), true);
								echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id' required
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
							?>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<button type="submit" name="search" value="1" class="btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
					</div>
            </footer>
                    <div class="tab-content">
                        <div id="invoice" class="tab-pane <?=empty($this->session->flashdata('pay_tab')) ? 'active' : ''; ?>">
                            <div class="text-right mr-lg hidden-print">
                                <button onClick="printDiv('invoice_print')" class="btn btn-default ml-sm"><i class="fas fa-print"></i> <?=translate('print')?></button>
                            </div>
                            <div id="invoice_print">
                                <div class="invoice">
                                    <header class="clearfix">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="ib">
                                                    <img src="<?=$this->application_model->getBranchImage($basic['branch_id'], 'printing-logo-1')?>" alt="RamomCoder Img" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h4 class="mt-none mb-none text-dark">Islamia University School System (ISS)</h4>
                                                <h5 class="mt-none mb-none text-dark">Contact: +92-62-9255863</h5>
                                                <h5 class="mt-none mb-none text-dark">Email: diss@iub.edu.pk</h5>
                                                <p class="mb-none">
                                                    <span class="text-dark"><?=translate('date')?>: </span>
                                                    <span class="value"><?=_d(date('Y-m-d'))?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </header>

                                    <div class="table-responsive br-none">
                                        <table class="table invoice-items table-hover mb-none">

                                            <thead >
                                            <tr>
<!--                                                <th colspan="1" style="text-align: right; background-color: #cfc0c0; font-size: x-large">Class:</th>-->
                                                <th colspan="4" style="text-align: center; background-color: #cfc0c0; font-size: x-large"><?php echo @$invoicelist[0]['class_name']; ?></th>
<!--                                                <th colspan="1" style="text-align: right; background-color: #cfc0c0; font-size: x-large">Shift:</th>-->
                                                <th colspan="3" style="text-align: center; background-color: #cfc0c0; font-size: x-large"><?php echo @$invoicelist[0]['section_name']; ?></th>
                                            </thead>

                                            <thead>
                                            <tr>
                                                <th><?=translate('sr')?></th>
                                                <th><?=translate('registration_no')?></th>
                                                <th><?=translate('name')?></th>
                                                <th><?=translate('gender')?></th>
                                                <th><?=translate('guardian_name')?></th>
                                                <th><?=translate('guardian_cnic')?></th>
                                                <th><?=translate('contact')?></th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $sr=1;
                                            foreach ($invoicelist as $row){
                                            ?>
                                            <tr>

                                                </td>
                                                <td><?php echo $sr++ ?></td>
                                                <td><?php echo $row['register_no'];?></td>
                                                <td><?php echo $row['fullname'];?></td>
                                                <td><?php echo $row['gender'];?></td>
                                                <td><?php echo (!empty($row['parent_id']) ? get_type_name_by_id('parent', $row['parent_id']) : 'N/A');?></td>
                                                <td><?php echo $row['cnic'];?></td>
                                                <td><?php echo $row['contact'];?></td>

                                                <?php
                                                } ?>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                            </div>
                        </div>
                        </div>
                    </div>


		</section>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>



