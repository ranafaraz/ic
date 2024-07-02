<?php $widget = (is_superadmin_loggedin() ? 3 : 4); ?>
<section class="panel">
    <header class="panel-heading">
        <h4 class="panel-title"><?= translate('select_fee_group') ?></h4>
    </header>
    <?php echo form_open('TestFeeController/save_fee_allocation', array('id' => 'fee_form')); ?>
    <div class="panel-body">
        <div class="row mb-sm">
            <?php if (is_superadmin_loggedin()): ?>
                <div class="col-md-3 mb-sm">
                    <div class="form-group">
                        <label class="control-label"><?= translate('branch') ?> <span class="required">*</span></label>
                        <?php
                        $arrayBranch = $this->app_lib->getSelectList('branch');
                        echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' onchange='getClassByBranch(this.value)'
                            data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                        ?>
                        <span class="error"><?= form_error('branch_id') ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-<?php echo $widget; ?> mb-sm">
                <div class="form-group">
                    <label class="control-label"><?= translate('fee_groups') ?> <span class="required">*</span></label>
                    <?php
                    $fee_group_options = [];
                    foreach ($fee_groups as $group) {
                        $fee_group_options[$group->id] = $group->title;
                    }
                    echo form_dropdown("fee_group_ids[]", $fee_group_options, set_value('fee_group_ids[]'), "class='form-control' id='fee_groups' multiple='multiple'
                        data-plugin-selectTwo data-width='100%' data-minimum-results-for-search='Infinity'");
                    ?>
                    <span class="error"><?= form_error('fee_group_ids[]') ?></span>
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="fetchFeeGroupDetails()"><?= translate('fetch_details') ?></button>
            </div>
        </div>

        <div class="row mb-sm">
            <div class="col-md-3 mb-sm">
                <div class="form-group">
                    <label class="control-label">
                        <input type="radio" name="discount_type" value="percentage" checked>
                        <?= translate('percentage') ?>
                    </label>
                    <label class="control-label">
                        <input type="radio" name="discount_type" value="fixed">
                        <?= translate('fixed_amount') ?>
                    </label>
                </div>
            </div>
            <div class="col-md-3 mb-sm">
                <div class="form-group">
                    <label class="control-label"><?= translate('apply_discount_to_all') ?></label>
                    <input type="text" id="global_discount" class="form-control" placeholder="<?= translate('enter_discount') ?>">
                    <button type="button" class="btn btn-default" onclick="applyGlobalDiscount()"><?= translate('apply_discount') ?></button>
                    <span id="global_discount_feedback" class="feedback"></span>
                </div>
            </div>
        </div>
        <div id="fee_group_details"></div>
        <div id="error_messages" class="error"></div>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                <button type="button" class="btn btn-default btn-block" onclick="validateAndSubmitForm()">
                    <i class="fas fa-save"></i> <?= translate('save') ?>
                </button>
            </div>
        </div>
    </footer>
    <?php echo form_close(); ?>
</section>

<script>
    function fetchFeeGroupDetails() {
        let selectedGroups = $('#fee_groups').val();
        if (!selectedGroups || selectedGroups.length === 0) {
            $('#error_messages').html('<?= translate("Please select at least one fee group.") ?>');
            return;
        } else {
            $('#error_messages').html(''); // Clear any previous error messages
        }
        $.post('<?php echo base_url('TestFeeController/fetch_fee_group_details'); ?>', { fee_group_ids: selectedGroups }, function(data) {
            let feeDetails = JSON.parse(data);
            let table = '<table class="table table-bordered table-hover table-condensed mb-none">';
            table += '<thead><tr><th><?= translate('fee_type') ?></th><th><?= translate('amount') ?></th><th><?= translate('due_date') ?></th><th><?= translate('discount') ?></th><th><?= translate('net_receivable') ?></th><th><?= translate('action') ?></th></tr></thead><tbody>';
            feeDetails.forEach(function(detail) {
                table += `<tr>
                        <td>${detail.fee_type_title}</td>
                        <td><input type="text" name="fee_allocation[${detail.id}][amt]" value="${detail.amt}" class="form-control amt" oninput="validateAmount(this)" readonly></td>
                        <td><input type="text" name="fee_allocation[${detail.id}][due_date]" value="${detail.due_date}" class="form-control due_date" oninput="validateDueDate(this)"></td>
                        <td><input type="text" name="fee_allocation[${detail.id}][discount]" class="form-control discount" oninput="updateNetReceivable(this)"></td>
                        <td><input type="text" name="fee_allocation[${detail.id}][net_receivable]" class="form-control net_receivable" readonly></td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="deleteRow(this, ${detail.id})"><?= translate('delete') ?></button>
                            <button type="button" class="btn btn-default" onclick="duplicateRow(this)"><?= translate('duplicate') ?></button>
                        </td>
                      </tr>`;
            });
            table += '</tbody></table>';
            $('#fee_group_details').html(table);
        });
    }

    function deleteRow(button, id) {
        if (confirm('<?= translate("Are you sure you want to delete this record?") ?>')) {
            $.post('<?php echo base_url('TestFeeController/delete_fee_group_detail'); ?>', { id: id }, function(response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    $(button).closest('tr').remove();
                } else {
                    alert(result.message);
                }
            });
        }
    }

    function duplicateRow(button) {
        let row = $(button).closest('tr');
        let clone = row.clone();

        // Update the name attributes to avoid conflicts
        clone.find('input').each(function() {
            let name = $(this).attr('name');
            if (name) {
                let newName = name.replace(/\[\d+\]/, function(match) {
                    let number = parseInt(match.match(/\d+/)[0]) + 1;
                    return `[${number}]`;
                });
                $(this).attr('name', newName);
            }
        });

        // Append the cloned row after the original row
        row.after(clone);
    }

    function removeRow(button) {
        $(button).closest('tr').remove();
    }

    function applyGlobalDiscount() {
        let discountType = $('input[name="discount_type"]:checked').val();
        let globalDiscount = $('#global_discount').val();
        let isValid = true;
        let feedback = '';

        if (discountType === 'percentage') {
            if (!$.isNumeric(globalDiscount) || globalDiscount < 0 || globalDiscount > 100) {
                isValid = false;
                feedback = '<?= translate("Percentage discount must be a number between 0 and 100.") ?>';
            } else {
                $('.discount').val(globalDiscount + '%').trigger('input');
                $('#global_discount_feedback').html('');
            }
        } else {
            if (!$.isNumeric(globalDiscount) || globalDiscount < 0) {
                isValid = false;
                feedback = '<?= translate("Fixed amount discount must be a positive number.") ?>';
            } else {
                $('.discount').val('Rs ' + globalDiscount).trigger('input');
                $('#global_discount_feedback').html('');
            }
        }

        if (!isValid) {
            $('#global_discount_feedback').html(feedback);
        }
    }

    function updateNetReceivable(discountInput) {
        let discountType = $('input[name="discount_type"]:checked').val();
        let discountValue = $(discountInput).val();
        let discount = parseFloat(discountValue.replace(/[^\d.-]/g, '')) || 0;  // Remove any non-numeric characters
        let amountInput = $(discountInput).closest('tr').find('.amt');
        let amount = parseFloat(amountInput.val()) || 0;
        let netReceivable = 0;

        if (discountType === 'percentage') {
            netReceivable = amount - (amount * discount / 100);
        } else {
            netReceivable = amount - discount;
        }

        $(discountInput).closest('tr').find('.net_receivable').val(netReceivable.toFixed(2));
    }

    function validateAmount(amountInput) {
        let value = $(amountInput).val();
        if (!$.isNumeric(value) || value <= 0) {
            $(amountInput).addClass('error');
        } else {
            $(amountInput).removeClass('error');
        }
    }

    function validateDueDate(dueDateInput) {
        let value = $(dueDateInput).val();
        if (!value) {
            $(dueDateInput).addClass('error');
        } else {
            $(dueDateInput).removeClass('error');
        }
    }

    function validateAndSubmitForm() {
        let isValid = true;
        let errorMessages = '';

        $('#error_messages').html('');

        $('.amt').each(function() {
            let value = $(this).val();
            if (!$.isNumeric(value) || value <= 0) {
                isValid = false;
                errorMessages += '<p><?= translate("Amount must be a positive number.") ?></p>';
            }
        });

        $('.due_date').each(function() {
            let value = $(this).val();
            if (!value) {
                isValid = false;
                errorMessages += '<p><?= translate("Due date cannot be empty.") ?></p>';
            }
        });

        $('.discount').each(function() {
            let discountType = $('input[name="discount_type"]:checked').val();
            let value = $(this).val();
            let discount = parseFloat(value.replace(/[^\d.-]/g, '')) || 0;
            if (discountType === 'percentage') {
                if (!$.isNumeric(discount) || discount < 0 || discount > 100) {
                    isValid = false;
                    errorMessages += '<p><?= translate("Percentage discount must be a number between 0 and 100.") ?></p>';
                }
            } else {
                if (!$.isNumeric(discount) || discount < 0) {
                    isValid = false;
                    errorMessages += '<p><?= translate("Fixed amount discount must be a positive number.") ?></p>';
                }
            }
        });

        if (isValid) {
            $('#fee_form').submit();
        } else {
            $('#error_messages').html(errorMessages);
        }
    }
</script>
