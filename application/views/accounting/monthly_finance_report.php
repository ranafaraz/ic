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
                                    <tr >
                                        <th width="50" style="text-align: center"><?php echo translate('sl'); ?></th>
                                        <th style="text-align: center"><?php echo translate('date');?> </th>
<!--                                        <th style="text-align: center">--><?php //echo translate('year');?><!--</th>-->
                                        <th style="text-align: center"><?php echo translate('amount') ; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $grand_total = 0; $count = 1; foreach ($monthlyfinancereport as $row):
                                        $grand_total += $row['amount'];
                                        ?>

                                        <tr>

                                            <td style="text-align: center"><?php echo $count++; ?></td>
                                            <td style="text-align: center"><?php
                                            if ($row['month'] == 1)
                                                echo 'January - ';
                                                if ($row['month'] == 2)
                                                    echo 'February - ';
                                                if ($row['month'] == 3)
                                                    echo 'March - ';
                                                if ($row['month'] == 4)
                                                    echo 'April - ';
                                                if ($row['month'] == 5)
                                                    echo 'May - ';
                                                if ($row['month'] == 6)
                                                    echo 'June - ';
                                                if ($row['month'] == 7)
                                                    echo 'July - ';
                                                if ($row['month'] == 8)
                                                    echo 'August - ';
                                                if ($row['month'] == 9)
                                                    echo 'September - ';
                                                if ($row['month'] == 10)
                                                    echo 'October - ';
                                                if ($row['month'] == 11)
                                                    echo 'November - ';
                                                if ($row['month'] == 12)
                                                    echo 'December - ';
                                                echo $row['year']; ?> </td>
<!--                                            <td style="text-align: center">--><?php //echo $row['year'] ?><!--</td>-->
                                            <td style="text-align: center"><?php echo ($currency_symbol . number_format($row['amount'], 2, '.', ',')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                    <th></th>
                                    <th style="text-align: center">Total Amount</th>
                                    <th style="text-align: center"> <?php echo ($currency_symbol . number_format($grand_total, 2, '.', ',')); ?></th>
                                    </tfoot>
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



