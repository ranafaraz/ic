<?php  $widget = (is_superadmin_loggedin() ? 4 : 6); ?>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <?php echo form_open($this->uri->uri_string(), array('class' => 'validate'));?>
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
                                        <h4 class="mt-none mb-none text-dark">Islamia University of Bahawalpur Schools System (ISS)</h4>
                                        <h5 class="mt-none mb-none text-dark">Contact: +92-62-9255863</h5>
                                        <h5 class="mt-none mb-none text-dark">Email: diss@iub.edu.pk</h5>
                                        <p class="mb-none">
                                            <span class="text-dark"><?=translate('date')?> : </span>
                                            <span class="value"><?=_d(date('Y-m-d'))?></span>
                                        </p>
                                    </div>
                                </div>
                            </header>

                            <div class="table-responsive br-none">
                                <table class="table table-bordered table-hover table-condensed" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="50"><?php echo translate('sl'); ?></th>
                                        <?php if (is_superadmin_loggedin()): ?>
                                            <!--							<th>--><?//=translate('branch')?><!--</th>-->
                                        <?php endif; ?>
                                        <!--							<th>--><?php //echo translate('account') . " " . translate('name'); ?><!--</th>-->
                                        <th><?php echo translate('title'); ?></th>
<!--                                        <th>--><?php //echo translate('voucher') . " " . translate('head'); ?><!--</th>-->
                                        <th><?php echo translate('email'); ?></th>
                                        <th><?php echo translate('contact'); ?></th>
                                        <th><?php echo translate('city'); ?></th>
                                        <th><?php echo translate('no_of_franchises'); ?></th>
<!--                                        <th>--><?php //echo translate('cr'); ?><!--</th>-->
<!--                                        <th>--><?php //echo translate('balance'); ?><!--</th>-->
<!--                                        <th>--><?php //echo translate('date'); ?><!--</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; foreach ($clients as $row): ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if (is_superadmin_loggedin()): ?>
                                                <!--							<td>--><?php //echo get_type_name_by_id('branch', $row['branch_id']);?><!--</td>-->
                                            <?php endif; ?>
                                            <!--							<td>--><?php //echo (!empty($row['attachments']) ? '<i class="fas fa-paperclip"></i> ' : ''); ?><!-- --><?php //echo html_escape($row['ac_name']); ?><!--</td>-->
                                            <td><?php echo ucfirst($row['client_name']); ?></td>
<!--                                            <td>--><?php //echo $row['v_head']; ?><!--</td>-->
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['city_name']; ?></td>
                                            <td><?php echo $row['franchises']; ?></td>
<!--                                            <td>--><?php //echo $currency_symbol . $row['cr']; ?><!--</td>-->
<!--                                            <td>--><?php //echo $currency_symbol . $row['bal']; ?><!--</td>-->
<!--                                            <td>--><?php //echo _d($row['date']); ?><!--</td>-->
                                        </tr>
                                    <?php endforeach; ?>
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



