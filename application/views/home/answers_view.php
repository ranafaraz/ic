<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Franchise and School Conversion Offer Survey View</h3>
                </div>
                <div class="card-body">
                   <table>
                       <thead>
                       <tr>
                           <th>Sr No.</th>
                           <th>Question</th>
                           <th>Answer</th>
                           <th>Mobile Number</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php foreach ($answers as $row): ?>
                           <tr>
                               <td><?php echo $row['id']; ?></td>
                               <td><?php echo $row['question']; ?></td>
                               <td><?php echo $row['opt']; ?></td>
<!--                               <td>--><?php //echo $row['opt']; ?><!--</td>-->
                               <td><?php echo $row['input']; ?></td>
                           </tr>
                       <?php endforeach; ?>
                       </tbody>

                   </table>
                </div>
            </div>
        </div>
    </div>
    <br>

</div>