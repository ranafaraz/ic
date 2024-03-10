<?php
$widget = (is_superadmin_loggedin() ? 4 : 6);
$currency_symbol = $global_config['currency_symbol'];
?>
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
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-<?php echo $widget; ?> mb-sm">
                        <div class="form-group">
                            <label class="control-label"><?=translate('class')?> <span class="required">*</span></label>
                            <?php
                            $arrayClass = $this->app_lib->getClass($branch_id);
                            echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id' onchange='getSectionByClass(this.value,0)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
                            ?>
                        </div>
                    </div>
                    <div class="col-md-<?php echo $widget; ?> mb-sm">
                        <div class="form-group">
                            <label class="control-label"><?=translate('section')?></label>
                            <?php
                            $arraySection = $this->app_lib->getSections(set_value('class_id'), false);
                            echo form_dropdown("section_id", $arraySection, set_value('section_id'), "class='form-control' id='section_id'
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
                </div>
            </footer>
            <?php echo form_close();?>
        </section>
        <?php if (isset($invoicelist)): ?>
            <section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
                <?php echo form_open('fees/invoicePrint', array('class' => 'printIn')); ?>
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-list-ol"></i> <?=translate('due_fees_report');?></h4>
                </header>
                <div class="panel-body">
                    <div class="mb-md mt-md">
                        <div class="export_title"><?=translate('due_fees_report')?></div>
                        <table class="table table-bordered table-condensed table-hover mb-none tbr-top table-export">
                            <thead>
                            <tr>
                                <th><?=translate('sl')?></th>
                                <th><?=translate('student')?></th>
                                <th><?=translate('register_no')?></th>
                                <th><?=translate('roll')?></th>
                                <th><?=translate('mobile_no')?></th>
                                <th><?=translate('total_fees')?></th>
                                <th><?=translate('total_paid')?></th>
                                <th><?=translate('total_discount')?></th>
                                <th><?=translate('total_fine')?></th>
                                <th><?=translate('total_balance')?></th>
                                <!--								<th>--><?//=translate('fee_month')?><!--</th>-->
                                <!--								<th>--><?//=translate('fee_year')?><!--</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            $totalfees = 0;
                            $totalpaid = 0;
                            $totaldiscount = 0;
                            $totalfine = 0;
                            $totalbalance = 0;
                            foreach($invoicelist as $row):
                                $paid = $row['payment']['total_paid'] + $row['payment']['total_discount'];
                                if ((float)$row['total_fees'] <= (float)$paid) {

                                } else {
                                    $totalfees += $row['total_fees'];
                                    $totalpaid += $row['payment']['total_paid'];
                                    $totaldiscount += $row['payment']['total_discount'];
                                    $totalfine += $row['payment']['total_fine'];
                                    $totalbalance += ($row['total_fees'] - $paid);
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $row['first_name'] . ' ' . $row['last_name'];?></td>
                                        <td><?php echo $row['register_no'];?></td>
                                        <td><?php echo $row['roll'];?></td>
                                        <td><?php echo $row['mobileno'];?></td>
                                        <td><?php echo $currency_symbol . number_format($row['total_fees'], 2, '.', '');?></td>
                                        <td><?php echo $currency_symbol . number_format($row['payment']['total_paid'], 2, '.', '');?></td>
                                        <td><?php echo $currency_symbol . number_format($row['payment']['total_discount'], 2, '.', '');?></td>
                                        <td><?php echo $currency_symbol . number_format($row['payment']['total_fine'], 2, '.', '');?></td>
                                        <td><?php echo $currency_symbol . number_format(($row['total_fees'] - $paid), 2, '.', '');?></td>
                                        <!--                                <td>--><?php //echo $row['fee_month'];?><!--</td>-->
                                        <!--                                <td>--><?php //echo $row['fee_year'];?><!--</td>-->
                                    </tr>
                                <?php } endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo ($currency_symbol . number_format($totalfees, 2, '.', '')); ?></th>
                                <th><?php echo ($currency_symbol . number_format($totalpaid, 2, '.', '')); ?></th>
                                <th><?php echo ($currency_symbol . number_format($totaldiscount, 2, '.', '')); ?></th>
                                <th><?php echo ($currency_symbol . number_format($totalfine, 2, '.', '')); ?></th>
                                <th><?php echo ($currency_symbol . number_format($totalbalance, 2, '.', '')); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </section>
        <?php endif; ?>
    </div>
</div>


<!--------------------due fee report-----------end here------------>

<!-------------------------------------fee payment history report------------------------------------------------------->
<?php
$widget = (is_superadmin_loggedin() ? 3 : 4);
$currency_symbol = $global_config['currency_symbol'];
?>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"><?=translate('branch')?> <span class="required">*</span></label>
                                <?php
                                $arrayBranch = $this->app_lib->getSelectList('branch');
                                echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' id='branch_id' onchange='getClassByBranch(this.value)'
								required data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-<?php echo $widget; ?> mb-sm">
                        <div class="form-group">
                            <label class="control-label"><?=translate('class')?></label>
                            <?php
                            $arrayClass = $this->app_lib->getClass($branch_id);
                            echo form_dropdown("class_id", $arrayClass, set_value('class_id'), "class='form-control' id='class_id'
								data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity' ");
                            ?>
                        </div>
                    </div>

                    <div class="col-md-<?php echo $widget; ?> mb-sm">
                        <div class="form-group">
                            <label class="control-label"><?php echo translate('date'); ?> <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-calendar-check"></i></span>
                                <input type="text" class="form-control daterange" name="daterange" value="<?php echo set_value('daterange', date("Y/m/d") . ' - ' . date("Y/m/d")); ?>" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-offset-10 col-md-2">
                        <button type="submit" name="search" value="1" class="btn btn-default btn-block"> <i class="fas fa-filter"></i> <?=translate('filter')?></button>
                    </div>
                </div>
            </footer>
            <?php echo form_close();?>
        </section>
        <?php if (isset($invoicelist)): ?>
            <section class="panel appear-animation" data-appear-animation="<?php echo $global_config['animations'];?>" data-appear-animation-delay="100">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-list-ol"></i> <?=translate('fees_report');?></h4>
                </header>
                <div class="panel-body">
                    <div class="mb-md mt-md">
                        <div class="export_title"><?=translate('fees_report')?></div>
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
                                                <h2 class="mt-none mb-none text-dark">Islamia University School System (ISS)</h2>
                                                <h4 class="mt-none mb-none text-dark">Contact: +92-62-9255863</h4>
                                                <h4 class="mt-none mb-none text-dark">Email: diss@iub.edu.pk</h4>
                                                <p class="mb-none">
                                                    <span class="text-dark"><?=translate('date')?> : </span>
                                                    <span class="value"><?=_d(date('Y-m-d'))?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </header>
                                    <table class="table table-bordered table-condensed table-hover mb-none tbr-top"  >
                                        <thead>
                                        <tr>
                                            <!--                                            <th>--><?//=translate('name')?><!--</th>-->
                                            <!--                                            <th>--><?//=translate('register_no')?><!--</th>-->
                                            <!--                                            <th>--><?//=translate('roll')?><!--</th>-->
                                            <!--                                            <th>--><?//=translate('date')?><!--</th>-->
                                            <!--                                            <th>--><?//=translate('class')?><!--</th>-->
                                            <!--                                            <th>--><?//=translate('collect_by')?><!--</th>-->
                                            <th><?=translate('payment_via')?></th>
                                            <th><?=translate('fees_type')?></th>
                                            <th><?=translate('amount')?></th>
                                            <th><?=translate('discount')?></th>
                                            <th><?=translate('fine')?></th>
                                            <th><?=translate('total')?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $gross_total_amount = 0;
                                        $gross_total_discount = 0;
                                        $gross_total_fine = 0;
                                        $gross_total = 0;
                                        $std_count = 0;
                                        foreach ($invoicelist as $student_name => $record){
                                            $std_total_amount = 0;
                                            $std_total_discount = 0;
                                            $std_total_fine = 0;
                                            $std_total_p = 0;
                                            $std_total = 0;
                                            $std_count++;
                                            ?>
                                            <?php foreach ($record as $rec){
                                                $std_total_amount += $rec['amount'];
                                                $std_total_discount += $rec['discount'];
                                                $std_total_fine += $rec['fine'];
                                                $std_total_p = ($rec['amount'] + $rec['fine']) - $rec['discount'];
                                                $std_total += $std_total_p;

                                                ?>
                                                <tr>
                                                    <!--                                                    <td>--><?//=$student_name?><!--</td>-->
                                                    <!--                                                    <td>--><?//=$rec['register_no']?><!--</td>-->
                                                    <!--                                                    <td>--><?//=$rec['roll']?><!--</td>-->
                                                    <!--                                                    <td>--><?//=$rec['date']?><!--</td>-->
                                                    <!--                                                    <td>--><?//=$rec['class_name']?><!--</td>-->
                                                    <!--                                                    <td>--><?php //if($rec['collect_by'] == 'online'){
                                                    //                                                            echo "Online";
                                                    //                                                        } else {
                                                    //                                                            echo get_type_name_by_id('staff', $rec['collect_by']);
                                                    //                                                        }?><!--</td>-->
                                                    <td><?=$rec['pay_via']?></td>
                                                    <td><?=$rec['type_name']?></td>
                                                    <td><?= $currency_symbol . $rec['amount']?></td>
                                                    <td><?= $currency_symbol . $rec['discount']?></td>
                                                    <td><?= $currency_symbol . $rec['fine']?></td>
                                                    <td><?= $currency_symbol . number_format($std_total_p, 2, '.', '');?></td>
                                                </tr>
                                            <?php }?>
                                            <tr style="background-color: #eeeeee">
                                                <th><?=$student_name?></th>
                                                <!--                                                <th></th>-->
                                                <!--                                                <th></th>-->
                                                <!--                                                <th></th>-->
                                                <th><?=$rec['class_name']?></th>
                                                <!--                                                <th></th>-->
                                                <!--                                                <th></th>-->
                                                <!--                                                <th></th>-->
                                                <th><?php echo ($currency_symbol . number_format($std_total_amount, 2, '.', '')); ?></th>
                                                <th><?php echo ($currency_symbol . number_format($std_total_discount, 2, '.', '')); ?></th>
                                                <th><?php echo ($currency_symbol . number_format($std_total_fine, 2, '.', '')); ?></th>
                                                <th><?php echo ($currency_symbol . number_format($std_total, 2, '.', '')); ?></th>
                                            </tr>
                                            <?php
                                            $gross_total_amount += $std_total_amount;
                                            $gross_total_discount += $std_total_discount;
                                            $gross_total_fine += $std_total_fine;
                                            $gross_total += $std_total;
                                        } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr style="background-color: #cfc0c0; font-size: larger">

                                            <!--                                            <th></th>-->
                                            <!--                                            <th></th>-->
                                            <!--                                            <th></th>-->
                                            <!--                                            <th></th>-->
                                            <!--                                            <th></th>-->
                                            <!--                                            <th></th>-->
                                            <th>Total Students</th>
                                            <th><?=$std_count?></th>
                                            <th><?php echo ($currency_symbol . number_format($gross_total_amount, 2, '.', '')); ?></th>
                                            <th><?php echo ($currency_symbol . number_format($gross_total_discount, 2, '.', '')); ?></th>
                                            <th><?php echo ($currency_symbol . number_format($gross_total_fine, 2, '.', '')); ?></th>
                                            <th><?php echo ($currency_symbol . number_format($gross_total, 2, '.', '')); ?></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
</div>


<script type="text/javascript">

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    $(document).ready(function () {

        $('#rowGroup').DataTable( {
            dom: '<"row"<"col-sm-6 mb-xs"B><"col-sm-6"f>><"table-responsive"t>p',
            autoWidth: false,
            pageLength: 25,
            order: [[0, 'asc']],
            rowGroup: {
                dataSrc: 0
            },
            columnDefs: [ {
                targets: [ 0 ],
                visible: false
            } ],
            "buttons": [
                {
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i>',
                    titleAttr: 'Copy',
                    title: $('.export_title').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i>',
                    titleAttr: 'Excel',
                    title: $('.export_title').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-alt"></i>',
                    titleAttr: 'CSV',
                    title: $('.export_title').html(),
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i>',
                    titleAttr: 'PDF',
                    title: $('.export_title').html(),
                    footer: true,
                    customize: function ( win ) {
                        win.styles.tableHeader.fontSize = 10;
                        win.styles.tableFooter.fontSize = 10;
                        win.styles.tableHeader.alignment = 'left';
                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    title: $('.export_title').html(),
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '9pt' );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );

                        $(win.document.body).find( 'h1' )
                            .css( 'font-size', '14pt' );
                    },
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns"></i>',
                    titleAttr: 'Columns',
                    title: $('.export_title').html(),
                    postfixButtons: ['colvisRestore']
                },
            ]
        } );



        var branchID = "<?=$branch_id?>";
        var typeID = "<?=set_value('fees_type')?>";
        var classID = "<?=set_value('class_id')?>";
        var sectionID = "<?=set_value('section_id')?>";
        getTypeByBranch(branchID, typeID);
        getStudentByClass(branchID, classID);


        $('#branch_id').on('change', function() {
            var branchID = $(this).val();
            getClassByBranch(branchID);
            getTypeByBranch(branchID);

        });

        $('#section_id').on('change', function() {
            var section_id = $(this).val();
            var class_id = $('#class_id').val();
            var branch_id = ($( "#branch_id" ).length ? $('#branch_id').val() : "");
            getStudentByClass(branch_id, class_id, section_id);
        });

        function getStudentByClass(branch_id, class_id) {
            var student_id = "<?=set_value('student_id')?>";
            $.ajax({
                url: base_url + 'ajax/getStudentByClass',
                type: 'POST',
                data: {
                    branch_id: branch_id,
                    class_id: class_id,
                    section_id: section_id,
                    student_id: student_id
                },
                success: function (data) {
                    $('#student_id').html(data);
                }
            });
        }

        function getTypeByBranch(branchID, typeID) {
            $.ajax({
                url: base_url + 'fees/getTypeByBranch',
                type: 'POST',
                data: {
                    'branch_id' : branchID,
                    'type_id' : typeID
                },
                success: function (data) {
                    $('#feesType').html(data);
                }
            });
        }
    });
</script>